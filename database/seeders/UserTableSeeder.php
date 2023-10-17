<?php
namespace Database\Seeders;

use App\Models\User;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;
use DB ;
class UserTableSeeder extends Seeder {

  public function run() {

    $faker = Faker::create('ar_SA');
    $users = [];
    for ($i = 0; $i < 10; $i++) {
      $users [] = [
        'name'         => $faker->name,
        'phone'        => "51111111$i",
        'email'        => $faker->unique()->email,
        'password'     => bcrypt(123456),
        'is_blocked'      => rand(0, 1),
        'active'       => rand(0, 1),
        'category_id'   => rand(1, 3),
        'start_pregnant_date' => date('Y-m-d',strtotime('-15 days')),
        'period_date' => date('Y-m-d',strtotime('-15 days')),
      ];
    }

    DB::table('users')->insert($users) ; 
  }
}
