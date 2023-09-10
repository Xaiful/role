<?php

use App\Models\User;
use App\Models\Subcategory;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AreaController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DevisionController;
use App\Http\Controllers\DistrictController;
use App\Http\Controllers\WarehouseController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\SubDistrictController;
use App\Http\Controllers\RawMaterialsController;
use App\Http\Controllers\RawMaterialsShopController;
use App\Http\Controllers\WarehouseProductController;

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
    Route::get('/rawmaterialshops/{rawMaterialsShop}', [RawMaterialsShopController::class,'show'])->name('rawmaterialShop.list');
    // Route::resource('products',ProductController::class);
    Route::get('/products', [ProductController::class, 'index'])->name('products.index');
    Route::post('/products/store', [ProductController::class, 'store'])->name('products.store');
    Route::get('/products/create', [ProductController::class, 'create'])->name('products.create');
    Route::get('/products/send', [ProductController::class, 'send'])->name('products.send');
    Route::post('/products/send-to-warehouse', [ProductController::class, 'sendToWarehouse'])->name('products.sendToWarehouse');
    // Route::put('/warehouses/{warehouse}/products/{product}/update-quantity', [ProductController::class, 'updateQuantity'])->name('products.updateQuantity');
    

    // Route::get('/products/confirmation', [ProductController::class, 'confirmSend'])->name('products.confirmSend');
    // Route::post('/products/editQuantity/{product}', [ProductController::class, 'editQuantity'])->name('products.editQuantity');


    Route::resource('devisions',DevisionController::class);
    Route::get('/devision', [DevisionController::class,'devision'])->name('devisions.devisions');
    Route::get('/devisions/{devision}/districts', [DevisionController::class,'showDevisionDistricts'])->name('devisions.districts');

    Route::resource('districts',DistrictController::class);
    Route::get('/district', [DistrictController::class,'district'])->name('districts.districts');
    Route::get('/districts/{district}/subDistricts', [DistrictController::class,'showSubDistrict'])->name('districts.subdistricts');
    Route::resource('subdistricts',SubDistrictController::class);

    Route::resource('warehouses',WarehouseController::class);
    Route::get('/warehouses/{warehouse}/', [WarehouseController::class,'show'])->name('warehouse.list');
    Route::put('/warehouses/update_quantity/{warehouse}/', [WarehouseController::class,'update_quantity'])->name('warehouse.updateQuantity');
    // Route::get('/warehouses/{warehouse}/products/{product}/edit', [WarehouseController::class,'editQuantity'])->name('products.editQuantity');
    // Route::put('/warehouses/{warehouse}/products/{product}/update-quantity', [WarehouseController::class, 'updateQuantity'])->name('products.updateQuantity');
    // Route::put('/warehouses/{warehouse}/products/{product}/update-quantity', [WarehouseController::class, 'updateProduct'])->name('products.update');
    // Route::put('/warehouses/{warehouse}/products/{product}', [WarehouseController::class, 'update'])->name('warehouses.update');
    Route::get('/edit-warehouse-product/{id}', 'WarehouseController@editProductQuantity')->name('warehouse.editProductQuantity');
    Route::get('/warehouseproduct', [WarehouseProductController::class,'index'])->name('warehouseproduct.index');



    Route::resource('areas',AreaController::class);
});