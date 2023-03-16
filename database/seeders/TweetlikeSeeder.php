<?php

namespace Database\Seeders;

use App\Models\TweetLike;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class TweetlikeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        TweetLike::truncate();

        TweetLike::factory()
        ->count(10)
        ->create();

    }
}
