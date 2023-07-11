<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\ProcurementData;
use App\Models\SpendCategory;
use Exception;
use Illuminate\Http\Request;

class ProcurementDataController extends Controller
{
    // ...
    public function create(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $categories = Category::all();
        $spendCategories = SpendCategory::all();
        return view('procurement.create', compact('categories', 'spendCategories'));
    }

    public function store(Request $request)
    {
        if ($request->hasFile('excel_file')) {
            $request->validate([
                'excel_file' => 'required|file|mimes:xls,xlsx',
            ]);

            $file = $request->file('excel_file');

            $spreadsheet = \PhpOffice\PhpSpreadsheet\IOFactory::load($file);
            $worksheet = $spreadsheet->getActiveSheet();

            $highestColumn = $worksheet->getHighestColumn();
            $highestColumnIndex = \PhpOffice\PhpSpreadsheet\Cell\Coordinate::columnIndexFromString($highestColumn);
            $headings = $worksheet->rangeToArray(
                'A1:' . $highestColumn . '1',
                NULL,
                TRUE,
                FALSE
            )[0];

            $requiredFields = [
                'FIRM NAME',
                'CERTIFICATE NO',
                'AGPO CERT NO',
                'CATEGORY',
                'DIRECTORS',
                'ADDRESS',
                'EMAIL',
                'CONTACT',
                'AMOUNT',
                'SPEND CATEGORY',
                'METHOD OF PROCUREMENT',
                'PROCUREMENT NUMBER',
            ];

            $rowsWithFullInfo = [];
            $rowsWithMissingInfo = [];

            $highestRow = $worksheet->getHighestRow();
            for ($row = 2; $row <= $highestRow; ++$row) {
                $rowData = $worksheet->rangeToArray(
                    'A' . $row . ':' . $highestColumn . $row,
                    NULL,
                    TRUE,
                    FALSE
                )[0];

                // Skip this row if all the cells are null
                if (count(array_filter($rowData)) === 0) {
                    continue;
                }

                $rowDataAssoc = array_combine($headings, $rowData);

                // Check for null or empty values
                $missingFields = [];
                foreach ($requiredFields as $requiredField) {
                    if (!isset($rowDataAssoc[$requiredField]) || $rowDataAssoc[$requiredField] === '') {
                        $missingFields[] = $requiredField;
                    }
                }

                if (empty($missingFields)) {
                    $rowsWithFullInfo[] = $rowDataAssoc;
                } else {
                    $rowDataAssoc['missing_fields'] = $missingFields;
                    $rowsWithMissingInfo[] = $rowDataAssoc;
                }
            }

            if (!empty($rowsWithMissingInfo)) {
                return view('procurement.missing-info', ['rowsWithMissingInfo' => $rowsWithMissingInfo, 'requiredFields' => $requiredFields, 'rowsWithFullInfo' => $rowsWithFullInfo]);
            } else {
                // Map the keys to the column names in the database
                $keyMapping = [
                    'FIRM NAME' => 'firm_name',
                    'CERTIFICATE NO' => 'certificate_number',
                    'AGPO CERT NO' => 'agpo_cert_no',
                    'CATEGORY' => 'category_id',
                    'DIRECTORS' => 'directors',
                    'ADDRESS' => 'postal_address',
                    'EMAIL' => 'email',
                    'CONTACT' => 'mobile_number',
                    'AMOUNT' => 'amount',
                    'SPEND CATEGORY' => 'spend_category_id',
                    'METHOD OF PROCUREMENT' => 'procurement_method',
                    'PROCUREMENT NUMBER' => 'procurement_number',
                ];

                $rowsWithFullInfoPrev = $rowsWithFullInfo;

                // Transform the keys of each row in $rowsWithFullInfo according to $keyMapping
                $rowsWithFullInfo = array_map(function ($row) use ($keyMapping) {
                    return array_combine(
                        array_map(function ($key) use ($keyMapping) {
                            return $keyMapping[$key] ?? $key;
                        }, array_keys($row)),
                        $row
                    );
                }, $rowsWithFullInfo);

                session(['rowsWithFullInfo' => $rowsWithFullInfo]);
                return view('procurement.confirm', ['rowsWithFullInfo' => $rowsWithFullInfoPrev]);
            }

            // TODO: Handle the Excel file processing and saving the data into the database
        } else {
            $data = $request->validate([
                'firm_name' => 'required|max:255',
                'certificate_number' => 'required|max:255',
                'agpo_cert_no' => 'required|max:255',
                'category_id' => 'required|exists:categories,id',
                'directors' => 'required',
                'postal_address' => 'required|max:255',
                'email' => 'required|email|max:255',
                'mobile_number' => 'required|max:255',
                'amount' => 'required|numeric',
                'spend_category_id' => 'required|exists:spend_categories,id',
                'procurement_number' => 'required|numeric',
                'procurement_method' => 'required|max:255',
            ]);

            // If 'directors' is a string, convert it to an array
            if (is_string($data['directors'])) {
                $data['directors'] = explode("\n", $data['directors']);
            }

            // Create a new ProcurementData record with the validated data
            $procurementData = ProcurementData::create($data);

            // Redirect to a success page, or wherever you'd like
            return redirect('/procurement/success');
        }
    }

    /**
     * @throws Exception
     */
    public function confirmUpload(Request $request): \Illuminate\Foundation\Application|\Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        $rowsWithFullInfo = session('rowsWithFullInfo', []);

        // Process the rows with full info and create ProcurementData models
        foreach ($rowsWithFullInfo as &$row) {
            // Fetch the category from the database that matches the name in the row data
            $category = Category::where('name', $row['category_id'])->first();
            $spendCategory = SpendCategory::where('name', $row['spend_category_id'])->first();

            if ($category && $spendCategory) {
                // If both the category and spend category were found, replace the names with the IDs in the row data
                $row['category_id'] = $category->id;
                $row['spend_category_id'] = $spendCategory->id;
            } else {
                // If either category was not found, you need to handle this case. Here's a simple example:
                if(!$category) {
                    throw new Exception("Category '{$row['category_id']}' not found.");
                }
                if(!$spendCategory) {
                    throw new Exception("Spend Category '{$row['spend_category_id']}' not found.");
                }
            }

            // Create ProcurementData record
            ProcurementData::create($row);
        }
        unset($row); // Unset reference to keep code safe outside loop.

        // Clear the session
        $request->session()->forget('rowsWithFullInfo');

        // Redirect to a success page
        return redirect('/procurement/success');
    }


    public function show(ProcurementData $procurement): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('procurement.show', compact('procurement'));
    }

    public function visualize(): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        $procurements = ProcurementData::all();
        return view('procurement.visualize', compact('procurements'));
    }

    // ...
}
