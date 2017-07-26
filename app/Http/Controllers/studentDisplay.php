<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Input;

class studentDisplay extends Controller
{

    public function add($id, $cc, $t){
        if(Session::has('username')) {
            DB::insert('insert into pre_enroll (id_number, coursenumber, term) values (?, ?, ?)', [$id, $cc, $t]);
            $stud = DB::table('students')->where('id_number', '=', $id)->get();
            if (count($stud) > 0) {
                return view('preenroll');
            } else {
                return view('preenroll')->withMessage('No data');
            }
        }
    }
    public function del($id, $c){
        if(Session::has('username')) {
            DB::table('pre_enroll')->where('id_number', '=', $id)
                ->where('coursenumber', '=', $c)
                ->delete();
            $stud = DB::table('students')->where('id_number', '=', $id)->get();
            if (count($stud) > 0) {
                return view('preenroll')->withDetails($stud)->withQuery($id);
            } else {
                return view('preenroll')->withMessage('No data');
            }
        }
    }
    public function addOverload($id, $cc, $t){
        if(Session::has('username')) {
            $status = 'Pending';
            DB::insert('insert into overloading (subjectID, id_number, status, term) values (?, ?, ?, ?)', [$cc, $id, $status, $t]);
            $stud = DB::table('students')->where('id_number', '=', $id)->get();
            if (count($stud) > 0) {
                return view('overload')->withDetails($stud)->withQuery($id);
            } else {
                return view('overload')->withMessage('No data');
            }
        }
    }
    public function delOverload($id, $c){
        if(Session::has('username')) {
            DB::table('overloading')->where('id_number', '=', $id)
                ->where('subjectID', '=', $c)
                ->delete();
            $stud = DB::table('students')->where('id_number', '=', $id)->get();
            if (count($stud) > 0) {
                return view('overload')->withDetails($stud)->withQuery($id);
            } else {
                return view('overload')->withMessage('No data');
            }
        }
    }
    public function login()
    {
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
        if (count($prestud) > 0) {
            Session::put('username', $username);
            return view('/layout', compact('username'));
        } else if (count($nonstud) > 0) {
            echo "<script type='text/javascript'>alert('User did not Pre-Enroll. Please Contact your System Administrator');</script>";
            return view('welcome');
        } else {
            return view('welcome');
        }
    }
}