<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
//Route::middleware('auth_api')->get('/headings/{id}/users', 'App\Http\Controllers\api\v1\HeadingController@users');
//Route::middleware('auth_api')->get('/users/{id}/headings', 'App\Http\Controllers\api\v1\UserController@headings');

Route::group(['prefix' => 'v1', 'namespace' => 'App\Http\Controllers\api\v1'], function() {
    Route::apiResource('users', \App\Http\Controllers\api\v1\UserController::class);
    Route::apiResource('headingUsers', \App\Http\Controllers\api\v1\HeadingUserController::class);
    Route::apiResource('headings', \App\Http\Controllers\api\v1\HeadingController::class);
    Route::post('/users/{user_id}/headings/{heading_id}', 'App\Http\Controllers\api\v1\HeadingUserController@store');
    Route::delete('/users/{user_id}/headings/{heading_id}', 'App\Http\Controllers\api\v1\HeadingUserController@delete');
    Route::delete('/users/{user_id}/headings', 'App\Http\Controllers\api\v1\HeadingUserController@delete_all');
    Route::get('/headings/{id}/users', 'App\Http\Controllers\api\v1\HeadingController@users');
    Route::middleware('auth_api')->get('/headings/{id}/users', 'App\Http\Controllers\api\v1\HeadingController@users');
    Route::middleware('auth_api')->get('/users/{id}/headings', 'App\Http\Controllers\api\v1\UserController@headings');
});
