<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;
use Illuminate\Validation\Rule;
use Illuminate\Http\Request;
use App\Models\Ingredient;
use App\Models\Customer;
use App\Models\Category;
use App\Models\UserType;
use App\Models\Rating;
use App\Models\Order;
use App\Models\User;
use App\Models\Item;
use Session;
use Hash;

class ItemController extends Controller
{
  /*
  *
  * ==========================================
  * ITEMS PAGE
  * ==========================================
  *
  */
  public function items(Request $request) {
    $data = User::where('id', Session::get('administration_log'))->first();
    $user_type = UserType::where('id', User::where('id', Session::get('administration_log'))->value('id'))->value('user_type_name');

    $categories = Category::where('category_status', '1')->get();
    $search = $request['productType'] ?? "";
    if ($search != "") {
        $items = DB::table('items')
        ->selectRaw('items.*, categories.*')
        ->where('item_name', 'LIKE', "%$search%")
        ->where('category_status', 'LIKE', "1")
        ->orWhere('categories.category_name', 'LIKE', "%$search%")
        ->join('categories', 'items.category_id', '=', 'categories.id')
        ->orderBy('item_name', 'desc')
        ->paginate(10);
    }else {
        $items = DB::table('items')
        ->selectRaw('items.*, categories.*')
        ->where('category_status', 'LIKE', "1")
        ->join('categories', 'items.category_id', '=', 'categories.id')
        ->orderBy('item_name', 'desc')
        ->paginate(10);
    }
    // dd($search);

    return view("adminpanel/items")
        ->with('search', $search)
        ->with('items', $items)
        ->with('data', $data)
        ->with('categories', $categories)
        ->with('user_type', $user_type);
}

  /*
  *
  * ==========================================
  * Admin- Item Create Page
  * ==========================================
  *
  */
  public function admin_create_item_page($id) {
    $data = User::where('id', Session::get('administration_log'))->first();
    $user_type = UserType::where('id', User::where('id', Session::get('administration_log'))->value('id'))->value('user_type_name');
    $categories = Category::all();

    return view("adminpanel/create/admin_create_item")
    ->with('data', $data)
    ->with('user_type', $user_type)
    ->with('categories', $categories);

}

public function admin_create_item(Request $request) {
    // dd($request->productType);
    $request->validate([
        'image' => '|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        'item_name' => 'required|max:40',
        'item_price' => 'required|max:40',
        'productType' => 'required',
        'item_description' => 'required',
    ]);

    // create images directory if it does not exist
    if (!file_exists(public_path('item_images'))) {
        mkdir(public_path('item_images'), 0777, true);
    }

    // Check if the image was uploaded
    if ($request->hasFile('image')) {

        // store image in public directory
        $image = $request->file('image');
        $name = time().'.'.$image->getClientOriginalExtension();
        $image->move(public_path('item_images'), $name);
        $path = $name;
    }

    $new_item = new Item();
    if ($request->has('image')) {
        $new_item->item_image = $request->image;
    }
    if (!empty($path)) {
        $new_item->item_image = $path;
    }
    $new_item->item_name = $request->item_name;
    $new_item->item_price = $request->item_price;
    $new_item->item_description = $request->item_description;
    $new_item->category_id = $request->productType;
    $res = $new_item->save();
    if($res) {
        return back()->with("success", "Item has succesfully created!");
    }
    else {
        return back()->with("fail", "Something went wrong.");
    }
}
}