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
                    return redirect('/customers');
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
}
