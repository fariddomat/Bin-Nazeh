<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\BlogCategory;
use Faker\Factory as Faker;

class BlogCategoriesSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('ar_SA');

        $categories = [
            [
                'slug' => 'real-estate-trends',
                'name' => 'اتجاهات السوق العقاري',
                'description' => 'استكشف أحدث الاتجاهات في سوق العقارات بالرياض، من الاستدامة إلى التصميمات الحديثة.',
                'img' => 'category-1.jpg',
            ],
            [
                'slug' => 'investment-opportunities',
                'name' => 'فرص الاستثمار',
                'description' => 'تعرف على أفضل فرص الاستثمار العقاري في المملكة العربية السعودية.',
                'img' => 'category-2.jpg',
            ],
            [
                'slug' => 'sustainable-living',
                'name' => 'الحياة المستدامة',
                'description' => 'اكتشف كيفية دمج الاستدامة في العقارات لتحسين جودة الحياة.',
                'img' => 'category-3.jpg',
            ],
            [
                'slug' => 'design-innovations',
                'name' => 'الابتكارات التصميمية',
                'description' => 'اطلع على أحدث التصميمات المعمارية التي تجمع بين الجمال والوظيفية.',
                'img' => 'category-4.jpg',
            ],
            [
                'slug' => 'market-insights',
                'name' => 'رؤى السوق',
                'description' => 'تحليلات وتوقعات لسوق العقارات في الرياض وخارجها.',
                'img' => 'category-5.jpg',
            ],
        ];

        foreach ($categories as $category) {
            BlogCategory::create($category);
        }
    }
}
