<?php

use Illuminate\Http\Request;



/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
*/

/**
* Buyers
*/
Route::resource('buyers','Buyer\BuyerController', ['only'=>['index','show']]);

/**
* Buyers
*/
Route::resource('buyers','Buyer\BuyerController', ['only'=>['index','show']]);

/**
* Category
*/
Route::resource('categories','Category\CategoryController', ['except'=>['create','edit']]);

/**
* Product
*/
Route::resource('products','Product\ProductController', ['only'=>['index','show']]);

/**
* Seller
*/
Route::resource('sellers','Seller\SellerController', ['only'=>['index','show']]);

/**
* Transaction
*/
Route::resource('U','Transaction\TransactionController', ['only'=>['index','show']]);
/**
* User
*/
Route::resource('users','User\UserController', ['except'=>['create','edit']]);