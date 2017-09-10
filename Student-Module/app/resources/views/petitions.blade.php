<!DOCTYPE html>
<html lang="en">
@include('header.header')
<body>
<!--<div class='preloader'><div class='loaded'>&nbsp;</div></div> !-->
<header id="home" class="header navbar-fixed-top">
    <div class="navbar navbar-default main-menu">
        <div class="container">
            <div class="collapse navbar-collapse" style="position: absolute; right: 2%; margin-top: 12%; color: black;">
                <ul class="nav navbar-nav navbar-right" style="">
                    <li><a href="/dashboard" ><i class="fa fa-home" id="space"></i>Home</a></li>
                    <li><a href="/preenroll"><i class="fa fa-stack-overflow" id="space"></i>Pre-Enrollment</a></li>
                    <li><a href="/checklist"><i class="fa fa-th-list" id="space"></i>Checklist</a></li>
                    <li><a href="/offeredSubjects"><i class="fa fa-columns" id="space"></i>Offered Subjects</a></li>
                    <li><a href="/overload"><i class="fa fa-folder-open-o" aria-hidden="true"></i>Request for overload</a></li>
                    <li class="active"><a href="/petitions"><i class="fa fa-pencil-square-o" aria-hidden="true"></i>Petitions</a></li>
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
        </div> <!-- end of row -->
    </div> <!-- end of container -->
</section>
<!-- START SCROLL TO TOP  -->
<div class="scrollup">
    <a href="#"><i class="fa fa-chevron-up"></i></a>
</div>

@include('script.script')
</body>
@include('footer.footer')
</html>