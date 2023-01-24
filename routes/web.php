<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AAuthController;
use App\Http\Controllers\AdminPannel;
use App\Http\Controllers\Authenticate;
use App\Models\Item;
use App\Models\Category;
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

// Route::get("/category", function() {
//     Category::create(['category_name' => 'fruits', 
//     'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 
//     'category_status' => 1]);
// });
// Route::get("/items", function() {
//     Item::create(['item_name' => 'hotdog', 
//     'item_price' => 4.99,
//     'category_id' =>1, 
//     'item_status' => 1]);
// });


Route::get("/customers", [AdminPannel::class, 'customers']);
Route::get("/customer/{id}", [AdminPannel::class, 'customer_details']);
Route::get("/order/{id}", [AdminPannel::class, 'order_details']);

// Admin Pannel
Route::get("admin/login", [Authenticate::class, 'login']);
Route::post("/login-admin", [Authenticate::class, 'loginAdmin'])->name('login-admin');
Route::get("admin/adminpage", [Authenticate::class, 'user_page'])->middleware('isAdminUserLoggedIn');
Route::get("admin/customers", [Authenticate::class, 'customers'])->middleware('isAdminUserLoggedIn');
// Log Out Admin Pannel
Route::get("admin/logout", [Authenticate::class, 'logout']);