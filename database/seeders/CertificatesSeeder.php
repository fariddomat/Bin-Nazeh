<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Certificate;
use Faker\Factory as Faker;

class CertificatesSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create('ar_SA');

        $certificates = [
            [
                'name' => 'شهادة الجودة ISO 9001',
                'img' => 'certificate-1.jpg',
            ],
            [
                'name' => 'جائزة التميز العقاري',
                'img' => 'certificate-2.jpg',
            ],
            [
                'name' => 'شهادة الاستدامة البيئية',
                'img' => 'certificate-3.jpg',
            ],
            [
                'name' => 'جائزة أفضل مطور عقاري',
                'img' => 'certificate-4.jpg',
            ],
            [
                'name' => 'شهادة السلامة المهنية',
                'img' => 'certificate-5.jpg',
            ],
        ];

        foreach ($certificates as $certificate) {
            Certificate::create($certificate);
        }
    }
}
