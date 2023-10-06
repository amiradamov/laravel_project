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

class CategoryController extends Controller
{
    /*
    *
    * ==========================================
    * CATEGORIES PAGE
    * ==========================================
    *
    */
    public function categories(Request $request) {
        $data = User::where('id', Session::get('administration_log'))->first();
        $user_type = UserType::where('id', User::where('id', Session::get('administration_log'))->value('id'))->value('user_type_name');

        $selectCategories= Category::all();

        $search = $request['categoryName'] ?? "";
        if ($search != "") {
            $categories = Category::where('category_name', 'LIKE', "%$search%")
            ->groupBy('id')
            ->paginate(10);
        }else {
            $categories = Category::groupBy('id')
            ->paginate(10);
        }

        return view("adminpanel/categories")
            ->with('selectCategories', $selectCategories)
            ->with('search', $search)
            ->with('categories', $categories)
            ->with('data', $data)
            ->with('user_type', $user_type);
    }

    /*
    *
    * ==========================================
    * CATEGORY_DETAIL PAGE
    * ==========================================
    *
    */
    public function category_details($id, Request $request) {
        $data = User::where('id', Session::get('administration_log'))->first();
        $user_type = UserType::where('id', User::where('id', Session::get('administration_log'))->value('id'))->value('user_type_name');
        $category = Category::find($id);
        
        $search = $request['search'] ?? "";
        if ($search != "") {
            $items = DB::table('items')
            ->selectRaw('items.*')
            ->where('item_name', 'LIKE', "%$search%")
            ->where('items.category_id', '=', $category->id)
            ->join('categories', 'items.category_id', '=', 'categories.id')
            ->orderBy('item_name', 'desc')
            ->paginate(10);
        }else {
            $items = DB::table('items')
            ->selectRaw('items.*')
            ->where('category_id', '=', $category->id)
            ->orderBy('item_name', 'desc')
            ->paginate(10);
        }

        return view("adminpanel/category")
        ->with('search', $search)
        ->with('data', $data)
        ->with('user_type', $user_type)
        ->with('items', $items)
        ->with('category', $category);
    }

    /*
    *
    * ==========================================
    * Admin- Category Create Page
    * ==========================================
    *
    */
    public function admin_create_category_page($id) {
        $data = User::where('id', Session::get('administration_log'))->first();
        $user_type = UserType::where('id', User::where('id', Session::get('administration_log'))->value('id'))->value('user_type_name');

        return view("adminpanel/create/admin_create_category")
        ->with('data', $data)
        ->with('user_type', $user_type);
    }

    public function admin_create_category(Request $request) {
        $request->validate([
            'image' => '|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'catname' => 'required|max:40',
            'description' => 'required',
        ]);

        // create images directory if it does not exist
        // if (!file_exists(public_path('images'))) {
        //     mkdir(public_path('images'), 0777, true);
        // }

        // Check if the image was uploaded
        // if ($request->hasFile('image')) {

        //     // store image in public directory
        //     $image = $request->file('image');
        //     $name = time().'.'.$image->getClientOriginalExtension();
        //     $image->move(public_path('images'), $name);
        //     $path = "/images/$name";
        // }

        $new_category = new Category();
        // if ($request->has('image')) {
        //     $new_customer->profile_image = $request->image;
        // }
        // if (!empty($path)) {
        //     $new_customer->profile_image = $path;
        // }
        $new_category->category_name = $request->catname;
        $new_category->description = $request->description;
        $res = $new_category->save();
        if($res) {
            return back()->with("success", "Category has succesfully created!");
        }
        else {
            return back()->with("fail", "Something went wrong.");
        }
    }
    /*
    *
    * ==========================================
    * Admin- Category Edit Page
    * ==========================================
    *
    */
    public function admin_edit_category_page($id) {
        $data = User::where('id', Session::get('administration_log'))->first();
        $user_type = UserType::where('id', User::where('id', Session::get('administration_log'))->value('id'))->value('user_type_name');

        $category = Category::where('id', $id)->first();
        return view("adminpanel/edit/admin_edit_category")
        ->with('data', $data)
        ->with('category', $category)
        ->with('user_type', $user_type);
    }

    public function admin_update_category(Request $request, $id) {
        if($request->input('submit') == 'submit'){

            $category = Category::where("id", $id)->first();
            $request->validate([
                'image' => '|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'catname' => 'required|max:40',
                'description' => 'required',
                'status',
            ]);

            // create images directory if it does not exist
            if (!file_exists(public_path('images'))) {
                    mkdir(public_path('images'), 0777, true);
            }

            // Check if the image was uploaded
            if ($request->hasFile('image')) {

                // store image in public directory
                if($customer->profile_image != null) {
                    if(Storage::disk('image')->exists($customer->profile_image) != null) {
                        Storage::disk('image')->delete($customer->profile_image);
                    }
                }
                // dd(Storage::didk('public'));
                $image = $request->file('image');
                $name = time().'.'.$image->getClientOriginalExtension();
                $image->move(public_path('images'), $name);
                $path = $name;
                Customer::where("id", $id)->update([
                    'profile_image' => $path,
                ]);
            }

            Category::where("id", $id)->update([
                'category_name' => $request->catname,
                'description' => $request->description,
            ]);
            
            if ($request->status == 1) {
                Category::where("id", $id)->update([
                    'category_status' => '1'
                ]);
                // dd($request->status);
            } elseif ($request->status == 0) {
                Category::where("id", $id)->update([
                    'category_status' => '0'
                ]);
                // dd($request->status);
            } 
            return back()->with("success", "Customer succesfuly updated.");
        } else {
            return back()->with("fail", "Something went wrong.");
        }
    }
}
