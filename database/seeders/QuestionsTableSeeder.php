<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
class QuestionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('questions')->insert([
            [
                'id' => 1,
                'parent_answer_id' => 0,
                'category_id' => 0,
                'question'    => json_encode(['en' => 'What is you weight in kilograms?'  , 'ar' => 'ماهو وزنك بالكيلو جرام؟'] , JSON_UNESCAPED_UNICODE) , 
                'type'        => 'text',
                'image'       => '',
            ],[
                'id' => 2,
                'parent_answer_id' => 0,
                'category_id' => 0,
                'question'    => json_encode(['en' => 'What is you height in centimeters?'  , 'ar' => 'ماهو طولك بالسنتي متر؟'] , JSON_UNESCAPED_UNICODE) , 
                'type'        => 'text',
                'image'       => '',
            ],[
                'id' => 3,
                'parent_answer_id' => 0,
                'category_id' => 0,
                'question'    => json_encode(['en' => 'What is the length of the monthly period?'  , 'ar' => '؟ماهو طول فترة الدورة الشهرية؟'] , JSON_UNESCAPED_UNICODE) , 
                'type'        => 'text',
                'image'       => '',
            ],[
                'id' => 4,
                'parent_answer_id' => 0,
                'category_id' => 0,
                'question'    => json_encode(['en' => 'What is the length of menstruation?'  , 'ar' => 'ماهو طول فترة الحيض؟'] , JSON_UNESCAPED_UNICODE) , 
                'type'        => 'text',
                'image'       => '',
            ],
            [
                'id' => 5,
                'parent_answer_id' => 0,
                'category_id' => 2,
                'question'    => json_encode(['en' => 'How long have you been trying to conceive?'  , 'ar' => 'منذ متي وانت تحاولين الحمل؟'] , JSON_UNESCAPED_UNICODE) , 
                'type'        => 'select',
                'image'       => '1.png',
            ],
            [
                'id' => 6,
                'parent_answer_id' => 0,
                'category_id' => 2,
                'question'    => json_encode(['en' => 'Do you take any medications?'  , 'ar' => 'هل تآخذي اي أدوية؟'] , JSON_UNESCAPED_UNICODE) , 
                'type'        => 'text',
                'image'       => '',
            ],
            [
                'id' => 7,
                'parent_answer_id' => 0,
                'category_id' => 3,
                'question'    => json_encode(['en' => 'What week of pregnancy are you in?'  , 'ar' => 'في آي اسبوع من الحمل آنتي الان؟'] , JSON_UNESCAPED_UNICODE) , 
                'type'        => 'text',
                'image'       => '2.png',
            ],
            [
                'id' => 8,
                'parent_answer_id' => 0,
                'category_id' => 3,
                'question'    => json_encode(['en' => 'What day of the week are you now on?'  , 'ar' => 'في آي يوم من ايام الاسبوع آنتي الان؟'] , JSON_UNESCAPED_UNICODE) , 
                'type'        => 'text',
                'image'       => '',
            ],
            //level 1
            [
                'id' => 9,
                'parent_answer_id' => 0,
                'category_id' => 1,
                'question'    => json_encode(['en' => 'Do you use contraceptive methods?'  , 'ar' => 'هل تستخدمين وسائل منع الحمل؟'] , JSON_UNESCAPED_UNICODE) , 
                'type'        => 'radio',
                'image'       => '3.png',
            ],
            //level 2
            [
                'id' => 10,
                'parent_answer_id' => 8,//ensert here answer id of 'yes' in question 9
                'category_id' => 1,
                'question'    => json_encode(['en' => 'Waht Do you use as contraceptive methods?'  , 'ar' => 'ما الذي تستخدمينة كوسيلة لمنع الحمل؟'] , JSON_UNESCAPED_UNICODE) , 
                'type'        => 'select_in_same_page',
                'image'       => '4.png',
            ],
            //level 2
            [
                'id' => 11,
                'parent_answer_id' => 9,//ensert here answer id of 'no' in question 9
                'category_id' => 1,
                'question'    => json_encode(['en' => 'Do you breastfeeding?'  , 'ar' => 'هل تقومين بعملية الرضاعة؟'] , JSON_UNESCAPED_UNICODE) , 
                'type'        => 'radio',
                'image'       => '5.png',
            ],
            //level 3
            [
                'id' => 12,
                'parent_answer_id' => 12,//ensert here answer id of 'first select' in question 10
                'category_id' => 1,
                'question'    => json_encode(['en' => 'Date of insertation?'  , 'ar' => 'تاريخ الادراج'] , JSON_UNESCAPED_UNICODE) , 
                'type'        => 'date',
                'image'       => '',
            ], [
                'id' => 13,
                'parent_answer_id' => 13,//ensert here answer id of 'second select' in question 10
                'category_id' => 1,
                'question'    => json_encode(['en' => 'When do you take your pill?'  , 'ar' => ' متي تآخذي حبوب منع الحمل الخاصة بيك؟'] , JSON_UNESCAPED_UNICODE) , 
                'type'        => 'date',
                'image'       => '',
            ],[
                'id' => 14,
                'parent_answer_id' => 16,//ensert here answer id of '5 select' in question 10
                'category_id' => 1,
                'question'    => json_encode(['en' => 'When did you take the injection?'  , 'ar' => ' متي آخذت الحقنة؟'] , JSON_UNESCAPED_UNICODE) , 
                'type'        => 'date',
                'image'       => '',
            ]

        ]);
    }
}
