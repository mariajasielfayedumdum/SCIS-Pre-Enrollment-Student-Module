<style>
    .navs {
        width:90% !important;
        position:absolute;
        overflow:hidden;
        height:50px;
        background-color:rgba(255,255,255,.2);
        -webkit-box-shadow:0px 2px 1px rgba(50, 50, 50, 0.22);
        -moz-box-shadow:0px 2px 1px rgba(50, 50, 50, 0.22);
        box-shadow:0px 2px 1px rgba(50, 50, 50, 0.22);
        padding-right:20px;
    }
    .navs li {
        text-align:center;
        font-size: 15px;
        color: black;
        height:47.5px;
        padding-left:20px;
        padding-right:20px;
        cursor:pointer;
        padding-top:17.5px !important;
        float: left;
        list-style: none;
        font-weight: 200;
        border-left:1px solid rgba(0,0,0,.1);
        background-color:none;
        transition:background-color ease-in-out .5s;
        -moz-transition:background-color ease-in-out .5s;
        -webkit-transition:background-color ease-in-out .5s;
        -o-transition:background-color ease-in-out .5s;
        text-shadow: 0px -3px 3px rgba(255, 255, 255, 0.2);
    }
    .navs li a,a:visited,a:hover {
        color: black;
        text-decoration:none;
    }
    .navs li:hover {
        background-color: #1b6d85;
    }
    .navs li.actives {
        background-color:pink;
    }
</style>
<ul class="navs">
    <li class="actives" style="margin-left: -30px;"><a href="#">Petitioned Subjects</a></li>
    <li><a href="#">Petition a Subject</a></li>
</ul>
<br><br><br>
<div style="height: 600px;">
    <form role="search" class="app-search hidden-xs" method="post" action="/searchOverload/">
        {{ csrf_field() }}
        <input type="text" placeholder="Search for subjects..." class="form-control" name="overload" style="width: 45%; height: 30%;">
        <i class="fa fa-search" style="position: relative; right: 3%; color: gray;"></i>
    </form>
    <br>
    @if(isset($details))
        <div class="white-box" style="width: 100%; height:600px;">
            <div class="table-responsive" style="overflow-y:scroll; height: 560px; width: 100%; margin-top: -.6%;">
                <table class="table" id="copy">
                    <th>Course Number</th>
                    <th>Descriptive Title</th>
                    <th>Units</th>
                    <th>Term</th>
                    <th>Number of Students</th>
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
                                <a href='#'>
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
        <div class="white-box" style="width: 100%; height: 600px;">
            <h3 class="box-title">Petitioned Subjects
            </h3>
            <div class="table-responsive" style="overflow-y:scroll; height: 500px; width: 100%; margin-top: -.6%;">
                <table class="table" style="position: absolute; display: block; z-index: 100; background-color:white; width: 82%;">
                    <tr>
                        <th>Course Number</th><th></th><th></th><th></th><th></th><th></th>
                        <th>Descriptive Title</th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th>
                        <th>Units</th><th></th><th></th>
                        <th>Term</th><th></th><th></th><th></th><th></th>
                        <th>Number of Students</th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th><th></th>
                    </tr>
                </table>
                <br><br><br>
                <table class="table" id="copy">
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
                            <td class="txt-oflo" >{{ $preenroll->coursenumber}}</td>
                            <td class="txt-oflo">{{$preenroll->destitle}}</td>
                            <td class="txt-oflo">{{$preenroll->units}}</td>
                            <td class="txt-oflo">{{$preenroll->term}}</td>
                            <td class="txt-oflo">{{ $number }}</td>
                            <td></td>
                            <td>
                                <a href='#'>
                                    <button class='btn btn-primary btn-sm' >
                                        <i class="fa fa-pencil-square" aria-hidden="true"><span>Petition Subject</span></i>
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