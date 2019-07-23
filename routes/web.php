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

Route::get('/', 'DashboardController@index');
Route::get('/console', 'ConsoleController@index');

Route::get('/dashboards', 'DashboardController@index');
Route::get('/deploy', 'DeployController@index');
Route::post('/deploy', 'DeployController@deploy');
Route::get('/deploy/deactive', 'DeployController@deactive');
Route::get('/deploy/restart', 'DeployController@restart');
Route::get('/settings', 'SettingsController@index');
Route::post('/settings/save', 'SettingsController@save');
