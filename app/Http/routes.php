<?php

/*
|--------------------------------------------------------------------------
| Routes File
|--------------------------------------------------------------------------
|
| Here is where you will register all of the routes in an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function (){
    return view('welcome');
    //return redirect()->action('Admin\AppController@index');
});
/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| This route group applies the "web" middleware group to every route
| it contains. The "web" middleware group is defined in your HTTP
| kernel and includes session state, CSRF protection, and more.
|
*/
Route::group(['middleware' => ['web','auth','entrust'],'namespace' => 'Admin','prefix' => 'admin','as' => 'admin::'], function () {



    /* 应用管理 */
//    Route::get('app', 'AppController@index');
//    Route::get('app/add', 'AppController@add');
//    Route::post('app/add', 'AppController@postAdd');
//    Route::get('app/{app}/edit','AppController@edit');
//    Route::post('app/{app}/edit','AppController@postEdit');
//    Route::post('app/{app}/delete','AppController@delete');

    Route::resource('app','AppController',[
        'except' => ['show']
    ]);

    /* 版本管理*/
    Route::get('app/{app}/version', 'VersionController@index');
    Route::get('app/{app}/version/create', 'VersionController@create');
    Route::post('app/{app}/version', 'VersionController@store');
    Route::get('app/{app}/version/{version}/edit', 'VersionController@edit');
    Route::put('app/{app}/version/{version}', 'VersionController@update');
    Route::delete('app/{app}/version/{version}', 'VersionController@destroy');

//    Route::resource('version','VersionController',[
//        'except' => ['show']
//    ]);

    /* 补丁管理 */
    Route::get('app/{app}/version/{version}/patch', 'PatchController@index');

    Route::resource('patch','PatchController', [
        'only' => ['index', 'update','store']
    ]);
});

Route::group(['middleware' => 'web'],function(){
    //Route::auth();

    // Authentication Routes...
    $this->get('login', 'Auth\AuthController@showLoginForm');
    $this->post('login', 'Auth\AuthController@login');
    $this->get('logout', 'Auth\AuthController@logout');

    // Registration Routes...
    //$this->get('register', 'Auth\AuthController@showRegistrationForm');
    //$this->post('register', 'Auth\AuthController@register');

    // Password Reset Routes...
    $this->get('password/reset/{token?}', 'Auth\PasswordController@showResetForm');
    $this->post('password/email', 'Auth\PasswordController@sendResetLinkEmail');
    $this->post('password/reset', 'Auth\PasswordController@reset');
});


