@extends('layouts.home')
@section('carousel')
 

    <div class="container-fluid  bg-dark ">
        @foreach ($sport as $events)
            @php
            $eventname = Strtoupper($events->name);
                $src = '';
                if ($events->file == '') {
                    $src = asset('assets/img/wmsu.jpg');
                } else {
                    $src = asset('assets/img') . '/' . $events->file;
                }
                
            @endphp
           
            <div class="container p-3" >
                <h4 class="text-light title" style="font-size: 16px;text-align:right">WMSU PALARO {{date('Y')}}</h4>
                <span style="font-size: 13px" class="text-danger hf">
                    @foreach ($college as $col)
                        @if ($col->id == $events->CollegeId)
                            {{ $col->name }} 
                        @endif
                    @endforeach
                </span>
                <h4 class="text-danger hf" style="font-weight: bold">{{ $events->name }}
                    <span style="font-size:15px" class="text-secondary">( {{$events->istype}} )</span>

                </h4>
            </div>
          
            <div class="container">
                <div class="row">
                <div class="col-md-4">
                   
                    <h6 style="text-align: center">
                        <img src="{{ $src }}" alt="" style="width: 250px;height:250px;" class="img-thumbnail rounded-circle shadow">
                        <br>
                        <button class="btn btn-dark"  data-bs-toggle="modal" data-bs-target="#exampleModal" style="font-size: 14px">Description</button>
          
          <!-- Modal -->
          <div class="modal fade " id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-fullscreen ">
              <div class="modal-content">
            
                <div class="modal-body bg-dark" >
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close" style="float: right;"></button>
                        <div class="row">
                                    <div class="col-md-1"></div>
                                    <div class="col-md-10">
                                             {{--    <img src="{{ $src }}" alt="" style="width:100%; height:100%" class="img-thumbnail shadow" > --}}
                                             <div class="row mt-5" >

                                                <div class="col-md-4">
                                                    <h6 class="text-secondary hf mt-5" style="font-weight: bold">
                                                        Description
                                
                                                        <hr>
                                                        <span style="font-size:14px;font-weight:normal"
                                                            class="hf text-secondary">{{ $events->description }}</span>
                                
                                                    </h6>
                                                </div>
                                                <div class="col-md-4 ">
                                                    <h6 class="text-secondary hf mt-5" style="font-weight: bold">
                                
                                                        Rules & Regulations
                                                        <hr>
                                                        <span style="font-size:14px;font-weight:normal"
                                                            class="hf text-secondary">{{ $events->rules_regulation }}</span>
                                
                                                    </h6>
                                                </div>
                                                <div class="col-md-4">
                                                    <h6 class="text-secondary hf mt-5" style="font-weight: bold">
                                
                                                        Requirements
                                                        <hr>
                                                        <span style="font-size:14px;font-weight:normal"
                                                            class="hf text-danger">{{ $events->requirements }}</span>
                                
                                
                                                        <br><br>
                                                        No. of Participants allowed
                                                        <br>
                                                        <span style="font-size:14px" class="hf text-danger">{{ $events->nop }}</span>
                                                        <input type="hidden" id="eventid" value="{{ $events->id }}">
                                                    </h6>
                                                </div>
                                
                                
                                            </div>
                                    </div>
                                    <div class="col-md-1"></div>
                        </div>
                      
                </div>
              
              </div>
            </div>
          </div>
                    </h6>


                </div>
                <div class="col-md-8">
                   
         


 @if(count($carousel)>=1)
 <div id="carouselExampleIndicators" class="carousel slide" data-bs-ride="true">
     <div class="carousel-indicators">
         <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="0" class="active"
             aria-current="true" aria-label="Slide 1"></button>
         <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="1"
             aria-label="Slide 2"></button>
         <button type="button" data-bs-target="#carouselExampleIndicators" data-bs-slide-to="2"
             aria-label="Slide 3"></button>
     </div>
     <div class="carousel-inner">
         
         @foreach ($carousel as $row )
        @if($row->isactive == 1)
         <div class="carousel-item active ">
           <img src="{{asset('assets/img').'/'.$row->images}}"  style="height: 400px"
           class="d-block w-100" alt="...">
         </div>
         @else
         <div class="carousel-item">
             <img src="{{asset('assets/img').'/'.$row->images}}"  style="height: 400px"
             class="d-block w-100" alt="...">
           </div>
         @endif

         @endforeach
        
       

     </div>
     <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleIndicators"
         data-bs-slide="prev">
         <span class="carousel-control-prev-icon" aria-hidden="true"></span>
         <span class="visually-hidden">Previous</span>
     </button>
     <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleIndicators"
         data-bs-slide="next">
         <span class="carousel-control-next-icon" aria-hidden="true"></span>
         <span class="visually-hidden">Next</span>
     </button>
 </div> 
@else
<div>
    <div  style="text-align: center;color:white">
      
        <img src="{{asset('assets/img/wmsu.jpg')}}" style="width:300px" alt="" class="rounded-circle">
        <br>
        Image Unavailable.
      </div>
</div>

 @endif



                </div>
            </div>

          
            @if(count($team)>=1)
            <div class="row mt-4">
                <h5 class="hf text-light">TEAMs</h5>
              <br>
              <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    @foreach ($team as $item)
                    <li class="breadcrumb-item active" aria-current="page"><span class="text-info hf" style="font-weight: bolder;font-size:16px">{{$item->name}}</span></li>
                    @endforeach   
                 
                </ol>
              </nav>
           
            </div>
            @endif
        @endforeach



        <hr>


    </div>

    </div>

    <div class="container mt-5 reveal">

        <script>
            window.onload = function() {

                var chart = new CanvasJS.Chart("chartContainer", {
                    theme: "dark1", // "light1", "light2", "dark1", "dark2"
                    exportEnabled: true,
                    animationEnabled: true,
                    title: {
                        text: "{{$eventname}}"
                    },
                    data: [{
                        type: "pie",
                        startAngle: 25,
                        toolTipContent: "<b>{label}</b>: {y}",
                        showInLegend: "true",
                        legendText: "{label}",
                        indexLabelFontSize: 16,
                        indexLabel: "{label} - {y}",
                        dataPoints: [{
                                y:{{count($participant)}},
                                label: "Participants"
                            },
                            {
                                y: {{count($team)}},
                                label: "Teams"
                            },
                            {
                                y: {{count($game)}},
                                label: "Game Match"
                            },
                          
                           
                        ]
                    }]
                });
                chart.render();

            }
        </script>
        <div class="row">
            <div class="col-md-8">
           {{--      <div id="chartContainer" style="height: 300px; width: 100%;background-color:transparent"></div> --}}

               @if (count($video) >= 1)
                        @foreach ($video as $vid)
                            @if ($vid->videotype == 'youtube')
                                <iframe id="ycvideo" width="400" height="315" src="{{ $vid->video }}"
                                    frameborder="0" allowfullscreen></iframe>
                            @elseif($vid->videotype == 'facebook')
                                <div class="" id="facebookvideo">
                                    {!! $vid->video !!}
                                </div>
                            @endif
                        @endforeach
                    @else
                    <div>
                        <div style="text-align: center">
                          
                            <img src="{{asset('assets/img/wmsu.jpg')}}" style="width:300px" alt="" class="rounded-circle">
                            <br>
                            Video Unavailable.
                          </div>
                    </div>
                    
                    @endif

                <script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
                <br>
                <table class="table">
                    <thead>
                      <tr class="table-dark">
                        <th scope="col">Team</th>
                        <th scope="col">Members</th>
                      {{--   <th scope="col">Scores</th> --}}
                      
                      </tr>
                    </thead>
                    <tbody>
                        @foreach ($team as $row)
                        <tr>
                            <td scope="row" class="text-danger hf" style="font-size: 15px">{{$row->name}}</td>
                            <td>
                                <ul class="list-group" >
                                    @foreach ($participant as $item)
                                    @if($item->team == $row->id)
                                  
                                    @foreach ($alluser as $pp)
                                   
                                    @if($pp->id == $item->user_id )
                                    <li class="">
                                    <span class="text-primary hf" style="font-weight: bold;font-size:13px">{{$pp->name}}
                                   
                                    <br>
                                    <span style="font-size: 13px" class="text-secondary af">{{$pp->email}}</span>
                                    <br>
                                    <span class="badge text-bg-success bg-danger">  @foreach ($college as $cl)

                                        @if($cl->id == $pp->CollegeId)
                                        {{$cl->name}}
                                        @endif
                                        
                                    @endforeach</span>
                                      
                                    </span>    
                                    </li>  

                                    @endif
                                    @endforeach

                                    @endif
                                    @endforeach
                                  
                                   
                                  
                                  </ul>
                            </td>
                         {{--    <td>


                            </td> --}}
                          </tr>
                        @endforeach
                     
                    </tbody>
                  </table>

            </div>
            <div class="col-md-4">
                <div class="  mt-3">
                    <div class="">
                        <h6 class="text-dark">Match & Score Board</h6>
                        <div class="card-body">
                            <ul class="list-group list-group-flush">

                                @foreach ($game as $row)
                                <li class="">
                                    <h6 class="hf text-dark" style="font-weight: bold">{{$row->name}}</h6>

                                    <span style="font-size:12px" class="text-dark">Match</span>
                                    <br>
                                    <h6 class="hf text-danger" style="text-align: center"> Vs</h6>
                                    <div class="row">
                                    @foreach ($tally as $mytally)
                                       
                                    @if($row->id == $mytally->match_id)
                                 
                                 
                                   
                                 
                                        @foreach ($team as $key => $group)
                                          @if($mytally->team == $group->id)
                                          
                                        
                                                <div class="col-md-6">
                                               
                                                    <span class="hf text-dark">{{$group->name}}</span>    
                                                    <br>
                                                    <span class="text-primary" style="font-size:13px">
                                                    @if($mytally->isofficial == 0)
                                                    Unofficial
                                                    @else 
                                                    OFFICIAL
                                                    @endif
                                                    </span>
                                                    <br>
                                                    <span class="text-dark" style="font-size: 12px">
                                                        Score: <span class="text-dark">{{$mytally->tally}}</span>
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
                                             
                                                  <span class="hf text-dark">{{$independent->name}}</span>    
                                                  <br>
                                                  <span class="text-primary" style="font-size:13px">@if($mytally->isofficial == 0)
                                                    Unofficial
                                                    @else 
                                                    OFFICIAL
                                                    @endif</span>
                                                  <br>
                                                  <span class="text-dark" style="font-size: 12px">
                                                      Score: <span class="text-dark">{{$mytally->tally}}</span>
                                                  </span>
                                                 
                                              </div>
                                                  @endif
                                              @endif
                                              @if($i == 1)
                                             <div class="col-md-2" id="k{{$i}}">
                                              <h6 class="text-danger hf ">VS</h6>
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
                                                  <span class="text-dark" style="font-size: 12px">
                                                      Score: <span class="text-dark">{{$mytally->tally}}</span>
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
                                @endforeach
                            </div>

                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        $('#1').addClass('d-none');
        $('#k1').addClass('d-none');
    </script>

  
    
  {{--   @if (count($announcement) >= 1)
    <div class="container mt-5 ">
        <div class="mt-5">
            <div class="card-header">
                <h6 class="hf text-danger" style="font-weight: bolder">Announcements</h6>
            </div>
    
            <div class="card-body">
                <div class="row">
                     
                    <div class="col-md-10">
                        <div class="">
                          
                                @foreach ($announcement as $ann)
                                    <a href="javascript:void(0)" class=" mb-2"
                                        aria-current="true" style="cursor: default;text-decoration:none;">
                                        <i class="fas fa-bell text-danger text-light"></i>

                                        <div class="d-flex w-100 justify-content-between">
                                            {{-- <h5 class="fs text-danger" style="font-size: 12px">
                                                               {{--    @foreach ($college as $col)
                                                                   @if ($col->id == $ann->CollegeId)
                                                                    {{$col->name}} 
                                                                   @endif
                                                                  @endforeach --}}

                                            {{-- @foreach ($sport as $item)
                                                                      @if ($item->id == $ann->sports_id)
                                                                 <span style="font-weight: bold">{{$item->name}}</span> 
                                                                      @endif
                                                                  @endforeach 
                                                                </h5>

                                            <small style="font-size:11px;float:right">
                                                <span style="color: #e9d5d8"><time class="timeago"
                                                        datetime="{{ $ann->date_added }}"
                                                        title="{{ $ann->date_added }}"></time></span>
                                            </small>
                                        </div>


                                        <p class="mb-1 fs text-light" style="font-size:13px">{{ $ann->announcement }}
                                        </p>

                                        <small style="font-size: 11px"></small>
                                    </a>
                                @endforeach
                       

                        </div>
                    </div>
                </div>



            </div>
        </div>
        
    </div>
 
@endif --}}
    <script>
        $(document).ready(function() {
            $("time.timeago").timeago();
        })
        /*   jQuery(document).ready(function() {
             jQuery("time.timeago").timeago();
              }); */
    </script>


    <div class="container mt-5">
        <h6 class="hf text-light">Event Coordinator</h6>
        <hr>

        <h6 class="hf text-danger" style="font-weight: bold">
            @foreach ($coordinator as $item)
                <nav style="--bs-breadcrumb-divider: '>>';" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"> {{ $item->name }} </li>
                        <li class="breadcrumb-item active" aria-current="page"> {{ $item->email }}</li>
                        <li class="breadcrumb-item active" aria-current="page"> {{ $item->contactno }}</li>
                    </ol>
                </nav>
            @endforeach
        </h6>

    </div>
@endsection
