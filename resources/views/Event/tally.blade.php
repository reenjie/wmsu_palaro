@extends('layouts.event_layout')
@section('content')
<div class="container">
    <h5 class="hf mb-3" style="font-weight:bold;">TALLY</h5>
    <div class="row">
        <div class="col-md-12">
            <button class="btn btn-dark btn-sm mb-2" data-bs-toggle="modal" data-bs-target="#exampleModal">Add Match</button>

            <!-- Modal -->
            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog modal-sm">
                    <div class="modal-content">
                        <div class="modal-header">

                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <form action="{{ route('e.savegame') }}" method="POST">
                            @csrf

                            <div class="modal-body">
                                <h6 class="hf">Enter Match Title</h6>
                                <input type="text" name="matchname" class="form-control" required>
                            </div>
                            <div class="modal-footer">

                                <button type="submit" class="btn btn-dark btn-sm">SAVE</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            @if(Session::get('Success'))
                <div class="alert alert-success alert-dismissable">
                    <strong class="hf">{{ Session::get('Success') }}</strong>
                    <button type="button" style="float:right" class="btn-close" data-bs-dismiss="alert"
                        aria-label="Close"></button>
                </div>
            @endif
            <div class=" shadow-sm mb-2  bg-dark">
                <div class="card-body">

                    @if(count($match)>=1)
                        <h1 class="hf text-danger" style="text-align: center">Versus</h1>
                        <ul class="list-group list-group-flush ">
                            @foreach($match as $row)

                            @php
                            $sportsid = Auth::user()->sports_id;
                                $check = DB::select('select * from tallies where match_id ='.$row->id.' and sports_id = '.$sportsid.' and team in (select team from participants where sports_id='.$sportsid.')  ');
                            @endphp
                                <li id="{{$row->id}}list" class="list-group-item shadow   mb-5 
                         @if($row->status == 0)
                         bg-dark
                            @elseif($row->status == 1)
                            bg-danger
                            @elseif($row->status==2)
                            bg-success
                            @else

                            @endif
                                
                                " style="border-bottom: 6px solid white">
                                    <span class="text-light hf"
                                        style="font-weight: bold;font-size:25px">{{ $row->name }}
                                        <div class="message"></div>
                                    </span>
                                    <br>
                                    <h6 class="text-light hf" style="">Match</h6>
                                    @if(count($check)>=1)
                                    <h6 class="text-light hf mt-3">Set Game Status</h6>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <select name="" data-id="{{$row->id}}" class="changestatus form-select mb-3 hf" id="">

                                                @if($row->status == 0)
                                                    <option value="0">Pending</option>
                                                @elseif($row->status == 1)
                                                    <option value="1">On Game</option>
                                                @elseif($row->status==2)
                                                    <option value="2">Match Ended</option>
                                                @else

                                                @endif
                                                <option value="0">Pending</option>
                                                <option value="1">On Game</option>
                                                <option value="2">Match Ended</option>
                                            </select>

                                            
                                        </div>
                                        <div class="col-md-6">

                                            @if($row->status == 1)
                                       
                                        @elseif($row->status==2)
                                        <button data-id="{{$row->id}}" class="deletematch btnhide btn btn-danger btn-sm ">DELETE THIS MATCH</button>

                                        @else 
                                        <button data-id="{{$row->id}}" class="deletematch btnhide btn btn-danger btn-sm ">DELETE THIS MATCH</button>

                                        <button data-id="{{$row->id}}" class="resetteamselection btn btn-secondary btnhide btn-sm ">RESET  SELECTION</button>
                                        @endif
                                              
                                        </div>
                                    </div>
                                    @endif

                                    <div class="row">
                                         @if(count($tally)>=1)  
                                        @foreach($tally as $pt)
                                            @if($pt->match_id == $row->id)
                                                <div class="col-md-6">
                                                    <div class="card shadow">
                                                        <div class="card-body">
                   
                                                        
                                                 
                                
                                    @foreach($team as $tm)
                               @if($tm->id == $pt->team)

                               @if($row->status == 2)
                               <select name="" data-team="{{$tm->id}}" class="ondeclare form-select mb-4 bg-dark text-light" id="" value="{{$tm->result}}"  style="text-align: center">
                                    @if($tm->result ==0)
                                    <option value="0"> -- Declare Tally --</option>
                                    @elseif ($tm->result ==1)
                                    <option value="1">1st Runner Up</option>
                                    @elseif ($tm->result ==2)
                                    <option value="2">2nd Runner Up</option>
                                    @elseif ($tm->result ==3)
                                    <option value="3">Champion</option>
                                    @endif
                                   
                                  <option value="3">Champion</option>
                                   <option value="1">1st Runner Up</option>
                                   <option value="2">2nd Runner Up</option>
                                   <option value="0">UnSet</option>
                                    </select>
                                               
                                @endif
                          <h6 class="text-danger hf"
                               style="font-weight: bold;font-size:20px;text-align:center">
                               {{ $tm->name }}</h6>
                          
                           @php
                           $sportsid = Auth::user()->sports_id;
                                  $users = DB::select('select * from users where id in (select user_id from participants where sports_id ='.$sportsid.' and team='.$pt->team.' )');
                           @endphp

            <h6 class="hf text-primary">Members:</h6>
            <ul class="list-group list-group-flush">
                
              
            @foreach ($users as $group)
            <li class="list-group-item">  <h6 class="hf text-secondary">
                        {{$group->name}}
                        <br>
                        <span style="font-size:14px">{{$group->email}}</span>

            </h6></li>
          
          @endforeach
          </ul>
                       
                                     @endif
                                     
                                                            @endforeach
                                              
                                                @foreach ($indi as $indiuser)
                                                    @if($indiuser->id == $pt->user_id)
                                     <h5 class="text-danger hf" style="font-weight:bold">{{$indiuser->name}}
                                    <br>
                                    <span style="font-size:12px" class="text-secondary">{{$indiuser->email}}</span>

                                    <br>
                                    <span class="text-primary hf" style="font-size:15px">INDEPENDENT</span>
                                    </h5>
                                                    @endif
                                                @endforeach
                                                @if($row->status == 1 || $row->status == 2)
                                                <h6 class="text-primary hf mt-3">Set Tally </h6>
                                                <input type="text" class="form-control mb-4" id="{{$pt->id}}" placeholder="Enter Scores, Tally" value="{{$pt->tally}}">
                                              <button class="btn hf btn-dark btn-sm btnofficial" data-val="1" data-id="{{$pt->id}}">Official</button>
                                              <button class="btn hf btn-dark btn-sm btnunofficial" data-id="{{$pt->id}}" data-val="0" >Unofficial</button>
                                                
                                                @endif
                   



                                                
                                                        </div>
                                                    </div>
                                                </div>

                                            @endif

                                        @endforeach
                                     
                                        @endif
                                             
                                    </div>

                            {{-- Checking If there are participants in every match --}}
                           

                                @if(count($check)>=1)
                                @else
                                <h1 class="text-light hf">No Teams or Individual Selected For this match Yet.</h1>
                                  
                                <button class="btn btn-primary btnset form-control" data-matchid="{{$row->id}}" >SET</button>
                                @endif
                                </li>
                            @endforeach
                                
                          
                           
                        </ul>


                    @else
                        <h6 style="text-align: center">
                            <img src="https://th.bing.com/th/id/OIP.y-HrFRfyRRQfvPq4opGxgwHaFm?pid=ImgDet&rs=1" alt="">
                            <br>
                           <span class="text-light">No Matches yet ..</span> 
                        </h6>
                    @endif

                </div>
            </div>
            <br><br>

        </div>
    </div>

</div>
<script>
    $('.btnset').click(function(){
        var matchid = $(this).data('matchid');
        window.location.href='{{route("e.setmatch")}}?matchid='+matchid;
    })
    $('.deletematch').click(function(){
        var id = $(this).data('id');

        swal({
  title: "Are you sure?",
  text: "this will also remove the team or individual participants, if you still want to proceed press ok.",
  icon: "warning",
  buttons: true,
  dangerMode: true,
})
.then((willDelete) => {
  if (willDelete) {
   $(this).html('<span style="font-size:17px" class="text-light">Deleting..</span>');
   window.location.href='{{route("e.forfeitmatch")}}?id='+id;
  } else {
   
  }
});
    })
    $('.resetteamselection').click(function(){
        var id = $(this).data('id');

swal({
title: "Are you sure?",
text: "this will  remove the team or individual participants, if you still want to proceed press ok.",
icon: "warning",
buttons: true,
dangerMode: true,
})
.then((willDelete) => {
if (willDelete) {
$(this).html('<span style="font-size:17px" class="text-light">Resetting..</span>');
window.location.href='{{route("e.resetmatch")}}?id='+id;
} else {

}
});
    })

    $('.changestatus').change(function(){
        var val = $(this).val();
        var id = $(this).data('id');
     
        if(val == 0){
           /*  $('#'+id+'list').addClass('bg-dark').removeClass('bg-danger').removeClass('bg-danger'); */
           $('.message').html('<span class="badge bg-success text-light">UPDATING STATUS ..</span>');
            
            $('.btnhide').removeClass('d-none');
            var e = setInterval(() => {
            location.reload();
                        clearInterval(e);
                    }, 2000);
                    
        }else if (val==1){
          
           /*  $('#'+id+'list').removeClass('bg-dark').removeClass('bg-danger').addClass('bg-danger'); */
            $('.btnhide').addClass('d-none');
            $('.message').html('<span class="badge bg-success text-light">UPDATING STATUS ..</span>');
            var e = setInterval(() => {
            location.reload();
                        clearInterval(e);
                    }, 2000);
        }else if (val == 2){
            $('.message').html('<span class="badge bg-success text-light">UPDATING STATUS ..</span>');
          /*   $('#'+id+'list').removeClass('bg-dark').removeClass('bg-danger').addClass('bg-success'); */
            var e = setInterval(() => {
            location.reload();
                        clearInterval(e);
                    }, 2000);
        }
        
        $.ajax({
                  url:"{{route('e.setstatus')}}",
                  method:"GET", 
                  data  : {id:id,val:val},
                  success :function(data){
                   
                  }

       }) 
    })

    $('.btnofficial').click(function(){
        var id = $(this).data('id');
        var val = $('#'+id).val();
        var offi = $(this).data('val');

       if(val == ''){
        $('#'+id).addClass('is-invalid');
       }else {
        $.ajax({
                  url:"{{route('e.settally')}}",
                  method:"GET", 
                  data  : {id:id,tally:val,offi:offi},
                  success :function(data){
                    $('#'+id).addClass('is-valid');
                    var e = setInterval(() => {
                        $('#'+id).removeClass('is-valid');   
                        clearInterval(e);
                    }, 1000);
                  }

       }) 
       }
    })
    $('.btnunofficial').click(function(){
        var id = $(this).data('id');
        var val = $('#'+id).val();
        var offi = $(this).data('val');
    if(val == ''){
        $('#'+id).addClass('is-invalid');
       }else {
        $.ajax({
                  url:"{{route('e.settally')}}",
                  method:"GET", 
                  data  : {id:id,tally:val,offi:offi},
                  success :function(data){
                    $('#'+id).addClass('is-valid');
                    var e = setInterval(() => {
                        $('#'+id).removeClass('is-valid');   
                        clearInterval(e);
                    }, 1000);
                  }

       }) 
       }
    })

    $('.ondeclare').change(function(){
        var id = $(this).data('team');

        var val = $(this).val();
       

        $.ajax({
                  url:"{{route('e.setresult')}}",
                  method:"GET", 
                  data  : {id:id,val:val},
                  success :function(data){
                   
                    swal("Result Set!", "You have Successfully set the Results", "success");
                  }

       }) 

       
    })
</script>
@endsection
