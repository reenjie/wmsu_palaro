@extends('layouts.coordinator_layout')
@section('content')

   <div class="container">
        <h6 class="af mb-3" style="font-weight:bold;font-size:18px">ANNOUNCEMENTS</h6>
       
        <div class="row">
            <div class="col-md-4">
                <div class="card shadow bg-transparent">
                    <div class="card-body">
                     
                            <h6 class="text-primary hf" style="font-size:14px">Announce Something! <i class="fas fa-bell"></i></h6>

                            <form action="{{route('coordinator.add_announcement')}}" method="post" >
                                @csrf
                            <textarea id="txtann" name="announce" placeholder="Enter something.." class=" af form-control mb-2" style="font-size:13px;resize:none" id="" cols="6" rows="6" required></textarea>

                            <button type="submit" id="addbtn" class="form-control btn-sm btn btn-primary"> Announce </button>
                        </form>
                    </div>
                </div>

                <div class="card shadow bg-transparent mt-3">
                    <div class="card-body">
                     
                            <h6 class="text-primary hf" style="font-size:14px">Update</h6>
                        <form action="{{route('coordinator.edit_announcement')}}" method="post">
                            @csrf
                            <textarea disabled name="e_announce" id="txtupt" data-id="" placeholder="Select one first to update the contents.."  class=" af form-control" style="font-size:13px;resize:none" id="" cols="6" rows="6"></textarea>
                            <input type="hidden" id="a_id" name="aid">
                            <div class="btn-group mt-2">
                            <button type="submit" id="editbtn" class="form-control btn-sm btn btn-info" disabled> Update</button>
                            <button type="button" id="cancelbtn" class="form-control btn-sm btn btn-secondary" disabled> Cancel</button>
                        </div>
                        </form>
                        
                    </div>
                </div>
            </div>
            <div class="col-md-8">
                @if (Session::get('Success'))
                <div class="alert alert-success alert-dismissable">
                    <strong class="hf">{{ Session::get('Success') }}</strong>
                    <button type="button" style="float:right" class="btn-close" data-bs-dismiss="alert"
                        aria-label="Close"></button>
                </div>
            @endif
                @if($counts>=1)
            @foreach ($announcement as $row)
                
        
              
                    
               
                <div class="card shadow-sm mb-2">
                    <div class="card-body">
                        <div class="container">
                            <span style="font-style:italic;font-weight:normal;font-size:13px">
                                <i class="fas fa-bell"></i>
                                <span style="float:right;font-size:11px" class="text-danger">{{
                        date('@h:i a F j, Y',strtotime($row->date_added))
                                }}</span>
                                <br>
                               {{$row->announcement}}</span>
                                <br>
                                <button id="{{$row->id}}" class="select mt-2 btn btn-light btn-sm text-primary" data-id="{{$row->id}}" data-val="{{$row->announcement}}">Select to Update</button>
                                <span style="float: right;margin-top:20px">
                                <div class="btn-group">
                                  
                                    <button  class="btndelete btn-sm btn text-secondary" data-id="{{$row->id}}"><i class="fas fa-trash"></i></button>
                                </div>
                                </span>
                        </div>
                    </div>
                </div>

                @endforeach
                @else
              <h6 style="text-align: center">
                <img src="https://th.bing.com/th/id/OIP.NqaQ8tsZyA625R1Q62wkdwHaDt?pid=ImgDet&rs=1" alt="">
                <br>
               No announcements yet ..
              </h6>
                @endif

            </div>
          

        </div>
   </div>
   <script>
    $('#addbtn').click(function(){
      if($('#txtann').val() == ''){

      }else {
        $(this).html('Posting Announcement .. ').removeClass('btn-primary').addClass('btn-secondary');
      }
       
    })
    $('.btndelete').click(function(){
        var id = $(this).data('id');
        swal({
      title: "Are you sure?",
      text: "Once deleted, you will not be able to recover it",
      icon: "warning",
      buttons: true,
      dangerMode: true,
    })
    .then((willDelete) => {
      if (willDelete) {
       $(this).html('<span style="font-size:11px" class="text-secondary">Deleting..</span>');
        window.location.href='deleteannouncement/'+id;
      } else {
       
      }
    });
    })

    $('.select').click(function(){
        var id = $(this).data('id');
        var val = $(this).data('val');
        $('#editbtn').removeAttr('disabled');
        $('#cancelbtn').removeAttr('disabled');
    $('#a_id').val(id);
    $('#txtupt').removeAttr('disabled').val(val).focus();
    $('.select').html('Select to Update');
       $('#'+id).html('<span style="font-size:11px" class="text-secondary">Updating..</span>');

     
    })
    $('#cancelbtn').click(function(){
        $('#txtupt').val('').attr('disabled',true);
        $('#editbtn').attr('disabled',true);
        $('#cancelbtn').attr('disabled',true);
        $('.select').html('Select to Update');
    })
  
   </script>
@endsection