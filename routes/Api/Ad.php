<?php

Route::get('/', 'AdController@index');
Route::post('/', 'AdController@store');
Route::get('/{ad}', 'AdController@show');