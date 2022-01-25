@extends('admin.layouts.main')
@section('title')
    {{__('Users')}}
@endsection

@section('content')

    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Users Table</h4>
{{--                <p class="card-description">--}}
{{--                    Add class <code>.table</code>--}}
{{--                </p>--}}
                <div class="table-responsive">
                    <table class="table table-striped selfDataTable">
                        <thead>
                        <tr>
                            <th>User</th>
                            <th>Name</th>
                            <th>Created</th>
                            <th>Status</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(sizeof($users)> 0)
                            @foreach($users as $u => $row)
                        <tr>
                            <td class="py-1">
                                @if($row->image)
                                    <img src="{{asset('storage/'.@$row->image)}}" alt="{{$row->name}}_image"/>
                                @else
                                    <img src="{{asset('assets/user_avatar.png')}}" alt="{{$row->name}}_image"/>
                                 @endif
                            </td>

                            <td>{{@$row->name}}</td>
                            <td>{{\Carbon\Carbon::parse(@$row->created_at)->format('d-m-Y')}}</td>
                            @if(@$row->status == 'active')
                                <td><label class="badge badge-success">{{@$row->status}}</label></td>
                            @elseif(@$row->status == 'suspend')
                                 <td><label class="badge badge-warning">{{@$row->status}}</label></td>
                            @endif
                            <td>
                            @if(@$row->status == 'suspend')
                                <a href="{{route('admin.changeStatus',['uuid'=>@$row->uuid, 'status'=>'active'])}}" class="user-status-btn tooltip2">
                                    <i class="mdi mdi-account" style="color: #71c016" ></i>
                                    <span class="tooltiptext2">Activate</span>
                                </a>
                            @elseif(@$row->status == 'active')
                                <a href="{{route('admin.changeStatus',['uuid'=>@$row->uuid, 'status'=>'suspend'])}}"  class="user-status-btn tooltip2">
                                    <i class="mdi mdi-account-off" style="color: red" ></i>
                                    <span class="tooltiptext2">Suspend</span>

                                </a>
                            @endif
                            @if(@$row->verify_user == 1)
                                <a href="{{route('admin.verifyUser',['uuid'=>@$row->uuid, 'verify'=> 0 ])}}"  class="user-status-btn tooltip2">
                                    <i class="mdi mdi-star" style="color: #FFD139"></i>
                                    <span class="tooltiptext2">Refute</span>
                                </a>
                            @else
                                <a href="{{route('admin.verifyUser',['uuid'=>@$row->uuid, 'verify'=> 1 ])}}"  class="user-status-btn tooltip2">
                                    <i class="mdi mdi-star-outline" style="color: #FFD139"></i>
                                    <span class="tooltiptext2">Verify</span>
                                </a>
                            @endif
                                <a href="{{route('admin.userPosts',['uuid'=>$row->uuid])}}" class="user-status-btn tooltip2" style="{color: white; padding-bottom: 6px; margin-top: -10px;}">
                                    <i class="mdi mdi-panorama" style="color: #2e47a2"></i>
                                    <span class="tooltiptext2">View Posts - {{count(@$row->posts)}}</span>
                                </a>

                                <a href="{{route('admin.userPenpals',['uuid'=>$row->uuid])}}" class="user-status-btn tooltip2" style="{color: white; padding-bottom: 6px; margin-top: -10px;}">
                                    <i class="mdi mdi-account-multiple" style="color: #5fdc00" ></i>
                                    <span class="tooltiptext2">View Penpals - {{count(@$row->posts)}}</span>
                                </a>

                            </td>
                        </tr>
                            @endforeach
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
