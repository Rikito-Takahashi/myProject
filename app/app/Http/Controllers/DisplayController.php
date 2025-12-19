<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;

class DisplayController extends Controller
{
    public function index()
    {
        return view('Auth.login');
    }//

    // public function signup()
    // {
    //     return view('Auth.register');
    // }//

    //     public function signup_conf()
    // {
    //     return view('Auth.register_conf');
    // }//
}
