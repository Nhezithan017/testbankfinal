<?php

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



Auth::routes(['verify' => true]);

Route::get('/', 'HomeController@index')->name('home');

Route::middleware(['auth','verified'])->group(function() {

    #CREATING,EDITING AND DELETING DEPARTMENT
      Route::get('/course','CourseController@index');
  
      Route::delete('course/delete/{courses}','CourseController@destroy');
  
      Route::get('/create/course','CourseController@create');
  
      Route::post('/create/course','CourseController@store');
  
      Route::get('/edit/course/{courses}','CourseController@edit');
  
      Route::patch('/edit/course/{courses}','CourseController@update');
  
   #CREATING,EDITING AND DELETING QUESTIONS
   Route::get('/question/{courses}','QuestionController@index');
  
   Route::get('/edit/question/{questions}','QuestionController@edit');
  
   Route::patch('/edit/question/{questions}','QuestionController@update');
  
   Route::get('/create/question/{courseId}','QuestionController@create');
  
   Route::post('/create/question/{courses}','QuestionController@store');
  
   Route::delete('delete/question/{questions}','QuestionController@destroy');
   Route::get('/faculty-tests','AdminController@facultyTest')->name('faculty.test');
   Route::get('/tests/pdfexport/{id}','PDFController@downloadPDF');
   Route::middleware('can:view')->group(function() {
   Route::get('/users','AdminController@index')->name('user');
   Route::get('/create/user','AdminController@create')->name('admin.create');
   Route::post('/create/user','AdminController@store')->name('admin.store');
   Route::get('/edit/user/{user}','AdminController@edit')->name('admin.edit');;
   Route::post('/edit/user/{user}','AdminController@update')->name('admin.update');
   Route::delete('/delete/user/{user}','AdminController@destroy')->name('admin.delete');

   Route::get('/tests','AdminController@viewTest')->name('test');
   Route::delete('/tests/delete/{courses}','AdminController@deleteImport')->name('import.delete');
   Route::delete('/delete/courses/{courses}','AdminController@destroy');
 
   Route::get('/search/{courses}','QuestionController@searchQuestion');
   Route::get('/search/question/{courseId}/{courses}','QuestionController@importQuestion');
   Route::post('/search/question/{courses}','QuestionController@createQuestion');
  });
  Route::get('/dept-editor/{any?}','CourseController@dept')->where('any','.*')->name('show.department');
  // Route::get('/question-editor/{any?}','QuestionController@ques')->where('any','.*');
  });