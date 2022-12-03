@extends('layouts.event_layout')
@section('content')
  
<div class="container">
    <h6 class="af mb-3" style="font-weight:bold;font-size:18px">PARTICIPANTS</h6>
     <div class="card shadow-sm bg-transparent">
        <div class="card-body">
           <div class="container">
            @if($available_slots>=1)
              <button class="btn btn-dark btn-sm px-4 mb-3" onclick="window.location.href='{{route('e.add_Participants')}}' ">Add</button>  
            @endif

            
              <button class="btn btn-dark btn-sm px-4 mb-3" onclick="window.location.href='{{route('e.blacklist')}}' ">BLACKLIST</button>  

              @if($count>=1)
              <button onclick="window.location.href='{{route('e.dashboard')}}' " class="btn btn-light text-primary btn-sm px-4 mb-3">New <span class="badge badge-danger bg-danger">{{$count}}</span> </button>   
              @endif

              <br>
              <nav style="--bs-breadcrumb-divider: url(&#34;data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' width='8' height='8'%3E%3Cpath d='M2.5 0L1 1.5 3.5 4 1 6.5 2.5 8l4-4-4-4z' fill='%236c757d'/%3E%3C/svg%3E&#34;);" aria-label="breadcrumb">
               <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="{{route('e.participants')}}">All</a></li>
     {{--    <li class="breadcrumb-item"><a href="{{route('e.sortby',['id'=> 0,'name' =>"INDEPENDENT"])}}">INDEPENDENT</a></li> --}}
                  @foreach ($allteam as $item)
                  <li class="breadcrumb-item"><a href="{{route('e.sortby',['id'=> $item->id,'name' => $item->name])}}">{{$item->name}}</a></li>
                  @endforeach
                
                
               </ol>
             </nav>

              @if (Session::get('Success'))
              <div class="alert alert-success alert-dismissable">
                  <strong class="hf">{{ Session::get('Success') }}</strong>
                  <button type="button" style="float:right" class="btn-close" data-bs-dismiss="alert"
                      aria-label="Close"></button>
              </div>
          @endif
          
              <div class="table-responsive">
              <table class="table table-striped table-sm table-hover table-secondary" id="myTable" style="font-size:14px">
                 <thead>
                   
                    <tr class="table-dark ">
                       <th></th>
                       <th>Email</th>
                       <th>Name</th>
                       <th>Address & Contact#</th>  
                       <th>College</th> 
                       <th>Team</th>
                       <th>Status</th> 
                       <th>Action</th>
                    </tr>
                 </thead>
                 <tbody>
                   
             {{--    
                    @foreach ($user as $users)
                       @if($users->id == $row->user_id)
                          @if($row->isverified == 1) --}}

                          @foreach ($user as $users)

                         

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
                              @foreach ($college as $item)
                                  @if($item->id == $users->CollegeId)
                              {{$item->name}}
                                  @endif
                              @endforeach
                           
                             </td>
                             <td>
                           

                              
                              @foreach ($participants as $key  => $row)
                               
 
                              @foreach ($sportevent as $sp )
                              @if($sp->id == $row->sports_id && $users->id == $row->user_id)
                             
                              @foreach ($team as $item)
                              @if($item->id == $row->team)
                              <span class="text-danger">
                                 {{$item->name}}
                              </span>
                               @endif
                              @endforeach


                              @endif
                              @endforeach
                              @endforeach
                             </td>
                               
                             <td>
                                <div class="btn-group">
                              
  
                              <span class="badge bg-success">VERIFIED</span>
                             
                    
                                </div>
                             </td>
                             <td>
                               
                                    @foreach ($participants as $key  => $row)
                               
 
                                 @foreach ($sportevent as $sp )
                                 @if($sp->id == $row->sports_id && $users->id == $row->user_id)
 
                                 @if($row->isverified == 0)
                                       <a href="New/Participants">For Verification</a>
                                
                                 @else
                            
                                       <button class="delete btn btn-light text-danger btn-sm" style="font-size:12px;font-weight:normal" data-id="{{$row->id}}"><i class="fas fa-trash-can"></i></button>
                                  
                                
                                 @endif
                          
                                 @endif
                               @endforeach
 
                                 @endforeach
                                 
                                 
                             </td>
                          </tr>
                          @endforeach
                          

                   {{--   
--}}
                
                
               {{--   @if($row->user_id == $user[$key]['id'])
                    <tr>
                       <td></td>
                       <td>{{$user[$key]['email']}}</td>
                       <td>{{$user[$key]['name']}}</td>
                       <td>
                        <span class="text-secondary">{{$user[$key]['address']}}</span><br>
                        #
                        <span style="font-size:14px" class="text-secondary">{{$user[$key]['contactno']}}</span>
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
                          @if($row->isverified == 0)
                          <button class="btn btn-primary btn-sm" style="font-size:12px;">Verify</button>
                          @else 
                          <button class="btn btn-success btn-sm" style="font-size:12px;" disabled>Verified</button>
                          @endif
                         
                             <button class="btn btn-light text-danger btn-sm" style="font-size:12px"><i class="fas fa-trash"></i></button>
                            
                          </div>
                       </td>
                    </tr> 
                 @endif
                  
                     
                 @endforeach  --}}
            
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
    window.location.href='delete_participants/'+id;
  } else {
   
  }
});
  })
</script>
@endsection