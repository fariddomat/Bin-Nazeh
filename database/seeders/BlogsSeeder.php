<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Blog;
use App\Models\BlogCategory;
use Faker\Factory as Faker;

class BlogsSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('ar_SA');
        $categories = BlogCategory::all()->pluck('id')->toArray();

        $blogs = [
            [
                'slug' => 'real-estate-trends-2025',
                'blog_category_id' => $categories[0],
                'image' => 'blog-1.jpg',
                'image_alt' => 'اتجاهات السوق العقاري 2025',
                'index_image' => 'blog-index-1.jpg',
                'index_image_alt' => 'صورة مميزة لاتجاهات السوق',
                'showed' => true,
                'show_at_home' => true,
                'title' => 'اتجاهات السوق العقاري لعام 2025',
                'introduction' => 'اكتشف أحدث اتجاهات السوق العقاري في الرياض، بما في ذلك الاستدامة والتصميمات الحديثة.',
                'content_table' => '<ul><li>الاستدامة</li><li>التكنولوجيا الذكية</li><li>التصميمات المفتوحة</li></ul>',
                'first_paragraph' => 'يشهد السوق العقاري في الرياض تحولات كبيرة مع اقتراب عام 2025، حيث تتصدر الاستدامة قائمة الاتجاهات.',
                'description' => 'تحليل شامل لاتجاهات السوق العقاري، مع التركيز على الاستدامة، التكنولوجيا الذكية، والتصميمات الحديثة التي تشكل مستقبل العقارات.',
                'author_name' => 'محمد النازح',
                'author_title' => 'خبير عقاري',
                'author_image' => 'author-1.jpg',
            ],
            // Add more blog entries similarly...
        ];

        // Generate 15 blogs (3 per category)
        for ($i = 0; $i < 15; $i++) {
            Blog::create([
                'slug' => $faker->slug,
                'blog_category_id' => $categories[$i % count($categories)],
                'image' => "blog-" . ($i % 5 + 1) . ".jpg",
                'image_alt' => $faker->sentence(3),
                'index_image' => $faker->boolean ? "blog-index-" . ($i % 5 + 1) . ".jpg" : null,
                'index_image_alt' => $faker->boolean ? $faker->sentence(3) : null,
                'showed' => $faker->boolean(80),
                'show_at_home' => $faker->boolean(30),
                'title' => $faker->sentence(4),
                'introduction' => $faker->paragraph(2),
                'content_table' => '<ul><li>' . implode('</li><li>', $faker->words(3)) . '</li></ul>',
                'first_paragraph' => $faker->paragraph(3),
                'description' => $faker->paragraph(5),
                'author_name' => $faker->name,
                'author_title' => $faker->jobTitle,
                'author_image' => 'author-' . ($i % 3 + 1) . '.jpg',
            ]);
        }

        // Ensure the first blog is included
        Blog::create($blogs[0]);
    }
}
