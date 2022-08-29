@extends('layouts.coordinator_layout')
@section('content')

            <div class="container">
                        <h5 class="af">My Profile</h5>
                      {{--   {{ Auth::user()->name }}
                        {{ Auth::user()->email }}
                        {{ Auth::user()->password }}
                        {{ Auth::user()->id }} --}}
                      <div class="row mt-5">
                        <div class="col-md-1"></div>
                        <div class="col-md-6">
                                    <div class="card shadow-sm">
                                     <div class="card-body">
                                                @if (Session::get('Success'))
                                                <div class="alert alert-success alert-dismissable">
                                                    <strong class="hf">{{ Session::get('Success') }}</strong>
                                                    <button type="button" style="float:right" class="btn-close" data-bs-dismiss="alert"
                                                        aria-label="Close"></button>
                                                </div>
                                            @endif
                             <div class="container py-5" style="text-align: center">
                                    <h4 class="hf text-primary" style="font-weight:bold">{{Auth::user()->name}}</h4>
                                    <h6 class="fs af">{{Auth::user()->email}}</h6>
                                   
                                    <h6 class="af">
                                                {{Auth::user()->address}}  
                                                <br>
                                                {{Auth::user()->contactno}}   
                                                <br>
                                                <hr>
                                              College Coordinator    

                                    </h6>
                             </div>

                                      </div>
                                    </div>
                        </div>
                        <div class="col-md-2">
                                   
                                                <a href="update-account/{{Auth::user()->id}}/Admin" class="form-control btn btn-light text-secondary border-secondary mb-2">UPDATE</a>
 
                                                <a href="{{route('admin.logout')}}" class="form-control btn btn-light text-danger border-secondary">Logout <i class="fas fa-door-open"></i></a>
                                    
                        </div>

                      </div>


            </div>

@endsection