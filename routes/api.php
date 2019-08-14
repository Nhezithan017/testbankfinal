<?php

use Illuminate\Http\Request;
use App\Course;
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


Route::delete('/department/delete/{courses}','CourseController@removeDept');
Route::post('/department/add-dept', 'CourseController@addDept');
Route::get('/department/{courses}', 'CourseController@showDept');
Route::post('/department/{courses}', 'CourseController@updateDept');
Route::get('/department', 'CourseController@getDept');

Route::get('/question/{courses}','QuestionController@getQuestion');
Route::get('/show-question/{questions}', 'QuestionController@showQuestion');
Route::post('/add-question/{courseId}','QuestionController@addQuestion');
Route::post('/edit-question/{questions}','QuestionController@editQuestion');
Route::delete('/delete-question/{questions}','QuestionController@removeQuestion');
Route::get('/search','QuestionController@searchQue');
Route::post('/import-question/{courses}/{question}','QuestionController@addImport');
Route::get('/download/{courseId}','PDFController@downloadPDF');
Route::post('/add-user', 'AdminController@store');

Route::get('/trueorfalse/{courses}','TrueorfalseController@getTF');
Route::post('/trueorfalse/upsert/{courses}','TrueorfalseController@upsert');
Route::delete('/delete-tf/{tfId}','TrueorfalseController@removeTf');
Route::get('/search','TrueorfalseController@searchQue');
Route::post('/import-trueorfalse/{courses}/{trueorfalse}','TrueorfalseController@addImport');


Route::get('/matching-type/{courses}','MatchingtypeController@getMT');
Route::post('/matching-type/upsert/{courses}','MatchingtypeController@upsert');
Route::delete('/delete-mt/{mtId}','MatchingtypeController@remove');
Route::post('/import-matching-type/{courses}/{matchingtype}','MatchingtypeController@addImport');
