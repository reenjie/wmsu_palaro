@extends('layouts.home')
@section('carousel')
<div class="container">
          <div class="row mt-5">
            <div class="col-md-2"></div>
            <div class="col-md-8">
               @foreach ($college as $item)
               <div class="card shadow bg-dark mb-3">
                        <div class="card-body">
              @foreach ($sport as $events)
                  @if($events->CollegeId == $item->id)
                    
                                    <div class="card-header">
                          <h6 style="font-size: 24px" class="hf text-light">{{$item->name}}</h6>
                                    </div>
                
                        <div class="container ">
                                
                                        @php
                                            $src = '';
                                            if ($events->file == '') {
                                                $src = asset('assets/img/wmsu.jpg');
                                            } else {
                                                $src = asset('assets/img') . '/' . $events->file;
                                            }
                                            
                                        @endphp
                                        <span style="font-size: 11px" class="text-light hf">
                                        
                                        </span>
                                        <h1 class="text-danger hf" style="font-weight: bold">{{ $events->name }}
                                            <span style="float:right;margin-right:40px">
                                                <br>
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
                                 
                
                                </div>
                   
                  @endif
              @endforeach
            </div>
</div>


               @endforeach         
                        
            </div>
            <div class="col-md-2"></div>
          </div>

</div>

@endsection