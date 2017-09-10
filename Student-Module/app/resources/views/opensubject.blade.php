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
                    <ol class="breadcrumb" style="position: relative;left:-40%;">
                        <li><a href="/subjectManagement">Subject Management</a></li>
                        <li class="active">Open Subject</li>
                    </ol>
                </div>
            </div>
            @foreach($coursenumber as $coursenumber)
                <?php
                $course = $coursenumber->destitle;
                $courses = $coursenumber->coursenumber;
                ?>
            <div class="white-box" style="width: 85%; margin: 0 auto; height: 350px;">
                <div style=" margin:0 auto; width:85%;">
                    <h4 style="text-align: center; font-size: 130%; letter-spacing:3px;"> Open a Subject: </h4>
                    <div style="position: absolute; margin-left: 2%; font-size: 120%;">
                        <p>Course Number: {{$coursenumber->coursenumber}}</p>
                        <p>Descriptive Title: {{$coursenumber->destitle}}</p>
                    </div>
                    <p style="position: absolute; margin-left: 45%; font-size: 120%;">Units: {{$coursenumber->units}}</p>

                    <?php
                    $subject = DB::table('subjects')->select('subjectID')
                        ->where('coursenumber', '=', $courses)
                        ->get();
                    ?>
                    @foreach($subject as $subject)
                        <?php
                        $sub = $subject->subjectID;
                        ?>
                    @endforeach
                    <form method="post" action="/subjectManagement/{{$sub}}">
                        <select class="form-control row b-none" name="term" id="term" style="width: 20%; position: relative; margin-top: 5%; margin-left: 74%;; font-size: 120%;">
                            <?php
                            $types = DB::table('enr_stat')->select('term')->distinct()->get();
                            ?>
                             <option disabled selected>Select Term</option>
                            @foreach($types as $types)
                                <option value="{!! $types->term !!}">{!! $types->term !!}</option>
                            @endforeach
                        </select>
                        <select class="form-control row b-none" name="cour" id="cour" style="width: 20%; position: relative; margin-top: 0; margin-left: 2%; font-size: 120%; ">
                            <?php
                            $type = DB::table('checklist')->select('course')->distinct()->get();
                            ?>
                            <option value="All">Open for All</option>
                            @foreach($type as $type)
                                <option value="{!! $type->course !!}">For {!! $type->course !!} only</option>
                            @endforeach
                        </select>
                        {{csrf_field()}}
                            <input class='btn btn-primary btn-sm' value="Open" style="margin-left: 40%; margin-top:5%; width:15%; height: 20%; padding: 8px 10px 8px 10px; font-size: 120%;" type="submit">
                    </form>
                </div>
            </div>
            @endforeach
            <br><br>
            <br><br>
            <br><br>
            <br><br>
            <br><br>
            <br><br>
            <br><br>
            <br><br>
            <br><br>

            <?php

            ?>
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