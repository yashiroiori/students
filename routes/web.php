<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\PhotoController;

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
Route::get('/', function(){
    return redirect()->route('student.index');
});
Route::resource('student', StudentController::class)
    ->missing(function (Request $request) {
        return Redirect::route('student.index');
    });
Route::resource('lesson', LessonController::class)
    ->missing(function (Request $request) {
        return Redirect::route('lesson.index');
    });
Route::get('/studentLesson', 'StudentLessonController@index')->name('student.lesson.index');
Route::post('/studentLesson', 'StudentLessonController@store')->name('student.lesson.store');