<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
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

Route::get('/',[\App\Http\Controllers\HomeController::class,'home']);
Route::get('login',[\App\Http\Controllers\HomeController::class,'login'])->middleware('guest')->name('login');
Route::post('login',[\App\Http\Controllers\HomeController::class,'postlogin']);
Route::get('register',[\App\Http\Controllers\HomeController::class,'register'])->middleware('guest');
Route::post('register',[\App\Http\Controllers\HomeController::class,'storeregister'])->middleware('guest');
Route::get('activation',[\App\Http\Controllers\HomeController::class,'mailactivation']);
Route::get('forgotpass',[\App\Http\Controllers\HomeController::class,'forgotpass']);

Route::group(['middleware'=>['auth']],function(){
    Route::get('success',[\App\Http\Controllers\HomeController::class,'success']);
    Route::get('logout',[\App\Http\Controllers\HomeController::class,'logout']);
    Route::get('dashboard',[\App\Http\Controllers\HomeController::class,'clientdashboard']);
    Route::get('admin/dashboard',[\App\Http\Controllers\HomeController::class,'admindashboard']);
    Route::get('profile',[\App\Http\Controllers\HomeController::class,'profile']);
    Route::get('admin/setting/category',[\App\Http\Controllers\HomeController::class,'category']);
    Route::get('admin/item',[\App\Http\Controllers\HomeController::class,'item']);
    Route::get('admin/request',[\App\Http\Controllers\HomeController::class,'userrequest']);
    Route::get('admin/setting/category/add',[\App\Http\Controllers\HomeController::class,'addcategory']);
    Route::get('admin/setting/category/{id}/delete',[\App\Http\Controllers\HomeController::class,'deletecategory']);
    Route::get('admin/item/add',[\App\Http\Controllers\HomeController::class,'additem']);
    Route::post('admin/item/add',[\App\Http\Controllers\HomeController::class,'storeitem']);
    Route::get('admin/item/{id}/view',[\App\Http\Controllers\HomeController::class,'reviewitem']);
    Route::get('admin/item/{id}/delete',[\App\Http\Controllers\HomeController::class,'deleteitem']);
    Route::get('admin/item/{id}/return',[\App\Http\Controllers\HomeController::class,'returnitem']);
    Route::get('clientreport',[\App\Http\Controllers\HomeController::class,'clientreport']);
    Route::get('clientreport/add',[\App\Http\Controllers\HomeController::class,'addreport']);
    Route::get('clientreport/{id}/view',[\App\Http\Controllers\HomeController::class,'reviewreport']);
    Route::get('clientreport/{id}/delete',[\App\Http\Controllers\HomeController::class,'deletereport']);
    Route::post('clientreport/add',[\App\Http\Controllers\HomeController::class,'storereport']);
    Route::get('lostitem',[\App\Http\Controllers\HomeController::class,'lostitem']);
    Route::get('lostitem/{id}/view',[\App\Http\Controllers\HomeController::class,'reviewlostitem']);
    Route::get('admin/request',[\App\Http\Controllers\HomeController::class,'adminrequest']);
    Route::get('clientrequest',[\App\Http\Controllers\HomeController::class,'clientrequest']);
//    Route::get('clientrequest/addclientrequest',[\App\Http\Controllers\HomeController::class,'addclientrequest']);
    Route::get('item/{id}/requestitem',[\App\Http\Controllers\HomeController::class,'requestitem']);
    Route::get('request/{id}/viewrequest',[\App\Http\Controllers\HomeController::class,'viewrequest']);
    Route::get('request/{id}/deleterequest',[\App\Http\Controllers\HomeController::class,'deleterequest']);
    Route::post('item/{id}/requestitem',[\App\Http\Controllers\HomeController::class,'storerequest']);
    
    Route::get('request/{id}/reviewrequest',[\App\Http\Controllers\HomeController::class,'reviewrequest']);
    Route::get('admin/checkuser',[\App\Http\Controllers\HomeController::class,'checkuser']);
    Route::get('user/{id}/delete',[\App\Http\Controllers\HomeController::class,'deleteuser']);
    Route::post('user/resetpassword',[\App\Http\Controllers\HomeController::class,'resetpassword']);
    Route::post('admin/changerole',[\App\Http\Controllers\HomeController::class,'changerole']);
    Route::get('admin/setting/location',[\App\Http\Controllers\HomeController::class,'location']);
    Route::get('admin/setting/location/{id}/delete',[\App\Http\Controllers\HomeController::class,'deletelocation']);

    Route::group(['prefix' => 'ajax'],function(){
        Route::post('modal-category',[\App\Http\Controllers\HomeController::class,'modalCategory']);
        Route::post('store-category',[\App\Http\Controllers\HomeController::class,'storeCategory']);
        Route::post('modal-location',[\App\Http\Controllers\HomeController::class,'modalLocation']);
        Route::post('store-location',[\App\Http\Controllers\HomeController::class,'storeLocation']);
        //Route::post('modal-profile',[\App\Http\Controllers\HomeController::class,'modalProfile']);
        Route::post('store-profile',[\App\Http\Controllers\HomeController::class,'storeProfile']);

        
    });
});




