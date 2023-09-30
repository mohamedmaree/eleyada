<?php

namespace App\Http\Controllers\Api;
use App\Models\Fqs;
use App\Models\City;
use App\Models\Image;
use App\Models\Intro;
use App\Models\Order;
use App\Models\Social;
use App\Models\Country;

use App\Models\Category;
use App\Models\SiteSetting;
use App\Models\Region;
use App\Traits\ResponseTrait;
use App\Services\CouponService;
use App\Services\SettingService;
use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Coupon\checkCouponRequest;
use App\Http\Resources\Api\Settings\SocialResource;
use App\Http\Resources\Api\Settings\FqsResource;
use App\Http\Resources\Api\Settings\CityResource;
use App\Http\Resources\Api\Settings\ImageResource;
use App\Http\Resources\Api\Settings\IntroResource;
use App\Http\Resources\Api\Settings\CountryResource;
use App\Http\Resources\Api\Settings\CategoryResource;
use App\Http\Resources\Api\Settings\CountryWithCitiesResource;
use App\Http\Resources\Api\Settings\CountryWithRegionsResource;
use App\Http\Resources\Api\Settings\RegionResource;
use App\Http\Resources\Api\Settings\RegionWithCitiesResource;
use App\Models\Speciality;
use App\Models\AcademicDegree;
use App\Models\ProductType;
use App\Http\Resources\Api\Settings\SpecialityResource;
use App\Http\Resources\Api\Settings\AcademicDegreeResource;
use App\Http\Resources\Api\Settings\ProductTypeResource;

class SettingController extends Controller {
  use ResponseTrait;

  public function settings() {
    $data = SettingService::appInformations(SiteSetting::pluck('value', 'key'));
    return $this->successData($data);
  }

  public function locales() {
    $data = [
      [
          'name' => 'Arabic',
          'key' => 'ar'
      ], [
          'name' => 'English',
          'key' => 'en'
      ]
    ];
    return $this->successData($data);
  }

  public function about() {
    $about = SiteSetting::where(['key' => 'about_' . lang()])->first()->value;
    return $this->successData( $about);
  }

  public function terms() {
    $terms = SiteSetting::where(['key' => 'terms_' . lang()])->first()->value;
    return $this->successData( $terms);
  }

  public function privacy() {
    $privacy = SiteSetting::where(['key' => 'privacy_' . lang()])->first()->value;
    return $this->successData( $privacy);
  }

  public function intros() {
    $intros = IntroResource::collection(Intro::latest()->get());
    return $this->successData( $intros);
  }

  public function fqss() {
    $fqss = FqsResource::collection(Fqs::latest()->get());
    return $this->successData( $fqss);
  }

  public function socials() {
    $socials = SocialResource::collection(Social::latest()->get());
    return $this->successData( $socials);
  }

  public function images($id = null) {
    $images = ImageResource::collection(Image::latest()->get());
    return $this->successData( $images);
    //$images = ImageResource::collection(Image::paginate(1));
  }

  public function categories($id = null) {
    $categories = CategoryResource::collection(Category::where('parent_id', $id)->latest()->get());
    return $this->successData($categories);
  }

  public function countries() {
    $countries = CountryResource::collection(Country::latest()->get());
    return $this->successData( $countries);
  }

  public function specialities() {
    $specialities = SpecialityResource::collection(Speciality::latest()->get());
    return $this->successData( $specialities);
  }

  public function academicDegrees() {
    $academicDegrees = AcademicDegreeResource::collection(AcademicDegree::latest()->get());
    return $this->successData( $academicDegrees);
  }

  public function productTypes() {
    $ProductTypes = ProductTypeResource::collection(ProductType::latest()->get());
    return $this->successData( $ProductTypes);
  }

  public function cities() {
    $cities = CityResource::collection(City::latest()->get());
    return $this->successData( $cities);
  }

  public function regions() {
    $regions = RegionResource::collection(Region::latest()->get());
    return $this->successData( $regions);
  }

  public function regionCities($region_id) {
    $cities = CityResource::collection(City::where('region_id', $region_id)->latest()->get());
    return $this->successData($cities);
  }

  public function regionsWithCities() {
    $regions = RegionWithCitiesResource::collection(Region::with('cities')->latest()->get());
    return $this->successData($regions);
  }

  public function CountryCities($country_id) {
    $cities = CityResource::collection(City::where('country_id', $country_id)->latest()->get());
    return $this->successData( $cities);
  }

  public function CountryRegions($country_id) {
    $regions = RegionResource::collection(Region::where('country_id', $country_id)->latest()->get());
    return $this->successData( $regions);
  }

  public function countriesWithCities() {
    $countries = CountryWithCitiesResource::collection(Country::with('cities')->latest()->get());
    return $this->successData( $countries);
  }
  
  public function countriesWithRegions() {
    $countries = CountryWithRegionsResource::collection(Country::with('regions')->latest()->get());
    return $this->successData( $countries);
  }

  public function checkCoupon(checkCouponRequest $request)
  {
    $checkCouponRes = CouponService::checkCoupon( $request->coupon_num , $request->total_price) ;
    return $this->response($checkCouponRes['key'] , $checkCouponRes['msg'] , $checkCouponRes['data'] ?? null);
  }
  public function isProduction()
  {
    $isProduction = SiteSetting::where(['key' => 'is_production'])->first()->value;
    return $this->successData($isProduction);
  }
}
