@if($types == 'Events')
@include('eventstally')
@else

<table class="table  text-light" style="font-size: 14px">
  <thead>


    <tr style="background-color: white;color:rgb(136, 41, 41);font-weight:bold;text-transform:uppercase">
      <th scope="col">College</th>
      <th scope="col">Champion</th>
      <th scope="col">1st Runner Up</th>
      <th scope="col">2nd Runner-up</th>
      <th scope="col">Competed</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($college as $item)

    <tr>
      <th scope="row">{{$item->name}}</th>
      <td style="text-align: center;border:1px solid white;font-weight:bold;font-size:18px">
        @php
        //
        if($types == 'Participant'){
        $champ = DB::select('SELECT * FROM `users` WHERE id in (select user_id from participants where team in (select id from teams where result = 3 )) and CollegeId = '.$item->id.' ');
        }else {
        $champ = DB::select('select * from teams where result =3 and id in (select team from participants where user_id in (select id from users where CollegeId = '.$item->id.'))');
        }


        @endphp


        @if(count($champ)>=1)
        {{count($champ)}}
        @else

        @endif


      </td>
      <td style="text-align: center;border:1px solid white;font-weight:bold;font-size:18px">
        @php

        if($types == 'Participant'){
        $firstrunnerup = DB::select('SELECT * FROM `users` WHERE id in (select user_id from participants where team in (select id from teams where result = 1 )) and CollegeId = '.$item->id.' ');
        }else {
        $firstrunnerup = DB::select('select * from teams where result =1 and id in (select team from participants where user_id in (select id from users where CollegeId = '.$item->id.'))');
        }




        @endphp


        @if(count($firstrunnerup))
        {{count($firstrunnerup)}}
        @else

        @endif

      </td>
      <td style="text-align: center;border:1px solid white;font-weight:bold;font-weight:bold;font-size:18px">
        @php

        if($types == 'Participant'){
        $secondrunnerup = DB::select('SELECT * FROM `users` WHERE id in (select user_id from participants where team in (select id from teams where result = 2 )) and CollegeId = '.$item->id.' ');
        }else {
        $secondrunnerup = DB::select('select * from teams where result =2 and id in (select team from participants where user_id in (select id from users where CollegeId = '.$item->id.'))');
        }

        @endphp


        @if(count($secondrunnerup))
        {{count($secondrunnerup)}}
        @else

        @endif

      </td>
      <td style="text-align: center;font-weight:bold;font-size:18px">
        @php
        if($types == 'Participant'){

        $totalcompeted = DB::select('SELECT * FROM `users` WHERE id in (select user_id from participants) and CollegeId = '.$item->id.' ');
        }else {
        $totalcompeted = DB::select('SELECT * FROM `teams` WHERE id in (select team from participants where user_id in (select id from users where CollegeId ='.$item->id.' )) ');

        }


        @endphp


        @if(count($totalcompeted))
        {{count($totalcompeted)}}
        @else

        @endif

      </td>
    </tr>
    @endforeach
    {{--
                    1 = 1st runner up
                    2 = 2nd Runner up
                    3 = Champion
                    //get The Count base on results
SELECT * FROM `users` WHERE id in (select user_id from participants where team in (select id from teams where result = 2 )) and CollegeId = 3;


// get the total Count COmpeted
SELECT * FROM `users` WHERE id in (select user_id from participants) and CollegeId = 1;


                    //
                    
                    --}}

  </tbody>
</table>
@endif