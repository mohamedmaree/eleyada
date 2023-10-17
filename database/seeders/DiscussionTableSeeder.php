<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
class DiscussionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('discussions')->insert([
            [
                'title'         => json_encode(['en' => 'the most used reversible contracteptive '  , 'ar' => 'منع الحمل القابلة للعكس' ] , JSON_UNESCAPED_UNICODE) , 
                'topics'        => json_encode(['en' => 'Baby is comin soon'  , 'ar' => 'الطفل سيآتي قريبا' ] , JSON_UNESCAPED_UNICODE) ,
                'status'        => 'live' ,
                'speaker_name'  => 'mohamed' ,
                'discussion_link'          => 'https://zoom.com' ,
            ],
            [
                'title'         => json_encode(['en' => 'the most used reversible contracteptive '  , 'ar' => 'منع الحمل القابلة للعكس' ] , JSON_UNESCAPED_UNICODE) , 
                'topics'        => json_encode(['en' => 'Baby is comin soon'  , 'ar' => 'الطفل سيآتي قريبا' ] , JSON_UNESCAPED_UNICODE) ,
                'status'        => 'past' ,
                'speaker_name'  => 'ahmed ali' ,
                'discussion_link'          => 'https://zoom.com' ,
            ],
        ]);
    }
}
