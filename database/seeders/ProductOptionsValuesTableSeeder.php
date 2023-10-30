<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB;
class ProductOptionsValuesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('product_options_values')->insert([
            [
                'product_option_id' => 1,
                'description'       => json_encode(['en' => 'It is an intrauterine device for birth control'  , 'ar' => 'هو جهاز داخل الرحم لتحديد النسل'] , JSON_UNESCAPED_UNICODE) , 
            ] ,
            [
                'product_option_id' => 1,
                'description'       => json_encode(['en' => 'Its shelf life is 5 years' , 'ar' => 'تبلغ مدة صلاحيتة ٥ سنوات'] , JSON_UNESCAPED_UNICODE) , 
            ] ,
            [
                'product_option_id' => 1,
                'description'       => json_encode(['en' => 'The device is for individual use only' , 'ar' => 'الجهاز للاستخدام الفردي فقط'] , JSON_UNESCAPED_UNICODE) , 
            ] ,
            
            [
                'product_option_id' => 2,
                'description'       => json_encode(['en' => 'The frame contains plastic wires' , 'ar' => 'يحتوي الاطار علي اسلاك بلاستيكية'] , JSON_UNESCAPED_UNICODE) , 
            ] ,
            [
                'product_option_id' => 2,
                'description'       => json_encode(['en' => 'The surface area is 180 cm' , 'ar' => 'تبلغ مساحة السطح ١٨٠ سم'] , JSON_UNESCAPED_UNICODE) , 
            ],

            [
                'product_option_id' => 3,
                'description'       => json_encode(['en' => 'Contains 50 packages' , 'ar' => 'يحتوي علي ٥٠ عبوة'] , JSON_UNESCAPED_UNICODE) , 
            ] ,
            [
                'product_option_id' => 3,
                'description'       => json_encode(['en' => 'insertion tube'  , 'ar' => 'انبوب ادخال'] , JSON_UNESCAPED_UNICODE) , 
            ] ,

            [
                'product_option_id' => 4,
                'description'       => json_encode(['en' => 'Before use check the packaging'  , 'ar' => 'قبل الاستخدام افحص العبوة'] , JSON_UNESCAPED_UNICODE) , 
            ] ,


            [
                'product_option_id' => 5,
                'description'       => json_encode(['en' => 'Malignant disease of the reproductive system' , 'ar' => 'مرض خبيث في الجهاز التناسلي'] , JSON_UNESCAPED_UNICODE) , 
            ] ,
            [
                'product_option_id' => 5,
                'description'       => json_encode(['en' => 'Undiagnosed vaginal bleeding' , 'ar' => 'نزيف مهبلي غير مشخص'] , JSON_UNESCAPED_UNICODE) , 
            ] ,

            [
                'product_option_id' => 6,
                'description'       => json_encode(['en' => 'Uterine abnormalities' , 'ar' => 'تشوهات الرحم'] , JSON_UNESCAPED_UNICODE) , 
            ] ,
            [
                'product_option_id' => 6,
                'description'       => json_encode(['en' => 'Allergy to copper' , 'ar' => 'حساسية من النحاس'] , JSON_UNESCAPED_UNICODE) , 
            ] ,

            [
                'product_option_id' => 7,
                'description'       => json_encode(['en' => 'Women who need a high-quality IUD' , 'ar' => 'النساء التي يحتجن اللولب عالي الجودة'] , JSON_UNESCAPED_UNICODE) , 
            ] ,
            [
                'product_option_id' => 7,
                'description'       => json_encode(['en' => 'The women we suffer from bleeding' , 'ar' => 'النساء التي يعانينا من النزيف'] , JSON_UNESCAPED_UNICODE) , 
            ] ,

            [
                'product_option_id' => 8,
                'description'       => json_encode(['en' => 'It is an intrauterine device for birth control'  , 'ar' => 'هو جهاز داخل الرحم لتحديد النسل'] , JSON_UNESCAPED_UNICODE) , 
            ] ,
            [
                'product_option_id' => 8,
                'description'       => json_encode(['en' => 'Its shelf life is 5 years' , 'ar' => 'تبلغ مدة صلاحيتة ٥ سنوات'] , JSON_UNESCAPED_UNICODE) , 
            ] ,
            [
                'product_option_id' => 8,
                'description'       => json_encode(['en' => 'The device is for individual use only' , 'ar' => 'الجهاز للاستخدام الفردي فقط'] , JSON_UNESCAPED_UNICODE) , 
            ] ,
            
            [
                'product_option_id' => 9,
                'description'       => json_encode(['en' => 'The frame contains plastic wires' , 'ar' => 'يحتوي الاطار علي اسلاك بلاستيكية'] , JSON_UNESCAPED_UNICODE) , 
            ] ,
            [
                'product_option_id' => 9,
                'description'       => json_encode(['en' => 'The surface area is 180 cm' , 'ar' => 'تبلغ مساحة السطح ١٨٠ سم'] , JSON_UNESCAPED_UNICODE) , 
            ],

            [
                'product_option_id' => 10,
                'description'       => json_encode(['en' => 'Contains 50 packages' , 'ar' => 'يحتوي علي ٥٠ عبوة'] , JSON_UNESCAPED_UNICODE) , 
            ] ,
            [
                'product_option_id' => 10,
                'description'       => json_encode(['en' => 'insertion tube'  , 'ar' => 'انبوب ادخال'] , JSON_UNESCAPED_UNICODE) , 
            ] ,

            [
                'product_option_id' => 11,
                'description'       => json_encode(['en' => 'Before use check the packaging'  , 'ar' => 'قبل الاستخدام افحص العبوة'] , JSON_UNESCAPED_UNICODE) , 
            ] ,


            [
                'product_option_id' => 12,
                'description'       => json_encode(['en' => 'Malignant disease of the reproductive system' , 'ar' => 'مرض خبيث في الجهاز التناسلي'] , JSON_UNESCAPED_UNICODE) , 
            ] ,
            [
                'product_option_id' => 12,
                'description'       => json_encode(['en' => 'Undiagnosed vaginal bleeding' , 'ar' => 'نزيف مهبلي غير مشخص'] , JSON_UNESCAPED_UNICODE) , 
            ] ,

            [
                'product_option_id' => 13,
                'description'       => json_encode(['en' => 'Uterine abnormalities' , 'ar' => 'تشوهات الرحم'] , JSON_UNESCAPED_UNICODE) , 
            ] ,
            [
                'product_option_id' => 13,
                'description'       => json_encode(['en' => 'Allergy to copper' , 'ar' => 'حساسية من النحاس'] , JSON_UNESCAPED_UNICODE) , 
            ] ,

            [
                'product_option_id' => 14,
                'description'       => json_encode(['en' => 'Women who need a high-quality IUD' , 'ar' => 'النساء التي يحتجن اللولب عالي الجودة'] , JSON_UNESCAPED_UNICODE) , 
            ] ,
            [
                'product_option_id' => 14,
                'description'       => json_encode(['en' => 'The women we suffer from bleeding' , 'ar' => 'النساء التي يعانينا من النزيف'] , JSON_UNESCAPED_UNICODE) , 
            ] ,

        ]);
    }
}
