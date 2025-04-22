<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Partner;
use Faker\Factory as Faker;

class PartnersSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('ar_SA');

        for ($i = 0; $i < 8; $i++) {
            Partner::create([
                'name' => $faker->company,
                'img' => "partner-" . ($i % 4 + 1) . ".jpg",
            ]);
        }
    }
}
