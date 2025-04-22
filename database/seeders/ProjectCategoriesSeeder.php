<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\ProjectCategory;
use Faker\Factory as Faker;

class ProjectCategoriesSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('ar_SA');

        $categories = [
            [
                'name' => 'فلل سكنية',
                'description' => 'مشاريع فلل فاخرة مصممة لتوفير الراحة والفخامة.',
                'img' => 'project-cat-1.jpg',
            ],
            [
                'name' => 'مباني تجارية',
                'description' => 'مشاريع تجارية حديثة تلبي احتياجات الأعمال.',
                'img' => 'project-cat-2.jpg',
            ],
            [
                'name' => 'مجمعات سكنية',
                'description' => 'مجمعات سكنية متكاملة مع مرافق عصرية.',
                'img' => 'project-cat-3.jpg',
            ],
            [
                'name' => 'مشاريع استثمارية',
                'description' => 'مشاريع مصممة لتحقيق عوائد استثمارية عالية.',
                'img' => 'project-cat-4.jpg',
            ],
        ];

        foreach ($categories as $category) {
            ProjectCategory::create($category);
        }
    }
}
