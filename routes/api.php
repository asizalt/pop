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

Route::post('student-register', 'Api\Student\RegisterController@registerStudent');
Route::post('teacher-register', 'Api\Teacher\RegisterController@registerTeacher');
//Admin Auth
Route::post('student-login', 'Api\Student\LoginController@loginStudent');
Route::post('teacher-login', 'Api\Teacher\LoginController@loginTeacher');




//Route::post('students-login', 'Api\Student\LoginController@loginStudent');

Route::group(['middleware' => ['multiauth:api,teacher'],'prefix' => 'teacher'], function () {

    Route::get('student/{period}', 'Api\Teacher\TeacherController@fetchStudentsByPeriod');
    Route::get('period', 'Api\Teacher\TeacherController@fetchTeacherPeriod');
    Route::get('period/students', 'Api\Teacher\TeacherController@studentsLinkTeachers');

});

Route::group(['middleware' => ['api', 'multiauth:student'],'prefix' => 'student'], function () {

    Route::get('/period/list-all', 'Api\Student\StudentController@listPeriods');
    Route::get('/period/list-registered', 'Api\Student\StudentController@listRegisteredPeriods');
    Route::post('/period/register', 'Api\Student\StudentController@RegisterToPeriod');
    Route::post('/period/unregister', 'Api\Student\StudentController@UnregisterFromPeriod');



});
