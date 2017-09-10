<div class="white-box">
    <div class="table-responsive" style="overflow-y:scroll; height: 590px; ">
        <table class="table">
            <p> <b> First Year -- First Semester</b></p>
            <thead>
            <tr>
                <th>Course Number</th>
                <th>Descriptive Title</th>
                <th>Units</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $subjects = DB::table('checklist')->where('subyear', '=', '1')->where('term', '=', 'First')->where('course', '=', 'BLIS')->get();
            ?>
            @foreach ($subjects as $subjects)
                <tr>
                    <td class="txt-oflo">{{ $subjects->coursenumber }}</td>
                    <td>{{ $subjects->destitle }}</td>
                    <td class="txt-oflo">{{ $subjects->units }}</td>
                </tr>

            @endforeach

            </tbody>
        </table>
        <table class="table">
            <br>
            <p> <b> First Year -- Second Semester</b></p>
            <thead>
            <tr>
                <th>Course Number</th>
                <th>Descriptive Title</th>
                <th>Units</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $subjects = DB::table('checklist')->where('subyear', '=', '1')->where('term', '=', 'Second')->where('course', '=', 'BLIS')->get();
            ?>
            @foreach ($subjects as $subjects)
                <tr>
                    <td class="txt-oflo">{{ $subjects->coursenumber }}</td>
                    <td>{{ $subjects->destitle }}</td>
                    <td class="txt-oflo">{{ $subjects->units }}</td>
                </tr>

            @endforeach

            </tbody>
        </table>
        <table class="table">
            <br>
            <p> <b> First Year -- Short Semester</b></p>
            <thead>
            <tr>
                <th>Course Number</th>
                <th>Descriptive Title</th>
                <th>Units</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $subjects = DB::table('checklist')->where('subyear', '=', '1')->where('term', '=', 'Short')->where('course', '=', 'BLIS')->get();
            ?>
            @foreach ($subjects as $subjects)
                <tr>
                    <td class="txt-oflo">{{ $subjects->coursenumber }}</td>
                    <td>{{ $subjects->destitle }}</td>
                    <td class="txt-oflo">{{ $subjects->units }}</td>
                </tr>

            @endforeach

            </tbody>
        </table>


        <table class="table">
            <br>
            <p> <b> Second Year -- First Semester</b></p>
            <thead>
            <tr>
                <th>Course Number</th>
                <th>Descriptive Title</th>
                <th>Units</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $subjects = DB::table('checklist')->where('subyear', '=', '2')->where('term', '=', 'First')->where('course', '=', 'BLIS')->get();
            ?>
            @foreach ($subjects as $subjects)
                <tr>
                    <td class="txt-oflo">{{ $subjects->coursenumber }}</td>
                    <td>{{ $subjects->destitle }}</td>
                    <td class="txt-oflo">{{ $subjects->units }}</td>
                </tr>

            @endforeach

            </tbody>
        </table>
        <table class="table">
            <br>
            <p> <b> Second Year -- Second Semester</b></p>
            <thead>
            <tr>
                <th>Course Number</th>
                <th>Descriptive Title</th>
                <th>Units</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $subjects = DB::table('checklist')->where('subyear', '=', '2')->where('term', '=', 'Second')->where('course', '=', 'BLIS')->get();
            ?>
            @foreach ($subjects as $subjects)
                <tr>
                    <td class="txt-oflo">{{ $subjects->coursenumber }}</td>
                    <td>{{ $subjects->destitle }}</td>
                    <td class="txt-oflo">{{ $subjects->units }}</td>
                </tr>

            @endforeach

            </tbody>
        </table>
        <table class="table">
            <br>
            <p> <b>Second Year -- Short Semester</b></p>
            <thead>
            <tr>
                <th>Course Number</th>
                <th>Descriptive Title</th>
                <th>Units</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $subjects = DB::table('checklist')->where('subyear', '=', '2')->where('term', '=', 'Short')->where('course', '=', 'BLIS')->get();
            ?>
            @foreach ($subjects as $subjects)
                <tr>
                    <td class="txt-oflo">{{ $subjects->coursenumber }}</td>
                    <td>{{ $subjects->destitle }}</td>
                    <td class="txt-oflo">{{ $subjects->units }}</td>
                </tr>

            @endforeach

            </tbody>
        </table>


        <table class="table">
            <br>
            <p> <b>Third Year -- First Semester</b></p>
            <thead>
            <tr>
                <th>Course Number</th>
                <th>Descriptive Title</th>
                <th>Units</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $subjects = DB::table('checklist')->where('subyear', '=', '3')->where('term', '=', 'First')->where('course', '=', 'BLIS')->get();
            ?>
            @foreach ($subjects as $subjects)
                <tr>
                    <td class="txt-oflo">{{ $subjects->coursenumber }}</td>
                    <td>{{ $subjects->destitle }}</td>
                    <td class="txt-oflo">{{ $subjects->units }}</td>
                </tr>

            @endforeach

            </tbody>
        </table>
        <table class="table">
            <br>
            <p> <b>Third Year -- Second Semester</b></p>
            <thead>
            <tr>
                <th>Course Number</th>
                <th>Descriptive Title</th>
                <th>Units</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $subjects = DB::table('checklist')->where('subyear', '=', '3')->where('term', '=', 'Second')->where('course', '=', 'BLIS')->get();
            ?>
            @foreach ($subjects as $subjects)
                <tr>
                    <td class="txt-oflo">{{ $subjects->coursenumber }}</td>
                    <td>{{ $subjects->destitle }}</td>
                    <td class="txt-oflo">{{ $subjects->units }}</td>
                </tr>

            @endforeach

            </tbody>
        </table>
        <table class="table">
            <br>
            <p> <b>Third Year -- Short Semester</b></p>
            <thead>
            <tr>
                <th>Course Number</th>
                <th>Descriptive Title</th>
                <th>Units</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $subjects = DB::table('checklist')->where('subyear', '=', '3')->where('term', '=', 'Short')->where('course', '=', 'BLIS')->get();
            ?>
            @foreach ($subjects as $subjects)
                <tr>
                    <td class="txt-oflo">{{ $subjects->coursenumber }}</td>
                    <td>{{ $subjects->destitle }}</td>
                    <td class="txt-oflo">{{ $subjects->units }}</td>
                </tr>

            @endforeach

            </tbody>
        </table>
        <table class="table">
            <br>
            <p> <b> Fourth Year -- First Semester</b></p>
            <thead>
            <tr>
                <th>Course Number</th>
                <th>Descriptive Title</th>
                <th>Units</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $subjects = DB::table('checklist')->where('subyear', '=', '4')->where('term', '=', 'First')->where('course', '=', 'BLIS')->get();
            ?>
            @foreach ($subjects as $subjects)
                <tr>
                    <td class="txt-oflo">{{ $subjects->coursenumber }}</td>
                    <td>{{ $subjects->destitle }}</td>
                    <td class="txt-oflo">{{ $subjects->units }}</td>
                </tr>

            @endforeach

            </tbody>
        </table>
        <table class="table">
            <br>
            <p> <b> Fourth Year -- Second Semester</b></p>
            <thead>
            <tr>
                <th>Course Number</th>
                <th>Descriptive Title</th>
                <th>Units</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $subjects = DB::table('checklist')->where('subyear', '=', '4')->where('term', '=', 'Second')->where('course', '=', 'BLIS')->get();
            ?>
            @foreach ($subjects as $subjects)
                <tr>
                    <td class="txt-oflo">{{ $subjects->coursenumber }}</td>
                    <td>{{ $subjects->destitle }}</td>
                    <td class="txt-oflo">{{ $subjects->units }}</td>
                </tr>

            @endforeach

            </tbody>
        </table>

    </div>
</div>
<div class="white-box">
    <div class="table-responsive" style="overflow-y:scroll; height: 590px; ">
        <table class="table">
            <h5> <b>ELECTIVES</b></h5>
            <thead>
            <tr>
                <th>Course Number</th>
                <th>Descriptive Title</th>
                <th>Units</th>
            </tr>
            </thead>
            <tbody>
            <?php
            $subjects = DB::table('checklist')->where('subyear', '=', '0')->where('term', '=', '0')->where('course', '=', 'BLIS')->get();
            ?>
            @foreach ($subjects as $subjects)
                <tr>
                    <td class="txt-oflo">{{ $subjects->coursenumber }}</td>
                    <td>{{ $subjects->destitle }}</td>
                    <td class="txt-oflo">{{ $subjects->units }}</td>
                </tr>

            @endforeach

            </tbody>
        </table>
    </div>
</div>