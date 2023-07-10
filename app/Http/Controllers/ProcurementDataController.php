<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\ProcurementData;
use App\Models\SpendCategory;
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
            }

            //dd('Rows with full info:', $rowsWithFullInfo, 'Rows with missing info:', $rowsWithMissingInfo);

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
