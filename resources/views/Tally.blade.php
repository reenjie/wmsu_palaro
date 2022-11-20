@extends('layouts.home')
@section('carousel')
<div class="container shadow" style="background-color: #050000;
background-image: linear-gradient(90deg, #1a0f0f 0%, #861c1cef 100%); ">
    @php
        $join = '';
    @endphp
       <div class="row mt-2 p-5">
        <h4 class="text-light">
            Overall Tallies
        </h4>

        <table class="table table-bordered text-light" style="font-size: 14px">
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
                    <td style="text-align: center">
                        @php
                       $champ = DB::select('SELECT * FROM `users` WHERE id in (select user_id from participants where team in (select id from teams where result = 3 )) and CollegeId = '.$item->id.' ');
                        @endphp

                        
                        @if(count($champ)>=1)
                        {{count($champ)}}
                        @else
                        -
                        @endif


                    </td>
                    <td style="text-align: center">
                        @php
                        $firstrunnerup = DB::select('SELECT * FROM `users` WHERE id in (select user_id from participants where team in (select id from teams where result = 1 )) and CollegeId = '.$item->id.' ');
                         @endphp
 
                        
                         @if(count($firstrunnerup))
                         {{count($firstrunnerup)}}
                         @else
                         -
                         @endif

                    </td>
                    <td style="text-align: center">
                        @php
                        $secondrunnerup = DB::select('SELECT * FROM `users` WHERE id in (select user_id from participants where team in (select id from teams where result = 2 )) and CollegeId = '.$item->id.' ');
                         @endphp
 
                      
                         @if(count($secondrunnerup))
                         {{count($secondrunnerup)}}
                         @else
                         -
                         @endif

                    </td>
                    <td style="text-align: center">
                        @php
                        $totalcompeted = DB::select('SELECT * FROM `users` WHERE id in (select user_id from participants) and CollegeId = '.$item->id.' ');
                         @endphp
 
                        
                         @if(count($totalcompeted))
                         {{count($totalcompeted)}}
                         @else
                         -
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
       </div>
            
</div>

@endsection