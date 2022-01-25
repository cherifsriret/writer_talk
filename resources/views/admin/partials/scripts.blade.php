<!-- plugins:js -->
<script src="{{asset('template/vendors/base/vendor.bundle.base.js')}}"></script>
<!-- endinject -->
<!-- Plugin js for this page-->
<script src="{{asset('template/vendors/chart.js/Chart.min.js')}}"></script>
{{--<script src="{{asset('template/vendors/datatables.net/jquery.dataTables.js')}}"></script>--}}
{{--<script src="{{asset('template/vendors/datatables.net-bs4/dataTables.bootstrap4.js')}}"></script>--}}
<!-- End plugin js for this page-->
<!-- inject:js -->
<script src="{{asset('template/js/off-canvas.js')}}"></script>
<script src="{{asset('template/js/hoverable-collapse.js')}}"></script>
<script src="{{asset('template/js/template.js')}}"></script>
<!-- endinject -->
<!-- Custom js for this page-->
<script src="{{asset('template/js/dashboard.js')}}"></script>
{{--<script src="{{asset('template/js/data-table.js')}}"></script>--}}
{{--<script src="{{asset('template/js/jquery.dataTables.js')}}"></script>--}}
{{--<script src="{{asset('template/js/dataTables.bootstrap4.js')}}"></script>--}}

<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.25/js/jquery.dataTables.js"></script>

<!-- End custom js for this page-->
@stack('js')
