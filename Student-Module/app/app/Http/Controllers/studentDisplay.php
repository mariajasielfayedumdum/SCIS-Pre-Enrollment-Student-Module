<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;

class studentDisplay extends Controller
{
     public function login() {

        $username = Input::get('username');
        $password = Input::get('password');

        $prestud = DB::table('users')
            ->where('username', '=', $username)
            ->where('password', '=', $password)
            ->where('type', '=', '1')->get();
        $nonstud = DB::table('users')
            ->where('username', '=', $username)
            ->where('password', '=', $password)
            ->where('type', '=', '2')->get();
        if(count($prestud) > 0){
            Session::put('username', $username);
            return view('/dashboard', compact('username'));
        }
        else if(count($nonstud) > 0){
            echo "<script type='text/javascript'>alert('User did not Pre-Enroll. Please Contact your System Administrator');</script>";
            return view('welcome');
        }
        else{return view('welcome');}

    }
}