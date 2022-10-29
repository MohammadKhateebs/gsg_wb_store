<?php

use App\Http\Controllers\Auth\ChangeUserPassordController;
use App\Http\Controllers\Auth\UserProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Dashboard\CategoriesController;
use App\Http\Controllers\Dashboard\DashboardController;
use App\Http\Controllers\Dashboard\ProductsController;
use App\Http\Controllers\HomeController;




Route::get('/', [HomeController::class, 'index']);
Route::get('/dashboard/order', [DashboardController::class, 'orders']);
Route::get('/dashboard/setting', [DashboardController::class, 'settings']);
Route::get('/dashboard', [DashboardController::class, 'index']);

//CRUD :Read,Crate,Update,Delete
Route::group([
    'prefix' => '/dashboard',
    'as' => 'dashboard.',
    'namespace' => 'Dashboard',
    // to apply middleware at the all route ..
    'middleware'=>['auth']
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

Route::get('/profile',[UserProfileController::class,'index'])
->name('profile')
->middleware('auth:web,admin','password.confirm');
Route::patch('/profile',[UserProfileController::class,'update'])
->name('profile.update')
->middleware('auth:web,admin','password.confirm');

Route::get('/change-password',[ChangeUserPassordController::class,'index'])
->name('change-password')
->middleware('auth:web,admin');
Route::put('/change-password',[ChangeUserPassordController::class,'update'])
->name('change-password.update')
->middleware('auth:web,admin');

Route::get('/dashboard/breeze', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

require __DIR__.'/auth.php';
