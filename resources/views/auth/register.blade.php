@extends('layouts.app')

@section('content')
    <div class="container">
      
    
    <div class="row justify-content-center" style="overflow:scroll;height:500px;overflow-x:hidden">
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


                    <label for="contact" class="af col-form-label text-md-end">{{ __('Contact No.') }}</label>

             
                    <input id="contact" type="text"  onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57)) " class="af form-control @error('contact') is-invalid @enderror" maxlength="11"  name="contact"  value="{{ old('contact') }}" required >

                    @error('contact')
                        <span class="invalid-feedback af" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                        
                    <label for="address" class="af col-form-label text-md-end">{{ __('Address') }}</label>
                       
             
                 
                    <textarea style="resize: none" name="address" class="form-control @error('address') is-invalid @enderror " id="" cols="4" rows="4" required>{{old('address')}}</textarea>

                    @error('address')
                        <span class="invalid-feedback af" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror

                    @php
                        use App\Models\College;
                        $college = College::all();
                    @endphp

        <label for="college" class="af col-form-label text-md-end">{{ __('College') }}</label>
        <select name="college" id="" class="form-select">
            @foreach ($college as $item)
            <option value="{{$item->id}}">{{$item->name}}</option>
                            
            @endforeach
        </select>
                      

                 

         
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
