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
    return view('welcome');
});

Route::prefix('superadmin')->group(function () {
    Route::get('/dashboard', function ()  { return view('superadmin.index');})->name('superadmin.dashboard');
    Route::get('/businesses', function () { return view('superadmin.businesses.index');})->name('superadmin.businesses');

    // Các route khác trong nhóm "superadmin" nếu cần
});


Route::get('setLocale/{locale}', function ($locale) {
    if (in_array($locale, Config::get('app.locales'))) {
      Session::put('locale', $locale);
    }
    return redirect()->back();
})->name('app.setLocale');
