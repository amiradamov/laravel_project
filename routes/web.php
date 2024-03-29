<?php

use App\Http\Controllers\OrderController;
use App\Http\Controllers\AAuthController;
use App\Http\Controllers\ItemController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\Authenticate;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminPannel;
use Illuminate\Support\Facades\DB;
use App\Models\Category;
use App\Models\UserType;
use App\Models\Customer;
use App\Models\Order;
use App\Models\Item;
use App\Models\User;

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

// Route::get("/login", [AAuthController::class, 'login']);
// Route::get("/registration", [AAuthController::class, 'registration']);
// Route::post("/register-user", [AAuthController::class, 'registerUser'])->name('register-user');
// Route::post("/login-user", [AAuthController::class, 'loginUser'])->name('login-user');
// Route::get("/dashboard", [AAuthController::class, 'dashBoard'])->middleware('isLoggedIn');
// Route::get("/logout", [AAuthController::class, 'logout']);
// Route::get("/delete-user", [AAuthController::class, 'delete'])->name('setting-user');
// Route::get("/edit-user", [AAuthController::class, 'editUser'])->name('setting-user');
// Route::get("/edit-cancel", [AuthController::class, 'cancelEdit'])->name('setting-user');


Route::get("/customers", [AdminPannel::class, 'customers']);

Route::get("/order/{id}", [AdminPannel::class, 'order_details']);

// Admin Pannel
Route::get("admin/login", [Authenticate::class, 'login'])->name('admin-login');

Route::post("/login-admin", [Authenticate::class, 'loginAdmin'])->name('login-admin');
Route::get("admin/adminpage", [Authenticate::class, 'user_page'])->middleware('isAdminUserLoggedIn');

Route::get("admin/customers", [Authenticate::class, 'customers'])->middleware('isAdminUserLoggedIn',);

// Customer page
Route::get("admin/customer/{id}", [Authenticate::class, 'customer_details'])->middleware('isAdminUserLoggedIn');

// Admin- Customer order create page
Route::get("admin/customer/{id}/order", [Authenticate::class, 'admin_create_customer_order_page'])->middleware('isAdminUserLoggedIn');

// Admin- Customer order create page - Add to cart
Route::post('add-to-cart', [Authenticate::class, 'add_to_cart'])->name('cart_add');

// Admin- Customer create page
Route::get("admin/{id}/create/customer", [Authenticate::class, 'admin_create_customer_page'])->middleware('isAdminUserLoggedIn');

// Admin- Customer created
Route::post("/create-admin-customer", [Authenticate::class, 'admin_create_customer'])->name('create-admin-customer');

// Admin- Customer edit page
Route::get("admin/customer/{id}/edit", [Authenticate::class, 'admin_edit_customer_page'])->middleware('isAdminUserLoggedIn');

// Admin- Customer update
Route::post("/update-admin-customer/{id}", [Authenticate::class, 'admin_update_customer'])->name('update-admin-customer');

// Log Out Admin Pannel
Route::get("admin/logout", [Authenticate::class, 'logout'])->name('logout');


/////////////////// CategoryController
// Cateogiries page
Route::get("admin/categories", [CategoryController::class, 'categories'])->middleware('isAdminUserLoggedIn');

// Category page
Route::get("admin/category/{id}", [CategoryController::class, 'category_details'])->middleware('isAdminUserLoggedIn');

// Admin- Category edit page
Route::get("admin/category/{id}/edit", [CategoryController::class, 'admin_edit_category_page'])->middleware('isAdminUserLoggedIn');

// Admin- Category update
Route::post("/update-admin-category/{id}", [CategoryController::class, 'admin_update_category'])->name('update-admin-category');

// Admin- Category create page
Route::get("admin/{id}/create/category", [CategoryController::class, 'admin_create_category_page'])->middleware('isAdminUserLoggedIn');

// Admin- Category created
Route::post("/create-admin-category", [CategoryController::class, 'admin_create_category'])->name('create-admin-category');


/////////////////// ItemCotroller
// Items
Route::get("admin/items", [ItemController::class, 'items'])->middleware('isAdminUserLoggedIn');
// Create New Item
Route::get("admin/{id}/create/item", [ItemController::class, 'admin_create_item_page'])->middleware('isAdminUserLoggedIn');
// Admin- Item created
Route::post("/create-admin-item", [ItemController::class, 'admin_create_item'])->name('create-admin-item');


/////////////////// Order
Route::get("admin/orders", [OrderController::class, 'orders'])->middleware('isAdminUserLoggedIn');






























Route::get('/createrecords', function() {
    $usertypes = array('admin', 'moderator', 'editor', 'monitor');
    // foreach ($usertypes as $usertype) {
    //     userType::create(['user_type_name' => $usertype,
    // 'user_type_status' => 1]);
    // };
    User::create([
        'name' => 'Zagir Adamov',
        'email' => 'zagir@adamov.net.ru',
        'user_type_id' => 2,
        'user_phone_number' => '+994505040122',
        'address' => 'xxxxx xxxx xxxx',
        'user_username' => 'zagir_adamov',
        'user_password' => 'zagir123',    
    ]);
    // $names = array('Togrul', 'Ibrahim', 'Sadig');
    // $lnames = array('Asadov', 'Mammadli', 'Latifli');
    // $emails = array('togrul@xxx.xxx.xx', 'ibrahim@xxx.xxx.xxx', 'sadig@xxx.xxx.xxx');
    // $phones = array('3 721 234-56-78', '+4 123 456-78-90', '+7 996 420-59-22');
    // $usernames = array('togrul_asadov', 'ibrahim_mammadli', 'sadig_latifli');
    // $passwords = array('togrul123', 'ibrahim123', 'sadig123');
    // for ($i=0; $i < 3; $i++) { 
    //     Customer::create([
    //         'customer_first_name' => $names[$i],
    //         'customer_last_name' => $lnames[$i],
    //         'email' => $emails[$i],
    //         'customer_phone_number' => $phones[$i],
    //         'customer_username' => $usernames[$i],
    //         'customer_password' => $passwords[$i],        ]);
    // };
    // $cats = array('fast food', 'hot meal', 'drinks');
    // foreach ($cats as $cat) {
    //     Category::create([
    //         'category_name' => $cat,
    //         'description' => 'vkusno i tochka.',
    //     ]);
    // };
    // $name = array('hotdog', 'doner', 'shawarma', 'cola', 'sprite', 'dolma', 'hinkal');
    // $price = array('3.99', '3.99', '3.99', 1, 1, '7.99', '6.99');
    // $description = array('A hot dog is a type of sausage that is typically served in a long bun with various condiments such as ketchup, mustard, and relish. It is a popular fast food and street food in many countries and is often associated with sports events and outdoor gatherings.', 'Doner (also spelled döner) is a Turkish dish consisting of meat that is cooked on a vertical rotisserie, sliced thin, and served in a pita or wrap with vegetables and sauces. It is a popular fast food in many countries and has become a staple of street food culture.', 'Shawarma is a Middle Eastern dish made of meat that is grilled on a spit, shaved off, and served in a pita or wrap with vegetables and sauces. It is similar to the Turkish döner kebab and has become popular worldwide as a fast food and street food.', 'carbonated soft drink flavored with a combination of vanilla, cinnamon, citrus, and other flavorings. It is one of the most popular beverages in the world, with a long history dating back to the 19th century.', 'Sprite is a lemon-lime flavored soft drink that was first introduced by The Coca-Cola Company in 1961. It is caffeine-free and is known for its clear, bubbly appearance and refreshing taste.', 'Dolma is a family of stuffed vegetable dishes common in the Middle East and Mediterranean cuisine. The word dolma means "stuffed" in Turkish, and the dish typically involves stuffing vegetables like grape leaves, bell peppers, and tomatoes with a filling made of rice, vegetables, and/or ground meat.', 'Hinkal is a traditional Dagestanian dish that consists of boiled dumplings filled with spiced meat, potatoes, or cheese, and served with a sauce made from sour cream or yogurt. It is a popular comfort food in Georgia and is often eaten with friends and family at special occasions.');
    // $cat = array(1, 1, 1, 3, 3, 2, 2);
    // for ($i=0; $i < 7; $i++) {
    //     Item::create(['item_name' => $name[$i], 
    //     'item_price' => $price[$i],
    //     'category_id' =>$cat[$i],
	//    'item_description' =>$description[$i],
    //     ]);
    // };
    // $customers_ids = array(1, 2, 3, 1, 2, 3, 1, 2, 3);
    // $total_amounts = array(10, 12, 14, 15, 15, 10, 8, 14, 10);
    // for ($i=0; $i < 9; $i++) {
    //     Order::create(['customer_id' => $customers_ids[$i],
    //     'total_amount' => $total_amounts[$i], 'proccessed_by' => 1]);
    // };
});
