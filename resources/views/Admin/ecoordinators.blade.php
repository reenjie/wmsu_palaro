@extends('layouts.admin_layout')
@section('content')


   <div class="container">
        <h6 class="af mb-3" style="font-weight:bold;font-size:18px">Event Coordinators</h6>
         <div class="card shadow-sm bg-transparent">
            <div class="card-body">
               <div class="container">

                  @if(count($events)>=1)
                  <button class="btn btn-dark btn-sm px-4 mb-3" onclick="window.location.href='{{route('admin.add_ecoordinator')}}' ">Add</button>  
                  @else 
                  <br><br>
                  @endif
                  
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
                           <th>Sport_Event</th> 
                           <th>Status</th>
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
                                  
                                     <ul class="list-group list-group-flush">
                                    @foreach ($sport as $item)
                                     
                                          @if($item->id == $users->sports_id)
                                          <li class="list-group-item"> <span class="text-danger hf">{{$item->name}} </span>{{--  <span style="float: right"><button class="btn btn-light btn-sm"><i class="fas fa-times text-danger"></i></button></span> --}}</li>
                                      
                                          @endif
                                     
                                       @endforeach 
                           
 



                                 </td>    
                                 <td>
                                    <div class="btn-group">
                                  
                                                <button class="btn btn-light text-success btn-sm" style="font-size:12px"><i class="fas fa-pen" onclick="window.location.href='{{route('admin.edit_coordinator',['id'=>$users->id ])}}'"></i></button>
                                
                                                <button data-id="{{$users->id}}" class="delete btn btn-light text-danger btn-sm" style="font-size:12px"><i class="fas fa-trash"></i></button>
                                
                                 
                        
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
      text: "you wont be able to recover it.",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
       $(this).html('<span style="font-size:11px" class="text-danger">Deleting..</span>');
        window.location.href='{{route("admin.deleteecoordinator",'')}}?id='+id;
      } else {
       
      }
    });
      })
   </script>
@endsection