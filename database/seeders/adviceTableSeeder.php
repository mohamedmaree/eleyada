<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
class adviceTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('advice')->insert([
            [
                'name'      => json_encode(['en' => 'Baby is comin soon'  , 'ar' => 'الطفل سيآتي قريبا' ] , JSON_UNESCAPED_UNICODE) , 
                'content'      => json_encode(['en' => 'Baby is comin soon'  , 'ar' => 'الطفل سيآتي قريبا' ] , JSON_UNESCAPED_UNICODE) ,
            ],
            [
                'name'      => json_encode(['en' => 'Pregnancy in final stages'  , 'ar' => 'الحمل في المراحل النهائية' ] , JSON_UNESCAPED_UNICODE) , 
                'content'      => json_encode(['en' => 'Pregnancy in final stages' , 'ar' => 'الحمل في المراحل النهائية' ] , JSON_UNESCAPED_UNICODE) ,
            ],
        ]);
    }
}
