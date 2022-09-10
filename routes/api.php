<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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


//unprotected routes
//Route::resource('products', ProductController::class);

//all products
Route::get('/products', [ProductController::class, 'index']);
//all inactive products
Route::get('/products/inactive', [ProductController::class, 'inactiveProducts']);
//all inactive products
Route::get('/products/active', [ProductController::class, 'activeProducts']);
//product by id
Route::get('/products/{product}', [ProductController::class, 'show']);
//search for product
Route::get('/products/search/{name}', [ProductController::class, 'search']);
//get products by user id
Route::get('products/user/{id}', [ProductController::class, 'productsByUserID']);
//get active products by user id
Route::get('products/user/{id}', [ProductController::class, 'activeProductsByUserID']);
//get inactive products by user id
Route::get('products/user/{id}', [ProductController::class, 'inactiveProductsByUserID']);
//register
Route::post('/register', [AuthController::class, 'register']);
//login
Route::post('/login', [AuthController::class, 'login']);


//protected route
Route::group( ['middleware' => ['auth:sanctum'] ], function (){
    //products
    //create
    Route::post('account/products', [ProductController::class, 'store']);
    //update
    Route::put('account//products/{product}', [ProductController::class, 'update']);
    //delete
    Route::delete('account/products/{product}', [ProductController::class, 'destroy']);
    //get all user products
    Route::get('/account/products', [ProductController::class, 'userProducts']);
    //get all user active products
    Route::get('/account/products/active', [ProductController::class, 'activeUserProducts']);
    //get all user inactive products
    Route::get('/account/products/inactive', [ProductController::class, 'inactiveUserProducts']);
    //activate a meal
    Route::put('account/products/activate/{id}', [ProductController::class, 'activateProduct']);
    //activate a meal
    Route::put('account/products/deactivate/{id}', [ProductController::class, 'deactivateProduct']);

    //auth
    Route::post('/logout', [AuthController::class, 'logout']);
});

