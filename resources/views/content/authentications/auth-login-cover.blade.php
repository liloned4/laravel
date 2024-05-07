@php
    $customizerHidden = 'customizer-hide';
    $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Login')

@section('vendor-style')
    @vite(['resources/assets/vendor/libs/@form-validation/form-validation.scss'])
@endsection

@section('page-style')
    @vite(['resources/assets/vendor/scss/pages/page-auth.scss'])
@endsection

@section('vendor-script')
    @vite(['resources/assets/vendor/libs/@form-validation/popular.js', 'resources/assets/vendor/libs/@form-validation/bootstrap5.js', 'resources/assets/vendor/libs/@form-validation/auto-focus.js', 'resources/assets/vendor/libs/sweetalert2/sweetalert2.js'])
@endsection

@section('page-script')
    @vite(['resources/assets/js/pages-auth.js'])
@endsection

@section('content')
    <div class="authentication-wrapper authentication-cover authentication-bg">
        <div class="authentication-inner row">
            <!-- /Left Text -->
            <div class="d-none d-lg-flex col-lg-7 p-0">
                <div class="auth-cover-bg auth-cover-bg-color d-flex justify-content-center align-items-center">
                    <img src="{{ asset('assets/img/front-pages/landing-page/0909-' . $configData['style'] . '.png') }}"
                        alt="auth-login-cover" class="img-fluid my-5 auth-illustration"
                        data-app-light-img="front-pages/landing-page/0909-light.png"
                        data-app-dark-img="front-pages/landing-page/0909-dark.png">

                    {{-- <img src="{{ asset('assets/img/illustrations/bg-shape-image-' . $configData['style'] . '.png') }}"
                        alt="auth-login-cover" class="platform-bg"
                        data-app-light-img="illustrations/bg-shape-image-light.png"
                        data-app-dark-img="illustrations/bg-shape-image-dark.png"> --}}
                </div>
            </div>
            <!-- /Left Text -->

            <!-- Login -->
            <div class="d-flex col-12 col-lg-5 align-items-center p-sm-5 p-4">
                <div class="w-px-400 mx-auto">
                    <!-- Logo -->
                    <div class="app-brand mb-2">
                        <a href="" class="app-brand-link gap-2">
                            <span class="app-brand-logo demo"
                                style="background: url('/assets/img/si-dandang/datu.png') no-repeat center center; background-size: cover; display: inline-block; width: 220px; height: 220px;"></span>
                        </a>
                    </div>
                    <!-- /Logo -->
                    <h3 class=" mb-1">Welcome to {{ config('variables.templateName') }}! 👋</h3>
                    <p class="mb-4">Please sign-in. </p>
                    <script>
                        // Tampilkan SweetAlert jika terdapat pesan sukses dalam URL
                        const successMessage = '{{ session('success') }}';
                        if (successMessage) {
                            Swal.fire('Sukses!', successMessage, 'success');
                        }

                        // Tampilkan SweetAlert jika terdapat pesan error dalam URL
                        const errorMessage = '{{ session('error') }}';
                        if (errorMessage) {
                            Swal.fire('Error!', errorMessage, 'error');
                        }
                    </script>
                    <form id="formAuthentication" class="mb-3" action="{{ route('proses.login') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label"> Username</label>
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Masukan username" autofocus>
                        </div>
                        <div class="mb-3 form-password-toggle">
                            <div class="d-flex justify-content-between">
                                <label class="form-label" for="password">Password</label>
                                <a href="{{ url('auth/forgot-password-cover') }}">
                                    <small class="text-success">Forgot Password?</small>
                                </a>
                            </div>
                            <div class="input-group input-group-merge">
                                <input type="password" id="password" class="form-control" name="password"
                                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                    aria-describedby="password" />
                                <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                            </div>
                        </div>
                        {{-- <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="remember-me">
                                <label class="form-check-label" for="remember-me">
                                    Remember Me
                                </label>
                            </div>
                        </div> --}}
                        <button class="btn btn-success d-grid w-100">
                            Sign in
                        </button>
                    </form>

                    <p class="text-center">
                        <span>New on our platform?</span>
                        <a href="{{ url('auth/register') }}">
                            <span class="text-success">Create an account</span>
                        </a>
                    </p>
                </div>
            </div>
            <!-- /Login -->
        </div>
    </div>
@endsection
