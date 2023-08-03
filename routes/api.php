<?php

use App\Http\Controllers\Auth\RegisterController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;



/*
|--------------------------------------------------------------------------
| API Routes2
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('register/check', [RegisterController::class, 'check'])->name('api-register-check');

Route::get('provinces', 'App\Http\Controllers\API\LocationController@provinces')->name('api-provinces');
Route::get('regencies/{provinces_id}', 'App\Http\Controllers\API\LocationController@regencies')->name('api-regencies');


  