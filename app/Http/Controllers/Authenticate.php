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
                if($request->password == $user->user_password){
                    $request->session()->put('administration_log', $user->id);
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
  *Ж
  * ==========================================
  * USER PAGE
  * ==========================================
  *
  */
    public function user_page(Request $request) {
        $data = array();
        if (Session::has('administration_log')) {
            $data = User::where('id', Session::get('administration_log'))->first();
            $user_type = UserType::where('id', User::where('id', Session::get('administration_log'))->value('user_type_id'))->value('user_type_name');

        // Access for different type ~of users ///////////////////////
            if($user_type == 'admin'){
                $request->session()->put('user_admin', $user_type);
            }
            if($user_type == 'moderator'){
                $request->session()->put('user_moderator', $user_type);
            }
            if($user_type == 'editor'){
                $request->session()->put('user_editor', $user_type);
            }

        // dd($request->session()->has('user_moderator'));
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
        $data = User::where('id', Session::get('administration_log'))->first();
        $user_type = UserType::where('id', User::where('id', Session::get('administration_log'))->value('id'))->value('user_type_name');

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
        $data = User::where('id', Session::get('administration_log'))->first();
        $user_type = UserType::where('id', User::where('id', Session::get('administration_log'))->value('id'))->value('user_type_name');
        $customer = Customer::find($id);
        $statusTypes = ['Pending', 'Failed', 'Success'];

        $statusFilter = $request->input('statusType'); // Get the selected status filter
        $dateFilter = $request->input('date'); // Get the selected date filter

        $search = $request['search'] ?? "";
        $selectStatus = $request['statusType'] ?? "";
        if ($search != "") {
            $ordersQuery = DB::table('orders')
                ->selectRaw('orders.id as order_id, orders.order_status, customers.id as customer_id, customers.*, COUNT(orders.customer_id) as order_num, users.name as user_name')
                ->where('customer_id', 'LIKE', "%$customer->id%")
                ->where('orders.id', 'LIKE', "%$search%")
                ->join('customers', 'orders.customer_id', '=', 'customers.id')
                ->join('users', 'orders.proccessed_by', '=', 'users.id')
                ->groupBy('order_id', 'customer_id');
    
            // Apply the status filter if selected
            if ($statusFilter) {
                $ordersQuery->where('orders.order_status', '=', $this->getStatusValue($statusFilter));
            }
    
            // Apply the date filter if selected
            if ($dateFilter) {
                $ordersQuery->whereDate('orders.created_at', '=', $dateFilter);
            }
    
            $orders = $ordersQuery->paginate(10);
        } else {
            $ordersQuery = DB::table('orders')
                ->selectRaw('orders.id as order_id, orders.order_status, customers.id as customer_id, customers.*, COUNT(orders.customer_id) as order_num, users.name as user_name')
                ->where('customer_id', 'LIKE', "%$customer->id%")
                ->join('customers', 'orders.customer_id', '=', 'customers.id')
                ->join('users', 'orders.proccessed_by', '=', 'users.id')
                ->groupBy('order_id', 'customer_id');
    
            // Apply the status filter if selected
            if ($statusFilter) {
                $ordersQuery->where('orders.order_status', '=', $this->getStatusValue($statusFilter));
            }
    
            // Apply the date filter if selected
            if ($dateFilter) {
                $ordersQuery->whereDate('orders.created_at', '=', $dateFilter);
            }
    
            $orders = $ordersQuery->paginate(10);
        }
    
        // ... (existing code)
    
        return view("adminpanel/customer")
            ->with('statusTypes', $statusTypes)
            ->with('search', $search)
            ->with('dateFilter', $dateFilter)
            ->with('selectStatus', $selectStatus)
            ->with('data', $data)
            ->with('orders', $orders)
            ->with('user_type', $user_type)
            ->with('customer', $customer);
    }
    
    // Helper function to get the order status value based on the selected status type
    private function getStatusValue($statusType) {
        switch ($statusType) {
            case 'Pending':
                return 1;
            case 'Failed':
                return 0;
            case 'Success':
                return 2;
            default:
                return null; // You can handle other cases as needed
        }
    }

  /*
  *
  * ==========================================
  * Admin- Customer Order Create Page
  * ==========================================
  *
  */
    public function admin_create_customer_order_page($id, Request $request) {
        $data = User::where('id', Session::get('administration_log'))->first();

        $user_type = UserType::where('id', User::where('id', Session::get('administration_log'))->value('id'))->value('user_type_name');

        $customer = Customer::where('id', $id)->first();
        
        $categories = Category::all();

        $search_item = $request['search_item'] ?? "";
        if ($search_item != "") {
            $items = DB::table('items')
            ->selectRaw('items.*, categories.*')
            ->where('item_name', 'LIKE', "%$search_item%")
            ->orWhere('categories.category_name', 'LIKE', "%$search_item%")
            ->join('categories', 'items.category_id', '=', 'categories.id')
            ->orderBy('item_name', 'desc')
            ->paginate(10);
        }else {
            $items = DB::table('items')
            ->selectRaw('items.*')
            ->orderBy('item_name', 'desc')
            ->paginate(10);
        }
        return view("adminpanel/create/admin_create_customer_order")
        ->with('data', $data)
        ->with('customer', $customer)
        ->with('categories', $categories)
        ->with('user_type', $user_type)
        ->with('search_item', $search_item)
        ->with('items', $items);
    }
    
  /*
  *
  * ==========================================
  * Admin- Customer Order Create Page - Add to cart  
  * ==========================================
  *
  */
  public function add_to_cart(Request $request)
  {
      $itemId = $request->input('id');
  
      $item = Item::find($itemId);
  
      if (!$item) {
        abort(404);
      }
  
      $cart = session()->get('cart');

      // if cart is empty then this the first product
      if (!$cart) {
          $cart = [
              $itemId => [
                  'name' => $item->item_name,
                  'price' => $item->item_price,
                  'category' => Category::where('id', $item->category_id)->value('category_name'),
                  'description' => $item->item_description,
                  'image' => $item->item_image,
                  'ingredients' => $item->item_ingredients,
                  'quantity' => 1,
              ]
          ];
      } else {
          if (isset($cart[$itemId])) {
              $cart[$itemId]['quantity']++;
          } else {
              $cart[$itemId] = [
                  'name' => $item->item_name,
                  'price' => $item->item_price,
                  'category' => Category::where('id', $item->category_id)->value('category_name'),
                  'description' => $item->item_description,
                  'image' => $item->item_image,
                  'ingredients' => $item->item_ingredients,
                  'quantity' => 1,
              ];
          }
      }
  
      session()->put('cart', $cart);
      $cartCount = array_sum(array_column($cart, 'quantity'));
      return response()->json(['success' => 'Item added to cart successfully.', 'cartCount' => $cartCount, 'name' => $item->item_name]);
  }
  
  /*
  *
  * ==========================================
  * Admin- Customer Create Page
  * ==========================================
  *
  */
    public function admin_create_customer_page($id) {
        $data = User::where('id', Session::get('administration_log'))->first();
        $user_type = UserType::where('id', User::where('id', Session::get('administration_log'))->value('id'))->value('user_type_name');

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
            $path = $name;
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
        $data = User::where('id', Session::get('administration_log'))->first();
        $user_type = UserType::where('id', User::where('id', Session::get('administration_log'))->value('id'))->value('user_type_name');

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
                if ($request->status == 1) {
                    Customer::where("id", $id)->update([
                        'customer_status' => 1
                    ]);
                    // dd($request->status);
                } elseif ($request->status == 0) {
                    Customer::where("id", $id)->update([
                        'customer_status' => 0
                    ]);
                    // dd($request->status);
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
        if(Session::has('administration_log')) {
            Session::flush();
            return redirect()->route('admin-login');
        }
    }
}
