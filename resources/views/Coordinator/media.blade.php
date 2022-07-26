@extends('layouts.coordinator_layout')
@section('content')

   <div class="container">
        <h6 class="af mb-3" style="font-weight:bold;font-size:18px">MEDIA</h6>
        <div class="row">
            <div class="col-md-2"></div>
            <div class="col-md-8">
          <div class="container">
            <h6 class="af">Stream Links</h6>
                
                   

            <textarea name="" style="resize: none" class="form-control mb-2" id="links" id="" cols="5" rows="5" placeholder="Enter URL or Embedded video code(Facebook) to Change the Current Video"></textarea>
            <div class="invalid-feedback mb-2">
              <span style="font-size:13px" class="af">Please provide link first!</span>
            </div>

            <button class="btn btn-danger btn-sm" id="youtube">Youtube</button>
            <button class="btn btn-primary btn-sm" id="facebook">Facebook</button> 
          </div>
        </div>
        <div class="col-md-2"></div>
        </div>
        <div class="row">
           
                <div class="container">
                     <div class="row">
                        <div class="col-md-2"></div>
                        <div class="col-md-8">
                            <div class="" id="youtubevideo">
                      
                                <br>
                                   <iframe id="ycvideo"  width="400" style="background-color: grey" height="315" src="" frameborder="0" allowfullscreen></iframe> 
                                 </div>
                                 <div class="d-none" id="facebookvideo">
                               
                                 
                                 </div>
             
                                 <div id="main">
                              
                                 
                              {{--    @foreach ($videos as $vid )
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
                               
                                 @endforeach --}}
                                
                               </div>
             
                                 
                        </div>
                        <div class="col-md-2"></div>
                     </div>
                  
                
                  
                  </div>

            </div>
          

        
   </div>
@endsection