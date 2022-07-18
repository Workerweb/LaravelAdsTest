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

Route::get('/', function () {
    return view('ad.index');
});
Route::get('/ad/create', function () {
    return view('ad.form');
});
Route::get('/ad/{ad}', function () {
    return view('ad.show');
});
