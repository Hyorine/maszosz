<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;

class baseController extends Controller
{
    public function index()
    {
        return view('main')->with('modul','base');
    }
    public function show(Request $request)
    {
       
    }
}