<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
class ProductOptionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product_options')->insert([
            [
                'option_id' => 1,
                'product_id'        => 1,
            ] ,

            
            [
                'option_id' => 2,
                'product_id'        => 1,
            ] ,


            [
                'option_id' => 3,
                'product_id'        => 1,
            ] ,

            [
                'option_id' => 4,
                'product_id'    => 1,
            ] ,


            [
                'option_id' => 5,
                'product_id'        => 1,
            ] ,


            [
                'option_id' => 6,
                'product_id'        => 1,
            ] ,


            [
                'option_id' => 7,
                'product_id'        => 1,
            ] ,

            
            [
                'option_id' => 1,
                'product_id'        => 2,
            ] ,

            
            [
                'option_id' => 2,
                'product_id'        => 2,
            ] ,

            [
                'option_id' => 3,
                'product_id'        => 2,
            ] ,


            [
                'option_id' => 4,
                'product_id'        => 2,
            ] ,


            [
                'option_id' => 5,
                'product_id'        => 2,
            ] ,


            [
                'option_id' => 6,
                'product_id'        => 2,
            ] ,


            [
                'option_id' => 7,
                'product_id'        => 2,
            ] ,


        ]);
    }
}
