<?php

use Illuminate\Support\Facades\Route;

// ADMIN / SELLER
use App\Http\Controllers\AdminAuthController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AdminDataController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\Admin\GeneralSettingController;

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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// ADMIN AUTH

Route::get('admin/login', [AdminAuthController::class, 'showLoginForm'])->name('admin.login');
Route::post('admin/login', [AdminAuthController::class, 'login']);
Route::post('admin/logout', [AdminAuthController::class, 'logout'])->name('admin.logout');
Route::get('admin/register', [AdminAuthController::class, 'showRegisterForm'])->name('admin.register');
Route::post('admin/register', [AdminAuthController::class, 'register']);

// ADMIN MENU
Route::prefix('admin')->middleware('auth:admin')->group(function () {
    
    Route::get('/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');

    // Dashboard
    Route::match(['GET'], 'dashboard', [AdminDashboardController::class, 'index']);
    // Settings 
    // General
    Route::get('/settings_general', [GeneralSettingController::class, 'index']);
    Route::post('/settings_general', [GeneralSettingController::class, 'update']);

    // Brands
    Route::match(['GET','POST' ,'PATCH'], 'brand', [BrandController::class, 'index'])->name('brands.index');
    Route::delete('/brand/{id}', [BrandController::class, 'destroy'])->name('brand.destroy');
    // Categorys
    Route::match(['GET','POST' ,'PATCH'], 'category', [CategoryController::class, 'index'])->name('categorys.index');
    Route::delete('/category/{id}', [CategoryController::class, 'destroy'])->name('categorys.destroy');

    // Products
    Route::match(['GET','POST' ,'PATCH'], 'product', [ProductController::class, 'index'])->name('products.index');
    Route::delete('/product/{id}', [ProductController::class, 'destroy'])->name('products.destroy');

    // Admins
    Route::match(['GET','PATCH'], 'admin', [AdminDataController::class, 'index']);
    Route::delete('/admin/{id}', [AdminDataController::class, 'destroy'])->name('admins.destroy');

    // Customers
    Route::match(['GET','PATCH'], 'customer', [CustomerController::class, 'index'])->name('customers.index');
    Route::delete('/customer/{id}', [CustomerController::class, 'destroy'])->name('customers.destroy');

    // Orders
    Route::match(['GET','PATCH'], 'order', [OrderController::class, 'index']);
    Route::post('/order/{id}', [OrderController::class, 'updateOrder']);
    // Notifications
    Route::get('/notifications/read/{id}', [NotificationController::class, 'markAsRead'])->name('notifications.read');
    Route::get('/notifications/read-all', [NotificationController::class, 'markAllAsRead'])->name('notifications.readAll');
    Route::get('/notifications/unread', [NotificationController::class, 'fetchUnreadNotifications'])->name('notifications.unread');
    Route::match(['GET','PATCH'], 'notification', [NotificationController::class, 'index']);
    
});
