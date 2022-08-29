@extends('layouts.event_layout')
@section('content')
  <div class="container">
    <h5 class="hf" style="font-weight: bolder">Dashboard</h5>

    <h1 class="hf text-danger">
    {{--   @foreach ($myevent as $myE)
      {{$myE->name}}
  @endforeach    --}}
    </h1>
    <div class="row">
      <div class="col-md-9">
        <div class="row">
          <div class="col-md-4 mt-4">
            <div class="card shadow-sm " style="background-color: rgba(117, 7, 7, 0.877)">
              <div class="card-body">
                <h5 class="hf text-light">Participants</h5>
                <h6 class="af text-light" style="font-size:14px;" >
               <span class="badge bg-light text-dark" style="font-size:17px">{{count($allparticipants)}}</span>  Accounts
                </h6>
                <i  class="dashboardbanner fas fa-users-gear"></i>
              </div>
            </div>
          </div>
          <div class="col-md-4 mt-4">
            <div class="card shadow-sm " style="background-color: rgba(7, 36, 117, 0.877)">
              <div class="card-body">
                <h5 class="hf text-light">TEAMS</h5>
                <h6 class="af text-light" style="font-size:14px;" >
               <span class="badge bg-light text-dark" style="font-size:17px">{{count($team)}}</span>  Accounts
                </h6>
                <i  class="dashboardbanner fas fa-users"></i>
              </div>
            </div>
          </div>
          <div class="col-md-4 mt-4">
            <div class="card shadow-sm " style="background-color: rgba(168, 146, 18, 0.877)">
              @foreach ($myevent as $myE)
              <div class="card-body">
                <h5 class="hf text-light"> 
                  {{$myE->name}}
           </h5>
                <h6 class="af text-light" style="font-size:14px;" >
               <span class="badge bg-light text-dark" style="font-size:17px;z-index:9">{{-- {{count($coordinator)}} --}}</span>EventID : {{$myE->id}}
                </h6>
            
              </div>
              @endforeach 
            </div>
          </div>
        </div>
      
    
    
        <div class="row mt-3">
         
    
          <div class="col-md-12">
            <div class="card shadow">
              <div class="card-header">
                <h6 class="text-primary hf" style="">
                  New Participants
                </h6>
              </div>
              <div class="card-body">
                
              
                {{--   <h6 class="af mb-3" style="font-weight:bold;font-size:18px"> PARTICIPANTS</h6> --}}
              
                     
                         
          
                     
                            @if (Session::get('Success'))
                            <div class="alert alert-success alert-dismissable">
                                <strong class="hf">{{ Session::get('Success') }}</strong>
                                <button type="button" style="float:right" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif
                          
                            <div class="table-responsive">
                            <table class="table table-striped table-sm table-hover" id="myTable" style="font-size:14px">
                               <thead>
                                 
                                  <tr class="table-dark ">
                                     <th></th>
                                     <th>Email</th>
                                     <th>Name</th>
                                     <th>Info</th>  
                                     <th>Date</th> 
                                     <th>Action</th>
                                  </tr>
                               </thead>
                               <tbody>
                                 
                             @foreach ($participants as $key  => $row)
                            
                                  @foreach ($user as $users)
                                     @if($users->id == $row->user_id)
                                        
          
                                  <tr>
                                     <td></td>
                                     <td>{{$users->email}}</td>
                                     <td>{{$users->name}}</td>
                                     <td>
                                      <span class="text-secondary">{{$users->address}}</span><br>
                                      #
                                      <span style="font-size:14px" class="text-secondary">{{$users->contactno}}</span>

                                      <br>
                                      @foreach ($college as $item)
                                          @if($item->id == $users->CollegeId)
                                      <span class="text-primary">{{$item->name}}</span>  
                                          @endif
                                      @endforeach
                                     </td>
                                     <td>
          {{date('@h:i a F j, Y',strtotime($row->date_added))}}
                                     </td>    
                                     <td>
                                        <div class="btn-group">

                                       
                                          @if($available_slots >=1)
                                          @if($row->isverified == 0)
                                         <span class="badge bg-danger">Pending..</span>
                                      
                                         
                                          @elseif($row->isverified == 1)

                                       

                                             <button id="btn{{$row->id}}" class="verify btn btn-primary btn-sm" style="font-size:12px;" data-bs-toggle="modal" data-bs-target="#verify{{$row->id}}">Verify</button>

                                        <button class="delete btn btn-light text-danger btn-sm" style="font-size:12px" data-id="{{$row->id}}"><i class="fas fa-trash"></i></button>
                                        

                                        @endif
                                         
                                      

                                        @else 
                                        <span class="badge bg-danger">FULL SLOT</span>

                                        <button class="delete btn btn-light text-danger btn-sm" style="font-size:12px" data-id="{{$row->id}}"><i class="fas fa-trash"></i></button>
                                          
                                          @endif
                                     
          
                    
                    <!-- Modal -->
                    <div class="modal fade themodal" id="verify{{$row->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                      <div class="modal-dialog modal-lg">
                        <div class="modal-content">
                          
                          <div class="modal-body">
                                  <button type="button" style="float: right" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                         <div class="row">
                                  <div class="col-md-6">
                                     <h6 style="font-size:12px" class="hf">Student</h6>
                                     <div class="container mt-5">
                                        <h6 class="af">
                                          <span class="hf">{{$users->name}}</span> 
                                           <br>
                                           <span style="font-size: 13px">{{$users->email}}</span>
                                           <br><br>
                                           <span style="font-size:12px" class="hf text-danger">Address</span> 
                                           <br>
                                           <span style="font-size:14px">
                                              {{$users->address}}
                                           </span>
                                           <br>
                                           <span style="font-size:12px" class="hf text-danger">Contact#</span> 
                                           <br>
                                           <span style="font-size:14px">
                                              {{$users->contactno}}
                                           </span>
                                           <br>
                                           <span style="font-size:12px" class="hf text-danger">College</span> 
                                           <br>
                                           <span style="font-size:14px">
                                              @foreach ($college as $coll)
                                                  @if($users->CollegeId == $coll->id)
                                                  {{$coll->name}}
                                                  @endif
                                              @endforeach
                                            
                                           </span>
                                           <br><br>
                                           <span style="font-size:12px" class="hf text-danger">Submitted Requirements</span> 
                                           <br>
                                           <span style="font-size:14px">
                                         @if($row->submitted_req)  
                                        @foreach (explode(',',$row->submitted_req) as $item)
                                        
                                        <a href="{{asset('assets/img').'/'.$item}}" target="blank_" style="font-size:13px;text-decoration:none">{{$item}} <i class="fas fa-download"></i></a> <br>
                                        @endforeach
                                        @else
                                       <span style="font-size:12px" class="hf">There was no submitted Requirements</span> 
                                        @endif
                                           </span>
                                        </h6>
          
                                     </div>
                                  </div>
                                  <div class="col-md-6">
                                     <h6 style="font-size:12px" class="hf">Sports/Event</h6>
                                              @foreach ($sportevent as $spd )
                                              @if($spd->id == $row->sports_id)
                                              <div class="container" >
                                                          <h5 style="text-align:center" class="hf" id="eventname">{{$spd->name}}</h5>
                                                          
                                                       
                                           
                                                          <div class="row">
                                                           
                                                             <h6 style="font-size:13px" class="hf">Sports/Events Date and Time</h6>
                                                             <div class="col-md-12">
                                                                
                                                                <h6 style="font-size:13px" class="hf">Dates <br> <span class="text-danger" id="datestart"> </span> <i class="fas fa-arrow-right"></i> <span class="text-danger" id="dateend"> </span> 
                                                             
                                                                   <br><br>
                                                                   Maximun number of participants allowed:
                                                                   <span id="nop" class="text-primary">{{$spd->nop}}</span>
                                                                   <br>
                                                                   Number of Rounds:
                                                                    <span id="nor" class="text-primary">{{$spd->nor}}</span>
                                                                </h6>
                                                             </div>
                                                             <div class="col-md-12">
                                                                <h6 style="font-size:13px" class="hf">Time <br> <span class="text-danger" id="timestart"></span> <i class="fas fa-arrow-right"></i> <span id="timeend" class="text-danger"> </span> 
                                                             
                                                                 
                                                                </h6>
                                                             </div>
                                                           
                                                          </div>
                                           
                                                          <br>
                                                          <div class="row">
                                                             <div class="col-md-12">
                                                                <h6 style="font-size:13px" class="hf text-danger" >Description</h6>
                                                                <h6 class=" mb-3" style="font-size:13px;font-weight:normal" id="description">{{$spd->description}}</h6>
                                                             </div>
                                                             <div class="col-md-12">
                                                                <h6 style="font-size:13px" class="hf text-danger">Rules & Regulation</h6>
                                                                <h6 class=" mb-3" style="font-size:13px;font-weight:normal" id="rules">{{$spd->rules_regulation}}</h6>
                                                             </div>
                                                          </div>
                                                       
                                           
                                                        
                                           
                                                          <h6 style="font-size:13px" class="hf text-danger">Requirements</h6>
                                                          <h6 class=" mb-3" style="font-size:13px;font-weight:normal" id="requirements">{{$spd->requirements}}</h6>
                                           
                                           
                                           
                                                        
                                                        
                                                      </div>
                                              @endif
                                            @endforeach
                                           
                                  </div>
                         </div>
          
          
                          </div>
                          <div class="modal-footer">
                          
                            <button onclick="window.location.href='{{route('e.verify',$row->id)}}'" type="button" class="btn btn-primary btn-sm hf px-3 " id="btnverify" >Verify</button>
                          </div>
                        </div>
                      </div>
                    </div>
          
                                       
                                      
                                          
                                        </div>
                                     </td>
                                  </tr> 
          
                                 
                                  @endif
                                
                                  @endforeach       
                               @endforeach 
                          
                               </tbody>
                              </table>
                            </div>
                      
                     
                 
                    
          
                  
             

    
    
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
    
    
       
       {{--  <div class="card shadow mt-5 bg-dark">
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
  <script>
    $('.delete').click(function(){
  var id = $(this).data('id');

  swal({
title: "Are you sure?",
text: "you wont be able to recover it.",
icon: "warning",
buttons: true,
dangerMode: true,
})
.then((willDelete) => {
if (willDelete) {
$(this).html('<span style="font-size:11px" class="text-danger">Deleting..</span>');
window.location.href='delete_participants/'+id;
} else {

}
});
})
$('#btnverify').click(function(){
  $(this).removeClass('btn btn-primary').html('<span style="font-size:12px">Verfying...</span>');

})
</script>
@endsection