<?php

Route::fallback(
    function () {
        return View('errors.404 ');
    }
);

// Authentication route
Auth::routes();

// Cache clear route
Route::get(
    'cache-clear',
    function () {
        \Artisan::call('config:cache');
        \Artisan::call('cache:clear');
        \Artisan::call('config:clear');
        return redirect()->back();
    }
);
// Home
Route::get('/', 'PostsController@index')->name('home');

Route::get('/home', function () {
    return Redirect::to('/');
});


Route::get('profile/{slug}', 'PublicController@showUserProfile')->name('showUserProfile');
Route::get('categories', 'CategoryController@categoriesList')->name('categoriesList');
Route::get('page/{slug}', 'PageController@show')->name('showPage');

Route::get('user/password/reset/{verify_code}', 'PublicController@resetPasswordView')->name('getResetPassView');
Route::post('user/update/password', 'PublicController@resetUserPassword')->name('resetUserPassword');

// Authentication|Guest Routes
Route::post('register/login-register-user', 'PublicController@loginUser')->name('loginUser');
Route::post('register/verify-user-code', 'PublicController@verifyUserCode');
Route::post('register/form-step1-custom-errors', 'PublicController@RegisterStep1Validation');
Route::post('register/form-step2-custom-errors', 'PublicController@RegisterStep2Validation');


// ------------ Posts --------------

// Admin Posts Routes
Route::middleware('role:admin')->group(function () {

    Route::get('/admin/posts/search', 'PostsController@adminIndex')->name('admin.posts.adminIndex');
    
    Route::post('/admin/posts/delete', 'PostsController@destroy')->name('admin.posts.destroy');
    Route::post('/admin/posts/multi-delete', 'PostsController@deleteSelected')->name('admin.posts.multi-delete');
    
    Route::get('/admin/posts/edit', 'PostsController@edit')->name('admin.posts.edit');
    Route::get('/admin/posts/{post}/edit', 'PostsController@edit')->name('admin.posts.edit');
    Route::patch('/admin/posts/{post}/update', 'PostsController@update')->name('admin.posts.update');
    
    Route::get('/admin/posts', 'PostsController@adminIndex')->name('admin.posts.adminIndex');
    Route::post('/admin/posts', 'PostsController@store')->name('admin.posts.store');
});

// User Posts Routes
Route::resource('/posts', 'PostsController')->only(['index', 'show']);

// Comments Routes
Route::post('/posts/{post}/comment', 'CommentsController@comment')->name('comments.store');
Route::patch('/posts/{post}/comments/{comment}', 'CommentsController@update')->name('comments.update');
Route::delete('/posts/{post}/comments/{comment}', 'CommentsController@destroy')->name('comments.destroy');

// Replies Routes
Route::post('/comments/{comment}/reply', 'RepliesController@reply')->name('replies.store');
Route::patch('/comments/{comment}/replies/{reply}', 'RepliesController@update')->name('replies.update');
Route::delete('/comments/{comment}/replies/{reply}', 'RepliesController@destroy')->name('replies.destroy');

// ------------ Posts --------------



// Admin Routes
Route::group(['middleware' => ['role:admin']], function () {
        Route::post('admin/clear-cache', 'SiteManagementController@clearCache');
        Route::get('admin/clear-allcache', 'SiteManagementController@clearAllCache');
        Route::get('admin/import-updates', 'SiteManagementController@importUpdate');
        
        Route::get('users', 'UserController@userListing')->name('userListing');

        // Category Routes
        Route::get('admin/categories', 'CategoryController@index')->name('categories');
        Route::get('admin/categories/edit-cats/{id}', 'CategoryController@edit')->name('editCategories');
        Route::post('admin/store-category', 'CategoryController@store');
        Route::get('admin/categories/search', 'CategoryController@index');
        Route::post('admin/categories/delete-cats', 'CategoryController@destroy');
        Route::post('admin/categories/update-cats/{id}', 'CategoryController@update');
        Route::post('admin/categories/upload-temp-image', 'CategoryController@uploadTempImage');
        Route::post('admin/delete-checked-cats', 'CategoryController@deleteSelected');
        
        
        // Site Management Routes
        Route::get('admin/settings', 'SiteManagementController@Settings')->name('settings');
        Route::post('admin/store/email-settings', 'SiteManagementController@storeEmailSettings');
        Route::post('admin/store/home-settings', 'SiteManagementController@storeHomeSettings');
        Route::get('admin/get-section-display-setting', 'SiteManagementController@getSectionDisplaySetting');
        Route::get('admin/get-chat-display-setting', 'SiteManagementController@getchatDisplaySetting');
        Route::post('admin/store/section-settings', 'SiteManagementController@storeSectionSettings');
        Route::post('admin/store/service-section-settings', 'SiteManagementController@storeServiceSectionSettings');
        Route::post('admin/store/settings', 'SiteManagementController@storeGeneralSettings');
        Route::post('admin/store/chat-settings', 'SiteManagementController@storeChatSettings');
        Route::post('admin/store/innerpage-settings', 'SiteManagementController@storeInnerPageSettings');
        Route::post('admin/get/innerpage-settings', 'SiteManagementController@getInnerPageSettings');
        Route::get('admin/get/registration-settings', 'SiteManagementController@getRegistrationSettings');
        Route::get('admin/get/site-payment-option', 'SiteManagementController@getSitePaymentOption');
        // Route::get('admin/theme-style-settings', 'SiteManagementController@ThemeStyleSettings');
        Route::post('admin/store/theme-styling-settings', 'SiteManagementController@storeThemeStylingSettings');
        Route::get('admin/get-theme-color-display-setting', 'SiteManagementController@getThemeColorDisplaySetting');
        Route::post('admin/store/registration-settings', 'SiteManagementController@storeRegistrationSettings');
        Route::post('admin/upload-temp-image/{file_name}', 'SiteManagementController@uploadTempImage');
        Route::post('admin/store/upload-icons', 'SiteManagementController@storeDashboardIcons');
        Route::post('admin/store/footer-settings', 'SiteManagementController@storeFooterSettings');
        Route::post('admin/store/access-type-settings', 'SiteManagementController@storeAccessTypeSettings');
        Route::post('admin/store/social-settings', 'SiteManagementController@storeSocialSettings');
        Route::post('admin/store/search-menu', 'SiteManagementController@storeSearchMenu');
        Route::post('admin/store/commision-settings', 'SiteManagementController@storeCommisionSettings');
        Route::post('admin/store/payment-settings', 'SiteManagementController@storePaymentSettings');
        Route::post('admin/store/stripe-payment-settings', 'SiteManagementController@storeStripeSettings');
        Route::get('admin/email-templates', 'EmailTemplateController@index')->name('emailTemplates');
        Route::get('admin/email-templates/filter-templates', 'EmailTemplateController@index')->name('emailTemplates');
        Route::get('admin/email-templates/{id}', 'EmailTemplateController@edit')->name('editEmailTemplates');
        Route::post('admin/email-templates/update-content', 'EmailTemplateController@updateTemplateContent');
        Route::post('admin/email-templates/update-templates/{id}', 'EmailTemplateController@update');
        Route::post('admin/store/breadcrumbs-settings', 'SiteManagementController@storeBreadcrumbsSettings');
        Route::post('admin/get/breadcrumbs-settings', 'SiteManagementController@getBreadcrumbsSettings');
        
        // Profile
        Route::get('admin/profile', 'UserController@adminProfileSettings')->name('adminProfile');
        Route::post('admin/store-profile-settings', 'UserController@storeProfileSettings');
        Route::post('admin/upload-temp-image', 'UserController@uploadTempImage');
        Route::post('admin/submit-user-refund', 'UserController@submitUserRefund');
    }
);


// User Routes
Route::group( ['middleware' => ['role:user']], function () {
    Route::get('user/profile', 'UserController@userProfileSettings')->name('userProfile');
    Route::post('user/upload-temp-image', 'UserController@uploadTempImage');
    Route::post('user/store-profile-settings', 'UserController@storeProfileSettings');
});

// User|Admin Routes
Route::group( ['middleware' => ['role:user|admin']],
    function () {
        
      
        Route::get('profile/settings/manage-account', 'UserController@accountSettings')->name('manageAccount');
        Route::get('profile/settings/reset-password', 'UserController@resetPassword')->name('resetPassword');
        Route::post('profile/settings/request-password', 'UserController@requestPassword');
        Route::get('profile/settings/email-notification-settings', 'UserController@emailNotificationSettings')->name('emailNotificationSettings');
        Route::post('profile/settings/save-email-settings', 'UserController@saveEmailNotificationSettings');
        Route::post('profile/settings/save-account-settings', 'UserController@saveAccountSettings');
        Route::get('profile/settings/delete-account', 'UserController@deleteAccount')->name('deleteAccount');
        Route::post('profile/settings/delete-user', 'UserController@destroy');
        Route::post('admin/delete-user', 'UserController@deleteUser');
        Route::get('profile/settings/get-manage-account', 'UserController@getManageAccountData');
        
        
    }
);