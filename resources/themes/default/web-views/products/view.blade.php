@extends('layouts.front-end.app')
@section('title', translate($data['data_from']) . ' ' . translate('products'))
@push('css_or_js')
    <meta property="og:image"
        content="{{ dynamicStorage(path: 'storage/app/public/company') }}/{{ $web_config['web_logo'] }}" />
    <meta property="og:title" content="Products of {{ $web_config['name'] }} " />
    <meta property="og:url" content="{{ env('APP_URL') }}">
    <meta property="og:description"
        content="{{ substr(strip_tags(str_replace('&nbsp;', ' ', $web_config['about']->value)), 0, 160) }}">
    <meta property="twitter:card"
        content="{{ dynamicStorage(path: 'storage/app/public/company') }}/{{ $web_config['web_logo'] }}" />
    <meta property="twitter:title" content="Products of {{ $web_config['name'] }}" />
    <meta property="twitter:url" content="{{ env('APP_URL') }}">
    <meta property="twitter:description"
        content="{{ substr(strip_tags(str_replace('&nbsp;', ' ', $web_config['about']->value)), 0, 160) }}">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/14.7.0/nouislider.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('/public/assets/front-end/css/search.css') }}">
    <style>
        .for-count-value {
            {{ Session::get('direction') === 'rtl' ? 'left' : 'right' }}: 0.6875 rem;
            ;
        }

        .for-count-value {
            {{ Session::get('direction') === 'rtl' ? 'left' : 'right' }}: 0.6875 rem;
        }

        .for-brand-hover:hover {
            color: var(--web-primary);
        }

        .for-hover-label:hover {
            color: var(--web-primary) !important;
        }

        .page-item.active .page-link {
            background-color: var(--web-primary) !important;
        }

        .for-sorting {
            padding- {{ Session::get('direction') === 'rtl' ? 'left' : 'right' }}: 9px;
        }

        .sidepanel {
            {{ Session::get('direction') === 'rtl' ? 'right' : 'left' }}: 0;
        }

        .sidepanel .closebtn {
            {{ Session::get('direction') === 'rtl' ? 'left' : 'right' }}: 25 px;
        }

        @media (max-width: 360px) {
            .for-sorting-mobile {
                margin- {{ Session::get('direction') === 'rtl' ? 'left' : 'right' }}: 0% !important;
            }

            .for-mobile {
                margin- {{ Session::get('direction') === 'rtl' ? 'right' : 'left' }}: 10% !important;
            }
        }

        @media (max-width: 500px) {
            .for-mobile {
                margin- {{ Session::get('direction') === 'rtl' ? 'right' : 'left' }}: 27%;
            }
        }

        .checkbox-wrapper-48 {
            --gray: #636e72;
            --very-light-gray: #eee;
            --light-gray: #9098A9;
            --x-light-gray: #dfe6e9;
            --gradient: linear-gradient(180deg, #1F3C74 0%, #1F3C74 100%);
        }

        .checkbox-wrapper-48 label {
            font-size: 1.35em;
        }

        /* CORE STYLES */
        .checkbox-wrapper-48 input {
            -webkit-appearance: none;
            -moz-appearance: none;
            appearance: none;
            width: 1em;
            height: 1em;
            font: inherit;
            border: 0.1em solid var(--light-gray);
            margin-bottom: -0.125em;
        }

        /*.checkbox-wrapper-48 input[type=checkbox] {
                                                                                                                                border-radius: 0.25em;
                                                                                                                            }*/
        .checkbox-wrapper-48 input:checked {
            border-color: transparent;
            background: #067531 !important;
            box-shadow: 0 0 0 0.1em inset #fff;
        }

        .checkbox-wrapper-48 input:not(:checked):hover {
            border-color: transparent;
            background: #067531 !important;
        }

        .categories_span {
            color: lightgray;
        }

        .header_categories {
            font-size: 20px;
            font-weight: 700;
            line-height: 24.8px;
            color: #078A3A;
        }

        .purple-icon {
            color: #774EA5;
        }

        .collapse-button {
            cursor: pointer;
            display: flex;
            align-items: center;
        }

        .collapse-button .fa {
            margin-left: 10px;
        }

        .slider-price-range {
            font-size: 16px;
            font-weight: 400;
            line-height: 20.8px;
            color: #6E777D;
        }

        #priceRange {
            appearance: none;
            /* Standard */
            -webkit-appearance: none;
            /* Safari and Chrome */
            -moz-appearance: none;
            /* Firefox */
            width: 100%;
            height: 8px;
            background: linear-gradient(90deg, #8974F7 0%, #1F3C74 100%);
            border: 1px solid rgba(255, 173, 155, 1);
            border-radius: 5px;
            outline: none;
        }

        #priceRange::-webkit-slider-thumb {
            appearance: none;
            -webkit-appearance: none;
            width: 20px;
            height: 20px;
            background-color: #fff;
            border: 2px solid rgba(255, 173, 155, 1);
            border-radius: 50%;
            cursor: pointer;
        }

        #priceRange::-moz-range-thumb {
            appearance: none;
            -moz-appearance: none;
            width: 20px;
            height: 20px;
            background-color: #fff;
            border: 2px solid rgba(255, 173, 155, 1);
            border-radius: 50%;
            cursor: pointer;
        }

        .custom-checkbox {
            display: none;
            /* Hide default checkbox */
        }

        .custom-checkbox+.form-check-label {
            display: inline-block;
            width: 32px;
            /* Set width and height */
            height: 32px;
            border: none;
            /* Border for square */
            border-radius: 3px;
            /* Optional: rounded corners */
            position: relative;
            cursor: pointer;
        }

        .custom-checkbox:checked+.form-check-label::before {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 12px;
            height: 12px;
            background: white;
            /* Color for check mark */
            border-radius: 2px;
            /* Optional: rounded corners */
            transform: translate(-50%, -50%);
        }

        .custom-checkbox:checked+.form-check-label {
            border-color: transparent;
        }

        .rating_star span img {
            width: 22px;
            margin-bottom: 7px;
        }

        .noUi-target,
        .noUi-connects {
            height: 6px;
        }

        .noUi-horizontal .noUi-handle,
        .noUi-touch-area {
            width: 18.48px;
            height: 18px;
            border-radius: 50%;
        }

        .noUi-touch-area {
            background: #AAAAAA;
        }

        .noUi-handle:after,
        .noUi-handle:before {
            background: unset !important;
        }

        .noUi-connect {
            background: #078A3A;
            ;
        }

        .noUi-tooltip {
            display: none;
        }

        /* Product Layout */

        /* Product Card Styling */
        .product-single-hover {
            height: 100%;
            display: flex;
            flex-direction: column;
            border: 1px solid #e9ecef;
            border-radius: 8px;
            background: white;
            transition: box-shadow 0.3s ease;
            overflow: hidden;
        }

        .product-single-hover:hover {
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        }

        /* Product Image */
        .search-product-image {
            width: 100%;
            height: 250px;
            position: relative;
            overflow: hidden;
        }

        .search-product-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
            object-position: center;
        }

        /* Product Details */
        .search-product-details {
            width: 100%;
            padding: 15px;
            flex-grow: 1;
            display: flex;
            flex-direction: column;
        }

        /* Cart Button Visibility */
        .add-to-cart {
            display: inline-block !important;
            visibility: visible !important;
            opacity: 1 !important;
        }

        .quantity-wrapper {
            display: flex !important;
            visibility: visible !important;
            opacity: 1 !important;
        }

        .product.__btn-grp {
            /* display: flex !important; */
            visibility: visible !important;
            opacity: 1 !important;
        }

        /* Hide sorting buttons */
        .button-group.changeItemPerRow {
            display: none !important;
        }

        /* Responsive Layout */
        @media (max-width: 768px) {

            .search-product-image {
                height: 200px;
            }

            .search-product-details {
                padding: 12px;
            }
        }

        @media (max-width: 575px) {

            .search-product-image {
                height: 180px;
            }

            .search-product-details {
                padding: 10px;
            }

            .add-to-cart {
                padding: 8px 12px;
                font-size: 14px;
                min-height: 40px;
            }
        }

        @media (max-width: 480px) {

            .search-product-image {
                height: 160px;
            }

            .search-product-details {
                padding: 8px;
                font-size: 13px;
            }
        }

        /*  */
        .button-group button {
            height: 30px;
            width: 30px;
        }

        .button-group button i {
            /* padding: 10px 20px; */
            margin-right: 10px;
            border: none;
            cursor: pointer;
            border-radius: 5px;
            color: #078A3A;
            border: 1px solid #078A3A;
            background: transparent;
            padding: 7px;
        }

        .button-group button.active i {
            color: #fff;
            background: #078A3A;
            padding: 7px;
        }



        /*  */
        .w-20 {
            width: 20px;
        }

        .h-20 {
            height: 20px;
        }

        .sorting-item {
            border-radius: unset !important;
            border: unset !important;
            box-shadow: unset !important;
            background: unset !important;
        }

        .bg-unset {
            background-color: unset !important;
        }

        /* .__search-sidebar [class*="border"] {
                                                                border: unset !important;
                                                                border-color: unset !important;
                                                            } */
        .border-1 {
            border-color: #E2E2E2 !important;
            border: 1px solid #E2E2E2 !important;
            border-radius: 8px;
        }

        .border-bottom-title {
            border-bottom: 1px solid #E2E2E2;
        }

        /* Sorting Products Ends */
    </style>
@endpush
@section('content')
    @php($decimal_point_settings = getWebConfig(name: 'decimal_point_settings'))
    <div class="container py-3" dir="{{ Session::get('direction') }}">
        <div class="search-page-header">
            <div class="breadcrumb">
                <a class="home" href="{{ url('/') }}">
                    <i class="fa fa-home" aria-hidden="true"></i>
                    Home
                </a>
                <i class="fa fa-angle-right" aria-hidden="true"></i>
                <span class="products">
                    Products
                </span>
            </div>
            {{-- <div>
                <h5 class="font-semibold mb-1">{{ translate(str_replace('_', ' ', $data['data_from'])) }} {{ translate('products') }} {{ isset($data['brand_name']) ? '(' . $data['brand_name'] . ')' : '' }}</h5>
                <div><span class="view-page-item-count">{{ $products->total() }}</span> {{ translate('items_found') }}</div>
            </div>  --}}
        </div>
    </div>
    <div class="container pb-5 mb-2 mb-md-4 rtl __inline-35" dir="{{ Session::get('direction') }}">
        <div class="row">
            <aside
                class="col-lg-3 hidden-xs col-md-3 col-sm-4 SearchParameters __search-sidebar {{ Session::get('direction') === 'rtl' ? 'pl-2' : 'pr-2' }}"
                id="SearchParameters">
                <div class="cz-sidebar __inline-35" id="shop-sidebar">
                    <div class="cz-sidebar-header bg-light">
                        <button class="close ms-auto" type="button" data-dismiss="sidebar" aria-label="Close">
                            <i class="tio-clear"></i>
                        </button>
                    </div>
                    <!-- Budget -->
                    <div class="form-group mb-4 border-1">
                        <div class="border-bottom-title d-flex justify-content-between align-items-center pt-3">
                            <h4 class="header_categories text-center w-100">Budget</h4>
                        </div>
                        <div class="card card-body border-0 px-3 pb-4 bg-unset">
                            <div class="slider-container my-3">
                                <div class="slider-labels d-flex justify-content-between">
                                    <span class="slider-price-range">Min price
                                        <div class="border-sidesearch mt-1 p-2">
                                            <span>
                                                {{ $defaultCurrencies->symbol }}
                                            </span>
                                            <span id="minPrice">10</span>
                                        </div>
                                    </span>
                                    <span class="slider-price-range">Max price
                                        <div class="border-sidesearch mt-1 p-2">
                                            <span>
                                                {{ $defaultCurrencies->symbol }}
                                            </span>
                                            <span id="maxPrice">10000</span>
                                        </div>
                                    </span>
                                </div>
                                <div id="priceSlider" class="mt-4"></div>
                            </div>
                        </div>
                    </div>
                    <!-- Budget Ends -->
                    <!-- Categories -->
                    <div class="form-group mb-4 border-1">
                        <div class="border-bottom-title d-flex justify-content-between align-items-center pt-3">
                            <h4 class="header_categories text-center w-100">
                                Product Categories
                            </h4>
                        </div>
                        {{-- @php($categories = \App\Utils\CategoryManager::get_categories_with_counting())
                        <div class="card card-body border-0 px-3 pb-4 bg-unset">
                            @foreach ($categories as $category)
                                <div class="checkbox-wrapper-48">
                                    <label class="d-flex align-items-center">
                                        <input type="checkbox" class="mr-2 category-checkbox" name="categories[]">
                                            value="{{ $category['id'] }}">
                                        <p class="m-0 categories_text">{{ $category['name'] }}
                                            <span class="categories_span">({{ $category->products_count }})</span>
                                        </p>
                                    </label>
                                </div>
                            @endforeach
                        </div> --}}
                        @php($categories = \App\Utils\CategoryManager::get_categories_with_counting())
                        <div class="card card-body border-0 px-3 pb-4 bg-unset">
                            <div id="category-list">
                                @foreach ($categories as $index => $category)
                                    @if ($index < 10)
                                        <!-- Show only the first 10 categories -->
                                        <div class="checkbox-wrapper-48">
                                            <label class="d-flex align-items-center">
                                                <input type="checkbox" class="mr-2 category-checkbox" name="categories[]"
                                                    value="{{ $category['id'] }}">
                                                <p class="m-0 categories_text">{{ $category['name'] }}</p>
                                            </label>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                            @if (count($categories) > 10)
                                <!-- Check if there are more than 10 categories -->
                                <button id="toggle-categories" class="btn btn-link">Show All</button>
                            @endif
                        </div>
                    </div>
                    <!-- Categories Ends -->
                    <!-- Stock -->
                    {{-- <div class="form-group mb-4 border-1">
                        <div class="border-bottom-title d-flex justify-content-between align-items-center pt-3">
                            <h4 class="header_categories text-center w-100">
                                Product Status
                            </h4>
                        </div>
                        <div class="card card-body border-0 px-3 pb-4 bg-unset">
                            <div class="checkbox-wrapper-48">
                                <label class="d-flex align-items-center">
                                    <input type="checkbox" class="mr-2 category-checkbox" name="inStock" value="inStock">
                                    <p class="m-0 categories_text">
                                        In Stock
                                    </p>
                                </label>
                            </div>
                            <div class="checkbox-wrapper-48">
                                <label class="d-flex align-items-center">
                                    <input type="checkbox" class="mr-2 category-checkbox" name="onSale" value="onSale">
                                    <p class="m-0 categories_text">
                                        On Sale
                                    </p>
                                </label>
                            </div>
                        </div>
                    </div> --}}
                    <!-- Stock Ends -->
                    <!-- Brand Section -->
                    <div class="form-group mb-4 border-1">
                        <div class="border-bottom-title d-flex justify-content-between align-items-center pt-3">
                            <h4 class="header_categories text-center w-100">Brand</h4>
                        </div>

                        @php($brands = \App\Utils\BrandManager::get_active_brands())
                        <div class="card card-body border-0 px-3 pb-4 bg-unset">
                            <div id="brand-list">
                                @foreach ($brands as $index => $brand)
                                    @if ($index < 10)
                                        <!-- Show only the first 10 brands -->
                                        <div class="checkbox-wrapper-48">
                                            <label class="d-flex align-items-center">
                                                <!-- Checkbox for each brand -->
                                                <input type="checkbox" class="mr-2 brand-checkbox"
                                                    value="{{ $brand['id'] }}" name="buy_phone">
                                                <p class="m-0 categories_text">
                                                    {{ $brand['name'] }}
                                                    <span
                                                        class="categories_span">({{ $brand['brand_products_count'] }})</span>
                                                </p>
                                            </label>
                                        </div>
                                    @endif
                                @endforeach
                            </div>
                            @if (count($brands) > 10)
                                <!-- Check if there are more than 10 brands -->
                                <button id="toggle-brands" class="btn btn-link">Show All</button>
                            @endif
                        </div>
                    </div>
                    <!-- Brand Section Ends -->
                    <!-- Rating Section -->
                    <div class="form-group mb-4 border-1">
                        <div class="d-flex justify-content-between align-items-center">
                            <h4 class="header_categories text-center w-100">Product Rating</h4>
                        </div>
                        <div class="card card-body border-0 px-3 pb-4 bg-unset">
                            <!-- Rating Checkbox List -->
                            @for ($i = 1; $i <= 5; $i++)
                                <div class="checkbox-wrapper-48">
                                    <label class="d-flex align-items-center">
                                        <input type="checkbox" class="mr-2 rating-filter" name="rating"
                                            value="{{ $i }}">
                                        <div class="rating_star">
                                            @for ($j = 1; $j <= 5; $j++)
                                                <span>
                                                    <img src="{{ asset($j <= $i ? 'public/images/yellowStar.jpg' : 'public/images/whiteStar.jpg') }}"
                                                        alt="Star">
                                                </span>
                                            @endfor
                                        </div>
                                    </label>
                                </div>
                            @endfor
                        </div>
                    </div>
                </div>
            </aside>
            <section class="col-lg-9">
                <div class="search-top-filter">
                    <div class="d-flex align-items-center justify-content-between flex-wrap gap-3 p-3">
                        <div class="count-results">
                            <span>Showing 1-20 of </span>
                            <span class="total-products">{{ $products->total() }} results</span>
                        </div>
                        <div class="d-flex align-items-center gap-3">
                            <form id="search-form" class="d-none d-lg-block" action="{{ route('products') }}"
                                method="GET">
                                <input hidden name="data_from" value="{{ $data['data_from'] }}">
                                <div class="sorting-item">
                                    <svg xmlns="http://www.w3.org/2000/svg" width="20" height="21"
                                        viewBox="0 0 20 21" fill="none">
                                        <path d="M11.6667 7.80078L14.1667 5.30078L16.6667 7.80078" stroke="#D9D9D9"
                                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                                        <path
                                            d="M7.91675 4.46875H4.58341C4.3533 4.46875 4.16675 4.6553 4.16675 4.88542V8.21875C4.16675 8.44887 4.3533 8.63542 4.58341 8.63542H7.91675C8.14687 8.63542 8.33341 8.44887 8.33341 8.21875V4.88542C8.33341 4.6553 8.14687 4.46875 7.91675 4.46875Z"
                                            stroke="#D9D9D9" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path
                                            d="M7.91675 11.9688H4.58341C4.3533 11.9688 4.16675 12.1553 4.16675 12.3854V15.7188C4.16675 15.9489 4.3533 16.1354 4.58341 16.1354H7.91675C8.14687 16.1354 8.33341 15.9489 8.33341 15.7188V12.3854C8.33341 12.1553 8.14687 11.9688 7.91675 11.9688Z"
                                            stroke="#D9D9D9" stroke-width="2" stroke-linecap="round"
                                            stroke-linejoin="round" />
                                        <path d="M14.1667 5.30078V15.3008" stroke="#D9D9D9" stroke-width="2"
                                            stroke-linecap="round" stroke-linejoin="round" />
                                    </svg>
                                    <label class="for-sorting" for="sorting">
                                        <span>{{ translate('sort_by') }}</span>
                                    </label>
                                    <select class="product-list-filter-on-viewpage">
                                        <option value="latest" {{ request('sort_by') == 'latest' ? 'selected' : '' }}>
                                            {{ translate('latest') }}</option>
                                        <option value="low-high" {{ request('sort_by') == 'low-high' ? 'selected' : '' }}>
                                            {{ translate('low_to_High_Price') }} </option>
                                        <option value="high-low" {{ request('sort_by') == 'high-low' ? 'selected' : '' }}>
                                            {{ translate('High_to_Low_Price') }}</option>
                                        <option value="a-z" {{ request('sort_by') == 'a-z' ? 'selected' : '' }}>
                                            {{ translate('A_to_Z_Order') }}</option>
                                        <option value="z-a" {{ request('sort_by') == 'z-a' ? 'selected' : '' }}>
                                            {{ translate('Z_to_A_Order') }}</option>
                                    </select>
                                </div>
                            </form>
                            <div class="d-lg-none">
                                <div class="filter-show-btn btn btn--primary py-1 px-2 m-0">
                                    <i class="tio-filter"></i>
                                </div>
                            </div>
                            <div class="button-group changeItemPerRow">
                                <button class="btn p-0 mr-1 btn1 active" onclick="changeItemsPerRow(1, this)">
                                    <i class="fa fa-th-list" aria-hidden="true"></i>
                                </button>
                                <button class="btn p-0 mr-1 btn2" onclick="changeItemsPerRow(2, this)">
                                    <i class="fa fa-th-large" aria-hidden="true"></i>
                                </button>
                                <button class="btn p-0 mr-1 btn3" onclick="changeItemsPerRow(3, this)">
                                    <i class="fa fa-th" aria-hidden="true"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                    <div class="search-card-filter">
                        <div class="d-flex">
                            <form method="GET" action="#" id="filterForm" class="w-100">
                                <div
                                    class="d-flex align-items-center justify-content-between p-3 flex-wrap gap-3 search-page-added_filter">
                                    <div class="dropdown">
                                        <button class="filter-select-btn btn bg-white dropdown-toggle" type="button"
                                            id="categoryDropdown" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                            All Categories
                                        </button>
                                        @php($categories = \App\Utils\CategoryManager::get_categories_with_counting())
                                        <ul class="dropdown-menu" aria-labelledby="categoryDropdown">
                                            @foreach ($categories as $category)
                                                <li><a href="#" class="dropdown-item"
                                                        data-category-id="{{ $category['id'] }}">{{ $category['name'] }}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                        <input type="hidden" name="category" id="selectedCategory">
                                    </div>
                                    <div class="dropdown">
                                        <button class="filter-select-btn btn bg-white dropdown-toggle" type="button"
                                            id="brandDropdown" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                            All Brands
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="brandDropdown">
                                            @foreach (\App\Utils\BrandManager::get_active_brands() as $brand)
                                                <li><a href="#" class="dropdown-item"
                                                        data-brand-id="{{ $brand['id'] }}">{{ $brand['name'] }}</a>
                                                </li>
                                            @endforeach
                                        </ul>
                                        <input type="hidden" name="brand" id="selectedBrand">
                                    </div>
                                    <div class="dropdown">
                                        <button class="filter-select-btn btn bg-white dropdown-toggle" type="button"
                                            id="SizeDropdown" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                            All Size
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="SizeDropdown">
                                            <li><a href="#" class="dropdown-item" data-size-id="1">size A</a>
                                            </li>
                                        </ul>
                                        <input type="hidden" name="size" id="selectedSize">
                                    </div>
                                    <div class="dropdown">
                                        <button class="filter-select-btn btn bg-white dropdown-toggle" type="button"
                                            id="weightDropdown" data-toggle="dropdown" aria-haspopup="true"
                                            aria-expanded="false">
                                            All Weight
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="weightDropdown">
                                            <li><a href="#" class="dropdown-item" data-weight-id="1">Weight
                                                    A</a></li>
                                        </ul>
                                        <input type="hidden" name="weight" id="selectedWeight">
                                    </div>
                                    <div class="d-flex align-items-center gap-2">
                                        <button type="submit" class="btn btn-search-filter">Filter</button>
                                        <button type="button" id="resetFilter"
                                            class="btn btn-search-filter bg-white">Reset Filter</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
                <div class="product items-container row mt-3" id="ajax-products">
                    @include('web-views.products._ajax-products', [
                        'products' => $products,
                        'decimal_point_settings' => $decimal_point_settings,
                    ])
                </div>
                <div class="col-12">
                    <nav class="d-flex justify-content-between pt-2" aria-label="Page navigation" id="paginator-ajax">
                        {!! $products->links() !!}
                    </nav>
                </div>
            </section>
        </div>
    </div>
    <span id="products-search-data-backup" data-url="{{ url('/products') }}" data-id="{{ $data['id'] }}"
        data-name="{{ $data['name'] }}" data-from="{{ $data['data_from'] }}" data-sort="{{ $data['sort_by'] }}"
        data-min-price="{{ $data['min_price'] }}" data-max-price="{{ $data['max_price'] }}"
        data-message="{{ translate('items_found') }}"></span>
@endsection
@push('script')
    <script src="{{ theme_asset(path: 'public/assets/front-end/js/product-view.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/14.7.0/nouislider.min.js"></script>
    <script>
        $(document).ready(function() {
            var priceSlider = document.getElementById('priceSlider');
            noUiSlider.create(priceSlider, {
                start: [10, 10000], // Initial values for handles
                connect: true,
                range: {
                    'min': 10,
                    'max': 10000
                },
                step: 1,
                tooltips: [true, true],
                format: {
                    to: function(value) {
                        return Math.round(value);
                    },
                    from: function(value) {
                        return Number(value);
                    }
                }
            });
            priceSlider.noUiSlider.on('update', function(values, handle) {
                if (handle === 0) {
                    document.getElementById('minPrice').innerText = values[0];
                } else {
                    document.getElementById('maxPrice').innerText = values[1];
                }
            });
        });
        // Responsive layout handling
        // function handleResponsiveLayout() {
        //     const container = document.querySelector('.items-container');
        //     if (container) {
        //         if (window.innerWidth <= 480) {
        //             container.style.gap = '6px';
        //         } else if (window.innerWidth <= 575) {
        //             container.style.gap = '8px';
        //         } else if (window.innerWidth <= 768) {
        //             container.style.gap = '10px';
        //         } else {
        //             container.style.gap = '15px';
        //         }
        //     }
        // }

        // Handle window resize
        window.addEventListener('resize', function() {
            handleResponsiveLayout();
        });

        // Initialize responsive layout on page load
        document.addEventListener('DOMContentLoaded', function() {
            handleResponsiveLayout();
        });

        // Sorting items Ends
    </script>
    {{-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> --}}
    <script>
        // checkbox is working
        // $('.category-checkbox').on('change', function() {
        //     let selectedCategories = [];
        //     // Collect all checked categories
        //     $('.category-checkbox:checked').each(function() {
        //         selectedCategories.push($(this).val()); // Push the value of each checked checkbox
        //     });
        //     // Make an AJAX request based on the selected categories
        //     $.ajax({
        //         url: "{{ route('products.filter') }}", // Ensure this route exists
        //         type: 'GET',
        //         data: {
        //             categories: selectedCategories
        //         },
        //         success: function(response) {
        //             console.log('AJAX Success:', response); // Log the successful response
        //             // Check if the response contains the correct HTML
        //             if (response && response.data) {
        //                 $('#ajax-products').html(response.data);
        //             } else {
        //                 console.error('Unexpected response structure:', response);
        //                 // alert('No products found for the selected categories.');
        //             }
        //             // Solves the Design Issue
        //             const btn3 = $(".changeItemPerRow .btn3").hasClass("active");
        //             const muntipleDesigns = $(".muntiple-designs ");
        //             if (btn3) {
        //                 muntipleDesigns.removeClass("design-1");
        //                 muntipleDesigns.addClass("design-2");
        //             }
        //             console.log(btn1, btn2, btn3)
        //             // Solves the Design Issue End
        //             if ($(window).width() < 430) {
        //                 $(".muntiple-designs").removeClass('design-1');
        //                 $(".muntiple-designs").addClass('design-2');
        //             }
        //             console.log($(window).width());
        //         },
        //         error: function(xhr, status, error) {
        //             console.error('AJAX Error:', error); // Log any error
        //             // alert('An error occurred while filtering products. Please try again.');
        //         }
        //     });
        // });
        // Checkbox is working
        // Use event delegation for dynamically added checkboxes
        $(document).on('change', '.category-checkbox', function() {
            let selectedCategories = [];
            // Collect all checked categories (including dynamically added ones)
            $('.category-checkbox:checked').each(function() {
                selectedCategories.push($(this).val());
            });

            // Rest of your AJAX code remains the same
            $.ajax({
                url: "{{ route('products.filter') }}",
                type: 'GET',
                data: {
                    categories: selectedCategories
                },
                success: function(response) {
                    console.log('AJAX Success:', response);
                    if (response && response.data) {
                        $('#ajax-products').html(response.data);
                        window.scrollTo({
                            top: 0,
                            behavior: 'smooth' // Optional: adds smooth scrolling
                        });
                    } else {
                        console.error('Unexpected response structure:', response);
                    }

                    // Design handling code
                    const btn3 = $(".changeItemPerRow .btn3").hasClass("active");
                    const muntipleDesigns = $(".muntiple-designs");
                    if (btn3) {
                        muntipleDesigns.removeClass("design-1");
                        muntipleDesigns.addClass("design-2");
                    }

                    if ($(window).width() < 430) {
                        $(".muntiple-designs").removeClass('design-1');
                        $(".muntiple-designs").addClass('design-2');
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', error);
                }
            });
        });
    </script>
    {{-- brand --}}
    <script>
        // $('.brand-checkbox').on('change', function() {
        //     let selectedBrand = [];
        //     // Collect all checked categories
        //     $('.brand-checkbox:checked').each(function() {
        //         selectedBrand.push($(this).val()); // Push the value of each checked checkbox
        //     });
        //     // Make an AJAX request based on the selected categories
        //     $.ajax({
        //         url: "{{ route('brand.filter') }}", // Ensure this route is correctly defined
        //         type: 'GET',
        //         data: {
        //             brands: selectedBrand // Send the selected brand IDs to the server
        //         },
        //         success: function(response) {
        //             // Update the products display with the filtered products
        //             $('#ajax-products').html(response.data);
        //         },
        //         error: function(xhr, status, error) {
        //             // console.error('Error filtering products:', xhr.responseText);
        //             // // Notify the user of an error
        //             // alert('An error occurred while filtering products. Please try again.');
        //         }
        //     });
        // });
        // Use event delegation for brand checkboxes
        $(document).on('change', '.brand-checkbox', function() {
            let selectedBrands = [];

            // Collect all checked brand checkboxes (including dynamically added ones)
            $('.brand-checkbox:checked').each(function() {
                selectedBrands.push($(this).val());
            });

            // Show loading indicator
            $('#ajax-products').html(
                '<div class="text-center py-4"><i class="fas fa-spinner fa-spin fa-2x"></i> Loading products...</div>'
            );

            // Make AJAX request
            $.ajax({
                url: "{{ route('brand.filter') }}",
                type: 'GET',
                data: {
                    brands: selectedBrands
                },
                success: function(response) {
                    if (response && response.data) {
                        $('#ajax-products').html(response.data);
                        window.scrollTo({
                            top: 0,
                            behavior: 'smooth' // Optional: adds smooth scrolling
                        });
                    } else {
                        console.error('Unexpected response structure:', response);
                        $('#ajax-products').html(
                            '<div class="alert alert-warning">No products found for selected brands</div>'
                        );
                    }
                },
                error: function(xhr, status, error) {
                    console.error('AJAX Error:', error);
                    $('#ajax-products').html(
                        '<div class="alert alert-danger">Error loading products. Please try again.</div>'
                    );
                }
            });
        });
    </script>
    {{-- product filter by  price range --}}
    <script>
        // Initialize the noUiSlider
        var priceSlider = document.getElementById('priceSlider');
        noUiSlider.create(priceSlider, {
            start: [10, 10000],
            connect: true,
            range: {
                'min': 0,
                'max': 10000
            },
            step: 1,
            tooltips: [true, true],
            format: {
                to: function(value) {
                    return Math.round(value); // Round to the nearest whole number
                },
                from: function(value) {
                    return Number(value); // Convert string to number
                }
            }
        });
        // Update the min and max values displayed
        priceSlider.noUiSlider.on('update', function(values, handle) {
            document.getElementById('minPrice').textContent = values[0];
            document.getElementById('maxPrice').textContent = values[1];
        });
        // Trigger filtering when the slider values change
        priceSlider.noUiSlider.on('change', function(values, handle) {
            filterProducts(values[0], values[1]);
        });
        // Function to filter products
        function filterProducts(minPrice, maxPrice) {
            $.ajax({
                url: '{{ route('price.filter') }}', // Define this route in your routes/web.php
                method: 'GET',
                data: {
                    min_price: minPrice,
                    max_price: maxPrice
                },
                success: function(response) {
                    // Update the products display with the filtered products
                    $('#ajax-products').html(response.data);
                    // console.log(response);
                },
                error: function(xhr, status, error) {
                    // console.error('Error filtering products:', xhr.responseText);
                    // // Notify the user of an error
                    // alert('An error occurred while filtering products. Please try again.');
                }
            });
        }
    </script>
    <script>
        // Get all checked checkboxes
        $('.rating-filter').on('change', function() {
            let selectedRatings = [];
            // Collect all checked categories
            $('.rating-filter:checked').each(function() {
                selectedRatings.push($(this).val()); // Push the value of each checked checkbox
            });
            // Make an AJAX request based on the selected categories
            $.ajax({
                url: "{{ route('filter.ratings') }}", // Your route to handle the request
                method: "GET",
                data: {
                    ratings: selectedRatings
                },
                success: function(response) {
                    // Update the products display with the filtered products
                    $('#ajax-products').html(response.data);
                    // console.log(response);
                },
                error: function(xhr, status, error) {
                    // console.error('Error filtering products:', xhr.responseText);
                    // // Notify the user of an error
                    // alert('An error occurred while filtering products. Please try again.');
                }
            });
        });
    </script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const showMoreBtn = document.getElementById('showMoreBtn');
            const moreColors = document.getElementById('moreColors');
            showMoreBtn.addEventListener('click', function() {
                if (moreColors.style.display === 'none') {
                    moreColors.style.display = 'flex'; // or 'block'
                    showMoreBtn.textContent = 'Show Less';
                } else {
                    moreColors.style.display = 'none';
                    showMoreBtn.textContent = 'Show More';
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            function getSelectedColors() {
                var selectedColors = [];
                $('.form-check-input:checked').each(function() {
                    selectedColors.push($(this).val());
                });
                return selectedColors;
            }

            function updateProducts() {
                var selectedColors = getSelectedColors();
                // Debugging: Uncomment to see selected colors in alert
                // alert(selectedColors);
                $.ajax({
                    url: "{{ route('filter.ColorWise') }}",
                    method: 'get',
                    data: {
                        colors: selectedColors,
                        _token: $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(response) {
                        // Update the products display with the filtered products
                        $('#ajax-products').html(response.data);
                        // console.log(response);
                    },
                    error: function(xhr, status, error) {
                        // console.error('Error filtering products:', xhr.responseText);
                        // // Notify the user of an error
                        // alert('An error occurred while filtering products. Please try again.');
                    }
                });
            }
            $('.form-check-input').on('change', function() {
                updateProducts();
            });
        });
        // Product filter
        // Handle dropdown selection for category, brand, size, and weight
        document.querySelectorAll('.dropdown-menu a').forEach(item => {
            item.addEventListener('click', function(e) {
                e.preventDefault(); // Prevent the default link behavior
                let category = this.getAttribute('data-category-id');
                let brand = this.getAttribute('data-brand-id');
                let size = this.getAttribute('data-size-id');
                let weight = this.getAttribute('data-weight-id');
                // Update category dropdown text and hidden input value
                if (category) {
                    document.getElementById('categoryDropdown').textContent = this.textContent;
                    document.getElementById('selectedCategory').value = category;
                }
                // Update brand dropdown text and hidden input value
                if (brand) {
                    document.getElementById('brandDropdown').textContent = this.textContent;
                    document.getElementById('selectedBrand').value = brand;
                }
                // Update size dropdown text and hidden input value (Corrected ID reference)
                if (size) {
                    document.getElementById('SizeDropdown').textContent = this.textContent;
                    document.getElementById('selectedSize').value = size;
                }
                // Update weight dropdown text and hidden input value
                if (weight) {
                    document.getElementById('weightDropdown').textContent = this.textContent;
                    document.getElementById('selectedWeight').value = weight;
                }
            });
        });
        // Handle reset button click
        document.getElementById('resetFilter').addEventListener('click', function() {
            // Reset dropdown button text to default
            document.getElementById('categoryDropdown').textContent = 'All Categories';
            document.getElementById('brandDropdown').textContent = 'All Brands';
            document.getElementById('SizeDropdown').textContent = 'All Size'; // Corrected here too
            document.getElementById('weightDropdown').textContent = 'All Weight';
            // Clear hidden input values
            document.getElementById('selectedCategory').value = '';
            document.getElementById('selectedBrand').value = '';
            document.getElementById('selectedSize').value = '';
            document.getElementById('selectedWeight').value = '';
            // Optionally, submit the form with cleared values to refresh the page with no filters
            document.getElementById('filterForm').submit();
        });
        // Product filter ends
    </script>
    <script>
        // $(document).on('click', '.add-to-cart', function() {
        //     // console.log('Add to Cart triggered');
        //     var productId = $(this).closest('form').find('input[name="id"]').val();
        //     var productIds = [];
        //     // Collect all checked categories
        //     $('.add-to-cart:checked').each(function() {
        //         productIds.push($(this).val()); // Push the value of each checked checkbox
        //     });
        //     // var productId = $(this).closest('form').find('input[name="id"]').val();
        //     // Set up the AJAX request
        //     $.ajax({
        //         // alert(productId);
        //         url: "{{ route('cart.add') }}", // Add to cart route
        //         type: 'POST',
        //         data: {
        //             _token: '{{ csrf_token() }}', // Pass CSRF token
        //             id: productId, // Pass the product ID
        //             quantity: 1 // You can change the quantity if needed
        //         },
        //         success: function(response) {
        //             if (response.status === 1) {
        //                 // console.log(response.cart);
        //                 toastr.success(response.message);
        //                 window.location.reload();
        //             } else {
        //                 // alert('Failed to add product to cart!');
        //                 toastr.error('Something went wrong, please try again.');
        //             }
        //         },
        //         error: function(response) {
        //             // alert('Error occurred while adding to cart!');
        //             toastr.success('Added Successfully.');
        //             window.location.reload();
        //         }
        //     });
        // });
        // $(document).ready(function() {
        //     // Event listener for the Add to Cart button
        //     $('.add-to-cart').on('click', function(e) {
        //         e.preventDefault();
        //         // Get product ID dynamically from the form
        //         var productId = $(this).closest('form').find('input[name="id"]').val();
        //         // Set up the AJAX request
        //         $.ajax({
        //             // alert(productId);
        //             url: "{{ route('cart.add') }}", // Add to cart route
        //             type: 'POST',
        //             data: {
        //                 _token: '{{ csrf_token() }}', // Pass CSRF token
        //                 id: productId,                 // Pass the product ID
        //                 quantity: 1                    // You can change the quantity if needed
        //             },
        //             success: function(response) {
        //                 if (response.status === 1) {
        //                     // console.log(response.cart);
        //                     toastr.success(response.message);
        //                     // alert('Product added to cart successfully!'); // You can replace with Toast message or a cart update
        //                     // You can update your cart UI here, for example, update cart counter, etc.
        //                 }
        //                  else {
        //                     // alert('Failed to add product to cart!');
        //                     toastr.error('Something went wrong, please try again.');
        //                 }
        //             },
        //             error: function(response) {
        //                 // alert('Error occurred while adding to cart!');
        //                 toastr.error('An error occurred. Please try again.');
        //             }
        //         });
        //     });
        // });
    </script>
    <script>
        $(document).ready(function() {
            $('.add-to-cart').on('click', function(e) {
                e.preventDefault();

                // Get product ID (works whether inside form or using data-id)
                var productId = $(this).data('id') || $(this).closest('form').find('input[name="id"]')
            .val();

                $.ajax({
                    url: "{{ route('cart.add') }}",
                    type: 'POST',
                    data: {
                        _token: '{{ csrf_token() }}',
                        id: productId,
                        quantity: 1
                    },
                    success: function(response) {
                        if (response.status === 1) {
                            toastr.success(response.message);

                            // ✅ Example: update cart count dynamically
                            if (response.cart_count !== undefined) {
                                $('#cart-count').text(response.cart_count);
                            }
                        } else {
                            toastr.error('Something went wrong, please try again.');
                        }
                    },
                    error: function(xhr) {
                        toastr.error('An error occurred. Please try again.');
                        console.error(xhr.responseText);
                    }
                });
            });
        });
    </script>

    <script>
        const categories = @json($categories); // Pass the categories to JavaScript
        let isExpanded = false; // Track whether categories are expanded
        document.getElementById('toggle-categories').addEventListener('click', function() {
            const categoryList = document.getElementById('category-list');
            categoryList.innerHTML = ''; // Clear existing categories
            if (isExpanded) {
                // Show only the first 10 categories
                categories.slice(0, 10).forEach(category => {
                    const div = document.createElement('div');
                    div.className = 'checkbox-wrapper-48';
                    div.innerHTML = `
                    <label class="d-flex align-items-center">
                        <input type="checkbox" class="mr-2 category-checkbox" name="categories[]" value="${category.id}">
                        <p class="m-0 categories_text">${category.name}</p>
                    </label>
                `;
                    categoryList.appendChild(div);
                });
                // Change button text to "Show All"
                this.textContent = 'Show All';
            } else {
                // Show all categories
                categories.forEach(category => {
                    const div = document.createElement('div');
                    div.className = 'checkbox-wrapper-48';
                    div.innerHTML = `
                    <label class="d-flex align-items-center">
                        <input type="checkbox" class="mr-2 category-checkbox" name="categories[]" value="${category.id}">
                        <p class="m-0 categories_text">${category.name}</p>
                    </label>
                `;
                    categoryList.appendChild(div);
                });
                // Change button text to "Show Less"
                this.textContent = 'Show Less';
            }
            isExpanded = !isExpanded; // Toggle the state
        });
    </script>
    <script>
        const brands = @json($brands); // Pass the brands to JavaScript
        let areBrandsExpanded = false; // Track whether brands are expanded
        document.getElementById('toggle-brands').addEventListener('click', function() {
            const brandList = document.getElementById('brand-list');
            brandList.innerHTML = ''; // Clear existing brands
            if (areBrandsExpanded) {
                // Show only the first 10 brands
                brands.slice(0, 10).forEach(brand => {
                    const div = document.createElement('div');
                    div.className = 'checkbox-wrapper-48';
                    div.innerHTML = `
                    <label class="d-flex align-items-center">
                        <input type="checkbox" class="mr-2 brand-checkbox" value="${brand.id}" name="buy_phone">
                        <p class="m-0 categories_text">
                            ${brand.name}
                            <span class="categories_span">(${brand.brand_products_count})</span>
                        </p>
                    </label>
                `;
                    brandList.appendChild(div);
                });
                // Change button text to "Show All"
                this.textContent = 'Show All';
            } else {
                // Show all brands
                brands.forEach(brand => {
                    const div = document.createElement('div');
                    div.className = 'checkbox-wrapper-48';
                    div.innerHTML = `
                    <label class="d-flex align-items-center">
                        <input type="checkbox" class="mr-2 brand-checkbox" value="${brand.id}" name="buy_phone">
                        <p class="m-0 categories_text">
                            ${brand.name}
                            <span class="categories_span">(${brand.brand_products_count})</span>
                        </p>
                    </label>
                `;
                    brandList.appendChild(div);
                });
                // Change button text to "Show Less"
                this.textContent = 'Show Less';
            }
            areBrandsExpanded = !areBrandsExpanded; // Toggle the state
        });
    </script>
    <script>
        $(document).on('click', '.btn-number', function(e) {
            e.preventDefault();
            console.log('Button clicked:', $(this));
            // Get the closest quantity box to scope the changes only to this product
            const parentContainer = $(this).closest('.quantity-box');
            const input = parentContainer.find("input[name='quantity']");
            const fieldName = $(this).attr("data-field");
            const type = $(this).attr("data-type");
            const productType = $(this).attr("data-producttype"); // Use data-producttype attribute
            let currentVal = parseInt(input.val());
            if (!isNaN(currentVal)) {
                if (type === "minus") {
                    if (currentVal > input.attr("min")) {
                        input.val(currentVal - 1).change();
                    }
                    if (parseInt(input.val()) === parseInt(input.attr("min"))) {
                        $(this).attr("disabled", true);
                    }
                } else if (type === "plus") {
                    if (currentVal < input.attr("max") || productType === "digital") {
                        input.val(currentVal + 1).change();
                    }
                    if (parseInt(input.val()) === parseInt(input.attr("max")) && productType === "physical") {
                        $(this).attr("disabled", true);
                    }
                }
            } else {
                input.val(0);
            }
        });
        $(document).on('focusin', '.input-number', function() {
            $(this).data("oldValue", $(this).val());
        });
        $(document).on('change', '.input-number', function() {
            const parentContainer = $(this).closest('.quantity-box');
            const productType = $(this).attr("data-producttype"); // Use data-producttype attribute
            const minValue = parseInt($(this).attr("min"));
            const maxValue = parseInt($(this).attr("max"));
            const valueCurrent = parseInt($(this).val());
            const name = $(this).attr("name");
            if (valueCurrent >= minValue) {
                parentContainer.find(".btn-number[data-type='minus']").removeAttr("disabled");
            } else {
                Swal.fire({
                    icon: "error",
                    title: "Cart",
                    text: "Sorry, the minimum order quantity does not match",
                });
                $(this).val($(this).data("oldValue"));
            }
            if (productType === "digital" || valueCurrent <= maxValue) {
                parentContainer.find(".btn-number[data-type='plus']").removeAttr("disabled");
            } else {
                Swal.fire({
                    icon: "error",
                    title: "Cart",
                    text: "Sorry, stock limit exceeded.",
                });
                $(this).val($(this).data("oldValue"));
            }
        });
        $(document).on('keydown', '.input-number', function(e) {
            if (
                $.inArray(e.keyCode, [46, 8, 9, 27, 13, 190]) !== -1 ||
                (e.keyCode === 65 && e.ctrlKey === true) ||
                (e.keyCode >= 35 && e.keyCode <= 39)
            ) {
                return;
            }
            if ((e.shiftKey || e.keyCode < 48 || e.keyCode > 57) && (e.keyCode < 96 || e.keyCode > 105)) {
                e.preventDefault();
            }
        });
        // search page header search category and brand dropdown
        $('.dropdown-item a').on('click', function(e) {
            e.preventDefault(); // Reset any interfering default behavior
            window.location.href = $(this).attr('href'); // Navigate to the link
        });
        // search page header search category and brand dropdown
    </script>
@endpush
