<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Review;
use Faker\Factory as Faker;

class ReviewsSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('ar_SA');

        for ($i = 0; $i < 10; $i++) {
            Review::create([
                'name' => $faker->name,
                'title' => $faker->jobTitle,
                'description' => $faker->paragraph(3),
                'img' => $faker->boolean ? "review-" . ($i % 3 + 1) . ".jpg" : null,
            ]);
        }
    }
}
