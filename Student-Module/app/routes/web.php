<?php
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;

Route::get('/', function(){
    return view('welcome');
});
Route::get('/dashboard', function(){
    if(Session::has('username'))
    {
        return view('dashboard');
    } else{
        return view('welcome');
    }
});
Route::get('/preenroll', function(){
    if(Session::has('username'))
    {
        return view('preenroll');
    } else{
        return view('welcome');
    }
});
Route::get('/checklist', function(){
    if(Session::has('username'))
    {
        return view('checklist');
    } else{
        return view('welcome');
    }
});
Route::get('/offeredSubjects', function(){
    if(Session::has('username'))
    {
        return view('offeredsubject');
    } else{
        return view('welcome');
    }
});
Route::get('/petitions', function(){
    if(Session::has('username'))
    {
        return view('petitions');
    } else{
        return view('welcome');
    }
});
Route::get('/overload', function(){
    if(Session::has('username'))
    {
        return view('overload');
    } else{
        return view('welcome');
    }
});
Route::post('/loginAuth', 'studentDisplay@login');

Route::get('/logout', function() {
    Session::forget('username');

    if(!Session::has('username'))
    {
        return view('welcome');
    }
});
Route::post('/add/{users}/{cc}/{t}', 'studentDisplay@add');
Route::get('/add/{users}/{cc}/{t}' ,[
    'as' => 'preenroll',
    'uses' =>'studentDisplay@add']);
Route::post('/delete/{users}/{c}', 'studentDisplay@del');
Route::get('/delete/{users}/{c}',[
    'as' => 'preenroll',
    'uses' =>'studentDisplay@del']);