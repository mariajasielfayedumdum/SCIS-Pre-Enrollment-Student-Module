<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" type="image/png" sizes="16x16" href="/plugins/images/scis.png">
    <title>SCIS Pre-Enrollment</title>
    <link href="/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css" rel="stylesheet">
    <link href="/plugins/bower_components/toast-master/css/jquery.toast.css" rel="stylesheet">
    <link href="/plugins/bower_components/morrisjs/morris.css" rel="stylesheet">
    <link href="/css/animate.css" rel="stylesheet">
    <link href="/css/style.css" rel="stylesheet">
    <link href="/css/colors/blue-dark.css" id="theme" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
    <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
</head>

<style>
    table {
        width: 300%;
        border-collapse: collapse;
        margin:50px auto;
    }

    th {
        background: #85b4d0;
        color: white;
        font-weight: 15px;
    }

    td, th {
        padding: 10px;
        border: 1px solid #ccc;
        text-align: left;
        font-size: 15px;
    }
</style>
<?php
use Illuminate\Support\Facades\Session;
$users = Session::get('username');
$user = DB::table('users')->where('username', '=', $users)->get();
?>
@foreach($user as $user)
    <body>
    <div id="wrapper">
        <br>
        @include ('layouts.nav')
        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse slimscrollsidebar">
                <ul class="nav" id="side-menu">
                    <li style="padding: 10px 0 0;">
                        <a href="/dashboard" class="waves-effect"><i class="fa fa-dashboard fa-fw" aria-hidden="true"></i><span class="hide-menu">Dashboard</span></a>
                    </li>
                    <li>
                        <a href="/preenroll" class="waves-effect"><i class="fa fa-folder fa-fw" aria-hidden="true"></i><span class="hide-menu">Pre Enrollment</span></a>
                    </li>
                    <li>
                        <a href="/offeredSubjects" class="waves-effect"><i class="fa fa-columns fa-fw" aria-hidden="true"></i><span class="hide-menu">Offered Subjects</span></a>
                    </li>
                    <li>
                        <a href="/overload" class="waves-effect"><i class="fa fa-stack-overflow fa-fw" aria-hidden="true"></i><span class="hide-menu">Request for Overload</span></a>
                    </li>
                    <li>
                        <a href="/petitions" class="waves-effect"><i class="fa fa-files-o fa-fw" aria-hidden="true"></i><span class="hide-menu">Petition Subject</span></a>
                    </li>
                    <li>
                        <a href="/checklist" class="waves-effect"><i class="fa fa-check-square-o fa-fw" aria-hidden="true"></i><span class="hide-menu">Checklist</span></a>
                    </li>
                    <li>
                        <a href="/profile" class="waves-effect"><i class="fa fa-user-circle fa-fw" aria-hidden="true"></i><span class="hide-menu">Profile</span></a>
                    </li>

                </ul>
            </div>
        </div>
        <!-- /#page-wrapper -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Request for Overload</h4>
                    </div>
                </div>
                <div class="container-fluid">
                    <?php
                    $stud = DB::table('students')->where('id_number', '=', $users)->get();
                    ?>
                    @foreach($stud as $stud)
                        <br>
                        <p style="position:absolute; left:25%;"> <b>Overloaded Subjects</b></p>
                        <p style="position:absolute; left:40%;"> <b>Max Units Allowed: </b></p>
                        <br>
                        <div class="white-box" style="width: 45%; height: 670px;">
                            <div class="table-responsive" style="overflow-y:scroll; height: 560px; width: 100%; margin-top: -.6%;">
                                <table class="table" id="copy">
                                    <tr>
                                        <th>Course Number</th>
                                        <th>Descriptive Title</th>
                                        <th>Units</th>
                                        <th>Term</th>
                                        <th>Action</th>
                                    </tr>
                                    <tbody>
                                    <?php
                                    $preenroll = DB::table('overloading')
                                        ->join('subjects', 'subjects.subjectID', '=', 'overloading.subjectID')
                                        ->join('students', 'students.id_number', '=', 'overloading.id_number')
                                        ->where('overloading.id_number', '=', $users)
                                        ->get();
                                    ?>
                                    @foreach($preenroll as $preenroll)
                                        <?php
                                        $c = $preenroll->subjectID;
                                        ?>
                                        <tr>
                                            <td class="txt-oflo" style="height: 30px;">{{ $preenroll->coursenumber}}</td>
                                            <td>{{$preenroll->destitle}}</td>
                                            <td class="txt-oflo">{{$preenroll->units}}</td>
                                            <td class="txt-oflo">{{$preenroll->term}}</td>
                                            <td>
                                                <a href='/delOver/{{$users}}/{{$c}}'>
                                                    <button class='btn btn-primary btn-sm' >
                                                        <span class="fa fa-times" aria-hidden="true"></span>
                                                    </button>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            <hr>
                            <?php
                            $students = DB::table('subjects')->selectRaw('sum(subjects.units) AS stotal')
                                ->join('overloading', 'subjects.subjectID', '=', 'overloading.subjectID')
                                ->where('overloading.id_number', '=', $users)
                                ->where('overloading.term', '=', 'First')
                                ->get();
                            $students1 = DB::table('subjects')->selectRaw('sum(subjects.units) AS stotal')
                                ->join('overloading', 'subjects.subjectID', '=', 'overloading.subjectID')
                                ->where('overloading.id_number', '=', $users)
                                ->where('overloading.term', '=', 'Second')
                                ->get();
                            $students2 = DB::table('subjects')->selectRaw('sum(subjects.units) AS stotal')
                                ->join('overloading', 'subjects.subjectID', '=', 'overloading.subjectID')
                                ->where('overloading.id_number', '=', $users)
                                ->where('overloading.term', '=', 'Short')
                                ->get();
                            ?>
                            @foreach($students as $students)
                            @foreach($students1 as $students1)
                            @foreach($students2 as $students2)
                                <h5>Total Units: </h5>
                                        <p style="position: absolute; margin-left: 5%; margin-top: -1.5%;">First: {{$students->stotal }}</p>
                                        <p style="position: absolute; margin-left: 15%; margin-top: -1.5%;">Second: {{$students1->stotal }}</p>
                                        <p style="position: absolute; margin-left: 25%; margin-top: -1.5%;">Short: {{$students2->stotal }}</p>
                            @endforeach
                            @endforeach
                            @endforeach
                            <a href="/dashboard"><input type="button" value="Request" class="btn btn-primary btn-sm" style="position: absolute; margin-top: -2%; margin-left: 31%; padding: 5px 10px 5px 10px; font-size: 100%;">
                            </a> </div>
                        <!-- search subjects
                        include
-->
                        @if(isset($detail))
                                <div class="container-fluid" style="position: absolute; right: 2%; top: 14%; width: 46%">
                                    <p> <b>Add Subject/s: </b></p>
                                    <form role="search" class="app-search hidden-xs" method="post" action="/searchOverload/">
                                        {{ csrf_field() }}
                                        <input type="text" placeholder="Search for subjects..." class="form-control" name="overload" style="width: 45%; height: 30%;">
                                        <i class="fa fa-search" style="position: relative; right: 3%; color: gray"></i>
                                    </form>
                                    <br>
                                    <div class="white-box">
                                        <div class="table-responsive" style="overflow-y:scroll; height: 600px; width: 100%; margin-top: -1%">
                                            <table class="table">
                                                <tr>
                                                    <th>CourseNo</th>
                                                    <th>Descriptive Title</th>
                                                    <th>Units</th>
                                                    <th>Course</th>
                                                    <th>Term</th>
                                                    <th>Action</th>
                                                </tr>
                                            <tbody>
                                              @foreach($detail as $studs)
                                                        <?php
                                                        $cc = $studs->subjectID;
                                                        $t = $studs->term;
                                                        ?>
                                                        <tr id="trRes">
                                                            <td class="txt-oflo">{{ $studs->coursenumber }}</td>
                                                            <td>{{ $studs->destitle }}</td>
                                                            <td>{{ $studs->units }}</td>
                                                            <td>{{ $studs->course }}</td>
                                                            <td>{{ $studs->term }}</td>
                                                            <td><a href='/addOve/{{$users}}/{{$cc}}/{{$t}}'>
                                                                    <button class='btn btn-primary btn-sm'>
                                                                        <span class="fa fa-plus" aria-hidden="true"></span>
                                                                    </button>
                                                                </a></td>
                                                        </tr>
                                                  @endforeach
                                            </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            @elseif(!isset($detail))
                                <div class="container-fluid" style="position: absolute; right: 2%; top: 14%; width: 46%">
                                    <p> <b>Add Subject/s: </b></p>
                                    <form role="search" class="app-search hidden-xs" method="post" action="/searchOverload/">
                                        {{ csrf_field() }}
                                        <input type="text" placeholder="Search for subjects..." class="form-control" name="overload" style="width: 45%; height: 30%;">
                                        <i class="fa fa-search" style="position: relative; right: 3%; color: gray;"></i>
                                    </form>
                                    <br>
                                    <div class="white-box">
                                        <div class="table-responsive" style="overflow-y:scroll; height: 600px; width: 100%; margin-top: -1%; ">
                                            <table class="table">
                                                <tr>
                                                    <th>CourseNo</th>
                                                    <th>Descriptive Title</th>
                                                    <th>Units</th>
                                                    <th>Course</th>
                                                    <th>Term</th>
                                                    <th>Action</th>
                                                </tr>
                                                <tbody>
                                                <?php
                                                $studs = DB::table('offered_subjects')
                                                    ->join('subjects', 'subjects.subjectID', '=', 'offered_subjects.subjectID')
                                                    ->get();
                                                ?>
                                                @foreach($studs as $studs)
                                                    <?php
                                                    $cc = $studs->subjectID;
                                                    $t = $studs->term;
                                                    ?>
                                                    <tr id="trRes">
                                                        <td class="txt-oflo">{{ $studs->coursenumber }}</td>
                                                        <td>{{ $studs->destitle }}</td>
                                                        <td>{{ $studs->units }}</td>
                                                        <td>{{ $studs->course }}</td>
                                                        <td>{{ $studs->term }}</td>
                                                        <td><a href='/addOve/{{$users}}/{{$cc}}/{{$t}}'>
                                                                <button class='btn btn-primary btn-sm'>
                                                                    <span class="fa fa-plus" aria-hidden="true"></span>
                                                                </button>
                                                            </a></td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            @elseif(isset($message))
                            <p>No Data!</p>
                                <div class="container-fluid" style="position: absolute; right: 2%; top: 14%; width: 46%">
                                    <p> <b>Add Subject/s: </b></p>
                                    <form role="search" class="app-search hidden-xs" method="post" action="/searchOverload/">
                                        {{ csrf_field() }}
                                        <input type="text" placeholder="Search for subjects..." class="form-control" name="overload" style="width: 45%; height: 30%;">
                                        <i class="fa fa-search" style="position: relative; right: 3%; color: gray;"></i>
                                    </form>
                                    <br>
                                    <div class="white-box">
                                        <div class="table-responsive" style="overflow-y:scroll; height: 600px; width: 100%; margin-top: -1%; ">
                                            <table class="table">
                                                <tr>
                                                    <th>CourseNo</th>
                                                    <th>Descriptive Title</th>
                                                    <th>Units</th>
                                                    <th>Course</th>
                                                    <th>Term</th>
                                                    <th>Action</th>
                                                </tr>
                                                <tbody>
                                                <?php
                                                $studs = DB::table('offered_subjects')
                                                    ->join('subjects', 'subjects.subjectID', '=', 'offered_subjects.subjectID')
                                                    ->get();
                                                ?>
                                                @foreach($studs as $studs)
                                                    <?php
                                                    $cc = $studs->subjectID;
                                                    $t = $studs->term;
                                                    ?>
                                                    <tr id="trRes">
                                                        <td class="txt-oflo">{{ $studs->coursenumber }}</td>
                                                        <td>{{ $studs->destitle }}</td>
                                                        <td>{{ $studs->units }}</td>
                                                        <td>{{ $studs->course }}</td>
                                                        <td>{{ $studs->term }}</td>
                                                        <td><a href='/addOve/{{$users}}/{{$cc}}/{{$t}}'>
                                                                <button class='btn btn-primary btn-sm'>
                                                                    <span class="fa fa-plus" aria-hidden="true"></span>
                                                                </button>
                                                            </a></td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            @endif
                    @endforeach
                </div>
            </div>
            @include('footer.footer')
        </div>
    </div>
    <!-- /#wrapper -->
    <!-- jQuery -->
    @include('script.script')
    </body>
@endforeach
@include('footer.footer')
</html>
