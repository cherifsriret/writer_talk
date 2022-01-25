@extends('admin.layouts.main')

@section('title')
    FileUpload
@endsection
@push('style')
    <style>
    .container {
    max-width: 500px;
    }
    dl, ol, ul {
    margin: 0;
    padding: 0;
    list-style: none;
    }
    </style>

@endpush

@section('content')
    <div class="container mt-5">
        <form action="{{route('admin.submitUploadTip')}}" method="post" enctype="multipart/form-data">
            <input type="hidden" name="file_extension" id="FileExtension" value="">
            <h3 class="text-center mb-5">Upload File </h3>
            @csrf
{{--            @if ($message = Session::get('success'))--}}
{{--                <div class="alert alert-success">--}}
{{--                    <strong>{{ $message }}</strong>--}}
{{--                </div>--}}
{{--            @endif--}}

{{--            @if (count($errors) > 0)--}}
{{--                <div class="alert alert-danger">--}}
{{--                    <ul>--}}
{{--                        @foreach ($errors->all() as $error)--}}
{{--                            <li>{{ $error }}</li>--}}
{{--                        @endforeach--}}
{{--                    </ul>--}}
{{--                </div>--}}
{{--            @endif--}}
            <div class="alert alert-success alert-block" id="responseMsg" style="display: none">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong></strong>
            </div>

            <center class="mb-2">

                <img src="" class="myImage" width="320" height="240" style="display: none">
            <video  id="video_p" class="myVideo"  width="320" height="240" controls style="display: none">
                <source src="" type="video/mp4">
            </video>
            </center>
            <div class="custom-file">
                <input type="file" name="file" class="custom-file-input" id="chooseFile" onchange="readFile(this)">
                <label class="custom-file-label file-label" for="chooseFile">Select file</label>
            </div>




            <button type="submit" name="submit" class="btn btn-primary btn-block mt-4">
                Upload Files
            </button>


        </form>
    </div>

    <div class="row videoParentRow">
        @if(sizeof($admin_tips) > 0)
            @foreach($admin_tips as $v => $row)
                <div class="col-md-4 ">
                    <div class="video-container">
                        @if(@$row->file_type == 'image')
                            <img src="{{asset('storage/'.@$row->file)}}"  style="opacity: 1; width: 320px;height: 211px;margin-bottom: 4px; margin-top: 29px;">

                        @elseif(@$row->file_type == 'video')
                            <video width="320" height="240" controls>
                                <source src="{{asset('storage/'.@$row->file)}}" type="video/mp4">
                                <source src="movie.ogg" type="video/ogg">
                                Your browser does not support the video tag.
                            </video>
                        @endif
                        <a href="{{route('admin.tip.destory',[@$row->uuid])}}"  id="deleteVideoBtn" class="btn btn-danger" style="width:320px"  ><i class="mdi mdi-delete"></i>Delete</a>
                    </div>
                </div>
            @endforeach
        @endif
    </div>

@endsection
@push('js')

<script type="text/javascript">

    function readFile(input) {
         let reader;
        let isImageExt = true;
        let isVideoExt = true;
        let  validImageExtensions = ["jpg","pdf","jpeg","gif","png"];
        let  validVideoExtensions = ["mp4"];
        $('#FileExtension').val('');
        if (input.files && input.files[0]) {
           let file_ext = input.files[0].name.split('.').pop().toLowerCase();
           if (validImageExtensions.indexOf(file_ext) == -1){
               isImageExt = false;
           }
           if (validVideoExtensions.indexOf(file_ext) == -1){
               isVideoExt = false;
           }

            console.log('---------------Is Video --------------')
            console.log(isVideoExt)
            console.log('---------------Is Image --------------')
            console.log(isImageExt)

            if (isImageExt == true){
                reader = new FileReader();
                reader.onload = function(e) {
                    $('#FileExtension').val('image');
                    $('.myVideo').hide();
                    $('.myImage').show();
                    $('.myImage').attr('src', e.target.result);
                    $('.myImage').css('opacity', 1);
                    $('.file-label').text(input.files[0].name)
                };
                reader.readAsDataURL(input.files[0]);

            }

           if (isVideoExt == true){
               reader = new FileReader();
               reader.onload = function(e) {
                   $('#FileExtension').val('video');
                   $('.myImage').hide();
                   $('.myVideo').show();
                   $('.myVideo').attr('src', e.target.result);
                   $('.file-label').text(input.files[0].name)
               };
               reader.readAsDataURL(input.files[0]);

           }


        }
    }

    // $(document).on('click','#deleteVideoBtn',function (e){
    //
    //
    //     if(!confirm("Do you really want to do this?")) {
    //         return false;
    //     }
    //     e.preventDefault()
    //     //
    //     // let video_id = $(this).attr('videoable_id');
    //     // let video_type = $(this).attr('videoable_type');
    //
    //     var id = $(this).data("id");
    //     // var id = $(this).attr('data-id');
    //
    //     // var key = $(this).attr('key_index')
    //     var token = $("meta[name='csrf-token']").attr("content");
    //     var url = e.target;
    //     console.log(id)
    //     $.ajax(
    //         {
    //             url: url.href, //or you can use url: "company/"+id,
    //             type: 'DELETE',
    //             data: {
    //                 id: id,
    //                 _token: token
    //             },
    //             success: function (response){
    //                 if (response.success == true){
    //                     $("#responseMsg").html(response.message)
    //                         location.reload()
    //                 }
    //
    //             }
    //         });
    //     return false;
    //
    //
    //
    //
    // });

</script>


@endpush
