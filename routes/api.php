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

Route::resource('buyers','Buyer\BuyerController', ['only'=>['index','show']]);
Route::resource('buyers.categories','Buyer\BuyerCategoryController', ['only'=>['index']]);
Route::resource('buyers.products','Buyer\BuyerProductController', ['only'=>['index']]);
Route::resource('buyers.sellers','Buyer\BuyerSellerController', ['only'=>['index']]);
Route::resource('buyers.transactions','Buyer\BuyerTransactionController', ['only'=>['index']]);

/**
* Category
*/
Route::resource('categories','Category\CategoryController', ['except'=>['create','edit']]);
Route::resource('category.products','Category\CategoryProductController', ['only'=>['index']]);
Route::resource('category.sellers','Category\CategorySellerController', ['only'=>['index']]);
Route::resource('category.buyers','Category\CategoryBuyerController', ['only'=>['index']]);
Route::resource('category.transactions','Category\CategoryTransactionController', ['only'=>['index']]);

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
Route::resource('transactions','Transaction\TransactionController', ['only'=>['index','show']]);
Route::resource('transactions.category','Transaction\TransactionCategoryController', ['only'=>['index']]);
Route::resource('transactions.seller','Transaction\TransactionSellerController', ['only'=>['index']]);
/**
* User
*/
Route::resource('users','User\UserController', ['except'=>['create','edit']]);