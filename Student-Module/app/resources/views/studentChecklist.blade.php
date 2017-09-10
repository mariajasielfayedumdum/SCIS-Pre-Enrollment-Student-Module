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
                    @foreach($idnumber as $idnumber)
                        <?php
                        $id = $idnumber->id_number;
                        $stud = DB::table('users')->where('username', '=', $id)->where('type', '=', '1')
                            ->DISTINCT()->select('username')->get();
                        $studCount = count($stud); ?>
                    @endforeach
                    <ol class="breadcrumb" style="position: relative; left:-4%; width: 100%;">
                        <li><a href="/studentManagement">Student Management</a></li>
                        <li><a href="/studentprofile/{{$id}}">Student Profile</a></li>
                        <li class="active" style="position:relative;">Student Checklist</li>
                    </ol>
                </div>
            </div>
            <?php
            if($studCount != 0){
            ?>
            <h4><b>{!! $idnumber->last_name !!}, {!! $idnumber->first_name !!}</b></h4>
            <h5>Course&Year: {!! $idnumber->course !!} {!! $idnumber->year !!}</h5>
            <h5 style="position:absolute; left:43%; top: 17%;">ID Number: {{$idnumber->id_number}}</h5>
            <h4 style="position: absolute; left: 27%;"> <b>Checklist Curriculum Year </b></h4><br><br>
            <?php
            $course = $idnumber->course;
            $year = $idnumber->year;

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
            <div class="white-box" style="width: 48%;">

                <div class="table-responsive" style="overflow-y:scroll; height: 610px; width:100%; ">
                    <table class="table" style="position: absolute; display: block; z-index: 100; background-color:white;width: 38.4%; left:13.5%;">
                        <thead >
                        <tr>
                            </th><th>
                            <th >Course Number</th>
                            <th></th></th><th>
                            <th>Descriptive Title</th>
                            <th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th>
                            <th>Units</th>
                            <th></th>
                            <th>Status</th>
                            <th></th>
                        </tr>
                        </thead>
                    </table>
                    <table class="table">
                        <br>
                        <br>
                        <br>
                        <p> <b>First Year -- First Semester</b></p>
                        <tbody>
                        <?php
                        $subjects = DB::table('updated_checklist')->join('checklist', 'checklist.checklistID', '=', 'updated_checklist.checklistID')
                            ->join('curriculum_checklist', 'updated_checklist.curriculumID', '=', 'curriculum_checklist.curriculumID')
                            ->join('students', 'updated_checklist.id_number', '=', 'students.id_number')
                            ->where('checklist.subyear', '=', '1')
                            ->where('checklist.term', '=', 'First')
                            ->where('students.course', '=', $course)
                            ->where('updated_checklist.id_number', '=', $id)
                            ->get();
                        ?>
                        @foreach ($subjects as $subjects)
                            <tr>
                                <td class="txt-oflo">{{ $subjects->coursenumber }}</td>
                                <td>{{ $subjects->destitle }}</td>
                                <td class="txt-oflo">{{ $subjects->units }}</td>
                                <?php
                                    $up = $subjects->status;
                                if($up == "Done"){
                                    echo "<td><i class='fa fa-check' aria-hidden='true'></i></td>";
                                } else if($up == "Not Done"){
                                    echo "<td><i class='fa fa-times' aria-hidden='true'></i></td>";
                                }  else if($up == "Currently Enrolled"){
                                    echo "<td>Currently Enrolled</td>";
                                }
                                ?>
                                <td></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <table class="table">
                        <br>
                        <p> <b> First Year -- Second Semester</b></p>
                        <tbody>
                        <?php
                        $subjects = DB::table('updated_checklist')->join('checklist', 'checklist.checklistID', '=', 'updated_checklist.checklistID')
                            ->join('curriculum_checklist', 'updated_checklist.curriculumID', '=', 'curriculum_checklist.curriculumID')
                            ->join('students', 'updated_checklist.id_number', '=', 'students.id_number')
                            ->where('checklist.subyear', '=', '1')
                            ->where('checklist.term', '=', 'Second')
                            ->where('students.course', '=', $course)
                            ->where('updated_checklist.id_number', '=', $id)
                            ->get();
                        ?>
                        @foreach ($subjects as $subjects)
                            <tr>
                                <td class="txt-oflo">{{ $subjects->coursenumber }}</td>
                                <td>{{ $subjects->destitle }}</td>
                                <td class="txt-oflo">{{ $subjects->units }}</td>
                                <?php
                                $up = $subjects->status;
                                if($up == "Done"){
                                    echo "<td><i class='fa fa-check' aria-hidden='true'></i></td>";
                                } else if($up == "Not Done"){
                                    echo "<td><i class='fa fa-times' aria-hidden='true'></i></td>";
                                }  else if($up == "Currently Enrolled"){
                                    echo "<td>Currently Enrolled</td>";
                                }
                                ?>
                                <td></td>
                            </tr>
                        @endforeach
                    </table>
                    <table class="table">
                        <br>
                        <p> <b>First Year -- Short Semester</b></p>
                        <tbody>
                        <?php
                        $subjects = DB::table('updated_checklist')->join('checklist', 'checklist.checklistID', '=', 'updated_checklist.checklistID')
                            ->join('curriculum_checklist', 'updated_checklist.curriculumID', '=', 'curriculum_checklist.curriculumID')
                            ->join('students', 'updated_checklist.id_number', '=', 'students.id_number')
                            ->where('checklist.subyear', '=', '1')
                            ->where('checklist.term', '=', 'Short')
                            ->where('students.course', '=', $course)
                            ->where('updated_checklist.id_number', '=', $id)
                            ->get();
                        ?>
                        @foreach ($subjects as $subjects)
                            <tr>
                                <td class="txt-oflo">{{ $subjects->coursenumber }}</td>
                                <td>{{ $subjects->destitle }}</td>
                                <td class="txt-oflo">{{ $subjects->units }}</td>
                                <?php
                                $up = $subjects->status;
                                if($up == "Done"){
                                    echo "<td><i class='fa fa-check' aria-hidden='true'></i></td>";
                                } else if($up == "Not Done"){
                                    echo "<td><i class='fa fa-times' aria-hidden='true'></i></td>";
                                }  else if($up == "Currently Enrolled"){
                                    echo "<td>Currently Enrolled</td>";
                                }
                                ?>
                                <td></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <table class="table">
                        <br>
                        <p><b> Second Year -- First Semester</b></p>
                        <tbody>
                        <?php
                        $subjects = DB::table('updated_checklist')->join('checklist', 'checklist.checklistID', '=', 'updated_checklist.checklistID')
                            ->join('curriculum_checklist', 'updated_checklist.curriculumID', '=', 'curriculum_checklist.curriculumID')
                            ->join('students', 'updated_checklist.id_number', '=', 'students.id_number')
                            ->where('checklist.subyear', '=', '2')
                            ->where('checklist.term', '=', 'First')
                            ->where('students.course', '=', $course)
                            ->where('updated_checklist.id_number', '=', $id)
                            ->get();
                        ?>
                        @foreach ($subjects as $subjects)
                            <tr>
                                <td class="txt-oflo">{{ $subjects->coursenumber }}</td>
                                <td>{{ $subjects->destitle }}</td>
                                <td class="txt-oflo">{{ $subjects->units }}</td>
                                <?php
                                $up = $subjects->status;
                                if($up == "Done"){
                                    echo "<td><i class='fa fa-check' aria-hidden='true'></i></td>";
                                } else if($up == "Not Done"){
                                    echo "<td><i class='fa fa-times' aria-hidden='true'></i></td>";
                                }  else if($up == "Currently Enrolled"){
                                    echo "<td>Currently Enrolled</td>";
                                }
                                ?>
                                <td></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <table class="table">
                        <br>
                        <p> <b>Second Year -- Second Semester</b></p>
                        <tbody>
                        <?php
                        $subjects = DB::table('updated_checklist')->join('checklist', 'checklist.checklistID', '=', 'updated_checklist.checklistID')
                            ->join('curriculum_checklist', 'updated_checklist.curriculumID', '=', 'curriculum_checklist.curriculumID')
                            ->join('students', 'updated_checklist.id_number', '=', 'students.id_number')
                            ->where('checklist.subyear', '=', '2')
                            ->where('checklist.term', '=', 'Second')
                            ->where('students.course', '=', $course)
                            ->where('updated_checklist.id_number', '=', $id)
                            ->get();
                        ?>
                        @foreach ($subjects as $subjects)
                            <tr>
                                <td class="txt-oflo">{{ $subjects->coursenumber }}</td>
                                <td>{{ $subjects->destitle }}</td>
                                <td class="txt-oflo">{{ $subjects->units }}</td>
                                <?php
                                $up = $subjects->status;
                                if($up == "Done"){
                                    echo "<td><i class='fa fa-check' aria-hidden='true'></i></td>";
                                } else if($up == "Not Done"){
                                    echo "<td><i class='fa fa-times' aria-hidden='true'></i></td>";
                                }  else if($up == "Currently Enrolled"){
                                    echo "<td>Currently Enrolled</td>";
                                }
                                ?>
                                <td></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <table class="table">
                        <br>
                        <p> <b>Second Year -- Short Semester</b></p>
                        <tbody>
                        <?php
                        $subjects = DB::table('updated_checklist')->join('checklist', 'checklist.checklistID', '=', 'updated_checklist.checklistID')
                            ->join('curriculum_checklist', 'updated_checklist.curriculumID', '=', 'curriculum_checklist.curriculumID')
                            ->join('students', 'updated_checklist.id_number', '=', 'students.id_number')
                            ->where('checklist.subyear', '=', '2')
                            ->where('checklist.term', '=', 'Short')
                            ->where('students.course', '=', $course)
                            ->where('updated_checklist.id_number', '=', $id)
                            ->get();
                        ?>
                        @foreach ($subjects as $subjects)
                            <tr>
                                <td class="txt-oflo">{{ $subjects->coursenumber }}</td>
                                <td>{{ $subjects->destitle }}</td>
                                <td class="txt-oflo">{{ $subjects->units }}</td>
                                <?php
                                $up = $subjects->status;
                                if($up == "Done"){
                                    echo "<td><i class='fa fa-check' aria-hidden='true'></i></td>";
                                } else if($up == "Not Done"){
                                    echo "<td><i class='fa fa-times' aria-hidden='true'></i></td>";
                                }  else if($up == "Currently Enrolled"){
                                    echo "<td>Currently Enrolled</td>";
                                }
                                ?>
                                <td></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
               <table class="table">
                        <br>
                        <p> <b>Third Year -- First Semester</b></p>
                        <tbody>
                        <?php
                        $subjects = DB::table('updated_checklist')->join('checklist', 'checklist.checklistID', '=', 'updated_checklist.checklistID')
                            ->join('curriculum_checklist', 'updated_checklist.curriculumID', '=', 'curriculum_checklist.curriculumID')
                            ->join('students', 'updated_checklist.id_number', '=', 'students.id_number')
                            ->where('checklist.subyear', '=', '3')
                            ->where('checklist.term', '=', 'First')
                            ->where('students.course', '=', $course)
                            ->where('updated_checklist.id_number', '=', $id)
                            ->get();
                        ?>
                        @foreach ($subjects as $subjects)
                            <tr>
                                <td class="txt-oflo">{{ $subjects->coursenumber }}</td>
                                <td>{{ $subjects->destitle }}</td>
                                <td class="txt-oflo">{{ $subjects->units }}</td>
                                <?php
                                $up = $subjects->status;
                                if($up == "Done"){
                                    echo "<td><i class='fa fa-check' aria-hidden='true'></i></td>";
                                } else if($up == "Not Done"){
                                    echo "<td><i class='fa fa-times' aria-hidden='true'></i></td>";
                                }  else if($up == "Currently Enrolled"){
                                    echo "<td>Currently Enrolled</td>";
                                }
                                ?>
                                <td></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <table class="table">
                        <br>
                        <p> <b>Third Year -- Second Semester</b></p>
                        <tbody>
                        <?php
                        $subjects = DB::table('updated_checklist')->join('checklist', 'checklist.checklistID', '=', 'updated_checklist.checklistID')
                            ->join('curriculum_checklist', 'updated_checklist.curriculumID', '=', 'curriculum_checklist.curriculumID')
                            ->join('students', 'updated_checklist.id_number', '=', 'students.id_number')
                            ->where('checklist.subyear', '=', '3')
                            ->where('checklist.term', '=', 'Second')
                            ->where('students.course', '=', $course)
                            ->where('updated_checklist.id_number', '=', $id)
                            ->get();
                        ?>
                        @foreach ($subjects as $subjects)
                            <tr>
                                <td class="txt-oflo">{{ $subjects->coursenumber }}</td>
                                <td>{{ $subjects->destitle }}</td>
                                <td class="txt-oflo">{{ $subjects->units }}</td>
                                <?php
                                $up = $subjects->status;
                                if($up == "Done"){
                                    echo "<td><i class='fa fa-check' aria-hidden='true'></i></td>";
                                } else if($up == "Not Done"){
                                    echo "<td><i class='fa fa-times' aria-hidden='true'></i></td>";
                                }  else if($up == "Currently Enrolled"){
                                    echo "<td>Currently Enrolled</td>";
                                }
                                ?>
                                <td></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <table class="table">
                        <br>
                        <p> <b>Third Year -- Short Semester</b></p>
                        <tbody>
                        <?php
                        $subjects = DB::table('updated_checklist')->join('checklist', 'checklist.checklistID', '=', 'updated_checklist.checklistID')
                            ->join('curriculum_checklist', 'updated_checklist.curriculumID', '=', 'curriculum_checklist.curriculumID')
                            ->join('students', 'updated_checklist.id_number', '=', 'students.id_number')
                            ->where('checklist.subyear', '=', '3')
                            ->where('checklist.term', '=', 'Short')
                            ->where('students.course', '=', $course)
                            ->where('updated_checklist.id_number', '=', $id)
                            ->get();
                        ?>
                        @foreach ($subjects as $subjects)
                            <tr>
                                <td class="txt-oflo">{{ $subjects->coursenumber }}</td>
                                <td>{{ $subjects->destitle }}</td>
                                <td class="txt-oflo">{{ $subjects->units }}</td>
                                <?php
                                $up = $subjects->status;
                                if($up == "Done"){
                                    echo "<td><i class='fa fa-check' aria-hidden='true'></i></td>";
                                } else if($up == "Not Done"){
                                    echo "<td><i class='fa fa-times' aria-hidden='true'></i></td>";
                                }  else if($up == "Currently Enrolled"){
                                    echo "<td>Currently Enrolled</td>";
                                }
                                ?>
                                <td></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <table class="table">
                        <br>
                        <p> <b> Fourth Year -- First Semester</b></p>
                        <tbody>
                        <?php
                        $subjects = DB::table('updated_checklist')->join('checklist', 'checklist.checklistID', '=', 'updated_checklist.checklistID')
                            ->join('curriculum_checklist', 'updated_checklist.curriculumID', '=', 'curriculum_checklist.curriculumID')
                            ->join('students', 'updated_checklist.id_number', '=', 'students.id_number')
                            ->where('checklist.subyear', '=', '4')
                            ->where('checklist.term', '=', 'First')
                            ->where('students.course', '=', $course)
                            ->where('updated_checklist.id_number', '=', $id)
                            ->get();
                        ?>
                        @foreach ($subjects as $subjects)
                            <tr>
                                <td class="txt-oflo">{{ $subjects->coursenumber }}</td>
                                <td>{{ $subjects->destitle }}</td>
                                <td class="txt-oflo">{{ $subjects->units }}</td>
                                <?php
                                $up = $subjects->status;
                                if($up == "Done"){
                                    echo "<td><i class='fa fa-check' aria-hidden='true'></i></td>";
                                } else if($up == "Not Done"){
                                    echo "<td><i class='fa fa-times' aria-hidden='true'></i></td>";
                                }  else if($up == "Currently Enrolled"){
                                    echo "<td>Currently Enrolled</td>";
                                }
                                ?>
                                <td></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                    <table class="table">
                        <br>
                        <p><b> Fourth Year -- Second Semester</b></p>
                        <tbody>
                        <?php
                        $subjects = DB::table('updated_checklist')->join('checklist', 'checklist.checklistID', '=', 'updated_checklist.checklistID')
                            ->join('curriculum_checklist', 'updated_checklist.curriculumID', '=', 'curriculum_checklist.curriculumID')
                            ->join('students', 'updated_checklist.id_number', '=', 'students.id_number')
                            ->where('checklist.subyear', '=', '4')
                            ->where('checklist.term', '=', 'Second')
                            ->where('students.course', '=', $course)
                            ->where('updated_checklist.id_number', '=', $id)
                            ->get();
                        ?>
                        @foreach ($subjects as $subjects)
                            <tr>
                                <td class="txt-oflo">{{ $subjects->coursenumber }}</td>
                                <td>{{ $subjects->destitle }}</td>
                                <td class="txt-oflo">{{ $subjects->units }}</td>
                                <?php
                                $up = $subjects->status;
                                if($up == "Done"){
                                    echo "<td><i class='fa fa-check' aria-hidden='true'></i></td>";
                                } else if($up == "Not Done"){
                                    echo "<td><i class='fa fa-times' aria-hidden='true'></i></td>";
                                }  else if($up == "Currently Enrolled"){
                                    echo "<td>Currently Enrolled</td>";
                                }
                                ?>
                                <td></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>
            </div>
            <div class="white-box" style="width: 45%; position: absolute; left: 55%; top: 15%;">
                <h5> <b>ELECTIVES</b></h5>
                <div class="table-responsive" style="overflow-y:scroll; height: 670px; width: 100%;">
                    <table class="table" style="position: absolute; display: block; z-index: 100; background-color:white; width: 94.3%; left:1%; top:7%;">
                        <thead>
                        <tr>
                            <th>Course Number</th>
                            <th></th><th></th>
                            <th>Descriptive Title</th>
                            <th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th>
                            <th>Units</th>
                            <th></th><th></th>
                            <th></th><th></th>
                            <th>Status</th>
                            <th></th><th></th>
                        </tr>
                        </thead>
                    </table>
                    <table class="table" style="margin-top: -1.9%;">
                        <br><br><br>
                        <tbody>
                        <?php
                        $subjects = DB::table('updated_checklist')->join('checklist', 'checklist.checklistID', '=', 'updated_checklist.checklistID')
                            ->join('curriculum_checklist', 'updated_checklist.curriculumID', '=', 'curriculum_checklist.curriculumID')
                            ->join('students', 'updated_checklist.id_number', '=', 'students.id_number')
                            ->where('checklist.subyear', '=', '0')
                            ->where('checklist.term', '=', '0')
                            ->where('students.course', '=', $course)
                            ->where('updated_checklist.id_number', '=', $id)
                            ->get();
                     //  $subject = DB::table('checklist')->where('subyear', '=', '0')->where('term', '=', '0')->where('course', '=', $course)->get();
                        ?>
                        @foreach ($subjects as $subjects)
                            <tr>
                                <td class="txt-oflo">{{ $subjects->coursenumber }}</td>
                                <td>{{ $subjects->destitle }}</td>
                                <td class="txt-oflo">{{ $subjects->units }}</td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <td></td>
                                <?php
                                $up = $subjects->status;
                                if($up == "Done"){
                                    echo "<td><i class='fa fa-check' aria-hidden='true'></i></td>";
                                } else if($up == "Not Done"){
                                    echo "<td><i class='fa fa-times' aria-hidden='true'></i></td>";
                                }  else if($up == "Currently Enrolled"){
                                    echo "<td>Currently Enrolled</td>";
                                }
                                ?>
                                <td></td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
            <?php
            }
            ?>
        </div> <!-- container fluid -->
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
