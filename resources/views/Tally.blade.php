@extends('layouts.home')
@section('carousel')
<div class="container shadow" style="background-color: #050000;
background-image: linear-gradient(90deg, #1a0f0f 0%, #861c1cef 100%); ">
    @php
        $join = '';
    @endphp
       <div class="row mt-2 p-5">
        <div class="col-md-12">
          <select name="" id="sort" class="form-select mb-2" style="width: 200px;float:right">
            <option value="Team">Teams</option>
            <option value="Participant">Participants</option>
          </select>
          <h4 class="text-light">
            Overall Tallies
        </h4>
        
        </div>
        <div id="tally">
          <h5 class="text-light">Fetching Data...</h5>
          <div class="d-flex justify-content-center mt-5">
            <div class="spinner-border" role="status" style="color:white">
              <span class="visually-hidden">Loading...</span>
             
            </div>
          
          </div>
          
        
        </div>

       </div>
            
</div>

<script>
  $(document).ready(function(){

    $('#sort').change(function(){
        var val = $(this).val();
      $('#tally').html('<div class="d-flex justify-content-center mt-5"><div class="spinner-border" role="status" style="color:white"><span class="visually-hidden">Loading...</span></div></div>');
        $.ajax({
       method: "GET",
       url: "{{route('fetchtally')}}",
       data: { tally:1,types:val }
       })
       .done(function( msg ) {
      $('#tally').html(msg);
     });
       
    })
    
    FetchTally();
    function FetchTally(){
    
      $.ajax({
       method: "GET",
       url: "{{route('fetchtally')}}",
       data: { tally:1 }
       })
       .done(function( msg ) {
      $('#tally').html(msg);
     });
    }

  })
</script>

@endsection