@extends('layouts.admin_layout')
@section('content')

   <div class="container">
            
        <h6 class="af mb-3" style="font-weight:bold;font-size:18px">ADD SPORTS/EVENTS</h6>
        
          <div class="card shadow-sm bg-transparent">
            <div class="card-body">
              <form action="{{route('admin.add_sports')}}" method="post" enctype="multipart/form-data">
                     @csrf
             
            <div class="container">
                        <a href="{{route('admin.sportevents')}}" class="btn btn-dark btn-sm">Back</a>
                        
            <div class="row mt-3">
            <div class="col-md-6">
              <h6 class="af "> Type :</h6>     
              <select name="istype" id="" class="form-select mb-2">
                     <option value="sport">Sports</option>
                     <option value="esports">Esports</option>

              </select>

                 <h6 class="af "> Sports/Event Name:</h6>      
                 <input type="text" name="eventname" class="clear form-control mb-2 @error('eventname') is-invalid  @enderror " style="font-size: 13px" value="{{old('eventname')}}">
                 @error('eventname') 
                     <div class="invalid-feedback mb-2">
                            <span style="font-:size:11px" class="hf" >{{$message}}</span>
                     </div>
                 @enderror
                 <h6 class="af ">DATE</h6>    
                 <div class="row">
                        <div class="col-md-6">
                                    <h6 class="af ">Start</h6> 
                                    <input type="date" class="clear form-control mb-2 @error('datestart') is-invalid  @enderror " style="font-size: 13px" name="datestart" value="{{old('datestart')}}">
                                    @error('datestart') 
                                    <div class="invalid-feedback mb-2">
                                           <span style="font-:size:11px" class="hf" >{{$message}}</span>
                                    </div>
                                @enderror
                        </div>
                        <div class="col-md-6">

                                    <h6 class="af ">End</h6> 
                                    <input type="date" class="clear form-control mb-2 @error('dateend') is-invalid   @enderror" style="font-size: 13px" name="dateend" value="{{old('dateend')}}">
                                    @error('dateend') 
                                    <div class="invalid-feedback mb-2">
                                           <span style="font-:size:11px" class="hf" >{{$message}}</span>
                                    </div>
                                @enderror
                        </div>
                 </div>  

                 <h6 class="af ">Description:</h6>      
                
                 <textarea name="description" class="clear form-control mb-2 @error('description') is-invalid  @enderror" id="" cols="5" rows="5" style="font-size: 13px;resize:none">{{old('description')}}</textarea>
                 @error('description') 
                 <div class="invalid-feedback mb-2">
                        <span style="font-:size:11px" class="hf" >{{$message}}</span>
                 </div>
             @enderror
                 <h6 class="hf" style="font-weight: bold">Rules and Regulations</h6>  

                 <div class="row">
                     <div class="col-md-6">
                            <h6 class="af ">Maximum number of Participants:</h6>
                            <input type="number" name="numofparticipants" class="form-control mb-2  " style="font-size: 13px" value="3" min="3">           
                </div>      
                <div class="col-md-6">
                            <h6 class="af ">Type of Round:</h6>
                               
                            <select name="numofrounds" style="font-size: 13px" id="" class="form-select">
                                   <option value="Innings">Innings</option>
                                   <option value="Quarters">Quarters</option>
                                   <option value="Sets">Sets</option>
                                   <option value="Rounds">Rounds</option>
                                   <option value="Halves">Halves</option>
                            </select>
                            
                            {{-- Innings
Quarters
Sets
Rounds
Halves --}}
                </div>  

                <h6 class="hf ">TIME per Day</h6>
                        
                        <div class="col-md-6">
                                    <h6 class="af ">Start</h6>
                                    <input type="time" class="clear form-control mb-2  @error('timestart') is-invalid  @enderror" style="font-size: 13px" name="timestart" value="{{old('timestart')}}">   
                                    @error('timestart') 
                                    <div class="invalid-feedback mb-2">
                                           <span style="font-:size:11px" class="hf" >{{$message}}</span>
                                    </div>
                                @enderror         
                        </div>   

                        <div class="col-md-6">
                                    <h6 class="af ">End</h6>
                                    <input type="time" class="clear form-control mb-2  @error('timeend') is-invalid  @enderror" style="font-size: 13px" name="timeend" value="{{old('timeend')}}" >  
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
                                    <h6 class="af "></h6>  
                                    <textarea name="rulesandregulation" placeholder="State the Rules and Regulation of the Sport or Event" class="clear form-control mb-2 @error('rulesandregulation') is-invalid  @enderror" id="" cols="8" rows="8" style="font-size: 13px;resize:none">{{old('rulesandregulation')}}</textarea>    
                                    @error('rulesandregulation') 
                                    <div class="invalid-feedback mb-2">
                                           <span style="font-:size:11px" class="hf" >{{$message}}</span>
                                    </div>
                                @enderror  
                        </div>
                        <div class="col-md-12">
                                    <h6 class="af ">Requirements:</h6>
                                    <textarea name="requirements"  class="clear form-control mb-2 @error('requirements') is-invalid  @enderror" id="" cols="5" rows="5" style="font-size: 13px;resize:none">{{old('requirements')}}</textarea>    
                                    @error('requirements') 
                                    <div class="invalid-feedback mb-2">
                                           <span style="font-:size:11px" class="hf" >{{$message}}</span>
                                    </div>
                                @enderror          
                        </div>
                        
                        <div class="col-md-12">
                                    <h6 class="af ">Upload Logo or Picture (Optional)</h6>
                                    <input type="file" name="imgfile" class="form-control mb-2 " style="font-size: 13px" accept="image/*">       

                        </div>
                      
                        </div>   

            </div>
            </div>  
            
            <button class="mt-3 btn btn-dark form-control">Submit</button>
            </div> 
       </form>     
            </div>
          </div>

        
   </div>
   <script>
       $('.clear').keyup(function(){
              $(this).removeClass('is-invalid');
       })
       $('.clear').change(function(){
              $(this).removeClass('is-invalid');
       })
   </script>
@endsection