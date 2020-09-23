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

// Route::middleware('auth:api')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['middleware' => ['cors','language']], function () { 
    Route::prefix('pwa')->group(function (){
        Route::get('slider',['as' => 'pwa','uses' => 'PWA\PWAController@slider']);
        Route::get('bahasa',['as' => 'pwa','uses' => 'PWA\PWAController@ses_lang']);
        Route::get('popup',['as' => 'pwa','uses' => 'PWA\PWAController@popup']);
        Route::get('foto',['as' => 'pwa','uses' => 'PWA\PWAController@foto']);
        Route::get('video',['as' => 'pwa','uses' => 'PWA\PWAController@video']);
        Route::get('smedia',['as' => 'pwa','uses' => 'PWA\PWAController@smedia']);
        Route::get('berita',['as' => 'pwa','uses' => 'PWA\PWAController@berita']);
        Route::get('pers',['as' => 'pwa','uses' => 'PWA\PWAController@pers']);
        Route::get('infografis',['as' => 'pwa','uses' => 'PWA\PWAController@infografis']);
        Route::get('struktur_single',['as' => 'pwa','uses' => 'PWA\PWAController@struktur_single']);
        Route::get('struktur_parent',['as' => 'pwa','uses' => 'PWA\PWAController@struktur_parent']);
        Route::get('struktur_child',['as' => 'pwa','uses' => 'PWA\PWAController@struktur_child']);
        Route::get('getDate',['as' => 'pwa','uses' => 'PWA\PWAController@getDate']);
        Route::get('getEvent',['as' => 'pwa','uses' => 'PWA\PWAController@getEvent']);
        Route::get('satker_single',['as' => 'pwa','uses' => 'PWA\PWAController@satker_single']);
        Route::get('satker_parent',['as' => 'pwa','uses' => 'PWA\PWAController@satker_parent']);
        Route::get('satker_child',['as' => 'pwa','uses' => 'PWA\PWAController@satker_child']);

    });
});