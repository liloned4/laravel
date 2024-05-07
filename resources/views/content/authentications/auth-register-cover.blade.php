@php
    $customizerHidden = 'customizer-hide';
    $configData = Helper::appClasses();
@endphp

@extends('layouts/layoutMaster')

@section('title', 'Register Cover - Pages')

@section('vendor-style')
    @vite(['resources/assets/vendor/libs/@form-validation/form-validation.scss'])
@endsection

@section('page-style')
    @vite(['resources/assets/vendor/scss/pages/page-auth.scss'])
@endsection

@section('vendor-script')
    @vite(['resources/assets/vendor/libs/@form-validation/popular.js', 'resources/assets/vendor/libs/@form-validation/bootstrap5.js', 'resources/assets/vendor/libs/@form-validation/auto-focus.js'])
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
                            alt="auth-register-cover" class="platform-bg"
                            data-app-light-img="illustrations/bg-shape-image-light.png"
                            data-app-dark-img="illustrations/bg-shape-image-dark.png"> --}}
                </div>
            </div>
            <!-- /Left Text -->

            <!-- Register -->
            <div class="d-flex col-12 col-lg-5 align-items-center p-sm-5 p-4">
                <div class="w-px-400 mx-auto">
                    <!-- Logo -->
                    <div class="app-brand mb-1">
                        <a href="{{ url('/') }}" class="app-brand-link gap-2">
                            <span class="app-brand-logo demo"
                                style="background: url('/assets/img/si-dandang/datu.png') no-repeat center center; background-size: cover; display: inline-block; width: 220px; height: 220px;"></span>
                        </a>
                    </div>
                    <!-- /Logo -->
                    <p class="mb-4">Silahkan Buat Akun Anda !</p>
                    <form id="formAuthentication" class="mb-3" action="{{ route('proses.register') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Username</label>
                            <input type="text" class="form-control" id="name" name="name"
                                placeholder="Enter your username" autofocus>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="text" class="form-control" id="email" name="email"
                                placeholder="Enter your email">
                        </div>
                        <div class="mb-3 form-password-toggle">
                            <label class="form-label" for="password">Password</label>
                            <div class="input-group input-group-merge">
                                <input type="password" id="password" class="form-control" name="password"
                                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                    aria-describedby="password" />
                                <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                            </div>
                        </div>
                        <div class="mb-3 form-password-toggle">
                            <label class="form-label" for="password_confirmation">Konfirmasi Password</label>
                            <div class="input-group input-group-merge">
                                <input type="password" id="password_confirmation" class="form-control"
                                    name="password_confirmation"
                                    placeholder="&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;&#xb7;"
                                    aria-describedby="password" />
                                <span class="input-group-text cursor-pointer"><i class="ti ti-eye-off"></i></span>
                            </div>
                        </div>

                        {{-- <div class="mb-3">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="terms-conditions" name="terms">
                                <label class="form-check-label" for="terms-conditions">
                                    I agree to
                                    <a class="text-success" href="javascript:void(0);">privacy policy & terms</a>
                                </label>
                            </div>
                        </div> --}}
                        <button class="btn btn-success d-grid w-100">
                            Sign up
                        </button>
                    </form>

                    <p class="text-center">
                        <span>Already have an account?</span>
                        <a href="{{ url('auth/login-cover') }}">
                            <span class="text-success">Sign in instead</span>
                        </a>
                    </p>

                    {{-- <div class="divider my-4">
                        <div class="divider-text">or</div>
                    </div>

                    <div class="d-flex justify-content-center">
                        <a href="javascript:;" class="btn btn-icon btn-label-facebook me-3">
                            <i class="tf-icons fa-brands fa-facebook-f fs-5"></i>
                        </a>

                        <a href="javascript:;" class="btn btn-icon btn-label-google-plus me-3">
                            <i class="tf-icons fa-brands fa-google fs-5"></i>
                        </a>

                        <a href="javascript:;" class="btn btn-icon btn-label-twitter">
                            <i class="tf-icons fa-brands fa-twitter fs-5"></i>
                        </a>
                    </div> --}}
                </div>
            </div>
            <!-- /Register -->
        </div>
    </div>
@endsection
