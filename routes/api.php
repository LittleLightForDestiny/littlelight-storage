<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('v2/loadouts', 'Api\v2\LoadoutsController@list')->name('apiv2.loadouts-list');
Route::post('v2/loadouts/save', 'Api\v2\LoadoutsController@save')->name('apiv2.loadout-save');
Route::post('v2/loadouts/delete', 'Api\v2\LoadoutsController@delete')->name('apiv2.loadout-delete');
