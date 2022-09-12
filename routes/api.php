<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Traits\Response;
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
Route::group(['middleware' => ['json']], function () {
    Route::get('/', function () {
        return Response::successResponse('Welcome to ProdSam');
    });
    Route::prefix('products')->group(function () {
        //all products
        Route::get('/', [ProductController::class, 'index']);
        //all inactive products
        Route::get('/inactive', [ProductController::class, 'inactiveProducts']);
        //all inactive products
        Route::get('/active', [ProductController::class, 'activeProducts']);
        //product by id
        Route::get('/{product}', [ProductController::class, 'show']);
        //search for product
        Route::get('/search/{name}', [ProductController::class, 'search']);
        //get products by user id
        Route::get('/user/{id}', [ProductController::class, 'productsByUserID']);
        //get active products by user id
        Route::get('/user/{id}/active', [ProductController::class, 'activeProductsByUserID']);
        //get inactive products by user id
        Route::get('/user/{id}/inactive', [ProductController::class, 'inactiveProductsByUserID']);
    });
    //register
    Route::post('/register', [AuthController::class, 'register']);
    //login
    Route::post('/login', [AuthController::class, 'login']);


    //protected route
    Route::group(['middleware' => ['auth:sanctum']], function () {
        //products
        Route::prefix('account')->group(function () {
            //create
            Route::post('/products', [ProductController::class, 'store']);
            //update
            Route::put('/products/{product}', [ProductController::class, 'update']);
            //delete
            Route::delete('/products/{product}', [ProductController::class, 'destroy']);
            //get all user products
            Route::get('/products', [ProductController::class, 'userProducts']);
            //get all user active products
            Route::get('/products/active', [ProductController::class, 'activeUserProducts']);
            //get all user inactive products
            Route::get('/products/inactive', [ProductController::class, 'inactiveUserProducts']);
            //activate a meal
            Route::put('/products/activate/{id}', [ProductController::class, 'activateProduct']);
            //activate a meal
            Route::put('/products/deactivate/{id}', [ProductController::class, 'deactivateProduct']);
        });
        //auth
        Route::post('/logout', [AuthController::class, 'logout']);
    });
});

