<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AAuthController;
use App\Http\Controllers\AdminPannel;
use App\Http\Controllers\Authenticate;
use App\Models\Item;
use App\Models\Category;
use App\Models\Order;
use App\Models\UserType;
use App\Models\User;
use App\Models\Customer;
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

Route::get("/login", [AAuthController::class, 'login']);
Route::get("/registration", [AAuthController::class, 'registration']);
Route::post("/register-user", [AAuthController::class, 'registerUser'])->name('register-user');
Route::post("/login-user", [AAuthController::class, 'loginUser'])->name('login-user');
Route::get("/dashboard", [AAuthController::class, 'dashBoard'])->middleware('isLoggedIn');
Route::get("/logout", [AAuthController::class, 'logout']);
Route::get("/delete-user", [AAuthController::class, 'delete'])->name('setting-user');
Route::get("/edit-user", [AAuthController::class, 'editUser'])->name('setting-user');
// Route::get("/edit-cancel", [AuthController::class, 'cancelEdit'])->name('setting-user');



Route::get("/customers", [AdminPannel::class, 'customers']);

Route::get("/order/{id}", [AdminPannel::class, 'order_details']);

// Admin Pannel
Route::get("admin/login", [Authenticate::class, 'login']);

Route::post("/login-admin", [Authenticate::class, 'loginAdmin'])->name('login-admin');
Route::get("admin/adminpage", [Authenticate::class, 'user_page'])->middleware('isAdminUserLoggedIn');

Route::get("admin/customers", [Authenticate::class, 'customers'])->middleware('isAdminUserLoggedIn');

// Customer page
Route::get("admin/customer/{id}", [Authenticate::class, 'customer_details'])->middleware('isAdminUserLoggedIn');

// Admin- Customer order create page
Route::get("admin/customer/{id}/create/order", [Authenticate::class, 'admin_create_customer_order_page'])->middleware('isAdminUserLoggedIn');

// Admin- Customer create page
Route::get("admin/{id}/create/customer", [Authenticate::class, 'admin_create_customer_page'])->middleware('isAdminUserLoggedIn');

// Admin- Customer created
Route::post("/create-admin-customer", [Authenticate::class, 'admin_create_customer'])->name('create-admin-customer');

// Admin- Customer edit page
Route::get("admin/customer/{id}/edit", [Authenticate::class, 'admin_edit_customer_page'])->middleware('isAdminUserLoggedIn');

// Admin- Customer update
Route::post("/update-admin-customer/{id}", [Authenticate::class, 'admin_update_customer'])->name('update-admin-customer');

// Log Out Admin Pannel
Route::get("admin/logout", [Authenticate::class, 'logout']);