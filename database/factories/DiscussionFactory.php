<?php

namespace Database\Factories;

use App\Services\DiscussionStatus;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Discussion>
 */
class DiscussionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'discussion_link' => $this->faker->url,
            'speaker_name' => $this->faker->name,
            'image' => $this->faker->imageUrl,
            'status' => DiscussionStatus::values()->random()
        ];
    }
}
