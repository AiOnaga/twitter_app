<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\TweetComment;
use Illuminate\Support\Facades\Schema;

class TweetCommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        TweetComment::truncate();

        TweetComment::factory()
        ->count(10)
        ->create();
    }
}
