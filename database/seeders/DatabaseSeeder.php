<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{

    public function run()
    {
        $this->call(SettingSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(PermissionTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call(DoctorTableSeeder::class);

        $this->call(IntroHowWorkTableSeeder::class);
        $this->call(IntroSliderTableSeeder::class);
        $this->call(IntroServiceTableSeeder::class);
        $this->call(IntroFqsCategoryTableSeeder::class);
        $this->call(IntroFqsTableSeeder::class);
        $this->call(IntroPartenerTableSeeder::class);
        $this->call(IntroSocialTableSeeder::class);
        $this->call(SocialTableSeeder::class);
        // $this->call(ComplaintTableSeeder::class);
        $this->call(CountryTableSeeder::class);
        $this->call(RegionTableSeeder::class);
        $this->call(CityTableSeeder::class);
        $this->call(FqsTableSeeder::class);
        $this->call(IntroTableSeeder::class);
        $this->call(ImageTableSeeder::class);
        $this->call(CouponTableSeeder::class);
        $this->call(SmsTableSeeder::class);
        // $this->call(NotificationSeeder::class);
        $this->call(CategoryTableSeeder::class);
        $this->call(AcademicDegreeTableSeeder::class);
        $this->call(SpecialityTableSeeder::class);
        $this->call(AnswersTableSeeder::class);
        $this->call(QuestionsTableSeeder::class);
        $this->call(ProductTypeTableSeeder::class);
        $this->call(ProductTableSeeder::class);
        $this->call(PregnantWeeksInfoTableSeeder::class);
        $this->call(adviceTableSeeder::class);
        $this->call(LiveVideoTableSeeder::class);
        $this->call(DiscussionTableSeeder::class);
        $this->call(SymptomsTableSeeder::class);
        $this->call(TrainingTableSeeder::class);
        $this->call(ClinicTableSeeder::class);
        $this->call(AvatarImagesTableSeeder::class);
        
        $this->call(OptionsTableSeeder::class);
        $this->call(ProductOptionsTableSeeder::class);
        $this->call(ProductOptionsValuesTableSeeder::class);
        
    }
}
