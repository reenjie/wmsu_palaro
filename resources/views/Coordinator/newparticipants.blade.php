@extends('layouts.coordinator_layout')
@section('content')

   <div class="container">
        <h6 class="af mb-3" style="font-weight:bold;font-size:18px"> PARTICIPANTS</h6>
         <div class="card shadow-sm bg-transparent">
            <div class="card-body">
               <div class="container">
                  <button class="btn btn-dark btn-sm px-4 mb-3" onclick="window.location.href='{{route('coordinator.add_participants')}}' ">Add</button>   

                  <button class="btn btn-light text-primary btn-sm px-4 mb-3" onclick="window.location.href='{{route('coordinator.participants')}}' ">Back</button>   
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
                           <th>Address & Contact#</th>  
                           <th>Sport_Event</th> 
                           <th>Action</th>
                        </tr>
                     </thead>
                     <tbody>
                       
                     @foreach ($participants as $key  => $row)
                        @foreach ($user as $users)
                           @if($users->id == $row->user_id)
                              @if($row->isverified == 0)

                        <tr>
                           <td></td>
                           <td>{{$users->email}}</td>
                           <td>{{$users->name}}</td>
                           <td>
                            <span class="text-secondary">{{$users->address}}</span><br>
                            #
                            <span style="font-size:14px" class="text-secondary">{{$users->contactno}}</span>
                           </td>
                           <td>

                            @foreach ($sportevent as $sp )
                              @if($sp->id == $row->sports_id)
                              {{$sp->name}}
                              @endif
                            @endforeach
                         
                           </td>    
                           <td>
                              <div class="btn-group">
                            

                              <button id="btn{{$row->id}}" class="verify btn btn-primary btn-sm" style="font-size:12px;" data-bs-toggle="modal" data-bs-target="#verify{{$row->id}}">Verify</button>


          
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
                              <span style="font-size:12px" class="hf">   * {{$item}} <br> </span>
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
                
                  <button onclick="window.location.href='{{route('coordinator.verify',$row->id)}}'" type="button" class="btn btn-primary btn-sm hf px-3 " id="btnverify" >Verify</button>
                </div>
              </div>
            </div>
          </div>

                             
                                 <button class="delete btn btn-light text-danger btn-sm" style="font-size:12px" data-id="{{$row->id}}"><i class="fas fa-trash"></i></button>
                                
                              </div>
                           </td>
                        </tr> 

                        @endif
                        @endif
                      
                        @endforeach       
                     @endforeach
                
                     </tbody>
                    </table>
                  </div>
               </div>
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
        window.location.href='../delete_participants/'+id;
      } else {
       
      }
    });
      })
      $('#btnverify').click(function(){
         $(this).removeClass('btn btn-primary').html('<span style="font-size:12px">Verfying...</span>');
       
      })
   </script>
@endsection