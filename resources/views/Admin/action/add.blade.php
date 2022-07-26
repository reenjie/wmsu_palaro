@extends('layouts.admin_layout')
@section('content')
<div class="container">
            <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-8">
                                    
                                    <h5 class="hf">Add new  
                                        @if($name == 'coordinator')
                                        Sports/Event Coordinator
                                        @elseif($name == 'student')
                                        Students
                                        @endif

                                    </h5>

                               
                                    <hr>
                                  
                                    <form action="{{route('admin.addcoordinator')}}" method="post">
                                                @csrf

                                               
                                    <h6 class="af fs">Email:</h6>
                                    <input type="email" name="email" class="fs af mb-2 form-control @error('email') is-invalid @enderror" required value="{{old('email')}}">       
                                    @error('email')
                                    <div class="invalid-feedback af mb-2">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror     
                                    <h6 class="af fs">Name:</h6>
                                    <input type="text" name="name" class="fs af mb-2 form-control  @error('name') is-invalid @enderror " required value="{{old('name')}}">
                                    <h6 class="af fs">Address:</h6>
                                    <textarea name="address" id=""  cols="30" class="form-control fs mb-2" style="resize: none" rows="3" required>{{old('address')}}</textarea>
                                    <h6 class="af fs">Contact No:</h6>
                                    <input type="text" name="contactno" class="fs af mb-2 form-control @error('contactno') is-invalid @enderror" value="{{old('contactno')}}" required>
                                    @error('contactno')
                                    <div class="invalid-feedback af mb-2">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror    
                              
                                    @if($name =='student')
                                    <input type="hidden" name="usertype" value="student">
                                    @else
                                    <input type="hidden" name="college" value="0">
                                    <input type="hidden" name="usertype" value="coordinator">
                                    @endif

                                    <h6 class="af fs">College:</h6>
                                    <select name="college" id="" class="af form-select mb-5">
                                        @foreach ($data as $college )
                                        <option value="{{$college->id}}">{{$college->name}}</option>
                                        @endforeach
                                        
                                      
                                    </select>
                                     
                                      
                                          <button type="button" class="btn btn-danger btn-sm af " onclick="window.history.back()">Cancel</button>
                                          <button type="submit" class="btn btn-dark btn-sm af">Submit</button>
                                        
                                    </form>
                        </div>
                        <div class="col-md-3"></div>
            </div>
</div>
@endsection