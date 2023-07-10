<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\SpendCategory;
use App\Models\ProcurementData;
use Illuminate\Database\Seeder;

class ProcurementDataSeeder extends Seeder
{
    public function run()
    {
        // Create categories
        $categoryNames = ['Category 1', 'Category 2', 'Category 3', 'Category 4', 'Category 5'];
        $categories = [];
        foreach ($categoryNames as $name) {
            $categories[] = Category::create(['name' => $name]);
        }

        // Create spend categories
        $spendCategoryNames = ['Spend Category 1', 'Spend Category 2', 'Spend Category 3', 'Spend Category 4', 'Spend Category 5'];
        $spendCategories = [];
        foreach ($spendCategoryNames as $name) {
            $spendCategories[] = SpendCategory::create(['name' => $name]);
        }

        // Create procurement data
        for ($i = 0; $i < 20; $i++) {
            ProcurementData::create([
                'firm_name' => 'Firm ' . ($i + 1),
                'certificate_number' => 'Certificate ' . ($i + 1),
                'agpo_cert_no' => 'AGPO ' . ($i + 1),
                'category_id' => $categories[array_rand($categories)]->id,
                'directors' => ['Director 1', 'Director 2'],
                'postal_address' => '1234 Street',
                'email' => 'email' . ($i + 1) . '@example.com',
                'mobile_number' => '1234567890',
                'amount' => rand(10000, 20000),
                'spend_category_id' => $spendCategories[array_rand($spendCategories)]->id,
                'procurement_number' => 'Procurement ' . ($i + 1),
                'procurement_method' => 'Method ' . ($i + 1),
            ]);
        }
    }
}
