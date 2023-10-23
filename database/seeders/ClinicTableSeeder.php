<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
class ClinicTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('clinics')->insert([
            [
                'name'            => 'clinic 1' , 
                'booking_link'    => 'https://www.google.com' ,
                'doctor_id'       => 1 ,
                'location_link'   => 'https://www.google.com/maps' ,
                'address'         => 'ali street' ,
                'lat'             => '30.123456' ,
                'lng'             => '30.123456' ,
            ],
            [
                'name'            => 'clinic 2' , 
                'booking_link'    => 'https://www.google.com' ,
                'doctor_id'       => 1 ,
                'location_link'   => 'https://www.google.com/maps' ,
                'address'         => 'ali street' ,
                'lat'             => '30.123456' ,
                'lng'             => '30.123456' ,
            ],            [
                'name'            => 'clinic 3' , 
                'booking_link'    => 'https://www.google.com' ,
                'doctor_id'       => 2 ,
                'location_link'   => 'https://www.google.com/maps' ,
                'address'         => 'ali street' ,
                'lat'             => '30.123456' ,
                'lng'             => '30.123456' ,
            ],
            [
                'name'            => 'clinic 4' , 
                'booking_link'    => 'https://www.google.com' ,
                'doctor_id'       => 2 ,
                'location_link'   => 'https://www.google.com/maps' ,
                'address'         => 'ali street' ,
                'lat'             => '30.123456' ,
                'lng'             => '30.123456' ,
            ],[
                'name'            => 'clinic 5' , 
                'booking_link'    => 'https://www.google.com' ,
                'doctor_id'       => 3 ,
                'location_link'   => 'https://www.google.com/maps' ,
                'address'         => 'ali street' ,
                'lat'             => '30.123456' ,
                'lng'             => '30.123456' ,
            ],
        ]);
    }
}
