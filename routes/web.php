<?php

use App\Http\Controllers\AdminIndexController;
use App\Http\Controllers\ChangePassword;
use App\Http\Controllers\LoginController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\departmentController;
use App\Http\Controllers\CompanyController;
use App\Http\Controllers\DesignationController;
use App\Http\Controllers\EmployeeController;
use App\Http\Controllers\SessionController;
use App\Http\Controllers\UnitsController;
use App\Http\Controllers\Usercontroller;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\Partycontroller;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\PdfController;
use App\Http\Controllers\SaleController;

Route::get('/', function () {
    return view('auth/index');
})->name('login');


Route::post('auth', [LoginController::class, 'authenticate'])->name('auth');
Route::post('logout', [LoginController::class, 'logout'])->name('logout');
Route::middleware(['auth'])->group(function () {
    // Database
    Route::get('admin/index', function () {
        return view('admin/index');
    });
    // company
    Route::controller(AdminIndexController::class)->group(function () {
        Route::get('admin/index', 'show');
    });

    Route::controller(CompanyController::class)->group(function () {
        Route::get('admin/master/company', 'show');
        Route::post('admin/master/company', 'store');
        Route::put('admin/master/company/{id}', 'update');
    });

    // Route::resource('Designations', DesignationController::class);
    Route::resource('admin/master/Departments', departmentController::class);
    Route::resource('admin/master/Designations', DesignationController::class);
    Route::resource('admin/master/Employees', EmployeeController::class);
    Route::resource('admin/master/Sessions', SessionController::class);
    Route::get('session_master', [SessionController::class, 'change_status']);

    Route::group(['prefix' => 'admin/master/'], function () {
        // User Master
        Route::controller(Usercontroller::class)->group(function () {
            Route::get('user_master', 'index');
            Route::post('user_master', 'store');
            Route::get('user_master/edit/{id}', 'edit');
            Route::get('user_master/delete/{id}', 'delete');
        });
        // user master close
        // Change password
        Route::get('changepassword', [ChangePassword::class, 'change']);
        Route::post('changepassword', [ChangePassword::class, 'updatepass']);
        Route::get('unitmaster', [UnitsController::class, 'index']);
        Route::post('unitmaster', [UnitsController::class, 'store']);
        Route::get('unitmaster/edit/{id}', [UnitsController::class, 'edit']);
        Route::get('unitmaster/delete/{id}', [UnitsController::class, 'delete']);
        Route::get('product_master', [ProductController::class, 'index']);
        Route::post('product_master', [ProductController::class, 'store']);
        Route::get('product_master/edit/{id}', [ProductController::class, 'edit']);
        Route::controller(Partycontroller::class)->group(function () {
            Route::get('party_master', 'index');
            Route::post('party_master', 'store');
            Route::get('party_master/edit/{id}', 'edit');
        });
        Route::controller(SupplierController::class)->group(function () {
            Route::get('supplier_master', 'index');
            Route::post('supplier_master', 'store');
            Route::get('supplier_master/edit/{id}', 'edit');
        });
    });
    Route::controller(PurchaseController::class)->group(function () {
        Route::get('admin/inventory/purchase_entry', 'index')->name("purchase_entry");
        Route::post('admin/purchase_details', 'search_purchase');
        Route::post('admin/purchase_entry', 'save');
        Route::get('admin/purchase_details', 'show_data')->name("purchase_details");
    });
    Route::post('ajax_save_product', [PurchaseController::class, 'add_data']);
    Route::get('show_product/{id}', [PurchaseController::class, 'show_product']);

    Route::get('admin/purchase_entry/edit/{id}', [PurchaseController::class, 'purchase_edit']);

    Route::delete('/delete_record/{id}', [ProductController::class, 'delete']);
    Route::delete('/delete_party/{id}', [Partycontroller::class, 'delete']);
    Route::delete('/delete_supplier/{id}', [SupplierController::class, 'delete']);
    Route::delete('/delete_purchase_details/{id}', [PurchaseController::class, 'delete']);
    Route::delete('/delete_purchase_entry/{id}', [PurchaseController::class, 'delete_purchase']);

    Route::post('ajax_save_product', [PurchaseController::class, 'add_data']);
    Route::post('ajax_add_product', [PurchaseController::class, 'add_product']);
    Route::post('ajax_edit_product_details', [PurchaseController::class, 'ajax_edit_product_details']);
    Route::get('show_product/{id}', [PurchaseController::class, 'show_product']);
    Route::get('get_unit/{id}', [PurchaseController::class, 'getunit']);
    Route::get('check_oldpass/{id}', [ChangePassword::class, 'oldpass']);
    Route::get('pdf_purchase_entry/{id}', [PurchaseController::class, 'downloadPDF']);



    Route::controller(SaleController::class)->group(function () {
        Route::get('admin/inventory/sale_entry', 'index')->name("sale_entry");
    });
});
