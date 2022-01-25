@extends('admin.layouts.main')
@section('title')
    User Penpals
@endsection
@push('style')
<style>
    .card-horizontal {
        display: flex;
        flex: 1 1 auto;
    }
</style>
@endpush
@section('content')

{{--    <div class="card">--}}
{{--        <h5 class="card-header">{{@$user->name}}</h5>--}}
{{--        <div class="card-body">--}}
{{--            <img class="card-img" @if(@$user->image) src="{{asset('storage/'.@$user->image)}}" @else src="{{asset('user_avatar.png')}}" @endif>--}}
{{--            <h5 class="card-title">Special title treatment</h5>--}}
{{--            <p class="card-text">With supporting text below as a natural lead-in to additional content.</p>--}}
{{--            <a href="#" class="btn btn-primary">Go somewhere</a>--}}
{{--        </div>--}}
{{--    </div>--}}


    <div class="row">
        <div class="col-12 mt-3">
            <div class="card">
                <div class="card-header">
                        {{strtoupper(@$user->name)}}
                </div>
                <div class="card-horizontal">
                    <div class="img-square-wrapper" style="width: 24%">
                        <img class="m-3"  @if(@$user->image) src="{{asset('storage/'.@$user->image)}}" @else src="{{asset('assets/user_avatar.png')}}" @endif  alt="Card image cap" >
                    </div>
                    <div class="card-body">
                        <h4 class="card-title">Email: <span>{{@$user->email}}</span></h4>
                        <p class="card-text">Contact Number: <span>{{@$user->contact_no}}</span></p>
                        @if(@$user->status == 'suspend')
                            <a href="{{route('admin.changeStatus',['uuid'=>@$user->uuid, 'status'=>'active'])}}" class="btn btn-success btn-sm mt-2 user-status-btn tooltip2">
                                Activate User
                            </a>
                        @elseif(@$user->status == 'active')
                            <a href="{{route('admin.changeStatus',['uuid'=>@$user->uuid, 'status'=>'suspend'])}}"  class="btn btn-danger btn-sm mt-2  user-status-btn tooltip2">
                                Suspend User
                            </a>
                        @endif

                        @if(@$user->verify_user == 1)
                            <a href="{{route('admin.verifyUser',['uuid'=>@$user->uuid, 'verify'=> 0 ])}}"  class="btn btn-warning btn-sm mt-2 user-status-btn tooltip2">
                                Refute User
                            </a>
                        @else
                            <a href="{{route('admin.verifyUser',['uuid'=>@$user->uuid, 'verify'=> 1 ])}}"  class="btn btn-warning btn-sm mt-2 user-status-btn tooltip2">
                                Verify User
                            </a>
                        @endif
                    </div>
                </div>
                <div class="card-footer">
                    <small class="text-muted float-right">Last updated {{@$user->updated_at->diffForHumans()}}</small>
                </div>
            </div>
        </div>
    </div>


    <div class="row text-center mt-5">
        <!-- Team item -->
        @if(sizeof(@$penpal_arr) > 0)
            @foreach($penpal_arr as $p => $p_row)

        <div class="col-xl-3 col-sm-6 mb-5 ml-5">
            <div class="bg-white rounded shadow-sm py-5 px-4">
                <img @if(@$p_row['penpal_details']->image) src="{{asset('storage/'.@$p_row['penpal_details']->image)}}" @else src="{{asset('assets/user_avatar.png')}}" @endif  alt="" width="100"  class="img-fluid rounded-circle mb-3 img-thumbnail shadow-sm" style="height: 110px; width: 120px;">
                <h5 class="mb-0">{{strtoupper(@$p_row['penpal_details']->name)}}</h5><span class="small text-uppercase text-muted">{{@$p_row['penpal_details']->email}}</span>
                <h4><span class="small text-uppercase text-muted">@if($p_row['penpal_details']->contact_no) {{@$p_row['penpal_details']->contact_no}} @else 000-000-0000 @endif</span></h4>
                <ul class="social mb-0 list-inline mt-3">
                    <li class="list-inline-item">
                        @if(@$p_row['penpal_details']->status == 'suspend')
                            <a href="{{route('admin.changeStatus',['uuid'=>@$p_row['penpal_details']->uuid, 'status'=>'active'])}}" class="user-status-btn tooltip2">
                                <i class="mdi mdi-account" style="color: #71c016" ></i>
                                <span class="tooltiptext2">Activate</span>
                            </a>
                        @elseif(@$p_row['penpal_details']->status == 'active')
                            <a href="{{route('admin.changeStatus',['uuid'=>@$p_row['penpal_details']->uuid, 'status'=>'suspend'])}}"  class="user-status-btn tooltip2">
                                <i class="mdi mdi-account-off" style="color: red" ></i>
                                <span class="tooltiptext2">Suspend</span>

                            </a>
                        @endif
                    </li>
                    <li class="list-inline-item">
                        @if(@$p_row['penpal_details']->verify_user == 1)
                            <a href="{{route('admin.verifyUser',['uuid'=>@$p_row['penpal_details']->uuid, 'verify'=> 0 ])}}"  class="user-status-btn tooltip2">
                                <i class="mdi mdi-star" style="color: #FFD139"></i>
                                <span class="tooltiptext2">Refute</span>
                            </a>
                        @else
                            <a href="{{route('admin.verifyUser',['uuid'=>@$p_row['penpal_details']->uuid, 'verify'=> 1 ])}}"  class="user-status-btn tooltip2">
                                <i class="mdi mdi-star-outline" style="color: #FFD139"></i>
                                <span class="tooltiptext2">Verify</span>
                            </a>
                        @endif
                    </li>
                    <li class="list-inline-item">
                        <a href="{{route('admin.userPosts',['uuid'=>$p_row['penpal_details']->uuid])}}" class="user-status-btn tooltip2" style="{color: white; padding-bottom: 6px; margin-top: -10px;}">
                            <i class="mdi mdi-panorama" style="color: #2e47a2"></i>
                            <span class="tooltiptext2">View Posts - {{count(@$p_row['penpal_details']->posts)}}</span>
                        </a>
                    </li>
                    <li class="list-inline-item">
                        <a href="{{route('admin.userPenpals',['uuid'=>$p_row['penpal_details']->uuid])}}" class="user-status-btn tooltip2" style="{color: white; padding-bottom: 6px; margin-top: -10px;}">
                            <i class="mdi mdi-account-multiple" style="color: #5fdc00" ></i>
                            <span class="tooltiptext2">View Penpals - {{count(@$p_row['penpal_details']->posts)}}</span>
                        </a>
                    </li>
                </ul>
            </div>
        </div><!-- End -->
            @endforeach
        @endif
    </div>


@endsection
