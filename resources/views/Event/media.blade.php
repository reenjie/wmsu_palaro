@extends('layouts.event_layout')
@section('content')
    <div class="container">
            <div class="card shadow-sm mt-2">
                        <div class="card-body">
                          <h6 class="text-primary">Video Stream/links</h6>
                          <hr>
                          <div class="row">
                            <div class="col-md-10">
                             
                                  <div class="container">
                                    <h6 class="af">Main Stream Links</h6>
                                
                                   
              
                                    <textarea name="" style="resize: none" class="form-control mb-2" id="links" id="" cols="5" rows="5" placeholder="Enter URL or Embedded video code(Facebook) to Change the Current Main Video"></textarea>
                                    <div class="invalid-feedback mb-2">
                                      <span style="font-size:13px" class="af">Please provide link first!</span>
                                    </div>
              
                                    <button class="btn btn-danger btn-sm" id="youtube">Youtube</button>
                                    <button class="btn btn-primary btn-sm" id="facebook">Facebook</button>
              
                                  
                                
              
                                        
                                    <div class="d-none" id="youtubevideo">
                                      <hr>
                                      Main-video
                                      <iframe id="ycvideo"  width="400" height="315" src="" frameborder="0" allowfullscreen></iframe> 
                                    </div>
                                    <div class="d-none" id="facebookvideo">
                                  
                                    
                                    </div>
              
                                    <div id="main">
                                 
                                    
                                    @foreach ($videos as $vid )
                                  
                                      @if($vid->videotype == 'youtube')
                                      <hr>
                                      Main-video
                                      <iframe id="ycvideo"  width="400" height="315" src="{{$vid->video}}" frameborder="0" allowfullscreen></iframe> 
                                      @elseif($vid->videotype == 'facebook')
                                      <hr>
                                      Main-video
                                  
                                      <div class="" id="facebookvideo">
                                        {!!$vid->video!!}
                                      </div>
              
                                     
                                  
                                      @endif
                                  
                                  
                                  
                                    @endforeach
                                   
                                  </div>
              
                                    
                                
                                  
                                  </div>
                             
              
                            </div>
                     
                          </div>
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
                  url:"{{route('e.savevideolink')}}",
                  method:"GET", 
                  data  : {link:embedded,vtype:'youtube'},
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
                  url:"{{route('e.savevideolink')}}",
                  method:"GET", 
                  data  : {link:url,vtype:'facebook'},
                  success :function(data){
                   
                  }

              })
            
           }


            })
            $('.openmodal').click(function(){
                 var cdata = $(this).data('cdata');   
                 var id = $(this).data('id');
                   
                 $('#titletext').text(cdata);
                 $('#carousel_id').val(id);
                 $('#typo').val(cdata);
            })
            $('.removeimg').click(function(){
            var id = $(this).data('id');
            var img = $(this).data('img');
       swal({
      title: "Are you sure?",
      text: "Once deleted, you will not be able to recover it",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
         window.location.href='removeimage/'+id+'/'+img;
      } else {
       
      }
    });

            })
          </script>
@endsection