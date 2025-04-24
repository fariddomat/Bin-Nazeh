<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Project;
use App\Models\ProjectCategory;
use Faker\Factory as Faker;

class ProjectsSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('ar_SA');
        $categories = ProjectCategory::all()->pluck('id')->toArray();

        $projects = [
            [
                'name' => 'نازح فيلا',
                'slug' => 'nazeh-villa',
                'date_of_build' => '2024-01-15',
                'address' => 'حي الملقا، الرياض',
                'address_location' => 'https://maps.google.com/?q=24.781,46.625',
                'virtual_location' => 'https://virtual-tour.nazeh.com/villa',
                'scheme_name' => 'فيلا فاخرة',
                'floors_count' => 3,
                'details' => 'فيلا فاخرة بتصميم عصري، تحتوي على 5 غرف نوم ومسبح خاص.',
                'img' => 'project-1.jpg',
                'cover_img' => 'project-cover-1.jpg',
                'status' => 'done',
                'status_percent' => 100,
                'project_category_id' => $categories[0],
                'sort_id' => 1,
            ],
            // Add more project entries...
        ];

        // Generate 12 projects (3 per category)
        for ($i = 0; $i < 12; $i++) {
            Project::create([
                'name' => $faker->sentence(3),
                'slug' => $faker->slug,
                'date_of_build' => $faker->dateTimeBetween('-2 years', 'now')->format('Y-m-d'),
                'address' => $faker->address,
                'address_location' => $faker->boolean ? 'https://maps.google.com/?q=' . $faker->latitude . ',' . $faker->longitude : null,
                'virtual_location' => $faker->boolean ? $faker->url : null,
                'scheme_name' => $faker->word,
                'floors_count' => $faker->numberBetween(1, 10),
                'details' => $faker->paragraph(5),
                'img' => "project-" . ($i % 4 + 1) . ".jpg",
                'cover_img' => $faker->boolean ? "project-cover-" . ($i % 4 + 1) . ".jpg" : null,
                'status' => $faker->randomElement(['not_started', 'pending', 'done']),
                'status_percent' => $faker->numberBetween(0, 100),
                'project_category_id' => $categories[$i % count($categories)],
                'sort_id' => $i + 1,
            ]);
        }

        Project::create($projects[0]);
    }
}
