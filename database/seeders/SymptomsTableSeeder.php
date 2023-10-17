<?php
namespace Database\Seeders;


use DB;
use Illuminate\Database\Seeder;

class SymptomsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('symptoms')->insert([
            [   
                'id'                => 1,
                'name'              => json_encode(['en' => 'Symptoms'  , 'ar' => 'أعراض'] , JSON_UNESCAPED_UNICODE) , 
                'parent_id'         => null,
            ],[   
                'id'                => 2,
                'name'              => json_encode(['en' => 'Intercourse'  , 'ar' => 'الجماع'] , JSON_UNESCAPED_UNICODE) , 
                'parent_id'         => null,
            ],
            [   
                'id'                => 3,
                'name'              => json_encode(['en' => 'Mood'  , 'ar' => 'المزاج'] , JSON_UNESCAPED_UNICODE) , 
                'parent_id'         => null,
            ],[   
                'id'                => 4,
                'name'              => json_encode(['en' => 'Vaginal Discharge'  , 'ar' => 'إفرازات مهبلية'] , JSON_UNESCAPED_UNICODE) , 
                'parent_id'         => null,
            ],
        ]);

        DB::table('symptoms')->insert([
            [   
                'id'                => 5,
                'name'              => json_encode(['en' => 'vaginal itching'  , 'ar' => 'الحكة المهبلية'] , JSON_UNESCAPED_UNICODE) , 
                'parent_id'         => 1,
            ],
            [   
                'id'                => 6,
                'name'              => json_encode(['en' => 'headache'  , 'ar' => 'صداع'] , JSON_UNESCAPED_UNICODE) , 
                'parent_id'         => 1,
            ],
            
            [   
                'id'                => 7,
                'name'              => json_encode(['en' => 'didnt have intercourse'  , 'ar' => 'لم امارس الجنس'] , JSON_UNESCAPED_UNICODE) , 
                'parent_id'         => 2,
            ],
            [   
                'id'                => 8,
                'name'              => json_encode(['en' => 'low sex drive'  , 'ar' => 'انخفاض الرغبة الجنسي'] , JSON_UNESCAPED_UNICODE) , 
                'parent_id'         => 2,
            ],
            
            
            [   
                'id'                => 9,
                'name'              => json_encode(['en' => 'Sad'  , 'ar' => 'حزين'] , JSON_UNESCAPED_UNICODE) , 
                'parent_id'         => 3,
            ],
            [   
                'id'                => 10,
                'name'              => json_encode(['en' => 'mood swings'  , 'ar' => 'تقلب المزاج'] , JSON_UNESCAPED_UNICODE) , 
                'parent_id'         => 3,
            ],
            
            
            [   
                'id'                => 11,
                'name'              => json_encode(['en' => 'sticky '  , 'ar' => 'لزج'] , JSON_UNESCAPED_UNICODE) , 
                'parent_id'         => 4,
            ],[   
                'id'                => 12,
                'name'              => json_encode(['en' => 'watery '  , 'ar' => 'مائي'] , JSON_UNESCAPED_UNICODE) , 
                'parent_id'         => 4,
            ],
        ]);
    }
}
