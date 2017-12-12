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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

/**
 * News
 */
Route::get('/',[
    'uses'  =>  'NewsController@index',
    'as'    =>  'home'
]);
Route::prefix('news')->group(function(){
    //create new object
    Route::post('/create',[
        'uses'  => 'NewsController@create',
        'as'    => 'news.create'
    ]);
    //show an single object
    Route::get('/show/{id}',[
        'uses'  => 'NewsController@show',
        'as'    => 'news.show'
    ]);
    //update object
    Route::put('/update/{id}',[
        'uses'  => 'NewsController@update',
        'as'    => 'news.update'
    ]);
    //delete object
    Route::delete('/delete/{id}',[
        'uses'  => 'NewsController@destroy',
        'as'    => 'news.destroy'
    ]);
});
