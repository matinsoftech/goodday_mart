@extends('layouts.front-end.app')
@section('title', $web_config['name']->value . ' ' . translate('online_Shopping') . ' | ' . $web_config['name']->value .
    ' ' . translate('ecommerce'))
    @push('css_or_js')
        <link rel="stylesheet" href="{{ theme_asset(path: 'public/assets/front-end/css/home.css') }}" />
        <link rel="stylesheet" href="{{ theme_asset(path: 'public/assets/front-end/css/owl.carousel.min.css') }}">
        <link rel="stylesheet" href="{{ theme_asset(path: 'public/assets/front-end/css/owl.theme.default.min.css') }}">
        <style>
            .brand-name {
                font-size: 16px;
                font-weight: 400;
                line-height: 24px;
                letter-spacing: 0.005em;
            }

            .product-name {
                font-size: 20px !important;
                font-weight: 600;
                line-height: 24px;
                letter-spacing: 0.0015em;
            }

            .bestSelling-section {
                margin-top: 1rem;
            }

            .dealOfTheDayProducts {
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
            }

            .dealOfTheDay {
                display: grid;
                grid-template-columns: 1fr 2fr 1fr;
                grid-template-rows: 1fr 1fr;
                grid-gap: 20px;
                width: 100%;
                max-width: 1200px;
            }

            .product {
                /* ----------- Added  ---------- */
                position: relative;
                /* max-width: 290px; */
                /* ----------- Added  ---------- */
            }

            .product-card {
                background-color: #f5f5f5;
                padding: 20px;
                /* border-radius: 8px; */
                box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
                position: relative;
                text-align: center;
                border: none;
                /* box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); */
                /* transition: transform 0.2s ease-in-out; */
            }

            .product-card.large {
                grid-column: 2 / 3;
                grid-row: 1 / 3;
                text-align: left;
                position: relative;
                overflow: hidden;
            }

            .discount-label {
                position: absolute;
                top: 10px;
                left: 10px;
                background-color: color-mix(in srgb, #FF3B3B, #fff 20%);
                color: #fff;
                padding: 5px 10px;
                border-radius: 4px;
                font-size: 12px;
            }

            .discount-label.center {
                top: 5%;
                left: 31px;
                transform: translate(-50%, -50%) rotate(-45deg);
                padding: 42px 82px;
                font-size: 16px;
            }

            .product-category {
                color: #727272;
                font-size: 16px;
                font-weight: 400;
                margin-bottom: 5px;
            }

            .rating {
                margin-top: 5px;
            }

            .price {
                margin: 10px 0;
            }

            .new-price {
                color: #e60000;
                font-weight: bold;
                font-size: 20px;
            }

            .old-price {
                color: #999;
                text-decoration: line-through;
                margin-left: 10px;
            }

            .shop-now {
                background-color: #007bff;
                color: #fff;
                padding: 10px 20px;
                border: none;
                border-radius: 4px;
                cursor: pointer;
                margin-top: 15px;
            }

            .countdown {
                display: flex;
                justify-content: space-between;
                margin: 10px 0;
            }

            .time {
                background-color: #e6e6e6;
                padding: 5px 10px;
                border-radius: 4px;
            }

            .availability {
                margin: 10px 0;
                font-size: 14px;
                color: #555;
            }

            .icons {
                display: flex;
                justify-content: space-between;
                margin-top: 10px;
            }

            .icons button {
                background: none;
                border: none;
                cursor: pointer;
                font-size: 18px;
            }

            .custom-card {
                width: 100%;
                /* height: 300px; */
                border: none;
                position: relative;
                background-color: #D9D9D9;
                margin-bottom: 0;
            }

            .custom-long-card {
                width: 100%;
                height: 300px;
                border: none;
                position: relative;
                background-color: #D9D9D9;
                margin-bottom: 0;
            }

            .category-badge {
                position: absolute;
                top: 10px;
                left: 10px;
                font-size: 14px;
                font-weight: 500;
                border-radius: 15px;
                background-color: #FFFFFF;
                color: #000;
            }

            .card-body {
                display: flex;
                flex-direction: column;
                justify-content: flex-end;
                height: 100%;
            }

            .add-to-cart {
                width: 100%;
                padding: 10px;
                background-color: #4759ff;
                color: #ffffff;
                border: none;
                border-radius: 10px;
                font-size: 14px;
                cursor: pointer;
                transition: background-color 0.3s ease;
            }

            .add-to-cart:hover {
                background-color: #3c4ed0;
                color: white;
            }

            .actions {
                position: absolute;
                top: 10px;
                right: 10px;
                /* 40px */
                display: flex;
                flex-direction: column;
            }

            .action-btn {
                margin-bottom: 5px;
                width: 40px;
                height: 40px;
                background: white;
                border: none;
                padding: 10px;
                border-radius: 50px 50px;
                cursor: pointer;
                font-size: 18px;
            }

            .arrow {
                font-size: 20px;
                color: #727272;
                cursor: pointer;
                padding: 0 20px;
            }

            .arrow-container {
                display: flex;
                align-items: center;
                justify-content: center;
            }

            .availability {
                margin: 10px 0;
                font-size: 16px;
                font-weight: 500;
                color: #727272;
            }

            .bg-blue {
                background-color: #74A4D0;
            }

            .bg-orange {
                background-color: #E79142;
            }

            .bg-purple {
                background-color: #CB58E0;
            }

            .box {
                box-shadow: rgba(0, 0, 0, 0.4) 0px 2px 4px, rgba(0, 0, 0, 0.3) 0px 7px 13px -3px, rgba(0, 0, 0, 0.2) 0px -3px 0px inset;
                margin-right: 5px;
                border-radius: 5px;
                font-weight: 500;
                font-size: 16px;
            }

            .card-body {
                display: flex;
                flex-direction: column;
                justify-content: flex-end;
                height: 100%;
            }

            .carding {
                /* width: 247px; */
                height: 300px;
                /* background-color: color-mix(in srgb, #606BBF, #fff 90%); */
                border-radius: 15px;
                display: flex;
                justify-content: center;
                align-items: center;
                border: none;
                position: relative;
                cursor: pointer;
            }

            .card-border {
                border: 1px solid black;
            }

            .product-hover_details .carding {
                /* top: -25px;
                                                                                                                                                                                                                                                                                                                                                                                left: -10px; */
                left: -10px;
                */ width: 246px;
                width: 100%;
                margin-right: 10px;
            }

            .product-hover_details .carding img {
                border-radius: 15px;
            }

            .category-badge {
                position: absolute;
                top: 10px;
                left: 10px;
                font-size: 14px;
                font-weight: 500;
                border-radius: 15px;
                background-color: #FFFFFF;
                color: #000;
            }

            .color-box {
                width: 30px;
                height: 30px;
            }

            .color-box-small {
                display: flex;
            }

            .color-box1 {
                background-color: gray;
            }

            .color-box2 {
                background-color: rgb(109, 30, 30);
            }

            .color-box3 {
                background-color: rgb(116, 79, 79);
            }

            .color-box4 {
                background-color: rgb(133, 141, 24);
            }

            .color-box5 {
                background-color: rgb(194, 102, 163);
            }

            .countdown {
                display: flex;
                justify-content: space-between;
                margin: 10px 0;
            }

            .custom-card {
                width: 100%;
                /* height: 300px; */
                border: none;
                position: relative;
                background-color: #D9D9D9;
                margin-bottom: 0;
            }

            .custom-long-card {
                width: 100%;
                height: 300px;
                border: none;
                position: relative;
                background-color: #D9D9D9;
                margin-bottom: 0;
            }

            .dealOfTheDay {
                display: grid;
                grid-template-columns: 1fr 2fr 1fr;
                grid-template-rows: 1fr 1fr;
                grid-gap: 20px;
                width: 100%;
                max-width: 1200px;
            }

            .dealOfTheDayProducts {
                display: flex;
                justify-content: center;
                align-items: center;
                height: 100vh;
            }

            .discount-label {
                position: absolute;
                top: 10px;
                left: 10px;
                background-color: color-mix(in srgb, #FF3B3B, #fff 20%);
                color: #fff;
                padding: 5px 10px;
                border-radius: 4px;
                font-size: 12px;
            }

            .discount-label.center {
                top: 5%;
                left: 31px;
                transform: translate(-50%, -50%) rotate(-45deg);
                padding: 42px 82px;
                font-size: 16px;
            }

            .fourth-box {
                background-color: #FFB4B4;
                border: none;
            }

            .gallery {
                display: flex;
                flex-direction: column;
                justify-content: space-between;
                display: none;
            }

            .gallery figure {
                border-radius: 10px;
                border: 1px solid color-mix(in srgb, #606BBF, #fff 90%);
                background-color: color-mix(in srgb, #606BBF, #fff 90%);
                width: 100%;
                /* height: 63px */
                height: 59.3px;
                cursor: pointer;
            }

            .gallery figure img {
                width: 100%;
                display: block;
                border-radius: inherit;
            }

            .product-hover_details {
                position: absolute;
                top: -16px;
                left: -16px;
                padding: 1rem;
                border-radius: 15px;
                z-index: 4;
                /* width: 370px; */
                box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
                background-color: #fff;
                /* cursor: pointer; */
            }

            .latest_product_hover:hover {
                height: 250px;
                height: 175px;
            }

            .image-placeholder {
                height: 200px;
                background-color: #f0f0f5;
                border-radius: 10px;
                margin-bottom: 15px;
            }

            .icons {
                margin-top: 15px;
                margin-right: 10px;
            }

            .icons button {
                background: white;
                padding: 10px;
                border-radius: 50px 50px;
                border: none;
                cursor: pointer;
                font-size: 18px;
            }

            .main-details {
                display: block;
            }

            .new-badge {
                top: 10px;
                left: 10px;
                z-index: 1;
                font-size: 0.8rem;
                padding: 5px 10px;
            }

            .new-price {
                color: color-mix(in srgb, #FF3B3B, #fff 20%);
                font-weight: 600;
                font-size: 20px;
            }

            .old-price {
                font-weight: 500;
                font-size: 16px;
                color: color-mix(in srgb, #1F3C74, #000000 50%);
                text-decoration: line-through;
                margin-left: 10px;
            }

            .p {
                font-weight: 600;
                font-size: 20px;
            }

            .promo-card {
                padding: 10px 20px;
                margin-bottom: 20px;
            }

            .product {
                position: relative;
            }

            .product-card {
                background-color: #f5f5f5;
                padding: 20px;
                box-shadow: 0 2px 8px rgba(0, 0, 0, 0.1);
                position: relative;
                text-align: center;
                border: none;
                transition: transform 0.2s ease-in-out;
            }

            .product-card.large {
                grid-column: 2 / 3;
                grid-row: 1 / 3;
                text-align: left;
                position: relative;
                overflow: hidden;
            }

            /* .product-card:hover {
                                                                                                                                                                                                                                                                                                                                                                                transform: scale(1.05);
                                                                                                                                                                                                                                                                                                                                                                            } */
            .product-category {
                color: #727272;
                font-size: 16px;
                font-weight: 400;
                margin-bottom: 5px;
            }

            .product-colors {
                display: flex;
                gap: 5px;
                /* margin-bottom: 15px; */
            }

            .product-tags {
                display: flex;
                gap: 5px;
                justify-content: center;
                margin-bottom: 5px;
            }

            /* Range */
            .progress {
                background-color: #f8f9fa;
                border-radius: 50px;
                height: 15px;
                overflow: hidden;
            }

            .progress-bar {
                background-color: #1f3c74;
                border-radius: 50px;
                height: 100%;
                width: 80%;
            }

            /* Range */
            .ribbon {
                position: absolute;
                padding: 5px 10px;
                font-size: 12px;
                font-weight: bold;
                color: white;
                z-index: 3;
                top: 20px;
                left: -13px;
                clip-path: polygon(100% 0, 85% 50%, 100% 100%, 10% 100%, 10% 0%);
                box-shadow: rgba(9, 30, 66, 0.25) 0px 4px 8px -2px, rgba(9, 30, 66, 0.08) 0px 0px 0px 1px;
            }

            .ribbon-new {
                top: 45px;
                left: -6px;
                width: 60px;
                display: flex;
                justify-content: center;
                align-items: center;
                background-color: #1F3C74;
                z-index: 1;
                font-size: 12px;
                font-weight: 400;
                line-height: 20px;
                letter-spacing: 0.0025em;
                height: 20px;
            }

            .ribbon-sale {
                background-color: color-mix(in srgb, #FF3B3B, #fff 20%);
                display: flex;
                justify-content: start;
                align-items: center;
                width: 130px;
                font-size: 11px;
                font-weight: 400;
                padding-left: 1rem;
                height: 20px;
            }

            .row>.col-md-3,
            .row>.col-md-6 {
                padding-right: 10px;
                padding-left: 10px;
            }

            .shop-now {
                background-color: #1F3C74;
                color: #fff;
                padding: 10px 20px;
                border: none;
                border-radius: 15px;
                cursor: pointer;
                margin-top: 15px;
                font-weight: 800;
                font-size: 16px;
            }

            .shop-now:hover {
                background-color: #0056b3;
            }

            .slider {
                padding: 5px;
                border: 1px solid;
            }

            .span.bold-subtitle {
                font-size: 20px;
                font-weight: 600;
            }

            .tag {
                /* background-color: #e0e0e0; */
                border-radius: 5px;
                padding: 5px;
                font-size: 12px;
                color: #555555;
                box-shadow: rgba(0, 0, 0, 0.25) 0px 0.0625em 0.0625em, rgba(0, 0, 0, 0.25) 0px 0.125em 0.5em, rgba(255, 255, 255, 0.1) 0px 0px 0px 1px inset;
            }

            .timer {
                width: 250px;
                position: absolute;
                bottom: 12px;
                padding: 8px 8px 0 8px;
                left: 50%;
                transform: translateX(-50%);
            }

            .time {
                background-color: #ffffff;
                text-align: center;
                padding: 10px 5px;
                border-radius: 4px;
                margin: 0 5px;
                box-shadow: rgba(0, 0, 0, 0.24) 0px 3px 8px;
            }

            .time-box {
                background-color: #ffffff;
                border-radius: 5px;
                width: 22%;
                box-shadow: rgba(50, 50, 93, 0.25) 0px 6px 12px -2px, rgba(0, 0, 0, 0.3) 0px 3px 7px -3px;
            }

            .number {
                font-size: 16px;
                font-weight: 500;
                color: #606BBF;
                color: color-mix(in srgb, #606BBF, #000000 50%);
            }

            .label {
                font-size: 16px;
                font-weight: 500;
                color: #727272;
            }

            .latest-slider .owl-stage-outer .owl-stage .owl-item.active {
                z-index: 1;
            }

            .testimonial_sec .wrap {
                padding: 2rem;
                border-radius: 8px;
                background-color: #078A3A;
            }

            .testimonial_sec .wrap .item figure {
                width: 5rem;
                height: 5rem;
            }

            .testimonial_sec .wrap .item figure img {
                width: 100%;
                object-fit: cover;
            }

            .testimonial_sec .wrap .item .testimonial {
                max-width: 60ch;
                margin: 0 auto;
            }

            .featured_sec {
                margin: 0;
            }

            .featured_sec figure {
                margin: 0;
                max-height: unset !important;
                height: 100%;
            }

            .featured_sec .wrap .featured {
                gap: 1rem;
                display: grid;
                grid-template-columns: 1fr 1.5fr;
                grid-template-rows: 1fr 1fr;
            }

            .featured_sec .wrap .featured .main {
                grid-row: 1/-1;
            }

            .featured_sec .wrap .featured .main img {
                /*height: 510px;*/
                height: 100%;
            }

            .rect figure img {
                /*height: 250px;*/
                height: 100% !important;
            }

            @media screen and (max-width: 720px) {
                .featured_sec .wrap .featured {
                    display: flex;
                    flex-direction: column;
                    align-items: center;
                    justify-content: center;
                }

                .featured_sec .wrap .featured .main img,
                .rect figure img {
                    object-fit: contain;
                    height: auto !important;
                }

                #owl-testimonial .owl-nav {
                    display: none !important;
                }
            }
        </style>
    @endpush
@section('content')
    <div class="__inline-61">
        @php($decimalPointSettings = !empty(getWebConfig(name: 'decimal_point_settings')) ? getWebConfig(name: 'decimal_point_settings') : 0)
        <section class="bg-transparent">
            <div class="position-relative">
                @include('web-views.partials._home-top-slider', ['main_banner' => $main_banner])
            </div>
        </section>
        <!-- New Switch sliders this is needed -->
        <div class="container py-4 rtl px-0 px-md-3" style="overflow-x: hidden;">
            @include('web-views.partials._muntiple-slider', [
                'product' => $product,
                'decimal_point_settings' => $decimalPointSettings,
            ])
        </div>
        <!-- New Switch sliders Ends -->
        @if ($web_config['flash_deals'] && count($web_config['flash_deals']->products) > 0)
            @include('web-views.partials._flash-deal', ['decimal_point_settings' => $decimalPointSettings])
        @endif
        @include('web-views.partials._category-section-home')

        @include('web-views.partials.infinite-slider')

        <!-- Featured Products Slider Start -->
        <div class="featured_sec pb-5">
            <div class="wrap container">
                <div class="featured">
                    <div class="main">
                        <figure>
                            <img src="{{ asset('public/assets/front-end/img/added/left-banner.jpg') }}" alt="Banner 1">
                        </figure>
                    </div>
                    <div class="rect">
                        <figure>
                            <img src="{{ asset('public/assets/front-end/img/added/right-top-banner.jpg') }}" alt="">
                        </figure>
                    </div>
                    <div class="rect">
                        <figure>
                            <img src="{{ asset('public/assets/front-end/img/added/right-bottom-banner.jpg') }}"
                                alt="">
                        </figure>
                    </div>
                </div>
            </div>
        </div>

        @if ($web_config['featured_deals'] && count($web_config['featured_deals']) > 0)
            <section class="featured_deal my-5">
                <div class="container">
                    <div class="__featured-deal-wrap bg--light">
                        <div class="d-flex flex-wrap justify-content-between gap-8 mb-3">
                            <div class="w-0 flex-grow-1">
                                <span
                                    class="featured_deal_title font-bold text-dark">{{ translate('featured_deal') }}</span>
                                <br>
                                <span
                                    class="text-left text-nowrap">{{ translate('see_the_latest_deals_and_exciting_new_offers') }}!</span>
                            </div>
                            <div>
                                <a class="text-capitalize view-all-text web-text-primary"
                                    href="{{ route('products', ['data_from' => 'featured_deal']) }}">
                                    {{ translate('view_all') }}
                                    <i
                                        class="czi-arrow-{{ Session::get('direction') === 'rtl' ? 'left mr-1 ml-n1 mt-1' : 'right ml-1' }}"></i>
                                </a>
                            </div>
                        </div>
                        <div class="owl-carousel owl-theme new-arrivals-product">
                            @foreach ($web_config['featured_deals'] as $key => $product)
                                @include('web-views.partials._product-card-1', [
                                    'product' => $product,
                                    'decimal_point_settings' => $decimalPointSettings,
                                ])
                            @endforeach
                        </div>
                    </div>
                </div>
            </section>
        @endif
        @include('web-views.partials._latest-product', ['decimal_point_settings' => $decimalPointSettings])
        @if (isset($main_section_banner))
            <div class="container rtl pt-4 px-0 px-md-3">
                <a href="{{ $main_section_banner->url }}" target="_blank" class="cursor-pointer d-block">
                    <img class="d-block footer_banner_img __inline-63" alt=""
                        src="{{ getValidImage(path: 'storage/app/public/banner/' . $main_section_banner['photo'], type: 'wide-banner') }}">
                </a>
            </div>
        @endif
        @include('web-views.partials._deal-of-the-day', [
            'decimal_point_settings' => $decimalPointSettings,
        ])
        @if ($footer_banner->count() > 0)
            @foreach ($footer_banner as $key => $banner)
                @if ($key == 0)
                    <div class="container rtl d-sm-none">
                        <div class="row g-3">
                            <div class="col-md-12">
                                <a href="{{ $banner->url }}" class="d-block" target="_blank">
                                    <img class="footer_banner_img __inline-63" alt=""
                                        src="{{ getValidImage(path: 'storage/app/public/banner/' . $banner['photo'], type: 'banner') }}">
                                </a>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        @endif
        @if ($footer_banner->count() > 0)
            @foreach ($footer_banner as $key => $banner)
                @if ($key == 1)
                    <div class="container rtl pt-4 d-sm-none">
                        <div class="row g-3">
                            <div class="col-md-12">
                                <a href="{{ $banner->url }}" class="d-block" target="_blank">
                                    <img class="footer_banner_img __inline-63" alt=""
                                        src="{{ getValidImage(path: 'storage/app/public/banner/' . $banner['photo'], type: 'banner') }}">
                                </a>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        @endif
        @if (count($footer_banner) > 0)
            <div class="container rtl d-none">
                <div class="row g-3 mt-3">
                    @if (count($footer_banner) <= 2)
                        @foreach ($footer_banner as $bannerIndex => $banner)
                            <div class="col-md-6">
                                <a href="{{ $banner->url }}" class="d-block" target="_blank">
                                    <img class="footer_banner_img __inline-63" alt=""
                                        src="{{ getValidImage(path: 'storage/app/public/banner/' . $banner['photo'], type: 'banner') }}">
                                </a>
                            </div>
                        @endforeach
                    @else
                        <div class="col-md-12">
                            <div class="owl-carousel owl-theme footer-banner-slider">
                                @foreach ($footer_banner as $banner)
                                    <a href="{{ $banner['url'] }}" class="d-block" target="_blank">
                                        <img class="footer_banner_img __inline-63" alt=""
                                            src="{{ getValidImage(path: 'storage/app/public/banner/' . $banner['photo'], type: 'banner') }}">
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    @endif
                </div>
            </div>
        @endif

        @php($businessMode = getWebConfig(name: 'business_mode'))
        @if ($businessMode == 'multi' && count($top_sellers) > 0)
        @endif

        <div class="testimonial_sec mt-5 px-5">
            <div class="testimonial-container container">
                <div class="testimonial-header">
                    <h2 class="featured_deal_title font-bold text-dark">
                        Our Customer Feedback
                    </h2>
                    <p>
                        Interactive! product distinctive paradigms where as one-to-one intellectual capital resource sucking
                        services. Objectively customize vertical.
                    </p>
                </div>
                <div class="row">
                    <div class="testimonial-content col-lg-7 col-md-7 col-sm-12">
                        <div class="testimonial-image">
                            <img src="{{ asset('public/assets/front-end/img/media/clients.png') }}" alt="">
                        </div>
                    </div>
                    <div class="testimonial-slider col-lg-5 col-md-5 col-sm-12">
                        <div class="owl-carousel owl-theme owl-testimonial h-100" id="owl-testimonial">
                            <div class="testimonial-top">
                                <div class="d-flex gap-4 mb-4 align-items-center justify-content-start">
                                    <div>
                                        <img class="rounded-circle testimonial-client-img"
                                            src="{{ asset('public/assets/front-end/img/user.png') }}" alt=""
                                            style="object-fit: contain;">
                                    </div>
                                    <div class="clients-info">
                                        <h5 class="mb-1 __name">Dayanan Chaudary</h5>
                                        <ul class="d-flex align-items-center fs-xs text-warning" style="list-style: none;">
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                        </ul>
                                    </div>
                                </div>
                                <p class="mb-0 __content">
                                    I’m so happy to have a platform where I can order all the groceries I need from
                                    home. From pickles and spices to rice and vegetables — everything is delivered on time
                                    and nicely packed. No more running to the market!
                                </p>
                            </div>
                            <div class="testimonial-top">
                                <div class="d-flex gap-4 mb-4 align-items-center justify-content-start">
                                    <div>
                                        <img class="rounded-circle testimonial-client-img"
                                            src="{{ asset('public/assets/front-end/img/user.png') }}" alt="">
                                    </div>
                                    <div class="clients-info">
                                        <h5 class="mb-1 __name">Anupam Gupta</h5>
                                        <ul class="d-flex align-items-center fs-xs text-warning"
                                            style="list-style: none;">
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                            <li><i class="fa fa-star"></i></li>
                                        </ul>
                                    </div>
                                </div>
                                <p class="mb-0 __content">
                                    This website has really made things easier — I can order all our weekly essentials in
                                    one go, which saves a lot of time. It’s great to see local Nepali brands available so
                                    conveniently.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @if ($home_categories->count() > 0)
            @foreach ($home_categories as $category)
                @include('web-views.partials._category-wise-product', [
                    'decimal_point_settings' => $decimalPointSettings,
                ])
            @endforeach
        @endif
        @php($companyReliability = getWebConfig(name: 'company_reliability'))
        @if ($companyReliability != null)
        @endif
    </div>
    <span id="direction-from-session" data-value="{{ session()->get('direction') }}"></span>
@endsection
@push('script')
    <script src="{{ theme_asset(path: 'public/assets/front-end/js/home.js') }}"></script>
    <script>
        $('.product').each(function() {
            var $this = $(this);
            var hoverDetail = $this.find('.product-hover_details');
            $this.hover(function() {
                hoverDetail.toggleClass('d-none');
            });
        });
        $("#owl-testimonial").owlCarousel({
            loop: true,
            autoplay: true,
            margin: 20,
            nav: false,
            navText: directionFromSession === 'rtl' ? ["<i class='czi-arrow-right'></i>",
                "<i class='czi-arrow-left'></i>"
            ] : ["<i class='czi-arrow-left'></i>", "<i class='czi-arrow-right'></i>"],
            dots: false,
            autoplayHoverPause: true,
            autoplaySpeed: 1500,
            slideTransition: 'linear',
            rtl: directionFromSession === 'rtl',
            ltr: directionFromSession === 'ltr',
            items: 1,
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Set the third button (3 items per row) as active and apply its layout by default
            changeItemsPerRow(1, document.querySelector('.button-group .btn:nth-child(3)'));
        });
        // Sorting items
        function changeItemsPerRow(numItems, element) {
            const container = document.querySelector('.items-container');
            container.style.gridTemplateColumns = `repeat(${numItems}, 1fr)`;
            // Ensure all items inside the product list get the correct class
            const items = document.querySelectorAll('.product-single-hover .muntiple-designs');
            items.forEach(item => {
                item.classList.remove('design-1', 'design-2');
                if (numItems === 1) {
                    item.classList.add('design-1');
                } else {
                    item.classList.add('design-2');
                }
            });
            // Remove the 'active' class from all buttons
            const buttons = document.querySelectorAll('.button-group button');
            buttons.forEach(button => button.classList.remove('active'));
            // Add the 'active' class to the clicked button
            element.classList.add('active');
        }
    </script>

    {{-- <script>
        $(document).ready(function() {
            // ? Add to Cart Button
            $('.add-to-cart').on('click', function(e) {
                e.preventDefault();
                let button = $(this);
                let form = button.closest('form');
                let productId = form.find('input[name="id"]').val();
                let quantityInput = form.find('.cart-qty-field');
                let quantity = parseInt(quantityInput.val()) || 1;
                let cartControls = form.find('.quantity-box');

                $.ajax({
                    url: "{{ route('cart.add') }}",
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: productId,
                        quantity: quantity
                    },
                    success: function(response) {
                        console.log("AJAX Response:", response);
                        if (response && response.amount_need !== undefined) {
                            console.log("Amount need:", response.amount_need);
                        } else {
                            console.warn("amount_need is missing from response");
                        }

                        if (response.status === 1) {
                            toastr.success(response.message);

                            // Hide the "Add to Cart" button
                            button.removeClass('d-flex').addClass('d-none');

                            // Show the quantity-wrapper (immediate sibling in your Blade)
                            let quantityWrapper = button.siblings('.quantity-wrapper');
                            quantityWrapper.removeClass('d-none').addClass('d-flex');

                            // Update input attributes for tracking
                            let qtyInput = quantityWrapper.find('.cart-quantity-input');
                            qtyInput.attr('data-cart-id', response.cart.in_cart_key)
                                .attr('data-cart-quantity', response.cart.quantity)
                                .addClass(`cartQuantity${response.cart.in_cart_key}`)
                                .val(response.cart.quantity);

                            // Show/hide trash or decrement buttons based on quantity
                            quantityWrapper.find('.remove-item-btn')
                                .toggleClass('d-none', response.cart.quantity != 1);
                            quantityWrapper.find('.decrement-btn')
                                .toggleClass('d-none', response.cart.quantity <= 1);

                            quantityWrapper.find('.increment-btn')
                                .attr('data-cart-id', response.cart.in_cart_key)

                            quantityWrapper.find('.decrement-btn')
                                .attr('data-cart-id', response.cart.in_cart_key)

                            quantityWrapper.find('.remove-item-btn')
                                .attr('data-cart-id', response.cart.in_cart_key)

                        } else {
                            toastr.error('Failed to add product to cart!');
                        }
                    }
                });
            });
            $(document).on('click', '.increment-btn', function() {
                let button = $(this);
                let wrapper = button.closest('.quantity-wrapper');
                let qtyInput = wrapper.find('.cart-quantity-input');

                let currentQty = parseInt(qtyInput.val()) || 1;
                let newQty = currentQty + 1;

                console.log(currentQty, newQty);
                qtyInput.val(newQty);

                // Show decrement, hide trash if >1
                wrapper.find('.remove-item-btn').addClass('d-none');
                wrapper.find('.decrement-btn').removeClass('d-none');
            });

            // Decrement quantity
            $(document).on('click', '.decrement-btn', function() {
                let button = $(this);
                let wrapper = button.closest('.quantity-wrapper');
                let qtyInput = wrapper.find('.cart-quantity-input');

                let currentQty = parseInt(qtyInput.val()) || 1;
                let newQty = currentQty - 1;

                console.log(currentQty, newQty);
                if (newQty <= 1) {
                    newQty = 1;
                    // Hide decrement, show trash when only 1 left
                    wrapper.find('.decrement-btn').addClass('d-none');
                    wrapper.find('.remove-item-btn').removeClass('d-none');
                }

                qtyInput.val(newQty);
            });

            // Trash button click
            $(document).on('click', '.remove-item-btn', function() {
                let button = $(this);
                let wrapper = button.closest('.quantity-wrapper');
                let addToCartBtn = wrapper.siblings('.add-to-cart');

                // Optional: send AJAX to actually remove item from backend
                $.ajax({
                    url: "{{ route('cart.remove') }}", // <- make sure you have this route
                    type: "POST",
                    data: {
                        _token: '{{ csrf_token() }}',
                        key: button.data('cart-id')
                    },
                    success: function(response) {
                        // if (response.status === 1) {
                        toastr.success(response.message);

                        // Hide quantity-wrapper and show Add To Cart
                        wrapper.removeClass('d-flex').addClass('d-none');
                        addToCartBtn.removeClass('d-none').addClass('d-flex');
                        // } else {
                        //     toastr.error('Failed to remove product from cart!');
                        // }
                    }
                });
            });



            // ? Increase/Decrease Quantity Button
            $('.btn-number').on('click', function(e) {
                e.preventDefault();
                let button = $(this);
                let input = button.closest(".cart-controls").find(".cart-qty-field");
                let cart_id = input.attr("data-cart-id");
                let product_id = input.data("producttype");
                let action = button.attr("data-type") === "plus" ? 1 : -1;

                if (!cart_id) {
                    console.error("Cart ID is missing! Ensure product is added to the cart first.");
                    return;
                }

                updateCartQuantity(cart_id, product_id, action);
            });

            // ? Manual Quantity Change
            $(".cart-qty-field").on("change", function() {
                let input = $(this);
                let newValue = parseInt(input.val()) || 1;
                let minValue = parseInt(input.attr("min")) || 1;
                let maxValue = parseInt(input.attr("max")) || 100;
                let cart_id = input.data("cart-id");
                let product_id = input.data("producttype");

                if (newValue < minValue) newValue = minValue;
                if (newValue > maxValue) newValue = maxValue;

                input.val(newValue);

                if (cart_id) {
                    updateCartQuantity(cart_id, product_id, newValue);
                } else {
                    console.error("Cart ID is missing!");
                }
            });
        });

        // ? Update Cart Quantity via AJAX
        function updateCartQuantity(cart_id, product_id, action, event = null) {
            let remove_url = $("#route-cart-remove").data("url");
            let update_url = $("#route-cart-updateQuantity-guest").data("url");
            let token = $('meta[name="_token"]').attr("content");
            let input = $(`.cartQuantity${cart_id}`);
            let currentQty = parseInt(input.attr('data-cart-quantity')) || 1;
            let newQty = (typeof action === 'number') ? (currentQty + action) : action;

            if (newQty <= 0) {
                toastr.info('Cannot use zero quantity.');
                input.val(input.data("min"));
                return;
            }

            if (newQty < input.data("min")) {
                toastr.error('Minimum quantity is ' + input.data("min"));
                input.val(input.data("min"));
                return;
            }

            // Remove item if decrement from min value
            if (currentQty === input.data("min") && action === -1) {
                $.post(remove_url, {
                    _token: token,
                    key: cart_id
                }, function(response) {
                    updateNavCart();
                    toastr.info(response.message);
                    location.reload();
                });
                return;
            }

            // Update quantity
            $.post(update_url, {
                _token: token,
                key: cart_id,
                product_id: product_id,
                quantity: newQty
            }, function(response) {
                if (response.status === 0) {
                    toastr.error(response.message);
                } else {
                    toastr.success(response.message);
                    $(`.cartQuantity${cart_id}`).val(response.qty).attr('data-cart-quantity', response.qty);
                    $(`.cart_quantity_multiply${cart_id}`).html(response.qty);
                    $(`.discount_price_of_${cart_id}`).html(response.discount_price);
                    $(`.quantity_price_of_${cart_id}`).html(response.quantity_price);
                    $(".cart_total_amount, .cart-total-price").html(response.total_price);
                    $(`.total_discount`).html(response.total_discount_price);
                    $(`.free_delivery_amount_need`).html(response.free_delivery_status.amount_need);

                    if (response.free_delivery_status.amount_need <= 0) {
                        $('.amount_fullfill').removeClass('d-none');
                        $('.amount_need_to_fullfill').addClass('d-none');
                    } else {
                        $('.amount_fullfill').addClass('d-none');
                        $('.amount_need_to_fullfill').removeClass('d-none');
                    }

                    const progressBar = document.querySelector('.progress-bar');
                    if (progressBar) {
                        progressBar.style.width = response.free_delivery_status.percentage + '%';
                    }

                    let iconHtml = (response.qty === input.data("min")) ?
                        '<i class="tio-delete-outlined text-danger fs-10"></i>' :
                        '<i class="tio-remove fs-10"></i>';

                    input.closest('.cart-controls').find(".quantity__minus").html(iconHtml);

                    if (["shop-cart", "checkout-payment", "checkout-details"].includes(window.location.pathname
                            .split("/").pop())) {
                        location.reload();
                    }
                }
            });
        }
    </script> --}}

    {{-- <script>
        $(document).ready(function() {
            // ? Add to Cart
            $(document).on('click', '.add-to-cart', function(e) {
                e.preventDefault();
                let button = $(this);
                let form = button.closest('form');
                let productId = form.find('input[name="id"]').val();
                let quantity = parseInt(form.find('.cart-qty-field').val()) || 1;

                $.ajax({
                    url: "{{ route('cart.add') }}",
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: productId,
                        quantity: quantity
                    },
                    success: function(response) {
                        if (response.status === 1) {
                            toastr.success(response.message);

                            button.removeClass('d-flex').addClass('d-none');
                            let quantityWrapper = button.siblings('.quantity-wrapper');
                            quantityWrapper.removeClass('d-none').addClass('d-flex');

                            let qtyInput = quantityWrapper.find('.cart-quantity-input');
                            qtyInput
                                .attr('data-cart-id', response.cart.in_cart_key)
                                .attr('data-producttype', response.cart.product_id)
                                .attr('data-cart-quantity', response.cart.quantity)
                                .val(response.cart.quantity);
                        } else {
                            toastr.error('Failed to add product to cart!');
                        }
                    }
                });
            });

            // ? Increment / Decrement
            $(document).on('click', '.increment-btn, .decrement-btn', function() {
                let button = $(this);
                let wrapper = button.closest('.quantity-wrapper');
                let qtyInput = wrapper.find('.cart-quantity-input');
                let cartId = qtyInput.data("cart-id");
                let productId = qtyInput.data("producttype");
                let currentQty = parseInt(qtyInput.val()) || 1;

                let newQty = currentQty + (button.hasClass('increment-btn') ? 1 : -1);

                updateCartQuantity(cartId, productId, newQty, wrapper);
            });

            // ? Manual Quantity Change
            $(document).on("change", ".cart-quantity-input", function() {
                let input = $(this);
                let cartId = input.data("cart-id");
                let productId = input.data("producttype");
                let newQty = parseInt(input.val()) || 1;

                updateCartQuantity(cartId, productId, newQty, input.closest('.quantity-wrapper'));
            });

            // ? Remove Item
            $(document).on('click', '.remove-item-btn', function() {
                let button = $(this);
                let wrapper = button.closest('.quantity-wrapper');
                let addToCartBtn = wrapper.siblings('.add-to-cart');

                $.ajax({
                    url: "{{ route('cart.remove') }}",
                    type: "POST",
                    data: {
                        _token: '{{ csrf_token() }}',
                        key: button.data('cart-id')
                    },
                    success: function(response) {
                        toastr.success(response.message);
                        wrapper.removeClass('d-flex').addClass('d-none');
                        addToCartBtn.removeClass('d-none').addClass('d-flex');
                    }
                });
            });
        });

        // ? Update Cart Quantity
        // ✅ Update Cart Quantity
        // ✅ Update Cart Quantity
        function updateCartQuantity(cart_id, product_id, newQty, wrapper = null) {
            let token = $('meta[name="_token"]').attr("content");

            // fallback: find wrapper if not provided
            if (!wrapper || wrapper.length === 0) {
                wrapper = $(`.cartQuantity${cart_id}`).closest('.quantity-wrapper');
            }

            // detect which URL to use
            let update_url = $("#route-cart-updateQuantity").data("url") || null;
            let update_url_guest = $("#route-cart-updateQuantity-guest").data("url") || null;
            let update_url_final = update_url ? update_url : update_url_guest;

            console.log("🔄 Updating cart", {
                cart_id: cart_id,
                product_id: product_id,
                newQty: newQty,
                route_used: update_url ? "USER route" : "GUEST route",
                url: update_url_final
            });

            let remove_url = $("#route-cart-remove").data("url");

            // 🚮 Remove item if qty <= 0
            if (newQty <= 0) {
                $.post(remove_url, {
                    _token: token,
                    key: cart_id
                }, function(response) {
                    toastr.info(response.message);
                    wrapper.removeClass('d-flex').addClass('d-none');
                    wrapper.siblings('.add-to-cart').removeClass('d-none').addClass('d-flex');
                });
                return;
            }

            // 🛒 Update item qty
            $.post(update_url_final, {
                _token: token,
                key: cart_id,
                product_id: product_id,
                quantity: newQty
            }, function(response) {
                console.log("📝 Server Response:", response);

                if (response.status === 0) {
                    toastr.error(response.message);
                    return;
                }

                toastr.success(response.message);

                // ✅ Always cast qty to number
                let updatedQty = parseInt(response.qty) || 1;

                // update input
                let qtyInput = wrapper.find('.cart-quantity-input');
                qtyInput.val(updatedQty).attr('data-cart-quantity', updatedQty);

                // toggle decrement/trash
                wrapper.find('.remove-item-btn').toggleClass('d-none', updatedQty > 1);
                wrapper.find('.decrement-btn').toggleClass('d-none', updatedQty <= 1);

                // ✅ Safe text updates
                if (response.total_price !== undefined) {
                    $(".cart_total_amount, .cart-total-price").html(response.total_price);
                }
                if (response.total_discount_price !== undefined) {
                    $(".total_discount").html(response.total_discount_price);
                }
                if (response.free_delivery_status !== undefined) {
                    $(".free_delivery_amount_need").html(response.free_delivery_status.amount_need);

                    if (response.free_delivery_status.amount_need <= 0) {
                        $('.amount_fullfill').removeClass('d-none');
                        $('.amount_need_to_fullfill').addClass('d-none');
                    } else {
                        $('.amount_fullfill').addClass('d-none');
                        $('.amount_need_to_fullfill').removeClass('d-none');
                    }

                    const progressBar = document.querySelector('.progress-bar');
                    if (progressBar) {
                        progressBar.style.width = response.free_delivery_status.percentage + '%';
                    }
                }
            });
        }
    </script> --}}

    <script>
        $(document).ready(function() {

            // ? Add to Cart
            $(document).on('click', '.add-to-cart', function(e) {
                e.preventDefault();
                let button = $(this);
                let form = button.closest('form');
                let productId = form.find('input[name="id"]').val();
                let quantity = parseInt(form.find('.cart-qty-field').val()) || 1;

                $.ajax({
                    url: "{{ route('cart.add') }}",
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: productId,
                        quantity: quantity
                    },
                    success: function(response) {
                        if (response.status === 1) {
                            toastr.success(response.message);

                            button.removeClass('d-flex').addClass('d-none');
                            let quantityWrapper = button.siblings('.quantity-wrapper');
                            quantityWrapper.removeClass('d-none').addClass('d-flex');

                            // Attach cart data to input & buttons
                            let qtyInput = quantityWrapper.find('.cart-quantity-input');
                            qtyInput
                                .attr('data-cart-id', response.cart.in_cart_key)
                                .attr('data-producttype', response.cart.product_id)
                                .attr('data-cart-quantity', response.cart.quantity)
                                .val(response.cart.quantity);

                            // Also update buttons with cart_id & product_id
                            quantityWrapper.find(
                                '.increment-btn, .decrement-btn, .remove-item-btn').each(
                                function() {
                                    $(this)
                                        .attr('data-cart-id', response.cart.in_cart_key)
                                        .attr('data-product-id', response.cart.product_id);
                                });

                        } else {
                            toastr.error('Failed to add product to cart!');
                        }
                    }
                });
            });

            // ? Increment / Decrement buttons
            $(document).on('click', '.increment-btn, .decrement-btn', function() {
                let button = $(this);
                let wrapper = button.closest('.quantity-wrapper');
                let qtyInput = wrapper.find('.cart-quantity-input');

                let cartId = button.data('cart-id') || qtyInput.data('cart-id');
                let productId = button.data('product-id') || qtyInput.data('producttype');
                let currentQty = parseInt(qtyInput.val()) || 1;

                let newQty = currentQty + (button.hasClass('increment-btn') ? 1 : -1);
                updateCartQuantity(cartId, productId, newQty, wrapper);
            });

            // ? Manual quantity change
            $(document).on('change', '.cart-quantity-input', function() {
                let input = $(this);
                let cartId = input.data('cart-id');
                let productId = input.data('producttype');
                let newQty = parseInt(input.val()) || 1;

                updateCartQuantity(cartId, productId, newQty, input.closest('.quantity-wrapper'));
            });

            // ? Remove item
            $(document).on('click', '.remove-item-btn', function() {
                let button = $(this);
                let wrapper = button.closest('.quantity-wrapper');
                let addToCartBtn = wrapper.siblings('.add-to-cart');

                let cartId = button.data('cart-id');

                $.ajax({
                    url: $("#route-cart-remove").data("url"),
                    type: "POST",
                    data: {
                        _token: '{{ csrf_token() }}',
                        key: cartId
                    },
                    success: function(response) {
                        toastr.success(response.message);
                        wrapper.removeClass('d-flex').addClass('d-none');
                        addToCartBtn.removeClass('d-none').addClass('d-flex');
                    }
                });
            });

        });

        // ? Update Cart Quantity function
        function updateCartQuantity(cart_id, product_id, newQty, wrapper) {
            if (!cart_id || !product_id) {
                console.error("❌ Missing cart_id or product_id", {
                    cart_id,
                    product_id
                });
                return;
            }

            let token = $('meta[name="_token"]').attr("content");
            let update_url = $("#route-cart-updateQuantity").data("url") || $("#route-cart-updateQuantity-guest").data(
                "url");

            // Remove item if quantity <= 0
            if (newQty <= 0) {
                $.post($("#route-cart-remove").data("url"), {
                    _token: token,
                    key: cart_id
                }, function(response) {
                    toastr.info(response.message);
                    wrapper.removeClass('d-flex').addClass('d-none');
                    wrapper.siblings('.add-to-cart').removeClass('d-none').addClass('d-flex');
                });
                return;
            }

            // Update item quantity
            $.post(update_url, {
                _token: token,
                key: cart_id,
                product_id: product_id,
                quantity: newQty
            }, function(response) {
                console.log("📝 Server Response:", response);

                if (response.status === 0) {
                    toastr.error(response.message);
                    return;
                }

                toastr.success(response.message);

                let updatedQty = parseInt(response.qty) || 1;

                let qtyInput = wrapper.find('.cart-quantity-input');
                qtyInput.val(updatedQty).attr('data-cart-quantity', updatedQty);

                wrapper.find('.remove-item-btn').toggleClass('d-none', updatedQty > 1);
                wrapper.find('.decrement-btn').toggleClass('d-none', updatedQty <= 1);

                if (response.total_price !== undefined) $(".cart_total_amount, .cart-total-price").html(response
                    .total_price);
                if (response.total_discount_price !== undefined) $(".total_discount").html(response
                    .total_discount_price);

                if (response.free_delivery_status !== undefined) {
                    $(".free_delivery_amount_need").html(response.free_delivery_status.amount_need);

                    if (response.free_delivery_status.amount_need <= 0) {
                        $('.amount_fullfill').removeClass('d-none');
                        $('.amount_need_to_fullfill').addClass('d-none');
                    } else {
                        $('.amount_fullfill').addClass('d-none');
                        $('.amount_need_to_fullfill').removeClass('d-none');
                    }

                    const progressBar = document.querySelector('.progress-bar');
                    if (progressBar) progressBar.style.width = response.free_delivery_status.percentage + '%';
                }
            });
        }
    </script>
@endpush
