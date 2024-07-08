<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Monster;

class EncyclopediaController extends Controller
{
    public function showMonsters()
    {
        $monsters = Monster::paginate(10);
        return view('main', ['monsters' => $monsters, 'modul' => 'enciklopedia']);
    }
    public function RefreshMonsters(Request $request)
    {
        $letter = $request->font;
        $monsters = Monster::where('name', 'LIKE', $letter . '%')->orWhere('name', 'LIKE', strtoupper($letter) . '%')->paginate(10);
        return view('enciklopedia', ['monsters' => $monsters]);
    }
}
