<?php

use App\Models\User;
use App\Models\Subcategory;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DevisionController;
use App\Http\Controllers\DistrictController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\SubDistrictController;
use App\Http\Controllers\RawMaterialsController;
use App\Http\Controllers\RawMaterialsShopController;

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

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth'])->name('dashboard');

require __DIR__.'/auth.php';

Route::group(['middleware' => 'auth'], function(){
    Route::get('/dashboard',[HomeController::class, 'index']);

    Route::resource('permission',PermissionController::class);
    Route::resource('roles',RolesController::class);
    Route::resource('users',UserController::class)->except('show');
    Route::resource('units',UnitController::class);
    Route::resource('categories',CategoryController::class);
    Route::resource('subcategories',SubcategoryController::class);
    Route::resource('rawmaterials',RawMaterialsController::class);
    Route::post('/rawmaterials/save-all', [RawMaterialsController::class,'saveAll'])->name('rawmaterials.saveAll');
    Route::resource('rawmaterialshops',RawMaterialsShopController::class);
    Route::resource('products',ProductController::class);
    Route::resource('devisions',DevisionController::class);
    Route::resource('districts',DistrictController::class);
    Route::resource('subdistricts',SubDistrictController::class);


});