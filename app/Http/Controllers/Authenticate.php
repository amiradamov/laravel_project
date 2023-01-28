<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
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

    // USER PAGE ///////////////////////////////////////////////
    public function user_page(Request $request) {
        $data = array();
        if (Session::has('logginId')) {
            $data = User::where('id', Session::get('logginId'))->first();
            $user_type = UserType::where('id', User::where('id', Session::get('logginId'))->value('id'))->value('user_type_name');

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
    // CUSTOMERS PAGE ///////////////////////////////////////////////
    public function customers(Request $request) {
        $data = User::where('id', Session::get('logginId'))->first();
        $user_type = UserType::where('id', User::where('id', Session::get('logginId'))->value('id'))->value('user_type_name');

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
        return view("adminpanel/customers")
            ->with('search', $search)
            ->with('customers', $customers)
            ->with('data', $data)
            ->with('user_type', $user_type);
    }
    // CUSTOMER_DETAIL PAGE ///////////////////////////////////////////////
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

    // Lot Out ////////////////////////////////////////////////
    public function logout() {
        if(Session::has('logginId')) {
            Session::pull('logginId');
            return redirect('admin/login');
        }
    }
}
