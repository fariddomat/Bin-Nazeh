<?php
namespace Database\Seeders;

use App\Models\About;
use Illuminate\Database\Seeder;

class AboutsSeeder extends Seeder
{
    public function run()
    {
        About::create([
            'name' => 'Who We Are',
            'discription' => 'بن نازح هي شركة رائدة في التطوير العقاري، تأسست لتقديم حلول مبتكرة ومستدامة تلبي تطلعات عملائنا. مع فريق من الخبراء، نحن ملتزمون بالجودة والتصميم العصري، نسعى للتميز ورضا العملاء.',
            'img' => null,
            'icon' => 'fas fa-building',
            'class' => null,
            'sort_id' => 1,
        ]);

        About::create([
            'name' => 'Mission',
            'discription' => 'نسعى لإعادة تعريف التطوير العقاري من خلال مشاريع مبتكرة ومستدامة تحسن جودة الحياة وتبني مجتمعات مزدهرة.',
            'img' => 'abouts/mission.jpg',
            'icon' => null,
            'class' => null,
            'sort_id' => 2,
        ]);

        About::create([
            'name' => 'Vision',
            'discription' => 'أن نكون الشركة الرائدة في التطوير العقاري، مع التركيز على الابتكار والاستدامة.',
            'img' => null,
            'icon' => 'fas fa-eye',
            'class' => 'value-card',
            'sort_id' => 3,
        ]);

        About::create([
            'name' => 'Success Standards',
            'discription' => 'تحقيق التميز من خلال الجودة العالية، التسليم في الوقت المحدد، ورضا العملاء.',
            'img' => null,
            'icon' => 'fas fa-star',
            'class' => 'value-card',
            'sort_id' => 4,
        ]);

        About::create([
            'name' => 'Values',
            'discription' => 'النزاهة، الابتكار، التعاون، والالتزام بالمسؤولية تجاه عملائنا ومجتمعنا.',
            'img' => null,
            'icon' => 'fas fa-heart',
            'class' => 'value-card',
            'sort_id' => 5,
        ]);

        About::create([
            'name' => 'Work Environment',
            'discription' => 'نحن نفخر بتوفير بيئة عمل داعمة تشجع على الإبداع والتعاون، مع التدريب المستمر وفرص التطور المهني.',
            'img' => 'abouts/work-environment.jpg',
            'class' => null,
            'sort_id' => 6,
        ]);

        About::create([
            'name' => 'Social Responsibility',
            'discription' => 'في بن نازح، نؤمن بأهمية رد الجميل للمجتمع. نسعى لدعم التعليم، حماية البيئة، وتحسين جودة الحياة في مجتمعاتنا.',
            'img' => null,
            'icon' => null,
            'class' => null,
            'sort_id' => 7,
        ]);
    }
}
