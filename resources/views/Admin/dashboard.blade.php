@extends('layouts.admin_layout')
@section('content')

            <div class="container">
                        <h5 class="af">Dashboard</h5>
                      {{--   {{ Auth::user()->name }}
                        {{ Auth::user()->email }}
                        {{ Auth::user()->password }}
                        {{ Auth::user()->id }} --}}
                    <div class="row">
                      <div class="col-md-9">
                        <div class="row">
                          <div class="col-md-4 mt-4">
                            <div class="card shadow-sm " style="background-color: rgba(117, 7, 7, 0.877)">
                              <div class="card-body">
                                <h5 class="hf text-light">Coordinators</h5>
                                <h6 class="af text-light" style="font-size:14px;" >
                               <span class="badge bg-light text-dark" style="font-size:17px">{{count($coordinator)}}</span>  Accounts
                                </h6>
                                <i  class="dashboardbanner fas fa-users-gear"></i>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-4 mt-4">
                            <div class="card shadow-sm " style="background-color: rgba(7, 36, 117, 0.877)">
                              <div class="card-body">
                                <h5 class="hf text-light">Students</h5>
                                <h6 class="af text-light" style="font-size:14px;" >
                               <span class="badge bg-light text-dark" style="font-size:17px">{{count($students)}}</span>  Accounts
                                </h6>
                                <i  class="dashboardbanner fas fa-users"></i>
                              </div>
                            </div>
                          </div>
                          <div class="col-md-4 mt-4">
                            <div class="card shadow-sm " style="background-color: rgba(168, 146, 18, 0.877)">
                              <div class="card-body">
                                <h5 class="hf text-light">Colleges</h5>
                                <h6 class="af text-light" style="font-size:14px;" >
                               <span class="badge bg-light text-dark" style="font-size:17px">{{count($college)}}</span>  in Records
                                </h6>
                                <i  class="dashboardbanner fas fa-graduation-cap"></i>
                              </div>
                            </div>
                          </div>
                        </div>
                      


                        <div class="row mt-3">
                          <div class="col-md-4">
                            <div class="card shadow">
                              <div class="card-body">
                                
                                <h6 class="hf text-primary">Sport Events</h6>
                                <hr>
                                <div class="overflow event_contents" >

                                
                                <ol class="list-group ">
                                  @foreach ($sport as $event)
                                  <li class="list-group-item d-flex justify-content-between align-items-start">

                                    <div class="ms-2 me-auto">
                                      <span style="font-size:11px" class="hf">
                                      @foreach ($college as $item)
                                          @if($item->id == $event->CollegeId)
                                        {{$item->name}}
                                          @endif
                                      @endforeach
                                      </span>
                                      <div  class="fw-bold text-danger">{{$event->name}}</div>
                                     <span style="font-size:12px">{{$event->description}}</span>
                                    </div>
                                   {{--  <span class="badge bg-primary rounded-pill">14</span> --}}
                                  </li> 
                                  @endforeach
                               
                                </ol>
                              </div>

                              </div>
                            </div>
                          </div>

                          <div class="col-md-8">
                            <div class="card shadow">
                              <div class="card-body">
                            
                               
                                <script>
                                  window.onload = function () {
                                  
                                  var chart = new CanvasJS.Chart("chartContainer", {
                                    exportEnabled: true,
                                    animationEnabled: true,
                                    title:{
                                      text: "All sportsevent and its participants"
                                    },
                                 /*    subtitles: [{
                                      text: "Click Legend to Hide or Unhide Data Series"
                                    }], */ 
                                    axisX: {
                                      title: "Sport/Events"
                                    },
                                    axisY: {
                                      title: "Participants",
                                      titleFontColor: "#4F81BC",
                                      lineColor: "#4F81BC",
                                      labelFontColor: "#4F81BC",
                                      tickColor: "#4F81BC",
                                      includeZero: true
                                    },
                                   /*  axisY2: {
                                      title: "Clutch - Units",
                                      titleFontColor: "#C0504E",
                                      lineColor: "#C0504E",
                                      labelFontColor: "#C0504E",
                                      tickColor: "#C0504E",
                                      includeZero: true
                                    } ,*/
                                    toolTip: {
                                      shared: true
                                    },
                                   /*  legend: {
                                      cursor: "pointer",
                                      itemclick: toggleDataSeries
                                    }, */
                                    data: [{
                                      type: "column",
                                      name: "",
                                      showInLegend: true,      
                                      yValueFormatString: "#,##0.# Participants",
                                      dataPoints: [
                                     
                                     @foreach($graph as $row)
                                   

                                      { label: "{{$row->name}}",  y: {{$row->totalcount}} },
                                    
                                     @endforeach

                                       /*  { label: "New Jersey",  y: 19034.5 },
                                        { label: "Texas", y: 20015 },
                                        { label: "Oregon", y: 25342 },
                                        { label: "Montana",  y: 20088 },
                                        { label: "Massachusetts",  y: 28234 } */
                                      ]
                                    }/* ,
                                    {
                                      type: "column",
                                      name: "Clutch",
                                      axisYType: "secondary",
                                      showInLegend: true,
                                      yValueFormatString: "#,##0.# Units",
                                      dataPoints: [
                                        { label: "New Jersey", y: 210.5 },
                                        { label: "Texas", y: 135 },
                                        { label: "Oregon", y: 425 },
                                        { label: "Montana", y: 130 },
                                        { label: "Massachusetts", y: 528 }
                                      ]
                                    } */]
                                  });
                                  chart.render();
                                  
                                  function toggleDataSeries(e) {
                                    if (typeof (e.dataSeries.visible) === "undefined" || e.dataSeries.visible) {
                                      e.dataSeries.visible = false;
                                    } else {
                                      e.dataSeries.visible = true;
                                    }
                                    e.chart.render();
                                  }
                                  
                                  }
                                  </script>

<div id="chartContainer" style="height: 300px; width: 100%;"></div>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>


                              </div>
                            </div>

                            <div class="card shadow mt-4">
                              <div class="card-body">
                                <h6 class="hf">WMSU PALARO YEAR {{now()->format('Y')}}-{{now()->format('Y')+1}}</h6>
                              </div>
                            </div>
                          </div>
                        </div>


                      </div>
                   
                  
                  
                     
                     
                      <div class="col-md-3">
                       
                     

                        <table>
                          <tr><td style="text-align: center;"><canvas id="canvas_tt62d8e53299536" width="175" height="175"></canvas></td></tr>
                          <tr><td style="text-align: center; font-weight: bold"><a href="//24timezones.com/Manila/time" style="text-decoration: none" class="clock24" id="tz24-1658381618-c1145-eyJzaXplIjoiMTc1IiwiYmdjb2xvciI6IjAwOTlGRiIsImxhbmciOiJlbiIsInR5cGUiOiJhIiwiY2FudmFzX2lkIjoiY2FudmFzX3R0NjJkOGU1MzI5OTUzNiJ9" title="Manila timezone" target="_blank" rel="nofollow">WMSU</a></td></tr>
                      </table>
            <script type="text/javascript" src="//w.24timezones.com/l.js" async></script>


                       {{-- 
                        <div class="card shadow mt-5 bg-dark">
                          <div class="card-body">
                            <h6 class="hf text-primary">Colleges with Events</h6>
                            <ul class="list-group list-group-flush">
                              @foreach ($collegewevent as $item)
                              <li class="list-group-item hf" style="font-size:13px">{{$item->name}}</li>
                              @endforeach
                           
                            </ul>
  

                          </div>
                        </div> --}}
                        
                      </div>
                    </div>

                
            </div>

@endsection