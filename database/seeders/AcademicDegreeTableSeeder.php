<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
class AcademicDegreeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('academic_degrees')->insert([
            [
                'name'              => json_encode(['en' => 'MBBS'  , 'ar' => 'بكالوريوس الطب والجراحة'] , JSON_UNESCAPED_UNICODE) , 
            ] , [
                'name'              => json_encode(['en' => 'MD'  , 'ar' => "دكتوراه الطب"] , JSON_UNESCAPED_UNICODE) , 
            ],[
                'name'              => json_encode(['en' => 'PhD'  , 'ar' => "دكتوراه الفلسفة"] , JSON_UNESCAPED_UNICODE) , 
            ],[
                'name'              => json_encode(['en' => 'MS'  , 'ar' => "ماجستير الطب" ] , JSON_UNESCAPED_UNICODE) , 
            ],[
                'name'              => json_encode(['en' => 'MSc'  , 'ar' => "ماجستير العلوم" ] , JSON_UNESCAPED_UNICODE) , 
            ],[
                'name'              => json_encode(['en' => 'MCh'  , 'ar' => "ماجستير الجراحة" ] , JSON_UNESCAPED_UNICODE) , 
            ],[
                'name'              => json_encode(['en' => 'DSc'  , 'ar' => "دكتوراه العلوم" ] , JSON_UNESCAPED_UNICODE) , 
            ],[
                'name'              => json_encode(['en' => 'DPhil'  , 'ar' => "دكتوراه الفلسفة"] , JSON_UNESCAPED_UNICODE) , 
            ],[
                'name'              => json_encode(['en' => 'DO'  , 'ar' => "دكتوراه العمل الطبي" ] , JSON_UNESCAPED_UNICODE) , 
            ],[
                'name'              => json_encode(['en' => 'DDS'  , 'ar' => "دكتوراه طب الأسنان" ] , JSON_UNESCAPED_UNICODE) , 
            ],[
                'name'              => json_encode(['en' => 'DMD'  , 'ar' => "دكتوراه طب الأسنان" ] , JSON_UNESCAPED_UNICODE) , 
            ],[
                'name'              => json_encode(['en' => 'PharmD'  , 'ar' =>  "دكتوراه الصيدلة", ] , JSON_UNESCAPED_UNICODE) , 
            ],[
                'name'              => json_encode(['en' => 'DPT'  , 'ar' => "دكتوراه العلاج الطبيعي"] , JSON_UNESCAPED_UNICODE) , 
            ],[
                'name'              => json_encode(['en' => 'DC'  , 'ar' =>"دكتوراه الكيروبراكتيك" ] , JSON_UNESCAPED_UNICODE) , 
            ],[
                'name'              => json_encode(['en' => 'DVM'  , 'ar' =>  "دكتوراه الطب البيطري"] , JSON_UNESCAPED_UNICODE) , 
            ],[
                'name'              => json_encode(['en' => 'PsyD'  , 'ar' =>  "دكتوراه النفسية" ] , JSON_UNESCAPED_UNICODE) , 
            ],[
                'name'              => json_encode(['en' => 'EdD'  , 'ar' =>  "دكتوراه التعليم" ] , JSON_UNESCAPED_UNICODE) , 
            ]
        ]);
    }
}
