<?php

use App\Http\Controllers\PostController;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WebsiteController;
use Illuminate\Support\Facades\Route;


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



//Route::post('/websites', 'WebsiteController@store');
//Route::post('/users', 'UserController@store');
//Route::post('/websites/{website}/posts', 'PostController@store');
//Route::post('/websites/{website}/subscribe', 'SubscriptionController@subscribe');

Route::get("/", function (){
   return view('welcome');
});


Route::post('/websites', [WebsiteController::class, 'store']);
Route::post('/websites/{website}/posts', [PostController::class, 'store']);
Route::post('/websites/{website}/subscribe', [SubscriptionController::class, 'store']);
Route::post('/users', [UserController::class, 'store']);


//Route::post('/websites/{websiteId}/posts', [PostController::class, 'store']);
//Route::post('/websites/{websiteId}/subscribe', [SubscriptionController::class, 'subscribe']);
