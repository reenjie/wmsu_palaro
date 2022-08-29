@extends('layouts.home')
@section('carousel')
    <div class="container">

        <div class="row">
            <div class="col-md-6">
                     <h4 class="hf mt-5">Join Game</h4>   
           <div class="card shadow mt-4  bg-dark">
            <div class="card-body">
                        <div class="container ">
                                    @foreach ($sport as $events)
                                        @php
                                            $src = '';
                                            if ($events->file == '') {
                                                $src = asset('assets/img/wmsu.jpg');
                                            } else {
                                                $src = asset('assets/img') . '/' . $events->file;
                                            }
                                            
                                        @endphp
                                        <span style="font-size: 11px" class="text-light hf">
                                            @foreach ($college as $col)
                                                @if ($col->id == $events->CollegeId)
                                                    {{ $col->name }}
                                                @endif
                                            @endforeach
                                        </span>
                                        <h1 class="text-danger hf" style="font-weight: bold">{{ $events->name }}
                                            <span style="float:right;margin-right:40px">
                                                <img src="{{ $src }}" alt="" class="rounded-circle img-thumbnail"
                                                    style="width:100px;height:100px">
                                            </span>
                                        </h1>
                                        <br>
                                        <h6 class="text-light af">
                                            Description
                
                                            <br>
                                            <span style="font-size:14px" class="hf">{{ $events->description }}</span>
                                            <br><br>
                                            Rules & Regulations
                                            <br>
                                            <span style="font-size:14px" class="hf">{{ $events->rules_regulation }}</span>
                                            <br><br>
                                            Requirements
                                            <br>
                                            <span style="font-size:14px" class="hf">{{ $events->requirements }}</span>
                
                
                                            <br><br>
                                            No. of Participants allowed
                                            <br>
                                            <span style="font-size:14px" class="hf">{{ $events->nop }}</span>
                                                <input type="hidden" id="eventid" value="{{$events->id}}">
                                        </h6>
                                    @endforeach
                
                                </div>
            </div>
           </div>
            </div>

            <div class="col-md-6">
            <h4 class="hf mt-5">Validating Participants</h4>     
            <hr>
            <h6 class="hf">Please Enter your Email Address for validation:</h6>
            <input id="email" type="email" class="validatetxt" autofocus autocomplete="none">
            <button id="validate" class="btn btn-dark px-4 hf mt-3">Validate</button>

            <br>
             <div class="result mt-5"></div>
            </div>

        </div>

    </div>

    <script>
            $('#validate').click(function(){
                var val = $('#email').val();
                var id = $('#eventid').val();
                if(val==''){
                  $('#email').addClass('invalid');
                }else {

                        if(IsEmail(val)== true){
                                    $('#email').removeClass('invalid');    

$('.result').html('<span style="font-weight:bolder;font-size:20px" class="text-secondary hf">Verifying ...</span>');
$.ajax({
url: '{{route("validate")}}',
method: 'get',
data : {val:val,id:id},
success : function(data){
if(data == 'join'){
$('.result').html('<span style="font-weight:bolder;font-size:25px" class="text-success hf">Account Verified!<br> Please <a href="{{route("login")}}">Login</a> and Join the Game!</span>');
}else if (data == 'cantjoin') {
            $('.result').html('<span style="font-weight:bolder;font-size:25px" class="text-danger hf">Sorry! You cannot join this game. </span>');
}else {
$('.result').html('<span style="font-weight:bolder;font-size:25px" class="text-danger hf">We are unable find your account. Please Make sure you have entered the correct Email. Or <a href="{{route("register")}}">Register</a> when you dont have an account. </span>');
}
} 
})
                        }else {
        $('.result').html('<span style="font-weight:bolder;font-size:25px" class="text-danger hf">Please Enter a Valid Email</span>');
                        }
                 
                }        
            })

function IsEmail(email) {
  var regex = /^([a-zA-Z0-9_\.\-\+])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/;
  if(!regex.test(email)) {
    return false;
  }else{
    return true;
  }
}
    </script>
@endsection
