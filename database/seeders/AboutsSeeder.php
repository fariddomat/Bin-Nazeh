<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\About;
use Faker\Factory as Faker;

class AboutsSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('ar_SA');

        $abouts = [
            [
                'name' => 'من نحن',
                'discription' => 'بن نازح هي شركة رائدة في التطوير العقاري بالرياض، ملتزمة بتقديم مشاريع فاخرة ومستدامة.',
                'img' => 'about-1.jpg',
                'icon' => 'fas fa-info-circle',
                'class' => 'about-section',
                'sort_id' => 1,
            ],
            [
                'name' => 'رؤيتنا',
                'discription' => 'نسعى لتحويل الرياض إلى مركز عقاري عالمي من خلال الابتكار والجودة.',
                'img' => 'about-2.jpg',
                'icon' => 'fas fa-eye',
                'class' => 'vision-section',
                'sort_id' => 2,
            ],
            [
                'name' => 'مهمتنا',
                'discription' => 'تقديم حلول عقارية متكاملة تلبي احتياجات عملائنا مع الحفاظ على الاستدامة.',
                'img' => 'about-3.jpg',
                'icon' => 'fas fa-bullseye',
                'class' => 'mission-section',
                'sort_id' => 3,
            ],
            [
                'name' => 'قيمنا',
                'discription' => 'الجودة، الشفافية، الابتكار، والالتزام تجاه عملائنا ومجتمعنا.',
                'img' => 'about-4.jpg',
                'icon' => 'fas fa-heart',
                'class' => 'values-section',
                'sort_id' => 4,
            ],
        ];

        foreach ($abouts as $about) {
            About::create($about);
        }
    }
}
