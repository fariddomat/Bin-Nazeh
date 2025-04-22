<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call(LaratrustSeeder::class);
        $this->call(UserSeeder::class);
        $this->call([
            BlogCategoriesSeeder::class,
            BlogsSeeder::class,
            ServicesSeeder::class,
            ProjectCategoriesSeeder::class,
            ProjectsSeeder::class,
            CountersSeeder::class,
            PartnersSeeder::class,
            WhiesSeeder::class,
            CertificatesSeeder::class,
            ReviewsSeeder::class,
            TermsSeeder::class,
            SlidersSeeder::class,
            AboutsSeeder::class,
            FacilitiesSeeder::class,
            SocialMediaSeeder::class,
        ]);
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);
    }
}
