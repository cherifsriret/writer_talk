{{--@extends('layouts.app')--}}

{{--@section('content')--}}
{{--<div class="container">--}}
{{--    <div class="row justify-content-center">--}}
{{--        <div class="col-md-8">--}}
{{--            <div class="card">--}}
{{--                <div class="card-header">{{ __('Login') }}</div>--}}

{{--                <div class="card-body">--}}
{{--                    <form method="POST" action="{{ route('login') }}">--}}
{{--                        @csrf--}}

{{--                        <div class="form-group row">--}}
{{--                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>--}}

{{--                                @error('email')--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="form-group row">--}}
{{--                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>--}}

{{--                            <div class="col-md-6">--}}
{{--                                <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="current-password">--}}

{{--                                @error('password')--}}
{{--                                    <span class="invalid-feedback" role="alert">--}}
{{--                                        <strong>{{ $message }}</strong>--}}
{{--                                    </span>--}}
{{--                                @enderror--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="form-group row">--}}
{{--                            <div class="col-md-6 offset-md-4">--}}
{{--                                <div class="form-check">--}}
{{--                                    <input class="form-check-input" type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>--}}

{{--                                    <label class="form-check-label" for="remember">--}}
{{--                                        {{ __('Remember Me') }}--}}
{{--                                    </label>--}}
{{--                                </div>--}}
{{--                            </div>--}}
{{--                        </div>--}}

{{--                        <div class="form-group row mb-0">--}}
{{--                            <div class="col-md-8 offset-md-4">--}}
{{--                                <button type="submit" class="btn btn-primary">--}}
{{--                                    {{ __('Login') }}--}}
{{--                                </button>--}}

{{--                                @if (Route::has('password.request'))--}}
{{--                                    <a class="btn btn-link" href="{{ route('password.request') }}">--}}
{{--                                        {{ __('Forgot Your Password?') }}--}}
{{--                                    </a>--}}
{{--                                @endif--}}
{{--                            </div>--}}
{{--                        </div>--}}
{{--                    </form>--}}
{{--                </div>--}}
{{--            </div>--}}
{{--        </div>--}}
{{--    </div>--}}
{{--</div>--}}
{{--@endsection--}}



    <!DOCTYPE html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Writers Talk Admin</title>
    <!-- plugins:css -->
    <link rel="stylesheet" href="{{asset('template/vendors/mdi/css/materialdesignicons.min.css')}}">
    <link rel="stylesheet" href="{{asset('template/vendors/base/vendor.bundle.base.css')}}">
    <!-- endinject -->
    <!-- plugin css for this page -->
    <!-- End plugin css for this page -->
    <!-- inject:css -->
    <link rel="stylesheet" href="{{asset('template/css/style.css')}}">
    <!-- endinject -->
    <link rel="shortcut icon" href="{{asset('template/images/favicon.png')}}" />
</head>

<body>
<div class="container-scroller">
    <div class="container-fluid page-body-wrapper full-page-wrapper">
        <div class="content-wrapper d-flex align-items-center auth px-0">
            <div class="row w-100 mx-0">
                <div class="col-lg-4 mx-auto">
                    <div class="auth-form-light text-left py-5 px-4 px-sm-5">
                        <div class="brand-logo">
                            <center>
                            <img src="{{asset('template/images/logo.jpeg')}}" alt="logo">
                            </center>
                        </div>
                        <h4>Sign in to continue.</h4>
{{--                        <h6 class="font-weight-light">Sign in to continue.</h6>--}}
                        <form  method="POST" action="{{ route($loginRoute) }}" class="pt-3">
                            @csrf
                            <div class="form-group">
                                <input type="email" name="email" class="form-control form-control-lg @error('email') is-invalid @enderror" id="email" value="{{ old('email') }}" required autocomplete="email" autofocus placeholder="Email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror

                            </div>
                            <div class="form-group">
                                <input type="password" name="password" class="form-control form-control-lg @error('password') is-invalid @enderror " id="password" required  autocomplete="current-password" autofocus placeholder="Password">
                                @error('password')
                                <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="mt-3">
                                <button type="submit" class="btn btn-block btn-primary btn-lg font-weight-medium auth-form-btn" >SIGN IN</button>
                            </div>
{{--                            <div class="my-2 d-flex justify-content-between align-items-center">--}}
{{--                                <div class="form-check">--}}
{{--                                    <label class="form-check-label text-muted">--}}
{{--                                        <input type="checkbox" class="form-check-input">--}}
{{--                                        Keep me signed in--}}
{{--                                    </label>--}}
{{--                                </div>--}}
{{--                                <a href="#" class="auth-link text-black">Forgot password?</a>--}}
{{--                            </div>--}}
{{--                            <div class="mb-2">--}}
{{--                                <button type="button" class="btn btn-block btn-facebook auth-form-btn">--}}
{{--                                    <i class="mdi mdi-facebook mr-2"></i>Connect using facebook--}}
{{--                                </button>--}}
{{--                            </div>--}}
{{--                            <div class="text-center mt-4 font-weight-light">--}}
{{--                                Don't have an account? <a href="register.html" class="text-primary">Create</a>--}}
{{--                            </div>--}}
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <!-- content-wrapper ends -->
    </div>
    <!-- page-body-wrapper ends -->
</div>
<!-- container-scroller -->
<!-- plugins:js -->
<script src="{{asset('template/vendors/base/vendor.bundle.base.js')}}"></script>
<!-- endinject -->
<!-- inject:js -->
<script src="{{asset('template/js/off-canvas.js')}}"></script>
<script src="{{asset('template/js/hoverable-collapse.js')}}"></script>
<script src="{{asset('template/js/template.js')}}"></script>
<!-- endinject -->
</body>

</html>
