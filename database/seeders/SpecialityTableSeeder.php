<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
class SpecialityTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('specialities')->insert([
            [
                'name'              => json_encode(['en' => 'General Practice'  , 'ar' => "الطب العام"] , JSON_UNESCAPED_UNICODE) , 
            ] , [
                'name'              => json_encode(['en' => 'Cardiology'  , 'ar' => "القلبية"] , JSON_UNESCAPED_UNICODE) , 
            ],[
                'name'              => json_encode(['en' => 'Dermatology'  , 'ar' =>"الأمراض الجلدية"] , JSON_UNESCAPED_UNICODE) , 
            ],[
                'name'              => json_encode(['en' => 'Endocrinology'  , 'ar' =>  "الغدد الصماء" ] , JSON_UNESCAPED_UNICODE) , 
            ],[
                'name'              => json_encode(['en' => 'Gastroenterology'  , 'ar' => "الجهاز الهضمي" ] , JSON_UNESCAPED_UNICODE) , 
            ],[
                'name'              => json_encode(['en' => 'Hematology'  , 'ar' => "علم الأمراض الدموية" ] , JSON_UNESCAPED_UNICODE) , 
            ],[
                'name'              => json_encode(['en' => 'Infectious Diseases'  , 'ar' => "أمراض العدوى"] , JSON_UNESCAPED_UNICODE) , 
            ],[
                'name'              => json_encode(['en' => 'Neurology'  , 'ar' => "أمراض الأعصاب"] , JSON_UNESCAPED_UNICODE) , 
            ],[
                'name'              => json_encode(['en' => 'Obstetrics and Gynecology'  , 'ar' => "التوليد والنسائية" ] , JSON_UNESCAPED_UNICODE) , 
            ],[
                'name'              => json_encode(['en' => 'Ophthalmology'  , 'ar' =>  "العيون"] , JSON_UNESCAPED_UNICODE) , 
            ],[
                'name'              => json_encode(['en' => 'Orthopedics'  , 'ar' => "العظام" ] , JSON_UNESCAPED_UNICODE) , 
            ],[
                'name'              => json_encode(['en' => 'Otolaryngology (ENT)'  , 'ar' =>   "أمراض الأنف والأذن والحنجرة", ] , JSON_UNESCAPED_UNICODE) , 
            ],[
                'name'              => json_encode(['en' => 'Pediatrics'  , 'ar' => "الأطفال"] , JSON_UNESCAPED_UNICODE) , 
            ],[
                'name'              => json_encode(['en' => 'Psychiatry'  , 'ar' =>"النفسيات" ] , JSON_UNESCAPED_UNICODE) , 
            ],[
                'name'              => json_encode(['en' => 'Radiology'  , 'ar' =>  "الأشعة"] , JSON_UNESCAPED_UNICODE) , 
            ],[
                'name'              => json_encode(['en' => 'Surgery'  , 'ar' =>  "الجراحة" ] , JSON_UNESCAPED_UNICODE) , 
            ],[
                'name'              => json_encode(['en' => 'Urology'  , 'ar' =>   "المسالك البولية" ] , JSON_UNESCAPED_UNICODE) , 
            ],[
                'name'              => json_encode(['en' => 'Oncology'  , 'ar' =>  "علم الأورام" ] , JSON_UNESCAPED_UNICODE) , 
            ],[
                'name'              => json_encode(['en' => 'Nephrology'  , 'ar' => "أمراض الكلى" ] , JSON_UNESCAPED_UNICODE) , 
            ],[
                'name'              => json_encode(['en' => 'Rheumatology'  , 'ar' => "أمراض المفاصل والروماتيزم" ] , JSON_UNESCAPED_UNICODE) , 
            ],[
                'name'              => json_encode(['en' => 'Pulmonology'  , 'ar' => "أمراض الرئة" ] , JSON_UNESCAPED_UNICODE) , 
            ],[
                'name'              => json_encode(['en' => 'Anesthesiology'  , 'ar' =>  "التخدير" ] , JSON_UNESCAPED_UNICODE) , 
            ],[
                'name'              => json_encode(['en' => 'Emergency Medicine'  , 'ar' =>  "الطب الطارئ"] , JSON_UNESCAPED_UNICODE) , 
            ]
        ]);
    }
}
