<?php

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
Route::post('/post', "App\Http\Controllers\TodoController@addTodo");
Route::post('/changestate', "App\Http\Controllers\TodoController@changeTodoState");
Route::post('/deleteTodo', "App\Http\Controllers\TodoController@deleteTodo");


Route::get('/',  "App\Http\Controllers\TodoController@show");
