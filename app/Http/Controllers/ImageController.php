<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class ImageController extends Controller
{
    public function upload(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        $imageName = time().'.'.$request->image->extension();

        $request->image->move(public_path('gallery'), $imageName);

        return redirect()->route('admin')->with('success', __('messages.adminGalerySucess'));
    }
    public function delet(Request $request)
    {
        $imageName = $request->input('imageName');
        $galleryPath = public_path('gallery');
        $imagePath = $galleryPath . '/' . $imageName;

        if (File::exists($imagePath)) {
            File::delete($imagePath);
            return redirect()->back()->with('imageDeletsuccess', __('messages.admingaleryDeletSucces'));
        }

        return redirect()->back()->with('imageDeleterror', __('messages.admingaleryDeletFail'));
    }
}
