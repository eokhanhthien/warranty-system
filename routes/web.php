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
    Route::resource('/businesses', 'superadmin\BusinessesController')->names([
        'index' => 'superadmin.businesses',
        'store' => 'superadmin.businesses.store',
        'show' => 'superadmin.businesses.show',
        'edit' => 'superadmin.businesses.edit',
        'update' => 'superadmin.businesses.update',
        'destroy' => 'superadmin.businesses.destroy',
    ]);
    Route::get('/team', 'superadmin\teamsController@index')->name('superadmin.team');
    // Các route khác trong nhóm "superadmin" nếu cần
});


Route::get('/address-options', 'SelectOptionsController@getAddressOptions')->name('address.options');
Route::get('/get-districts/{provinceId}', 'SelectOptionsController@getDistricts');
Route::get('/get-wards/{districtId}', 'SelectOptionsController@getWards');
Route::post('/validate-business', 'validateData@validateDatabusiness')->name('validate-business');

// Dịch ngôn ngữ
Route::get('setLocale/{locale}', function ($locale) {
    if (in_array($locale, Config::get('app.locales'))) {
      Session::put('locale', $locale);
    }
    return redirect()->back();
})->name('app.setLocale');
