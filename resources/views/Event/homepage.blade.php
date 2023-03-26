@extends('layouts.event_layout')
@section('content')

<div class="container">
    <h5 class="hf" style="font-weight: bolder">HOMEPAGE</h5>

    <div class="card shadow">
        <div class="card-body">
            <h6 class="text-primary">Carousel</h6>
            <hr>
            @if(Session::get('Success_image'))
                <div class="alert alert-success alert-dismissable">
                    <strong class="hf">{{ Session::get('Success_image') }}</strong>
                    <button type="button" style="float:right" class="btn-close" data-bs-dismiss="alert"
                        aria-label="Close"></button>
                </div>
            @endif
            <button data-bs-toggle="modal" data-bs-target="#exampleModal" class="btn btn-dark btn-sm mb-3 openmodal"
                data-cdata="add">Add Image</button>
            <br>
            <div class="row">

                @if(count($data)>=1)
                    @foreach($data as $row )

                        <div class="col-md-4">
                            <div class="card shadow-sm mb-2">

                                <img src="{{ asset('public/assets/img').'/'.$row->images }}"
                                    class="card-img-top" alt="" style="height: 200px">
                                <div class="card-body">
                                    @if($row->isactive == 1)
                                        <span class="badge bg-success">Active</span>
                                        <br>
                                    @endif
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModal"
                                        class="btn btn-primary btn-sm openmodal" data-cdata="change"
                                        data-id="{{ $row->id }}">Change Photo</a>
                                    @if($row->priority == 0)
                                        <button class="btn btn-light text-danger removeimg" data-id="{{ $row->id }}"
                                            data-img="{{ $row->images }}"
                                            data-active="{{ $row->isactive }}">Remove</button>
                                    @endif

                                </div>

                            </div>
                        </div>
                    @endforeach
                @else
                    <h5 style="text-align: center;font-weight:bold" class="hf">No Carousel Image yet.</h5>
                @endif



            </div>

        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm">
        <div class="modal-content">
            <div class="modal-header">
                <h6 class="modal-title hf" id="exampleModalLabel"><span id="titletext"></span> image</h6>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="{{ route('e.saveimage') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="modal-body">
                    <input type="hidden" id="typo" name="action" value="">
                    <input type="hidden" id="carousel_id" name="id">
                    <input type="file" accept="image/*" class="form-control" name="imgfile" required>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary btn-sm" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary btn-sm">Save</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script>
    $('.openmodal').click(function () {
        var cdata = $(this).data('cdata');
        var id = $(this).data('id');

        $('#titletext').text(cdata);
        $('#carousel_id').val(id);
        $('#typo').val(cdata);
    })
    $('.removeimg').click(function () {
        var id = $(this).data('id');
        var img = $(this).data('img');
        var active = $(this).data('active');
        if (active == 1) {
            swal({
                    title: " WARNING!! Are you sure?",
                    text: "This one is the active carousel. if you remove this all carousel images will be removed as well. Do you still want to proceed?",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        window.location.href = 'removeallimage';
                    } else {

                    }
                });
        } else {
            swal({
                    title: "Are you sure?",
                    text: "Once deleted, you will not be able to recover it",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                .then((willDelete) => {
                    if (willDelete) {
                        window.location.href = 'removeimage/' + id + '/' + img;
                    } else {

                    }
                });

        }

    })

</script>
@endsection
