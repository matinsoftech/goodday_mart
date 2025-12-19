@extends('layouts.front-end.app')
@section('title', translate('register'))
@push('css_or_js')
    <link rel="stylesheet"
        href="{{ theme_asset(path: 'public/assets/front-end/plugin/intl-tel-input/css/intlTelInput.css') }}">
@endpush
<style>
    .signin .sign-in-container {
        padding: 30px 40px;
        border-radius: 12px;
        background: #ffffff;
    }
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
    .signin .form-group .form-control {
        border: 1px solid #078A3A;
    }
    .signin input::placeholder {
        color: #078A3A;
        font-weight: 600;
        font-size: 16px;
    }
    .signin .form-width {
        width: 370px;
    }
    .signin .carousal-image-section {
        padding: 0 12px 0 60px;
    }
    .web-direction .btn---primary {
        background: #078A3A;
        padding: 4px 20px;
        border-radius: 4px;
        font-weight: 600;
        font-size: 16px;
        color: #ffffff;
    }
    @media (max-width:992px) {
        .signin .sign-in-container {
            padding: 20px 8px !important;
        }
        .signin .form-width {
            width: 100%;
        }
    }
    @media (max-width:768px) {
        .signin .carousal-image-section {
            padding: 0 15px;
        }
    }
</style>
@section('content')
    <div class="container mt-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Sign Up</li>
            </ol>
        </nav>
        <div class="signin">
            <div class="row sign-in-container">
                <div class="col-lg-6 col-md-6 col-sm-12 forms">
                    <h1 class="signInTitle">Sign Up</h1>
                    <p class="signInSubTitle">Please fill your details to access your account.</p>
                    <form class="needs-validation_ mt-3 form-width" id="customer-register-form"
                        action="{{ route('customer.auth.sign-up') }}" method="post">
                        @csrf
                        <div class="form-group">
                            <!--<input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="First Name"> -->
                            <input class="form-control text-align-direction" value="{{ old('f_name') }}" type="text"
                                name="f_name" placeholder="{{ translate('First name') }}" required>
                            <div class="invalid-feedback">{{ translate('please_enter_your_first_name') }}!</div>
                        </div>
                        <div class="form-group">
                            <!--<input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Last Name">-->
                            <input class="form-control text-align-direction" type="text" value="{{ old('l_name') }}"
                                name="l_name" placeholder="{{ translate('Last name') }}" required>
                            <div class="invalid-feedback">{{ translate('please_enter_your_last_name') }}!</div>
                        </div>
                        <div class="form-group">
                            <!-- <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Email address">-->
                            <input class="form-control text-align-direction" type="email" value="{{ old('email') }}"
                                name="email" placeholder="{{ translate('enter_email_address') }}" autocomplete="off"
                                required>
                            <div class="invalid-feedback">{{ translate('please_enter_valid_email_address') }}!</div>
                        </div>
                        <div class="form-group">
                            {{-- <label class="form-label font-semibold">{{ translate('phone_number') }}
                                <small class="text-primary">( * {{ translate('country_code_is_must_like_for_BD') }} 880 )</small></label> --}}
                            <input class="form-control text-align-direction phone-input-with-country-picker" type="tel"
                                value="{{ old('phone') }}" placeholder="{{ translate('enter_phone_number') }}" required>
                            <input type="hidden" class="country-picker-phone-number w-50" name="phone" readonly>
                        </div>
                        <div class="form-group">
                            <div class="password-toggle rtl">
                                <small class="text-danger mx-1 password-error"></small>
                                <input class="form-control text-align-direction" name="password" type="password"
                                    id="s-password" placeholder="{{ translate('Password') }}" required>
                                <label class="password-toggle-btn">
                                    <!--<input class="custom-control-input" type="checkbox">-->
                                    <i class="tio-hidden password-toggle-indicator"></i><span
                                        class="sr-only">{{ translate('show_password') }} </span>
                                </label>
                            </div>
                        </div>
                        <div class="form-group">
                            {{-- <label class="form-label font-semibold">{{ translate('confirm_password') }}</label> --}}
                            <div class="password-toggle rtl">
                                <input class="form-control text-align-direction" name="password_confirmation"
                                    type="password" placeholder="{{ translate('Confirm Password') }}" id="si-password"
                                    required>
                                <label class="password-toggle-btn">
                                    <!--<input class="custom-control-input text-align-direction" type="checkbox">-->
                                    <i class="tio-hidden password-toggle-indicator"></i>
                                    <span class="sr-only">{{ translate('show_password') }}</span>
                                </label>
                            </div>
                        </div>
                        {{-- <div class="form-group form-check d-flex justify-content-between">
                            <div>
                                <input type="checkbox" class="form-check-input" id="exampleCheck1">
                                <label class="form-check-label rememberForgot" for="exampleCheck1">Remember me</label>
                            </div>
                            <label class="form-check-label float-end" for="exampleCheck1">
                                <a href="{{ route('customer.auth.recover-password') }}"
                                    class="rememberForgot text-decoration-none forgot_pass ">Forgot Password</a>
                            </label>
                        </div> --}}
                        <div class="col-12">
                            <div class="row g-3">
                                <div class="col-sm-12">
                                    <div class="rtl">
                                        <label class="custom-control custom-checkbox m-0 d-flex">
                                            <input type="checkbox" class="custom-control-input" name="remember"
                                                id="inputChecked">
                                            <span class="custom-control-label">
                                                <span>{{ translate('i_agree_to_Your') }}</span> <a
                                                    class="font-size-sm text-primary text-force-underline" target="_blank"
                                                    href="{{ route('terms') }}">{{ translate('terms_and_condition') }}</a>
                                            </span>
                                        </label>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    @php($recaptcha = getWebConfig(name: 'recaptcha'))
                                    @if (isset($recaptcha) && $recaptcha['status'] != 1)
                                        <div id="recaptcha_element" class="w-100" data-type="image"></div>
                                    @else
                                        <div class="row">
                                            <div class="col-6 pr-2">
                                                <input type="text" class="form-control border __h-40"
                                                    name="default_recaptcha_value_customer_regi" value=""
                                                    placeholder="{{ translate('enter_captcha_value') }}"
                                                    autocomplete="off">
                                            </div>
                                            <div class="col-6 input-icons mb-2 w-100 rounded bg-white">
                                                <a href="javascript:"
                                                    class="d-flex align-items-center align-items-center get-regi-recaptcha-verify"
                                                    data-link="{{ URL('/customer/auth/code/captcha') }}">
                                                    <img alt=""
                                                        src="{{ URL('/customer/auth/code/captcha/1?captcha_session_id=default_recaptcha_id_customer_regi') }}"
                                                        class="input-field rounded __h-40" id="default_recaptcha_id">
                                                    <i class="tio-refresh icon cursor-pointer p-2"></i>
                                                </a>
                                            </div>
                                        </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                        <div class="web-direction">
                            <div class="mx-auto mt-4 __max-w-356">
                                <button class="btn---primary" id="sign-up" type="submit">
                                    {{ translate('sign_up') }}
                                </button>
                            </div>
                            <div class="text-black-50 mt-3 text-center">
                                <small>
                                    {{ translate('Already_have_account ') }}?
                                    <a class="text-primary text-underline" href="{{ route('customer.auth.login') }}">
                                        {{ translate('sign_in') }}
                                    </a>
                                </small>
                            </div>
                        </div>
                    </form>
                    {{-- <div class="mt-2">
                        <p class="signInSubTitle text-center">or Sign in with</p>
                        <a href="#" class="signGoogle btn btn-outline-dark ">Sign in with Google</a>
                    </div> --}}
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 carousal-image-section">
                    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                        <ol class="carousel-indicators">
                            <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                            <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                        </ol>
                        <div class="carousel-inner">
                            <div class="carousel-item active">
                                <img src="{{ theme_asset(path: 'public/assets/front-end/img/image 6.jpg') }}"
                                    alt="Buyer" class="buyerImg ">
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
@endsection
@push('script')
    @if (isset($recaptcha) && $recaptcha['status'] == 1)
        <script type="text/javascript">
            "use strict";
            var onloadCallback = function() {
                grecaptcha.render('recaptcha_element', {
                    'sitekey': '{{ getWebConfig(name: 'recaptcha')['site_key'] }}'
                });
            };
        </script>
        <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit" async defer></script>
    @endif
    <script>
        document.querySelectorAll('.password-toggle-btn').forEach(button => {
            button.addEventListener('click', function() {
                const passwordInput = this.parentElement.querySelector(
                    'input[type="password"], input[type="text"]');
                const icon = this.querySelector('.password-toggle-indicator');
                if (passwordInput.type === 'password') {
                    passwordInput.type = 'text';
                    icon.classList.remove('tio-hidden');
                    icon.classList.add('tio-visible');
                } else {
                    passwordInput.type = 'password';
                    icon.classList.remove('tio-visible');
                    icon.classList.add('tio-hidden');
                }
            });
        });
    </script>
    <script src="{{ theme_asset(path: 'public/assets/front-end/plugin/intl-tel-input/js/intlTelInput.js') }}"></script>
    <script src="{{ theme_asset(path: 'public/assets/front-end/js/country-picker-init.js') }}"></script>
@endpush
