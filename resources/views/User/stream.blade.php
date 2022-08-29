@extends('layouts.user_layout')
@section('content')
    <div class="container">
        <h5 class="hf mb-3" style="font-weight: bold">Streaming</h5>
        <div class="row">
            <div class="col-md-8" id="Media">

                <div class="card" id="videoconscontroller">

                    <div class="container" id="selectedvideo">

                        @foreach ($videos as $vid)
                            @if ($vid->id == 1)
                                @if ($vid->videotype == 'youtube')
                                    <iframe id="ycvideo" width="400" height="315" src="{{ $vid->video }}"
                                        frameborder="0" allowfullscreen></iframe>
                                @elseif($vid->videotype == 'facebook')
                                    <div class="" id="facebookvideo">
                                        {!! $vid->video !!}
                                    </div>
                                @endif
                                {{-- <h6 class="af">COMMENTS:</h6>
                        
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
                <div class="card" id="videocontroller">

                    <div class="card-body">

                        <div id="videocontents" class="overflow">

                            @foreach ($videos as $vid)
                                @if ($vid->id == 1)
                                @else
                                    @foreach ($sport as $event)
                                        @if ($event->id == $vid->event)
                                            <div class="row mb-2">
                                                <div class="videocard">
                                                    <div class="container">


                                                        <div class="card bg-dark">

              <div class="card-header">
       <h6 class="hf text-danger" style="font-size:11px">
           @foreach ($college as $item)
            @if ($item->id == $event->CollegeId)
        {{ $item->name }}
            @endif
              @endforeach
             </h6>
            </div>

         <div class="card-body">
              <div class="row">
     <div class="col-md-4">
           <img src="{{ asset('assets/img/wmsu.jpg') }}"
          style="width:100%" alt=""
         class="rounded-circle">
       </div>
              <div class="col-md-8">
         <h6 style="font-weight: bold;text-align:center"
class="hf  txt shadow-sm text-light">
    {{ $event->name }}


       </h6>
       <h6 class="text-secondary"
             style="font-weight: normal;font-size:12px;text-align:center">
            Stream now!
              </h6>

        <span style="float: right">
    <button data-name="{{ $event->name }}"
                                                                                id="{{ $vid->id }}btnview"
                                                                                data-vid="{{ $vid->id }}"
                                                                                class="btnview  mt-4">View Stream</button>
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
