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

    public function store(Request $request): \Illuminate\Foundation\Application|\Illuminate\Routing\Redirector|\Illuminate\Http\RedirectResponse|\Illuminate\Contracts\Foundation\Application
    {
        // Validate incoming request data
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
            'excel_file' => 'nullable|file|mimes:xlsx',
        ]);


        //dd($data);
        // If 'directors' is a string, convert it to an array
        if (is_string($data['directors'])) {
            $data['directors'] = explode("\n", $data['directors']);
        }

        // If there's an Excel file, you would handle it here
        if ($request->hasFile('excel_file')) {
            // TODO: Handle the Excel file
        }

        // Create a new ProcurementData record with the validated data
        $procurementData = ProcurementData::create($data);

        // Redirect to a success page, or wherever you'd like
        return redirect('/procurement/success');
    }


    public function show(ProcurementData $procurement): \Illuminate\Contracts\View\View|\Illuminate\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\Foundation\Application
    {
        return view('procurement.show', compact('procurement'));
    }


    // ...
}
