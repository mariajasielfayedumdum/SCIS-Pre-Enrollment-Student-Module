<?php
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\DB;
?>
<!DOCTYPE html>
<html>
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <style>
        .overlay {
            position: fixed;
            top: 0;
            bottom: 0;
            left: 0;
            right: 0;
            background: rgba(0, 0, 0, 0.7);
            transition: opacity 500ms;
            visibility: hidden;
            opacity: 0;
        }
        .overlay:target {
            visibility: visible;
            opacity: 1;
        }

        .popup {
            margin: 70px auto;
            padding: 20px;
            background: #fff;
            border-radius: 5px;
            width: 30%;
            position: relative;
            transition: all 5s ease-in-out;
        }

        .popup h2 {
            margin-top: 0;
            color: #333;
            font-family: Tahoma, Arial, sans-serif;
        }
        .popup .close {
            position: absolute;
            top: 20px;
            right: 30px;
            transition: all 200ms;
            font-size: 30px;
            font-weight: bold;
            text-decoration: none;
            color: #333;
        }
        .popup .close:hover {
            color: #06D85F;
        }
        .popup .content {
            max-height: 30%;
            overflow: auto;
        }

        @media screen and (max-width: 700px){
            .box{
                width: 70%;
            }
            .popup{
                width: 70%;
            }
        }
    </style>
    <body>
    <div id="wrapper">
        <br>
        @include('layouts.nav')
        <div class="navbar-default sidebar" role="navigation">
            <div class="sidebar-nav navbar-collapse slimscrollsidebar">
                <ul class="nav" id="side-menu">
                    <li style="padding: 10px 0 0;">
                        <a href="/dashboard" class="waves-effect"><i class="	fa fa-dashboard fa-fw" aria-hidden="true"></i><span class="hide-menu">Dashboard</span></a>
                    </li>
                    <li>
                        <a href="/studentManagement" class="waves-effect"><i class="fa fa-user fa-fw" aria-hidden="true"></i><span class="hide-menu">Student Management</span></a>
                    </li>
                    <li>
                        <a href="/subjectManagement" class="waves-effect"><i class="fa fa-table fa-fw" aria-hidden="true"></i><span class="hide-menu">Subject Management</span></a>
                    </li>
                    <li>
                        <a href="/preenrollment" class="waves-effect"><i class="fa fa-address-card fa-fw" aria-hidden="true"></i><span class="hide-menu">Pre-Enrollment</span></a>
                    </li>
                    <li>
                        <a href="/petitions" class="waves-effect"><i class="	fa fa-folder-open fa-fw" aria-hidden="true"></i><span class="hide-menu">Petitions</span></a>
                    </li>
                    <li>
                        <a href="/overload" class="waves-effect"><i class="fa fa-envelope-o fa-fw" aria-hidden="true"></i><span class="hide-menu">Overload Requests</span></a>
                    </li>
                    <li>
                        <a href="/checklists" class="waves-effect"><i class="fa fa-calendar-check-o fa-fw" aria-hidden="true"></i><span class="hide-menu">Checklists</span></a>
                    </li>

                </ul>
            </div>
        </div>
        <div id="page-wrapper">
        <div class="container-fluid">
            <div class="row bg-title">
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                    <h4 class="page-title">Student Management</h4>
                </div>
            </div>
            <form role="search" class="app-search hidden-xs" method="post" action="/searchstud">
                {{ csrf_field() }}
                <input type="text" placeholder="Search for students..." class="form-control" name="search" style="width: 40%; height: 30%;">
                <a href="#"></a><i class="fa fa-search" style="position: relative; right: 2%; color: gray;"></i>
            </form>
            <br>
            <div class="col-md-2 col-sm-4 col-xs-12 pull-right" style="position: absolute; top: 13%; right: 1%;">
                <form method="get" action="/sortStud">
                    <select class="form-control row b-none" name="sortcourse" id="sortcourse" style="top: 1%; width: 50%; font-size: 110%; right: 0; position: relative;">
                        <?php
                        $types = DB::table('students')->select('course')->distinct()->get();
                        ?>
                        <option disabled selected>select course</option>
                        @foreach($types as $types)
                            <option value="{!! $types->course !!}">{!! $types->course !!}</option>
                        @endforeach
                    </select>
                    <select class="form-control row b-none" name="sortyear" id="sortyear" style="width: 50%; font-size: 110%; position: relative; right: -52%; margin-top: -12.8%;">
                        <?php
                        $typers = DB::table('students')->select('year')->distinct()->get();
                        ?>
                        <option disabled selected>select year</option>
                        @foreach($typers as $typers)
                            <option value="{!! $typers->year !!}">{!! $typers->year !!}</option>
                        @endforeach
                    </select>
                    <input type='submit' name = 'submit' value='Reset' style="position: relative; right: -75%; margin-top: 3%; border-radius: 5px; padding: 3px 15px 3px 15px;"/>
                    <input type='submit' name = 'submit' value='Apply' style="position: relative; right: -25%; border-radius: 5px; padding: 3px 15px 3px 15px;"/>
                </form>
                <?php
                $sortCourse=Input::get('sortcourse');
                $sortYear=Input::get('sortyear');
                ?>
                <h1 style="position:absolute;">{{$sortCourse}}{{$sortYear}}</h1>
            </div>
            @if(isset($details))
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="white-box">
                                <h3 class="box-title"> Students </h3>
                                <div class="table-responsive" style="overflow-y:scroll; height: 700px; ">
                                    <table class="table"  style="position: absolute; display: block; z-index: 100; background-color:white;width: 95%;">
                                        <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th>
                                            <th>ID Number</th><th></th><th></th><th></th><th></th><th></th><th></th>
                                            <th>Course&Year</th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th>
                                            <th>Status</th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th>
                                            <th>Profile</th><th></th><th></th><th></th>
                                        </tr>
                                        </thead>
                                    </table>
                                    <br><br>
                                    <table class="table ">
                                        <tbody>
                                        <?php
                                        $sql = DB::table('students')->join('pre_enroll', 'students.id_number', '=', 'pre_enroll.id_number')
                                            ->select('students.last_name', 'students.first_name', 'students.id_number', 'students.course', 'students.year', 'students.course as status')
                                            ->DISTINCT()
                                            ->orderBy('last_name','asc')->get();
                                        ?>
                                        @foreach($details as $stud)
                                            <tr>
                                                <td class="txt-oflo">{{ $stud->last_name}}, {{ $stud->first_name }}</td>
                                                <td>{{ $stud->id_number }}</td>
                                                <td class="txt-oflo">{{ $stud->course}} {{$stud->year }}</td>
                                                <?php
                                                $id = $stud->id_number;
                                                    $stat = "";
                                                $studs = DB::table('users')->where('username', '=', $id)->where('type', '=', 1)
                                                    ->select('username')->get();
                                                $studCount = count($studs);
                                                $status='';
                                                if(count($studs) > 0){
                                                    $stat = 'PRE-ENROLLEE';
                                                } if (count($studs) == 0){
                                                    $stat = 'NON PRE-ENROLLEE';
                                                }
                                                ?>
                                                <td><span class="text-success">{{ $stat }}</span></td>
                                                <td>
                                                    <a href="/studentprofile/{{$id}}">
                                                        <button class='btn btn-primary btn-sm'>
                                                            <span class='glyphicon glyphicon-user' aria-hidden='true'></span>
                                                        </button>
                                                    </a>
                                                </td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
            @elseif(isset($message))
                <p>{{ $message }}</p>
                <div class="row">
                    <div class="col-sm-12">
                        <div class="white-box">
                            <h3 class="box-title"> Students </h3>
                            <div class="table-responsive" style="overflow-y:scroll; height: 700px; ">
                                <table class="table"  style="position: absolute; display: block; z-index: 100; background-color:white;width: 95%;">
                                    <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th>
                                        <th>ID Number</th><th></th><th></th><th></th><th></th><th></th><th></th>
                                        <th>Course&Year</th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th>
                                        <th>Status</th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th>
                                        <th>Profile</th><th></th><th></th><th></th><th></th>
                                    </tr>
                                    </thead>
                                </table>
                                <br><br>
                                <table class="table ">
                                    <tbody>
                                    <?php
                                    $sql = DB::table('students')->join('pre_enroll', 'students.id_number', '=', 'pre_enroll.id_number')
                                        ->select('students.last_name', 'students.first_name', 'students.id_number', 'students.course', 'students.year')
                                        ->DISTINCT()->get();
                                    $subjects = DB::table('students')
                                        ->select('students.last_name', 'students.first_name', 'students.id_number', 'students.course', 'students.year', 'students.course as status')
                                        ->DISTINCT()->orderBy('last_name','asc')->get();
                                    ?>
                                    @foreach ($subjects as $subjects)
                                        <tr>
                                            <td class="txt-oflo">{{ $subjects->last_name}}, {{ $subjects->first_name }}</td>
                                            <td>{{ $subjects->id_number }}</td>
                                            <td class="txt-oflo">{{ $subjects->course}} {{$subjects->year }}</td>

                                            <?php
                                            $id = $stud->id_number;
                                            $stat = "";
                                            $studs = DB::table('users')->where('username', '=', $id)->where('type', '=', 1)
                                                ->select('username')->get();
                                            $studCount = count($studs);
                                            $status='';
                                            if(count($studs) > 0){
                                                $stat = 'PRE-ENROLLEE';
                                            } if (count($studs) == 0){
                                                $stat = 'NON PRE-ENROLLEE';
                                            }
                                            ?>
                                            <td><span class="text-success">{{ $stat }}</span></td>
                                            <td>
                                                <a href="/studentprofile/{{$id}}">
                                                    <button class='btn btn-primary btn-sm'>
                                                        <span class='glyphicon glyphicon-user' aria-hidden='true'></span>
                                                    </button>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                @elseif(!isset($details))
                <div class="row">
                    <div class="col-sm-12">
                        <div class="white-box">
                            <h3 class="box-title"> Students </h3>
                            <div class="table-responsive" style="overflow-y:scroll; height: 700px; ">
                                <table class="table"  style="position: absolute; display: block; z-index: 100; background-color:white;width: 95%;">
                                <thead>
                                    <tr>
                                        <th>Name</th>
                                        <th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th>
                                        <th>ID Number</th><th></th><th></th><th></th><th></th><th></th><th></th>
                                        <th>Course&Year</th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th>
                                        <th>Status</th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th>
                                        <th>Profile</th><th></th><th></th><th></th><th></th>
                                    </tr>
                                    </thead>
                                </table>
                                <br><br>
                                <table class="table ">
                                    <tbody>
                                    <?php
                                    $sql = DB::table('students')->join('pre_enroll', 'students.id_number', '=', 'pre_enroll.id_number')
                                        ->select('students.last_name', 'students.first_name', 'students.id_number', 'students.course', 'students.year')
                                        ->DISTINCT()->get();
                                    $subjects = DB::table('students')
                                        ->select('students.last_name', 'students.first_name', 'students.id_number', 'students.course', 'students.year', 'students.course as status')
                                        ->DISTINCT()->orderBy('last_name','asc')->get();
                                    ?>
                                    @foreach ($subjects as $subjects)
                                        <tr>
                                            <td class="txt-oflo">{{ $subjects->last_name}}, {{ $subjects->first_name }}</td>
                                            <td>{{ $subjects->id_number }}</td>
                                            <td class="txt-oflo">{{ $subjects->course}} {{$subjects->year }}</td>

                                            <?php
                                            $id = $subjects->id_number;
                                            $stat = "";
                                            $stud = DB::table('users')->where('username', '=', $id)->where('type', '=', 1)
                                                ->select('username')->get();
                                            $studCount = count($stud);
                                            $status='';
                                            if($stud){
                                                $stat = 'PRE-ENROLLEE';
                                                //  exit();

                                            } if ($stud->isEmpty()){
                                                $stat = 'NON PRE-ENROLLEE';
                                            }
                                            ?>
                                            <td><span class="text-success">{{ $stat }}</span></td>
                                            <td>
                                                <a href="/studentprofile/{{$id}}">
                                                    <button class='btn btn-primary btn-sm'>
                                                        <span class='glyphicon glyphicon-user' aria-hidden='true'></span>
                                                    </button>
                                                </a>
                                            </td>
                                        </tr>

                                    @endforeach
                                    </tbody>
                                </table>
                            </div>

                            <div id="popup1" class="overlay">
                                <div class="popup">
                                    <?php // $cours = $_GET['idnumber'];?>
                                    <h2>HI</h2>
                                    <a class="close" href="#">&times;</a>
                                    <div class="content">
                                        Thank to pop me out of that button, but now i'm done so you can close this window.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                @endif
            </div>
        </div>
        </div>
        @include('footer.footer')
    </div>
    <script src="/plugins/bower_components/jquery/dist/jquery.min.js"></script>
    <script src="/bootstrap/dist/js/bootstrap.min.js"></script>
    <script src="/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.js"></script>
    <script src="/js/jquery.slimscroll.js"></script>
    <script src="/js/waves.js"></script>
    <script src="/plugins/bower_components/waypoints/lib/jquery.waypoints.js"></script>
    <script src="/plugins/bower_components/counterup/jquery.counterup.min.js"></script>
    <script src="/plugins/bower_components/raphael/raphael-min.js"></script>
    <script src="/plugins/bower_components/morrisjs/morris.js"></script>
    <script src="/js/custom.min.js"></script>
    <script src="/js/dashboard1.js"></script>
    <script src="/plugins/bower_components/toast-master/js/jquery.toast.js"></script>
</body>
</html>