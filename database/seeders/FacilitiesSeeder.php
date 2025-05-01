<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Facility;
use Faker\Factory as Faker;

class FacilitiesSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('ar_SA');

        $facilities = [
            [
                'title' => 'مسبح خاص',
                'description' => 'استمتع بالرفاهية مع مسبح خاص في مشاريعنا السكنية.',
                'icon' => 'facility-1.jpg',
            ],
            [
                'title' => 'صالة رياضية',
                'description' => 'حافظ على لياقتك مع صالات رياضية مجهزة بأحدث المعدات.',
                'icon' => 'facility-2.jpg',
            ],
            [
                'title' => 'حدائق خضراء',
                'description' => 'مساحات خضراء للاسترخاء والترفيه مع العائلة.',
                'icon' => 'facility-3.jpg',
            ],
            [
                'title' => 'أمن على مدار الساعة',
                'description' => 'نظام أمني متطور لحماية سكاننا.',
                'icon' => 'facility-4.jpg',
            ],
            [
                'title' => 'مواقف سيارات',
                'description' => 'مواقف سيارات واسعة وآمنة لجميع السكان.',
                'icon' => 'facility-5.jpg',
            ],
            [
                'title' => 'مركز تسوق',
                'description' => 'مراكز تسوق قريبة تلبي كافة احتياجاتك.',
                'icon' => 'facility-6.jpg',
            ],
        ];

        foreach ($facilities as $facility) {
            Facility::create($facility);
        }
    }
}
