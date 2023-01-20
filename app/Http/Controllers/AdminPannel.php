<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Ingredient;
use App\Models\Customer;
use App\Models\Category;
use App\Models\Rating;
use App\Models\Order;
use App\Models\User;
use App\Models\Item;


class AdminPannel extends Controller
{
    public function show($id) {
        $category = Category::find($id);
        // dd($category);
        return view("category")->with('category', $category);
    }
    public function customers() {
        $user = User::all();
        $customers = Customer::all();
        return view("adminpanel/customers")->with('customers', $customers);
    }
    public function customer_details($id) {
          
        $customer = Customer::find($id);
        // $orders = Order::where('customer_id', $id)->get();
        return view("adminpanel/customer")
        ->with('customer', $customer);
    }
    public function order_details($id) {
        $order = Order::find($id);

        return view("adminpanel/order")
        ->with('order', $order);
    }
}
