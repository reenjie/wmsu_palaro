@extends('layouts.admin_layout')
@section('content')

   <div class="container">
        <h6 class="af mb-3" style="font-weight:bold;font-size:18px">SPORTS/EVENTS</h6>
         <div class="card shadow-sm bg-transparent">
            <div class="card-body">
               <div class="container">
                  <button class="btn btn-dark btn-sm px-4 mb-3" onclick="window.location.href='{{route('admin.add_sports_events')}}' ">Add</button>   
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
                       
                        <tr class="table-dark " >
                           <th></th>
                           <th>Sports/Event</th>
                           <th>Details</th>
                           <th>Start</th>
                           <th>End</th>
                           <th>Action</th>
                        </tr>
                     </thead>
                     <tbody>
                        @foreach ($sportsdata as $row)
                          @php
                          $src = '';
                        if($row->file == ''){
                           $src = 'https://st2.depositphotos.com/4137693/11314/v/450/depositphotos_113146534-stock-illustration-no-photo-camera-vector-sign.jpg';
                        }else {
                          $src =  asset('assets/img').'/'.$row->file;
                        }

                          @endphp
                        <tr>
                           <td>
                              <img src="{{$src}}" alt="" class="rounded-circle" style="width:100px;height:100px">
                           </td>
                           <td style="font-weight: bold">{{$row->name}}</td>
                           <td>
                              <button class="view btn btn-light text-info btn-sm" style="font-size:12px" data-bs-toggle="modal" data-bs-target="#exampleModal" 
                              data-name="{{$row->name}}"
                              data-datestart="{{date('F j,Y',strtotime($row->datestart))}}"
                              data-dateend="{{date('F j,Y',strtotime($row->dateend))}}"
                              data-vdatestart ="{{$row->datestart}}"
                              data-vdateend ="{{$row->dateend}}"

                              data-timestart="{{date('h:i a',strtotime($row->timestart))}}"
                              data-timeend="{{date('h:i a',strtotime($row->timeend))}}"
                              data-vtimestart ="{{$row->timestart}}"
                              data-vtimeend ="{{$row->timeend}}"
                              data-description = "{{$row->description}}"
                              data-rules = "{{$row->rules_regulation}}"
                              data-requirements = "{{$row->requirements}}"
                              data-file = "{{$row->file}}"
                              data-nop = "{{$row->nop}}"
                              data-nor = "{{$row->nor}}"
                              ><i class="fas fa-eye"></i></button>
                           </td>
                           <td>
                              Date : 
                                 @if($row->datestart == '' || $row->datestart=='NULL')
                                 <span class="text-danger" style="font-size:12px">Not set</span>
                                 @else 
                                 {{date('F j,Y',strtotime($row->datestart))}}
                                 @endif
                            
                              <br>
                              Time: 
                              @if($row->timestart == '' || $row->timestart=='NULL')
                              <span class="text-danger" style="font-size:12px">Not set</span>
                              @else 
                              {{date('h:i a',strtotime($row->timestart))}}
                              @endif
                             
                           </td>
                           <td>
                              Date :
                              @if($row->dateend == '' || $row->dateend=='NULL')
                              <span class="text-danger" style="font-size:12px">Not set</span>
                              @else 
                              {{date('F j,Y',strtotime($row->dateend))}}
                              @endif
                              <br>
                              Time:
                              @if($row->timeend == '' || $row->timeend=='NULL')
                              <span class="text-danger" style="font-size:12px">Not set</span>
                              @else 
                              {{date('h:i a',strtotime($row->timeend))}}
                              @endif
                           </td>
                           <td>
                              <div class="btn-group">
                                 
                                 <button class="btn btn-light text-success btn-sm" style="font-size:12px"><i class="fas fa-pen" onclick="window.location.href='Edit/Sport-Events/{{$row->id}}/{{md5(Auth::user()->id)}}'"></i></button>
                                
                                 <button data-id="{{$row->id}}" class="delete btn btn-light text-danger btn-sm" style="font-size:12px"><i class="fas fa-trash"></i></button>
                                
                              </div>
                           </td>
                        </tr>
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
      text: "All data connected to this sports will be deleted as well. do you still want to proceed?",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
       $(this).html('<span style="font-size:11px" class="text-secondary">Deleting..</span>');
        window.location.href='delete_sports/'+id;
      } else {
       
      }
    });
      })
      $('.view').click(function(){
         var name = $(this).data('name');
         var dstart = $(this).data('datestart');
         var deend = $(this).data('dateend');
         var vdstart = $(this).data('vdatestart');
         var vdend = $(this).data('vdateend');
         var tstart = $(this).data('timestart');
         var teend = $(this).data('timeend');
         var vtstart = $(this).data('vtimestart');
         var vtend = $(this).data('vtimeend');
         var description = $(this).data('description');
         var rules = $(this).data('rules');
         var requirements=$(this).data('requirements');
         var file = $(this).data('file');
         var nop = $(this).data('nop');
         var nor = $(this).data('nor');

         if(file == ''){
 /* $('#img-view').attr('src','https://cdn.dribbble.com/users/244309/screenshots/14872040/01_4x.jpg'); */
         }else {
            $('#img-view').attr('src','{{asset("assets/img")}}'+'/'+file);
         }

         if(vdstart == '' || vtstart == ''){
            dstart = 'Not Set';
            tstart = 'Not Set';
         }
      
         if(vdend == '' || vtend == ''){
            
            deend = 'Not Set';
            teend = 'Not Set';
            
         }
      


         $('#eventname').text(name);
         $('#datestart').text(dstart);
         $('#dateend').text(deend);
         $('#timestart').text(tstart);
         $('#timeend').text(teend);
         $('#description').text(description);
         $('#rules').text(rules);
         $('#requirements').text(requirements);
         $('#nop').text(nop);
         $('#nor').text(nor);
      })
   </script>

 
 <!-- Modal -->
 <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
   <div class="modal-dialog modal-lg ">
     <div class="modal-content">
      
       <div class="modal-body">
         <button type="button" style="float: right" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
     
       {{--    --}}
           <div class="container" >
               <h5 style="text-align:center" class="hf" id="eventname">Sporty</h5>
               
            

               <div class="row">
                
                  <h6 style="font-size:13px" class="hf">Sports/Events Date and Time</h6>
                  <div class="col-md-4">
                     
                     <h6 style="font-size:13px" class="hf">Dates <br> <span class="text-danger" id="datestart"> </span> <i class="fas fa-arrow-right"></i> <span class="text-danger" id="dateend"> </span> 
                  
                        <br><br>
                        Maximun number of participants allowed:
                        <span id="nop" class="text-primary"></span>
                        <br>
                        Number of Rounds:
                         <span id="nor" class="text-primary"></span>
                     </h6>
                  </div>
                  <div class="col-md-4">
                     <h6 style="font-size:13px" class="hf">Time <br> <span class="text-danger" id="timestart"></span> <i class="fas fa-arrow-right"></i> <span id="timeend" class="text-danger"> </span> 
                  
                      
                     </h6>
                  </div>
                
               </div>

               <br>
               <div class="row">
                  <div class="col-md-6">
                     <h6 style="font-size:13px" class="hf">Description</h6>
                     <h6 class=" mb-3" style="font-size:13px;font-weight:normal" id="description"></h6>
                  </div>
                  <div class="col-md-6">
                     <h6 style="font-size:13px" class="hf">Rules & Regulation</h6>
                     <h6 class=" mb-3" style="font-size:13px;font-weight:normal" id="rules"></h6>
                  </div>
               </div>
            

             

               <h6 style="font-size:13px" class="hf">Requirements</h6>
               <h6 class=" mb-3" style="font-size:13px;font-weight:normal" id="requirements"></h6>



             
             
           </div>
            
             
   {{--         <img src="" id="img-view" alt="" style="width: 150px;position: absolute; top:20px;right:50px;border-radius:3px; " >
              
                  --}}
               
                       
             

                   
       </div>
      
     </div>
   </div>
 </div>
@endsection