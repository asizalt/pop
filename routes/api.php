<?php

use Illuminate\Http\Request;

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

//User Auth
Route::post('student-login', 'Api\Student\Auth\LoginController@login');
Route::post('student-register', 'Api\Student\Auth\RegisterController@register');

//Admin Auth
Route::post('teacher-login', 'Api\Teacher\Auth\LoginController@login');
Route::post('teacher-register', 'Api\Teacher\Auth\RegisterController@register');

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
