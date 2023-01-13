<?php

namespace App\Http\Controllers;

use Illuminate\Http\Ingredient;
use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Category;
use App\Models\Rating;
use App\Models\Order;
use App\Models\Item;


class AdminPannel extends Controller
{
    public function show($id)
    {
        $category = Category::find($id);
        // dd($category);
        return view("category")->with('category', $category);
    }
    public function rating() {
        $rating = Rating::find(1);  
        $item = Item::find(2);
        // dd($item);
        return view("category")->with('item', $item);
    }
    public function ingredient() {
        $item = Item::find(2);
        // dd($item);
        return view("category")->with('item', $item);
    }
    public function order() {
        $order = Order::find(1);
        // dd($item);
        return view("category")->with('order', $order);
    }
    public function customers() {
        $customers = Customer::all();
        return view("adminpanel/customers")->with('customers', $customers);
    }
    public function customer_details($id) {
        $customer = Customer::find($id);
        return view("adminpanel/customer")->with('customer', $customer);
    }
}
