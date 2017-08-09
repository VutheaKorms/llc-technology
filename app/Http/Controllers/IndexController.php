<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class IndexController extends Controller
{
    public function index()
    {
        return view('welcome');
    }

    public function contact()
    {
        return view('contact');
    }

    public function about()
    {
        return view('about');
    }

}
