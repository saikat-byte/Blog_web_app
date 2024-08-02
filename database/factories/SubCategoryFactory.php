<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\SubCategory>
 */
class SubCategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            // 'sub_category_name' => $this->faker->name(),
            // 'slug_name' => $this->faker->unique()->slug(),
            // 'category_id' => Category::inRandomOrder()->first()->id,
            // 'order_by' => $this->faker->numberBetween(0, 100),
            // 'status' => $this->faker->numberBetween(0, 1),
        ];
    }
}
