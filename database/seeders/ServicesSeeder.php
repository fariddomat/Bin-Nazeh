<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Service;
use Faker\Factory as Faker;

class ServicesSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('ar_SA');

        $services = [
            [
                'name' => 'الاستشارات العقارية',
                'slug' => 'real-estate-consulting',
                'description' => 'تقديم استشارات مهنية للاستثمار العقاري واختيار العقارات المناسبة.',
                'icon' => 'fas fa-building',
                'img' => 'service-1.jpg',
            ],
            [
                'name' => 'إدارة المشاريع',
                'slug' => 'project-management',
                'description' => 'إدارة المشاريع العقارية من التخطيط إلى التنفيذ بكفاءة عالية.',
                'icon' => 'fas fa-project-diagram',
                'img' => 'service-2.jpg',
            ],
            [
                'name' => 'التصميم المعماري',
                'slug' => 'architectural-design',
                'description' => 'تصميمات معمارية مبتكرة تجمع بين الجمال والوظيفية.',
                'icon' => 'fas fa-drafting-compass',
                'img' => 'service-3.jpg',
            ],
            [
                'name' => 'التطوير العقاري',
                'slug' => 'real-estate-development',
                'description' => 'تطوير مشاريع عقارية متكاملة تلبي احتياجات السوق.',
                'icon' => 'fas fa-city',
                'img' => 'service-4.jpg',
            ],
            [
                'name' => 'إدارة الممتلكات',
                'slug' => 'property-management',
                'description' => 'إدارة العقارات بفعالية لضمان أعلى عائد استثماري.',
                'icon' => 'fas fa-home',
                'img' => 'service-5.jpg',
            ],
            [
                'name' => 'التقييم العقاري',
                'slug' => 'property-valuation',
                'description' => 'تقييم دقيق للعقارات لضمان اتخاذ قرارات استثمارية مدروسة.',
                'icon' => 'fas fa-calculator',
                'img' => 'service-6.jpg',
            ],
        ];

        foreach ($services as $service) {
            Service::create($service);
        }
    }
}
