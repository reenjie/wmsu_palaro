@extends('layouts.app')

@section('content')
    <div class="container">
      
    
    <div class="row justify-content-center">
        <div class="col-md-8">

        <form method="POST" action="{{ route('register') }}">
            @csrf

            <h4 class="hf" style="font-weight: bold">Register</h4>
            <br>
                <label for="name" class="af col-form-label text-md-end">{{ __('Name') }}</label>

           
                    <input id="name" type="text" class="af form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>

                    @error('name')
                        <span class="invalid-feedback af" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
               

         
                <label for="email" class="af col-form-label text-md-end">{{ __('Email Address') }}</label>

             
                    <input id="email" type="email" class="af form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                    @error('email')
                        <span class="invalid-feedback af" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
              

         
                <label for="password" class="af col-form-label text-md-end">{{ __('Password') }}</label>

            
                    <input id="password" type="password" class="af form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                    @error('password')
                        <span class="invalid-feedback af" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
             
          

           
                <label for="password-confirm" class="af col-form-label text-md-end">{{ __('Confirm Password') }}</label>

             
                    <input id="password-confirm" type="password" class="form-control af" name="password_confirmation" required autocomplete="new-password">
             

           
               
                    <button type="submit" id="btn-login" class="mt-3 af">
                        {{ __('Register') }}
                    </button>

                    <a href="/login" style="text-decoration: none;font-size:14px" class="btn btn-link af mt-2"  >Already have an Account?</a>
               
        </form>
        </div>
    </div>


    </div>
        
                  
      

@endsection
