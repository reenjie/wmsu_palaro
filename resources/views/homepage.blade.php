@extends('layouts.home')
@section('carousel')
<div class="shadow" style=" background-color: #5a0b0b;
">
{{-- background-image: linear-gradient(90deg, #b90707 0%, #b90707 100%); --}}
 
   <div class="">
    <div id="carouselExampleControls" class="carousel slide " data-bs-ride="carousel">
      <div class="carousel-inner shadow-sm revealc " id="c-inner" >
             
    
              @foreach ($carousel as $row )
                @if($row->id == 1)
                <div class="carousel-item active ">
                    
                          @if(file_exists(public_path().'/assets/img/'.$row->images))
                                            
                                                <img src="{{asset('public/assets/img').'/'.$row->images}}" class="c-img" alt="" >
                                                     
                                                    @else
                                                      
                                                     <img src="{{asset('assets/img').'/'.$row->images}}" class="c-img" alt="" >
                                                @endif
                                               
                 
                </div>
    
                @else
                <div class="carousel-item">
                      @if(file_exists(public_path().'/assets/img/'.$row->images))
                                            
                                                <img src="{{asset('public/assets/img').'/'.$row->images}}" class="c-img" alt="" >
                                                     
                                                    @else
                                                      
                                                     <img src="{{asset('assets/img').'/'.$row->images}}" class="c-img" alt="" >
                                                @endif
                </div>
                @endif
    
          
              @endforeach
            
          
       
            </div>
            <button  class="carousel-control-prev carousel-btns" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="prev">
              <span style="border-radius:5px"  class="carousel-control-prev-icon" aria-hidden="true"></span>
           
              <span class="visually-hidden">Previous</span>
            </button>
            <button    class="carousel-control-next carousel-btns" type="button" data-bs-target="#carouselExampleControls" data-bs-slide="next">
              <span class="carousel-control-next-icon " style="border-radius:5px" aria-hidden="true"></span>
              <span class="visually-hidden">Next</span>
            </button>
          </div>
   </div>
          
   <div id="btninfos">
    <button class="btntally" 
    onclick="window.location.href='{{route('Tally')}}' "
    >Tally</button>
       <button class="btnresult" 
       onclick="window.location.href='{{route('allevents')}}' "
       >Results</button>
 
   </div>
  


 @endsection

 @section('schedule_events')
 

        
 {{-- <div class="titlebars" style="text-align: center">
  <h4 class="text-light title" style="font-size: 25px">WMSU PALARO {{date('Y')}}</h4>
</div> --}}
        
 <div class="container mt-4" >
  <div class="row ">
            
              <div class="col-md-8 " id="Events" >

                <h5 class="title" >EVENTS</h5> 
               <br>
             {{--   <input type="text" class="eventsearch mb-3 hf" placeholder="Search for Events">
               <button class="btn btn-light text-danger hf">Search</button>
                --}}

                <div class="container" >
                  <!-- Flickity HTML init -->
<div class="gallery js-flickity" 
data-flickity-options='{"wrapAround": true }'>
@if(count($sport)>=1)
@foreach ($sport as $events)

@php
$src = '';



     if(file_exists(public_path().'/assets/img/'.$events->file)){
                                            
               
                  
                  if($events->file == ''){
                     $src = asset('public/assets/img/wmsu.jpg');
                    }else {
                    $src =  asset('public/assets/img').'/'.$events->file;
                    }
                                                     
                                                    }else{
                      if($events->file == ''){
                     $src = asset('assets/img/wmsu.jpg');
                    }else {
                    $src =  asset('assets/img').'/'.$events->file;
                    }
                                                      
                
                                                }

@endphp
<div class="gallery-cell" >
  <div class="container" style="text-align:center;margin-top:5px" >
   
    <span style="font-size: 11px" class="text-light hf">
    @foreach ($college as $col)
    @if($col->id == $events->CollegeId)
      {{$col->name}}
    @endif
        
    @endforeach
    </span>
    <h5 class="text-light hf"  style="font-weight: bold;padding-top:10px">{{$events->name}}
      <br/>
      <span >
        <img src="{{$src}}" alt="" class="rounded-circle img-thumbnail" style="width:150px;height:150px">
      </span>
    </h5>  
   
<h6 style="font-size: 13px" class="text-light af" >
   

      <span style="display: flex;align-items:center;justify-content:center" >
  {{--     <button onclick="window.location.href='{{route('join',['id'=>$events->id])}}' " class="btnjoin">Join</button> --}}
       
      <form action="{{route('View')}}" method="post">
        @csrf
        <input type="hidden" name="id"  value="{{$events->id}}" >
        <button type="submit" class="btnjoin" >View</button>
      </form>
    
      </span>

    
    </span>
    </h6>

   


   
  </div>  
</div>        
@endforeach
@else 
<h6 style="text-align: center" class="hf">
  <img src="{{asset('assets/img/wmsu.jpg')}}" alt="" style="width:100%">
  <br>
 No Events yet ..
</h6>
@endif


</div>


                </div>
<link rel="stylesheet" href="https://unpkg.com/flickity@2/dist/flickity.min.css">
<script src="https://unpkg.com/flickity@2/dist/flickity.pkgd.min.js"></script>
              {{--   <section id="slider">
                
                  <input type="radio" name="slider" id="s1">
                  <input type="radio" name="slider" id="s2">
                  <input type="radio" name="slider" id="s3" checked>
                  <input type="radio" name="slider" id="s4">
                  <input type="radio" name="slider" id="s5">
                  <label for="s1" id="slide1">ASdsad</label>
                  <label for="s2" id="slide2">asdasd</label>
                  <label for="s3" id="slide3">asdd</label>
                  <label for="s4" id="slide4">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Cupiditate sapiente laboriosam quaerat eum commodi velit illum illo necessitatibus quia, quidem nobis mollitia harum consequatur inventore praesentium atque odio neque pariatur?</label>
                  <label for="s5" id="slide5"></label>
                </section> --}}
                <br>
                @if(count($sport)>=1)
                
                @endif
              </div>
              <div class="col-md-4" >
                <h5 class="title"  >Announcement</h5>

 <div class="container" id="Announcement">
  <div class="announcement_board">
      <div class="announcement_content overflow">
        <div class="list-group" >
          @if(count($announcement)>=1)
          @foreach($announcement as $ann)         

          <a href="javascript:void(0)" class="  mb-2" aria-current="true" style="cursor: default;background-color:transparent;text-decoration:none;color:white">
            <i class="fas fa-bell text-light"></i>
            <br>
            <div class="d-flex w-100 justify-content-between">
              <h5 class="mb-1 fs text-light" style="font-size: 12px">
                @foreach ($college as $col)
                 @if($col->id == $ann->CollegeId)
                  {{$col->name}} 
                 @endif
                @endforeach
                <hr>
                @foreach ($sport as $item)
                    @if($item->id == $ann->sports_id)
               <span style="font-weight: bold">{{$item->name}}</span> 
                    @endif
                @endforeach
              </h5>
          
              <small style="font-size:11px">
                <span style="color: #dfdfdf"><time class="timeago" datetime="{{$ann->date_added}}"
                  title="{{$ann->date_added}}"></time></span>
              </small>
            </div>
           
           <br>
            <p class="mb-1 fs text-light" style="font-size:13px">{{$ann->announcement}}</p>
          
            <small style="font-size: 11px"></small>
          </a>
          @endforeach
          @else 
          <h6 style="text-align: center" class="hf">
            <img src="https://th.bing.com/th/id/OIP.NqaQ8tsZyA625R1Q62wkdwHaDt?pid=ImgDet&rs=1" alt="" style="width:100%">
            <br>
           No announcements yet ..
          </h6>
          @endif
        </div>
      </div>


  </div>
 </div>
              </div>
                      
             </div>
 </div>

</div>

 <script>
  $(document).ready(function(){
   $("time.timeago").timeago();
  })
/*   jQuery(document).ready(function() {
     jQuery("time.timeago").timeago();
      }); */
 </script>
          

 @endsection

@section('videostream')
        
          
 <div class="container mt-5">

   
            <div class="row">


<div class="col-md-8" id="Media">
  <h5 class="title text-dark" style="text-align: left">Stream <i class="fas fa-list"></i></h5>
  <div class="card" id="videoconscontroller">

              <div class="container" id="selectedvideo">
                
                @foreach ($videos as $vid )
                @if($vid->id == 1)
                  @if($vid->videotype == 'youtube')
               
                  <iframe id="ycvideo"  width="400" height="315" src="{{$vid->video}}" frameborder="0" allowfullscreen></iframe> 
                  @elseif($vid->videotype == 'facebook')
                
              
                  <div class="" id="facebookvideo">
                    {!!$vid->video!!}
                  </div>

                 
              
                  @endif
                 {{--  <h6 class="af">COMMENTS:</h6>

               <div class="row">
                <div class="col-md-2">
                  <img src="https://yt3.ggpht.com/a-/AN66SAy6MVt0L0Gqv7d2gCPK11I2emobzFuFJ7GxwA=s900-mo-c-c0xffffffff-rj-k-no" class="rounded-circle" alt="" style="width: 80%">
                </div>
                <div class="col-md-10">
                  <h6 class="hf" style="font-size:13px;font-weight:bolder">Mr.Bean |
                    <span class="text-secondary" style="font-weight: bolder;font-size:11px"> ( 3 seconds ago )</span>
                  </h6> 
                  <hr>
                  <span style="font-size:12px">
                  Lorem ipsum dolor sit, amet consectetur adipisicing elit. Repellendus, cum ipsam facere nemo magni quia. Corporis possimus corrupti sunt reiciendis ad, ut eveniet explicabo consectetur cupiditate voluptas repudiandae tempore quasi!
                  </span>
                </div>
               </div> --}}
                @endif


              
                @endforeach
              </div>
              <br>
             

             
  </div>
 
</div>
<div class="col-md-4">
  <h5 class="title text-dark" style="text-align: left">Videos</h5>
  <div class="" id="videocontroller" >
  
              <div class="card-body" >
               
      <div id="videocontents" class="overflow" style="width: 100%">
        @php
            $kunta = 0;
        @endphp
            @foreach($videos as $vid)   
            @if($vid->id == 1)
              @else
        @php
            $kunta++;
        @endphp
              
              @foreach ($sport as $event)
                  @if($event->id == $vid->event)
                  <div class="row mb-2">
                    <div class="videocard" >
                               <div class="container">
                                      
                                      
                                <div class="">
                                 
                                       <div class="">
                                        <h6 class="hf text-danger" style="font-size:11px" >
                                        @foreach ($college as $item)
                                           @if($item->id == $event->CollegeId)
                                            {{$item->name}}
                                           @endif
                                        @endforeach
                                        </h6>
                                       </div>
                                
                                <div class="card-body">  
                                  <div class="row">
                                    <div class="col-md-4">
                                      <img src="{{asset('assets/img/wmsu.jpg')}}" style="width:100%" alt="" class="rounded-circle">
                                    </div>
                                    <div class="col-md-8">
                                      <h6 style="font-weight: bold;text-align:center" class="hf  txt  text-dark">{{$event->name}}
                                      
                                       
                                      </h6>
                                      <h6 class="text-secondary" style="font-weight: normal;font-size:12px;text-align:center" >
                                        Stream now!
                                      </h6> 
                                         
                                     <span style="float: right">
                                     <button data-name="{{$event->name}}" id="{{$vid->id}}btnview" data-vid="{{$vid->id}}" class="btnview  mt-4">View Stream</button>
                                     </span>
                                    </div>
                                  </div>
                                         
                                                                   </div>
                                                       </div>
                                         
                                       
                                        
                               </div>
                    </div>
       
                   </div>
                  @endif
              @endforeach
        
            @endif

  @endforeach
                  @if($kunta >=1)
                  @else 
                  <div class="container">
                    <h6 class="mt-5 hf " style="text-align: center;">
                      <img src="https://cdn.shopify.com/s/files/1/0684/0685/products/no_video_grande.jpg?v=1428475340" alt="" style="width:100%">
                      <br>
                      No Event Videos Yet..
                  </div>
               
                  </h6>
                  @endif
              </div>


              </div>
 
</div>
</div>




            </div>
 </div>

 <div class="bg-dark " style="margin-top: 120px; ">
  <div class="container">
    <div class="row">
   
      <div class="col-md-12">
    
  <h5 class="title" >EVENT COORDINATORS</h5>
  
  <br>
  <div class="container ">
  {{-- <div class="row" style="text-align: center">

   
             @foreach($ecoordinator as $row)   
             <div class="col-md-2 d-flex">
               <div class="card mb-4 " style="background-color: rgba(224, 159, 17, 0.158)" >
              <div class="card-body coordinators">
                         <img src="{{asset('assets/img/wmsu.jpg')}}"  class="rounded-circle" alt="">
                         <h6 class="hf text-danger">{{$row->name}}</h6>
             <h6 style="font-size: 14px" class="text-light hf">
              @foreach ($sport as $sp )
                    @if($sp->id == $row->sports_id)
                    {{$sp->name}}
                    @endif
              @endforeach
            </h6>
              </div>
  
               </div>
             </div>
             @endforeach
  </div> --}}
  <style>
.xscroll::-webkit-scrollbar {
    width: 10px;
    height: 20px;
}

/* Track */
.xscroll::-webkit-scrollbar-track {
    background: transparent;
}

/* Handle */
.xscroll::-webkit-scrollbar-thumb {
    background: rgba(90, 28, 28, 0.959);
    border-radius: 5px;
}

/* Handle on hover */
.xscroll::-webkit-scrollbar-thumb:hover {
    background: rgba(128, 37, 37, 0.959);
}
  </style>
 <div class="xscroll"  style="width:100%;overflow-x:scroll;display:inline-flex;overflow-y:hidden">
      @foreach($ecoordinator as $row)   
    <div class="d-flex align-items-stretch" style="width: 300px;margin-left:10px;padding:10px">
        <div class="card pic " style="background-color: rgba(224, 159, 17, 0.158);width:150px" >
          <div class="card-body coordinators">
                     <img src="{{asset('assets/img/wmsu.jpg')}}"  class="rounded-circle" alt="">
                     <h6 class="hf text-danger">{{$row->name}}</h6>
         <h6 style="font-size: 14px" class="text-light hf">
          @foreach ($sport as $sp )
                @if($sp->id == $row->sports_id)
                {{$sp->name}}
                @endif
          @endforeach
        </h6>
          </div>

           </div>
          </div>
    
      @endforeach
     
    </div>
 
  </div>
  
  
  <h5 class="title" >COLLEGE COORDINATORS</h5>
  
  <br>
  <div class="container ">
  {{-- <div class="row" style="text-align: center">
             @foreach($coordinator as $row)   
             <div class="col-md-2 d-flex">
              <div class="card mb-4 bg-dark" >
              <div class="card-body coordinators">
                         <img src="{{asset('assets/img/wmsu.jpg')}}"  class="rounded-circle" alt="">
                         <h6 class="hf text-danger">{{$row->name}}</h6>
                         <h6 style="font-size: 14px" class="text-light hf">
                          @foreach ($college as $cc )
                                @if($cc->id == $row->CollegeId)
                                {{$cc->name}}
                                @endif
                          @endforeach
                        </h6>
              </div>
  
               </div>
             </div>
             @endforeach
  </div> --}}

  <div class="xscroll mb-4  "  style="width:100%;overflow-x:scroll;display:inline-flex;overflow-y:hidden">
    @foreach($coordinator as $row)   
  <div class="d-flex align-items-stretch" style="width: 300px;margin-left:10px;padding:10px">
      <div class="card pic   " style="background-color: rgba(224, 159, 17, 0.158);width:150px" >
        <div class="card-body coordinators">
                   <img src="{{asset('assets/img/wmsu.jpg')}}"  class="rounded-circle" alt="">
                   <h6 class="hf text-danger">{{$row->name}}</h6>
                   <h6 style="font-size: 14px" class="text-light hf">
                    @foreach ($college as $cc )
                          @if($cc->id == $row->CollegeId)
                          {{$cc->name}}
                          @endif
                    @endforeach
                  </h6>
        </div>

         </div>
        </div>
  
    @endforeach
   
  </div>
  </div>
  
  
  
  
  
      </div>
  
    </div>
  </div>
 </div>

 <script>
  $('.btnview ').click(function(){
   var id = $(this).data('vid');
   var name = $(this).data('name');
   $('.btnview').html('View Stream').removeClass('bg-primary').removeClass('text-light');;
   $('#'+id+'btnview').html('viewing..').addClass('bg-primary').addClass('text-light');
   
   $('#selectedvideo').html('<h1 class="mt-5 text-danger" style="text-align:center"><div class="spinner-border " style="width: 150px; height:150px; text-align:center" role="status"><span class="visually-hidden">Loading...</span></div></h1>');
    $.ajax({
      url:'{{route("changevideo")}}',
      method:'get',
      data:{id:id},
      success:function(data){
        $('#selectedvideo').html(data);
      }
    });
  })
 </script>

 @endsection



@section('sport_coordinators')





 @endsection

 