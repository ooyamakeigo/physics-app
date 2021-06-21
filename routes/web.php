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


use App\Lecture;
use Illuminate\Http\Request;

//一覧表示
Route::get('/', 'LecturesController@index');

//新規登録画面
Route::get('/lecturesnew', 'LecturesController@new');

//登録処理
Route::post('/lectures','LecturesController@store');

//更新画面
Route::post('/lecturesedit/{lectures}','LecturesController@edit');

//更新処理
Route::post('/lectures/update','LecturesController@update');

//本を削除
Route::delete('/lecture/{lecture}','LecturesController@destroy');

//Auth
Auth::routes();
Route::get('/', 'LecturesController@index')->name('home');
