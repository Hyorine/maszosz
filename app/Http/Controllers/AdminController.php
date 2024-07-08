<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\File;
use App\Models\event;
use App\Models\Monster; 
use App\Models\Role; 
use App\Models\role_user;
use App\Models\Rank;
use App\Models\RankUser;
use App\Models\Category;

class AdminController extends Controller
{
    public function index()
    {
        $modul = "admin";
        $users = User::all();

        $galleryPath = public_path('gallery');
        $imageNames = File::files($galleryPath);
        $events = event::all();
        $monsters = Monster::all();
        $roles = Role:: all();
        $Ranks = Rank::all();
        $Categorys = Category:: all();
        foreach ($users as $user) {
            $user->load('Just1Role');
            $user->load('myrank');
        }

        return view('main', compact('users', 'imageNames', 'events', 'monsters', 'roles', 'Ranks', 'Categorys' ,'modul'));
    }
    public function change(Request $request)
    {
        switch($request->userOperation){
            case 1:
                $role = role_user::where('user_id', $request->userId)->first();
                if ($role) {
                    $sessionRole = session('roles');
                    if($sessionRole[0] < $request->userRole){
                        $role->update([
                            'role_id' => $request->userRole,
                        ]);
                        $userRoles = Auth::user()->roles; // Assuming you have a 'roles' relationship in your User model
                        $roleNames = $userRoles->pluck('id')->toArray();
                        session(['roles' => $roleNames]);
                        return redirect()->back()->with('userRollUpdateSuccess', __('messages.userRollChangeSucces'));
                    }
                    else{
                        return redirect()->back()->with('userRollUpdateError', __('messages.userRollChangeError'));
                    }
                }
                else{
                    return redirect()->back()->with('userRollUpdateError', __('messages.userRollChangeError'));
                }
            break;
            case 2:
                $validator = Validator::make($request->all(), [
                    'rankName' => 'required|string|max:255', // Adjust the maximum length as per your requirements
                ]);
            
                if ($validator->fails()) {
                    return redirect()->back()->withErrors($validator)->withInput();
                }
            
                try {
                    $rank = Rank::create([
                        "name" => $request->rankName
                    ]);
            
                    if ($rank) {
                        return redirect()->back()->with('userRankAddSuccess', __('messages.userRankAddSuccess'));
                    } else {
                        return redirect()->back()->with('userRankAddError', __('messages.userRankAddError'));
                    }
                } catch (\Exception $e) {
                    // Log the error or handle it appropriately
                    return redirect()->back()->with('userRankAddError', __('messages.userRankAddError'));
                }
            break; 
            case 3:
                $RankUser = RankUser::where('user_id',$request->userRankID)->first();
                if ($RankUser) {
                    $RankUser->update([
                        'rank_id' => (int) $request->rank
                    ]);
                    return redirect()->back()->with('userRollUpdateSuccess', __('messages.userRankChangeSucces'));
                }else {
                    return redirect()->back()->with('userRollUpdateError', __('messages.userRankChangeError'));
                }
            break;
            case 4:
                $RankUsers = RankUser::where('rank_id',$request->userrank)->get();
                foreach ($RankUsers as $RankUser) {
                    $RankUser->rank_id  = 1;
                    $RankUser->save();
                }
                Rank::where('id',$request->userrank)->delete();
                return redirect()->back();
            break;
            case 5:
                $categoryId = $request->input('category_id');
                $active = $request->input('active');

                // Update the active status in the database
                $category = Category::find($categoryId);
                if ($category) {
                    $category->active = $active;
                    $category->save();
                }
            break;
            case 6:
                $Category = Category::create([
                    "name" => $request->categoryName
                ]);

                if ($Category) {
                    return redirect()->back()->with('NewCategoryAddSuccess', __('messages.NewCategoryAddSuccess'));
                } else {
                    return redirect()->back()->with('NewCategoryAddError', __('messages.NewCategoryAddError'));
                }

            break; 
        }
    }
}