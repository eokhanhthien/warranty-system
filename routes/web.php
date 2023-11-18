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

Route::get('/', function () { return view('welcome'); })->name('home-page'); 
// Route::get('/dashboard', function ()  { return view('dashboard');})->name('dashboard')->middleware('auth');
Route::get('/not-found', function () { return view('error.index');});

// Auth
Route::get('/login', 'Auth\AuthController@index')->name('login')->middleware('no_auth');
Route::get('/register', 'Auth\AuthController@register')->name('register')->middleware('no_auth');
Route::post('/get-register', 'Auth\AuthController@getRegister')->name('post.register');
Route::post('/auth-login', 'Auth\AuthController@authLogin')->name('auth.login');
Route::get('/logout', 'Auth\AuthController@logout')->name('logout');
Route::get('/auth/google', 'Auth\AuthController@redirectToGoogle');
Route::get('/auth/google/callback', 'Auth\AuthController@handleGoogleCallback');

// Login cho nhân viên
Route::get('/login-staff', 'Auth\AuthController@staffIndex')->name('staff.login')->middleware('guest:staff');
Route::post('/auth-staff-login', 'Auth\AuthController@authStaffLogin')->name('auth.staff.login');
Route::get('/logout-staff', 'Auth\AuthController@logoutStaff')->name('staff.logout');

Route::prefix('staff')->namespace('staff')->group(function () {
    Route::resource('staff-hrm', 'HrmController');

    Route::resource('staff-order', 'OrderController');
    Route::get('/staff/order-invoice/{id}', 'PDFInvoiceController@orderInvoice')->name('staff.order.invoice');

    Route::get('/staff/preparing-order', 'OrderController@preparingOrder')->name('staff.order.preparing');
    Route::get('/staff/pending-order', 'OrderController@pendingOrder')->name('staff.order.pending');
    Route::get('/staff/delivering-order', 'OrderController@deliveringOrder')->name('staff.order.delivering');
    Route::get('/staff/delivered-order', 'OrderController@deliveredOrder')->name('staff.order.delivered');
    Route::get('/staff/denied-order', 'OrderController@getDeniedOrder')->name('staff.order.denied');
    Route::get('/staff/return-order', 'OrderController@getReturnOrder')->name('staff.order.return');
    Route::get('/staff/cancel-order', 'OrderController@getCancelOrder')->name('staff.order.cancel');


    Route::get('/staff/confirm-order/{id}', 'OrderController@confirmOrder')->name('staff.confirm.order');
    Route::get('/staff/denied-order/{id}', 'OrderController@deniedOrder')->name('staff.denied.order');
    Route::get('/staff/done-preparing-order/{id}', 'OrderController@donePreparingOrder')->name('staff.done.preparing.order');
    Route::get('/staff/done-delivered-order/{id}', 'OrderController@doneDeliveredOrder')->name('staff.done.delivered.order');
    Route::get('/staff/cancel-order/{id}', 'OrderController@cancelOrder')->name('staff.cancel.order');
    Route::get('/staff/detail-order/{id}', 'OrderController@detailOrder')->name('staff.detail.order');
    Route::get('/staff/done-pay-order/{id}', 'OrderController@donePay')->name('staff.done.pay.order');
    Route::get('/staff/return-order/{id}', 'OrderController@returnOrder')->name('staff.return.order');
});


// Gửi mail
Route::get('/sendverifyemail/{email}','MailController@verify_email')->name('verify.email');
Route::post('/sendverifyemail','MailController@confirm_verify_email')->name('confirm.verify.email');
Route::get('/sendhtmlemail','MailController@html_email');
Route::get('/sendattachmentemail','MailController@attachment_email');


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
    Route::resource('/product-type', 'TypeProductController');
});

Route::prefix('admin')->namespace('Admin')->middleware((['auth', 'admin' ,'CheckBusinessSetting']))->group(function () {
    Route::get('/dashboard', 'DashboardController@index')->name('admin.dashboard');
    Route::resource('/subscription-package', 'BusinessSubscriptionController');
    Route::get('/show-packages', "BusinessSubscriptionController@showPackages")->name('package.show.packages');

    Route::middleware(['CheckSubscriptionRoleAdmin'])->group(function () {
        Route::get('/business-info', 'BusinessInfoController@index')->name('admin.business.info');
        Route::post('/business-update-info', 'BusinessInfoController@update')->name('admin.business.info.update');
        Route::get('/business-display', 'BusinessInfoController@businessDisplay')->name('admin.business.display');
        Route::post('/set-business-display', 'BusinessInfoController@setBusinessDisplay')->name('admin.set.business.display');
        Route::resource('/business-service', 'BusinessServiceController');
        Route::post('/business-color', 'BusinessInfoController@businessColor')->name('admin.business.color');
        Route::resource('/categories', 'BusinessCategoryController');
        Route::get('/getSubcategories/{category_id}', 'BusinessCategoryController@getSubcategories')->name('getSubcategories');
        Route::resource('/products', 'BusinessProductController');
        Route::resource('/warehouse', 'WareHouseController');
        Route::resource('/supplier', 'SupplierController');
        Route::get('/warehouse-list', 'WareHouseController@getListWareHouse')->name('warehouse.list');
        Route::get('/export-inventory-list', 'WareHouseController@getListExport')->name('export.inventory.list');
        Route::post('/export-inventory-store', 'WareHouseController@exportInventory')->name('export.inventory');
        Route::get('/receipt-detail/{id}', 'WareHouseController@getDetailReceipt')->name('receipt.detail');
        Route::get('/discounts', 'BusinessProductController@getDiscount')->name('product.discounts');
        Route::post('/create-discounts', 'BusinessProductController@createDiscount')->name('product.discounts.create');
        Route::put('/update-discounts/{id}', 'BusinessProductController@updateDiscount')->name('product.discounts.update');
        Route::delete('/delete-discounts/{id}', 'BusinessProductController@deleteDiscount')->name('product.discounts.delete');
        Route::post('/update-stock', 'BusinessProductController@updateQuantity')->name('stock.update');

        Route::get('/get-product-type-attributes/{id}', 'BusinessProductController@getAttributes');

        Route::get('/investment-channel/price-gold', 'InvestmentChannelController@price_gold');
        Route::get('/investment-channel/gasoline', 'InvestmentChannelController@gasoline');
        Route::get('/investment-channel/interest-rate', 'InvestmentChannelController@interest_rate');
        Route::get('/investment-channel/deposit-rate', 'InvestmentChannelController@deposit_rate');
        Route::get('/investment-channel/conversion-tool', 'InvestmentChannelController@conversion_tool');
        
        Route::resource('/order', 'OrderController');
        Route::get('/order-invoice/{id}', 'PDFInvoiceController@orderInvoice')->name('order.invoice');

        Route::get('/preparing-order', 'OrderController@preparingOrder')->name('order.preparing');
        Route::get('/pending-order', 'OrderController@pendingOrder')->name('order.pending');
        Route::get('/delivering-order', 'OrderController@deliveringOrder')->name('order.delivering');
        Route::get('/delivered-order', 'OrderController@deliveredOrder')->name('order.delivered');
        Route::get('/denied-order', 'OrderController@getDeniedOrder')->name('order.denied');
        Route::get('/return-order', 'OrderController@getReturnOrder')->name('order.return');
        Route::get('/cancel-order', 'OrderController@getCancelOrder')->name('order.cancel');


        Route::get('/confirm-order/{id}', 'OrderController@confirmOrder')->name('confirm.order');
        Route::get('/denied-order/{id}', 'OrderController@deniedOrder')->name('denied.order');
        Route::get('/done-preparing-order/{id}', 'OrderController@donePreparingOrder')->name('done.preparing.order');
        Route::get('/done-delivered-order/{id}', 'OrderController@doneDeliveredOrder')->name('done.delivered.order');
        Route::get('/cancel-order/{id}', 'OrderController@cancelOrder')->name('cancel.order');
        Route::get('/detail-order/{id}', 'OrderController@detailOrder')->name('admin.detail.order');
        Route::get('/done-pay-order/{id}', 'OrderController@donePay')->name('done.pay.order');
        Route::get('/return-order/{id}', 'OrderController@returnOrder')->name('return.order');

        Route::resource('/profile', 'ProfileController');

        Route::resource('/admin-gateway', 'GatewayController');
        Route::resource('/crm', 'CrmController');
        Route::resource('/hrm', 'HrmController');
        Route::get('/statistical', 'StatisticalController@statisticalChart')->name('statistical');
        Route::get('/statistical-revenue', 'StatisticalController@statisticalRevenue')->name('statistical.revenue');

        // Các Route khác cho Admin
    });
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

Route::get('staff/dashboard', function () { return view('staff.dashboard'); })->name('staff.dashboard')->middleware('no_auth_staff');; 

// Route dành cho khách hàng sỡ hữu doanh nghiệp
// Trang chủ website
Route::prefix('artisq')->namespace('Seller')->group(function () {
    Route::middleware(['CheckDomain','CheckSubscription'])->group(function () {
        Route::get('{domain}/{category_slug}', 'SellerController@index')->name('seller.business');
        Route::get('{domain}/{category_slug}/all-product', 'SellerController@all_product')->name('seller.business.all.product');
        Route::get('{domain}/{category_slug}/detail-product/{id}', 'SellerController@detail')->name('seller.business.detail.product');
        Route::get('{domain}/{category_slug}/service', 'SellerController@Service')->name('seller.business.service');

        // check đăng nhập
        Route::middleware(['auth_customer'])->group(function () {
            Route::get('{domain}/{category_slug}/cart', 'CartController@showCart')->name('seller.show.cart');
            Route::delete('{domain}/{category_slug}/delete-cart/{id}', 'CartController@deletefromCart')->name('seller.delete.cart');
            Route::post('{domain}/{category_slug}/order', 'CartController@Order')->name('seller.order');
            Route::get('{domain}/{category_slug}/order', 'CartController@getOrder')->name('seller.get.order');
            Route::get('{domain}/{category_slug}/order-detail/{id}', 'CartController@getOrderDetail')->name('seller.get.detail.order');
            Route::get('{domain}/{category_slug}/profile', 'SellerController@getProfile')->name('seller.profile');
            Route::post('{domain}/{category_slug}/post-profile', 'SellerController@postProfile')->name('seller.post.profile');

        });


        Route::get('{domain}/{category_slug}/login', 'AuthController@index')->name('seller.login');
        Route::get('{domain}/{category_slug}/register', 'AuthController@register')->name('seller.register');
        Route::post('{domain}/{category_slug}/get-register', 'AuthController@getRegister')->name('seller.get.register');
        Route::post('{domain}/{category_slug}/get-login', 'AuthController@authLoginCustomer')->name('seller.get.login');
        Route::get('{domain}/{category_slug}/logout', 'AuthController@authLogoutCustomer')->name('seller.logout');
    });

    Route::post('/add-to-cart', 'CartController@addToCart')->name('cart.add');
    Route::post('/update-cart', 'CartController@updateQuantity')->name('cart.update');
    Route::post('/check-discount', 'CartController@checkDiscount')->name('check.discount');
    Route::get('/destroy-discount', 'CartController@destroyDiscount')->name('destroy.discount');

});


// Chọn địa chỉ
Route::get('/address-options', 'SelectOptionsController@getAddressOptions')->name('address.options');
Route::get('/get-districts/{provinceId}', 'SelectOptionsController@getDistricts');
Route::get('/get-wards/{districtId}', 'SelectOptionsController@getWards');

// Validate form data
Route::post('/validate-business', 'validateData@validateDatabusiness')->name('validate-business');
Route::post('/validate-team', 'validateData@validateDatateam')->name('validate-team');
Route::put('/validate-team', 'validateData@validateDatateam')->name('validate-team');
Route::post('/validate-business-categories', 'validateData@validateDatabusinessCategory')->name('validate.business.categories');
Route::post('/validate-business-display', 'validateData@validateDatabusinessDisplay')->name('validate.business.display');
Route::post('/validate-business-setting', 'validateData@validateDatabusinessSetting')->name('validate.business.setting');
Route::post('/validate-register', 'validateData@validateDataRegister')->name('validate.register');
Route::post('/validate-admin-service', 'validateData@validateDataAdminService')->name('validate-admin-service');
Route::put('/validate-admin-service', 'validateData@validateDataAdminService')->name('validate-admin-service');
Route::post('/validate-business-package', 'validateData@validateDatabusinessPackage')->name('validate.business.package');
Route::put('/validate-business-package', 'validateData@validateDatabusinessPackage')->name('validate.business.package');
Route::post('/validate-admin-product', 'validateData@validateDataAdminProduct')->name('validate-admin-product');
Route::put('/validate-admin-product', 'validateData@validateDataAdminProduct')->name('validate-admin-product');
Route::post('/validate-register-customer', 'validateData@validateRegisterCustomer')->name('validate-register-customer');
Route::post('/validate-info-order', 'validateData@validateOrder')->name('validate.order');

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
