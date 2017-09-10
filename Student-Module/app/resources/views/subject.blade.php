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
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12"><i data-icon="E" class="linea-icon linea-basic"></i>
                    <h4 class="page-title">Subject Management</h4>
                </div>
            </div>
            <div class="row" style="width: 90%;">
                <div class="col-sm-7">
                    <div class="white-box">
                        <h3 class="box-title">Pre-Enrolled Subjects</h3>
                        <div class="input-group" style="left:0%; width: 45%; font-size: 90%; ">
                            <form role="search" method="post" action="/searchpresubj">
                                {{ csrf_field() }}
                                <span class="input-group-btn" style="position: relative; ">
                                <input type="text" class="form-control" id= "input" name="input" placeholder="Search for..." style="margin-bottom: 0%; border-radius: 5%;">
                            <button class="btn btn-default" type="submit" name="search" style="border-radius: 5%;">Enter</button>
                            <button class="btn btn-default" type="button" value="reset" style="border-radius: 5%;"><a href = "/subjectManagement/">Reset</a></button>
                        </span>
                            </form>
                        </div>
                        <br>
                        @if(isset($details))
                        <div class="table-responsive" style="overflow-y:scroll; height: 680px; width: 100%;">
                            <table class="table" style="position: absolute; display: block; z-index: 100; background-color:white;width: 90%;">
                                <tr>
                                    <th>Course Number</th>
                                    <th>Descriptive Title</th>
                                    <th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th>
                                    <th>Units</th>
                                    <th>Term</th>
                                    <th>Number of Students</th>
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
                                        <td><a href='/subjectprofile/{{$course}}/{{$ter}}'>
                                                <button class='btn btn-primary btn-sm'>
                                                    <span class='glyphicon glyphicon-list' aria-hidden='true'></span>
                                                </button>
                                            </a></td>
                                    </tr>
                                @endforeach
                                </tbody>
                            </table>
                        </div>
                        @elseif(isset($message))
                            <h5>{{$message}}</h5>
                            <div class="table-responsive" style="overflow-y:scroll; height: 680px; width: 100%; font-size: 100%;">
                                <table class="table" style="position: absolute; display: block; z-index: 100; background-color:white;width: 100%;">
                                    <tr>
                                        <th>Course Number</th>
                                        <th>Descriptive Title</th>
                                        <th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th>
                                        <th>Units</th>
                                        <th>Term</th>
                                        <th>Number of Students</th>
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
                                            <td><a href='/subjectprofile/{{$courses}}/{{$ter}}'>
                                                    <button class='btn btn-primary btn-sm'>
                                                        <span class='glyphicon glyphicon-list' aria-hidden='true'></span>
                                                    </button>
                                                </a></td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @elseif(!isset($details))
                            <div class="table-responsive" style="overflow-y:scroll; height: 680px; width: 100%; font-size: 100%;">
                                <table class="table" style="position: absolute; display: block; z-index: 100; background-color:white;width: 90%;">
                                    <tr>
                                        <th>Course Number</th>
                                        <th>Descriptive Title</th>
                                        <th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th>
                                        <th>Units</th>
                                        <th>Term</th>
                                        <th>Number of Students</th>
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
                                            <td><a href='/subjectprofile/{{$courses}}/{{$ter}}'>
                                                    <button class='btn btn-primary btn-sm'>
                                                        <span class='glyphicon glyphicon-list' aria-hidden='true'></span>
                                                    </button>
                                                </a></td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
            <div class="row" style="position: absolute; margin-left: 44.5%; top: 15%; width: 42.5%;">
                <div class="col-sm-12">
                    <div class="white-box">
                        <h3 class="box-title">Search and Open a Subject</h3>
                        <div class="input-group" style="left:0%; width: 45%; font-size: 90%; ">
                            <form method="get" role="search" action="/searchallsubj">
                                {{ csrf_field() }}
                                <span class="input-group-btn" style="position: relative; ">
                                <input type="text" class="form-control" id= "inputs" name="inputs" placeholder="Search for..." style="margin-bottom: 0%; border-radius: 5%;">
                            <button class="btn btn-default" type="submit" name="searchs" style="border-radius: 5%;">Enter</button>
                            <button class="btn btn-default" type="button" value="reset" style="border-radius: 5%;"><a href = "/subjectManagement">Reset</a></button>
                        </span>
                            </form>
                        </div>
                        @if(isset($detail))
                            <div class="table-responsive" style="margin-top: 2%; overflow-y:scroll; height:670px;">
                                <table class="table" style="position: absolute; display: block; z-index: 100; background-color:white;width: 90%;">
                                    <tr>
                                        <th>Course Number</th>
                                        <th>Descriptive Title</th>
                                        <th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th>
                                        <th>Units</th>
                                        <th></th><th></th>
                                        <th>Type</th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th>
                                    </tr>
                                </table>
                                <br><br><br>
                                <table class="table ">
                                    <tbody>
                                    @foreach ($detail as $studs)
                                        <?php
                                        $cou = $studs->coursenumber;
                                        ?>
                                        <tr>
                                            <td class="txt-oflo">{{ $studs->coursenumber }}</td>
                                            <td>{{ $studs->destitle }}</td>
                                            <td>{{ $studs->units }}</td>
                                            <td>{{ $studs->type }}</td>
                                            <td><a href='/opensubject/{{$cou}}'>
                                                    <button class='btn btn-primary btn-sm'>
                                                        <span class="fa fa-plus-square" aria-hidden="true"></span>
                                                    </button>
                                                </a></td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @elseif(!isset($detail))
                            <div class="table-responsive" style="margin-top: 2%; overflow-y:scroll; height:670px;">
                                <table class="table" style="position: absolute; display: block; z-index: 100; background-color:white;width: 90%;">
                                    <tr>
                                        <th>Course Number</th>
                                        <th>Descriptive Title</th>
                                        <th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th>
                                        <th>Units</th>
                                        <th>Type</th><th></th><th></th><th></th><th></th><th></th>
                                    </tr>
                                </table>
                                <br><br><br>
                                <table class="table ">
                                    <tbody>
                                    <?php
                                    $subjects = DB::table('subjects')->get();
                                    ?>
                                    @foreach ($subjects as $subjects)
                                        <?php
                                        $cou = $subjects->coursenumber;
                                        ?>
                                        <tr>
                                            <td class="txt-oflo">{{ $subjects->coursenumber }}</td>
                                            <td>{{ $subjects->destitle }}</td>
                                            <td>{{ $subjects->units }}</td>
                                            <td>{{ $subjects->type }}</td>
                                            <td><a href='/opensubject/{{$cou}}'>
                                                    <button class='btn btn-primary btn-sm'>
                                                        <span class="fa fa-plus-square" aria-hidden="true"></span>
                                                    </button>
                                                </a></td>
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                            @elseif(isset($message))

                        <div class="table-responsive" style="margin-top: 2%; overflow-y:scroll; height:670px;">
                            <table class="table" style="position: absolute; display: block; z-index: 100; background-color:white;width: 86%;">
                                <tr>
                                    <th>Course Number</th>
                                    <th>Descriptive Title</th>
                                    <th>Units</th>
                                    <th>Type</th>
                                </tr>
                            </table>
                            <table class="table ">
                                <tbody>
                                <?php
                                $subjects = DB::table('subjects')->get();
                                ?>
                                @foreach ($subjects as $subjects)
                                <?php
                                $cou = $subjects->coursenumber;
                                ?>
                                    <tr>
                                        <td class="txt-oflo">{{ $subjects->coursenumber }}</td>
                                        <td>{{ $subjects->destitle }}</td>
                                        <td>{{ $subjects->units }}</td>
                                        <td>{{ $subjects->type }}</td>
                                        <td><a href='/opensubject/{{$cou}}'>
                                                <button class='btn btn-primary btn-sm'>
                                                    <span class="fa fa-plus-square" aria-hidden="true"></span>
                                                </button>
                                            </a></td>
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