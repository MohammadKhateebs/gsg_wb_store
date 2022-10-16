<?php

use App\Http\Controllers\Dashboard\CategoriesController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\ProductsController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [HomeController::class, 'index']);
Route::get('/dashboard/order', [DashboardController::class, 'orders']);
Route::get('/dashboard/setting', [DashboardController::class, 'settings']);
Route::get('/dashboard', [DashboardController::class, 'index']);

//CRUD :Read,Crate,Update,Delete
Route::group([
    'prefix' => '/dashboard',
    'as' => 'dashboard.',
    'namespace' => 'Dashboard'
], function () {
    Route::get('products/trash', [ProductsController::class, 'trash'])
    ->name('products.trash');

    Route::resource('/products','ProductsController')->names([
        // 'index'=>'products',
        // 'show'=>'products.details'
    ]);
    Route::patch('products/{id}/restore',[ProductsController::class,'restore'])
    ->name('products.restore');
    Route::prefix('/categories')->as('categories.')->group(function () {
        Route::get('/', [CategoriesController::class, 'index'])
            ->name('index');
            Route::get('/trash', [CategoriesController::class, 'trash'])
            ->name('trash');
        Route::get("/create", [CategoriesController::class, 'create'])
            ->name('create');
        //use post to modfication the data (standers requst mothed)
        Route::post('/', [CategoriesController::class, 'store'])
            ->name('store');
        Route::get('/edit/{id}', [CategoriesController::class, 'edit'])
            ->name('edit');
        Route::put('/{id}', [CategoriesController::class, 'update'])
            ->name('update');
        Route::delete('/{id}', [CategoriesController::class, 'destroy'])
            ->name('destroy');
            Route::patch('/{id}/restore',[CategoriesController::class,'restore'])
            ->name('restore');


    });
});
