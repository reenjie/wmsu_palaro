@extends('layouts.user_layout')
@section('content')
<div class="container">
            <h5 class="hf mb-3" style="font-weight: bold">Join Event (<span class="text-danger" style="font-size:30px">{{$name}}</span> )</h5>    
            
            <a href="{{route('user.join')}}" class="btn btn-dark btn-sm px-3">Back</a>

<div class="row">
            <div class="col-md-8">
                        <div class="card shadow mt-3">
                                    <div class="card-body">
                                   <div class="row">
                                    <div class="col-md-6">
                                                <h6 class="hf">Rules & Regulation</h6>
                                                <span class="text-danger">
                                                @foreach ($eventdata as $item)
                                                    {{$item->rules_regulation}}
                                                @endforeach
                                                </span>
                                    </div>
                                    <div class="col-md-6">
                                                <h6 class="hf">Requirements</h6>
                                                <span class="text-danger">
                                                @foreach ($eventdata as $item)
                                                    {{$item->requirements}}
                                                @endforeach
                                                </span>
                                    </div>
                                   </div>

                                   <hr>  
                                   <span class="text-secondary hf">
                                    Note: Please provide the complete requirements shown above. after pressing join button . your request to join is subjected for verification
                                   </span>
                                   <hr>
                                 <h6 class="hf">Add requirements</h6>
                                 <form action="{{route('user.join_sportevent')}}" method="post" enctype="multipart/form-data">
                                    @csrf
                                   <input type="hidden" name="id" value="{{$id}}">
                                   <div class="row">
                                    <div class="col-md-6">
                                              <input id="requirements" type="file" class="form-control mb-2" required multiple name="files[]">    
                                    </div>
                                    <div class="col-md-6">
                                                <button type="submit" class="btn btn-dark px-5">Join</button>
                                    </div>

                                    <div class="col-md-12">
                                               
                                                <hr>
                                                <h6 style="font-weight: bold" class="hf text-danger" id="selected"></h6>
                                                <div id="items">

                                                </div>
                                    </div>
                                   </div>

                        </form>

                                   
                                
                                   
                                    </div>
                        </div>
            </div>
</div>
</div>

<script>
$('#requirements').change(function(){      
            $('#items').html('');     
            var val = $(this)[0].files.length;
            var items = $(this)[0].files;
            var fragments = "";
            $('#selected').html(val+' '+'Items Selected');

            if(val>0){
                        for(var i=0; i<val; i++){
   fragments += "<div class='card shadow mb-2'><div class='card-body'><h6 class='text-primary hf' style='text-align:center'>"+items[i].name+"</h6></div></div>" ;    
                        }
            }

            $('#items').append(fragments);
            

           
})
</script>
    
@endsection