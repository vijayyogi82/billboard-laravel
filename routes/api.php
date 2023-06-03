<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\UserController;
use App\Http\Controllers\API\CampaignController;
use App\Http\Controllers\API\FileManagerController;
use App\Http\Controllers\API\BillboardController;
use App\Http\Controllers\API\SettingController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::post('user', [UserController::class, 'registerUser']);
Route::post('login', [UserController::class, 'validateMobileOrEmail']);
Route::post('login-otp-verify', [UserController::class, 'verifyOtp']);
Route::post('send-register-otp', [UserController::class, 'sendOtp']);
Route::post('verify-register-otp', [UserController::class, 'verifyUserOtp']);
Route::post('register', [UserController::class, 'registerUser']);

Route::get('city', [SettingController::class, 'getCities']);
Route::get('state', [SettingController::class, 'getStates']);
Route::get('country', [SettingController::class, 'getCountries']);
Route::get('roles', [SettingController::class, 'getRoles']);

Route::group(['middleware' => ['jwt.verify']], function() {

    Route::group(['prefix' => 'file-manager'], function () {
        Route::post('upload', [FileManagerController::class, 'mobileUpload']);
        Route::delete('delete/{id}', [FileManagerController::class, 'delete'])->where(['id' => '[0-9]+']);
    });

    Route::put('user/profile/{user}', [UserController::class, 'UserProfile']);
    Route::get('user/profile/{user}', [UserController::class, 'getUserProfile']);

    Route::post('wishlist', [UserController::class, 'AddToWishList']);
    Route::get('wishlist', [UserController::class, 'getWishLists']);
    Route::delete('wishlist', [UserController::class, 'RemoveWishList']);

    Route::post('campaign', [CampaignController::class, 'createOrUpdateCampaign']);
    Route::put('campaign/{campaign}', [CampaignController::class, 'createOrUpdateCampaign'])->where(['campaign' => '[0-9]+']);
    Route::get('campaign', [CampaignController::class, 'getCampaigns']);
    Route::get('campaign/{campaign}', [CampaignController::class, 'getCampaign'])->where(['campaign' => '[0-9]+']);
    Route::post('campaign/{campaign}/brand', [CampaignController::class, 'createOrUpdateBrand'])->where(['campaign' => '[0-9]+', 'brand' => '[0-9]+']);
    Route::put('campaign/{campaign}/brand/{brand}', [CampaignController::class, 'createOrUpdateBrand'])->where(['campaign' => '[0-9]+', 'brand' => '[0-9]+']);

    Route::post('billboard', [BillboardController::class, 'createOrUpdateBillboard']);
    Route::put('billboard/{billboard}', [BillboardController::class, 'createOrUpdateBillboard'])->where(['billboard' => '[0-9]+']);
    Route::get('billboard', [BillboardController::class, 'getBillboards']);
    Route::get('billboard/{billboard}', [BillboardController::class, 'getBillboard'])->where(['billboard' => '[0-9]+']);
    Route::delete('billboard', [BillboardController::class, 'deleteBillboards']);

    Route::post('billboard/{billboard}/printing-service', [BillboardController::class, 'createOrUpdatePrintingService']);
    Route::put('billboard/{billboard}/printing-service/{printingservice}', [BillboardController::class, 'createOrUpdatePrintingService'])->where(['billboard' => '[0-9]+', 'printingservice' => '[0-9]+']);
    Route::get('billboard/printing-service/{printingservice}', [BillboardController::class, 'getPrintingServices'])->where(['billboard' => '[0-9]+', 'printingservice' => '[0-9]+']);
    Route::delete('billboard/printing-service', [BillboardController::class, 'deletePrintingServices']);

    Route::post('billboard/{billboard}/flighting-service', [BillboardController::class, 'createOrUpdateFlightingService']);
    Route::put('billboard/{billboard}/flighting-service/{flightingservice}', [BillboardController::class, 'createOrUpdateFlightingService'])->where(['billboard' => '[0-9]+', 'flightingservice' => '[0-9]+']);
    Route::get('billboard/flighting-service/{flightingservice}', [BillboardController::class, 'getFlightingServices'])->where(['billboard' => '[0-9]+', 'flightingservice' => '[0-9]+']);
    Route::delete('billboard/flighting-service', [BillboardController::class, 'deleteFlightingServices']);

    Route::post('campaign-billboard', [BillboardController::class, 'addBillboardToCampaign']);
    Route::post('billboard-availability', [BillboardController::class, 'getBillboardAvailability']);
    Route::delete('campaign-billboard/{id}', [BillboardController::class, 'removeBillboardFromCampaign'])->where(['id' => '[0-9]+', 'flightingservice' => '[0-9]+']);
});
