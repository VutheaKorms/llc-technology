<?php

namespace App\Http\Controllers;
use Auth;
use Illuminate\Http\Request;

class AdminController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = Auth::user();
        //return view('admin')->with(['user' => $user]);
        return view('admin', ['user' => $user]);
    }


}
