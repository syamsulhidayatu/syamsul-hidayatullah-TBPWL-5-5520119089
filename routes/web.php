<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\MerekBarangController;
use App\Http\Controllers\AkunController;
use App\Http\Controllers\ProdukController;
use App\Http\Controllers\KategoriController;
use GuzzleHttp\Middleware;
use Illuminate\Support\Facades\Auth;

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
    return view('auth.login');
});

Auth::routes();



Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

//Admin Route
Route::get('admin/home', [AdminController::class, 'index'])
    ->name('admin.home')
    ->middleware('is_admin');


//Route User
Route::get('admin/user', [AkunController::class, 'index'])
    ->name('admin.user')
    ->Middleware('is_admin');

//route tambah
Route::post('admin/user', [AkunController::class, 'add_user'])
    ->name('admin.user.submit')
    ->middleware('is_admin');

//route edit
Route::patch('admin/user/update', [AkunController::class, 'update_user'])
    ->name('admin.user.update')
    ->middleware('is_admin');
Route::get('admin/ajaxadmin/dataUser/{id}', [AkunController::class, 'getDataUser']);

//route delete
Route::delete('admin/user/delete', [AkunController::class, 'destroy'])
    ->name('admin.user.delete')
    ->middleware('is_admin');





//Route Kategori
Route::get('admin/kategori', [KategoriController::class, 'index'])
    ->name('admin.kategori')
    ->middleware('is_admin');
Route::post('admin/kategori', [KategoriController::class, 'add_categories'])
    ->name('admin.kategori.submit')
    ->middleware('is_admin');
//route edit Kategori
Route::patch('admin/kategori/update', [KategoriController::class, 'update_categories'])
    ->name('admin.kategori.update')
    ->middleware('is_admin');
Route::get('admin/ajaxadmin/dataCategories/{id}', [KategoriController::class, 'getDataCategories']);

//route delete Kategori
Route::delete('admin/kategori/delete', [KategoriController::class, 'delete_categories'])
    ->name('admin.kategori.delete')
    ->middleware('is_admin');


//ROUTE UTAMA Merek Produk
Route::get('admin/merek', [MerekBarangController::class, 'index'])
    ->name('admin.merek')
    ->middleware('is_admin');

//route tambah Merek Produk
Route::post('admin/merek', [MerekBarangController::class, 'add_brand'])
    ->name('admin.brand.submit')
    ->middleware('is_admin');

//route edit Merek Produk
Route::patch('admin/merek/update', [MerekBarangController::class, 'update_brands'])
    ->name('admin.brand.update')
    ->middleware('is_admin');
Route::get('admin/ajaxadmin/dataBrands/{id}', [MerekBarangController::class, 'getDataBrands']);

//route delete Merek Produk
Route::delete('admin/merek/delete', [MerekBarangController::class, 'delete_brands'])
    ->name('admin.brand.delete')
    ->middleware('is_admin');


//Route Pengelolaan Produk
Route::get('admin/produk', [App\Http\Controllers\ProdukController::class, 'index'])
    ->name('admin.product')
    ->middleware('is_admin');

//Route Tambah Pengelolaan Produk
Route::post('admin/produk', [ProdukController::class, 'add_product'])
    ->name('admin.product.submit')
    ->middleware('is_admin');

Route::patch('admin/produk/update', [ProdukController::class, 'edit_product'])
    ->name('admin.product.update')
    ->middleware('is_admin');
Route::get('admin/ajaxadmin/dataProduct/{id}', [ProdukController::class, 'getDataProduct']);

//delete data
Route::delete('admin/produk/delete',[ProdukController::class, 'destroy'])
->name('admin.product.delete')
->middleware('is_admin');



