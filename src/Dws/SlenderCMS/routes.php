<?php

// Resource without Auth
Route::resource(Config::get('slender-cms::cms.admin-url').'/login', 'LoginController');
Route::get(Config::get('slender-cms::cms.admin-url').'/login/logout', 'LoginController@logout');


// Resources with Auth
Route::group(array('before' => 'cms_auth', 'prefix' => Config::get('slender-cms::cms.admin-url')), function()
{
    Route::get('/', 'HomeController@index');

    Route::resource('sites', 'SitesController');
    Route::resource('users', 'UsersController');
    Route::resource('roles', 'RolesController');
    

    Route::get('password/forgot', array('uses' => 'PasswordController@forgot', 'as' => 'forgotpassword'));
    Route::post('password/send', array('uses' => 'PasswordController@send', 'as' => 'sendpassword'));
    Route::any('password/reset/{data}', array('uses' => 'PasswordController@reset', 'as' => 'resetpassword'));

    // Route::any('sites', 'SitesController@index');
});


Route::filter('cms_auth', function()
{
    if (Auth::guest()) return Redirect::to(Config::get('slender-cms::cms.admin-url').'/login');
});

