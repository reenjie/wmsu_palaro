@extends('layouts.home')
@section('carousel')
<div class="container shadow-lg" style="background-color: #050000;
background-image: linear-gradient(90deg, #1a0f0f 0%, #861c1cef 100%); ">
    @php
        $join = '';
    @endphp
          <div class="row mt-3">
            <div class="col-md-2"></div>
            <div class="col-md-8 p-5" style="color:white">
                <style>
                    #visitlink {
                        font-size:14px;text-decoration:none;float:right;color:rgb(241, 241, 139);
                    }
                    #visitlink:hover{
                       color:yellow;
                      
                        transition: all ease 0.2s;
                    }
                </style>
               
                <ul class="list-group list-group-flush">
                @foreach ($sport as $row )
             
         
                <li class="mb-5">
                    <form action="{{route('View')}}" method="post">
                        @csrf
                        <input type="hidden" name="id"  value="{{$row->id}}" >
                        <button type="submit" class="btn btn-link" id="visitlink"  >Visit Page</button>
                      </form> 
                      <h5 class="hf text-warning">{{$row->name}}</h5>
                
                    <hr>
                    <h6 class="text-light">Match & Score Board</h6>
                    @foreach ($game as $g)
                    @if($g->sports_id == $row->id)
                    <h6 class="hf text-light" style="font-weight: bold">{{$g->name}}</h6>
    
                    <span style="font-size:12px" class="text-light">Match</span>
                    <br>
                    <div class="row"  >
                    @foreach ($tally as $mytally)
                                       
                    @if($g->id == $mytally->match_id)
                  
                        @foreach ($team as $key => $group)
                        @if($mytally->team == $group->id)
                      
                            <div class="col-md-6 mb-2 p-4" style="border:1px solid white" >
                         
                                <span class="hf text-light">{{$group->name}}</span>    
                                <br>
                                <span class="text-primary" style="font-size:13px">
                                @if($mytally->isofficial == 0)
                                Unofficial
                                @else 
                                OFFICIAL
                                @endif
                                </span>
                                <br>
                                <span class="text-light" style="font-size: 12px">
                                    Score: <span class="text-light">{{$mytally->tally}}</span>
                                </span>
                               
                            </div>
                       
                     
    
                        @endif
                        @endforeach
                     
                    @endif
                    @endforeach
                </div>
                      @endif
                    @endforeach

                    @foreach ($user as $key => $independent)
                                        @if($mytally->user_id == $independent->id)
                                               
                                          @for ($i = 0; $i < 3; $i++)
                                              @if($i == 0)
                                                  @if($key == 0)
                                              <div class="col-md-5">
                                             oooooo
                                                  <span class="hf text-light">{{$independent->name}}</span>    
                                                  <br>
                                                  <span class="text-primary" style="font-size:13px">@if($mytally->isofficial == 0)
                                                    Unofficial
                                                    @else 
                                                    OFFICIAL
                                                    @endif</span>
                                                  <br>
                                                  <span class="text-light" style="font-size: 12px">
                                                      Score: <span class="text-light">{{$mytally->tally}}</span>
                                                  </span>
                                                 
                                              </div>
                                                  @endif
                                              @endif
                                              @if($i == 1)
                                             <div class="col-md-2" id="k{{$i}}">
                                        
                                             </div>
                                              @endif
                                              @if($i == 2)
    
                                                  @if($key == 1)
                                              <div class="col-md-5">
                                             
                                                  <span class="hf">{{$independent->name}}</span>    
                                                  <br>
                                                  <span class="text-primary" style="font-size:13px">@if($mytally->isofficial == 0)
                                                    Unofficial
                                                    @else 
                                                    OFFICIAL
                                                    @endif</span>
                                                  <br>
                                                  <span class="text-light" style="font-size: 12px">
                                                      Score: <span class="text-light">{{$mytally->tally}}</span>
                                                  </span>
                                                 
                                              </div>
                                                  @endif
    
                                              @endif
                                          @endfor
                                       
                                        
                                       
    
                                       @endif 
                                      @endforeach
        
                    
                    <h6 class="mt-4">Participated Colleges</h6>

                    <ul style="font-size: 14px">
                      @php
         $ptcollege = DB::select("SELECT * FROM `colleges` WHERE id in (
                select CollegeId from users where id in (
                select user_id from participants where team in (
                    select id from teams where sports_id ='$row->id' 
                )
                )


             )");

                      @endphp

                      @foreach ($ptcollege as $cl )

                      <li>{{$cl->name}}</li>
                          
                      @endforeach
                    </ul>


                </li>

                @endforeach

            </ul>
             
            
           
           

            </div>
            <div class="col-md-2"></div>
          </div>

</div>

@endsection