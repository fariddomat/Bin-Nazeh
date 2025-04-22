<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\SocialMedia;

class SocialMediaSeeder extends Seeder
{
    public function run()
    {
        $socialMedia = [
            [
                'name' => 'تويتر',
                'link' => 'https://twitter.com/nazeh',
                'icon' => 'fab fa-twitter',
            ],
            [
                'name' => 'فيسبوك',
                'link' => 'https://facebook.com/nazeh',
                'icon' => 'fab fa-facebook',
            ],
            [
                'name' => 'إنستغرام',
                'link' => 'https://instagram.com/nazeh',
                'icon' => 'fab fa-instagram',
            ],
            [
                'name' => 'لينكدإن',
                'link' => 'https://linkedin.com/company/nazeh',
                'icon' => 'fab fa-linkedin',
            ],
            [
                'name' => 'يوتيوب',
                'link' => 'https://youtube.com/nazeh',
                'icon' => 'fab fa-youtube',
            ],
        ];

        foreach ($socialMedia as $media) {
            SocialMedia::create($media);
        }
    }
}
