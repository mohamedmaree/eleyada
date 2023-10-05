<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ChatController;
use App\Http\Controllers\Api\SettingController;
use App\Http\Controllers\Api\SettlementController;

use App\Http\Controllers\Api\DoctorController;
// use App\Http\Controllers\Api\PasswordController;
// use Illuminate\Http\Request;
// use Illuminate\Support\Facades\Route;
// use App\Http\Controllers\Auth\RegisterController;
// use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Api\SpecialityController;
use App\Http\Controllers\Api\CountryController;
use App\Http\Controllers\Api\CertificateController;
use App\Http\Controllers\Api\ClinicController;
// use App\Http\Controllers\Api\ChangePasswordController;
use App\Http\Controllers\Api\CartController;
use App\Http\Controllers\Api\OrderController;
use App\Http\Controllers\Api\ProductController;
use App\Http\Controllers\Api\TrainingController;
// use App\Http\Controllers\Api\LocaleController;
use App\Http\Controllers\Api\DiscussionController;
// use App\Http\Controllers\Api\ProductTypeController;
// use App\Http\Controllers\Api\AcademicDegreeController;
// use App\Http\Controllers\Api\GovernorateController;
use App\Http\Controllers\Api\HomeController;
// use App\Http\Controllers\Api\NotificationController;
// use App\Http\Controllers\Api\VerificationController;
use App\Http\Controllers\Api\QuestionsController;

use Illuminate\Support\Facades\Route;

Route::group([
    'namespace'  => 'Api',
    'middleware' => ['api-cors', 'api-lang'],
], function () {


    // Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    //     return $request->user();
    // });
    
    //Route::get('authenticate/{provider}', [AuthController::class, 'authenticate']);
    //Route::get('authenticate/callback', [AuthController::class, 'handleCallback']);
    
    Route::group(['prefix' => 'v1', 'middleware' => []], function () {
        Route::group(['middleware' => ['OptionalSanctumMiddleware']], function () {
            /***************************** SettingController start *****************************/
                Route::get('settings'                    ,[SettingController::class, 'settings']);
                Route::get('about'                       ,[SettingController::class, 'about']);
                Route::get('terms'                       ,[SettingController::class, 'terms']);
                Route::get('privacy'                     ,[SettingController::class, 'privacy']);
                Route::get('intros'                      ,[SettingController::class, 'intros']);
                Route::get('fqss'                        ,[SettingController::class, 'fqss']);
                Route::get('socials'                     ,[SettingController::class, 'socials']);
                Route::get('images'                      ,[SettingController::class, 'images']);
                Route::get('categories/{id?}'            ,[SettingController::class, 'categories']);
                Route::get('countries'                   ,[SettingController::class, 'countries']);
                Route::get('countries-with-cities'       ,[SettingController::class, 'countriesWithCities']);
                Route::get('countries-with-regions'      ,[SettingController::class, 'countriesWithRegions']);
                Route::get('regions'                     ,[SettingController::class, 'regions']);
                Route::get('cities'                      ,[SettingController::class, 'cities']);
                Route::get('region/{region_id}/cities'   ,[SettingController::class, 'regionCities']);
                Route::get('regions-with-cities'         ,[SettingController::class, 'regionsWithCities']);
                Route::get('country/{country_id}/cities' ,[SettingController::class, 'CountryCities']);
                Route::get('country/{country_id}/regions' ,[SettingController::class, 'CountryRegions']);
                Route::post('check-coupon'               ,[SettingController::class, 'checkCoupon']);
                Route::get('is-production'               ,[SettingController::class, 'isProduction']);
                Route::get('specialities'                ,[SettingController::class, 'specialities']);
                Route::get('specialities'                ,[SettingController::class, 'specialities']);
                Route::get('academic-degrees'            ,[SettingController::class, 'academicDegrees']);
                Route::get('product-types'               ,[SettingController::class, 'productTypes']);
                Route::get('locales'                     , [SettingController::class, 'locales']);

                /***************************** SettingController End *****************************/
        });
    
        Route::group(['middleware' => ['guest']], function () {
            /***************************** AuthController  Start *****************************/
                Route::post('sign-up'                      ,[AuthController::class, 'register']);
                Route::post('register/doctor'              ,[AuthController::class, 'doctorRegister']);
                Route::post('register/patient'             ,[AuthController::class, 'register']);
                Route::patch('activate'                    ,[AuthController::class, 'activate']);
                Route::patch('doctor-activate'             ,[AuthController::class, 'doctorActivate']);
                Route::get('resend-code'                   ,[AuthController::class, 'resendCode']);
                Route::get('doctor-resend-code'            ,[AuthController::class, 'doctorResendCode']);
                Route::post('sign-in'                      ,[AuthController::class, 'login']);
                Route::post('doctor-sign-in'               ,[AuthController::class, 'doctorLogin']);
                Route::delete('sign-out'                   ,[AuthController::class, 'logout']);
                Route::post('forget-password-send-code'    ,[AuthController::class, 'forgetPasswordSendCode']);
                Route::post('doctor-forget-password-send-code'    ,[AuthController::class, 'doctorForgetPasswordSendCode']);
                Route::post('reset-password'               ,[AuthController::class, 'resetPassword']);
                Route::post('doctor-reset-password'        ,[AuthController::class, 'doctorResetPassword']);
            /***************************** AuthController end *****************************/
        });
    
        Route::group(['middleware' => ['auth:sanctum', 'is-active']], function () {
            /***************************** AuthController  Start *****************************/
                Route::get('profile'                                  ,[AuthController::class,       'getProfile']);
                Route::put('update-profile'                           ,[AuthController::class,       'updateProfile']);
                Route::get('doctor-profile'                           ,[AuthController::class,       'getDoctorProfile']);
                Route::put('update-doctor-profile'                    ,[AuthController::class,       'updateDoctorProfile']);
                Route::patch('update-passward'                        ,[AuthController::class,       'updatePassword']);
                Route::patch('change-lang'                            ,[AuthController::class,       'changeLang']);
                Route::patch('switch-notify'                          ,[AuthController::class,       'switchNotificationStatus']);
                Route::post('change-phone-send-code'                  ,[AuthController::class        , 'changePhoneSendCode']);
                Route::post('change-phone-check-code'                 ,[AuthController::class        , 'changePhoneCheckCode']);
                Route::post('change-email-send-code'                  ,[AuthController::class        , 'changeEmailSendCode']);
                Route::post('change-email-check-code'                 ,[AuthController::class        , 'changeEmailCheckCode']);
                Route::get('notifications'                            ,[AuthController::class,       'getNotifications']);
                Route::get('count-notifications'                      ,[AuthController::class,       'countUnreadNotifications']);
                Route::delete('delete-notification/{notification_id}' ,[AuthController::class,       'deleteNotification']);
                Route::delete('delete-notifications'                  ,[AuthController::class,       'deleteNotifications']);
                Route::post('new-complaint'                           ,[AuthController::class,       'StoreComplaint']);
                Route::delete('delete-account'                        , [AuthController::class,  'deleteAccount']);
            /***************************** AuthController end *****************************/
            
            /***************************** SettlementController start *****************************/
                Route::post('settlement-request'                      ,[SettlementController::class, 'settlementRequest']);
            /***************************** SettlementController end *****************************/
    
            Route::get('country', [CountryController::class, 'show']);
            Route::get('speciality', [SpecialityController::class, 'show']);

            Route::get('public-questions'     , [QuestionsController::class, 'publicQuestions']);
            Route::get('category-questions/{category}'     , [QuestionsController::class, 'categoryQuestions']);
            Route::post('answer-question', [QuestionsController::class, 'answerQuestion']);


            /***************************** ChatController start *****************************/
                Route::get('create-room'                       ,[ChatController::class, 'createRoom']);
                Route::post('create-private-room'              ,[ChatController::class, 'createPrivateRoom']);
                Route::get('room-members/{room}'               ,[ChatController::class, 'getRoomMembers']);
                Route::get('join-room/{room}'                  ,[ChatController::class, 'joinRoom']);
                Route::get('leave-room/{room}'                 ,[ChatController::class, 'leaveRoom']);
                Route::get('get-room-messages/{room}'          ,[ChatController::class, 'getRoomMessages']);
                Route::get('get-room-unseen-messages/{room}'   ,[ChatController::class, 'getRoomUnseenMessages']);
                Route::get('get-rooms'                         ,[ChatController::class, 'getMyRooms']);
                Route::delete('delete-message-copy/{message}'  ,[ChatController::class, 'deleteMessageCopy']);
                Route::post('send-message/{room}'              ,[ChatController::class, 'sendMessage']);
                Route::post('upload-room-file/{room}'          ,[ChatController::class, 'uploadRoomFile']);
            /***************************** ChatController end *****************************/
        // });

    //     Route::post('login', [LoginController::class, 'login'])->name('auth.login');
        // Route::post('register/doctor', [RegisterController::class, 'registerAsDoctor'])->name('doctor-as-register');
    //     Route::post('register/patient', [RegisterController::class, 'registerAsPatient'])->name('patient-as-register');
    //     Route::get('locales', [LocaleController::class, 'index'])->name('locales.show');
    //     Route::get('countries', [CountryController::class, 'index'])->name('country.index');
    //     Route::get('specialities', [SpecialityController::class, 'index'])->name('specialities.index');
    //     Route::get('academic-degrees', [AcademicDegreeController::class, 'index'])->name('academicDegree.index');
    //     Route::post('forget-password', [PasswordController::class, 'forget'])->name('password.email');
    // })->middleware('guest');
    
    // Route::post('/verify', [VerificationController::class, 'verify'])
    //     ->middleware('auth:sanctum');
    
    // Route::post('v1/verify', [VerificationController::class, 'patientVerify'])
    // ->middleware('auth:sanctum');

    // Route::post('v1/verify/resent', [VerificationController::class, 'resent'])
    //     ->middleware('auth:sanctum')
    //     ->name('verification.verify.resent');
    
    // Route::group(['prefix' => 'v1', 'middleware' => ['auth:sanctum', 'is-active']], function () {
    
    //     //  user routes
    //     Route::get('logout', [LoginController::class, 'logout'])->name('logout');
    //     Route::put('user/change-password', [ChangePasswordController::class, 'update'])->name('password-change.update');
    
    // //    academic degrees
    
    //     //  doctor routes
    //     Route::post('doctor/update', [DoctorController::class, 'update'])->name('doctor.update');
    //     Route::delete('doctor', [DoctorController::class, 'destroy'])->name('doctor.delete');
        Route::get('doctors', [DoctorController::class, 'index'])->name('doctor.index');
        Route::get('doctors/{doctor}', [DoctorController::class, 'showDoctor'])->name('doctors.show');
    
    //     //  clinic routes
        Route::get('clinics', [ClinicController::class, 'index'])->name('clinic.index');
        Route::get('clinics/{clinic}', [ClinicController::class, 'show'])->name('clinic.show');
        Route::post('clinics', [ClinicController::class, 'store'])->name('clinic.store');
        Route::post('clinics/{clinic}/update', [ClinicController::class, 'update'])->name('clinic.update');
        Route::delete('clinics/{clinic}', [ClinicController::class, 'destroy'])->name('clinic.delete');
    
    //     //  doctor certificate
        Route::get('certificates', [CertificateController::class, 'index'])->name('certificate.index');
        Route::post('certificates', [CertificateController::class, 'store'])->name('certificate.store');
        Route::post('certificates/{certificate}/update', [CertificateController::class, 'update'])->name('certificate.update');
        Route::delete('certificates/{certificate}', [CertificateController::class, 'destroy'])->name('certificate.delete');
    
    //     //  doctor country
    
    //     //  doctor specialities
    
    // //    governorates
        // Route::get('governorates', [GovernorateController::class, 'index'])->name('governorates.index');
    
    //     //    cart
        Route::get('cart', [CartController::class, 'index']);
        Route::get('cart/products/{product}/add', [CartController::class, 'addToCart']);
        Route::get('cart/products/{product}/remove', [CartController::class, 'removeFromCart'])->name('cart.remove-from-cart');
    
    //     //    orders
        Route::get('orders', [OrderController::class, 'index'])->name('order.index');
        Route::post('place-order', [OrderController::class, 'placeOrder']);
        Route::get('orders/{order}/cancel', [OrderController::class, 'cancel'])->name('order.cancel');
        Route::get('orders/{order}', [OrderController::class, 'show'])->name('order.show');

    
    //     //    products
        Route::get('products', [ProductController::class, 'index']);
        Route::get('products/{product}', [ProductController::class, 'show'])->name('product.show');
    
    //     //    trainings
        Route::get('trainings/{training}', [TrainingController::class, 'show'])->name('training.show');
    
    //     //    discussion
        Route::get('discussions/{discussion}', [DiscussionController::class, 'show'])->name('discussion.show');
    //     //    Home
        Route::get('home/', [HomeController::class, 'show'])->name('Home.show');
    
    //     //  notifications
    // //    Route::get('home/{$id}', [NotificationController::class, 'markAsRead'])->name('Home.show');
    });
});
    
});
