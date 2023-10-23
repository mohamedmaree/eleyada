<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
class AvatarImagesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('avatar_images')->insert([
            [
                'image'          => '1.png' ,
            ] , [
                'image'          => '2.png' , 
            ],[
                'image'          => '3.png' , 
            ],[
                'image'          => '4.png' , 
            ],[
                'image'          => '5.png' ,
            ] , [
                'image'          => '6.png' , 
            ],[
                'image'          => '7.png' , 
            ],[
                'image'          => '8.png' , 
            ],[
                'image'          => '9.png' ,
            ] , [
                'image'          => '10.png' , 
            ],[
                'image'          => '11.png' , 
            ],[
                'image'          => '12.png' , 
            ],[
                'image'          => '13.png' ,
            ] , [
                'image'          => '14.png' , 
            ],[
                'image'          => '15.png' , 
            ]
        ]);
    }
}
