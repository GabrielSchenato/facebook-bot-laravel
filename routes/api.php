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

Route::post('auth/register', 'AuthController@register');
Route::post('auth/login', 'AuthController@login');


Route::group(['middleware' => 'jwt.auth'], function() {
    Route::get('auth/user', 'AuthController@user');
    Route::post('auth/logout', 'AuthController@logout');
});
Route::group(['middleware' => 'jwt.refresh'], function() {
    Route::get('auth/refresh', 'AuthController@refresh');
});

Route::middleware('jwt.auth')
        ->namespace('Api\V1')
        ->group(function () {
            Route::resource('/menus', 'MenusController');
            Route::get('/menu/set-menu/{menu_id}', 'MenusController@setMenu');
            Route::get('/menu/remove-menu', 'MenusController@removeMenu');

            Route::resource('/menu-buttons', 'MenuButtonsController');

            Route::post('/postbacks/get-started-button/{id}', 'PostbacksController@setGetStartedButton');
            Route::delete('/postbacks/get-started-button', 'PostbacksController@removeGetStartedButton')->middleware('isAdminOrSelf');
            Route::resource('/postbacks', 'PostbacksController')->middleware('isAdmin');

            Route::resource('/messages', 'MessagesController');
            Route::post('/messages/{id}/product', 'MessagesController@product');
            Route::delete('/messages/{id}/product/{productId}', 'MessagesController@deleteProduct');
            Route::get('/messages/{id}/product', 'MessagesController@getProduct');


            Route::resource('/elements', 'ElementsController');

            Route::resource('/products', 'ProductsController');
            Route::resource('/suggestions', 'SuggestionsController');
});
