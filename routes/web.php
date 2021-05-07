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

Route::any('/', function () {
    return view('auth.login');
});

Auth::routes(["register" => false]);
Route::any("/logout/user", "GlobalController@logout")->name("logout.user");



Route::prefix('home')->group(function () {
    Route::any('/', 'HomeController@index')->name('home');
    Route::prefix('matakuliah')->group(function () {
        Route::any('/', 'HomeController@mataKuliah')->name('home.matakuliah.index');
        Route::any('/action/{kondisi}', 'HomeController@mataKuliah')->name('home.matakuliah.save');
        Route::any('/action/{kondisi}/{id}', 'HomeController@mataKuliah')->name('home.matakuliah.action');
    });
    Route::prefix('perangkat-perkuliahan')->group(function () {
        Route::any('/', 'HomeController@inputData')->name('home.perangkat.index');
        Route::any('/action/{kondisi}/{id}', 'HomeController@inputData')->name('home.perangkat.action');
    });
    Route::prefix('admin')->group(function () {
        Route::any('/', 'AdminController@index')->name('home.admin.index');
        Route::prefix('new-account')->group(function () {
            Route::any('/', 'AdminController@dataAkun')->name('home.adminnew.account');
            Route::any('/action/{kondisi}', 'AdminController@dataAkun')->name('home.adminnew.account.save');
            Route::any('/action/{kondisi}/{id}', 'AdminController@dataAkun')->name('home.adminnew.action');
        });
        Route::prefix('data-semester')->group(function () {
            Route::any('/', 'AdminController@dataSemester')->name('home.admin.data.semester');
            Route::any('/action/{kondisi}', 'AdminController@dataSemester')->name('home.admin.data.semester.save');
            Route::any('/action/{kondisi}/{id}', 'AdminController@dataSemester')->name('home.admin.data.semester.action');
        });
        Route::prefix('perangkat-pembelajaran')->group(function () {
            Route::any('/', 'AdminController@perangkatPembelajaran')->name('home.admin.perangkat.pembelajaran');
            Route::any('/action/{kondisi}', 'AdminController@perangkatPembelajaran')->name('home.admin.perangkat.pembelajaran.save');
            Route::any('/action/{kondisi}/{id}', 'AdminController@perangkatPembelajaran')->name('home.admin.perangkat.pembelajaran.action');
        });
    });
    
});
