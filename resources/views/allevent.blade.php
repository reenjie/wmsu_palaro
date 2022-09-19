@extends('layouts.home')
@section('carousel')
<div class="container">
    @php
        $join = '';
    @endphp
          <div class="row mt-5">
            <div class="col-md-2"></div>
            <div class="col-md-8" style="color:white">
                @foreach ($sport as $row )
                <style>
                    #visitlink {
                        font-size:14px;text-decoration:none;float:right;color:rgb(241, 241, 139);
                    }
                    #visitlink:hover{
                       color:yellow;
                      
                        transition: all ease 0.2s;
                    }
                </style>
                <div class="container mb-2">
                 
                    <form action="{{route('View')}}" method="post">
                        @csrf
                        <input type="hidden" name="id"  value="{{$row->id}}" >
                        <button type="submit" class="btn btn-link" id="visitlink"  >Visit Page</button>
                      </form>
                    <h5 class="hf text-warning">{{$row->name}}</h5>
                
                    <hr>
                    <h6 class="text-light">Match & Score Board</h6>
                    <div class="">
                        <ul class="list-group list-group-flush">

                            @foreach ($game as $g)
                                @if($g->sports_id == $row->id)
                                <li class="">
                                    <h6 class="hf text-light" style="font-weight: bold">{{$g->name}}</h6>
    
                                    <span style="font-size:12px" class="text-light">Match</span>
                                    <br>
                                    {{-- <h6 class="hf text-danger" style="text-align: center"> Vs</h6> --}}
                                    <div class="row">
                                    @foreach ($tally as $mytally)
                                       
                                    @if($g->id == $mytally->match_id)
                                 
                                 
                                   
                                 
                                        @foreach ($team as $key => $group)
                                          @if($mytally->team == $group->id)
                                          
                                        
                                                <div class="col-md-6">
                                               
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
    
                                            
                                              
                                      @foreach ($user as $key => $independent)
                                        @if($mytally->user_id == $independent->id)
                                               
                                          @for ($i = 0; $i < 3; $i++)
                                              @if($i == 0)
                                                  @if($key == 0)
                                              <div class="col-md-5">
                                             
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
                                            {{--   <h6 class="text-danger hf ">VS</h6> --}}
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
                                    
                                        
    
    
                                   
                                 
    
    
    
                                    @endif
                                    @endforeach
                                  {{--   <span class="text-light badge bg-danger"
                                        style="float: right">5</span> --}}</li> 
                                @endif

                        
                            @endforeach
                        </div>

                        </ul>
                    </div>
                    <hr>
                </div>
              

                @endforeach

            </div>
            <div class="col-md-2"></div>
          </div>

</div>

@endsection