<div class="__inline-9 rtl" style="margin-top: 5rem;">
    <footer class="page-footer  font-small mdb-color rtl">
        <div class="footer_contact">
            <div class="row align-items-center text-black">
                <div class=" py-3 footer_contact_lg_4 text-white" style="">
                    <div class="footer_get_in_touch d-flex justify-content-end align-items-center">
                        <div class="phone_logo">
                            <i class="fa fa-volume-control-phone fa-2x me-4" aria-hidden="true"
                                style="rotate: -40deg;"></i>
                        </div>
                        <div class="phone_number">
                            <span>Get in Touch</span><br>
                            <a class="text-white" href="tel: {{ $web_config['phone']->value }}" class="m-0 ">
                                {{ $web_config['phone']->value }}
                            </a>
                        </div>
                    </div>
                    <div class="clip_path_design_one">
                        <div class="clip_path_background"></div>
                    </div>
                </div>
                <div class=" py-4 freeshi_pping" style="">
                    <div class="freeshi_pping_flex">
                        @php($companyReliability = getWebConfig('company_reliability'))
                        @if ($companyReliability != null)
                            @foreach ($companyReliability as $key => $value)
                                @if ($value['status'] == 1 && !empty($value['title']))
                                    <div class="free_shipping border_left_line px-4">
                                        <div class="icon_text_align">
                                            <span><img width="35"
                                                    src="{{ getValidImage(path: 'storage/app/public/company-reliability/' . $value['image'], type: 'source', source: theme_asset(path: 'public/assets/front-end/img') . '/' . $value['item'] . '.png') }}"
                                                    alt=""></span>
                                            <div>
                                                <p class="m-0 free_shipping_head ">{{ $value['title'] }}</p>
                                                <p class="m-0 free_shipping_bottom">{{ $value['description'] }}</p>
                                            </div>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="pt-5rem footer-color-bg">
            <div class="text-center __pb-13px pb-0 container">
                <div class="row mt-3 justify-content-center">
                    <div class="col-lg-4 col-md-12 footer-web-logo text-center text-md-start px-4 mr-auto footer-info">
                        <div class="as_footer_logo">
                            <a href="{{ url('/') }}">
                                <img class="{{ Session::get('direction') === 'rtl' ? 'rightalign' : '' }}"
                                    src="{{ asset('storage/app/public/company/') }}/{{ $web_config['footer_logo']->value }}"
                                    onerror="this.src='{{ asset('public/assets/front-end/img/image-place-holder.png') }}'"
                                    alt="{{ $web_config['name']->value }}">
                            </a>
                        </div>
                        <p class="mt-2 footer-brand_desc">
                            खाना त हामी लयाउछौ, मायाले पकाउनु ल
                        </p>
                        <div class="text-nowrap mb-4 position-relative">
                            <form action="{{ route('subscription') }}" method="post">
                                @csrf
                                <input type="email" name="subscription_email"
                                    class="form-control subscribe-border text-align-direction p-12px subscription-input mt-3"
                                    placeholder="{{ translate('your_Email_Address') }}" required>
                                <button class="subscribe-button position-unset" type="submit">
                                    {{ translate('subscribe') }}
                                </button>
                            </form>
                        </div>
                        <div
                            class="max-sm-100 justify-content-start d-flex flex-wrap mt-md-3 mt-0 mb-md-3 text-align-direction footer-social_media">
                            @if ($web_config['social_media'])
                                @foreach ($web_config['social_media'] as $item)
                                    <span class="social-media ">
                                        @if ($item->name == 'twitter')
                                            <a class="social-btn  sb-light sb-{{ $item->name }} me-2 mb-2 d-flex justify-content-center align-items-center"
                                                target="_blank" href="{{ $item->link }}">
                                                {{-- <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="16"
                                                    height="16" viewBox="0 0 24 24">
                                                    <g opacity=".3">
                                                        <polygon fill="#fff" fill-rule="evenodd"
                                                            points="16.002,19 6.208,5 8.255,5 18.035,19"
                                                            clip-rule="evenodd">
                                                        </polygon>
                                                        <polygon points="8.776,4 4.288,4 15.481,20 19.953,20 8.776,4">
                                                        </polygon>
                                                    </g>
                                                    <polygon fill-rule="evenodd"
                                                        points="10.13,12.36 11.32,14.04 5.38,21 2.74,21"
                                                        clip-rule="evenodd">
                                                    </polygon>
                                                    <polygon fill-rule="evenodd"
                                                        points="20.74,3 13.78,11.16 12.6,9.47 18.14,3"
                                                        clip-rule="evenodd">
                                                    </polygon>
                                                    <path
                                                        d="M8.255,5l9.779,14h-2.032L6.208,5H8.255 M9.298,3h-6.93l12.593,18h6.91L9.298,3L9.298,3z"
                                                        fill="currentColor">
                                                    </path>
                                                </svg> --}}
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24">
                                                    <path fill="currentColor"
                                                            d="M12.75 2h2.5c.2 1.1.8 2 1.7 2.6c.6.4 1.3.6 2 .7v2.5c-.9 0-1.9-.2-2.8-.7v6.7c0 3.2-2.6 5.8-5.8 5.8S4.5 16.9 4.5 13.7
                                                            s2.6-5.8 5.8-5.8c.3 0 .6 0 .9.1v2.6c-.3-.1-.6-.1-.9-.1c-1.7 0-3.1 1.4-3.1 3.1s1.4 3.1 3.1 3.1s3.1-1.4 3.1-3.1V2z"/>
                                                </svg>

                                            </a>
                                        @else
                                            <a class="social-btn  sb-light sb-{{ $item->name }} me-2 mb-2"
                                                target="_blank" href="{{ $item->link }}">
                                                <i class="{{ $item->icon }} " aria-hidden="true"></i>
                                            </a>
                                        @endif
                                    </span>
                                @endforeach
                            @endif
                        </div>
                    </div>
                    <div class="col-lg-2 col-md-4 mt-3 col-sm-6 col-12 footer-web-logo text-center text-md-start">
                        <h6 class="text-uppercase font-semi-bold footer-header text-def footer-head">
                            Our Company
                        </h6>
                        <ul class="widget-list __pb-10px">
                            <li class="widget-list-item">
                                <a class="widget-list-link" href="{{ url('/') }}">
                                    Home
                                </a>
                            </li>
                            <li class="widget-list-item">
                                <a class="widget-list-link" href="{{ route('about-us') }}">
                                    About
                                </a>
                            </li>
                            <li class="widget-list-item">
                                <a class="widget-list-link" href="{{ route('products') }}">
                                    Products
                                </a>
                            </li>
                            <li class="widget-list-item">
                                @if (auth('customer')->check())
                                    <a class="widget-list-link" href="{{ route('account-tickets') }}">
                                        <span>
                                            {{ translate('support_ticket') }}
                                        </span>
                                    </a>
                                @else
                                    <a class="widget-list-link" href="{{ route('customer.auth.login') }}">
                                        <span>
                                            {{ translate('support_ticket') }}
                                        </span>
                                    </a>
                                @endif
                            </li>
                            {{-- <li class="widget-list-item">
                                <a class="widget-list-link" href="{{ url('faq') }}">
                                    FAQ
                                </a>
                            </li> --}}
                        </ul>
                    </div>
                    <div class="col-lg-2 col-md-4 mt-3 col-sm-6 col-12 footer-web-logo text-center text-md-start">
                        <h6 class="text-uppercase font-semi-bold footer-header text-def footer-head">
                            Special
                        </h6>
                        <ul class="widget-list __pb-10px">
                            <li class="widget-list-item">
                                <a class="widget-list-link"
                                    href="{{ route('products', ['data_from' => 'featured', 'page' => 1]) }}">
                                    {{ translate('featured_products') }}
                                </a>
                            </li>
                            <li class="widget-list-item">
                                <a class="widget-list-link"
                                    href="{{ route('products', ['data_from' => 'latest', 'page' => 1]) }}">
                                    {{ translate('latest_products') }}
                                </a>
                            </li>
                            <li class="widget-list-item">
                                <a class="widget-list-link"
                                    href="{{ route('products', ['data_from' => 'best-selling', 'page' => 1]) }}">
                                    {{ translate('best_selling_product') }}
                                </a>
                            </li>
                            <li class="widget-list-item">
                                <a class="widget-list-link"
                                    href="{{ route('products', ['data_from' => 'top-rated', 'page' => 1]) }}">
                                    {{ translate('top_rated_product') }}
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="col-lg-3 col-md-4 mt-3 col-sm-6 col-12 footer-web-logo text-center text-md-start">
                        <h6 class="text-uppercase font-semi-bold footer-header text-def footer-head">
                            Info
                        </h6>
                        @php($refund_policy = getWebConfig(name: 'refund-policy'))
                        @php($return_policy = getWebConfig(name: 'return-policy'))
                        @php($cancellation_policy = getWebConfig(name: 'cancellation-policy'))
                        @if (auth('customer')->check())
                            <ul class="widget-list __pb-10px">
                                <li class="widget-list-item">
                                    <a class="widget-list-link" href="{{ route('user-account') }}">
                                        {{ translate('profile_info') }}
                                    </a>
                                </li>
                                <li class="widget-list-item">
                                    <a class="widget-list-link" href="{{ route('track-order.index') }}">
                                        {{ translate('track_order') }}
                                    </a>
                                </li>
                                @if (isset($refund_policy['status']) && $refund_policy['status'] == 1)
                                    <li class="widget-list-item">
                                        <a class="widget-list-link" href="{{ route('refund-policy') }}">
                                            Return & Refund Policy
                                        </a>
                                    </li>
                                @endif
                                @if (isset($cancellation_policy['status']) && $cancellation_policy['status'] == 1)
                                    <li class="widget-list-item">
                                        <a class="widget-list-link" href="{{ route('cancellation-policy') }}">
                                            {{ translate('cancellation_policy') }}
                                        </a>
                                    </li>
                                @endif
                            </ul>
                        @else
                            <ul class="widget-list __pb-10px">
                                <li class="widget-list-item">
                                    <a class="widget-list-link"
                                        href="{{ route('customer.auth.login') }}">{{ translate('profile_info') }}</a>
                                </li>
                                <li class="widget-list-item">
                                    <a class="widget-list-link"
                                        href="{{ route('track-order.index') }}">{{ translate('track_order') }}</a>
                                </li>
                                @if (isset($refund_policy['status']) && $refund_policy['status'] == 1)
                                    <li class="widget-list-item">
                                        <a class="widget-list-link"
                                            href="{{ route('refund-policy') }}">{{ translate('refund_policy') }}</a>
                                    </li>
                                @endif
                                @if (isset($return_policy['status']) && $return_policy['status'] == 1)
                                    <li class="widget-list-item">
                                        <a class="widget-list-link"
                                            href="{{ route('return-policy') }}">{{ translate('return_policy') }}</a>
                                    </li>
                                @endif
                                @if (isset($cancellation_policy['status']) && $cancellation_policy['status'] == 1)
                                    <li class="widget-list-item">
                                        <a class="widget-list-link"
                                            href="{{ route('cancellation-policy') }}">{{ translate('cancellation_policy') }}</a>
                                    </li>
                                @endif
                            </ul>
                        @endif
                    </div>
                </div>
            </div>
            <div class="container">
                <div class="row footer-bottom w-100 p-2" style="background: #191d28;">
                    <div class="col-md-4 col-sm-6 col-12 footer-additional-content">
                        <div class="foot-bottom-copyright text-white text-start text-sm-center w-90 margin-copyright ps-3">
                            {{ $web_config['copyright_text']->value }}
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 col-12 row footer-additional-content">
                        <div class="row justify-content-center gap-2 w-100">
                            <div class="">
                                <div class="supported-payment-box">
                                    <img src="{{ asset('public/assets/front-end/img/added/visa.png') }}"
                                        alt="">
                                </div>
                            </div>
                            <div class="">
                                <div class="supported-payment-box">
                                    <img src="{{ asset('public/assets/front-end/img/added/mastercard.png') }}"
                                        alt="">
                                </div>
                            </div>
                            <div class="">
                                <div class="supported-payment-box">
                                    <img src="{{ asset('public/assets/front-end/img/added/payoneer.png') }}"
                                        alt="">
                                </div>
                            </div>
                            <div class="">
                                <div class="supported-payment-box">
                                    <img src="{{ asset('public/assets/front-end/img/added/paypal.png') }}"
                                        alt="">
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 col-12 footer-additional-content">
                        <div class="row w-100">
                            <div class="col-6 foot-bottom-copyright  text-center w-100">
                                <a class="text-white" href="{{ url('terms-and-condition') }}">
                                    Terms & conditions
                                </a>
                            </div>
                            <div class="col-6 foot-bottom-copyright  text-center w-100">
                                <a class="text-white" href="{{ url('privacy-policy') }}">
                                    Privacy Policy
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @php($cookie = $web_config['cookie_setting'] ? json_decode($web_config['cookie_setting']['value'], true) : null)
        @if ($cookie && $cookie['status'] == 1)
            <section id="cookie-section"></section>
        @endif
    </footer>
</div>
