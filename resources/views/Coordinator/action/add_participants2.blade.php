@extends('layouts.coordinator_layout')
@section('content')


<div class="container">
    <a href="{{route('coordinator.add_participants')}}" class="btn btn-dark btn-sm px-4 mb-2" >Back</a>
    <div class="card shadow">
        <div class="card-body">
           <div class="container">
          
            <h6 class="hf " style="font-size:13px">Select Participants for ( <span style="font-size:15px" class="text-danger">{{$ename}}</span> )</h6>
            
            <br>
            <h6 class="hf">Available Slots : <span class="text-primary">{{$available_slots}}</span> 
            <br>
            Selected Participants : <span class="text-danger" id="selectedp"></span>
            </h6>
            <div class="container">
                        <form action="{{ route('coordinator.addParticipants') }}" method="post">
                                    @csrf     
             
                    <div class="table-responsive">
            
            
                        <table class="table table-striped af" id="myTable1" style="font-size:14px">
                            <thead>
                                <tr>
                                    <th scope="col">
                                      
                                    </th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Email</th>
                                    <th scope="col">Contact#</th>
                                    <th scope="col">College</th>
            
                                </tr>
                            </thead>
                            <tbody>
                                 
                                  
                                @foreach ($data as $row)
                                    @if ($row->user_type == 'student')
                                        <tr id="{{ $row->id }}" class="tbl {{ $row->id }}" >
                                            <td
                                                class="clean 
                                                     @if (Session::get('Error')) table-danger @endif
                                                     ">
                                                <div class="form-check">
                                                    <input class="check form-check-input" type="checkbox"
                                                        value="{{ $row->id }}" name="selected_ids[]"
                                                        id="selection{{ $row->id }}" data-id="{{ $row->id }}">
                                                    <label class="form-check-label"
                                                        for="selection{{ $row->id }}">
            
                                                    </label>
                                                    <input type="hidden" name="sportsevent"  value="{{$sportevent}}">
                                                </div>
                                            </td>
                                            <td>{{ $row->name }}</td>
                                            <td>{{ $row->email }}</td>
                                            <td>{{ $row->contactno }}</td>
                                            <td>
                                                @foreach ($college as $col)
                                                    @if ($col->id == $row->CollegeId)
                                                        {{ $col->name }}
                                                    @endif
                                                @endforeach
                                            </td>
            
                                        </tr>
                                      
                                    @endif
                                @endforeach
                              
                          
            
                            </tbody>
                        </table>
                    </div>
                    <button type="submit" id="btnadd" disabled class="btn btn-dark btn-sm px-5">Add</button>
                  
                        </form>
                    <br>
                    @if (Session::get('Error'))
                        <span class="af text-danger" id="errortext" style="font-size:13px">{{Session::get('Error')}}</span>
                    @endif
                
            </div>
            </div>
            
           </div>
        </div>
    </div>
         
<script>
    var def = $('input[name="selected_ids[]"]:checked').length;
   
    $('#selectedp').text(def);

            $('.check').change(function() {
                $('#btnadd').removeAttr('disabled',true);
                $('.clean').removeClass('table-danger');
                $('#errortext').html('');
                var id = $(this).data('id');
                $('#'+id).removeClass('table-danger');
             var len =  $('input[name="selected_ids[]"]:checked').length;
             $('#selectedp').text(len);
                if(len > {{$available_slots}} )
                {
                    $(this).prop('checked',false);
                    $('#'+id).addClass('table-danger');
                    $('#selectedp').text(len-1);
                    $('#btnadd').removeAttr('disabled',true);
                }else if( len < {{$available_slots}} ) {
                
                    $('#btnadd').removeAttr('disabled',true);
                }

                if(len == 0){
                    $('#btnadd').attr('disabled',true);
                }

              
            })
        </script>
@endsection