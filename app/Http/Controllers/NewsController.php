<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\event;
use App\Models\User;

class NewsController extends Controller
{
    public function save(Request $request)
    {
        // Validation logic here

        $news = new event();
        $news->title = $request->input('title');
        $news->content = $request->input('content');
        $news->save();

        $users = User::all();
        return redirect()->route('admin')->with('eventSuccess', __('messages.adminNewsSucces'))->with('modul','admin');

    }
}