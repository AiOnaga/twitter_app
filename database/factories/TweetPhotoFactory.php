<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\TweetPost;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TweetPhoto>
 */
class TweetPhotoFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'post_id'=>TweetPost::all()->random()->id,
            'image'=>"https://picsum.photos/500/420",
        ];
    }
}
