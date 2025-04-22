<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Slider;

class SlidersSeeder extends Seeder
{
    public function run()
    {
        $sliders = [
            [
                'title' => 'مرحبًا بك في بن نازح',
                'description' => 'اكتشف مشاريعنا العقارية الفاخرة في الرياض.',
                'img' => 'slider-1.jpg',
            ],
            [
                'title' => 'استثمر بذكاء',
                'description' => 'فرص استثمارية عقارية بأعلى العوائد.',
                'img' => 'slider-2.jpg',
            ],
            [
                'title' => 'عيش الفخامة',
                'description' => 'فلل وشقق مصممة لتلبي تطلعاتك.',
                'img' => 'slider-3.jpg',
            ],
        ];

        foreach ($sliders as $slider) {
            Slider::create($slider);
        }
    }
}
