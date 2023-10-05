<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
class AnswersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('answers')->insert([
            [
                'id' => 1,
                'question_id' => 5,
                'answer'      => json_encode(['en' => '-1 year'  , 'ar' => '-1 سنه' ] , JSON_UNESCAPED_UNICODE) , 
            ],[
                'id' => 2,
                'question_id' => 5,
                'answer'      => json_encode(['en' => '1 year'  , 'ar' => '1 سنه' ] , JSON_UNESCAPED_UNICODE) , 
            ],[
                'id' => 3,
                'question_id' => 5,
                'answer'      => json_encode(['en' => '2 year'  , 'ar' => '2 سنه' ] , JSON_UNESCAPED_UNICODE) , 
            ],[
                'id' => 4,
                'question_id' => 5,
                'answer'      => json_encode(['en' => '3 year'  , 'ar' => '3 سنين' ] , JSON_UNESCAPED_UNICODE) , 
            ],[
                'id' => 5,
                'question_id' => 5,
                'answer'      => json_encode(['en' => '4 year'  , 'ar' => '4 سنين' ] , JSON_UNESCAPED_UNICODE) , 
            ],[
                'id' => 6,
                'question_id' => 5,
                'answer'      => json_encode(['en' => '5 year'  , 'ar' => '5 سنين' ] , JSON_UNESCAPED_UNICODE) , 
            ],[
                'id' => 7,
                'question_id' => 5,
                'answer'      => json_encode(['en' => '+6 year'  , 'ar' => '+6 سنين' ] , JSON_UNESCAPED_UNICODE) , 
            ],
            
            [
                'id' => 8,
                'question_id' => 9,
                'answer'      => json_encode(['en' => 'Yes'  , 'ar' => 'نعم' ] , JSON_UNESCAPED_UNICODE) , 
            ],
            [
                'id' => 9,
                'question_id' => 9,
                'answer'      => json_encode(['en' => 'No'  , 'ar' => 'لا' ] , JSON_UNESCAPED_UNICODE) , 
            ],
            [
                'id' => 10,
                'question_id' => 11,
                'answer'      => json_encode(['en' => 'Yes'  , 'ar' => 'نعم' ] , JSON_UNESCAPED_UNICODE) , 
            ],

            [
                'id' => 11,
                'question_id' => 11,
                'answer'      => json_encode(['en' => 'No'  , 'ar' => 'لا' ] , JSON_UNESCAPED_UNICODE) , 
            ],

            [
                'id' => 12,
                'question_id' => 10,
                'answer'      => json_encode(['en' => 'IUD'  , 'ar' => 'لولب' ] , JSON_UNESCAPED_UNICODE) , 
            ],
            [
                'id' => 13,
                'question_id' => 10,
                'answer'      => json_encode(['en' => 'Pills'  , 'ar' => 'حبوب' ] , JSON_UNESCAPED_UNICODE) , 
            ],[
                'id' => 14,
                'question_id' => 10,
                'answer'      => json_encode(['en' => 'Condom'  , 'ar' => 'واق ذكري' ] , JSON_UNESCAPED_UNICODE) , 
            ],[
                'id' => 15,
                'question_id' => 10,
                'answer'      => json_encode(['en' => 'Vaginal Suppository'  , 'ar' => 'لبوس منع حمل مهبلي' ] , JSON_UNESCAPED_UNICODE) , 
            ],[
                'id' => 16,
                'question_id' => 10,
                'answer'      => json_encode(['en' => 'Injection'  , 'ar' => 'حقن' ] , JSON_UNESCAPED_UNICODE) , 
            ],[
                'id' => 17,
                'question_id' => 10,
                'answer'      => json_encode(['en' => 'Implant'  , 'ar' => 'تركيب' ] , JSON_UNESCAPED_UNICODE) , 
            ],[
                'id' => 18,
                'question_id' => 10,
                'answer'      => json_encode(['en' => 'Calendar'  , 'ar' => 'التقويم' ] , JSON_UNESCAPED_UNICODE) , 
            ]
            
        ]);
    }
}
