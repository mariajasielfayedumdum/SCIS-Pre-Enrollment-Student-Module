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
<body>
<div id="wrapper">
    <br>
    @include('layouts.nav')
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
                    <a href="/offeredSubjects" class="waves-effect"><i class="fa fa-columns fa-fw" aria-hidden="true"></i><span class="hide-menu">Subjects</span></a>
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
        <div class="container-fluid">
            <div class="row bg-title">
                <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                    <ol class="breadcrumb" style="position: relative;left:-50%;">
                        <li><a href="/petitions">Petitions</a></li>
                        <li class="active">Petition New Subject</li>
                    </ol>
                </div>
            </div>
            <form role="search" class="app-search hidden-xs" method="post" action="/searchopenPetition/">
                {{ csrf_field() }}
                <input type="text" placeholder="Search for subjects..." class="form-control" name="petition" style="width: 45%; height: 30%;">
                <i class="fa fa-search" style="position: relative; right: 3%; color: gray;"></i>
            </form>
            <br>
            <!-- SUBJECTS -->
            @if(isset($details))
                <div class="white-box" style="width: 55%; height: 700px;">
                    <div class="table-responsive" style="overflow-y:scroll; height: 650px; width: 100%; font-size: 100%; ">
                        <table class="table" style="position: absolute; display: block; z-index: 100; background-color:white;width: 43.7%; margin-top: -1%;">
                            <tr>
                                <th style="width: 10%;">Course Number</th>
                                <th style="width: 60%;">Descriptive Title</th>
                                <th style="width: 12%;">Units</th>
                            </tr>
                        </table>
                        <br><br><br>
                        <table class="table" style="width: 100%;">
                            <tbody>
                            @foreach ($details as $stud)
                                <?php
                                $course = $stud->destitle;
                                $id = $stud->subjectID;
                                $courses = $stud->coursenumber;
                                ?>
                                <tr>
                                    <td class="txt-oflo">{{ $stud->coursenumber }}</td>
                                    <td>{{ $stud->destitle }}</td>
                                    <td class="txt-oflo">{{ $stud->units }}</td>
                                    <td></td>
                                    <td>
                                        <a href='/addPetition/{{$id}}'>
                                            <button class='btn btn-primary btn-sm' >
                                                <i class="fa fa-hand-o-left" aria-hidden="true"></i>
                                            </button>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @elseif(!isset($details))
                <div class="white-box" style="width: 55%; height: 700px;">
                    <div class="table-responsive" style="overflow-y:scroll; height: 650px; width: 100%; font-size: 100%; ">
                        <table class="table" style="position: absolute; display: block; z-index: 100; background-color:white;width: 43.7%; margin-top: -1%;">
                            <tr>
                                <th style="width: 10%;">Course Number</th>
                                <th style="width: 60%;">Descriptive Title</th>
                                <th style="width: 12%;">Units</th>
                            </tr>
                        </table>
                        <br><br><br>
                        <table class="table" style="width: 100%;">
                            <tbody>
                            <?php
                            $subjects = DB::table('subjects')
                                ->DISTINCT()->orderby('coursenumber', 'asc')->get();
                            $number='continue here';
                            ?>
                            @foreach ($subjects as $subjects)
                                <?php
                                $course = $subjects->destitle;
                                $id = $subjects->subjectID;
                                $courses = $subjects->coursenumber;
                                ?>
                                <tr>
                                    <td class="txt-oflo">{{ $subjects->coursenumber }}</td>
                                    <td>{{ $subjects->destitle }}</td>
                                    <td class="txt-oflo">{{ $subjects->units }}</td>
                                    <td></td>
                                    <td>
                                        <a href='/addPetition/{{$id}}'>
                                            <button class='btn btn-primary btn-sm' >
                                                <i class="fa fa-hand-o-left" aria-hidden="true"></i>
                                            </button>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @elseif(isset($message))
                <h3>{{$message}}</h3>
                <div class="white-box" style="width: 55%; height: 700px;">
                    <div class="table-responsive" style="overflow-y:scroll; height: 650px; width: 100%; font-size: 100%; ">
                        <table class="table" style="position: absolute; display: block; z-index: 100; background-color:white;width: 43.7%; margin-top: -1%;">
                            <tr>
                                <th style="width: 10%;">Course Number</th>
                                <th style="width: 60%;">Descriptive Title</th>
                                <th style="width: 12%;">Units</th>
                            </tr>
                        </table>
                        <br><br><br>
                        <table class="table" style="width: 100%;">
                            <tbody>
                            <?php
                            $subjects = DB::table('subjects')
                                ->DISTINCT()->orderby('coursenumber', 'asc')->get();
                            $number='continue here';
                            ?>
                            @foreach ($subjects as $subjects)
                                <?php
                                $course = $subjects->destitle;
                                $id = $subjects->subjectID;
                                $courses = $subjects->coursenumber;
                                ?>
                                <tr>
                                    <td class="txt-oflo">{{ $subjects->coursenumber }}</td>
                                    <td>{{ $subjects->destitle }}</td>
                                    <td class="txt-oflo">{{ $subjects->units }}</td>
                                    <td></td>
                                    <td>
                                        <a href='/addPetition/{{$id}}'>
                                            <button class='btn btn-primary btn-sm' >
                                                <i class="fa fa-hand-o-left" aria-hidden="true"></i>
                                            </button>
                                        </a>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        </div>
        <!-- FORM -->
        @foreach($sub as $query)
            <?php
            $cc = $query->subjectID;
            ?>
            <div class="white-box" style="position: absolute; width: 37%; height: 350px; top: 20%; right: 1%;">
                <h4 style="text-align: center; font-size: 130%; letter-spacing:3px;"> Petition New Subject </h4>
                <div style="position: absolute; margin-left: 2%; font-size: 120%;">
                    <br>
                    <p>Course Number: {{$query->coursenumber}}</p>
                    <p>Descriptive Title: {{$query->destitle}}</p>
                    <p>Units: {{$query->units}}</p>
                </div>
                <form method="post" action="/addpetitionSub/{{$users}}/{{$cc}}">
                    <select class="form-control row b-none" name="cour" id="cour" style="width:25%; position: relative; margin-top:21%; margin-left: 0%; font-size: 120%; ">
                        <?php
                        $type = DB::table('enr_stat')->select('term')->distinct()->get();
                        ?>
                        <option value="All">Select Term</option>
                        @foreach($type as $type)
                            <option value="{!! $type->term !!}">{!! $type->term !!}</option>
                        @endforeach
                    </select>
                    {{csrf_field()}}
                    <button style="margin-left: 40%; margin-top:5%; width:15%; height: 20%; padding: 8px 10px 8px 10px; font-size: 120%;" class='btn btn-primary btn-sm'>Submit</button>
                </form>
            </div>
        @endforeach
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