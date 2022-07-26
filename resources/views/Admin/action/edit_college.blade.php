@extends('layouts.admin_layout')
@section('content')
<div class="container">
            <div class="row">
                        <div class="col-md-1"></div>
                        <div class="col-md-8">
                                    
                                    <h5 class="hf">
                                    Add College

                                    </h5>

                               
                                    <hr>
                                  @foreach ($data as $row )
                                  <form action="{{route('admin.form_editcollege')}}" method="post">
                                    @csrf
                  <h6 class="af fs">College:</h6>
                  <input id="collegeentry" type="text" name="name" class="form-control af fs mb-5 @error('name') is-invalid  @enderror" value="{{$row->name}}"  required>

                  <input type="hidden" name="id" value="{{$row->id}}">

            @error('name')
                  <div class="invalid-feedback af mb-5">
                      <strong>College Already Exist..</strong>
                  </div>
              @enderror   

                       
                  <button type="button" class="btn btn-danger btn-sm af " onclick="window.location.href='{{route('admin.colleges')}}'">Cancel</button>
                  <button type="submit" class="btn btn-secondary btn-sm af">Update</button>
                                    


                        </form>
                                  @endforeach
                              
                        </div>
                        <div class="col-md-3"></div>
            </div>
</div>
<script>
$('#collegeentry').keyup(function(){
            $(this).removeClass('is-invalid');
})
</script>
@endsection