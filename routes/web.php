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

Route::get('/', function () {
    return view('welcome');
});


Route::prefix('bot')
        ->group(function() {
            Route::get('/webhook', 'BotController@subscribe');
            Route::post('/webhook', 'BotController@receiveMessage');
    });
    
Route::prefix('api/v1')
        ->middleware('auth')
        ->namespace('Api\V1')
        ->group(function () {
            Route::post('/postbacks/get-started-button/{id}', 'PostbacksController@setGetStartedButton');  
            Route::delete('/postbacks/get-started-button', 'PostbacksController@removeGetStartedButton'); 
            Route::resource('/postbacks', 'PostbacksController');    
            
            Route::resource('/messages', 'MessagesController');    
            Route::post('/messages/{id}/product', 'MessagesController@product');
            Route::delete('/messages/{id}/product/{productId}', 'MessagesController@deleteProduct');
            Route::get('/messages/{id}/product', 'MessagesController@getProduct');
            
            
            Route::resource('/elements', 'ElementsController'); 
            
            Route::resource('/products', 'ProductsController');   
            Route::resource('/suggestions', 'SuggestionsController');   
        });
        
Route::prefix('api/v1')
        ->namespace('Api\V1')
        ->group(function () {
            Route::get('/users/me', 'UsersController@me');      
        });
    
Auth::routes();
