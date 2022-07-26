@extends('layouts.home')
@section('carousel')
<div class="container">
 
      <div id="carouselExampleControls" class="carousel slide" data-bs-ride="carousel">
        <div class="carousel-inner">
         

          @foreach ($carousel as $row )
            @if($row->id == 1)
            <div class="carousel-item active">
              <img src="{{asset('assets/img').'/'.$row->images}}" class="c-img" alt="...">
            </div>

            @else
            <div class="carousel-item">
              <img src="{{asset('assets/img').'/'.$row->images}}" class=" c-img" alt="...">
            </div>
            @endif

      
          @endforeach
        
      
   
        </div>
        <button  class="carousel-control-prev carousel-btns" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
          <span style="background-color:rgb(190, 42, 42);padding:20px"  class="carousel-control-prev-icon" aria-hidden="true"></span>
       
          <span class="visually-hidden">Previous</span>
        </button>
        <button    class="carousel-control-next carousel-btns" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
          <span class="carousel-control-next-icon " style="background-color:rgb(190, 42, 42);padding:20px" aria-hidden="true"></span>
          <span class="visually-hidden">Next</span>
        </button>
      </div>
    
 
</div>


 @endsection

 @section('schedule_events')
 <div class="linespacer container"><hr></div>
        

 <div class="container">
            <div class="row mt-2 ">
              <div class="col-md-8 border-right" >
                <h5 class="title" >EVENTS</h5>
                <div class="event_contents overflow" id="event_contents">

               
                <div class="row">
                  @for($i = 0 ; $i < 8; $i ++)
                  <div class="col-md-4">
      <div class="card mb-4 shadow" style="border-radius: 7px">
     
        <div class="card-body eventcardbody">
        <h6 class="af eventcardheader">Week {{$i}} </h6>     
        <div class="linespacer container"><hr></div>
        <ol class="list-group list-group-numbered">
          <li class="list-group-item d-flex fs justify-content-between align-items-start">
            <div class="ms-2 me-auto">
              <div class="fw-bold fs">Subheading</div>
              Content for list item
            </div>
            <span class="badge bg-primary rounded-pill">14</span>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-start">
            <div class="ms-2 fs me-auto">
              <div class="fw-bold fs">Subheading</div>
              Content for list item
            </div>
            <span class="badge bg-primary rounded-pill">14</span>
          </li>
          <li class="list-group-item d-flex justify-content-between align-items-start">
            <div class="ms-2 fs me-auto">
              <div class="fw-bold fs">Subheading</div>
              Content for list item
            </div>
            <span class="badge bg-primary rounded-pill">14</span>
          </li>
        </ol>

        
       </div>
                              
           </div>
                  </div>
                  @endfor
                </div>
              </div>
              </div>
              <div class="col-md-4" >
                <h5 class="title"  >Announcement</h5>

 <div class="container">
  <div class="announcement_board">
      <div class="announcement_content overflow">
        <div class="list-group">
          @for($i = 0 ; $i < 7; $i ++)         
          <a href="#" class="list-group-item list-group-item-action " aria-current="true">
            <div class="d-flex w-100 justify-content-between">
              <h5 class="mb-1 fs">List group item heading</h5>
              <small>3 days ago</small>
            </div>
            <p class="mb-1 fs">Some placeholder content in a paragraph.</p>
            <small>And some small print.</small>
          </a>
          @endfor
     
        </div>
      </div>


  </div>
 </div>
              </div>
                      
             </div>
 </div>
 
          

 @endsection

@section('videostream')
            <div class="linespacer container"><hr></div>
          
 <div class="container mt-5">
  <h5 class="title" style="text-align: left">Stream</h5>
   
            <div class="row">
<div class="col-md-8">
  
            <div class="card" id="videoconscontroller">

                        <div class="container">
                          
                          @foreach ($videos as $vid )
                          @if($vid->id == 1)
                            @if($vid->videotype == 'youtube')
                         
                            <iframe id="ycvideo"  width="400" height="315" src="{{$vid->video}}" frameborder="0" allowfullscreen></iframe> 
                            @elseif($vid->videotype == 'facebook')
                          
                        
                            <div class="" id="facebookvideo">
                              {!!$vid->video!!}
                            </div>
    
                           
                        
                            @endif
                        
                          @endif
                        
                          @endforeach
                        </div>
                        <br>
                        <h6 class="af">COMMENTS:</h6>
                       
            </div>
           
</div>
<div class="col-md-4">
            <div class="card" id="videocontroller">
                     
                        <div class="card-body" >

                <div id="videocontents" class="overflow">

                      @for($i = 0 ; $i < 7; $i ++)                 
            <div class="row mb-2">
             <div class="videocard" >
                        <div class="container">
                               
                               
                         <div class="card">
                          
                                
                         
                         <div class="card-body">  
                                      <h6 class="af eventcardheader txt">PlayOffs</h6>
                                      <div class="linespacer container"><hr></div>
                          <h6 class="af">asd</h6>     
                                                            </div>
                                                </div>
                                  
                                
                                 
                        </div>
             </div>

            </div>
            @endfor

                        </div>


                        </div>
            </div>
</div>

            </div>
 </div>

 @endsection



@section('sport_coordinators')
<div class="linespacer container"><hr></div>
<h5 class="title" >SPORT COORDINATORS</h5>

 <br>
 <div class="container">
 <div class="row">
            @for($i = 0 ; $i < 7; $i ++)   
            <div class="col-md-2">
              <div class="mb-4">
             <div class="card-body coordinators">
                        <img src="{{asset('assets/img/wmsu.jpg')}}"  class="rounded-circle" alt="">
                        <h6>Reenjay Caimor</h6>
             </div>

              </div>
            </div>
            @endfor
 </div>
</div>


 @endsection