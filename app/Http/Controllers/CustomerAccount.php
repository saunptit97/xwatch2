<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Session;
use App\User;
use App\Bill;
class CustomerAccount extends Controller
{
    public function index(){
        $bills = Bill::where('id_user', Session::get('user')->id)->get(); 
        return view('frontend.pages.user', ['bills' => $bills]);
    }
    public function logout(){
        Session::forget('user');
        return redirect()->route('home');
    }
    public function login(Request $request){
        $username = $request['username'];
        $password = $request['password'];
        $user = User::where('username', $username)->where('password', $password)->first();
        if($user){
            Session::put('user', $user);
            return response()->json(['success' => true, 
                'data' => $username
            ]);
        }else{
            return response()->json(['success' => false]);
        }
        
    }
}
