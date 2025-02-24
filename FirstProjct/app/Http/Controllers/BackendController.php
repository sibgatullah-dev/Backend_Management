<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BackendController extends Controller
{
    function dashboard(){
        return view('backend.dashboard');
    }
   
}
