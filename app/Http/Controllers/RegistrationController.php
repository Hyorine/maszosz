<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\role_user;
use App\Models\Notification;
use App\Models\RankUser;
use App\Mail\UserRegistered;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;

class RegistrationController extends Controller
{
    public function index()
    {
        return view('main')->with('modul','reg');
    }
    public function show(Request $request)
    {
        $request->validate([
            'email' => 'required|email|unique:users',
            'username' => 'required|unique:users',
            'password' => [
                'required',
                'string',
                'min:8',
                'max:16',
                'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]/',
                'confirmed',
            ],
        ]);
        
        $token = Str::uuid();

        $user = User::create([
            'username' => $request->input('username'),
            'email' => $request->input('email'),
            'password' => bcrypt($request->input('password')),
            'confirmation_token' => $token 
        ]);
        role_user::create([
            'user_id' =>$user->id,
            'role_id' =>5,
        ]);
        RankUser::create([
            'rank_id' =>1,
            'user_id' => $user->id
        ]);
        Notification::create([
            'user_id' => $user->id
        ]);
        Mail::to($user->email)->send(new UserRegistered(__('messages.EmailSubbject1'),'emails/user_registered', $request->input('email'), $token ));
        return view('main')->with('modul','succes');
    }
    public function confirmRegistration($token)
    {
        // Find the user by token
        $user = User::where('confirmation_token', $token)->first();

        if (!$user) {
            // Handle invalid or expired token
            return view('main')->with('modul','error')->with('error',__('messages.errorConfirm'));
        }

        // Mark the user as confirmed
        $user->email_verified_at  = now();
        $user->confirmation_token = null; // Optional: Clear the token after confirmation
        $user->save();

        // Redirect to a success page or login page
        return view('main')->with('modul','succesReg');
    }
}