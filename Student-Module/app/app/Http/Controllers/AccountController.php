<?php
use Illuminate\Support\Facades\Input;
use DB;

class AccountController extends BaseController {


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
        $admin = DB::table('users')
            ->where('username', '=', $username)
            ->where('password', '=', $password)
            ->where('type', '=', '4')->get();

        if(count($prestud)){
            //student module
        }
        else if(count($nonstud)){
            //notify
        }
        else if(count($admin)){
            return view('layout');
        }
        return view('welcome');
    }
}