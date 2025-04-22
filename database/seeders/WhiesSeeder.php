<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Why;

class WhiesSeeder extends Seeder
{
    public function run()
    {
        $whies = [
            [
                'name' => 'الجودة العالية',
                'icon' => 'fas fa-star',
                'value' => 'نلتزم بتقديم مشاريع بأعلى معايير الجودة.',
            ],
            [
                'name' => 'الابتكار',
                'icon' => 'fas fa-lightbulb',
                'value' => 'نستخدم أحدث التقنيات والتصميمات المبتكرة.',
            ],
            [
                'name' => 'خدمة العملاء',
                'icon' => 'fas fa-headset',
                'value' => 'دعم عملاء متميز على مدار الساعة.',
            ],
            [
                'name' => 'الاستدامة',
                'icon' => 'fas fa-leaf',
                'value' => 'تصميمات صديقة للبيئة لمستقبل أفضل.',
            ],
            [
                'name' => 'الشفافية',
                'icon' => 'fas fa-handshake',
                'value' => 'معاملات واضحة وصادقة مع عملائنا.',
            ],
            [
                'name' => 'الخبرة',
                'icon' => 'fas fa-award',
                'value' => 'خبرة واسعة في السوق العقاري السعودي.',
            ],
        ];

        foreach ($whies as $whie) {
            Why::create($whie);
        }
    }
}
