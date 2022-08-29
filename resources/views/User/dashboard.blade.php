@extends('layouts.user_layout')
@section('content')
    <div class="container">
        <h5 class="hf mb-3" style="font-weight: bold">Dashboard</h5>

        <div class="row mb-5">
            <div class="col-md-4 mb-2">
                <div class="card shadow-sm " style="background-color: rgba(47, 69, 102, 0.877);height:100px">
                    <div class="card-body">
                        <h5 class="hf text-light">My Events</h5>
                        <h6 class="af text-light" style="font-size:14px;">
                            <span class="badge bg-light text-dark" style="font-size:17px">{{ count($sport) }}</span>
                        </h6>
                        <i class="dashboardbanner fas fa-basketball" style="font-size:50px"></i>
                    </div>
                </div>
            </div>

            <div class="col-md-4 mb-2">
                <div class="card shadow-sm " style="background-color: rgba(16, 53, 8, 0.877);height:100px">
                    <div class="card-body">
                        <h5 class="hf text-light">College Sport/Events</h5>
                        <h6 class="af text-light" style="font-size:14px;">
                            <span class="badge  text-light" style="font-size:17px">{{ count($events) }}</span> Overall Count
                        </h6>
                        <i class="dashboardbanner fas fa-baseball" style="font-size:50px"></i>
                    </div>
                </div>
            </div>

            <div class="col-md-4">
                <div class="card shadow-sm " style="background-color: rgba(97, 14, 14, 0.877);height:100px">
                    <div class="card-body">
                        <h5 class="hf text-light">My Status</h5>
                        <h6 class="af text-light" style="font-size:14px;">
                            <span class="badge bg-light text-dark" style="font-size:17px"></span>
                            <a href="">Go To</a>
                        </h6>
                        <i class="dashboardbanner fas fa-clock" style="font-size:50px"></i>
                    </div>
                </div>
            </div>

        </div>
        <div class="row">
            <div class="col-md-8">
                <div class="card shadow ">
                    <div class="card-header">
                        <h6 class="hf text-primary">Events Joined</h6>
                    </div>
                    <div class="card-body" style="overflow-y:scroll;height:500px">
                        <div class="row">
                            @if (count($sport))
                                @foreach ($sport as $row)
                                    @php
                                        $src = '';
                                        if ($row->file == '') {
                                            $src = asset('assets/img/wmsu.jpg');
                                        } else {
                                            $src = asset('assets/img') . '/' . $row->file;
                                        }
                                        
                                    @endphp
                                    <div class="col-md-6">
                                        <div class="card shadow bg-light mb-2 "
                                            style="">

                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-5">
                                                        <h6 class="hf text-danger"
                                                            style="text-align: center;font-weight:bold">

                                                            <img src="{{ $src }}" alt=""
                                                                class="rounded-circle img-thumbnail"
                                                                style="width:100px;height:100px">
                                                            <br>
                                                            {{ $row->name }}

                                                        </h6>
                                                    </div>
                                                    <div class="col-md-7">
                                                            <span class="hf text-secondary" style="font-size:13px">Description</span>
                                                            <hr>
                                                        <span class="text-secondary"
                                                            style="font-size:12px">{{ $row->description }}


                                                        </span>
                                                    </div>
                                                </div>


                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <h6 style="text-align: center">
                                    <img src="{{ asset('assets/img/wmsu.jpg') }}" alt="" class="rounded-circle">
                                    <br>
                                    No Joined Events yet..
                                </h6>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card shadow">
                    <div class="card-header">
                        <h6 class="hf text-primary">Announcements</h6>
                    </div>
                    <div class="card-body">
                        @foreach ($announcement as $ann)
                            <a href="javascript:void(0)" class="list-group-item list-group-item-action mb-2"
                                aria-current="true" style="cursor: default">
                                <i class="fas fa-bell text-danger"></i>

                                <div class="d-flex w-100 justify-content-between">


                                    <small style="font-size:11px">
                                        <span style="color: #891f2f"><time class="timeago" datetime="{{ $ann->date_added }}"
                                                title="{{ $ann->date_added }}"></time></span>
                                    </small>
                                </div>

                                <br>
                                <p class="mb-1 fs text-secondary" style="font-size:13px">{{ $ann->announcement }}</p>

                                <small style="font-size: 11px"></small>
                            </a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>


    <script>
        $(document).ready(function() {
            $("time.timeago").timeago();
        })
        /*   jQuery(document).ready(function() {
             jQuery("time.timeago").timeago();
              }); */
    </script>
@endsection
