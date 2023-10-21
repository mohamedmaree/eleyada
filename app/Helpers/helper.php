<?php
use Illuminate\Support\Facades\App;

use App\Models\Seo;
use App\Models\SiteSetting;

function seo($key){
    return Seo::where('key' , $key)->first() ;
}

function appInformations(){
    $result = SiteSetting::pluck('value', 'key');
    return $result;
}


function convert2english( $string )
{
    $newNumbers = range( 0, 9 );
    $arabic     = array( '٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩' );
    $string     = str_replace( $arabic, $newNumbers, $string );
    return $string;
}

function fixPhone( $string = null )
{
    if(!$string){
      return null;
    }

    $result = convert2english($string);
    $result = ltrim($result, '00');
    $result = ltrim($result, '0');
    $result = ltrim($result, '+');
    return $result;
}

function Translate($text,$lang){

    $api  = 'trnsl.1.1.20190807T134850Z.8bb6a23ccc48e664.a19f759906f9bb12508c3f0db1c742f281aa8468';

    $url = file_get_contents('https://translate.yandex.net/api/v1.5/tr.json/translate?key='.$api
        .'&lang=ar' . '-' . $lang . '&text=' . urlencode($text));
    $json = json_decode($url);
    return $json->text[0];

}

function getYoutubeVideoId( $youtubeUrl )
{
    preg_match( "/^(?:http(?:s)?:\/\/)?(?:www\.)?(?:m\.)?(?:youtu\.be\/|youtube\.com\/(?:(?:watch)?\?(?:.*&)?v(?:i)?=|(?:embed|v|vi|user)\/))([^\?&\"'>]+)/",
        $youtubeUrl, $videoId );
    return $youtubeVideoId = isset( $videoId[ 1 ] ) ? $videoId[ 1 ] : "";
}

function toggleBooleanView($model, $url, $switch = 'is_active' , $open = 1 , $close = 0)
{

    return view('components.admin.toggle-boolean-view', compact('model', 'url', 'switch','open','close'))->render();
}
function toggleBoolean($model, $name = 'is_active' , $open = 1 , $close = 0)
{
    if ($model->$name == $open) {
        $model->$name = $close;
        $model->save();
        return true;
    } elseif($model->$name == $close) {
        $model->$name = $open;
        $model->save();
        return true;
    }else{
        $model->$name = $close;
        $model->save();
        return false;
    }

    return true;
}

function lang(){
    return App() -> getLocale();
}

function generateRandomCode(){
    return '1234';
    return rand(1111,4444);
}

if (!function_exists('languages')) {
  function languages() {
    $setting = SiteSetting::where(['key'=>'locales'])->get()->first()??[];
    return json_decode($setting->value??['ar', 'en']);
  }
}

if (!function_exists('defaultLang')) {
  function defaultLang() {
    return SiteSetting::where(['key'=>'default_locale'])->get()->first()->value??'ar';
  }
}

if (!function_exists("removeSlug")) {
    function removeSlug(string $value): string
    {
        return implode(" ",explode('_',$value));
    }
}

if (!function_exists("capitalize")) {
    function capitalize(string $value): string
    {
        $newPhrase="";
        foreach(explode(" ",$value) as $phrase){
            $newPhrase .= str($phrase)->ucfirst()." ";
        }
        return $newPhrase;
    }
}

function convertToHoursMins($num_minutes) {
    if ($num_minutes < 1) {
        return '00:00';
    }
    $hours   = floor($num_minutes / 60);
    $minutes = ($num_minutes % 60);
    $format = '%02d:%02d';
    return sprintf($format, $hours, $minutes);
  }

