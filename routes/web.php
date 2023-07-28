<?php

use App\Http\Controllers\ClientController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProviderController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SaleController;
use App\Http\Controllers\IncomeController;
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

/** Clientes **/
Route::get('/client/index_content',
    [ClientController::class, 'indexContent'])->name('client.index_content');

Route::post('/client/upsert/{idUser}',
    [ClientController::class, 'upsert'])->name('client.upsert');


/** Usuarios **/
Route::get('/user/index_content',
    [UserController::class, 'indexContent'])->name('user.index_content');

Route::post('/user/upsert/{idUser}',
    [UserController::class, 'upsert'])->name('user.upsert');

/** Categorias **/
Route::get('/category/index_content',
    [CategoryController::class, 'indexContent'])->name('category.index_content');

Route::post('/category/upsert/{idCategory}',
    [CategoryController::class, 'upsert'])->name('category.upsert');

/** Proveedores **/
Route::get('/provider/index_content',
    [ProviderController::class, 'indexContent'])->name('provider.index_content');

Route::post('/provider/upsert/{idProvider}',
    [ProviderController::class, 'upsert'])->name('provider.upsert');

/** Productos **/
Route::get('/product/index_content',
    [ProductController::class, 'indexContent'])->name('product.index_content');

Route::post('/product/upsert/{idProduct}',
    [ProductController::class, 'upsert'])->name('product.upsert');

Route::get('/product/get_categories',
    [ProductController::class, 'getCategories'])
    ->name('product.category');

/** Ventas **/
Route::get('/sale/index_content',
    [SaleController::class, 'indexContent'])->name('sale.index_content');

Route::post('/sale/upsert/{idSale}',
    [SaleController::class, 'upsert'])->name('sale.upsert');

Route::get('/sale/get_product',
    [SaleController::class, 'getProduct'])
    ->name('sale.product');

Route::get('/sale/get_client',
    [SaleController::class, 'getClient'])
    ->name('sale.client');

Route::get('/sale/get_state',
    [SaleController::class, 'getState'])
    ->name('sale.state');

/** Ingreso **/
Route::get('/income/index_content',
    [IncomeController::class, 'indexContent'])->name('income.index_content');

Route::post('/income/upsert/{idIncome}',
    [IncomeController::class, 'upsert'])->name('income.upsert');

Route::get('/income/get_product',
    [IncomeController::class, 'getProduct'])
    ->name('income.product');

Route::get('/income/get_provider',
    [IncomeController::class, 'getProvider'])
    ->name('income.provider');

Route::get('/income/get_user',
    [IncomeController::class, 'getUser'])
    ->name('income.user');

Route::get('/{any}', function () {
    return view(('admin.main'));
})->where('any', '.*');
