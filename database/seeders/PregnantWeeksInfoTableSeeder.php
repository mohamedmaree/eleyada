<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
class PregnantWeeksInfoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $weeks = [];
        for ($i = 1; $i <= 40; $i++) {
          $weeks [] = [
            'order'        => $i,
            'name'         => json_encode(['en' => 'week '.$i  , 'ar' => 'الأسبوع '.$i] , JSON_UNESCAPED_UNICODE) , 
            'mother_info'  => json_encode(['en' => "Your baby's main task is to adapt to life outside the womb" , 'ar' => ' مهمة طفلك الاساسية هي التكيف مع الحياه خارج الرحم'] , JSON_UNESCAPED_UNICODE) , 
            'baby_info'    => json_encode(['en' => "Your baby's main task is to adapt to life outside the womb" , 'ar' => ' مهمة طفلك الاساسية هي التكيف مع الحياه خارج الرحم'] , JSON_UNESCAPED_UNICODE) , 
            'baby_weight'  => $i.' KG',
            'baby_height'  => $i.' CM',
            'image'        => 'week'.$i.'.png' , 
          ];
        }
    
        DB::table('pregnant_weeks_infos')->insert($weeks) ; 
    }
}
