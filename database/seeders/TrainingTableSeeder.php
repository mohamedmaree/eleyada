<?php
namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class TrainingTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('trainings')->insert([
            [   
                'product_id'        => 1,
                'title'             => json_encode(['en' => 'first training'  , 'ar' => 'التدريب الاول'] , JSON_UNESCAPED_UNICODE) , 
                'is_paid'           => 0,
                'link_to_order'     => "http:://google.com",
            ],
            [   
                'product_id'        => 2,
                'title'             => json_encode(['en' => 'second training'  , 'ar' => 'التدريب التاني'] , JSON_UNESCAPED_UNICODE) , 
                'is_paid'           => 1,
                'link_to_order'     => "http:://google.com",
            ],
        ]);

    }
}
