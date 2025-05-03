<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{   

    //Registration View page Function
    public function registrationPage(){
        return (view('Auth.register'));
    }
      
    // New Customer Registration Function
    public function register(Request $request){
        $validateData = $request->validate([
            'name' => 'required|string|max:50',
            'email' => 'required|email|max:50|unique:users,email', // Fixed validation syntax
            'password' => 'required|confirmed', // Fixed validation syntax
        ]);

        User::create([
            'name' => $validateData['name'],
            'email' => $validateData['email'],
            'password' => $validateData['password'],
        ]);

        Auth::attempt($request->only('email', 'password'));
        return redirect()->route('dashboard')->with('status', 'Registration Successful');
    }

    //Login View page Function
    public function loginPage(){
        return (view('Auth.login'));
    }
    //Login Function
    public function login(Request $request){
        $validateData = $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if(!Auth::attempt($request->only('email', 'password'))){
            return redirect()->back()->with('status', 'Invalid Credentials');
        }
        return redirect()->route('dashboard');
    }

    //Dashboard Function
    public function dashboard(){
        $user_id = Auth::user()->id;

        $categoriesCount = Category::where('user_id', $user_id)->count();
        $postsCount = Post::where('user_id', $user_id)->count();
        return view('admin.dashboard', compact('categoriesCount', 'postsCount'));
    }

    //Logout Function
    public function logout(){
        Auth::logout();
        return redirect()->route('login');
    }



}
