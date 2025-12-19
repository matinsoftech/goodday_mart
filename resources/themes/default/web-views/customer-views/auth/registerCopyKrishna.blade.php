<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | Gooday Mart Ecommerce</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css"
        integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css"
        integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

	<link rel="stylesheet" href="{{ asset('public/assets/front-end/css/signupIn.css') }}">

</head>

<body>

  @include('layouts.front-end.partials._header')
    <div class="container mt-4">
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb">
                <li class="breadcrumb-item"><a href="#">Home</a></li>
                <li class="breadcrumb-item active" aria-current="page">Sign Up</li>
            </ol>
        </nav>

    <div class="signin">
        <div class="row">
            <div class="col-5 forms">
                <h1 class="signInTitle">Sign Up</h1>
                <p class="signInSubTitle">Please fill your details to access your account.</p>
                <form class="needs-validation_ mt-3" id="customer-register-form" action="{{ route('customer.auth.sign-up')}}" method="post">
                  @csrf
                    <div class="form-group">
                         <!--<input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="First Name"> -->
                         <input class="form-control text-align-direction" value="{{ old('f_name')}}" type="text" name="f_name" placeholder="{{ translate('First name') }}" required >
						 <div class="invalid-feedback">{{ translate('please_enter_your_first_name')}}!</div>
                    </div>
                    <div class="form-group">
                        <!--<input type="text" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Last Name">-->
                        <input class="form-control text-align-direction" type="text" value="{{old('l_name') }}" name="l_name" placeholder="{{ translate('Last name') }}" required>
                        <div class="invalid-feedback">{{ translate('please_enter_your_last_name') }}!</div>
                    </div>
                    <div class="form-group">
                       <!-- <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Email address">-->
                      <input class="form-control text-align-direction" type="email" value="{{old('email') }}" name="email" placeholder="{{ translate('enter_email_address') }}" autocomplete="off" required>
                      <div class="invalid-feedback">{{ translate('please_enter_valid_email_address') }}!</div>
                    </div>
                  
                  <div class="form-group">
                    <small class="text-primary">( * {{ translate('country_code_is_must_like_for_BD') }} 880 )</small>
                    <input class="form-control text-align-direction phone-input-with-country-picker"
                           type="tel"  value="{{ old('phone') }}"
                           placeholder="{{ translate('enter_phone_number') }}" required>

                    <input type="hidden" class="country-picker-phone-number w-50" name="phone" readonly>
                  </div>
                  
                    <div class="form-group">
                      <!--<input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">-->
                      <small class="text-danger mx-1 password-error form-label font-semibold d-none"></small>
                      <input class="form-control text-align-direction" name="password" type="password" id="si-password" placeholder="{{ translate('minimum_8_characters_long') }}" required>
                    </div>
                    <div class="form-group form-check d-flex justify-content-between">
                        <div>
                           <input type="checkbox" class="form-check-input" id="exampleCheck1">
                          	<!-- <input type="checkbox" class="form-check-input custom-control-input" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>-->
                            <label class="form-check-label rememberForgot" for="exampleCheck1">Remember me</label>
                        </div>
                        <label class="form-check-label float-end" for="exampleCheck1">
                            <a href="{{route('customer.auth.recover-password')}}" class="rememberForgot text-decoration-none forgot_pass ">Forgot Password</a>
                        </label>
                    </div>

                    <div class="d-flex">
                        <button type="submit" class="logSin btn btn-success">Sign up</button>
                    </div>
                </form>

                <div class="mt-2">
                    <p class="signInSubTitle text-center">or Sign in with</p>
                    <a href="#" class="signGoogle btn btn-outline-dark ">Sign in with Google</a> 
                </div>
            </div>

            <div class="col-1"></div>

            <div class="col-5 mt-5">
                <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
                    <ol class="carousel-indicators">
                        <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                        <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
                    </ol>
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="{{ theme_asset(path: 'public/assets/front-end/img/image 6.jpg') }}" alt="Buyer" class="buyerImg ">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ theme_asset(path: 'public/assets/front-end/img/image 6.jpg') }}" alt="Buyer" class="buyerImg">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ theme_asset(path: 'public/assets/front-end/img/image 6.jpg') }}" alt="Buyer" class="buyerImg">
                        </div>
                    </div>
                    <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="sr-only">Previous</span>
                    </a>
                    <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="sr-only">Next</span>
                    </a>
                </div>
            </div>

        </div>
    </div>
      </div>
      @include('layouts.front-end.partials._footer')
      
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.2.4/jquery.min.js"
        integrity="sha512-DUC8yqWf7ez3JD1jszxCWSVB0DMP78eOyBpMa5aJki1bIRARykviOuImIczkxlj1KhVSyS16w2FSQetkD4UU2w=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx"
        crossorigin="anonymous"></script>
  	<!--<script src="{{ theme_asset(path: 'public/assets/front-end/plugin/intl-tel-input/js/intlTelInput.js') }}"></script>-->
  <!--<script src="{{ theme_asset(path: 'public/assets/front-end/js/country-picker-init.js') }}"></script>-->
  <script src="{{ asset('public/assets/front-end/plugin/intl-tel-input/js/intlTelInput.js') }}"></script>
  <script src="{{ asset('public/assets/front-end/js/country-picker-init.js') }}"></script>
  
    
    <script src="script.js"></script>
</body>

</html>