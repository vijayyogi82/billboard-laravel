<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\OptionsController;
use App\Http\Controllers\WebController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('test', function () {
    return view('form');
});

Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('add-category', [OptionsController::class, 'AddCategoryView'])->middleware(['auth'])->name('addCategory');
Route::get('update-category-status/{id}/{status}', [OptionsController::class, 'updateCategoryStatus'])->middleware(['auth'])->name('updateCategoryStatus');
Route::get('update-category/{id}', [OptionsController::class, 'updateCategoryView'])->middleware(['auth'])->name('updateCategory');
Route::post('addCategoryLogic', [OptionsController::class, 'AddCategoryLogic'])->middleware(['auth'])->name('addCategoryLogic');
Route::get('category-list', [OptionsController::class, 'CategoryListView'])->middleware(['auth'])->name('addCategoryList');


Route::get('add-type', [OptionsController::class, 'AddTypeView'])->middleware(['auth'])->name('addType');
Route::get('update-type/{id}', [OptionsController::class, 'updateTypeView'])->middleware(['auth'])->name('updateType');
Route::post('addTypeLogic', [OptionsController::class, 'AddTypeLogic'])->middleware(['auth'])->name('addTypeLogic');
Route::get('type-list', [OptionsController::class, 'TypeListView'])->middleware(['auth'])->name('addTypeList');
Route::get('update-type-status/{id}/{status}', [OptionsController::class, 'updateTypeStatus'])->middleware(['auth'])->name('updateTypeStatus');

Route::get('add-sub-category', [OptionsController::class, 'AddSubCategoryView'])->middleware(['auth'])->name('addSubCategory');
Route::get('update-sub-category/{id}', [OptionsController::class, 'updateSubCategoryView'])->middleware(['auth'])->name('updateSubCategory');
Route::post('addSubCategoryLogic', [OptionsController::class, 'AddSubCategoryLogic'])->middleware(['auth'])->name('addSubCategoryLogic');
Route::get('sub-category-list', [OptionsController::class, 'SubCategoryListView'])->middleware(['auth'])->name('addSubCategoryList');
Route::get('update-sub-category-status/{id}/{status}', [OptionsController::class, 'updateSubCategoryStatus'])->middleware(['auth'])->name('updateSubCategoryStatus');

Route::get('add-location', [OptionsController::class, 'AddLocationView'])->middleware(['auth'])->name('addLocation');
Route::get('update-location/{id}', [OptionsController::class, 'updateLocationView'])->middleware(['auth'])->name('updateLocation');
Route::post('addLocationLogic', [OptionsController::class, 'AddLocationLogic'])->middleware(['auth'])->name('addLocationLogic');
Route::get('location-list', [OptionsController::class, 'LocationListView'])->middleware(['auth'])->name('addLocationList');
Route::get('update-location-status/{id}/{status}', [OptionsController::class, 'updateLocationStatus'])->middleware(['auth'])->name('updateLocationStatus');

require __DIR__.'/auth.php';


// Billboard Owner pages START

Route::get('/home', [WebController::class, 'home']);
Route::get('/login', [WebController::class, 'login']);
Route::get('/sub-login', [WebController::class, 'sub_login']);
Route::get('/sign-up-mediaowner', [WebController::class, 'sign_up_mediaowner']);
Route::get('/production-popup', [WebController::class, 'production_popup']);
Route::get('/sign-up-step2', [WebController::class, 'sign_up_step2']);
Route::get('/sign-up-step3', [WebController::class, 'sign_up_step3']);
Route::get('/sign-up-step4', [WebController::class, 'sign_up_step4']);
Route::get('/otp-mobile', [WebController::class, 'otp_mobile']);
Route::get('/otp-message', [WebController::class, 'otp_message']);
Route::get('/location-selection', [WebController::class, 'location_selection']);
Route::get('/location-map', [WebController::class, 'location_map']);
