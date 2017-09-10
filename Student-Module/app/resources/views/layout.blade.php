<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" sizes="16x16" href="/plugins/images/scis.png">
    <title>SCIS Pre-Enrollment</title>
    <link href="/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/plugins/bower_components/sidebar-nav/dist/sidebar-nav.min.css" rel="stylesheet">
    <link href="/plugins/bower_components/toast-master/css/jquery.toast.css" rel="stylesheet">
    <link href="/plugins/bower_components/morrisjs/morris.css" rel="stylesheet">
    <link href="/css/animate.css" rel="stylesheet">
    <link href="/css/style.css" rel="stylesheet">
    <link href="/css/style-2.css" rel="stylesheet">
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
            <div id="page-wrapper">
                <div class="row bg-title">
                    <h4 class="page-title" style="margin-left:3%">Welcome!</h4>
                </div>
            </div>
            <div class="container" style="width:90%; position: relative">
                <div class="row">
                    <center>
                        <div class="col-sm-30 col-xs-20 heading-text">
                            <div class="single_home_content wow zoomIn" data-wow-duration="1s">
                                <div class="button" style="margin-left: 16%; margin-right: 6%; position: relative; margin-top:-45%; border-style: dotted">
                                    <br>
                                    <a href="/preenroll" class="butn" style="color: black; border-color: #0f0f0f">Pre-Enroll</a>
                                    <a href="/checklist" class="butn" style="color: black; border-color: #0f0f0f">Update Checklist</a>
                                    <a href="/offeredSubjects" class="butn" style="color: black; border-color: #0f0f0f">View Offered Subjects</a>
                                    <a href="/petitions" class="butn" style="color: black; border-color: #0f0f0f">Petition Subject</a>
                                    <a href="/overload" class="butn" style="color: black; border-color: #0f0f0f">Request for Overload</a>
                                    <a href="/profile" class="butn" style="color: black; border-color: #0f0f0f">View Profile</a>
                                    <br>
                                </div>
                            </div>
                        </div>
                    </center>
                </div> <!-- end of row -->
            </div> <!-- end of container -->

        <div class="row" id="dashstud">
            <div class="col-md-4 col-lg-6 col-sm-12">
                <div class="white-box" style="overflow-y:scroll; height: 500px; width: 80%">
                    <h3 class="box-title">Status of Petitioned Subjects</h3>
                    <div class="message-center">
                        <?php
                        $subj = DB::table('petitions')
                            ->join('subjects', 'subjects.subjectID', '=', 'petitions.subjectID')
                            ->select(array('petitions.subjectID', 'subjects.coursenumber', 'subjects.destitle', DB::raw('COUNT(petitions.subjectID) as count')))
                            ->groupBy('petitions.subjectID')
                            ->orderBy('count', 'desc')
                            ->limit(7)
                            ->get();
                        ?>
                        @foreach($subj as $subj)
                            <?php
                            $subjID = $subj->subjectID;
                            $subjs = DB::table('petitions')->select('term')->distinct()->where('subjectID', '=', $subjID)->get();
                            // echo $subjID;
                            $c = count($subjs);
                            ?>
                            @foreach($subjs as $subjs)
                                <a href="/petitions">
                                    <div class="mail-content">
                                        <h5>{{ $subj-> coursenumber }} -- {{ $subj->destitle }}</h5>
                                        <span class="mail-desc" ></span>Number of Students: {{ $subj->count}} &nbsp&nbsp Term: {{$subjs->term}}
                                    </div>
                                </a>
                            @endforeach
                        @endforeach
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-4 col-sm-12">
                <div class="white-box" style="overflow-y:scroll; height: 500px; margin-left: -18%; width: 80%">
                    <h3 class="box-title">Status of Overload Requests</h3>
                    <div class="message-center">
                        <?php
                        $overload = DB::table('overloading')
                            ->join('subjects', 'subjects.subjectID', '=', 'overloading.subjectID')
                            ->join('students', 'students.id_number', '=', 'overloading.id_number')
                            ->orderBy('overloading.overloadID', 'desc')->limit(5)
                            ->get();
                        ?>
                        @foreach($overload as $overload)
                            <a href="/overload">
                                <div class="mail-contnet">
                                    <h5>{{ $overload -> last_name }}, {{ $overload -> first_name }} -- {{  $overload->id_number }}</h5>
                                    <span class="mail-desc"></span> Subject: {{ $overload->coursenumber }} -- {{ $overload->destitle }} -- {{ $overload->units }} Units <br> Status: {{ $overload->status }}
                                </div>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

    @include('footer.footer')
    <!-- jQuery -->
    </div>
    @include('script.script')
    </body>
    @endforeach

</html>
