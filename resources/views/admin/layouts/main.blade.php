<!DOCTYPE html>
<html lang="en">
<head>
    @include('admin.partials.head')

    @stack('style')
</head>
<body>
<div class="container-scroller">
    @include('admin.partials.nav')
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_sidebar.html -->
        @include('admin.partials.sidebar')
        <!-- partial -->
        <div class="main-panel">
            <div class="content-wrapper">

                @include('admin.partials.response_message')
                @yield('content')

            </div>
            <!-- content-wrapper ends -->
            <!-- partial:partials/_footer.html -->
            @include('admin.partials.footer')
            <!-- partial -->
        </div>
        <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->

@include('admin.partials.scripts')

<script type="text/javascript">

    $(document).ready( function () {
        $('.selfDataTable').DataTable();
    });

</script>

</body>

</html>
