<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Customer;
use App\Models\Category;
use App\Models\Rating;
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
}
