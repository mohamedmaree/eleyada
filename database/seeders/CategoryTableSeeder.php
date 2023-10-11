<?php
namespace Database\Seeders;


use DB;
use Carbon\Carbon;
use App\Models\Category;
use Illuminate\Database\Seeder;

class CategoryTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // 1
        DB::table('categories')->insert([
            [   
                'id'                => 1,
                'name'              => json_encode(['en' => 'Track Your Monthly Period'  , 'ar' => 'تتبع الدورة الشهرية' ] , JSON_UNESCAPED_UNICODE) , 
                'image'             => 'category1.png',
                'created_at'        => Carbon::now()
            ],[
                'id'                => 2,
                'name'              => json_encode(['en' => 'Trying To Get Pregnant'  , 'ar' => 'احاول ان احمل'] , JSON_UNESCAPED_UNICODE) , 
                'image'             => 'category2.png',
                'created_at'        => Carbon::now()
            ],[
                'id'                => 3,
                'name'              => json_encode(['en' => 'Pregnancy Tracking'  , 'ar' => 'تتبع الحمل'] , JSON_UNESCAPED_UNICODE) , 
                'image'              => 'category3.png',
                'created_at'        => Carbon::now()
            ]
        ]);

    }
}
