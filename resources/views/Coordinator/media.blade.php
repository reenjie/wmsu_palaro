@extends('layouts.coordinator_layout')
@section('content')

   <div class="container">
    <h6 class="af mb-3" style="font-weight:bold;font-size:18px">MEDIA</h6>
    <div class="table-responsive">
      <table class="table table-striped table-sm table-hover table-bordered" id="myTable" style="font-size:14px">
         <thead>
           
            <tr class="table-dark " >
            
               <th>Sports/Event</th>
              
               <th>Link</th>
               <th>Action</th>
            </tr>
         </thead>
         <tbody>
            @foreach ($sportsdata as $row)

            @php
            $src = '';
          if($row->file == ''){
             $src = 'https://st2.depositphotos.com/4137693/11314/v/450/depositphotos_113146534-stock-illustration-no-photo-camera-vector-sign.jpg';
          }else {
            $src =  asset('assets/img').'/'.$row->file;
          }

            @endphp
            
            <tr>
            
               <td style="font-weight: bold;text-align:center">
               
               
                {{$row->name}}
                <br>
                <img src="{{$src}}" alt="" class="rounded-circle" style="width:80px;height:80px">
              </td>
               
             
               <td>
             
                <ul class="list-group list-group-flush" style="font-size:14px">
                  @foreach ($video as $link)
                  @if ($link->event == $row->id)
              
                <li class="list-group-item">  {{$link->video}}</li>
                <li class="list-group-item">Type :  {{$link->videotype}}</li>

                  @else
               
                  @endif
               
                  @endforeach


             
                 
                </ul>
                
               </td>
               <td>
                <button class="btn btn-light btn-sm text-primary" onclick="window.location.href='{{route('coordinator.addvideolinks',['id'=>$row->id,'name'=>$row->name])}}' ">MODIFY</button>
               </td>
            </tr>
            @endforeach
         </tbody>
        </table>
      </div>


   </div>
@endsection