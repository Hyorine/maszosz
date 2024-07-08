<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Notification;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function show()
    {
        $user = Auth::user();

        return view('main', ['modul' => 'profil', 'profilContent' => 'information' ,  'user' => $user]);
    }
    public function notification()
    {
        $notifications = Notification::where('user_id', auth()->id())->first();
        return view('main', ['modul' => 'profil', 'profilContent' => 'notification', 'notifications' => $notifications ]);
    }
    public function helper(Request $request)
    {
        $request->validate([
            'profilOperation' => 'required|integer', 
        ]);
        switch ($request->profilOperation) {
            case 1:
                $request->validate([
                    'newUsername' => 'required|string|max:255|unique:users,username',
                    'password' => 'required|string',
                ]);
                $user = Auth::user();
                if (!Hash::check($request->password, $user->password)) {
                    return back()->withErrors(['password' => 'A megadott jelszó helytelen.']);
                }
                $Iuser = User::find($user->id);
                $Iuser->username  = $request->newUsername;
                $Iuser->save();
                
                return view('main', ['modul' => 'profil', 'profilContent' => 'information' ,  'user' => $user]);
                break;
            case 2:
                
                $request->validate([
                    'currentPassword' => 'required|string',
                    'newPassword' => [
                        'required',
                        'string',
                        'min:8',
                        'max:16',
                        'regex:/^(?=.*[a-z])(?=.*[A-Z])(?=.*\d)(?=.*[@$!%*?&])[A-Za-z\d@$!%*?&]{8,16}$/',
                    ],
                    'confirmPassword' => 'required|same:newPassword',
                ]);
                $user = Auth::user();
                if (!Hash::check($request->currentPassword, $user->password)) {
                    return back()->withErrors(['currentPassword' => 'A megadott jelenlegi jelszó helytelen.']);
                }

                // Jelszó frissítése
                $user->password = Hash::make($request->newPassword);
                $user->save();
                return view('main', ['modul' => 'profil', 'profilContent' => 'information' ,  'user' => $user]);
                break;
            case 3:
                $request->validate([
                    'newEmail' => 'required|string|email|max:255|unique:users,email',
                    'EmailPassword' => 'required|string',
                ]);
                $user = Auth::user();
                if (!Hash::check($request->EmailPassword, $user->password)) {
                    return back()->withErrors(['password' => 'A megadott jelszó helytelen.']);
                }
    
                $user->email = $request->newEmail;
                $user->save();
                return view('main', ['modul' => 'profil', 'profilContent' => 'information' ,  'user' => $user]);
                break;
            case 4:
                $data = $request->validate([
                    'notifications.event' => 'nullable|boolean',
                    'notifications.new_monster' => 'nullable|boolean',
                    'notifications.watched_post' => 'nullable|boolean',
                    'notifications.answered_post' => 'nullable|boolean',
                    'notifications.friend_request' => 'nullable|boolean',
                    'notifications.friend_accept' => 'nullable|boolean',
                    'notifications.private_message' => 'nullable|boolean',
                    'notifications.moderation' => 'nullable|boolean',
                    'notifications.followed_user' => 'nullable|boolean',
                ]);
                $user = auth()->user();
                $Notification = Notification::where('user_id',$user->id)->first();
                $data = $request->notifications ?? [];
                $Notification->update([
                    'event' => $data['event'] ?? 0,
                    'new_monster' => $data['new_monster'] ?? 0,
                    'watched_post' => $data['watched_post'] ?? 0,
                    'answered_post' => $data['answered_post'] ?? 0,
                    'friend_request' => $data['friend_request'] ?? 0,
                    'friend_accept' => $data['friend_accept'] ?? 0,
                    'private_message' => $data['private_message'] ?? 0,
                    'moderation' => $data['moderation'] ?? 0,
                    'followed_user' => $data['followed_user'] ?? 0,
                ]);
                $Notification->save();
                // Sikeres mentés után visszairányítás vagy egyéb műveletek
                return redirect()->back()->with('success', 'Értesítések mentve!');
                break;
            default:
                // aha
                break;
        }
    }
}