@extends('layouts.admin_layout')
@section('content')

            <div class="container">
                        <h5 class="af">Homepage</h5>
                      {{--   {{ Auth::user()->name }}
                        {{ Auth::user()->email }}
                        {{ Auth::user()->password }}
                        {{ Auth::user()->id }} --}}
               <div class="row">
                       <div class="col-md-10">
            <div class="card shadow">
                        <div class="card-body">
                                    <h6 class="text-primary">Carousel</h6>
                                    <hr>
                                    @if (Session::get('Success_image'))
                                    <div class="alert alert-success alert-dismissable">
                                        <strong class="hf">{{ Session::get('Success_image') }}</strong>
                                        <button type="button" style="float:right" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                @endif
                                    <button data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-dark btn-sm mb-3 openmodal" data-cdata="add">Add Image</button>
                                    <br>
            <div class="row">
                    
                                    @if($count>=1)
                                    @foreach ($data as $row )
                                  
                                   <div class="col-md-4">
                                     <div class="card shadow-sm mb-2" >
                                               
                                                 <img src="{{asset('assets/img').'/'.$row->images}}" class="card-img-top" alt="" style="height: 200px">
                                                 <div class="card-body">
                                                   
                                                   <a href="#"
                                                   data-bs-toggle="modal" data-bs-target="#exampleModal"  class="btn btn-primary btn-sm openmodal" data-cdata="change" data-id="{{$row->id}}">Change Photo</a>
                                                   @if($row->priority == 0)
                                                   <button class="btn btn-light text-danger removeimg" data-id="{{$row->id}}" data-img="{{$row->images}}">Remove</button>
                                                   @endif
                                                  
                                                 </div>
                                 
                                     </div>          
                         </div>
                                   @endforeach
                                   @else
                                   No data found
                                   @endif
                    
                     
                      
            </div>

                        </div>
            </div>   
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
                      @if($vid->id == 1)
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
                    
                      @endif
                    
                      @endforeach
                     
                    </div>

                      
                  
                    
                    </div>
               

              </div>
       
            </div>
            </div>  
          </div>         
            </div> 
               </div>

            </div>

         

            
          
          <!-- Modal -->
          <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm">
              <div class="modal-content">
                <div class="modal-header">
                  <h6 class="modal-title hf" id="exampleModalLabel"><span id="titletext"></span> image</h6>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{route('admin.saveimage')}}" method="post" enctype="multipart/form-data">
                        @csrf
                <div class="modal-body">
                        <input type="hidden" id="typo" name="action" value="">
                        <input type="hidden" id="carousel_id" name="id">
                <input type="file" accept="image/*" class="form-control" name="imgfile" required>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                  <button type="submit" class="btn btn-primary btn-sm">Save</button>
                </div>
            </form>
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
                  url:"{{route('admin.savevideolink')}}",
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
                  url:"{{route('admin.savevideolink')}}",
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