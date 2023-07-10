<?php

namespace Database\Factories;

use App\Models\SpendCategory;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SpendCategory>
 */
class SpendCategoryFactory extends Factory
{
    protected $model = SpendCategory::class;

    public function definition()
    {
        return [
            'name' => $this->faker->word,
        ];
    }
}
