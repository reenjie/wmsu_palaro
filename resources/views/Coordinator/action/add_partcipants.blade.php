@extends('layouts.coordinator_layout')
@section('content')
    <div class="container">
            
        <h6 class="af mb-3" style="font-weight:bold;font-size:18px">ADD PARTICIPANTS</h6>

        <a href="{{route('coordinator.participants')}}" class="btn btn-dark btn-sm px-4 mb-2" >Back</a>
        <div class="card shadow-sm">
            <div class="card-body">
                        <form action="{{ route('coordinator.addParticipants') }}" method="post">
                                    @csrf
                <div class="row">
                    <div class="col-md-12">
                        <h6 class="hf " style="font-size:13px">Select Sports/Event   </h6>
                     
                        <div class="table-responsive">
                                    <table class="table table-striped table-sm table-hover" id="myTable" style="font-size:14px">
                                       <thead>
                                         
                                          <tr class="" >
                                             <th></th>
                                             <th>Sports/Event</th>    
                                             <th>Maximum number of Participants</th> 
                                             <th>Current No. of Participants</th>      
                                             <th>Start</th>
                                             <th>End</th>
                                             <th>Status</th>
                                           
                                          </tr>
                                       </thead>
                                       <tbody>
                                          @foreach ($sportsdata as $row)
                                            
                                          <tr id="{{$row->id}}" class="table-success">
                                             <td>{{-- <input type="radio" name="sportsevent" class="sportselect" value="{{$row->id}}" id="radio{{$row->id}}"> --}}
                                          
                                            <button type="submit" name="sportsevent" value="{{$row->id}}" class="btn btn-dark btn-sm" id="radio{{$row->id}}">Select</button>
                                            </td>
                                           
                                             <td style="font-weight: bold">{{$row->name}}
                                              
                                         
                                            </td>
                                            <td>
                                                <span class="text-dark">
                                                    {{$row->nop}}
                                                </span>
                                              </td>
                                              <td>
                                              @if(count($nop) >=1)
                                               @foreach ($nop as $key )
                                               @if($row->id == $key->sports_id)
                                              <span class="text-dark">{{$key->nop}}</span>  
                                            
                                              @if($row->nop <= $key->nop)
                                                <script>
                                                    $('#{{$row->id}}').addClass('table-danger');
                                                    $('#radio{{$row->id}}').addClass('d-none');
                                                </script>
                                              @endif

                                              @else 
                                              
                                               @endif
                                                
                                               @endforeach
                                               @else
                                           {{--     <span class="badge badge-danger bg-danger">No Participants</span> --}}
                                               @endif
                                              
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
                                                @if(count($nop) >=1)
                                                @foreach ($nop as $key )
                                                @if($row->id == $key->sports_id)
                                              
                                                 
                                               @if($row->nop <= $key->nop)
                                               <span class="badge badge-danger bg-danger">Full Slots</span>
                                               @else
                                               <span class="badge badge-danger bg-success">Available Slots( {{$row->nop - $key->nop}} )</span>

                                               @endif

                                               @else 
                                            
                                             
                                                @endif
                                                 
                                                @endforeach
                                           
                                                @else   <span class="badge badge-danger bg-success">Available Slots( {{$row->nop}} )</span>
                                                @endif
                                               
                                             </td>
                                       
                                          </tr>
                                          @endforeach
                                       </tbody>
                                      </table>
                                    </div>
                    </div>
                   
                </div>

               {{--  <button type="submit" id="proceed" class="btn btn-dark btn-sm px-3">Proceed <i class="fas fa-arrow-right"></i></button>
                <span id="txtinfo" class="text-danger" style="font-size:13px">Select one to Proceed</span> --}}
            </form>
            @if (Session::get('Error'))
            <span class="af text-danger" id="errortext" style="font-size:13px">{{Session::get('Error')}}</span>
        @endif

            </div>
        </div>

    </div>
    <script>
         var def = $('input[name="sportsevent"]:checked').length;
        if(def == 0 ){
            $('#proceed').attr('disabled',true);
        }
        $('.sportselect').change(function(){
            $('#proceed').removeAttr('disabled');
            $('#txtinfo').addClass('d-none');
        })
    </script>
@endsection
