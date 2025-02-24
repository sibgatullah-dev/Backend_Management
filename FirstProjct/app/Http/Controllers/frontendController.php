<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class frontendController extends Controller
{
    function welcome(){
        return view('welcome');
    }
    function about(){
        return view('about');
    }
}
 