@extends('layouts.event_layout')
@section('content')
<div class="container">
            <h5 class="hf" style="font-weight: bolder">Manage Team</h5>

<button class="btn btn-dark btn-sm mb-4" data-bs-toggle="modal" data-bs-target="#exampleModal">Add Team</button>

@if (Session::get('Success'))
<div class="alert alert-success alert-dismissable">
    <strong class="hf">{{ Session::get('Success') }}</strong>
    <button type="button" style="float:right" class="btn-close" data-bs-dismiss="alert"
        aria-label="Close"></button>
</div>
@endif

@if (Session::get('error'))
<div class="alert alert-danger alert-dismissable">
    <strong class="hf">{{ Session::get('error') }}</strong>
    <button type="button" style="float:right" class="btn-close" data-bs-dismiss="alert"
        aria-label="Close"></button>
</div>
@endif

          
          <!-- Modal -->
          <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{route('e.savenewteam')}}" method="post">
                        @csrf
               
                <div class="modal-body">
            <h6 class="hf">Enter TEAM name :</h6>
            <input type="text" class="form-control mb-2" name="teamname" required>

            <h6 class="hf">Enter Maximum Participants :</h6>
            <input type="number" class="form-control" name="max" value="3" required>
                </div>
                <div class="modal-footer">
              
                  <button type="submit" class="btn btn-dark btn-sm">Save</button>
                </div>
            </form>
              </div>
            </div>
          </div>



          @foreach ($allteam as $row)

          <div class="card shadow mb-2">
            <div class="card-header">
         
              <button class="btn btn-light btn-sm text-success" style="float:right" data-bs-toggle="modal" data-bs-target="#editteam{{$row->id}}">Edit <i class="fas fa-edit"></i> </button>

            

              <div class="modal fade" id="editteam{{$row->id}}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                <div class="modal-dialog modal-sm">
                  <div class="modal-content">
                    <div class="modal-header">
                      <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <form action="{{route('e.updateteam')}}" method="post">
                            @csrf
                   
                    <div class="modal-body">
                <h6 class="hf">TEAM Name :</h6>
                <input type="text" value="{{$row->name}}" class="form-control mb-2" name="teamname" required>
                <input type="hidden" value="{{$row->id}}" name="id">

                <h6 class="hf">Enter Maximum Participants :</h6>
                <input type="number" class="form-control" name="max" value="{{$row->maxcount}}" required>
                    </div>
                    <div class="modal-footer">
                  
                      <button type="submit" class="btn btn-dark btn-sm">Update</button>
                    </div>
                </form>
                  </div>
                </div>
              </div>

           
    
                       
                        <h5 class="hf text-danger" style="font-weight:bold">{{$row->name}}</h5>

                      
            </div>
            <div class="card-body">
              <span style="font-size:13px;font-weight:bold">Maximum Number of Participants : {{$row->maxcount}}</span>
            <h6 class="hf">Members:</h6>
            <ul class="list-group list-group-flush">
                     
                        @foreach ($pt as $participants)
                        @if($participants->team == $row->id)
                      
                        @foreach ($user as $member)
                            @if($member->id == $participants->user_id)
                        
                            <li class="list-group-item"><span class="text-primary">{{$member->name}} <br><span class="text-secondary" style="font-size:12px">{{$member->email}}</span>
                            <br>
                            @if($participants->isverified == 0)

                            @else 

                            
                            <span class="badge badge-success bg-success">VERIFIED</span>
                            </span> 
                            @endif
                        <span style="float: right">
            <div class="dropdown">
            <button class="btn btn-dark btn-sm dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                                                Move To
                  </button>
             <ul class="dropdown-menu">
                        @foreach ($allteam as $item)
                            @if($item->id == $row->id)
                      
                            @else 
                            <li><a class="dropdown-item movethis text-danger" style="font-weight: bold" data-moveto="{{$item->id}}"  data-id ="{{$participants->id}}" href="javascript:void(0)">{{$item->name}}</a></li>
                            @endif
                        @endforeach
          
         
             </ul>
      </div>
                        </span>
                        </li>
                            @endif
                        @endforeach
                        @endif
                        
                    @endforeach    
                      </ul>
                  


            </div>
            <div class="card-footer">
                       
                      @foreach ($delete as $item)
                          @if($item->id == $row->id)
                          <span style="float: right">
                    <button class="btn btn-light text-danger btn-sm deleteteam" data-id="{{$row->id}}"><i class="fas fa-trash-can"></i></button>
                        </span>
                      
                          @endif
                      @endforeach
                       
            </div>
          </div>

              
          @endforeach

          <br><br><br>
</div>
<script>
            $('.movethis').click(function(){
            var moveto= $(this).data('moveto');
            var userid = $(this).data('user_id');
            var id = $(this).data('id');
            swal({
            title: "Are you sure?",
            text: "to move this participants to another team.",
            icon: "warning",
            buttons: true,
            dangerMode: false,
            })
            .then((willDelete) => {
            if (willDelete) {
            $(this).html('<span style="font-size:11px" class="text-danger">Deleting..</span>');
            window.location.href='{{route("e.move")}}?moveto='+moveto+'&id='+id;
            } else {
            
            }
            });


            })
            $('.deleteteam').click(function(){
            var id = $(this).data('id');  
            swal({
            title: "Are you sure?",
            text: "You wont be able to revert this",
            icon: "warning",
            buttons: true,
            dangerMode: true,
            })
            .then((willDelete) => {
            if (willDelete) {
                        
            $(this).html('<span style="font-size:11px" class="text-danger">Deleting..</span>');
            window.location.href='{{route("e.deleteteam")}}?id='+id;
            } else {
            
            }
            });
            
            })
</script>

@endsection