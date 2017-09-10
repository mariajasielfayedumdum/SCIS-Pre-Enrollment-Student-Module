<?php

namespace App\Http\Controllers;

use DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;

class subjectDisplay extends Controller
{

    public function petitionSub($users, $cc, $t){
        if(Session::has('username')) {
            $query = DB::table('petitions')
                ->where('id_number', '=', $users)
                ->where('subjectID', '=', $cc)->get();
            if (count($query) == 0){
                DB::insert('insert into petitions (subjectID, id_number, term) values (?, ?, ?)', [ $cc, $users, $t]);
                return view('petitions');
            }else if(count($query) > 0){
                return view('petitions')->withMessages('You already petitioned the subject');
            }
        }
    }
    public function addPetition($id){
        if(Session::has('username')) {
            $sub = DB::table('subjects')
                ->where('subjectID', '=', $id)->get();
            return view('addnewpetition2', compact('sub'));
        }
    }

    public function addpetitionSub($users, $cc){
        if(Session::has('username')) {
            $term = Input::get('cour');
            $query = DB::table('petitions')
                ->where('id_number', '=', $users)
                ->where('subjectID', '=', $cc)->get();
            if (count($query) == 0){
                DB::insert('insert into petitions (subjectID, id_number, term) values (?, ?, ?)', [ $cc, $users, $term]);
                return view('petitions');
            }else if(count($query) > 0){
                return view('petitions')->withMessages('You already petitioned the subject');
            }
        }
    }

}
