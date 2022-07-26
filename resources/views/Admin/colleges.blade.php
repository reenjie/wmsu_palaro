@extends('layouts.admin_layout')
@section('content')

            <div class="container">
                        <h5 class="af">Colleges</h5>
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
                                    <button class="btn btn-dark mb-3 px-4 btn-sm"  onclick="window.location.href='{{route('admin.addcollege')}}' ">Add</button>
                                    <div class="table-responsive">
                                   
                                    <table class="table af" id="myTable">
                                                <thead>
                                                  <tr>
                                                    <th scope="col">College</th>
                                                    <th scope="col">Coordinator</th>
                                                  
                                                    <th scope="col">Action</th>
                                                  </tr>
                                                </thead>
                                                <tbody>
                                  
                                    @foreach ($wcoordinator as $row )
                                               
                                                      
                                                
                                 
                                       <tr>
                                                <td>{{$row->name}}</td>
                                                <td>
                                                  <a href="">
                                                    {{$row->email}}
                                                  </a>
                                                
                                                </td>
                                               
                                                <td>
                                                   <div class=" btn-group">
                                                <button data-id="{{$row->id}}" class="update btn btn-light btn-sm text-success"><i class="fas fa-edit"></i></button>  
                                                <button  class="delete btn btn-light btn-sm text-danger" data-id="{{$row->id}}"><i class="fas fa-trash"></i></button>             
                                                </div>         
                                                </td>
                                        </tr>
                                     
                                        
                               
                                    @endforeach
                                    @foreach ($nocoordinator as  $row)
                                  
                                    <tr>
                                      <td>{{$row->name}}</td>
                                      <td>
                                    
                                       <span  class= "badge bg-danger">No Coordinator</span>
                                      
                                      </td>
                                     
                                      <td>
                                         <div class=" btn-group">
                                      <button data-id="{{$row->id}}" class="update btn btn-light btn-sm text-success"><i class="fas fa-edit"></i></button>  
                                      <button  class="delete btn btn-light btn-sm text-danger" data-id="{{$row->id}}"><i class="fas fa-trash"></i></button>             
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
      $('.update').click(function(){
        var id = $(this).data('id');
        window.location.href='update-college/'+id+'/Colleges';
      })
     $('.delete').click(function(){
      var id = $(this).data('id');
                      swal({
      title: "Are you sure?",
      text: "Coordinators Record will be deleted aswell. Do you still want to proceed?",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
         window.location.href='deletecollage/'+id;
      } else {
       
      }
    });
                })
          
            </script>
      
        

@endsection