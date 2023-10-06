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

class OrderController extends Controller
{
    public function orders(Request $request) {
        $data = User::where('id', Session::get('administration_log'))->first();
        $user_type = UserType::where('id', User::where('id', Session::get('administration_log'))->value('id'))->value('user_type_name');

        $customers = Customer::get();
        $statusTypes = ['Pending', 'Failed', 'Success'];

        $statusFilter = $request->input('statusType'); // Get the selected status filter
        $dateFilter = $request->input('date'); // Get the selected date filter

        $search = $request['search'] ?? "";
        $selectStatus = $request['statusType'] ?? "";
        if ($search != "") {
            $ordersQuery = DB::table('orders')
                ->selectRaw('orders.id as order_id, orders.order_status, customers.id as customer_id, customers.*, COUNT(orders.customer_id) as order_num, users.name as user_name')
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

        return view("adminpanel/orders")
            ->with('statusTypes', $statusTypes)
            ->with('search', $search)
            ->with('dateFilter', $dateFilter)
            ->with('selectStatus', $selectStatus)
            ->with('data', $data)
            ->with('orders', $orders)
            ->with('user_type', $user_type)
            ->with('customers', $customers);
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
}
