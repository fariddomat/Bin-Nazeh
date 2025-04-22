<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Term;

class TermsSeeder extends Seeder
{
    public function run()
    {
        Term::create([
            'content' => 'هذه الشروط والأحكام تحكم استخدامك لموقع بن نازح العقاري. من خلال الوصول إلى هذا الموقع، فإنك توافق على الالتزام بهذه الشروط. يحتفظ بن نازح بالحق في تعديل هذه الشروط في أي وقت دون إشعار مسبق. يُرجى مراجعة هذه الصفحة بشكل دوري للحصول على التحديثات.',
        ]);
    }
}
