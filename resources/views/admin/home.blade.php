{{--@extends('layouts.app')--}}

{{--@section('content')--}}
{{--<div class="container">--}}
{{--    <div class="row justify-content-center">--}}
{{--        <div class="col-md-8">--}}
{{--            <div class="card">--}}
{{--                <div class="card-header">{{ __('Dashboard') }}</div>--}}

{{--                <div class="card-body">--}}
{{--                    @if (session('status'))--}}
{{--                        <div class="alert alert-success" role="alert">--}}
{{--                            {{ session('status') }}--}}
{{--                        </div>--}}
{{--                    @endif--}}

{{--                    {{ __('You are logged in!') }}--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
{{--@endsection--}}
@extends('admin.layouts.main')

@section('content')

    {{--                Welcome Back Row --}}
    {{--    <div class="row">--}}
    {{--        <div class="col-md-12 grid-margin">--}}
    {{--            <div class="d-flex justify-content-between flex-wrap">--}}
    {{--                <div class="d-flex align-items-end flex-wrap">--}}
    {{--                    <div class="mr-md-3 mr-xl-5">--}}
    {{--                        <h2>Welcome back,</h2>--}}
    {{--                        <p class="mb-md-0">Your analytics dashboard template.</p>--}}
    {{--                    </div>--}}
    {{--                    <div class="d-flex">--}}
    {{--                        <i class="mdi mdi-home text-muted hover-cursor"></i>--}}
    {{--                        <p class="text-muted mb-0 hover-cursor">&nbsp;/&nbsp;Dashboard&nbsp;/&nbsp;</p>--}}
    {{--                        <p class="text-primary mb-0 hover-cursor">Analytics</p>--}}
    {{--                    </div>--}}
    {{--                </div>--}}
    {{--                <div class="d-flex justify-content-between align-items-end flex-wrap">--}}
    {{--                    <button type="button" class="btn btn-light bg-white btn-icon mr-3 d-none d-md-block ">--}}
    {{--                        <i class="mdi mdi-download text-muted"></i>--}}
    {{--                    </button>--}}
    {{--                    <button type="button" class="btn btn-light bg-white btn-icon mr-3 mt-2 mt-xl-0">--}}
    {{--                        <i class="mdi mdi-clock-outline text-muted"></i>--}}
    {{--                    </button>--}}
    {{--                    <button type="button" class="btn btn-light bg-white btn-icon mr-3 mt-2 mt-xl-0">--}}
    {{--                        <i class="mdi mdi-plus text-muted"></i>--}}
    {{--                    </button>--}}
    {{--                    <button class="btn btn-primary mt-2 mt-xl-0">Download report</button>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </div>--}}

    {{--                Overview Row --}}
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body dashboard-tabs p-0">
{{--                    <ul class="nav nav-tabs px-4" role="tablist">--}}
{{--                        <li class="nav-item">--}}
{{--                            <a class="nav-link active" id="overview-tab" data-toggle="tab" href="#overview" role="tab" aria-controls="overview" aria-selected="true">Overview</a>--}}
{{--                        </li>--}}
{{--                        <li class="nav-item">--}}
{{--                            <a class="nav-link" id="sales-tab" data-toggle="tab" href="#sales" role="tab" aria-controls="sales" aria-selected="false">Sales</a>--}}
{{--                        </li>--}}
{{--                        <li class="nav-item">--}}
{{--                            <a class="nav-link" id="purchases-tab" data-toggle="tab" href="#purchases" role="tab" aria-controls="purchases" aria-selected="false">Purchases</a>--}}
{{--                        </li>--}}
{{--                    </ul>--}}
                    <div class="tab-content py-0 px-0">
                        <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview-tab">
                            <div class="d-flex flex-wrap justify-content-xl-between">
                                <div class="d-none d-xl-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                    <i class="mdi mdi-account icon-lg mr-3 text-primary"></i>
                                    <div class="d-flex flex-column justify-content-around">
                                        <small class="mb-1 text-muted">Total Users</small>
                                        <div class="dropdown">
{{--                                            <a class="btn btn-secondary dropdown-toggle p-0 bg-transparent border-0 text-dark shadow-none font-weight-medium" href="#" role="button" id="dropdownMenuLinkA" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
                                                <h5 class="mb-0 d-inline-block">{{@$total_users}}</h5>
{{--                                            </a>--}}
{{--                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuLinkA">--}}
{{--                                                <a class="dropdown-item" href="#">12 Aug 2018</a>--}}
{{--                                                <a class="dropdown-item" href="#">22 Sep 2018</a>--}}
{{--                                                <a class="dropdown-item" href="#">21 Oct 2018</a>--}}
{{--                                            </div>--}}
                                        </div>
                                    </div>
                                </div>
                                <div class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                    <i class="mdi mdi-account-circle mr-3 icon-lg text-success"></i>
                                    <div class="d-flex flex-column justify-content-around">
                                        <small class="mb-1 text-muted">Active Users</small>
                                        <h5 class="mr-2 mb-0">{{@$active_users}}</h5>
                                    </div>
                                </div>
                                <div class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                    <i class="mdi mdi-star mr-3 icon-lg text-warning"></i>
                                    <div class="d-flex flex-column justify-content-around">
                                        <small class="mb-1 text-muted">Verify Users</small>
                                        <h5 class="mr-2 mb-0">{{@$verify_users}}</h5>
                                    </div>
                                </div>
                                <div class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                    <i class="mdi mdi-account-multiple mr-3 icon-lg text-secondary"></i>
                                    <div class="d-flex flex-column justify-content-around">
                                        <small class="mb-1 text-muted">Total Groups</small>
                                        <h5 class="mr-2 mb-0">{{@$total_groups}}</h5>
                                    </div>
                                </div>
                                <div class="d-flex py-3 border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                    <i class="mdi mdi-image-multiple mr-3 icon-md text-primary"></i>
                                    <div class="d-flex flex-column justify-content-around">
                                        <small class="mb-1 text-muted">Admin Tips</small>
                                        <h5 class="mr-2 mb-0">{{@$total_admin_tips}}</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{--                Graph Row   --}}
    {{--    <div class="row">--}}
    {{--        <div class="col-md-7 grid-margin stretch-card">--}}
    {{--            <div class="card">--}}
    {{--                <div class="card-body">--}}
    {{--                    <p class="card-title">Cash deposits</p>--}}
    {{--                    <p class="mb-4">To start a blog, think of a topic about and first brainstorm party is ways to write details</p>--}}
    {{--                    <div id="cash-deposits-chart-legend" class="d-flex justify-content-center pt-3"></div>--}}
    {{--                    <canvas id="cash-deposits-chart"></canvas>--}}
    {{--                </div>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--        <div class="col-md-5 grid-margin stretch-card">--}}
    {{--            <div class="card">--}}
    {{--                <div class="card-body">--}}
    {{--                    <p class="card-title">Total sales</p>--}}
    {{--                    <h1>$ 28835</h1>--}}
    {{--                    <h4>Gross sales over the years</h4>--}}
    {{--                    <p class="text-muted">Today, many people rely on computers to do homework, work, and create or store useful information. Therefore, it is important </p>--}}
    {{--                    <div id="total-sales-chart-legend"></div>--}}
    {{--                </div>--}}
    {{--                <canvas id="total-sales-chart"></canvas>--}}
    {{--            </div>--}}
    {{--        </div>--}}
    {{--    </div>--}}
    {{--                RECENT PURCHASES TABLE--}}
    <div class="row">
        <div class="col-md-12 stretch-card">
            <div class="card">
                <div class="card-body">
                    <p class="card-title">Recent Users </p>
                    <div class="table-responsive">
                        <table class="table selfDataTable">
                            <thead>
                            <tr>
                                <th>Name</th>
                                <th>Posts</th>
                                <th>Likes/Saved</th>
                                <th>Comments</th>
                                <th>Created At</th>
                                <th>Action</th>
                            </tr>
                            </thead>
                            <tbody>
                        @if(sizeof($users)>0)
                            @foreach($users as $u => $row)
                                <tr>
                                <td>{{@$row->name}}</td>
                                <td>{{count(@$row->posts)}}</td>
                                <td>{{count(@$row->likes)}}</td>
                                <td>{{count(@$row->comments)}}</td>
                                <td>{{\Carbon\Carbon::parse(@$row->created_at)->format('d-M-Y')}}</td>
                                <td><a href="{{route('admin.userPosts',[@$row->uuid])}}" title="View User Posts" class="mdi mdi-eye text-lg-center" style="margin-left: 28px; font-size: 20px"></a></td>
                            </tr>
                            @endforeach
                        @endif

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{--                END OF RECENT PURCHASES--}}

@endsection
