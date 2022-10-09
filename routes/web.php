<?php

use App\Http\Controllers\Dashboard\CategoriesController;
use App\Http\Controllers\Dashboard\DashboardController;
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
Route::get('/dashboard/product', [DashboardController::class, 'products']);
Route::get('/dashboard/setting', [DashboardController::class, 'settings']);

//CRUD :Read,Crate,Update,Delete
Route::group([
    'prefix' => '/dashboard',
    'as' => 'dashboard.',
    'namespace' => 'Dashboard'
], function () {
    Route::get('/dashboard', [DashboardController::class, 'index']);
    Route::prefix('/categories')->as('categories.')->group(function () {
        Route::get('/', [CategoriesController::class, 'index'])
            ->name('index');
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
    });
});
