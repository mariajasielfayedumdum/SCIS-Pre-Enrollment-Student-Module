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

    .label tr td label {
        display: block;
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
                        <h4 class="page-title">Checklist</h4> </div>
                </div>

            </div>
            <!--Checklist: First Year - First Semester-->
            <form method="post" action="">
                <div style="overflow-y:scroll; height: 700px; width: 100%; margin-top: -1%; ">
                    <div class="container-fluid">
                        <div class="col-md-10 col-md-offset-1">
                            <table class="table table-bordered bordered table-striped table-condensed datatable" ui-jq="dataTable" ui-options="dataTableOpt" id="checklistInfo">
                                <thead class="dept-name">
                                <tr>
                                    <td colspan="5"><label for="first-first">First Year - First Semester</label>
                                    </td>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $stud = DB::table('students')->where('id_number', '=', $users)->get();
                                ?>
                                @foreach($stud as $stud)
                                    <?php
                                    $course = $stud->course;
                                    $ff = DB::table('checklist')
                                        ->join('curriculum_checklist', 'curriculum_checklist.checklistID', '=', 'checklist.checklistID')
                                        ->where('checklist.subyear', '=', '1')
                                        ->where('checklist.term', '=', 'First')
                                        ->where('checklist.course', '=', $course)
                                        ->get();
                                    ?>
                                @endforeach
                                <tr>
                                    <th>Course Number</th>
                                    <th>Descriptive Title</th>
                                    <th>Units</th>
                                    <th colspan="2">Action</th>
                                </tr>
                                </tbody>
                                @foreach($ff as $ff)
                                    <tbody class="dept-detail">
                                    <tr>
                                        <td>{{$ff->coursenumber}}</td>
                                        <td>{{$ff->destitle}}</td>
                                        <td>{{$ff->units}}</td>
                                        <td><span class='done'><input type='checkbox' class='control-label' name='checkbox1[]'/>Done</span></td>
                                        <td><span class='enrolled'><input type='checkbox' class='control-label' name='checkbox2[]'/>Currently Enrolled</span></td>
                                    </tr>
                                    </tbody>
                                @endforeach

                            <!--Checklist: First Year - Second Semester-->
                                <thead class="dept-name">
                                <tr>
                                    <td colspan="5"><label for="second-second">First Year - Second Semester</label>
                                    </td>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $stud = DB::table('students')->where('id_number', '=', $users)->get();
                                ?>
                                @foreach($stud as $stud)
                                    <?php
                                    $course = $stud->course;
                                    $ff = DB::table('checklist')
                                        ->join('curriculum_checklist', 'curriculum_checklist.checklistID', '=', 'checklist.checklistID')
                                        ->where('checklist.subyear', '=', '1')
                                        ->where('checklist.term', '=', 'Second')
                                        ->where('checklist.course', '=', $course)
                                        ->get();
                                    ?>
                                @endforeach
                                <tr>
                                    <th>Course Number</th>
                                    <th>Descriptive Title</th>
                                    <th>Units</th>
                                    <th colspan="2">Action</th>
                                </tr>
                                </tbody>
                                @foreach($ff as $ff)
                                    <tbody class="dept-detail">
                                    <tr>
                                        <td>{{$ff->coursenumber}}</td>
                                        <td>{{$ff->destitle}}</td>
                                        <td>{{$ff->units}}</td>
                                        <td><span class='done'><input type='checkbox' class='control-label' name='checkbox1[]'/>Done</span></td>
                                        <td><span class='enrolled'><input type='checkbox' class='control-label' name='checkbox2[]'/>Currently Enrolled</span></td>
                                    </tr>
                                    </tbody>
                                @endforeach

                            <!--Checklist: First Year - Short Term-->
                                <thead class="dept-name">
                                <tr>
                                    <td colspan="5"><label for="first-short">First Year - Short Term</label>
                                    </td>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $stud = DB::table('students')->where('id_number', '=', $users)->get();
                                ?>
                                @foreach($stud as $stud)
                                    <?php
                                    $course = $stud->course;
                                    $ff = DB::table('checklist')
                                        ->join('curriculum_checklist', 'curriculum_checklist.checklistID', '=', 'checklist.checklistID')
                                        ->where('checklist.subyear', '=', '1')
                                        ->where('checklist.term', '=', 'Short')
                                        ->where('checklist.course', '=', $course)
                                        ->get();
                                    ?>
                                @endforeach
                                <tr>
                                    <th>Course Number</th>
                                    <th>Descriptive Title</th>
                                    <th>Units</th>
                                    <th colspan="2">Action</th>
                                </tr>
                                </tbody>
                                @foreach($ff as $ff)
                                    <tbody class="dept-detail">
                                    <tr>
                                        <td>{{$ff->coursenumber}}</td>
                                        <td>{{$ff->destitle}}</td>
                                        <td>{{$ff->units}}</td>
                                        <td><span class='done'><input type='checkbox' class='control-label' name='checkbox1[]'/>Done</span></td>
                                        <td><span class='enrolled'><input type='checkbox' class='control-label' name='checkbox2[]'/>Currently Enrolled</span></td>
                                    </tr>
                                    </tbody>
                                @endforeach

                            <!--Checklist: Second Year - First Semester-->
                                <thead class="dept-name">
                                <tr>
                                    <td colspan="5"><label for="second-first">Second Year - First Semester</label>
                                    </td>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $stud = DB::table('students')->where('id_number', '=', $users)->get();
                                ?>
                                @foreach($stud as $stud)
                                    <?php
                                    $course = $stud->course;
                                    $ff = DB::table('checklist')
                                        ->join('curriculum_checklist', 'curriculum_checklist.checklistID', '=', 'checklist.checklistID')
                                        ->where('checklist.subyear', '=', '2')
                                        ->where('checklist.term', '=', 'First')
                                        ->where('checklist.course', '=', $course)
                                        ->get();
                                    ?>
                                @endforeach
                                <tr>
                                    <th>Course Number</th>
                                    <th>Descriptive Title</th>
                                    <th>Units</th>
                                    <th colspan="2">Action</th>
                                </tr>
                                </tbody>
                                @foreach($ff as $ff)
                                    <tbody class="dept-detail">
                                    <tr>
                                        <td>{{$ff->coursenumber}}</td>
                                        <td>{{$ff->destitle}}</td>
                                        <td>{{$ff->units}}</td>
                                        <td><span class='done'><input type='checkbox' class='control-label' name='checkbox1[]'/>Done</span></td>
                                        <td><span class='enrolled'><input type='checkbox' class='control-label' name='checkbox2[]'/>Currently Enrolled</span></td>
                                    </tr>
                                    </tbody>
                                @endforeach

                            <!--Checklist: Second Year - Second Semester-->
                                <thead class="dept-name">
                                <tr>
                                    <td colspan="5"><label for="second-second">Second Year - Second Semester</label>
                                    </td>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $stud = DB::table('students')->where('id_number', '=', $users)->get();
                                ?>
                                @foreach($stud as $stud)
                                    <?php
                                    $course = $stud->course;
                                    $ff = DB::table('checklist')
                                        ->join('curriculum_checklist', 'curriculum_checklist.checklistID', '=', 'checklist.checklistID')
                                        ->where('checklist.subyear', '=', '2')
                                        ->where('checklist.term', '=', 'Second')
                                        ->where('checklist.course', '=', $course)
                                        ->get();
                                    ?>
                                @endforeach
                                <tr>
                                    <th>Course Number</th>
                                    <th>Descriptive Title</th>
                                    <th>Units</th>
                                    <th colspan="2">Action</th>
                                </tr>
                                </tbody>
                                @foreach($ff as $ff)
                                    <tbody class="dept-detail">
                                    <tr>
                                        <td>{{$ff->coursenumber}}</td>
                                        <td>{{$ff->destitle}}</td>
                                        <td>{{$ff->units}}</td>
                                        <td><span class='done'><input type='checkbox' class='control-label' name='checkbox1[]'/>Done</span></td>
                                        <td><span class='enrolled'><input type='checkbox' class='control-label' name='checkbox2[]'/>Currently Enrolled</span></td>
                                    </tr>
                                    </tbody>
                                @endforeach

                            <!--Checklist: Second Year - Short Term-->
                                <thead class="dept-name">
                                <tr>
                                    <td colspan="5"><label for="second-short">Second Year - Short Term</label>
                                    </td>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $stud = DB::table('students')->where('id_number', '=', $users)->get();
                                ?>
                                @foreach($stud as $stud)
                                    <?php
                                    $course = $stud->course;
                                    $ff = DB::table('checklist')
                                        ->join('curriculum_checklist', 'curriculum_checklist.checklistID', '=', 'checklist.checklistID')
                                        ->where('checklist.subyear', '=', '2')
                                        ->where('checklist.term', '=', 'Short')
                                        ->where('checklist.course', '=', $course)
                                        ->get();
                                    ?>
                                @endforeach
                                <tr>
                                    <th>Course Number</th>
                                    <th>Descriptive Title</th>
                                    <th>Units</th>
                                    <th colspan="2">Action</th>
                                </tr>
                                </tbody>
                                @foreach($ff as $ff)
                                    <tbody class="dept-detail">
                                    <tr>
                                        <td>{{$ff->coursenumber}}</td>
                                        <td>{{$ff->destitle}}</td>
                                        <td>{{$ff->units}}</td>
                                        <td><span class='done'><input type='checkbox' class='control-label' name='checkbox1[]'/>Done</span></td>
                                        <td><span class='enrolled'><input type='checkbox' class='control-label' name='checkbox2[]'/>Currently Enrolled</span></td>
                                    </tr>
                                    </tbody>
                                @endforeach

                            <!--Checklist: Third Year - First Semester-->
                                <thead class="dept-name">
                                <tr>
                                    <td colspan="5"><label for="third-first">Third Year - First Semester</label>
                                    </td>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $stud = DB::table('students')->where('id_number', '=', $users)->get();
                                ?>
                                @foreach($stud as $stud)
                                    <?php
                                    $course = $stud->course;
                                    $ff = DB::table('checklist')
                                        ->join('curriculum_checklist', 'curriculum_checklist.checklistID', '=', 'checklist.checklistID')
                                        ->where('checklist.subyear', '=', '3')
                                        ->where('checklist.term', '=', 'First')
                                        ->where('checklist.course', '=', $course)
                                        ->get();
                                    ?>
                                @endforeach
                                <tr>
                                    <th>Course Number</th>
                                    <th>Descriptive Title</th>
                                    <th>Units</th>
                                    <th colspan="2">Action</th>
                                </tr>
                                </tbody>
                                @foreach($ff as $ff)
                                    <tbody class="dept-detail">
                                    <tr>
                                        <td>{{$ff->coursenumber}}</td>
                                        <td>{{$ff->destitle}}</td>
                                        <td>{{$ff->units}}</td>
                                        <td><span class='done'><input type='checkbox' class='control-label' name='checkbox1[]'/>Done</span></td>
                                        <td><span class='enrolled'><input type='checkbox' class='control-label' name='checkbox2[]'/>Currently Enrolled</span></td>
                                    </tr>
                                    </tbody>
                                @endforeach

                            <!--Checklist: Third Year - Second Semester-->
                                <thead class="dept-name">
                                <tr>
                                    <td colspan="5"><label for="third-second">Third Year - Second Semester</label>
                                    </td>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $stud = DB::table('students')->where('id_number', '=', $users)->get();
                                ?>
                                @foreach($stud as $stud)
                                    <?php
                                    $course = $stud->course;
                                    $ff = DB::table('checklist')
                                        ->join('curriculum_checklist', 'curriculum_checklist.checklistID', '=', 'checklist.checklistID')
                                        ->where('checklist.subyear', '=', '3')
                                        ->where('checklist.term', '=', 'Second')
                                        ->where('checklist.course', '=', $course)
                                        ->get();
                                    ?>
                                @endforeach
                                <tr>
                                    <th>Course Number</th>
                                    <th>Descriptive Title</th>
                                    <th>Units</th>
                                    <th colspan="2">Action</th>
                                </tr>
                                </tbody>
                                @foreach($ff as $ff)
                                    <tbody class="dept-detail">
                                    <tr>
                                        <td>{{$ff->coursenumber}}</td>
                                        <td>{{$ff->destitle}}</td>
                                        <td>{{$ff->units}}</td>
                                        <td><span class='done'><input type='checkbox' class='control-label' name='checkbox1[]'/>Done</span></td>
                                        <td><span class='enrolled'><input type='checkbox' class='control-label' name='checkbox2[]'/>Currently Enrolled</span></td>
                                    </tr>
                                    </tbody>
                                @endforeach

                            <!--Checklist: Third Year - Short Term-->
                                <thead class="dept-name">
                                <tr>
                                    <td colspan="5"><label for="third-short">Third Year - Short Term</label>
                                    </td>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $stud = DB::table('students')->where('id_number', '=', $users)->get();
                                ?>
                                @foreach($stud as $stud)
                                    <?php
                                    $course = $stud->course;
                                    $ff = DB::table('checklist')
                                        ->join('curriculum_checklist', 'curriculum_checklist.checklistID', '=', 'checklist.checklistID')
                                        ->where('checklist.subyear', '=', '3')
                                        ->where('checklist.term', '=', 'Short')
                                        ->where('checklist.course', '=', $course)
                                        ->get();
                                    ?>
                                @endforeach
                                <tr>
                                    <th>Course Number</th>
                                    <th>Descriptive Title</th>
                                    <th>Units</th>
                                    <th colspan="2">Action</th>
                                </tr>
                                </tbody>
                                @foreach($ff as $ff)
                                    <tbody class="dept-detail">
                                    <tr>
                                        <td>{{$ff->coursenumber}}</td>
                                        <td>{{$ff->destitle}}</td>
                                        <td>{{$ff->units}}</td>
                                        <td><span class='done'><input type='checkbox' class='control-label' name='checkbox1[]'/>Done</span></td>
                                        <td><span class='enrolled'><input type='checkbox' class='control-label' name='checkbox2[]'/>Currently Enrolled</span></td>
                                    </tr>
                                    </tbody>
                                @endforeach

                            <!--Checklist: Fourth Year - First Semester-->
                                <thead class="dept-name">
                                <tr>
                                    <td colspan="5"><label for="fourth-first">Fourth Year - First Semester</label>
                                    </td>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $stud = DB::table('students')->where('id_number', '=', $users)->get();
                                ?>
                                @foreach($stud as $stud)
                                    <?php
                                    $course = $stud->course;
                                    $ff = DB::table('checklist')
                                        ->join('curriculum_checklist', 'curriculum_checklist.checklistID', '=', 'checklist.checklistID')
                                        ->where('checklist.subyear', '=', '4')
                                        ->where('checklist.term', '=', 'First')
                                        ->where('checklist.course', '=', $course)
                                        ->get();
                                    ?>
                                @endforeach
                                <tr>
                                    <th>Course Number</th>
                                    <th>Descriptive Title</th>
                                    <th>Units</th>
                                    <th colspan="2">Action</th>
                                </tr>
                                </tbody>
                                @foreach($ff as $ff)
                                    <tbody class="dept-detail">
                                    <tr>
                                        <td>{{$ff->coursenumber}}</td>
                                        <td>{{$ff->destitle}}</td>
                                        <td>{{$ff->units}}</td>
                                        <td><span class='done'><input type='checkbox' class='control-label' name='checkbox1[]'/>Done</span></td>
                                        <td><span class='enrolled'><input type='checkbox' class='control-label' name='checkbox2[]'/>Currently Enrolled</span></td>
                                    </tr>
                                    </tbody>
                                @endforeach

                            <!--Checklist: Fourth Year - Second Semester-->
                                <thead class="dept-name">
                                <tr>
                                    <td colspan="5"><label for="fourth-second">Fourth Year - Second Semester</label>
                                    </td>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $stud = DB::table('students')->where('id_number', '=', $users)->get();
                                ?>
                                @foreach($stud as $stud)
                                    <?php
                                    $course = $stud->course;
                                    $ff = DB::table('checklist')
                                        ->join('curriculum_checklist', 'curriculum_checklist.checklistID', '=', 'checklist.checklistID')
                                        ->where('checklist.subyear', '=', '4')
                                        ->where('checklist.term', '=', 'Second')
                                        ->where('checklist.course', '=', $course)
                                        ->get();
                                    ?>
                                @endforeach
                                <tr>
                                    <th>Course Number</th>
                                    <th>Descriptive Title</th>
                                    <th>Units</th>
                                    <th colspan="2">Action</th>
                                </tr>
                                </tbody>
                                @foreach($ff as $ff)
                                    <tbody class="dept-detail">
                                    <tr>
                                        <td>{{$ff->coursenumber}}</td>
                                        <td>{{$ff->destitle}}</td>
                                        <td>{{$ff->units}}</td>
                                        <td><span class='done'><input type='checkbox' class='control-label' name='checkbox1[]'/>Done</span></td>
                                        <td><span class='enrolled'><input type='checkbox' class='control-label' name='checkbox2[]'/>Currently Enrolled</span></td>
                                    </tr>
                                    </tbody>
                                @endforeach

                            <!--Checklist: Electives-->
                                <thead class="dept-name">
                                <tr>
                                    <td colspan="5"><label for="electives">Electives</label>
                                    </td>
                                </tr>
                                </thead>
                                <tbody>
                                <?php
                                $stud = DB::table('students')->where('id_number', '=', $users)->get();
                                ?>
                                @foreach($stud as $stud)
                                    <?php
                                    $course = $stud->course;
                                    $ff = DB::table('checklist')
                                        ->join('curriculum_checklist', 'curriculum_checklist.checklistID', '=', 'checklist.checklistID')
                                        ->where('checklist.subyear', '=', '0')
                                        ->where('checklist.term', '=', '0')
                                        ->where('checklist.course', '=', $course)
                                        ->get();
                                    ?>
                                @endforeach
                                <tr>
                                    <th>Course Number</th>
                                    <th>Descriptive Title</th>
                                    <th>Units</th>
                                    <th colspan="2">Action</th>
                                </tr>
                                </tbody>
                                @foreach($ff as $ff)
                                    <tbody class="dept-detail">
                                    <tr>
                                        <td>{{$ff->coursenumber}}</td>
                                        <td>{{$ff->destitle}}</td>
                                        <td>{{$ff->units}}</td>
                                        <td><span class='done'><input type='checkbox' class='control-label' name='checkbox1[]'/>Done</span></td>
                                        <td><span class='enrolled'><input type='checkbox' class='control-label' name='checkbox2[]'/>Currently Enrolled</span></td>
                                    </tr>
                                    </tbody>
                                @endforeach

                            </table>
                        </div>
                    </div>
                </div>
                <input type="submit" value="Update Checklist" class="btn btn-primary btn-sm" style="margin-left: 90%;">
            </form>
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
