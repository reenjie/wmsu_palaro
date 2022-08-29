@extends('layouts.user_layout')
@section('content')
<div class="container">
  <h5 class="hf mb-3" style="font-weight: bold">Join Event</h5>

<div class="row">
 <div class="col-md-7">
            <div class="card shadow-sm">
             <div class="card-body">
         <h6 class="hf text-primary">Event's Joined</h6>
            @if(count($joinedevent)>=1)
                 @foreach ($joinedevent as $myevents)

                 @php
                 $src = '';
               if($myevents->file == ''){
                  $src = 'https://st2.depositphotos.com/4137693/11314/v/450/depositphotos_113146534-stock-illustration-no-photo-camera-vector-sign.jpg';
               }else {
                 $src =  asset('assets/img').'/'.$myevents->file;
               }

                 @endphp
                  <div class="card shadow mb-2">
                        <div class="card-body">
            <div class="row">
                        <div class="col-md-4">
                                    <h5 style="text-align: center;font-weight:bolder " class="hf text-danger">
                                                <img src="{{$src}}" alt="" class="rounded-circle" style="width:100px;height:100px">
                                                <br>
                                                {{$myevents->name}}</h5>
                        </div>
                        <div class="col-md-8">
                                    <h6 class="hf">
                                              Date: 
                                              <br>
                                                @if($myevents->datestart == '' || $myevents->datestart=='NULL')
                                                <span class="text-danger" style="font-size:12px">Not set</span>
                                                @else 
                                                {{date('F j,Y',strtotime($myevents->datestart))}}
                                                @endif
                                                <i class="fas fa-arrow-right"></i>
                                            
                                                @if($myevents->dateend == '' || $myevents->dateend=='NULL')
                                                <span class="text-danger" style="font-size:12px">Not set</span>
                                                @else 
                                                {{date('F j,Y',strtotime($myevents->dateend))}}
                                                @endif

                                                <br>
                                                Time :
                                                <br>
                                               
                                                @if($myevents->timestart == '' || $myevents->timestart=='NULL')
                                                <span class="text-danger" style="font-size:12px">Not set</span>
                                                @else 
                                                {{date('h:i a',strtotime($myevents->timestart))}}
                                                @endif
                                                <i class="fas fa-arrow-right"></i>
                                                @if($myevents->timeend == '' || $myevents->timeend=='NULL')
                                                <span class="text-danger" style="font-size:12px">Not set</span>
                                                @else 
                                                {{date('h:i a',strtotime($myevents->timeend))}}
                                                @endif

                                                <br>
                                                Description :
                                                <br>
                                               <span class="text-secondary af">{{$myevents->description}}</span> 

                                                
                                                <hr>
                                                Rules & Regulation :
                                                <br>
                                                <span class="text-secondary af"> {{$myevents->rules_regulation}}
                                                </span>
                                                <hr>
                                                Requirements
                                                <br>
                                                <span class="text-secondary af">{{$myevents->requirements}}
                                                </span>

                                                <br>
                                                Status:
                                                <br>
                                                @foreach ($isverified as $item)
                                                @if($item->sports_id == $myevents->id)
                                                @if($item->isverified == 0)
                                                <span class="badge bg-danger ">FOR VERIFICATION</span>
                                               
                                                <button data-sportsid="{{$myevents->id}}" class="delete btn btn-light  btn-sm text-danger">Cancel</button>

                                                @elseif($item->isverified == 1)
                                                <span class="badge bg-secondary ">
                                                  Waiting for the Event Coordinator to Verify
                                                </span>

                                                @elseif($item->isverified == 2)
                                                <span class="badge bg-success ">VERIFIED</span>
                                                @endif


                                                @endif
                                                @endforeach
                                             
                                    </h6>
                                   
                        </div>
            </div>

                        </div>
                  </div>
                 @endforeach
            @else 
            <h6 style="text-align: center" class="hf">
                        <img src="https://image.freepik.com/free-vector/no-data-concept-illustration_114360-626.jpg" alt="" style="width: 500px">
                        <br>
                        No Event Found
                     </h6>
            @endif

        {{--     
         --}}

               </div>
            </div>
 </div>
 <div class="col-md-5">
 <div class="card shadow">
  <div class="card-body">
       <h6 class="hf text-primary">Sport Events</h6>     
            @if(count($event)>=1)
       <ul class="list-group list-group-flush">
            @foreach ($event as $row)
   
                        <li class="list-group-item"><span class="text-danger hf" style="text-transform: uppercase;font-size:25px;font-weight:bolder">{{$row->name}}</span> <span style="float: right">
                                    <button onclick="window.location.href='{{route('user.join_event',['id'=>$row->id,'name'=>$row->name])}}' " class="hf btn btn-dark btn-sm  px-4">JOIN</button>
                                   </span></li>
            @endforeach
          
          
          </ul>
          @else
        <h6 style="text-align: center">
            <img src="https://th.bing.com/th/id/R.21b5631dc64f42d69f85fea9c53a2db9?rik=XIUntjuST8rkDg&riu=http%3a%2f%2fautoglos.com%2fpublic%2ffrontend%2fimages%2fno-record.png&ehk=4QyHprA%2fVbkSRu0VwmNQLKKdrcu4k76VrbxAVMfzu80%3d&risl=&pid=ImgRaw&r=0" alt="">
        </h6>
          @endif
</div>          
</div> 

@if(count($blacklist)>=1)
<div class="card shadow mt-3">
            <div class="card-body">
                 <h6 class="hf text-primary ">Ban Events</h6>     
          
                 <ul class="list-group list-group-flush">
                      @foreach ($blacklist as $row)
             
                                  <li class="list-group-item"><span class="text-danger hf" style="text-transform: uppercase;font-size:25px;font-weight:bolder">{{$row->name}}</span> <span style="float: right"> <span style="font-size:13px" class="text-secondary hf">BANNED <i class="fas fa-ban"></i></span>
                                             </span></li>
                      @endforeach
                    
                    
                    </ul>
                    <hr>
                    <h6 class="hf">
                        NOTE: <br>
                        <span class="af" style="font-size:14px">
                        You are not allowed to join the Events listed Above.
                        <br>
                        Kindly Contact your Sports/Event Coordinator for more info.
                        </span>
                    </h6>
          </div>          
          </div>
          @endif
</div>

</div>

</div>

<script>
  $('.delete').click(function(){
var id = $(this).data('sportsid');

swal({
title: "Are you sure?",
text: "you cannot undo actions.",
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
</script>
    
@endsection