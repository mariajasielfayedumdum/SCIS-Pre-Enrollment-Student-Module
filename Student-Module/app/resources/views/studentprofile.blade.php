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
    i.fa-eye span {
        position: absolute;
        width:140px;
        color: #FFFFFF;
        background: #000000;
        height: 30px;
        line-height: 30px;
        text-align: center;
        visibility: hidden;
        border-radius: 6px;
    }
   i.fa-eye span:after {
        content: '';
        position: absolute;
        top: 100%;
        left: 50%;
        margin-left: -8px;
        width: 0; height: 0;
        border-top: 8px solid #000000;
        border-right: 8px solid transparent;
        border-left: 8px solid transparent;
    }
    i:hover.fa-eye span {
        display: block;
        position: absolute;
        margin-top: -6%;
        right: 6%;
        width: 10%;
        visibility: visible;
        opacity: 0.8;
        z-index: 999;
    }
</style>
<body>
 <div id="wrapper">
    <br>
@include ('layouts.nav')
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
                    <ol class="breadcrumb" style="position: relative;left:-40%;">
                        <li><a href="/studentManagement">Student Management</a></li>
                        <li class="active">Student Profile</li>
                    </ol>
                </div>
            </div>
        @foreach($idnumber as $idnumber)
        <?php
        $id = $idnumber->id_number;
        $stud = DB::table('users')->where('username', '=', $id)->where('type', '=', 1)
            ->DISTINCT()->select('username')->get();
        $studCount = count($stud); ?>
            @endforeach
            <?php
        if($studCount != 0){
        ?>
            <h4><b>{!! $idnumber->last_name !!}, {!! $idnumber->first_name !!}</b></h4>
            <a href="/studentChecklist/{{$id}}"><button class="btn btn-primary btn-sm" style="position: absolute; top: 15%; left:44%; padding: 6px 15px 6px 15px;">View Checklist</button></a>
            <h5>Course&Year: {!! $idnumber->course !!} {!! $idnumber->year !!}</h5>
            <h5 style="position:absolute; left:43%; top: 17.8%;">ID Number: {{$idnumber->id_number}}</h5>
            <h4 style="position: absolute; left: 27%;"> <b>Pre-Enrolled Subjects</b></h4><br><br>
            <?php
                if(($idnumber->year) == 2){
                    $maxUnits=24;
                }
                if(($idnumber->year) == 3){
                    $maxUnits=18;
                }
                if(($idnumber->year) == 4){
                    $maxUnits=21;
                }
                ?>
            <div class="white-box" style="width: 45%; height: 670px;">
                <div class="table-responsive" style="overflow-y:scroll; height: 580px; margin-top: -2%;">
                    <table class="table" style="position: absolute; display: block; z-index: 100; background-color:white;width: 35%;">
                        <tr >
                            <th>Course Number</th><th></th>
                            <th>Descriptive Title</th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th>
                            <th>Units</th>
                            <th></th>
                        </tr>
                    </table>
                    <br><br><br>
                    <table class="table">
                        <tbody>
                        <?php
                        $id = $idnumber->id_number;
                        $student = DB::table('pre_enroll')
                            ->join('subjects', 'subjects.coursenumber', '=', 'pre_enroll.coursenumber')
                            ->join('students', 'students.id_number', '=', 'pre_enroll.id_number')
                            ->where('pre_enroll.id_number', '=', $id)
                            ->where('pre_enroll.term', '=', 'First')
                            ->get();
                        ?>
                        @foreach ($student as $student)
                            <tr>
                                <td class="txt-oflo" style="height: 30px;">{{ $student->coursenumber }}</td>
                                <td>{{ $student->destitle }}</td>
                                <td class="txt-oflo">{{ $student->units }}</td>
                            </tr>

                        @endforeach

                        </tbody>
                    </table>
            </div>
                <?php
                $id = $idnumber->id_number;
                $students = DB::table('subjects')->selectRaw('sum(subjects.units) AS stotal')
                    ->join('pre_enroll', 'subjects.coursenumber', '=', 'pre_enroll.coursenumber')
                    ->where('pre_enroll.id_number', '=', $id)
                    ->where('pre_enroll.term', '=', 'First')
                    ->get();
                ?>
                <hr>
                @foreach($students as $students)
                    <div style="">
                        <p style="position: absolute;">Term: First Semester</p>
                        <p style="position: absolute; left:45%;">
                            Total Units: {{ $students->stotal }}</p>
                        <p style="position:absolute; left: 29%;">
                            Max Units Allowed: {{$maxUnits}}</p>
                    </div>
                @endforeach
            </div>
        </div> <!-- container fluid -->

        <div class="container-fluid" style="position: absolute; right: 1%; top: 15%; width: 45%; ">
            <p> <b>Overloaded Subject/s: </b></p>
            <div class="white-box">
                <div class="table-responsive" style="overflow-y:scroll; height:230px; width: 100%; margin-top: -1%; ">
                    <table class="table">
                        <tr>
                            <th>Course Number</th>
                            <th>Descriptive Title</th>
                            <th>Units</th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                        <tbody>
                        <?php
                        $student = DB::table('overloading')
                            ->join('subjects', 'subjects.subjectID', '=', 'overloading.subjectID')
                            ->where('overloading.id_number', '=', $id)
                            ->get();
                        ?>
                        @foreach ($student as $student)
                            <tr>
                                <td class="txt-oflo" style="height: 30px;">{{ $student->coursenumber }}</td>
                                <td>{{ $student->destitle }}</td>
                                <td class="txt-oflo">{{ $student->units }}</td>
                                <td>{{$student->status}}</td>
                                <td>
                                    <a href="#">
                                        <i class="fa fa-eye" aria-hidden="true">
                                            <span>View Details</span></i>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <hr>
                <?php
                $total = DB::table('overloading')->selectRaw('SUM(units) AS totalUnits')
                    ->join('subjects', 'subjects.subjectID', '=', 'overloading.subjectID')
                    ->where('overloading.id_number', '=', $id)
                    ->get();
                ?>
                @foreach($total as $total)
                    <p>Total Units: {{$total->totalUnits}}</p>
                    @endforeach
            </div>
            <div class="container-fluid" style="position: absolute; right: 1%; margin-top: 2%; width: 100%; ">
                <p> <b>Petitioned Subject/s: </b></p>
                <div class="white-box">
                    <div class="table-responsive" style="overflow-y:scroll; height: 230px; width: 100%; margin-top: -1%; ">
                        <table class="table">
                            <tr>
                                <th>Course Number</th>
                                <th>Descriptive Title</th>
                                <th>Units</th>
                                <th>Term</th>
                                <th></th>
                            </tr>
                            <tbody>
                            <?php
                            $student = DB::table('petitions')
                                ->join('students', 'students.id_number', '=', 'petitions.id_number')
                                ->join('subjects', 'subjects.subjectID', '=', 'petitions.subjectID')
                                ->where('petitions.id_number', '=', $id)
                                ->get();
                            ?>
                            @foreach ($student as $student)
                                <tr>
                                    <td class="txt-oflo" style="height: 30px;">{{ $student->coursenumber }}</td>
                                    <td>{{ $student->destitle }}</td>
                                    <td class="txt-oflo">{{ $student->units }}</td>
                                    <td>{{ $student->term }}</td>
                                    <td>
                                        <a href="#">
                                            <i class="fa fa-eye" aria-hidden="true">
                                                <span>View Details</span></i>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                    <hr>
                    <?php
                    $total = DB::table('petitions')->selectRaw('SUM(units) AS totalUnits')
                        ->join('subjects', 'subjects.subjectID', '=', 'petitions.subjectID')
                        ->where('petitions.id_number', '=', $id)
                        ->get();
                    ?>
                    @foreach($total as $total)
                        <p>Total Units: {{$total->totalUnits}}</p>
                    @endforeach
                </div>
            </div>
            <?php
            }
            if($stud->isEmpty()){ ?>
            <div class="container-fluid">
                <h4><b>{!! $idnumber->last_name !!}, {!! $idnumber->first_name !!}</b></h4>
                <h5>Course&Year: {!! $idnumber->course !!} {!! $idnumber->year !!}</h5>
                <h5>ID Number: {{$idnumber->id_number}}</h5>
                <?php
                $id = $idnumber->id_number;
                ?>
                <br>
                <div class="white-box" style="height: 600px;">
                    <center><h4 style="position:relative; margin-top: 40px;">STUDENT DID NOT PRE-ENROLL!</h4><br>
                        <a href="/studentManagement">
                            <button class='btn btn-primary btn-sm' style="font-size: 120%; margin-left: -13%;"><i class="fa fa-reply" aria-hidden="true"></i> Go Back</button>
                        </a>
                        <form method="post" action="/preenrollStud/{{$id}}">
                            {{csrf_field()}}
                                <button class='btn btn-primary btn-sm' style="font-size: 120%; position: absolute; margin-left: -1.9%; margin-top: -2%;"><i class="fa fa-plus" aria-hidden="true"></i> Pre-Enroll Student</button>
                        </form>
                    </center>
                </div>
            </div>
            <?php
            }
            ?>
            </div>
        </div>
    @include('footer.footer')
        <!-- /#page-wrapper -->
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
