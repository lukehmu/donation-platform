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

Route::get('/', function () {
    return view('donate');
});

Route::get('/{any}', function () {
    return view('donate');
});

Route::get('/admin/{any}', function () {
    return view('admin');
});

Auth::routes();

Route::resource('donations', 'DonationController');
