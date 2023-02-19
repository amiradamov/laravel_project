<?php

namespace App\Http\Controllers;

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

class Authenticate extends Controller
{
    public function login() {
        return view("adminpanel.authentication.login");
    }
    public function loginAdmin(Request $request) {
        $request->validate([
            'username' => 'required|min:5|max:15',
            'password' => 'required',
        ]);

        $user = User::where("user_username", $request->username)->first();
        if($user) {
            if($user->user_status = 1){
                if($request->password = $user->user_password){
                    $request->session()->put('logginId', $user->id);
                    return redirect('admin/adminpage');
                }else {
                    return back()->with('fail', "Password is incorrect");
                }
            }else {
                return back()->with('fail', "This user was banned");
            }
            
        }else {
            return back()->with('fail', "Accaunt not found");
        }

    }

  /*
  *
  * ==========================================
  * USER PAGE
  * ==========================================
  *
  */
    public function user_page(Request $request) {
        $data = array();
        if (Session::has('logginId')) {
            $data = User::where('id', Session::get('logginId'))->first();
            $user_type = UserType::where('id', User::where('id', Session::get('logginId'))->value('user_type_id'))->value('user_type_name');

        // Access for different type of users ///////////////////////
            if($user_type == 'admin'){
                $request->session()->put('user_admin', $user_type);
            }
            if($user_type == 'moderator'){
                $request->session()->put('user_moderator', $user_type);
            }
            if($user_type == 'editor'){
                $request->session()->put('user_editor', $user_type);
            }
        return view('adminpanel/user_page')
            ->with('data', $data)
            ->with('user_type', $user_type);
    }
}
  /*
  *
  * ==========================================
  * CUSTOMERS PAGE
  * ==========================================
  *
  */
    public function customers(Request $request) {
        $data = User::where('id', Session::get('logginId'))->first();
        $user_type = UserType::where('id', User::where('id', Session::get('logginId'))->value('id'))->value('user_type_name');

        $search = $request['search'] ?? "";
        if ($search != "") {
            $customers = Customer::where('customer_first_name', 'LIKE', "%$search%")
            ->orWhere('customer_last_name', 'LIKE', "%$search%")
            ->orWhere('email', 'LIKE', "%$search%")
            ->groupBy('id')
            ->paginate(10);
        }else {
            $customers = Customer::groupBy('id')
            ->paginate(10);
        }
        return view("adminpanel/customers")
            ->with('search', $search)
            ->with('customers', $customers)
            ->with('data', $data)
            ->with('user_type', $user_type);
    }
  
    /*
  *
  * ==========================================
  * CUSTOMER_DETAIL PAGE
  * ==========================================
  *
  */
    public function customer_details($id, Request $request) {
        $data = User::where('id', Session::get('logginId'))->first();
        $user_type = UserType::where('id', User::where('id', Session::get('logginId'))->value('id'))->value('user_type_name');
        $customer = Customer::find($id);
        
        $search = $request['search'] ?? "";
        if ($search != "") {
            $customers = DB::table('orders')
            ->selectRaw('customers.*, COUNT(orders.customer_id) as order_num')
            ->where('customer_first_name', 'LIKE', "%$search%")
            ->orWhere('customer_last_name', 'LIKE', "%$search%")
            ->orWhere('email', 'LIKE', "%$search%")
            ->join('customers', 'orders.customer_id', '=', 'customers.id')
            ->groupBy('id')
            ->paginate(10);
        }else {
            $customers = DB::table('orders')
            ->selectRaw('customers.*, COUNT(orders.customer_id) as order_num')
            ->join('customers', 'orders.customer_id', '=', 'customers.id')
            ->groupBy('id')
            ->paginate(10);
            // dd($customers);
        }

        return view("adminpanel/customer")
        ->with('search', $search)
        ->with('data', $data)
        ->with('user_type', $user_type)
        ->with('customer', $customer);
    }

  /*
  *
  * ==========================================
  * Admin- Customer Order Create Page
  * ==========================================
  *
  */
    public function admin_create_customer_order_page($id) {
        $data = User::where('id', Session::get('logginId'))->first();

        $user_type = UserType::where('id', User::where('id', Session::get('logginId'))->value('id'))->value('user_type_name');

        $customer = Customer::where('id', $id)->first();
        
        $categories = Category::all();

        $search = $request['search'] ?? "";
        if ($search != "") {
            $items = DB::table('items')
            ->selectRaw('items.item_name, items.item_price, items.item_image, items.item_status, items.item_description, categories.category_name')
            ->where('categoty_name', 'LIKE', "%$search%")
            ->join('categories', 'items.category_id', '=', 'categories.id')
            ->groupBy('items.item_name', 'items.item_price', 'items.item_image', 'items.item_status', 'items.item_description', 'categories.category_name')
            ->paginate(10);
        }else {
            $items = DB::table('items')
            ->selectRaw('items.item_name, items.item_price, items.item_image, items.item_status, items.item_description, categories.category_name')
            ->join('categories', 'items.category_id', '=', 'categories.id')
            ->groupBy('items.item_name', 'items.item_price', 'items.item_image', 'items.item_status', 'items.item_description', 'categories.category_name')
            ->paginate(10);
            // dd($customers);
        }
        $new_customer = new Customer();

        dd($new_customer);
        return view("adminpanel/create/admin_create_customer_order")
        ->with('data', $data)
        ->with('customer', $customer)
        ->with('categories', $categories)
        ->with('user_type', $user_type)
        ->with('search', $search)
        ->with('items', $items);
    }
  /*
  *
  * ==========================================
  * Admin- Customer Order Create Page - Selected category  * ==========================================
  *
  */
    public function admin_selected_category(Request $request, $id) {
        $data = User::where('id', Session::get('logginId'))->first();

        $user_type = UserType::where('id', User::where('id', Session::get('logginId'))->value('id'))->value('user_type_name');

        $customer = Customer::where('id', $id)->first();


    }
  /*
  *
  * ==========================================
  * Admin- Customer Create Page
  * ==========================================
  *
  */
    public function admin_create_customer_page($id) {
        $data = User::where('id', Session::get('logginId'))->first();
        $user_type = UserType::where('id', User::where('id', Session::get('logginId'))->value('id'))->value('user_type_name');

        return view("adminpanel/create/admin_create_customer")
        ->with('data', $data)
        ->with('user_type', $user_type);

    }

    public function admin_create_customer(Request $request) {
        $request->validate([
            'image' => '|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'firstname' => 'required|max:40',
            'lastname' => 'required|max:40',
            'username' => 'required|min:5|max:15',
            'email' => 'required|email|unique:users',
            'contact_number' => 'required|min:5|max:20',
            'address' => 'required',
            'new_password' => 'required|min:5|max:15|',
            'confirm_password' => 'required|min:5|max:15',
        ]);

        // create images directory if it does not exist
        if (!file_exists(public_path('images'))) {
            mkdir(public_path('images'), 0777, true);
        }
    
        // Check if the image was uploaded
        if ($request->hasFile('image')) {

            // store image in public directory
            $image = $request->file('image');
            $name = time().'.'.$image->getClientOriginalExtension();
            $image->move(public_path('images'), $name);
            $path = "/images/$name";
        }

        if($request->new_password == $request->confirm_password) {
            $new_customer = new Customer();
            
            if ($request->has('image')) {
                $new_customer->profile_image = $request->image;
            }
            if (!empty($path)) {

                $new_customer->profile_image = $path;
            }
            $new_customer->customer_first_name = $request->firstname;
            $new_customer->customer_last_name = $request->lastname;
            $new_customer->customer_username = $request->username;
            $new_customer->email = $request->email;
            $new_customer->customer_phone_number = $request->contact_number;
            $new_customer->address = $request->address;
            $new_customer->address = $request->address;
            $new_customer->customer_password = Hash::make($request->confirm_password);
            $res = $new_customer->save();
            if($res) {
                return back()->with("success", "You have succesfully registered!");
            }
            else {
                return back()->with("fail", "Something went wrong.");
            }
        } else {
            return back()->with("fail", "Password does not match.");
        }
    }
  /*
  *
  * ==========================================
  * Admin- Customer Edit Page
  * ==========================================
  *
  */
    public function admin_edit_customer_page($id) {
        $data = User::where('id', Session::get('logginId'))->first();
        $user_type = UserType::where('id', User::where('id', Session::get('logginId'))->value('id'))->value('user_type_name');

        $customer = Customer::where('id', $id)->first();
        return view("adminpanel/edit/admin_edit_customer")
        ->with('data', $data)
        ->with('customer', $customer)
        ->with('user_type', $user_type);
    }

    public function admin_update_customer(Request $request, $id) {
        if($request->input('submit') == 'submit'){
    
            $customer = Customer::where("id", $id)->first();
            $request->validate([
                'image' => '|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
                'firstname' => 'required|max:40',
                'lastname' => 'required|max:40',
                'username' => 'required|min:5|max:15',
                'email' => [
                    'required','nullable','string','email','max:255',
                    Rule::unique('customers')->ignore($customer->id),
                ],
                'contact_number' => 'required|min:5|max:20',
                'address' => 'required',
                'new_password' => 'nullable|min:5|max:15|confirmed',
                'confirm_password' => 'nullable|min:5|max:15',
                'status',
            ]);

            // create images directory if it does not exist
            if (!file_exists(public_path('images'))) {
                    mkdir(public_path('images'), 0777, true);
            }

            // Check if the image was uploaded
            if ($request->hasFile('image')) {

                // store image in public directory
                if(File::exists('/images'.$customer->profile_image)) {
                    File::delete('/images'.$customer->profile_image);
                }
                $image = $request->file('image');
                $name = time().'.'.$image->getClientOriginalExtension();
                $image->move(public_path('images'), $name);
                $path = "/images/$name";
                Customer::where("id", $id)->update([
                    'profile_image' => $path,
                ]);
            }

            // Check email
            if ($request->has('email')) {
                Customer::where("id", $id)->update([
                    'email' => $request->email,
                ]);
            }

            if($request->new_password == $request->confirm_password) {
                Customer::where("id", $id)->update([
                    'customer_first_name' => $request->firstname,
                    'customer_last_name' => $request->lastname,
                    'customer_username' => $request->username,
                    'customer_phone_number' => $request->contact_number,
                    'address' => $request->address,
                    'customer_password' => Hash::make($request->confirm_password),
                ]);
                if($request->status == 'on') {
                    Customer::where("id", $id)->update([
                        'customer_status' => '1'
                    ]);
                } else {
                    Customer::where("id", $id)->update([
                        'customer_status' => '0'
                    ]);
                }
                return back()->with("success", "Customer succesfuly updated.");
            } else {
                return back()->with("fail", "Password does not match.");
            }
        } else {
            return back()->with("fail", "Something went wrong.");
        }
    }

  /*
  *
  * ==========================================
  * Lot Out
  * ==========================================
  *
  */
    public function logout() {
        if(Session::has('logginId')) {
            Session::pull('logginId');
            return redirect('admin/login');
        }
    }
}
