<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Redirect;
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

Route::get('/', function () {
    return view('login');
});






// Route::resource('student',StudentController::class);
Route::get('main', 'MainController@index');
Route::post('main/checklogin', 'MainController@checklogin');
Route::get('main/successlogin', 'MainController@successlogin');
Route::get('main/logout', 'MainController@logout');
Route::get('main/homepage', 'MainController@homepage');
Route::get('main/dashboard', 'MainController@dashboard');
Route::get('main/students', 'MainController@students');
Route::get('main/teachers', 'MainController@teachers');
Route::get('main/subjects', 'MainController@subjects');
Route::get('main/users', 'MainController@users');
Route::get('main/gradings', 'MainController@gradings');

Route::get('main/count_student', 'MainController@count_student');
Route::get('main/count_teacher', 'MainController@count_teacher');
Route::get('main/count_user', 'MainController@count_user');
Route::get('main/count_subject', 'MainController@count_subject');



Route::post('/students/store', 'StudentController@store');
Route::post('/students/update', 'StudentController@update');
Route::post('/students/destroy/{id}','StudentController@destroy');



//use this for controller with params {{action('StudentController@destroy',$students->id)}}



Route::get('/dashboard/navigation','DashboardController@navigation');
Route::post('/teacher/insert_teacher','teacherController@insert_teacher');
Route::get('/teacher','teacherController@index');
Route::post('/teachers/update', 'teacherController@update');
Route::post('/teachers/destroy/{id}','teacherController@destroy');
Route::post('/subjects/insert_subject','SubjectController@insert_subject');
Route::post('/subjects/update','SubjectController@update');
Route::post('/subjects/destroy/{id}','SubjectController@destroy');

Route::post('/user/insert','UserController@insert');
Route::post('/user/update','UserController@update');
Route::post('/user/destroy/{id}','UserController@destroy');

Route::post('/grade_inputs/{id}','GradesController@populate_grades_bysubject');
Route::post('selected-subjects', 'GradesController@insert_selected_subjects')->name('insert_selected');
Route::post('view_grades', 'GradesController@get_student_grades')->name('populate_grades');
Route::post('update_grades', 'GradesController@update_grades')->name('update_grades');

Route::get('/redirect-to-previous-url', function(){
    return Redirect::to(url()->previous());
});

Auth::routes();


