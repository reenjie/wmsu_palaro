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
                               <span class="badge bg-light text-dark" style="font-size:17px">145</span>  Accounts
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
                               <span class="badge bg-light text-dark" style="font-size:17px">145</span>  Accounts
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
                               <span class="badge bg-light text-dark" style="font-size:17px">145</span>  Accounts
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

                                
                                <ol class="list-group list-group-numbered">
                                  @for ($i = 0; $i < 3; $i++)
                                  <li class="list-group-item d-flex justify-content-between align-items-start">

                                    <div class="ms-2 me-auto">
                                      <div class="fw-bold">Subheading</div>
                                      Content for list item
                                    </div>
                                    <span class="badge bg-primary rounded-pill">14</span>
                                  </li>
                                  <li class="list-group-item d-flex justify-content-between align-items-start">
                                    <div class="ms-2 me-auto">
                                      <div class="fw-bold">Subheading</div>
                                      Content for list item
                                    </div>
                                    <span class="badge bg-primary rounded-pill">14</span>
                                  </li>
                                  <li class="list-group-item d-flex justify-content-between align-items-start">
                                    <div class="ms-2 me-auto">
                                      <div class="fw-bold">Subheading</div>
                                      Content for list item
                                    </div>
                                    <span class="badge bg-primary rounded-pill">14</span>
                                  </li>
                                  @endfor
                               
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
	animationEnabled: true,
	exportEnabled: true,
	theme: "light1", // "light1", "light2", "dark1", "dark2"
	title:{
		text: "All Sports and its Participants"
	},
  	axisY: {
      includeZero: true
    },
	data: [{
		type: "column", //change type to bar, line, area, pie, etc
		//indexLabel: "{y}", //Shows y value on all Data Points
		indexLabelFontColor: "#5A5757",
      	indexLabelFontSize: 16,
		indexLabelPlacement: "outside",
		dataPoints: [
			{ x: 10, y: 71 },
			{ x: 20, y: 55 },
			{ x: 30, y: 50 },
			{ x: 40, y: 65 },
			{ x: 50, y: 92, indexLabel: "\u2605 Highest" },
			{ x: 60, y: 68 },
			{ x: 70, y: 38 },
			{ x: 80, y: 71 },
			{ x: 90, y: 54 },
			{ x: 100, y: 60 },
			{ x: 110, y: 36 },
			{ x: 120, y: 49 },
			{ x: 130, y: 21, indexLabel: "\u2691 Lowest" }
		]
	}]
});
chart.render();

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


                       
                        <div class="card shadow mt-5 bg-dark">
                          <div class="card-body">
                            <h6 class="hf text-primary">Scores</h6>
                            <ul class="list-group list-group-flush">
                              <li class="list-group-item">An item</li>
                              <li class="list-group-item">A second item</li>
                              <li class="list-group-item">A third item</li>
                              <li class="list-group-item">A fourth item</li>
                              <li class="list-group-item">And a fifth one</li>
                            </ul>
  

                          </div>
                        </div>
                        
                      </div>
                    </div>

                
            </div>

@endsection