<!DOCTYPE html>
<html lang="en">
@include('header.header')
<?php
use Illuminate\Support\Facades\Session;
$users = Session::get('username');
$user = DB::table('users')->where('username', '=', $users)->get();
?>
@foreach($user as $user)
    <body>
    <!--<div class='preloader'><div class='loaded'>&nbsp;</div></div> !-->
    <header id="home" class="header navbar-fixed-top">
        <div class="navbar navbar-default main-menu">
            <div class="container">
                <div class="collapse navbar-collapse" style="position: absolute; right: 2%; margin-top: 12%; color: black;">
                    <ul class="nav navbar-nav navbar-right" style="">
                        <li class="active"><a href="/dashboard" ><i class="fa fa-home" id="space"></i>Home</a></li>
                        <li><a href="/preenroll"><i class="fa fa-stack-overflow" id="space"></i>Pre-Enrollment</a></li>
                        <li><a href="/checklist"><i class="fa fa-th-list" id="space"></i>Checklist</a></li>
                        <li><a href="/offeredSubjects"><i class="fa fa-columns" id="space"></i>Offered Subjects</a></li>
                        <li><a href="/overload"><i class="fa fa-folder-open-o" aria-hidden="true"></i>Request for overload</a></li>
                        <li><a href="/petitions"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Petitions</a></li>
                        <li><a href="/profile"><i class="fa fa-user-circle-o" aria-hidden="true"></i>Profile</a></li>
                    </ul>
                </div>
            </div>
        </div> <!-- end of navbar -->
    </header>
    <section id="home">
        <img src="images/building.jpg" alt="" style="width: 100%; margin-top: 1%;"/>
        <hr style="width: 100%; margin-top: 4%;">
        <div class="container" style="width: 90%;">
            <div class="row" >
                <br>
                <h3>Welcome {{$user->name}}!</h3>
                <?php
                $course = DB::table('students')->where('id_number', '=', $users)->get();
                ?>
                @foreach($course as $course)
                    <h3>You are currently enrolled as {{$course->course}} {{$course->year}} </h3>
                @endforeach
                <center>
                    <div class="col-sm-30 col-xs-20 heading-text">
                        <div class="single_home_content wow zoomIn" data-wow-duration="1s">
                            <div class="button">
                                <a href="/preenroll" class="btn" style=" color: black; border-color: black;">Pre-Enroll</a>
                                <a href="/checklist" class="btn" style=" color: black; border-color: black;">Update Checklist</a>
                                <a href="/offeredSubjects" class="btn" style=" color: black; border-color: black;">View Offered Subjects</a>
                                <a href="/petitions" class="btn" style=" color: black; border-color: black;">Petition Subject</a>
                                <a href="/overload" class="btn" style=" color: black; border-color: black;">Request for Overload</a>
                                <a href="/profile" class="btn" style=" color: black; border-color: black;">View Profile</a>
                            </div>
                        </div>
                    </div>
                </center>
            </div> <!-- end of row -->
        </div> <!-- end of container -->
    </section>
    <!-- START SCROLL TO TOP  -->
    <div class="scrollup">
        <a href="#"><i class="fa fa-chevron-up"></i></a>
    </div>
    @include('script.script')
    </body>
@endforeach
@include('footer.footer')
</html>