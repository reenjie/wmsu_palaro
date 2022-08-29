@extends('layouts.coordinator_layout')
@section('content')
<div class="container">
            <h6 class="af mb-3" style="font-weight:bold;font-size:18px">MODIFY VIDEO LINKS ( <span class="text-danger">{{$name}}</span>)</h6>

            <a href="{{route('coordinator.media')}}" class="btn btn-dark mb-3 px-3 btn-sm">Back</a>
        

            <div class="container">
                        <h6 class="af">{{$name}} Stream Links</h6>
                    
                       
  
                        <textarea name="" style="resize: none" class="form-control mb-2" id="links" id="" cols="5" rows="5" placeholder="Enter URL or Embedded video code(Facebook) to Change the Current Main Video"></textarea>
                        <div class="invalid-feedback mb-2">
                          <span style="font-size:13px" class="af">Please provide link first!</span>
                        </div>
  
                        <button class="btn btn-danger btn-sm" id="youtube">Youtube</button>
                        <button class="btn btn-primary btn-sm" id="facebook">Facebook</button>
  
                      
                    
  
                            
                        <div class="d-none" id="youtubevideo">
                          <hr>
                       
                          <iframe id="ycvideo"  width="400" height="315" src="" frameborder="0" allowfullscreen></iframe> 
                        </div>
                        <div class="d-none" id="facebookvideo">
                      
                        
                        </div>
  
                        <div id="main">
                     
                        
                        @foreach ($videos as $vid )
                   
                          @if($vid->videotype == 'youtube')
                          <hr>
                        
                         
                          <iframe id="ycvideo"  width="400" height="315" src="{{$vid->video}}" frameborder="0" allowfullscreen></iframe> 
                          @elseif($vid->videotype == 'facebook')
                          <hr>
                       
                      
                          <div class="" id="facebookvideo">
                            {!!$vid->video!!}
                          </div>
  
                         
                      
                          @endif
                      
                     
                      
                        @endforeach
                       
                      </div>
  
                        
                    
                      
                      </div>
         
</div>
    <script>
            
            $('#links').keyup(function(){
              $(this).removeClass('is-invalid');
            })
            $('#youtube').click(function(){
              var url = $('#links').val();
           
              if(url == ''){
                $('#links').addClass('is-invalid');
              }else {
                $('#main').addClass('d-none');
                $('#youtubevideo').removeClass('d-none');
                $('#facebookvideo').addClass('d-none');
             
                var newval = url.slice(32);
                $('#yvideo').attr('src','https://www.youtube.com/embed/'+newval);
                $('#ycvideo').attr('src','https://www.youtube.com/embed/'+newval);
                $('iframe').attr('style','width:100%;height:400px');

                var embedded = 'https://www.youtube.com/embed/'+newval;
                $.ajax({
                  url:"{{route('coordinator.savevideolink')}}",
                  method:"GET", 
                  data  : {link:embedded,vtype:'youtube',event:'{{$id}}'},
                  success :function(data){
                   
                  }

              })
              }

            })

            $('#facebook').click(function(){
            var url = $('#links').val();
           
           if(url == ''){
             $('#links').addClass('is-invalid');
           }else {
            $('#main').addClass('d-none');
            $('#youtubevideo').addClass('d-none');
             $('#facebookvideo').removeClass('d-none');

              $('#facebookvideo').html(url);

              $.ajax({
                  url:"{{route('coordinator.savevideolink')}}",
                  method:"GET", 
                  data  : {link:url,vtype:'facebook',event:'{{$id}}'},
                  success :function(data){
                   
                  }

              })
            
           }


            })
    </script>
@endsection