@extends('layouts.event_layout')
@section('content')
<div class="container">
            <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-8">
                                   
                                   

                                    @foreach ($data as $row )
                                    <h5 class="hf">Updating {{$name}} Account with Email({{$row->email}})</h5>
                             
                                    <hr>
                                  
                   <form action="{{route('e.update_coordinator')}}" method="post">
                                                @csrf

                                            <input type="hidden" name="id" value="{{$row->id}}">   
                                    <h6 class="af fs">Email:</h6>
                                    <input type="email" name="email" class="fs af mb-2 form-control   @error('email') is-invalid @enderror" readonly required value=" {{$row->email}}">       
                                    @error('email')
                                    <div class="invalid-feedback af mb-2">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror     
                                    <h6 class="af fs">Name:</h6>
                                    <input type="text" name="name" class="fs af mb-2 form-control  @error('name') is-invalid @enderror " required value=" {{$row->name}}">
                                    <h6 class="af fs">Address:</h6>
                                    <textarea name="address" id=""  cols="30" class="form-control fs mb-2" style="resize: none" rows="3" required> {{$row->address}}</textarea>
                                    <h6 class="af fs">Contact No:</h6>
                                    <input type="text" name="contactno" class="fs af mb-2 form-control @error('contactno') is-invalid @enderror" value=" {{$row->contactno}}" required>
                                    @error('contactno')
                                    <div class="invalid-feedback af mb-4">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror    

                                @if($name =='Student')
                               
                                <input type="hidden" name="usertype" value="student">
                                @elseif($name=='Coordinator')
                                <input type="hidden" name="usertype" value="coordinator">


                                @else 
                                <input type="hidden" name="usertype" value="Admin">
                                <input type="hidden" name="college" value="{{$row->CollegeId}}">
                                @endif

                                @if($name =='Admin')

                                    @else

                                    <h6 class="af fs">College:</h6>
                                    <select name="college" id="" value="{{$row->CollegeId}}" class="fs af form-select mb-2">
                                        @if($name =='Coordinator')
                                        @foreach ($default_college as $dfc )
                                            <option value="{{$dfc->id}}">{{$dfc->name}}</option>
                                        @endforeach
                                        @foreach ($college as $col )
                                      
                                            <option value="{{$col->id}}">{{$col->name}}</option>
                                        @endforeach


                                        @elseif($name =='Student')
                                 
                                        @foreach ($default_college as $dfc )
                                        <option value="{{$dfc->id}}">{{$dfc->name}}</option>
                                    @endforeach
                                    @foreach ($college as $col )
                                  
                                        <option value="{{$col->id}}">{{$col->name}}</option>
                                    @endforeach
                                          
                                        @endif
                                          
                                        </select>  
                               
                             
                                

                                @endif

                                

                                <h6 class="af fs">Password:</h6>
                                <input type="text" name="password" class="fs af mb-2 form-control " value="">
                                <span class="text-danger " style="font-size:13px">Put a Value to change the Password.</span><br>

                                      
                                          <button type="button" class="btn btn-danger mt-4 btn-sm af " onclick="window.history.back()">Cancel</button>
                                          <button type="submit" class="btn btn-secondary mt-4 btn-sm af">Update</button>
                                        
                                    </form>
                                    @endforeach
                        </div>
                        <div class="col-md-3"></div>
            </div>
</div>
@endsection