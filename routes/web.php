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

Route::get('/', function () { return view('welcome'); }); 
Route::get('/dashboard', function ()  { return view('dashboard');})->name('dashboard')->middleware('auth');
Route::get('/not-found', function () { return view('error.index');});

// Auth
Route::get('/login', 'Auth\AuthController@index')->name('login')->middleware('no_auth');
Route::get('/register', 'Auth\AuthController@register')->name('register')->middleware('no_auth');
Route::post('/auth-login', 'Auth\AuthController@authLogin')->name('auth.login');
Route::get('/logout', 'Auth\AuthController@logout')->name('logout');


Route::prefix('superadmin')->middleware((['auth', 'superadmin']))->group(function () {
   
    Route::resource('/businesses', 'superadmin\BusinessesController')->names([
        'index' => 'superadmin.businesses',
        'store' => 'superadmin.businesses.store',
        'edit' => 'superadmin.businesses.edit',
    ]);
    Route::post('/businesses/{id}/update', 'superadmin\BusinessesController@update')->name('superadmin.businesses.update');
    Route::delete('/businesses/{id}/delete', 'superadmin\BusinessesController@destroy')->name('superadmin.businesses.destroy');

    Route::resource('/team', 'superadmin\teamsController')->names([
        'index' => 'superadmin.team',
        'store' => 'superadmin.team.store',
        'edit' => 'superadmin.team.edit',
    ]);
    Route::post('/team/{id}/update', 'superadmin\teamsController@update')->name('superadmin.team.update');
    Route::delete('/team/{id}/delete', 'superadmin\teamsController@destroy')->name('superadmin.team.destroy');

    // Các route khác trong nhóm "superadmin" nếu cần
});

Route::prefix('admin')->middleware('admin')->group(function () {
    Route::get('/dashboard', function () {
        // Logic xử lý cho trang dashboard của Admin
    })->name('admin.dashboard');

    // Các Route khác cho Admin
});

// Route::prefix('user')->middleware('user')->group(function () {
//     Route::get('/dashboard', function () {
//         // Logic xử lý cho trang dashboard của User
//     })->name('user.dashboard');
//     // Các Route khác cho User
// });

// Chọn địa chỉ
Route::get('/address-options', 'SelectOptionsController@getAddressOptions')->name('address.options');
Route::get('/get-districts/{provinceId}', 'SelectOptionsController@getDistricts');
Route::get('/get-wards/{districtId}', 'SelectOptionsController@getWards');

// Validate form data
Route::post('/validate-business', 'validateData@validateDatabusiness')->name('validate-business');
Route::post('/validate-team', 'validateData@validateDatateam')->name('validate-team');

// Dịch ngôn ngữ
Route::get('setLocale/{locale}', function ($locale) {
    if (in_array($locale, Config::get('app.locales'))) {
      Session::put('locale', $locale);
    }
    return redirect()->back();
})->name('app.setLocale');


// upload anh
Route::post('/upload_image', 'UploadDriverColtroller@upload_image');
Route::get('/get_file', 'UploadDriverColtroller@get_file');
