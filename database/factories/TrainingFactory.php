<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Training>
 */
class TrainingFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'product_id' => Product::inRandomOrder()->first()->id,
            'title' => $this->faker->title,
            'is_paid' => $this->faker->boolean,
            'link_to_order' => $this->faker->url,
            'image' => $this->faker->imageUrl,
        ];
    }
}
