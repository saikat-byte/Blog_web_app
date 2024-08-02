<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Category>
 */
class CategoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
         return [
            // 'title' => $this->faker->name(),
            // 'slug' => $this->faker->unique()->slug(),
            // 'is_approved' => $this->faker->numberBetween(0, 1),
            // 'category_id' => $this->faker->numberBetween(1, 10),
            // 'sub_category_id' => $this->faker->numberBetween(1, 10),
            // 'user_id' => $this->faker->numberBetween(1, 5),
            // 'description' => $this->faker->text(500),
            // 'status' => $this->faker->numberBetween(0, 1),
            // 'admin_comment' => $this->faker->sentence(15),
        ];
    }
}
