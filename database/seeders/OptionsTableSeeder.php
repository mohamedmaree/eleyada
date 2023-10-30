<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
class OptionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('options')->insert([
            [
                'name'              => json_encode(['en' => 'Professional information'  , 'ar' => 'المعلومات المهنية'] , JSON_UNESCAPED_UNICODE) , 
            ] , [
                'name'              => json_encode(['en' => 'Product'  , 'ar' => "المنتج"] , JSON_UNESCAPED_UNICODE) , 
            ],[
                'name'              => json_encode(['en' => 'Package'  , 'ar' => "حزمة"] , JSON_UNESCAPED_UNICODE) , 
            ],[
                'name'              => json_encode(['en' => 'Warnings'  , 'ar' => "تحذيرات" ] , JSON_UNESCAPED_UNICODE) , 
            ],[
                'name'              => json_encode(['en' => 'Contraindications (absolute)'  , 'ar' => "موانع الاستعمال (المطلقة)" ] , JSON_UNESCAPED_UNICODE) , 
            ],[
                'name'              => json_encode(['en' => 'Contraindications (relative)'  , 'ar' => "موانع الاستعمال (نسبي)" ] , JSON_UNESCAPED_UNICODE) , 
            ],[
                'name'              => json_encode(['en' => 'for whom?'  , 'ar' => "لمن؟" ] , JSON_UNESCAPED_UNICODE) , 
            ]
        ]);
    }
}
