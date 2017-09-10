<!DOCTYPE html>
<html lang="en">
@include('header.header')
<?php
use Illuminate\Support\Facades\Session;
$users = Session::get('username');
$user = DB::table('users')->where('username', '=', $users)->get();
?>

@foreach($user as $user)
    <body>
    <!--<div class='preloader'><div class='loaded'>&nbsp;</div></div> !-->
    <header id="home" class="header">
        <div class="navbar navbar-default main-menu">
            <div class="container">
                <div class="collapse navbar-collapse" style="position: absolute; right: 2%; margin-top: 15%; color: black;">
                    <ul class="nav navbar-nav navbar-right" style="">
                        <li><a href="/dashboard" ><i class="fa fa-home" id="space"></i>Home</a></li>
                        <li class="active"><a href="/preenroll"><i class="fa fa-stack-overflow" id="space"></i>Pre-Enrollment</a></li>
                        <li><a href="/checklist"><i class="fa fa-th-list" id="space"></i>Checklist</a></li>
                        <li><a href="/offeredSubjects"><i class="fa fa-columns" id="space"></i>Offered Subjects</a></li>
                        <li><a href="/overload"><i class="fa fa-folder-open-o" aria-hidden="true"></i>Request for overload</a></li>
                        <li><a href="/petitions"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Petitions</a></li>
                        <li><a href="/profile"><i class="fa fa-user-circle-o" aria-hidden="true"></i>Profile</a></li>
                    </ul>
                </div>
            </div>
        </div> <!-- end of navbar -->
    </header>
    <section id="preenroll">
        <img src="images/building.jpg" alt="" style="width: 100%; margin-top: 1%;"/>
        <hr style="width: 100%; margin-top: 4%;">
        <div class="container" style="width: 90%;">
            <div class="row" >
            </div> <!-- end of row -->
        </div> <!-- end of container -->
    </section>
    <div id="about">
        <div class="container-fluid">
            <div class="row">
                <div class="about-heading" style="margin-top: -3%; margin-left: 84%; width:20%;">
                    <!--<h2>Pre-enroll now</h2>-->
                    <form method="post" action="#">
                        <select style="width: 120px; padding: 5px; margin-top:15%; margin-right:200%; text-align:center;" name = "sort">
                            <option value="All"><a href="#"><b>Overall Term</b></a></option>
                            <option value="First"><a href="#"><b>First Term</b></a></option>
                            <option value="Second"><a href="#"><b>Second Term</b></a></option>
                            <option value="Short"><a href="#"><b>Short Term</b></a></option>
                        </select>
                        <input type="submit" name="submit" class="btn btn-sm btn-info" value="Apply" style="width: 20%; height: 10%;">
                        <a href="#"><input type="submit" name="submit" class="btn btn-sm btn-info" value="Reset" style="width: 20%;height: 10%;"></a>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- tables -->
    <div style="margin-left: 50%; margin-top: 50%; position: absolute; width: 25%; height: 30%;">
        <form role="search" class="app-search hidden-xs" method="post" action="#">
            {{ csrf_field() }}
            <input type="text" placeholder="Search for subjects..." class="form-control" name="searchavail" style="">
            <i class="fa fa-search" style="position: absolute; right: 3%; color: gray; margin-top: -5%;"></i>
        </form>
    </div>
    <div class="container-fluid">
        <div class="row">

            <div class="table-responsive" style="margin-top: 17%; overflow-y:scroll; height:500px; width: 45%; position: absolute; right: 3%; top: 13%;">
                <table class="table" style="position: absolute; display: block; z-index: 100; background-color:white; width: 39%;">
                    <tr>
                        <th>Course Number</th>
                        <th></th><th></th>
                        <th>Descriptive Title</th>
                        <th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th>
                        <th>Units</th>
                        <th>Term</th><th></th>
                        <th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th>
                    </tr>
                </table>
                <br><br><br>
                <table class="table ">
                    <tbody>
                    <?php
                    $studs = DB::table('offered_subjects')
                        ->join('subjects', 'subjects.subjectID', '=', 'offered_subjects.subjectID')
                        ->orderby('subjects.coursenumber', 'asc')
                        ->get();
                    ?>
                    @foreach ($studs as $studs)
                        <?php
                        $cc = $studs->coursenumber;
                        $t = $studs->term;
                        ?>
                        <tr>
                            <td class="txt-oflo">{{ $studs->coursenumber }}</td>
                            <td>{{ $studs->destitle }}</td>
                            <td>{{ $studs->units }}</td>
                            <td>{{ $studs->term }}</td>
                            <td><a href='/add/{{$users}}/{{$cc}}/{{$t}}'>
                                    <button class='btn btn-primary btn-sm' style="margin-left: 20%; width: 20px;">
                                        <span class="fa fa-plus" aria-hidden="true"></span>
                                    </button>
                                </a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            <div style="margin-top: -7%; margin-left: 2%;">
                <?php
                $course = DB::table('students')->where('id_number', '=', $users)->get();
                $students = DB::table('subjects')->selectRaw('sum(subjects.units) AS stotal')
                    ->join('pre_enroll', 'subjects.coursenumber', '=', 'pre_enroll.coursenumber')
                    ->where('pre_enroll.id_number', '=', $users)
                    ->where('pre_enroll.term', '=', 'First')
                    ->get();
                ?>
                @foreach($course as $course)
                    @foreach($students as $students)
                        <h4> You are currently Enrolled as: {{$course->course}} - {{$course->year}}</h4>
                        <h5 style="position: absolute; margin-top: 0.5%; margin-left: 40%; font-size: 100%;"> Total Units: {{$students->stotal }}</h5>
                        <h4 style=" margin-top: 1%; margin-left: 1%; font-size: 120%;"> Maximum Units Allowed: </h4>
                    @endforeach
                @endforeach
            </div>
            <br>
            <div class="table-responsive" style="margin-top: -1%; overflow-y:scroll; height:500px; width:45%; margin-left: 3%; border-color: #000;">
                <table class="table" style="position: absolute; display: block; z-index: 100; background-color: darkgray;width: 44%;">
                    <tr>
                        <th>Course Number</th>
                        <th>Descriptive Title</th>
                        <th></th>
                        <th>Units</th>
                        <th>Term</th>
                        <th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th>
                    </tr>
                </table>
                <br><br><br>
                <table class="table">
                    <tbody>
                    <?php
                    $stud = $user->username;
                    $id = DB::table('students')->where('id_number', '=', $stud)->get();
                    ?>
                    @foreach($id as $id)
                        <?php $idd = $id->id_number; ?>
                    @endforeach
                    <?php
                    $studs= DB::table('pre_enroll')
                        ->join('subjects', 'subjects.coursenumber', '=', 'pre_enroll.coursenumber')
                        ->join('students', 'students.id_number', '=', 'pre_enroll.id_number')
                        ->where('pre_enroll.id_number', '=', $idd)
                        ->where('pre_enroll.term', '=', 'First')
                        ->get();
                    ?>
                    @foreach ($studs as $studs)
                        <?php
                        $c = $studs->coursenumber;
                        ?>
                        <tr>
                            <td class="txt-oflo">{{ $studs->coursenumber }}</td>
                            <td>{{ $studs->destitle }}</td>
                            <td>{{ $studs->units }}</td>
                            <td>
                                <a href='/delete/{{$users}}/{{$c}}'>
                                    <button class='btn btn-primary btn-sm' style="margin-left: 50%; width: 3%">
                                        <span class="fa fa-times" aria-hidden="true"></span>
                                    </button>
                                </a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <a href="#preenroll"><input type="button" value="Pre-Enroll" class="btn btn-primary btn-sm" style="position: absolute; width: 10%; margin-top: 1%; margin-left: 60%; font-size: 80%; width: 10%">
        </a>
    </div>
    <!-- START SCROLL TO TOP  -->
    <div class="scrollup">
        <a href="#"><i class="fa fa-chevron-up"></i></a>
    </div>

    @include('script.script')
    </body>
    @endforeach
@include('footer.footer')
</html>