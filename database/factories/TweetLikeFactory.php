<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\User;
use App\Models\TweetPost;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TweetLike>
 */
class TweetLikeFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id'=> User::all()->random()->id,
            'post_id'=>TweetPost::all()->random()->id,
        ];
    }
}
