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
                    <h4 class="page-title">Pre-Enrollment</h4>
                </div>
            </div>
            <div class="container-fluid">
                @if(isset($details))
                    @foreach($details as $stud)
                        <br>
                        <h4>Name: {{$stud->last_name}}, {{$stud->first_name}}</h4>
                        <h5>Course&Year: {{$stud->course}} {{$stud->year}}</h5><br>
                        <p style="position:absolute; left:25%;"> <b>Pre-Enrolled Subjects</b></p>
                        <p style="position:absolute; left:40%;"> <b>Max Units Allowed: </b></p>
                        <br>
                        <div class="white-box" style="width: 45%; height: 670px;">
                            <div class="table-responsive" style="overflow-y:scroll; height: 560px; width: 100%; margin-top: -.6%;">
                                <table class="table" id="copy">
                                    <th>Course Number</th>
                                    <th>Descriptive Title</th>
                                    <th>Units</th>
                                    <th></th>
                                    <tbody>
                                    <?php
                                    $id= $stud->id_number;
                                    $preenroll = DB::table('pre_enroll')
                                        ->join('subjects', 'subjects.coursenumber', '=', 'pre_enroll.coursenumber')
                                        ->join('students', 'students.id_number', '=', 'pre_enroll.id_number')
                                        ->where('pre_enroll.id_number', '=', $id)
                                        ->where('pre_enroll.term', '=', 'First')
                                        ->get();
                                    ?>
                                    @foreach($preenroll as $preenroll)
                                        <?php
                                        $c = $preenroll->coursenumber;
                                        ?>
                                        <tr>
                                            <td class="txt-oflo" style="height: 30px;">{{ $preenroll->coursenumber}}</td>
                                            <td>{{$preenroll->destitle}}</td>
                                            <td class="txt-oflo">{{$preenroll->units}}</td>
                                            <td>
                                                <a href='/delete/{{$id}}/{{$c}}'>
                                                    <button class='btn btn-primary btn-sm' >
                                                        <span class="fa fa-times" aria-hidden="true"></span>
                                                    </button>
                                                </a>
                                            </td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div><hr>
                            <?php
                            $id= $stud->id_number;
                            $students = DB::table('subjects')->selectRaw('sum(subjects.units) AS stotal')
                                ->join('pre_enroll', 'subjects.coursenumber', '=', 'pre_enroll.coursenumber')
                                ->where('pre_enroll.id_number', '=', $id)
                                ->where('pre_enroll.term', '=', 'First')
                                ->get();
                            ?>
                            @foreach($students as $students)
                                <p>Total Units: {{$students->stotal }}</p>
                            @endforeach
                            <a href="/preenrollment"><input type="button" value="Pre-Enroll" class="btn btn-primary btn-sm" style="position: absolute; margin-top: -2%; margin-left: 31%; padding: 5px 10px 5px 10px; font-size: 100%;">
                            </a> </div>
                        <!-- search subjects
                        include
-->
                        <div class="container-fluid" style="position: absolute; right: 1%; top: 14%; width: 45%;">
                            <p> <b>Add Subject/s: </b></p>
                            <form role="search" class="app-search hidden-xs" method="post" action="/searchavail/{{$id}}">
                                {{ csrf_field() }}
                                <input type="text" placeholder="Search for subjects..." class="form-control" name="searchavail" style="width: 45%; height: 30%;">
                                <i class="fa fa-search" style="position: relative; right: 3%; color: gray;"></i>
                            </form>
                            <br>
                                <div class="white-box">
                                    <div class="table-responsive" style="overflow-y:scroll; height: 650px; width: 100%; margin-top: -1%; ">
                                        <table class="table"  style="position: absolute; display: block; z-index: 100; background-color:white;width: 86%;">
                                            <tr >
                                                <th>CourseNo</th><th></th><th></th>
                                                <th>Descriptive Title</th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th>
                                                <th>Units</th>
                                                <th></th>
                                                <th>Course</th>
                                                <th>Term</th>
                                                <th></th><th></th>
                                            </tr>
                                        </table>
                                        <br><br><br>
                                        <table class="table" id="tables">
                                            <?php
                                                $studs = DB::table('offered_subjects')
                                                ->join('subjects', 'subjects.subjectID', '=', 'offered_subjects.subjectID')
                                                ->get();
                                                $id= $stud->id_number;
                                                ?>
                                                @foreach($studs as $studs)
                                                    <?php
                                                    $cc = $studs->coursenumber;
                                                    $t = $studs->term;
                                                    ?>
                                                <tr id="trRes">
                                                    <td class="txt-oflo">{{ $studs->coursenumber }}</td>
                                                    <td>{{ $studs->destitle }}</td>
                                                    <td>{{ $studs->units }}</td>
                                                    <td>{{ $studs->course }}</td>
                                                    <td>{{ $studs->term }}</td>
                                                    <td><a href='#'>
                                                            <button class='btn btn-primary btn-sm'>
                                                                <span class="fa fa-plus" aria-hidden="true"></span>
                                                            </button>
                                                        </a></td>
                                                </tr>
                                           @endforeach
                                        </table>
                                    </div>
                                </div>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
        @include('footer.footer')
    </div>
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