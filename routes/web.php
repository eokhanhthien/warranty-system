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
// Route::get('/dashboard', function ()  { return view('dashboard');})->name('dashboard')->middleware('auth');
Route::get('/not-found', function () { return view('error.index');});

// Auth
Route::get('/login', 'Auth\AuthController@index')->name('login')->middleware('no_auth');
Route::get('/register', 'Auth\AuthController@register')->name('register')->middleware('no_auth');
Route::post('/get-register', 'Auth\AuthController@getRegister')->name('post.register');
Route::post('/auth-login', 'Auth\AuthController@authLogin')->name('auth.login');
Route::get('/logout', 'Auth\AuthController@logout')->name('logout');


Route::prefix('superadmin')->namespace('superadmin')->middleware((['auth', 'superadmin']))->group(function () {
    // Dashboard
    Route::get('/dashboard', 'DashboardController@index')->name('superadmin.dashboard');

    // Danh nghiệp
    Route::resource('/businesses', 'businessesController')->names([
        'index' => 'superadmin.businesses',
        'store' => 'superadmin.businesses.store',
        'edit' => 'superadmin.businesses.edit',
    ]);
    Route::post('/businesses/{id}/update', 'businessesController@update')->name('superadmin.businesses.update');
    Route::delete('/businesses/{id}/delete', 'businessesController@destroy')->name('superadmin.businesses.destroy');

    // Đồng đội
    Route::resource('/team', 'teamsController')->names([
        'index' => 'superadmin.team',
        'store' => 'superadmin.team.store',
        'edit' => 'superadmin.team.edit',
    ]);
    Route::post('/team/{id}/update', 'teamsController@update')->name('superadmin.team.update');
    Route::delete('/team/{id}/delete', 'teamsController@destroy')->name('superadmin.team.destroy');

    // Danh mục doanh nghiệp
    Route::resource('/businesses-categories', 'BussinessCategoriesController')->names([
        'index' => 'superadmin.businesses.categories',
        'store' => 'superadmin.businesses.categories.store',
        'edit' => 'superadmin.businesses.categories.edit',
    ]);
    Route::post('/businesses-categories/{id}/update', 'BussinessCategoriesController@update')->name('superadmin.businesses.categories.update');
    Route::delete('/businesses-categories/{id}/delete', 'BussinessCategoriesController@destroy')->name('superadmin.businesses.categories.destroy');

    // Giao diện doanh nghiệp
    Route::resource('/businesses-display', 'BussinessDisplayController')->names([
        'index' => 'superadmin.businesses.display',
        'store' => 'superadmin.businesses.display.store',
        'edit' => 'superadmin.businesses.display.edit',
    ]);
    Route::post('/businesses-display/{id}/update', 'BussinessDisplayController@update')->name('superadmin.businesses.display.update');
    Route::delete('/businesses-display/{id}/delete', 'BussinessDisplayController@destroy')->name('superadmin.businesses.display.destroy');

    // Gói
    Route::resource('/businesses-package', 'BussinessPackageController');
    Route::get('/check-package', 'BussinessPackageController@checkpackage')->name('check.package');
    Route::post('/check-package', 'BussinessPackageController@postCheckpackage')->name('check.package');
    Route::post('/edit-date-package', 'BussinessPackageController@editDatepackage')->name('edit.date.package');
    Route::resource('/gateway', 'GatewayController');
});

Route::prefix('admin')->namespace('Admin')->middleware((['auth', 'admin' ,'CheckBusinessSetting']))->group(function () {
    Route::get('/dashboard', 'DashboardController@index')->name('admin.dashboard');
    Route::get('/business-info', 'BusinessInfoController@index')->name('admin.business.info');
    Route::post('/business-update-info', 'BusinessInfoController@update')->name('admin.business.info.update');
    Route::get('/business-display', 'BusinessInfoController@businessDisplay')->name('admin.business.display');
    Route::post('/set-business-display', 'BusinessInfoController@setBusinessDisplay')->name('admin.set.business.display');
    Route::resource('/business-service', 'BusinessServiceController');
    Route::resource('/subscription-package', 'BusinessSubscriptionController');
    Route::get('/show-packages', "BusinessSubscriptionController@showPackages")->name('package.show.packages');

    // Các Route khác cho Admin
});
// Check cài đặt doanh ngiệp lần đầu
Route::prefix('admin')->namespace('Setting')->middleware((['auth', 'admin']))->group(function () {
Route::get('/business-setting', 'BusinessSettingController@businessSetting')->name('business.setting');
Route::post('/business-display-setting', 'BusinessSettingController@businessDisplaySetting')->name('business.display.setting');
Route::post('/business-setting-add', 'BusinessSettingController@businessSettingAdd')->name('business.setting.add');
});
// Route::prefix('user')->middleware('user')->group(function () {
//     Route::get('/dashboard', function () {
//         // Logic xử lý cho trang dashboard của User
//     })->name('user.dashboard');
//     // Các Route khác cho User
// });


// Route dành cho khách hàng sỡ hữu doanh nghiệp
// Trang chủ website
Route::prefix('artisq')->namespace('Seller')->group(function () {
    Route::middleware(['CheckDomain','CheckSubscription'])->group(function () {
        Route::get('{domain}/{category_slug}', 'SellerController@index')->name('seller.business');
        Route::get('{domain}/{category_slug}/about', 'SellerController@about')->name('seller.business.about');
    });
});


// Chọn địa chỉ
Route::get('/address-options', 'SelectOptionsController@getAddressOptions')->name('address.options');
Route::get('/get-districts/{provinceId}', 'SelectOptionsController@getDistricts');
Route::get('/get-wards/{districtId}', 'SelectOptionsController@getWards');

// Validate form data
Route::post('/validate-business', 'validateData@validateDatabusiness')->name('validate-business');
Route::post('/validate-team', 'validateData@validateDatateam')->name('validate-team');
Route::post('/validate-business-categories', 'validateData@validateDatabusinessCategory')->name('validate.business.categories');
Route::post('/validate-business-display', 'validateData@validateDatabusinessDisplay')->name('validate.business.display');
Route::post('/validate-business-setting', 'validateData@validateDatabusinessSetting')->name('validate.business.setting');
Route::post('/validate-register', 'validateData@validateDataRegister')->name('validate.register');
Route::post('/validate-admin-service', 'validateData@validateDataAdminService')->name('validate-admin-service');
Route::put('/validate-admin-service', 'validateData@validateDataAdminService')->name('validate-admin-service');
Route::post('/validate-business-package', 'validateData@validateDatabusinessPackage')->name('validate.business.package');
Route::put('/validate-business-package', 'validateData@validateDatabusinessPackage')->name('validate.business.package');

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
