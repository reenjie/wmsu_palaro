@extends('layouts.app')

@section('content')

<div class="container">
    
    <div class="row justify-content-center">
        <div class="col-md-8">
          
           

              
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <h4 class="hf" style="font-weight: bold">Login</h4>
                        <br>
                     
                            <label for="email" class="text-md-end af">{{ __('Email ') }}</label>

                         
                                <input id="email" type="email" class="form-control af mb-2 @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>

                                @error('email')
                                    <span class="invalid-feedback af" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                           
                       
                        
                            <label for="password" class="af text-md-end">{{ __('Password') }}</label>

                                <input id="password" type="password" class="form-control af @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">

                                @error('password')
                                    <span class="invalid-feedback af" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                           

                    
                         
                                <div class="form-check mb-4">
                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>

                                    <label class="af form-check-label" for="remember">
                                        {{ __('Remember Me') }}
                                    </label>
                                </div>
                           
                       

                      
                                @if (Route::has('password.request'))
                                <a class="btn btn-link af" style="font-size: 14px" href="{{ route('password.request') }}">
                                    {{ __('Forgot Your Password?') }}
                                </a>
                            @endif
                        
                                <button type="submit" id="btn-login" class="af ">
                                    {{ __('Login') }}
                                </button>

                                <a href="/register" style="text-decoration: none;font-size:14px" class="btn btn-link af mt-2"  >Not yet Registered?</a>
                              
                        
                    </form>
                
           
        </div>
    </div>
</div>
@endsection
