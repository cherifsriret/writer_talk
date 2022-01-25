@extends('admin.layouts.main')
@section('title')
    Quick Text
@endsection
@section('content')

    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body dashboard-tabs p-0">
                    <div class="tab-content py-0 px-0">
                        <div class="tab-pane fade show active" id="overview" role="tabpanel" aria-labelledby="overview-tab">
                            <div class="d-flex flex-wrap justify-content-xl-between">
                                <div class="d-none d-xl-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                    <i class="mdi mdi-account icon-lg mr-3 text-primary"></i>
                                    <div class="d-flex flex-column justify-content-around">
                                        <small class="mb-1 text-muted">Total Transactions</small>
                                        <div class="dropdown">
                                            {{--                                            <a class="btn btn-secondary dropdown-toggle p-0 bg-transparent border-0 text-dark shadow-none font-weight-medium" href="#" role="button" id="dropdownMenuLinkA" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">--}}
                                            <h5 class="mb-0 d-inline-block">{{@$total_payments}}</h5>
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
                                    <i class="mdi mdi-account icon-lg mr-3 icon-lg text-success"></i>
                                    <div class="d-flex flex-column justify-content-around">
                                        <small class="mb-1 text-muted">Total Memberships</small>
                                        <h5 class="mr-2 mb-0">{{@$total_members}}</h5>
                                    </div>
                                </div>
                                <div class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                    <i class="mdi mdi-account icon-lg icon-lg text-warning"></i>
                                    <div class="d-flex flex-column justify-content-around">
                                        <small class="mb-1 text-muted">Total Expired Members</small>
                                        <h5 class="mr-2 mb-0">{{@$total_expired}}</h5>
                                    </div>
                                </div>
                                <div class="d-flex border-md-right flex-grow-1 align-items-center justify-content-center p-3 item">
                                    <i class="mdi mdi-account icon-lg mr-3 icon-lg text-secondary"></i>
                                    <div class="d-flex flex-column justify-content-around">
                                        <small class="mb-1 text-muted">Total Trial Users </small>
                                        <h5 class="mr-2 mb-0">{{@$total_trial}}</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row">

        <div class="col-md-12 stretch-card">

            <div class="card">
                <div class="card-body">
                    <button type="button" class="btn btn-primary btn-sm float-right m-3 promo_code_btn" data-toggle="modal" data-target="#promoModal">
                        Add Quick Text
                    </button>
                    <p class="card-title">Quick Texts </p>
                    <div class="table-responsive">
                        <table class="table selfDataTable">
                            <thead>
                            <tr>
                                <th>No. </th>
                                <th>Text</th>
                                <th>Updated at</th>
                                <th>Created at</th>
                            </tr>
                            </thead>
                            <tbody>
                            @if(sizeof($quick_text)>0)
                                @foreach($quick_text as $u => $row)
                                    <tr>
                                        <td>{{ @$u + 1 }}</td>
                                        <td>{{@$row->text}}</td>
                                        <td>{{\Carbon\Carbon::parse(@$row->updated_at)->format('d-M-Y')}}</td>
                                        <td>{{\Carbon\Carbon::parse(@$row->created_at)->format('d-M-Y')}}</td>
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
    <div class="modal fade" id="promoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Add Quick Text</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{route('admin.createQuickText')}}" method="POST" id="createPromoForm">
                        @csrf
                        <center>
                            <p class="text-danger font-weight-bold" id="responseMsg" style="display: none"></p>
                        </center>
                        <div class="form-group">
                            <label for="promo_code">Quick Text</label>
                            <input type="text" name="quick_text" class="form-control promo_code" id="quickText" value="">
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-primary submit_promo_btn">Save changes</button>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('js')
    <script type="text/javascript">
        $(document).on('click','#submitEditModalBtn', function (e){
            e.preventDefault();
            $('#updatePromoForm').submit();
        });
        $(document).on('click','#editPromoBtn', function (e){
            e.preventDefault();
            let promo_id  = $(this).attr('promo_id');
            $('#modalPromoCodeId').val(promo_id);
            let url = window.location.origin+'/admin/edit-promo/'+promo_id

            $.ajax({
                'type':'GET',
                'url': url,
                'success':function (data){
                    let get_data = JSON.parse(data);
                    if (get_data.success == true){
                        console.log(get_data.data.promo_code);
                        $('#promoCodeToEdit').val(get_data.data.promo_code);
                        // $('select#editPaymentOption option[value = get_data.data.payment_option]');
                        $('#editPaymentOption').val(get_data.data.payment_option)
                    }
                }
            })
        });
    </script>
    <script type="text/javascript">
        $(document).on('click','.submit_promo_btn',function (e){
            e.preventDefault();
            let quickText = $('#quickText').val();
            if (quickText){
                $('#responseMsg').hide();
                $('#responseMsg').html('');
                $('#createPromoForm').submit();
            }else {
                $('#responseMsg').show();
                $('#responseMsg').html('Required Fields Can Not be Empty');
            }


        })
    </script>

@endpush
