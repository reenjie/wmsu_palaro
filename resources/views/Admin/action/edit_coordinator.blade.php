@extends('layouts.admin_layout')
@section('content')
<div class="container">
            <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-8">
                                    
                                    <h5 class="hf">Edit Coordinator

                                    </h5>

                               
                                    <hr>
                                  
                                    <form action="{{route('admin.editcoordinator')}}" method="post">
                                                @csrf

                                      @foreach ($data as $row)
                                          
                                    <input type="hidden" name="userid" value="{{$row->id}}">
                                    <h6 class="af fs">Email:</h6>
                                    <input type="email" name="email" class="fs af mb-2 form-control @error('email') is-invalid @enderror" disabled required value="{{$row->email}}">       
                                    @error('email')
                                    <div class="invalid-feedback af mb-2">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror     
                                    <h6 class="af fs">Name:</h6>
                                    <input type="text" name="name" class="fs af mb-2 form-control  @error('name') is-invalid @enderror " required value="{{$row->name}}">
                                    <h6 class="af fs">Address:</h6>
                                    <textarea name="address" id=""  cols="30" class="form-control fs mb-2" style="resize: none" rows="3" required>{{$row->address}}</textarea>
                                    <h6 class="af fs">Contact No:</h6>
                                    <input type="text" name="contactno" class="fs af mb-2 form-control @error('contactno') is-invalid @enderror" value="{{$row->contactno}}" required>
                                    @error('contactno')
                                    <div class="invalid-feedback af mb-2">
                                        <strong>{{ $message }}</strong>
                                    </div>
                                @enderror   
                                
                               {{--  <h6 class="af fs">Sport/Event:</h6>
                                <select name="sportsid" class="form-select mb-5" id="">

                                    @foreach ($events as $item)
                                      <option value="{{$item->id}}">{{$item->name}}</option>
                                    @endforeach
                                </select> --}}
                              

                                 
                                  
                                     
                                      
                                          <button type="button" class="btn btn-danger btn-sm af " onclick="window.history.back()">Cancel</button>
                                          <button type="submit" class="btn btn-dark btn-sm af">Submit</button>
                                          @endforeach             
                                    </form>
                        </div>
                        <div class="col-md-3"></div>
            </div>
</div>
@endsection