<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Model>
 */
class ForumPostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'forum_id' => '1',
            'user_id' => '1',
            'title' => $this->faker->sentence,
            'content' => $this->faker->paragraph,
            'isPinned' => '0',
            'isLocked' => '0',
        ];
    }
}
