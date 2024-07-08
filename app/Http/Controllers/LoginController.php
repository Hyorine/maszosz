<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\role_user;

class LoginController extends Controller
{
    public function index()
    {
        return view('main')->with('modul','login');
    }
    public function show(Request $request)
    {
        $credentials = $request->only('email', 'password');
        $loginField = filter_var($credentials['email'], FILTER_VALIDATE_EMAIL) ? 'email' : 'username';
    

        // Check if email is verified
        $user = User::where($loginField, $credentials['email'])->first();
    
        if ($user && $user->email_verified_at !== null) {
            // Attempt authentication
            if (Auth::attempt([$loginField => $credentials['email'], 'password' => $credentials['password']])) {
                // Authentication successful

                $userId = $user->id;
                $email = $user->email;
                $emailVerifiedAt = $user->email_verified_at;
            
                // Access and store user roles
                $userRoles = Auth::user()->roles; // Assuming you have a 'roles' relationship in your User model
                $roleNames = $userRoles->pluck('id')->toArray();
               
                // Store user information in the session
                session(['user_id' => $userId, 'email' => $email, 'email_verified_at' => $emailVerifiedAt, 'roles' => $roleNames]);
                

                return redirect('/');
            } else {
                // Authentication failed
                return redirect()->route('login')->with('error', __('messages.InvalidCredentials'));
            }
        } else {
            // Email is not verified
            return redirect()->route('login')->with('error', __('messages.EmailNotVerified'));
        }
    }
    public function logout(Request $request)
    {
        Auth::logout();

        return redirect('/');
    }
}