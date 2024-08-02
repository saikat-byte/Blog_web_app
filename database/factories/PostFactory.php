<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\SubCategory;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Ramsey\Uuid\Type\Integer;

use function Laravel\Prompts\text;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Post>
 */
class PostFactory extends Factory
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
            // 'category_id' =>Category::inRandomOrder()->first()->id,
            // 'sub_category_id' => SubCategory::inRandomOrder()->first()->id,
            // 'user_id' => User::inRandomOrder()->first()->id,
            // 'description' => $this->faker->text(500),
            // 'status' => $this->faker->numberBetween(0, 1),
            // 'admin_comment' => $this->faker->sentence(15),
        ];
    }
}
