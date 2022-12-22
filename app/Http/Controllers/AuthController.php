<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Hash;
use Session;

class AuthController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
    // Registration
    public function registration() {
        return view("authentication.registration");
    }
    public function registerUser(Request $request) {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:users',
            'password' => 'required|min:5|max:15'
        ]);
        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $res = $user->save();

        // Sometimes you may wish to redirect the user to their previous location, such as when a submitted form is invalid. You may do so by using the global back
        // with is used to flash message after redirecting
        if($res) {
            return back()->with("success", "You have succesfully registered!");
        }
        else {
            return back()->with("fail", "Something went wrong.");
        }
        
    }
    // Login
    public function login() {
        return view("authentication.login");
    }
    public function loginUser(Request $request) {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        $user = User::where("email", $request->email)->first();
        if($user) {
            if(Hash::check($request->password, $user->password)){
                // To store data in the session, you will typically use the request instance's put method:
                $request->session()->put('logginId', $user->id);
                return redirect('dashboard');
            }else {
                return back()->with("fail", "Password is incorrect");
            }
        }else {
            return back()->with("fail", "This email is not registered");
        } 
    }
    public function dashBoard() {
        $data = array();
        if (Session::has('logginId')){
            $data = User::where('id', Session::get('logginId'))->first();
        }
        return view('dashboard', compact('data'));
    }
    public function logout(){
        if (Session::has('logginId')){
            // The pull method will retrieve and delete an item from the session in a single statement:
            Session::pull('logginId');
            return redirect('login');
        }
    }
    public function delete(Request $request){
        $delete_user = 0;
        if (Session::has('logginId') && $request->input('delete') == "True"){
            User::where('id', Session('logginId'))->delete();
            Session::pull('logginId');
            return redirect('login')->with("success", "User successfully deleted");
        }else {
            return back()->with("fail", "Try again")
        }
    }
}
