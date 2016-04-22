<?php

/*
|--------------------------------------------------------------------------
| 后台模块
|--------------------------------------------------------------------------
*/

/* 应用管理 */
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

/* 补丁管理 */
Route::get('app/{app}/version/{version}/patch', 'PatchController@index');
Route::post('app/{app}/version/{version}/patch', 'PatchController@store');
Route::put('app/{app}/version/{version}/patch/{patch}', 'PatchController@update');



