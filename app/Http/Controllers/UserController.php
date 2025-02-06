<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
class UserController extends Controller
{
    //


    public function home(){

        return view('home');
    }

	public function login(Request $request)
    {

        //dd($request->all());
        // Validate the form input
        $request->validate([
            'email' => 'required|email',
            'password' => 'required|min:4',
        ]);
        if(Auth::attempt([
            'email' => $request->email,
            'password' => $request->password,
            ], $request->remember)){
            return view('home');
        }
         echo "login failed"; die(); 
        //dd($request->all());
        
    }
    public function upload_data(){

    	return view('upload');
    }
    public function scroll_message(){
    	return view('scroll_message');
    }
    public function users_view(){
    	return view('users_view');
    }
    public function login_activity(){

    	return view('login_activity');
    }
    public function report_show(){
        return view('report');
    }
}
