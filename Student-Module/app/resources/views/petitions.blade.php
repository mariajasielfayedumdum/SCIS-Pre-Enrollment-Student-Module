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
        <div id="page-wrapper">
            <div class="container-fluid">
                <div class="row bg-title">
                    <div class="col-lg-3 col-md-4 col-sm-4 col-xs-12">
                        <h4 class="page-title">Petitions</h4> </div>
                </div>

                @if(isset($messages))
                    <center><h4>{{$messages}}</h4></center>
                    <form role="search" class="app-search hidden-xs" method="post" action="/searchPetition/">
                        {{ csrf_field() }}
                        <input type="text" placeholder="Search for subjects..." class="form-control" name="petition" style="width: 45%; height: 30%;">
                        <i class="fa fa-search" style="position: relative; right: 3%; color: gray;"></i>
                    </form>
                    <br>
                    <div style="width: 100%;">
                        <center>
                            @if(isset($details))
                                <div class="white-box" style="width: 90%; height: 650px;">
                                    <div class="table-responsive">
                                        <table class="table" id="copy">
                                            <tr>
                                                <th style="width:15%;" >Course Number</th>
                                                <th style="width:25%;" >Descriptive Title</th>
                                                <th style="width:15%;" >Units</th>
                                                <th style="width:15%;" >Term</th>
                                                <th style="width:15%;" >Number of Students</th>
                                                <th style="width:15%;" ></th>
                                            </tr>
                                            <tbody>
                                            @foreach($details as $stud)
                                                <?php
                                                $c = $stud->subjectID;
                                                $course=$stud->coursenumber;
                                                $ter=$stud->term;
                                                $subject = DB::table('subjects')
                                                    ->join('petitions', 'subjects.subjectID', '=', 'petitions.subjectID')
                                                    ->select('petitions.id_number')
                                                    ->where('subjects.coursenumber', '=', $course)
                                                    ->where('petitions.term', '=', $ter)
                                                    ->get();
                                                $number = count($subject);
                                                ?>
                                                <tr>
                                                    <td class="txt-oflo" style="height: 30px;">{{ $stud->coursenumber}}</td>
                                                    <td>{{$stud->destitle}}</td>
                                                    <td class="txt-oflo">{{$stud->units}}</td>
                                                    <td class="txt-oflo">{{$stud->term}}</td>
                                                    <td class="txt-oflo">{{ $number }}</td>
                                                    <td>
                                                        <a href='/petitionSub/{{$users}}/{{$c}}/{{$ter}}'>
                                                            <button class='btn btn-primary btn-sm' >
                                                                <span class="fa fa-plus" aria-hidden="true"></span>
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
                                <div class="white-box" style="width: 90%; height: 650px;">
                                    <div class="table-responsive" style="overflow-y:scroll; height: 560px; width: 100%; margin-top: -.6%;">
                                        <table class="table">
                                            <tr>
                                                <th style="width:15%;" >Course Number</th>
                                                <th style="width:25%;" >Descriptive Title</th>
                                                <th style="width:15%;" >Units</th>
                                                <th style="width:15%;" >Term</th>
                                                <th style="width:15%;" >Number of Students</th>
                                                <th style="width:15%;" ></th>
                                            </tr>
                                            <tbody>
                                            <?php
                                            $preenroll = DB::table('petitions')
                                                ->join('subjects', 'subjects.subjectID', '=', 'petitions.subjectID')
                                                ->join('students', 'students.id_number', '=', 'petitions.id_number')
                                                ->get();

                                            ?>
                                            @foreach($preenroll as $preenroll)
                                                <?php
                                                $c = $preenroll->subjectID;
                                                $course=$preenroll->coursenumber;
                                                $ter=$preenroll->term;
                                                $subject = DB::table('subjects')
                                                    ->join('petitions', 'subjects.subjectID', '=', 'petitions.subjectID')
                                                    ->select('petitions.id_number')
                                                    ->where('subjects.coursenumber', '=', $course)
                                                    ->where('petitions.term', '=', $ter)
                                                    ->get();
                                                $number = count($subject);
                                                ?>
                                                <tr>
                                                    <td class="txt-oflo" style="height: 30px;">{{ $preenroll->coursenumber}}</td>
                                                    <td>{{$preenroll->destitle}}</td>
                                                    <td class="txt-oflo">{{$preenroll->units}}</td>
                                                    <td class="txt-oflo">{{$preenroll->term}}</td>
                                                    <td class="txt-oflo">{{ $number }}</td>
                                                    <td style="width: 15%;">
                                                        <a href='/petitionSub/{{$users}}/{{$c}}/{{$ter}}'>
                                                            <button class='btn btn-primary btn-sm' >
                                                                <i class="fa fa-pencil-square" aria-hidden="true"></i>
                                                                Petition Subject
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
                                <h5>{{$messages}}</h5>
                                <div class="white-box" style="width: 90%; height: 650px;">
                                    <div class="table-responsive">
                                        <table class="table" id="copy">
                                            <tr>
                                                <th style="width:15%;" >Course Number</th>
                                                <th style="width:25%;" >Descriptive Title</th>
                                                <th style="width:15%;" >Units</th>
                                                <th style="width:15%;" >Term</th>
                                                <th style="width:15%;" >Number of Students</th>
                                                <th style="width:15%;" ></th>
                                            </tr>
                                            <tbody>
                                            <?php
                                            $preenroll = DB::table('petitions')
                                                ->join('subjects', 'subjects.subjectID', '=', 'petitions.subjectID')
                                                ->join('students', 'students.id_number', '=', 'petitions.id_number')
                                                ->get();

                                            ?>
                                            @foreach($preenroll as $preenroll)
                                                <?php
                                                $c = $preenroll->subjectID;
                                                $course=$preenroll->coursenumber;
                                                $ter=$preenroll->term;
                                                $subject = DB::table('subjects')
                                                    ->join('petitions', 'subjects.subjectID', '=', 'petitions.subjectID')
                                                    ->select('petitions.id_number')
                                                    ->where('subjects.coursenumber', '=', $course)
                                                    ->where('petitions.term', '=', $ter)
                                                    ->get();
                                                $number = count($subject);
                                                ?>
                                                <tr>
                                                    <td class="txt-oflo" style="height: 30px;">{{ $preenroll->coursenumber}}</td>
                                                    <td>{{$preenroll->destitle}}</td>
                                                    <td class="txt-oflo">{{$preenroll->units}}</td>
                                                    <td class="txt-oflo">{{$preenroll->term}}</td>
                                                    <td class="txt-oflo">{{ $number }}</td>
                                                    <td>
                                                        <a href='/petitionSub/{{$users}}/{{$c}}/{{$ter}}'>
                                                            <button class='btn btn-primary btn-sm' >
                                                                <span class="fa fa-plus" aria-hidden="true"></span>
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
                        </center>
                    </div>
                    @endif

                <form role="search" class="app-search hidden-xs" method="post" action="/searchPetition/">
                    {{ csrf_field() }}
                    <input type="text" placeholder="Search for subjects..." class="form-control" name="petition" style="width: 45%; height: 30%;">
                    <i class="fa fa-search" style="position: relative; right: 3%; color: gray;"></i>
                </form>
                <br>
                <div style="width: 100%;">
                    <center>
                        @if(isset($details))
                            <div class="white-box" style="width: 90%; height: 650px;">
                                <div class="table-responsive" style="overflow-y:scroll; height: 560px; width: 100%; margin-top: -.6%;">
                                    <table class="table" id="copy">
                                        <tr>
                                            <th>Course Number</th>
                                            <th>Descriptive Title</th>
                                            <th>Units</th>
                                            <th>Term</th>
                                            <th>Number of Students</th>
                                            <th>Action</th>
                                        </tr>
                                        <tbody>
                                        @foreach($details as $stud)
                                            <?php
                                            $c = $stud->subjectID;
                                            $course=$stud->coursenumber;
                                            $ter=$stud->term;
                                            $subject = DB::table('subjects')
                                                ->join('petitions', 'subjects.subjectID', '=', 'petitions.subjectID')
                                                ->select('petitions.id_number')
                                                ->where('subjects.coursenumber', '=', $course)
                                                ->where('petitions.term', '=', $ter)
                                                ->get();
                                            $number = count($subject);
                                            ?>
                                            <tr>
                                                <td class="txt-oflo" style="height: 30px;">{{ $stud->coursenumber}}</td>
                                                <td>{{$stud->destitle}}</td>
                                                <td class="txt-oflo">{{$stud->units}}</td>
                                                <td class="txt-oflo">{{$stud->term}}</td>
                                                <td class="txt-oflo">{{ $number }}</td>
                                                <td>
                                                    <a href='/petitionSub/{{$users}}/{{$c}}/{{$ter}}'>
                                                        <button class='btn btn-primary btn-sm' >
                                                            <i class="fa fa-pencil-square" aria-hidden="true"></i>
                                                            Petition Subject
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
                            <div class="white-box" style="width: 90%; height: 650px;">
                                <div class="table-responsive" style="overflow-y:scroll; height: 560px; width: 100%; margin-top: -.6%;">
                                    <table class="table">
                                        <tr>
                                            <th>Course Number</th>
                                            <th>Descriptive Title</th>
                                            <th>Units</th>
                                            <th>Term</th>
                                            <th>Number of Students</th>
                                            <th>Action</th>
                                        </tr>
                                        <tbody>
                                        <?php
                                        $preenroll = DB::table('petitions')
                                            ->join('subjects', 'subjects.subjectID', '=', 'petitions.subjectID')
                                            ->join('students', 'students.id_number', '=', 'petitions.id_number')
                                            ->get();

                                        ?>
                                        @foreach($preenroll as $preenroll)
                                            <?php
                                            $c = $preenroll->subjectID;
                                            $course=$preenroll->coursenumber;
                                            $ter=$preenroll->term;
                                            $subject = DB::table('subjects')
                                                ->join('petitions', 'subjects.subjectID', '=', 'petitions.subjectID')
                                                ->select('petitions.id_number')
                                                ->where('subjects.coursenumber', '=', $course)
                                                ->where('petitions.term', '=', $ter)
                                                ->get();
                                            $number = count($subject);
                                            ?>
                                            <tr>
                                                <td class="txt-oflo" style="height: 30px;">{{ $preenroll->coursenumber}}</td>
                                                <td>{{$preenroll->destitle}}</td>
                                                <td class="txt-oflo">{{$preenroll->units}}</td>
                                                <td class="txt-oflo">{{$preenroll->term}}</td>
                                                <td class="txt-oflo">{{ $number }}</td>
                                                <td style="width: 15%;">
                                                    <a href='/petitionSub/{{$users}}/{{$c}}/{{$ter}}'>
                                                        <button class='btn btn-primary btn-sm' >
                                                            <i class="fa fa-pencil-square" aria-hidden="true"></i>
                                                            Petition Subject
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
                            <h5>{{$messages}}</h5>
                            <div class="white-box" style="width: 90%; height: 650px;">
                                <div class="table-responsive" style="overflow-y:scroll; height: 560px; width: 100%; margin-top: -.6%;">
                                    <table class="table" id="copy">
                                        <tr>
                                            <th>Course Number</th>
                                            <th>Descriptive Title</th>
                                            <th>Units</th>
                                            <th>Term</th>
                                            <th>Number of Students</th>
                                            <th>Action</th>
                                        </tr>
                                        <tbody>
                                        <?php
                                        $preenroll = DB::table('petitions')
                                            ->join('subjects', 'subjects.subjectID', '=', 'petitions.subjectID')
                                            ->join('students', 'students.id_number', '=', 'petitions.id_number')
                                            ->get();

                                        ?>
                                        @foreach($preenroll as $preenroll)
                                            <?php
                                            $c = $preenroll->subjectID;
                                            $course=$preenroll->coursenumber;
                                            $ter=$preenroll->term;
                                            $subject = DB::table('subjects')
                                                ->join('petitions', 'subjects.subjectID', '=', 'petitions.subjectID')
                                                ->select('petitions.id_number')
                                                ->where('subjects.coursenumber', '=', $course)
                                                ->where('petitions.term', '=', $ter)
                                                ->get();
                                            $number = count($subject);
                                            ?>
                                            <tr>
                                                <td class="txt-oflo" style="height: 30px;">{{ $preenroll->coursenumber}}</td>
                                                <td>{{$preenroll->destitle}}</td>
                                                <td class="txt-oflo">{{$preenroll->units}}</td>
                                                <td class="txt-oflo">{{$preenroll->term}}</td>
                                                <td class="txt-oflo">{{ $number }}</td>
                                                <td>
                                                    <a href='/petitionSub/{{$users}}/{{$c}}/{{$ter}}'>
                                                        <button class='btn btn-primary btn-sm' >
                                                            <i class="fa fa-pencil-square" aria-hidden="true"></i>
                                                            Petition Subject
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
                    </center>
                </div>
                <a href="/addPetition">
                    <input type="button" name="petition" value="Petition New Subject" class="btn btn-primary btn-sm" style="right:8%; position:absolute; bottom: 13%;">
                </a>
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