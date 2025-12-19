@extends('layouts.front-end.app')
@section('title', translate('sign_in'))
<style>
    .signin .signInTitle {
        font-size: 20px;
        font-weight: 700;
        color: #078A3A;
    }

    .signin .signInSubTitle {
        font-size: 16px;
        font-weight: 600;
        line-height: 20.8px;
        color: #999999;
    }

    .login-form .form-group .form-control {
        border: 1px solid #078A3A;
    }

    .signin .login-form input::placeholder {
        color: #078A3A;
        font-weight: 600;
        font-size: 16px;
    }

    .custom-color-green {
        color: #078A3A
    }

    .login-signup-button .logSin {
        font-size: 16px;
        border-radius: 4px;
        padding: 2px 20px;
        font-weight: 600;
    }

    .login-signup-button .log--in,
    .login-signup-button .sign--in:hover {
        color: #ffffff;
        background: #078A3A;
        border: 1px solid #078A3A;
    }

    .login-signup-button .sign--in,
    .login-signup-button .log--in:hover {
        color: #078A3A;
        background: #ffffff;
        border: 1px solid #078A3A;
    }

    .form-group input {
        background-color: #ffffff !important;
    }

    .form-control:focus {
        color: #078A3A;
        font-size: 14px;
        font-weight: 400;
    }

    .container .breadcrumb {
        background-color: none !important;
    }

    @media (max-width:768px) {
        .signin .sign-in-container {
            padding: 16px !important;
        }
    }
</style>
@section('content')
    <div class="container mt-4">
        <nav aria-label="breadcrumb" sty>
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Sign In</li>
            </ol>
        </nav>
        <div class="signin">
            <div class="row sign-in-container">
                <div class="col-lg-6 col-md-6 col-sm-12 forms d-flex align-items-center">
                    <div>
                        <h1 class="signInTitle">Sign In</h1>
                        <p class="signInSubTitle">Please fill your details to access your account.</p>
                        <form class="mt-3 login-form" action="{{ route('customer.auth.login') }}" method="post"
                            id="customer-login-form">
                            @csrf
                            <div class="form-group">
                                <input type="text" name="user_id" id="si-email" value="{{ old('user_id') }}"
                                    class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp"
                                    placeholder="Email address">
                                <div class="invalid-feedback">{{ translate('please_provide_valid_email_or_phone_number') }}
                                    .
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="password-toggle rtl">
                                    <input name="password" type="password" class="form-control" id="passwordField"
                                        placeholder="Password">
                                    <label class="password-toggle-btn" onclick="togglePassword()">
                                        <i class="tio-hidden password-toggle-indicator" id="toggleIcon"></i>
                                        <span class="sr-only">{{ translate('show_password') }} </span>
                                    </label>
                                </div>
                            </div>
                            <div class="form-group form-check d-flex justify-content-between">
                                <div>
                                    <input type="checkbox" class="form-check-input" name="remember" id="remember"
                                        {{ old('remember') ? 'checked' : '' }}>
                                    <label class="form-check-label rememberForgot custom-color-green"
                                        for="exampleCheck1">Remember me</label>
                                </div>
                                <label class="form-check-label float-end" for="exampleCheck1">
                                    <a href="{{ route('customer.auth.recover-password') }}"
                                        class="rememberForgot text-decoration-none forgot_pass custom-color-green">Forgot
                                        Password</a>
                                </label>
                            </div>
                            @php($recaptcha = getWebConfig(name: 'recaptcha'))
                            @if (isset($recaptcha) && $recaptcha['status'] != 1)
                                <div id="recaptcha_element" class="w-100" data-type="image"></div>
                                <br />
                            @else
                                <div class="row py-2">
                                    <div class="col-6 pr-2">
                                        <input type="text" class="form-control border __h-40"
                                            name="default_recaptcha_id_customer_login" value=""
                                            placeholder="{{ translate('enter_captcha_value') }}" autocomplete="off">
                                    </div>
                                    <div class="col-6 input-icons mb-2 w-100 rounded">
                                        <a href="javascript:"
                                            class="d-flex align-items-center align-items-center get-login-recaptcha-verify"
                                            data-link="{{ URL('/customer/auth/code/captcha') }}">
                                            <img src="{{ URL('/customer/auth/code/captcha/1?captcha_session_id=default_recaptcha_id_customer_login') }}"
                                                class="input-field rounded __h-40" id="customer_login_recaptcha_id"
                                                alt="">
                                            <i class="tio-refresh icon cursor-pointer p-2"></i>
                                        </a>
                                    </div>
                                </div>
                            @endif
                            <div class="d-flex gap-3 login-signup-button ">
                                <div class="">
                                    <button type="submit" class="logSin log--in btn">Login</button>
                                </div>
                                <div class="">
                                    <a class="logSin sign--in btn" href="{{ route('customer.auth.sign-up') }}">
                                        Signup
                                    </a>
                                </div>
                            </div>
                        </form>
                        <!---->
                        @if ($web_config['social_login_text'])
                            <div class="text-center m-3 text-black-50">
                                <small>{{ translate('or_continue_with') }}</small>
                            </div>
                        @endif
                        <div class="d-flex justify-content-center my-3 gap-2">
                            @foreach (getWebConfig(name: 'social_login') as $socialLoginService)
                                @if (isset($socialLoginService) && $socialLoginService['status'])
                                    <div>
                                        <a class="d-block"
                                            href="{{ route('customer.auth.service-login', $socialLoginService['login_medium']) }}">
                                            <img src="{{ theme_asset(path: 'public/assets/front-end/img/icons/' . $socialLoginService['login_medium'] . '.png') }}"
                                                alt="">
                                        </a>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                        <!---->
                    </div>
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 mt-3">
                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="{{ theme_asset(path: 'public/assets/front-end/img/image 6.jpg') }}"
                                    alt="Buyer" class="buyerImg">
                            </div>
                            <div class="carousel-item">
                                <img src="{{ theme_asset(path: 'public/assets/front-end/img/image 6.jpg') }}"
                                    alt="Buyer" class="buyerImg">
                            </div>
                            <div class="carousel-item">
                                <img src="{{ theme_asset(path: 'public/assets/front-end/img/image 6.jpg') }}"
                                    alt="Buyer" class="buyerImg">
                            </div>
                        </div>
                        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button"
                            data-slide="prev">
                            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                            <span class="sr-only">Previous</span>
                        </a>
                        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button"
                            data-slide="next">
                            <span class="carousel-control-next-icon" aria-hidden="true"></span>
                            <span class="sr-only">Next</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
        function togglePassword() {
            const passwordField = document.getElementById("passwordField");
            const toggleIcon = document.getElementById("toggleIcon");
            if (passwordField.type === "password") {
                passwordField.type = "text";
                toggleIcon.classList.replace("tio-hidden", "tio-visible"); // Update icon if visible class exists
            } else {
                passwordField.type = "password";
                toggleIcon.classList.replace("tio-visible", "tio-hidden"); // Revert icon if hidden class exists
            }
        }
    </script>
@endsection
{{-- @push('script')
@if (isset($recaptcha) && $recaptcha['status'] == 1)
<script type="text/javascript">
    "use strict";
    var onloadCallback = function() {
        grecaptcha.render('recaptcha_element', {
            'sitekey': '{{ getWebConfig(name: '
            recaptcha ')['
            site_key '] }}'
        });
    };
</script>
<script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer></script>
@endif
@endpush --}}
@push('script')
    @if (isset($recaptcha) && $recaptcha['status'] == 1)
        <script type="text/javascript">
            "use strict";
            var onloadCallback = function() {
                grecaptcha.render('recaptcha_element', {
                    'sitekey': '{{ (getWebConfig(name: 'recaptcha') ?? [])['site_key'] ?? '' }}'
                });
            };
        </script>
        <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer></script>
    @endif
@endpush
