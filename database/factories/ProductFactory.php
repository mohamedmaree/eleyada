<?php

namespace Database\Factories;

use App\Models\ProductPicture;
use App\Models\ProductType;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'price' => $this->faker->numberBetween(100, 1000),
            'ar_icon' => $this->faker->url,
            'video' => $this->faker->boolean ? 'storage/product/video/test-video.mp4' : 'https://www.youtube.com/watch?v=krDWc30PAGg&ab_channel=H%E1%BB%93ngH%E1%BA%A3i',
            'product_type_id' => ProductType::inRandomOrder()->first()->id,
        ];
    }
}
