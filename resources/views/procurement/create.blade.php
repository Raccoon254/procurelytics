@extends('layouts.app')
@section('title', 'Add Procurement Data')
@section('content')

    <div class="flex flex-col items-center">
        <h1 class="my-5 text-3xl font-semibold">Add Procurement Data</h1>

        <form action="{{ route('procurement.store') }}" method="post" enctype="multipart/form-data" class="w-full max-w-3xl mx-3">
            @csrf


            <div class="grid gap-5 lg:grid-cols-2">
                <div class="space-y-1">
                    <label for="firm_name" class="text-sm font-medium">Name of the Firm:</label>
                    <input type="text" id="firm_name" name="firm_name" class="w-full input input-bordered form-input">
                </div>

                <div class="space-y-1">
                    <label for="certificate_number" class="text-sm font-medium">Certificate Number:</label>
                    <input type="text" id="certificate_number" name="certificate_number" class="w-full input input-bordered form-input">
                </div>

                <div class="space-y-1">
                    <label for="agpo_cert_no" class="text-sm font-medium">AGPO CERT NO:</label>
                    <input type="text" id="agpo_cert_no" name="agpo_cert_no" class="w-full input input-bordered form-input">
                </div>

                <div class="space-y-1">
                    <label for="category_id" class="text-sm font-medium">Category:</label>
                    <select id="category_id" name="category_id" class="w-full input input-bordered form-select">
                        @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="space-y-1">
                    <label for="directors" class="text-sm font-medium">Numbers and Names of Directors:</label>
                    <textarea id="directors" name="directors" class="w-full input input-bordered form-textarea"></textarea>
                </div>

                <div class="space-y-1">
                    <label for="postal_address" class="text-sm font-medium">Postal Address:</label>
                    <input type="text" id="postal_address" name="postal_address" class="w-full input input-bordered form-input">
                </div>

                <div class="space-y-1">
                    <label for="email" class="text-sm font-medium">Email Address:</label>
                    <input type="email" id="email" name="email" class="w-full input input-bordered form-input">
                </div>

                <div class="space-y-1">
                    <label for="mobile_number" class="text-sm font-medium">Mobile Number:</label>
                    <input type="tel" id="mobile_number" name="mobile_number" class="w-full input input-bordered form-input">
                </div>

                <div class="space-y-1">
                    <label for="amount" class="text-sm font-medium">Amount:</label>
                    <input type="number" id="amount" name="amount" class="w-full input input-bordered form-input">
                </div>

                <div class="space-y-1">
                    <label for="spend_category_id" class="text-sm font-medium">Spend Category:</label>
                    <select id="spend_category_id" name="spend_category_id" class="w-full input input-bordered form-select">
                        @foreach($spendCategories as $spendCategory)
                            <option value="{{ $spendCategory->id }}">{{ $spendCategory->name }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="space-y-1">
                    <label for="procurement_number" class="text-sm font-medium">Procurement Number:</label>
                    <input type="number" id="procurement_number" name="procurement_number" class="w-full input input-bordered form-input">
                </div>

                <div class="space-y-1">
                    <label for="procurement_method" class="text-sm font-medium">Method of Procurement:</label>
                    <input type="text" id="procurement_method" name="procurement_method" class="w-full input input-bordered form-input">
                </div>

                <div class="space-y-0">
                    <label for="excel_file" class="text-sm font-medium">Or upload an Excel file:</label>
                    <input type="file" id="excel_file" name="excel_file" class="file-input input-bordered w-full">
                </div>

                <div>
                    <input type="submit" value="Submit" class="btn btn-primary">
                </div>
            </div>
        </form>
    </div>
@endsection
