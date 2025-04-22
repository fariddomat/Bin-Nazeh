<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Counter;

class CountersSeeder extends Seeder
{
    public function run()
    {
        $counters = [
            [
                'name' => 'المشاريع المنجزة',
                'icon' => 'fas fa-building',
                'value' => '50+',
            ],
            [
                'name' => 'العملاء السعداء',
                'icon' => 'fas fa-users',
                'value' => '1000+',
            ],
            [
                'name' => 'سنوات الخبرة',
                'icon' => 'fas fa-briefcase',
                'value' => '15+',
            ],
            [
                'name' => 'الجوائز المحققة',
                'icon' => 'fas fa-trophy',
                'value' => '10+',
            ],
        ];

        foreach ($counters as $counter) {
            Counter::create($counter);
        }
    }
}
