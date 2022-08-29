@extends('layouts.event_layout')
@section('content')

@if(count($data)>=1)
<div class="container ">
    <a href="{{ route('e.tally') }}" class="btn btn-dark btn-sm px-4 mb-2">Back</a>
    <div class="card shadow" id="tableteam">
        <div class="card-body">
            <div class="container">

                <h6 class="hf " style="font-size:13px">TEAM Picking</h6>

                <br>
                <h6 class="hf">SELECTION OF  <span class="text-primary" style="font-weight: bold;font-size:29px">{{ $available_slots }}</span> TEAMS FOR THE MATCH
                    <br>
                    Selected Participants : <span class="text-danger" id="selectedp"></span>
                </h6>
                <div class="container">
                    <form action="{{ route('e.setmatchselected') }}" method="post">
                        @csrf
                        <input type="hidden" name="matchid" value="{{$matchid}}">
                        <input type="hidden" name="mtype" value="team">
                        {{-- 
                                  <div class="row">
                                    <div class="col-md-6">
                                        <select name="team" id="" required class="form-select mb-2">
                                            <option value="">Select Team</option>
                                            <option value="0">INDEPENDENT (Zero Team)</option>
@foreach($allteam as $item)
                <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach

                        </select>
                </div>
            </div> --}}
            <div class="table-responsive">


                <table class="table table-striped af" id="myTable1" style="font-size:14px">
                    <thead>
                        <tr>
                            <th scope="col">

                            </th>
                            <th scope="col">Name</th>
                            <th scope="col">Type</th>

                        </tr>
                    </thead>
                    <tbody>


                        @foreach($data as $row)

                            <tr id="{{ $row->id }}" class="tbl {{ $row->id }}">
                                <td class="clean 
@if(Session::get('Error')) table-danger @endif
                                                     ">
                                    <div class="form-check">
                                                @if(count($data)==1) 

                                                @else 
                                                <input class="check form-check-input" type="checkbox" value="{{ $row->id }}"
                                                name="selected_ids[]" id="selection{{ $row->id }}"
                                                data-id="{{ $row->id }}">
                                            <label class="form-check-label" for="selection{{ $row->id }}">
    
                                            </label>
                                            <input type="hidden" name="sportsevent" value="{{ $sportevent }}">
                                                @endif
                                     
                                    </div>
                                </td>
                                <td class="text-primary hf">{{ $row->name }}</td>
                                <td>Team</td>


                            </tr>


                        @endforeach





                    </tbody>
                </table>
            </div>
            @if(count($data)==1) 
            <span class="text-danger hf">Could not Complete Selection. Number of TEAM/GROUP is lacking 1 to select 2 TEAMS. </span>
            @else 
            <button type="submit" id="btnadd" disabled class="btn btn-dark btn-sm px-5">Add</button>
            @endif
            

            </form>
            <br>
            @if(Session::get('Error'))
                <span class="af text-danger" id="errortext"
                    style="font-size:13px">{{ Session::get('Error') }}</span>
            @endif

        </div>
    </div>

</div>
</div>
</div>

@endif

@if(count($individual)>=1)
<div class="container mt-4 " id="tableindividual">
    <div class="card shadow">
        <div class="card-body">
            <div class="container">

                <h6 class="hf " style="font-size:13px">INDEPENDENT Picking</h6>

                <br>
                <h6 class="hf">SELECTION OF  <span class="text-primary" style="font-weight: bold;font-size:29px">{{ $available_slots }}</span> INDIVIDUALS FOR THE MATCH
                    <br>
                    Selected Participants : <span class="text-danger" id="selectedpi"></span>
                </h6>
                <div class="container">
                    <form action="{{ route('e.setmatchselected') }}" method="post">
                        @csrf
                        <input type="hidden" name="mtype" value="individual">
                        <input type="hidden" name="matchid" value="{{$matchid}}">
                        {{-- 
                                                  <div class="row">
                                                    <div class="col-md-6">
                                                        <select name="team" id="" required class="form-select mb-2">
                                                            <option value="">Select Team</option>
                                                            <option value="0">INDEPENDENT (Zero Team)</option>
@foreach($allteam as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                        @endforeach

                        </select>
                </div>
            </div> --}}
            <div class="table-responsive" >


                <table class="table table-striped af" id="myTable1" style="font-size:14px">
                    <thead>
                        <tr>
                            <th scope="col">

                            </th>
                            <th scope="col">Name</th>
                            <th scope="col">Type</th>

                        </tr>
                    </thead>
                    <tbody>


                        @foreach($individual as $row)

                            <tr id="{{ $row->id }}i" class="tbl {{ $row->id }}i">
                                <td class="cleani 
@if(Session::get('Error')) table-danger @endif
                                                                     ">
                                    <div class="form-check">
                                                @if(count($individual)==1) 
                                                @else 
                                                <input class="checki form-check-input" type="checkbox" value="{{ $row->id }}"
                                                name="selected_id_individual[]" id="selectioni{{ $row->id }}"
                                                data-id="{{ $row->id }}">
                                            <label class="form-check-label" for="selectioni{{ $row->id }}">
    
                                            </label>
                                            <input type="hidden" name="sportsevent" value="{{ $sportevent }}">
                                                @endif
                                       
                                    </div>
                                </td>
                                <td> <span class="text-primary">{{ $row->name }}</span>
                                    <br>
                                   <span class="text-secondary" style="font-size: 14px">{{$row->email}}</span> 
                        </td>
                                <td>INDEPENDENT</td>


                            </tr>


                        @endforeach





                    </tbody>
                </table>
            </div>
            @if(count($individual)==1) 
            <span class="text-danger hf">Could not Complete Selection. Number of Independent participants is lacking 1 to select 2 individuals. </span>
            @else 
            <button type="submit" id="btnaddi" disabled class="btn btn-dark btn-sm px-5">Add</button>
            @endif
          

            </form>
            <br>
            @if(Session::get('Error'))
                <span class="af text-danger" id="errortexti"
                    style="font-size:13px">{{ Session::get('Error') }}</span>
            @endif

        </div>
    </div>

</div>
</div>
</div>
@endif

<script>
    var def = $('input[name="selected_ids[]"]:checked').length;
    var indi = $('input[name="selected_id_individual[]"]:checked').length;

    $('#selectedp').text(def);
    $('#selectedpi').text(indi);

    $('.check').change(function () {
            $('#tableindividual').addClass('d-none');
       // $('#btnadd').removeAttr('disabled', true);
        $('.clean').removeClass('table-danger');
        $('#errortext').html('');
        var id = $(this).data('id');
        $('#' + id).removeClass('table-danger');
        var len = $('input[name="selected_ids[]"]:checked').length;
        $('#selectedp').text(len);
        if (len > {{$available_slots}}) {
            $(this).prop('checked', false);
            $('#' + id).addClass('table-danger');
            $('#selectedp').text(len - 1);
            $('#btnadd').removeAttr('disabled', true);
        } else if (len <  {{$available_slots}}) {
         
            $('#btnadd').attr('disabled', true);
        }else if (len == {{$available_slots}})

        {
            $('#btnadd').removeAttr('disabled', true);
        }

        if (len == 0) {
            $('#btnadd').attr('disabled', true);
            $('#tableindividual').removeClass('d-none');
        }


    })

    $('.checki').change(function () {
            $('#tableteam').addClass('d-none');
        $('#btnaddi').removeAttr('disabled', true);
        $('.cleani').removeClass('table-danger');
        $('#errortexti').html('');
        var id = $(this).data('id');
        $('#' + id+'i').removeClass('table-danger');
        var len = $('input[name="selected_id_individual[]"]:checked').length;
        $('#selectedpi').text(len);
        if (len > {{$available_slots}}) {
            $(this).prop('checked', false);
            $('#' + id+'i').addClass('table-danger');
            $('#selectedpi').text(len - 1);
            $('#btnaddi').removeAttr('disabled', true);
        } else if (len < {{$available_slots}}) {

            $('#btnaddi').attr('disabled', true);
        }else if (len == {{$available_slots}}) {
            $('#btnaddi').removeAttr('disabled', true);
        }

        if (len == 0) {
            $('#btnaddi').attr('disabled', true);
            $('#tableteam').removeClass('d-none');
        }


    })

</script>
@endsection
