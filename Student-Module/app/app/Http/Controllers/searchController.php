<?php

namespace App\Http\Controllers;

use App\Users;

class searchController extends Controller
{
    public function studentSearch($query, $keyword){

        if ($keyword!=''){
            $query->where(function ($query) use ($keyword)
            {
                $query->where('students.last_name', 'LIKE','%$keyword%')
                    ->orWhere('students.first_name', 'LIKE','%$keyword%')
                    ->orWhere('students.id_number', 'LIKE','%$keyword%');
            });
        }
        $keyword = Input::get('search', '');
      //  $users = Users::studentSearch($keyword)->get();
        return $query;

    }

    public function search(){
        $keyword = Input::get('keyword');
        if(isset($keyword)){
            $subjects = Users::where('students.last_name', 'LIKE', '%$keyword%')
                ->orWhere('students.first_name', 'LIKE','%$keyword%')
                ->orWhere('students.id_number', 'LIKE','%$keyword%')->get();
        }else{
            $subjects= Users::all();
        }

        return $subjects;
    }
}
