<?php

namespace Database\Factories;

use App\Models\ProcurementData;
use App\Models\Category;
use App\Models\SpendCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProcurementDataFactory extends Factory
{
    protected $model = ProcurementData::class;

    public function definition()
    {
        return [
            'firm_name' => $this->faker->company,
            'certificate_number' => $this->faker->unique()->numerify('#####'),
            'agpo_cert_no' => $this->faker->unique()->numerify('#####'),
            'category_id' => Category::factory(),
            'directors' => $this->faker->words(3),
            'postal_address' => $this->faker->address,
            'email' => $this->faker->companyEmail,
            'mobile_number' => $this->faker->phoneNumber,
            'amount' => $this->faker->randomNumber(5),
            'spend_category_id' => SpendCategory::factory(),
            'procurement_number' => $this->faker->randomNumber(5),
            'procurement_method' => $this->faker->randomElement(['Open Tendering', 'Restricted Tendering', 'Direct Procurement']),
        ];
    }
}
