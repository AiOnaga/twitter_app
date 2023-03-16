<?php

namespace Database\Factories;

use App\Models\TweetPost;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\TweetComment>
 */
class TweetCommentFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $userId = User::all()->random()->id;

        return [
            'user_id'=> $userId,
            'post_id'=>TweetPost::whereNot('user_id', $userId)->first()->id,
            'comment'=>fake()->realText($maxNbChars = 50, $indexSize = 2),
        ];
    }
}
