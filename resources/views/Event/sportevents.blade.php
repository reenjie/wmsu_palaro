@extends('layouts.event_layout')
@section('content')
@foreach ($myevent as $row)

@php
$src = '';
if($row->file == ''){
 $src = asset('assets/img/wmsu.jpg');
}else {
$src =  asset('assets/img').'/'.$row->file;
}

@endphp

   <div class="container">
       


           
                   
            <h6 style="position: absolute;right:10px;top:40px">
                        <img src="{{$src}}" alt="" class="rounded-circle img-thumbnail" style="width:100px;height:100px">
            </h6>  
            <h5 class="hf" style="font-weight: bolder">{{$row->name}}</h5>      
            <div class="container">
                       
                        
            <div class="row mt-3">
            <div class="col-md-6">
                        <h6 class="text-danger hf">Note: Automatically saving Changes..</h6>
                 <h6 class="af ">DATE</h6>    
                 <div class="row">
                        <div class="col-md-6">
                                    <h6 class="af ">Start</h6> 
                                    <input type="date" class="clear form-control mb-2 @error('datestart') is-invalid  @enderror  savechange" style="font-size: 13px" name="datestart" value="{{$row->datestart}}" data-id="{{$row->id}}" data-name="datestart">
                                    @error('datestart') 
                                    <div class="invalid-feedback mb-2">
                                           <span style="font-:size:11px" class="hf" >{{$message}}</span>
                                    </div>
                                @enderror
                        </div>
                        <div class="col-md-6">

                                    <h6 class="af ">End</h6> 
                                    <input type="date" class="clear form-control mb-2 @error('dateend') is-invalid   @enderror savechange" style="font-size: 13px" name="dateend" value="{{$row->dateend}}" data-id="{{$row->id}}" data-name="dateend">
                                    @error('dateend') 
                                    <div class="invalid-feedback mb-2">
                                           <span style="font-:size:11px" class="hf" >{{$message}}</span>
                                    </div>
                                @enderror
                        </div>
                 </div>  

                 <h6 class="af ">Description:</h6>      
                
                 <textarea name="description" class="clear savetext form-control mb-2 @error('description') is-invalid  @enderror" id="" cols="5" rows="5" style="font-size: 13px;resize:none" data-id="{{$row->id}}" data-name="description">{{$row->description}}</textarea>
                 @error('description') 
                 <div class="invalid-feedback mb-2">
                        <span style="font-:size:11px" class="hf" >{{$message}}</span>
                 </div>
             @enderror
                 <h6 class="hf" style="font-weight: bold">Rules and Regulations</h6>  

                 <div class="row">
                     <div class="col-md-6">
                            <h6 class="af ">Maximum number of Participants:</h6>
                            <input type="number" name="numofparticipants" class="form-control savetext mb-2  " style="font-size: 13px" value="{{$row->nop}}" min="3" data-id="{{$row->id}}" data-name="nop">           
                </div>      
                <div class="col-md-6">
                            <h6 class="af ">Number of Rounds:</h6>
                            <input type="number" class="form-control savetext mb-2 " style="font-size: 13px" name="numofrounds" value="{{$row->nor}}" data-id="{{$row->id}}" data-name="nor">            
                </div>  

                <h6 class="hf ">TIME per Day</h6>
                        
                        <div class="col-md-6">
                                    <h6 class="af ">Start</h6>
                                    <input type="time" class="clear form-control mb-2  @error('timestart') is-invalid  @enderror savechange" style="font-size: 13px" name="timestart" value="{{$row->timestart}}" data-id="{{$row->id}}" data-name="timestart">   
                                    @error('timestart') 
                                    <div class="invalid-feedback mb-2">
                                           <span style="font-:size:11px" class="hf" >{{$message}}</span>
                                    </div>
                                @enderror         
                        </div>   

                        <div class="col-md-6">
                                    <h6 class="af ">End</h6>
                                    <input type="time" class="clear form-control mb-2  @error('timeend') is-invalid  @enderror savechange" style="font-size: 13px" name="timeend" value="{{$row->timeend}}" data-id="{{$row->id}}" data-name="timeend" >  
                                    @error('timeend') 
                                    <div class="invalid-feedback mb-2">
                                           <span style="font-:size:11px" class="hf" >{{$message}}</span>
                                    </div>
                                @enderror          
                        </div>   

                 </div>
              
                
               
            </div>
            <div class="col-md-6">
                        
                        <div class="row">
                 
                        
                        <div class="col-md-12">
                                    <h6 class="af ">Rules:</h6>  
                                    <textarea name="rulesandregulation" placeholder="State the Rules and Regulation of the Sport or Event" class="savetext clear form-control  mb-2 @error('rulesandregulation') is-invalid  @enderror" id="" cols="8" rows="8" style="font-size: 13px;resize:none;width:100%;" data-id="{{$row->id}}" data-name="rules_regulation">{{$row->rules_regulation}}</textarea>    
                                    @error('rulesandregulation') 
                                    <div class="invalid-feedback mb-2">
                                           <span style="font-:size:11px" class="hf" >{{$message}}</span>
                                    </div>
                                @enderror  
                        </div>
                        <div class="col-md-12">
                                    <h6 class="af ">Requirements:</h6>
                                    <textarea name="requirements"  class="savetext clear form-control mb-2 @error('requirements') is-invalid  @enderror" id="" cols="5" rows="5" style="font-size: 13px;resize:none" data-id="{{$row->id}}" data-name="requirements">{{$row->requirements}}</textarea>    
                                    @error('requirements') 
                                    <div class="invalid-feedback mb-2">
                                           <span style="font-:size:11px" class="hf" >{{$message}}</span>
                                    </div>
                                @enderror          
                        </div>
                        
                        <div class="col-md-12">
                                    <h6 class="af ">Upload Logo or Picture (Optional)</h6>
                                   {{--  <input type="file" name="imgfile" class="form-control mb-2 " style="font-size: 13px" accept="image/*">  
                                     --}}
                                    <button class="btn btn-light btn-sm form-control text-primary" data-bs-toggle="modal" data-bs-target="#exampleModal"> Choose File <i class="fas fa-file"></i></button>


          
          <!-- Modal -->
          <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-sm">
              <div class="modal-content">
                <div class="modal-header">
                 
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <form action="{{route('e.savelogo')}}" method="POST" enctype="multipart/form-data">@csrf
                <div class="modal-body">
                        <h6 class="hf">Browse Image</h6>
                        <input type="file" name="imgfile" class="form-control mb-2 " style="font-size: 13px" accept="image/*" required>
                        <input type="hidden" value="{{$row->id}}" name="id">
                </div>
                <div class="modal-footer">
                
                  <button type="submit" class="btn btn-dark btn-sm">Upload</button>
                </div>
            </form>
              </div>
            </div>
          </div>

                        </div>
                      
                        </div>   

            </div>
            </div>  
            
           
            </div> 


       
   </div>
   @endforeach    
   <script>
            $('.savetext').focusout(function(){
            var id = $(this).data('id');
            var name = $(this).data('name');
            var newval = $(this).val();
                        
             
            $.ajax({
                  url:"{{route('e.updateevent')}}",
                  method:"GET", 
                  data  : {id:id,name:name,newval:newval},
                  success :function(data){
                   
                  }

              })

            })

            $('.savechange').change(function(){
            var id = $(this).data('id');
            var name = $(this).data('name');
            var newval = $(this).val();

            $.ajax({
                  url:"{{route('e.updateevent')}}",
                  method:"GET", 
                  data  : {id:id,name:name,newval:newval},
                  success :function(data){
                   
                  }

              })
                                 
            })
   </script>
@endsection