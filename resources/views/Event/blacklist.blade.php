@extends('layouts.event_layout')
@section('content')
  <div class="container">
            <h6 class="af mb-3" style="font-weight:bold;font-size:18px">BLACKLIST</h6>
            <a href="{{route('e.participants')}}" class="btn btn-dark btn-sm mb-3" >Back</a>

            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        
                        @foreach ($myevent as $sport)
            <h4 class="hf text-danger">{{$sport->name}} <button onclick="window.location.href='{{route('e.addblacklist', ['id' => $sport->id,'name'=> $sport->name])}}' " class="btn btn-light text-info btn-sm">Add List</button>   </h4>      
             
        <div class="row">

          

          
                    <div class="container">
                        @php $count=0 @endphp
                        <ul class="list-group list-group-flush">
                            @if(count($blacklisted)>=1)
                            @foreach ($blacklisted as $blocked)
                            @if($blocked->sports_id == $sport->id)
                                @foreach ($data as $user)
                                    @if($blocked->user_id == $user->id)
                                     <li class="list-group-item shadow">
                                <span class="text-danger">{{$user->name}}</span>
                                <br>
                                <span class="text-secondary" style="font-size: 12px">{{$user->email}}</span>
                                <span style="float: right">
                                    <button type="button" onclick="window.location.href='{{route('e.removefrom_blacklist',['id'=>$user->id,'event'=>$sport->id])}}' "  style="font-size: 12px" class="btn btn-light btn-sm unblock ">UNBLOCK</button>
                                </span>

                            </li>
                            @else
                            
                                    @endif
                                @endforeach
                            

                            @endif
                           
                            
                            @endforeach
                            @else
                           <h5 style="text-align: center;font-weight:bold" class="hf">No Blacklisted yet.</h5>
                            @endif
                           
                          </ul>


                    </div>
                
                
          
        </div>
        @endforeach
                    </div>

                    <div class="col-md-4">
                       {{--  <div class="card">
                            <div class="card-body">
                                <button class="btn btn-dark btn px-3">Add List</button>

                                

                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>


  </div>
  <script>
    $('.unblock').click(function () {
            $(this).html('<span class="text-secondary" style="font-size:12px">Unblocking..</span>');
    })
  </script>
@endsection

