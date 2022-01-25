@extends('admin.layouts.main')

@section('title')
    Tags
@endsection

@section('content')


    <button type="button" class="btn btn-primary btn-sm float-right m-3" data-toggle="collapse" data-target="#collapseExample" aria-expanded="false" aria-controls="collapseExample" id="addNewBtn"> Add New </button>
    <div class="col-lg-12 grid-margin stretch-card collapse" id="collapseExample">
        <div class="card">
            <div class="card-header">
                Add Tag
            </div>
            <div class="card-body">
                <form id="addNewTagForm" action="{{route('admin.submitPostTag')}}" method="POST">
                    @csrf
                    <label>Tag Name</label>
                    <input type="text" name="tag_name" class="form-control tag_name" >
                    <input type="button" name="add_tag" class="btn btn-primary btn-sm mt-3 float-right" id="submitTagBtn" value="Submit">
                </form>
            </div>
        </div>
    </div>
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">Tags Table</h4>
                {{--                <p class="card-description">--}}
                {{--                    Add class <code>.table</code>--}}
                {{--                </p>--}}
                <div class="table-responsive">
                    <table class="table table-striped selfDataTable">
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>Tag Name</th>
                            <th>Created At</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(sizeof($tags)> 0)
                            @foreach($tags as $t => $t_row)
                                <tr>
                                    <td class="py-1">
                                        {{$t+1}}
                                    </td>

                                    <td>{{@$t_row->tag_name}}</td>
                                    <td>{{\Carbon\Carbon::parse(@$t_row->created_at)->format('d-m-Y')}}</td>
                                    <td><a href="{{route('admin.deletePostTag',['uuid'=>$t_row->uuid])}}"><span class="mdi mdi-delete" style="color: red">Delete</span></a></td>
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

@push('js')
<script type="text/javascript">
    $(document).on('click','#submitTagBtn',function (e){
        e.preventDefault();
       let tagName = $('.tag_name').val();
       if (tagName != ''){

           $('#addNewTagForm').submit();
       }else{
           alert('Please Enter Tag Name');
       }

    })
</script>

@endpush
