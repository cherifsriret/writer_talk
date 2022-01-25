@extends('admin.layouts.main')
@section('title')
    UserPosts
@endsection

@section('content')
{{--{{dd($posts)}}--}}



    <div class="row">
        <div class="col-3">
            <div class="card">

                <div class="card-body">
                    <div>
                        <img @if(@$user->image) src="{{asset('storage/'.@$user->image)}}" @else src="{{asset('assets/user_avatar.png')}}"@endif class="rounded-circle" alt="Cinque Terre" style="width: 150px;height: 150px;object-fit: cover;">
                        <h4 class="username-heading" style=" white-space: nowrap ;">{{@$user->name}}</h4>
                        <p class="useremail">{{@$user->email}}</p>

                    </div>

                    <div class="pt-3" >
                        @if(@$user->status == 'active')
                            <a href="{{route('admin.changeStatus',['uuid'=>@$user->uuid, 'status'=>'suspend'])}}" class="btn btn-info btn-sm float-left user-action-button ">Suspend User</a>
                        @else
                        <a href="{{route('admin.changeStatus',['uuid'=>@$user->uuid, 'status'=>'active'])}}" class="btn btn-primary btn-sm float-left user-action-button ">Active</a>
                        @endif
                        @if(@$user->verify_user == 1)
                            <a href="{{route('admin.verifyUser',['uuid'=>@$user->uuid, 'verify'=> 0 ])}}" class="btn btn-warning btn-sm user-action-button float-left ml-1">Refute User</a>
                        @else
                            <a href="{{route('admin.verifyUser',['uuid'=>@$user->uuid, 'verify'=> 1 ])}}" class="btn btn-warning btn-sm user-action-button float-left ml-1 ">Verify User</a>
                        @endif
                    </div>

                    <div class="pt-5">
                        <p class="about_me">
                            Lorem Ipsum is simply dummy text of the printing and typesetting industry.
                            Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book.
                            It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged.
                        </p>
                    </div>

                    <div class="pt-3 user-stat">
                        <p><strong>{{count(@$posts)}}</strong> posts</p>
                        <p><strong>{{@$penpal_count}}</strong> penpals</p>
                    </div>
                </div>


            </div>
        </div>
        <div class="col-9">
            <div class="row ">
                <div class="tab">
                <button class="tablinks active" onclick="openCity(event ,'Posts')" >Posts</button>
                <button class="tablinks" onclick="openCity(event, 'Stories')">Stories</button>
{{--                <button class="tablink" onclick="openCity('Tokyo', this, 'blue')">Tokyo</button>--}}
{{--                <button class="tablink" onclick="openCity('Oslo', this, 'orange')">Oslo</button>--}}
                </div>
           </div>

            <div style="display: block" id="Posts" class="tabcontent ">
                <div class="row mt-5 postParentRow">
                        @if(sizeof($posts)>0)
                            @foreach($posts as $p=>$row)

                    <div class="col-4 mt-4">
                        <div class="container">
                            <a href="javascript:void(0)" suspend_status="{{@$row->suspend}}" user_id="{{@$row->user_id}}" description="{{@$row->description}}" post_created_at="{{@$row->created_at}}" uuid="{{@$row->uuid}}" key="{{$p+1}}" class="show_post_details">

                                <img class="img-fluid"  @if($row->file) src="{{asset('storage/'.$row->file)}}" @else src="{{asset('assets/user_avatar.png')}}"@endif style="width: 100%">
                            </a>
                            @if($row->suspend == 1)
                            <div class="top-left" style="background-color: red">Suspended</div>
                            @else
                                <div class="top-left" style="background-color: green">Active</div>
                            @endif
                        </div>

                    </div>
                        @endforeach
                    @endif
{{--                    <div class="col-4">--}}
{{--                        <img src="{{asset('assets/user_avatar.png')}}" style="width: 100%">--}}
{{--                    </div>--}}
{{--                    <div class="col-4">--}}
{{--                        <img src="{{asset('assets/user_avatar.png')}}" style="width: 100%">--}}
{{--                    </div>--}}
                </div>
            </div>

            <div id="Stories" class="tabcontent">
                <div class="row mt-5" id="Posts">
                    @if(sizeof($stories)>0)
                        @foreach($stories as $s=>$s_row)


                            <div class="col-4 mt-4">
                                <div class="container" style="height: 150px">
                                        @if(@$s_row->file_type == 'image')
{{--                                        <a href="javascript:void(0)" suspend_status="{{@$s_row->suspend}}" user_id="{{@$s_row->user_id}}" description="{{@$s_row->description}}" post_created_at="{{@$s_row->created_at}}" uuid="{{@$s_row->uuid}}" key="{{$p+1}}" class="show_post_details">--}}

                                        <img class="img-fluid max-100"  @if($s_row->file) src="{{asset('storage/'.$s_row->file)}}" @else src="{{asset('assets/user_avatar.png')}}"@endif style="width: 100%">
{{--                                        </a>--}}
                                        @elseif(@$s_row->file_type == 'video')
                                            <video width="200" height="150" class="max-100" controls >
                                                <source src="{{asset('storage/'.@$s_row->file)}}" type="video/mp4">
                                            </video>
                                        @endif
{{--                                    @if($row->suspend == 1)--}}
{{--                                        <div class="top-left" style="background-color: red">Suspended</div>--}}
{{--                                    @else--}}
{{--                                        <div class="top-left" style="background-color: green">Active</div>--}}
{{--                                    @endif--}}
                                </div>

                            </div>
                        @endforeach
                    @endif
                </div>
            </div>


        </div>
    </div>

<!-- Modal -->
<div class="modal fade" id="postDetailsModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Post Details</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <div class="alert alert-success alert-block removePostDiv" style="display:none">
                    <button type="button" class="close" data-dismiss="alert">×</button>
                    <strong class="removePostMsg"></strong>
                </div>
                <input type="hidden" name="post_id" id="postId" value="">
                <input type="hidden" name="post_data" id="postData" value="">
                <input type="hidden" name="user_id" id="userId" value="">
                <input type="hidden" name="index" id="divIndex" value="">
               <div class="">
                   <center>

                       <img src="" alt="" class="modalPostImage" width="50%">
                   </center>
                   <p class="modal_description pt-5"></p>
                   <p class="created_at text-muted float-right pt-3"></p>
               </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="removePostBtn">Remove Post</button>
            </div>
        </div>
    </div>
</div>
@endsection

@push('js')
    <script src="{{asset('js/moment.js')}}"></script>
<script type="text/javascript">

    function openCity(evt, cityName) {
        // Declare all variables
        var i, tabcontent, tablinks;

        // Get all elements with class="tabcontent" and hide them
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }

        // Get all elements with class="tablinks" and remove the class "active"
        tablinks = document.getElementsByClassName("tablinks");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }

        // Show the current tab, and add an "active" class to the button that opened the tab
        document.getElementById(cityName).style.display = "block";
        evt.currentTarget.className += " active";
    }

    $(document).on('click','.show_post_details', function(e){
                e.preventDefault();
        $('.removePostMsg').html('')
        $('.removePostDiv').hide()

        $('#postDetailsModal').modal('show');
            // let post = $(this).attr('row_details');
            let key = $(this).attr('key');
            let img_src = $(this).find('img').attr('src');
            let description = $(this).attr('description')
            let created_at = $(this).attr('post_created_at')
            let status_suspended = $(this).attr('suspend_status')
            let user_id = $(this).attr('user_id')
            let post_uuid = $(this).attr('uuid')

            $('#divIndex').val(key);
            $('.modalPostImage').attr('src',img_src)
            $('.modal_description').html(description)
            $('#postId').val(post_uuid);
            $('#userId').val(user_id);
            $('.created_at').html(moment(created_at).format("MMM Do YY,  h:mm:ss a"));
            if (status_suspended == 1){
                $('#removePostBtn').text('Active Post')
                $('#removePostBtn').attr('status_post', 0)
            }else{
                $('#removePostBtn').text('Remove Post')
                $('#removePostBtn').attr('status_post', 1)

            }
    });

    $(document).on('click', '#removePostBtn', function (){


        let base_path = window.location.origin;
        let user_id = $('#userId').val();
        let post_id = $('#postId').val();
        let post_data = $('#postData').val();
        let post_status = $(this).attr('status_post')
        let div_index = $('#divIndex').val()

        let url = base_path+'/admin/remove-user-post/'+user_id+'/'+post_id+'/'+post_status;
        console.log(url);

        $.ajax({
           type:"GET",
           url:url,
            success:function (data){


               let res = JSON.parse(data)

                console.log(res);
                if (res.success == true){

                    setTimeout(function (){

                        $('#postDetailsModal').modal('hide');

                        let post_html = '                        <div class="container">\n' +
                            '                            <a href="javascript:void(0)" suspend_status="'+res.data.suspend+'" user_id="'+res.data.user_id+'" description="'+res.data.description+'" post_created_at="'+res.data.created_at+'" uuid="'+res.data.uuid+'"  key="'+div_index+'" class="show_post_details">\n' ;
                                if(res.data.file != ''){

                                    post_html+=  ' <img class="img-fluid"   src="'+base_path+'/storage/'+res.data.file+'"  style="width: 100%">\n';

                                }else{
                                    post_html+=  ' <img class="img-fluid"   src="'+base_path+'/assets/user_avatar.png'+'" style="width: 100%">\n';

                                }
                            '                            </a>\n' ;
                                if (res.data.suspend == 1){
                                    post_html += '<div class="top-left" style="background-color: red">Suspended</div>\n';

                                }else{
                                    post_html +=  '   <div class="top-left" style="background-color: green">Active</div>\n';

                                }
                            '                        </div>\n';

                        $( ".postParentRow .col-4:nth-child("+div_index+")" ).html('')
                        $( ".postParentRow .col-4:nth-child("+div_index+")" ).append(post_html)

                    },300)

                    $('.removePostMsg').html(res.message)
                    $('.removePostDiv').show()

                }
            },
            error:function (data){

            }
        });
    })
</script>
@endpush
