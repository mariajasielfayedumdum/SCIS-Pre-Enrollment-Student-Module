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
                        <a href="/preenroll" class="waves-effect"><i class="fa fa-user fa-fw" aria-hidden="true"></i><span class="hide-menu">Pre Enrollment</span></a>
                    </li>
                    <li>
                        <a href="/offeredSubjects" class="waves-effect"><i class="fa fa-table fa-fw" aria-hidden="true"></i><span class="hide-menu">Subjects</span></a>
                    </li>
                    <li>
                        <a href="/overload" class="waves-effect"><i class="fa fa-address-card fa-fw" aria-hidden="true"></i><span class="hide-menu">Request for Overload</span></a>
                    </li>
                    <li>
                        <a href="/petitions" class="waves-effect"><i class="fa fa-folder-open fa-fw" aria-hidden="true"></i><span class="hide-menu">Petition Subject</span></a>
                    </li>
                    <li>
                        <a href="/checklist" class="waves-effect"><i class="fa fa-envelope-o fa-fw" aria-hidden="true"></i><span class="hide-menu">Checklist</span></a>
                    </li>
                    <li>
                        <a href="/profile" class="waves-effect"><i class="fa fa-calendar-check-o fa-fw" aria-hidden="true"></i><span class="hide-menu">Profile</span></a>
                    </li>

                </ul>
            </div>
        </div>
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Offered Subjects</h4> </div>
                </div>
                <div class="row" style="width: 100%;">
                    <div class="col-sm-12">
                        <div class="white-box">
                            <h3 class="box-title">Pre-Enrolled Subjects</h3>
                            <div class="input-group" style="left:0%; width: 45%; font-size: 90%; ">
                                <form role="search" method="post" action="/searchpresubj">
                                    {{ csrf_field() }}
                                    <span class="input-group-btn" style="position: relative; ">
                                <input type="text" class="form-control" id= "input" name="input" placeholder="Search for course number, descriptive title, term..." style="margin-bottom: 0%; border-radius: 5%;">
                            <button class="btn btn-default" type="submit" name="search" style="border-radius: 5%;">Enter</button>
                            <button class="btn btn-default" type="button" value="reset" style="border-radius: 5%;"><a href = "/offeredSubjects/">Reset</a></button>
                        </span>
                                </form>
                            </div>
                            <br>
                            @if(isset($details))
                                <div class="table-responsive" style="overflow-y:scroll; height: 680px; width: 100%;">
                                    <table class="table" style="position: absolute; display: block; z-index: 100; background-color:white;width: 90%;">
                                        <tr>
                                            <th>Course Number</th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th>
                                            <th>Descriptive Title</th>
                                            <th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th>
                                            <th>Units</th><th></th><th></th>
                                            <th>Term</th><th></th><th></th><th></th>
                                            <th>Number of Students</th><th></th><th></th><th></th><th></th><th></th>
                                        </tr>
                                    </table>
                                    <table class="table ">
                                        <tbody>
                                        <?php
                                        $subjects = DB::table('subjects')->join('pre_enroll', 'subjects.coursenumber', '=', 'pre_enroll.coursenumber')
                                            ->select('subjects.coursenumber', 'subjects.destitle', 'subjects.units', 'pre_enroll.term')
                                            ->DISTINCT()->orderby('coursenumber', 'asc')->get();
                                        $number='continue here';
                                        ?>
                                        @foreach($details as $stud)
                                            <?php
                                            $course =$stud->coursenumber ;
                                            $ter = $stud->term;
                                            $subject = DB::table('subjects')
                                                ->join('pre_enroll', 'subjects.coursenumber', '=', 'pre_enroll.coursenumber')
                                                ->select('pre_enroll.id_number')
                                                ->where('subjects.coursenumber', '=', $course)
                                                ->where('pre_enroll.term', '=', $ter)
                                                ->get();
                                            $number = count($subject);
                                            // $courses = $subjects->coursenumber;
                                            ?>
                                            <tr>
                                                <td class="txt-oflo">{{ $stud->coursenumber }}</td>
                                                <td>{{  $stud->destitle }}</td>
                                                <td class="txt-oflo">{{  $stud->units }}</td>
                                                <td class="txt-oflo">{{ $stud->term }}</td>
                                                <td><span class="text-success" style="text-align: center; align-content: center;">{{ $number }}</span></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @elseif(isset($message))
                                <h5>{{$message}}</h5>
                                <div class="table-responsive" style="overflow-y:scroll; height: 680px; width: 100%; font-size: 100%;">
                                    <table class="table" style="position: absolute; display: block; z-index: 100; background-color:white;width: 95%;">
                                        <tr>
                                            <th>Course Number</th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th>
                                            <th>Descriptive Title</th>
                                            <th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th>
                                            <th>Units</th><th></th>
                                            <th>Term</th><th></th><th></th>
                                            <th>Number of Students</th><th></th><th></th><th></th><th></th><th></th><th></th>
                                        </tr>
                                    </table>
                                    <table class="table" style="width: 100%;">

                                        <tbody>
                                        <?php
                                        $subjects = DB::table('subjects')->join('pre_enroll', 'subjects.coursenumber', '=', 'pre_enroll.coursenumber')->select('subjects.coursenumber', 'subjects.destitle', 'subjects.units', 'pre_enroll.term')->DISTINCT()->orderby('coursenumber', 'asc')->get();
                                        $number='continue here';
                                        ?>
                                        @foreach ($subjects as $subjects)
                                            <?php
                                            $course = $subjects->destitle;
                                            $ter = $subjects->term;
                                            $subject = DB::table('subjects')->join('pre_enroll', 'subjects.coursenumber', '=', 'pre_enroll.coursenumber')->select('pre_enroll.id_number')->where('subjects.destitle', '=', $course)->where('pre_enroll.term', '=', $ter)->get();
                                            $number = count($subject);
                                            $courses = $subjects->coursenumber;
                                            ?>
                                            <tr>
                                                <td class="txt-oflo">{{ $subjects->coursenumber }}</td>
                                                <td>{{ $subjects->destitle }}</td>
                                                <td class="txt-oflo">{{ $subjects->units }}</td>
                                                <td class="txt-oflo">{{ $subjects->term }}</td>
                                                <td><span class="text-success" style="text-align: center; align-content: center;">{{ $number }}</span></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @elseif(!isset($details))
                                <div class="table-responsive" style="overflow-y:scroll; height: 680px; width: 100%; font-size: 100%;">
                                    <table class="table" style="position: absolute; display: block; z-index: 100; background-color:white;width: 95%;">
                                        <tr>
                                            <th>Course Number</th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th>
                                            <th>Descriptive Title</th>
                                            <th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th>
                                            <th>Units</th><th></th>
                                            <th>Term</th><th></th><th></th>
                                            <th>Number of Students</th><th></th><th></th><th></th><th></th><th></th><th></th>
                                        </tr>
                                    </table>
                                    <br><br><br><br>
                                    <table class="table" >
                                        <tbody>
                                        <?php
                                        $subjects = DB::table('subjects')->join('pre_enroll', 'subjects.coursenumber', '=', 'pre_enroll.coursenumber')
                                            ->select('subjects.coursenumber', 'subjects.destitle', 'subjects.units', 'pre_enroll.term')
                                            ->DISTINCT()->orderby('coursenumber', 'asc')->get();
                                        $number='continue here';
                                        ?>
                                        @foreach ($subjects as $subjects)
                                            <?php
                                            $course = $subjects->destitle;
                                            $ter = $subjects->term;
                                            $subject = DB::table('subjects')->join('pre_enroll', 'subjects.coursenumber', '=', 'pre_enroll.coursenumber')->select('pre_enroll.id_number')->where('subjects.destitle', '=', $course)->where('pre_enroll.term', '=', $ter)->get();
                                            $number = count($subject);
                                            $courses = $subjects->coursenumber;
                                            ?>
                                            <tr>
                                                <td class="txt-oflo">{{ $subjects->coursenumber }}</td>
                                                <td>{{ $subjects->destitle }}</td>
                                                <td class="txt-oflo">{{ $subjects->units }}</td>
                                                <td class="txt-oflo">{{ $subjects->term }}</td>
                                                <td><span class="text-success" style="text-align: center; align-content: center;">{{ $number }}</span></td>
                                                <td></td>
                                                <td></td>
                                                <td></td>
                                            </tr>
                                        @endforeach
                                        </tbody>
                                    </table>
                                </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <!-- /.container-fluid -->
            @include('footer.footer')
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->
    <!-- jQuery -->
    @include('script.script')
    </body>
@endforeach

</html>
