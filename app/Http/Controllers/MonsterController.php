<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Monster; // Make sure to import the Monster model
use Illuminate\Support\Facades\Auth;

class MonsterController extends Controller
{
    public function saveMonster(Request $request)
    {
        // Validate the request data (you can customize this based on your requirements)
        $validatedData = $request->validate([
            'name' => 'required|string',
            'description' => 'required|string',
            'place' => 'required|string',
            'behavior' => 'required|string',
            'rarity_level' => 'required|integer|min:0|max:10',
            'danger_level' => 'required|integer|min:0|max:10',
            'nutrition' => 'required|string',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048', // Add image validation rules
        ]);
        
        $validatedData = array_map('trim', $validatedData);
        // Add user_id to the validated data
        $validatedData['user_id'] = Auth::id();

        // Save the image directly in the public/encyclopedia directory
        $image = $request->file('image');
        $imageName = time() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('encyclopedia'), $imageName);

        // Add image path to the validated data
        $validatedData['image'] = 'encyclopedia/' . $imageName;

        // Create a new Monster instance with the validated data
        $monster = Monster::create($validatedData);

        // Optionally, you can redirect to a success page or return a response
        return redirect()->back()->with('monsterSuccess', 'Monster saved successfully!');
    }
    public function deleteMonster(Request $request){
        //MonsterDeletIDData
        $monster = Monster::find($request->MonsterDeletIDData);

        if (!$monster) {
            // Handle the case where the monster with the given id is not found
            return redirect()->back()->with('adminMonsterError', __('messages.adminMonsterDeletError'));
        }

        // Delete the monster
        $monster->delete();

        return redirect()->back()->with('adminMonsterSucces', __('messages.adminMonsterDeletSucces'));
    }

}
