@extends('admin.layouts.main')
@section('title')
    {{__('Users')}}
@endsection

@section('content')
{{--    <a href="{{route('admin.createUserPromoCode')}}" class="btn btn-primary btn-sm float-right m-3">Genereate Promo Code</a>--}}
    <button type="button" class="btn btn-primary btn-sm float-right m-3 promo_code_btn" data-toggle="modal" data-target="#promoModal">
        Generate Promo Code
    </button>

        <!-- Modal -->
        <div class="modal fade" id="promoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Modal title</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form action="{{route('admin.createUserPromoCode')}}" method="POST" id="createPromoForm">
                            @csrf
                            <center>
                                <p class="text-danger font-weight-bold" id="responseMsg" style="display: none"></p>
                            </center>
                            <div class="form-group">
                                <label for="promo_code">PromoCode</label>
                                <input type="text" name="promo_code" class="form-control promo_code" id="promoCodeText" value="">
                            </div>
                            <div class="form-group">
{{--                                <label for="promo_code">Select Payment Option</label>--}}
                                <select name="payment_option" id="paymentOption" class="form-control">
                                    <option  selected disabled>Select Payment Option</option>
                                    <option value="$1.99 for first month">$1.99 for first month</option>
                                    <option value="$1.99 for two months">$1.99 for two months</option>
                                    <option value="$1.99 for first year">$1.99 for first year</option>
                                    <option value="Free for first year">Free for first year</option>
                                    <option value="Free forever">Free forever</option>
                                </select>
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
    <div class="col-lg-12 grid-margin stretch-card">
        <div class="card">
            <div class="card-body">
                <h4 class="card-title">PromoCode Table</h4>
                {{--                <p class="card-description">--}}
                {{--                    Add class <code>.table</code>--}}
                {{--                </p>--}}
                <div class="table-responsive">
                    <table class="table table-striped selfDataTable" >
                        <thead>
                        <tr>
                            <th>#</th>
                            <th>PromoCode</th>
                            <th>Payment Option</th>
                            <th>Created At</th>
{{--                            <th>Status</th>--}}
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @if(sizeof($promo_codes)> 0)
                            @foreach($promo_codes as $u => $row)
                                <tr>
                                    <td class="py-1">
                                            {{$u+1}}
                                    </td>

                                    <td>{{@$row->promo_code}}</td>
                                    <td>{{@$row->payment_option}}</td>
                                    <td>{{\Carbon\Carbon::parse(@$row->created_at)->format('d-m-Y')}}</td>
                                    <td>
                                        <button  type="button"  class="btn btn-info btn-sm" promo_id="{{$row->id}}" id="editPromoBtn" data-toggle="modal" data-target="#editPromoModal">
                                            <span class="mdi mdi-square-edit-outline">
                                            </span>Edit</button>
                                        <a href="{{url('admin/delete-promo/'.$row->id)}}" class="btn btn-danger btn-sm"><span class="mdi mdi-trash-can-outline"></span>Delete</a>
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

    <!-- Modal -->
    <div class="modal fade" id="editPromoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Edit PromoCode</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form action="{{url('admin/update-promo')}}" method="POST" id="updatePromoForm">
                        @csrf
                        <input type="hidden" name="promo_code_id" id="modalPromoCodeId" value="">
                        <div class="form-group">
                        <label>PromoCode</label>
                        <input type="text" name="promo_code" class="form-control" id="promoCodeToEdit" value="">
                        </div>
                        <div class="form-group">
                            {{--                                <label for="promo_code">Select Payment Option</label>--}}
                            <select name="payment_option" id="editPaymentOption" class="form-control">
                                <option  selected disabled>Select Payment Option</option>
                                  <option value="$1.99 for first month">$1.99 for first month</option>
                                  <option value="$1.99 for two months">$1.99 for two months</option>
                                    <option value="$1.99 for first year">$1.99 for first year</option>
                                    <option value="Free for first year">Free for first year</option>
                                    <option value="Free forever">Free forever</option>
                            </select>
                        </div>

                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="button"  id="submitEditModalBtn" class="btn btn-primary">Save changes</button>
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
        $(document).on('click','.promo_code_btn',function (e){
            e.preventDefault();
               let rand_promo =  getRandomString(6);
               $('.promo_code').val(rand_promo);

        })
        $(document).on('click','.submit_promo_btn',function (e){
            e.preventDefault();
            let promo_code = $('#promoCodeText').val();
            let payment_option = $('#paymentOption option:selected').val();
            console.log(promo_code)
            console.log(payment_option)
            if (promo_code && payment_option && payment_option != 'Select Payment Option'){
                $('#responseMsg').hide();
                $('#responseMsg').html('');
                $('#createPromoForm').submit();
            }else {
                $('#responseMsg').show();
                $('#responseMsg').html('Required Fields Can Not be Empty');
            }


        })
        function getRandomString(length) {
            var randomChars = 'ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789';
            var result = '';
            for ( var i = 0; i < length; i++ ) {
                result += randomChars.charAt(Math.floor(Math.random() * randomChars.length));
            }
            return result;
        }
    </script>

@endpush
