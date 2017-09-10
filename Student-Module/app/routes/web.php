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
        return view('layout');
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
        return view('offeredSubjects');
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
Route::get('/profile', function(){
    if(Session::has('username'))
    {
        return view('profile');
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
Route::get('/addPetition', function(){
    if(Session::has('username'))
    {
        return view('addnewpetition');
    } else{
        return view('welcome');
    }
});
Route::post('/addPetition/{id}', 'subjectDisplay@addPetition');
Route::get('/addPetition/{id}' ,[
    'as' => 'addnewpetition',
    'uses' =>'subjectDisplay@addPetition']);

Route::post('/addpetitionSub/{users}/{cc}', 'subjectDisplay@addpetitionSub');
Route::get('/addpetitionSub/{users}/{c}' ,[
    'as' => 'addnewpetition',
    'uses' =>'subjectDisplay@addpetitionSub']);

Route::post('/petitionSub/{users}/{cc}/{t}', 'subjectDisplay@petitionSub');
Route::get('/petitionSub/{users}/{cc}/{t}' ,[
    'as' => 'petitions',
    'uses' =>'subjectDisplay@petitionSub']);

Route::post('/addOve/{users}/{cc}/{t}', 'studentDisplay@addOverload');
Route::get('/addOve/{users}/{cc}/{t}' ,[
    'as' => 'overload',
    'uses' =>'studentDisplay@addOverload']);

Route::post('/delOver/{users}/{c}', 'studentDisplay@delOverload');
Route::get('/delOver/{users}/{c}',[
    'as' => 'overload',
    'uses' =>'studentDisplay@delOverload']);

Route::post('/add/{users}/{cc}/{t}', 'studentDisplay@add');
Route::get('/add/{users}/{cc}/{t}' ,[
    'as' => 'preenroll',
    'uses' =>'studentDisplay@add']);
Route::post('/delete/{users}/{c}', 'studentDisplay@del');
Route::get('/delete/{users}/{c}',[
    'as' => 'preenroll',
    'uses' =>'studentDisplay@del']);

//subject mgmt page
Route::any('/searchpresubj', function(){
    if(Session::has('username')) {
        $searched = Input::get('input');
        $stud = DB::table('subjects')->join('pre_enroll', 'subjects.coursenumber', '=', 'pre_enroll.coursenumber')
            ->select('subjects.coursenumber', 'subjects.destitle', 'subjects.units', 'pre_enroll.term')
            ->where('subjects.coursenumber', 'LIKE', '%' . $searched . '%' )
            ->orWhere('subjects.destitle', 'LIKE', '%' . $searched . '%' )
            ->orWhere('pre_enroll.term', 'LIKE', '%' . $searched . '%' )
            ->DISTINCT()->orderby('coursenumber', 'asc')
            ->get();
        if(count($stud) > 0){
            return view('offeredSubjects')->withDetails($stud)->withQuery($searched);
        } else {
            return view ('offeredSubjects')->withMessage('SUBJECT NOT FOUND! ');
        }}  else{
        return view('welcome');
    }
});

Route::any('/searchOverload', function(){
    if(Session::has('username')) {
        $searched = Input::get('overload');
        $stud = DB::table('subjects')->join('offered_subjects', 'subjects.subjectID', '=', 'offered_subjects.subjectID')
            ->select('subjects.subjectID', 'subjects.coursenumber', 'subjects.destitle', 'subjects.units', 'offered_subjects.term', 'offered_subjects.course')
            ->where('subjects.coursenumber', 'LIKE', '%' . $searched . '%' )
            ->orWhere('subjects.destitle', 'LIKE', '%' . $searched . '%' )
            ->DISTINCT()->orderby('subjects.coursenumber', 'asc')
            ->get();
        if(count($stud) > 0){
            return view('overload')->withDetail($stud)->withQuery($searched);
        } else {
            return view ('overload')->withMessage('SUBJECT NOT FOUND! ');
        }}  else{
        return view('welcome');
    }
});

Route::any('/searchavail/', function(){
    if(Session::has('username')) {
        $searched = Input::get('searchavail');
        $studs = DB::table('offered_subjects')
            ->join('subjects', 'subjects.subjectID', '=', 'offered_subjects.subjectID')
            ->where('subjects.coursenumber', 'LIKE', '%' . $searched . '%')
            ->orWhere('subjects.destitle', 'LIKE', '%' . $searched . '%')
            ->orderby('subjects.coursenumber', 'asc')
            ->get();
        if (count($studs) > 0) {
            return view('preenroll')->withDetail($studs)->withQuery($searched);
        } else {
            return view('preenroll')->withMessage('No data');
        }
        }
    else{
        return view('welcome');
    }
});

Route::any('/searchPetition', function(){
    if(Session::has('username')) {
        $searched = Input::get('petition');
        $stud = DB::table('subjects')->join('petitions', 'subjects.subjectID', '=', 'petitions.subjectID')
            ->select('subjects.subjectID', 'subjects.coursenumber', 'subjects.destitle', 'subjects.units', 'petitions.term')
            ->where('subjects.coursenumber', 'LIKE', '%' . $searched . '%' )
            ->orWhere('subjects.destitle', 'LIKE', '%' . $searched . '%' )
            ->DISTINCT()->orderby('subjects.coursenumber', 'asc')
            ->get();
        if(count($stud) > 0){
            return view('petitions')->withDetails($stud)->withQuery($searched);
        } else {
            return view ('petitions')->withMessage('SUBJECT NOT FOUND! ');
        }}  else{
        return view('welcome');
    }
});
Route::any('/searchopenPetition', function(){
    if(Session::has('username')) {
        $searched = Input::get('petition');
        $stud = DB::table('subjects')
            ->where('coursenumber', 'LIKE', '%' . $searched . '%' )
            ->orWhere('destitle', 'LIKE', '%' . $searched . '%' )
            ->DISTINCT()->orderby('coursenumber', 'asc')
            ->get();
        if(count($stud) > 0){
            return view('addnewpetition')->withDetails($stud)->withQuery($searched);
        } else {
            return view ('addnewpetition')->withMessage('SUBJECT NOT FOUND! ');
        }}  else{
        return view('welcome');
    }
});
