<table class="table  text-light" style="font-size: 14px">
    <thead>


        <tr style="background-color: white;color:rgb(136, 41, 41);font-weight:bold;text-transform:uppercase">
            <th scope="col">Sport Event</th>
            <th scope="col">Champion</th>
            <th scope="col">1st Runner Up</th>
            <th scope="col">2nd Runner-up</th>
            <th scope="col">Competed</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($sportevent as $item)

        <tr>
            <th scope="row">{{$item->name}}</th>
            <td style="text-align: center;border:1px solid white;font-weight:bold;font-size:18px">
                <ul style="font-size:12px">

                    @php
                    $champ = DB::select('select * from `colleges` where id in ( SELECT CollegeId FROM `users` WHERE id in (select user_id from participants where team in (select id from teams where result = 3 ) and sports_id ='.$item->id.' ))')
                    @endphp
                    @foreach($champ as $row)
                    <li>{{$row->name}}</li>
                    @endforeach

                </ul>

            </td>
            <td style="text-align: center;border:1px solid white;font-weight:bold;font-size:18px">
                <ul style="font-size:12px">

                    @php
                    $fst = DB::select('select * from `colleges` where id in ( SELECT CollegeId FROM `users` WHERE id in (select user_id from participants where team in (select id from teams where result = 1 ) and sports_id ='.$item->id.' ))')
                    @endphp
                    @foreach($fst as $row)
                    <li>{{$row->name}}</li>
                    @endforeach

                </ul>

            </td>
            <td style="text-align: center;border:1px solid white;font-weight:bold;font-weight:bold;font-size:18px">
                <ul style="font-size:12px">

                    @php
                    $snd = DB::select('select * from `colleges` where id in ( SELECT CollegeId FROM `users` WHERE id in (select user_id from participants where team in (select id from teams where result = 2 ) and sports_id ='.$item->id.' ))')
                    @endphp
                    @foreach($snd as $row)
                    <li>{{$row->name}}</li>
                    @endforeach

                </ul>

            </td>
            <td style="text-align: center;font-weight:bold;font-size:18px">
                <ul style="font-size:12px">

                    @php
                    $com = DB::select('select * from `colleges` where id in ( SELECT CollegeId FROM `users` WHERE id in (select user_id from participants where sports_id ='.$item->id.' ))')
                    @endphp
                    @foreach($com as $row)
                    <li>{{$row->name}}</li>
                    @endforeach

                </ul>

            </td>
        </tr>
        @endforeach


    </tbody>