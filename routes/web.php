<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\AdminPannel;
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

Route::get("/login", [AuthController::class, 'login']);
Route::get("/registration", [AuthController::class, 'registration']);
Route::post("/register-user", [AuthController::class, 'registerUser'])->name('register-user');
Route::post("/login-user", [AuthController::class, 'loginUser'])->name('login-user');
Route::get("/dashboard", [AuthController::class, 'dashBoard'])->middleware('isLoggedIn');
Route::get("/logout", [AuthController::class, 'logout']);
Route::get("/delete-user", [AuthController::class, 'delete'])->name('setting-user');
Route::get("/edit-user", [AuthController::class, 'editUser'])->name('setting-user');
// Route::get("/edit-cancel", [AuthController::class, 'cancelEdit'])->name('setting-user');

Route::get("/category", function() {
    Category::create(['category_name' => 'fruits', 
    'description' => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.', 
    'category_status' => 1]);
});
Route::get("/items", function() {
    Item::create(['item_name' => 'hotdog', 
    'item_price' => 4.99,
    'category_id' =>1, 
    'item_status' => 1]);
});

Route::get("/category/{id}", [AdminPannel::class, 'show']);
Route::get("/rating", [AdminPannel::class, 'rating']);
Route::get("/ingredient", [AdminPannel::class, 'ingredient']);
Route::get("/order", [AdminPannel::class, 'order']);
Route::get("/customers", [AdminPannel::class, 'customers']);
Route::get("/customer/{id}", [AdminPannel::class, 'customer_details']);