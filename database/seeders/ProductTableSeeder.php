<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class ProductTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('products')->insert([
            [
                'name'              => json_encode(['en' => 'Capsules'  , 'ar' => "كبسولات"] , JSON_UNESCAPED_UNICODE) , 
                'price'             => 100,
                'video'             => 'https://www.youtube.com/watch?v=krDWc30PAGg&ab_channel=H%E1%BB%93ngH%E1%BA%A3i',
                'product_type_id'   => 1,
                ] , [
                'name'              => json_encode(['en' => 'injections'  , 'ar' => "حقن"] , JSON_UNESCAPED_UNICODE) , 
                'price'             => 200,
                'video'             => 'https://www.youtube.com/watch?v=krDWc30PAGg&ab_channel=H%E1%BB%93ngH%E1%BA%A3i',
                'product_type_id'   => 2,
            ],
        ]);
    }
}
