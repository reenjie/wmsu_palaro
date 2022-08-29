@extends('layouts.coordinator_layout')
@section('content')
         
<div class="container">
            <h5 class="af">Students</h5>
          {{--   {{ Auth::user()->name }}
            {{ Auth::user()->email }}
            {{ Auth::user()->password }}
            {{ Auth::user()->id }} --}}

          
<div class="card shadow-sm mt-3">
<div class="card-body">
@if (Session::get('Success'))
  <div class="alert alert-success alert-dismissable">
      <strong class="hf">{{ Session::get('Success') }}</strong>
      <button type="button" style="float:right" class="btn-close" data-bs-dismiss="alert"
          aria-label="Close"></button>
  </div>
@endif
            <div class="container">
                      {{--   <button class="btn btn-dark mb-3 px-4 btn-sm"  onclick="window.location.href='{{route('admin.add_student_route','student')}}' ">Add</button> --}}
                        <div class="table-responsive">
                       
                        <table class="table af table-sm" id="myTable">
                                    <thead>
                                      <tr class="table-dark">
                                        <th scope="col">Name</th>
                                        <th scope="col">Email</th>
                                        <th scope="col">Contact#</th>
                                      {{--   <th scope="col">College</th>
                                        <th scope="col">Action</th> --}}
                                      </tr>
                                    </thead>
                                    <tbody>
                      
                        @foreach ($data as $row )
                     
                           @if($row->user_type == 'student')
                           <tr>
                                    <td class="text-danger">{{$row->name}}</td>
                                    <td  class="text-primary">{{$row->email}}</td>
                                    <td>{{$row->contactno}}</td>
                                    {{-- <td>
                                    
                                      @foreach ($college as $col )
                                      @if($col->id == $row->CollegeId)
                                       {{$col->name}}
                                    
                                      @endif
                                   @endforeach
                                    </td> 
                                  <td>
                                       <div class=" btn-group">
                                    <button data-id="{{$row->id}}" class="update btn btn-light btn-sm text-success"><i class="fas fa-edit"></i></button>  
                                    <button  class="delete btn btn-light btn-sm text-danger" data-id="{{$row->id}}"><i class="fas fa-trash"></i></button>             
                                    </div>         
                                    </td> --}}
                            </tr>
                         
                           @endif
                   
                        @endforeach
                      
                               
                                    </tbody>
                                  </table>
                        </div>
            </div>
</div>
</div>
        
</div>


<script>
$('.update').click(function(){
var id = $(this).data('id');
window.location.href='update-account/'+id+'/Student';
})
$('.delete').click(function(){
var id = $(this).data('id');
          swal({
title: "Are you sure?",
text: "Once deleted, you will not be able to recover it",
icon: "warning",
buttons: true,
dangerMode: true,
})
.then((willDelete) => {
if (willDelete) {
window.location.href='deletecoordinator/'+id;
} else {

}
});
    })

</script>



@endsection