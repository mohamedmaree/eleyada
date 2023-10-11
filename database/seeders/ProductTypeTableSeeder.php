<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;

class ProductTypeTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product_types')->insert([
            [
                'name'              => json_encode(['en' => 'Capsules'  , 'ar' => "كبسولات"] , JSON_UNESCAPED_UNICODE) , 
            ] , [
                'name'              => json_encode(['en' => 'injections'  , 'ar' => "حقن"] , JSON_UNESCAPED_UNICODE) , 
            ],
        ]);
    }
}
