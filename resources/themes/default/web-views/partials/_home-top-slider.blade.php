<div class="row no-gutters position-relative rtl">
    {{-- @if ($categories->count() > 0)
        <div class="col-xl-3 position-static d-none d-xl-block __top-slider-cate">
            <div class="category-menu-wrap position-static">
                <ul class="category-menu mt-0">
                    @foreach ($categories as $key => $category)
                        <li>
                            <a href="{{route('products',['id'=> $category['id'],'data_from'=>'category','page'=>1])}}">{{$category->name}}</a>
                            @if ($category->childes->count() > 0)
                                <div class="mega_menu z-2">
                                    @foreach ($category->childes as $sub_category)
                                        <div class="mega_menu_inner">
                                            <h6><a href="{{route('products',['id'=> $sub_category['id'],'data_from'=>'category','page'=>1])}}">{{$sub_category->name}}</a></h6>
                                            @if ($sub_category->childes->count() > 0)
                                                @foreach ($sub_category->childes as $sub_sub_category)
                                                    <div><a href="{{route('products',['id'=> $sub_sub_category['id'],'data_from'=>'category','page'=>1])}}">{{$sub_sub_category->name}}</a></div>
                                                @endforeach
                                            @endif
                                        </div>
                                    @endforeach
                                </div>
                            @endif
                        </li>
                    @endforeach
                    <li class="text-center">
                        <a href="{{route('categories')}}" class="text-primary font-weight-bold justify-content-center text-capitalize">
                            {{translate('view_all')}}
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    @endif --}}
    {{-- <div class="col-12 __top-slider-images"> --}}
    {{--
    <div class="">
        <div class="{{Session::get('direction') === "rtl" ? 'pr-xl-0' : 'pl-xl-0'}}">
            <div class="owl-theme owl-carousel hero-slider">
                @foreach ($main_banner as $key => $banner)
                <a href="{{$banner['url']}}" class="d-block" target="_blank">
                    <img class="w-100 __slide-img" alt=""
                        src="{{ getValidImage(path: 'storage/app/public/banner/'.$banner['photo'], type: 'banner') }}">
                </a>
                @endforeach
            </div>
        </div>
    </div> --}}
    @push('css_or_js')
    <style>
        .at-header-social {
            left: -70px;
            top: 50%;
            z-index: 50;
            position: absolute;
            -webkit-transform: translateY(-50%) rotate(-90deg);
            transform: translateY(-50%) rotate(-90deg);
            overflow: visible;
            display: flex;
            align-items: center;
            gap: 0.5rem;
        }
        .at-header-social>span {
            color: #191d28 !important;
            font-size: 14px;
            font-weight: 600;
            padding-left: 20px;
            display: inline-block;
        }
        .at-header-social>span::before {
            content: "";
            position: absolute;
            left: -15px;
            bottom: 50%;
            width: 32px;
            height: 1px;
            background: #191d28;
            transform: translateY(50%);
        }
        .bg-unset {
            background: unset;
        }
        #home-hero-slider .owl-nav {
            display: none !important;
        }
    </style>
    @endpush
    <div class="owl-carousel " id="home-hero-slider">
        @foreach ($main_banner as $key => $banner)
            <a href="{{ $banner['url'] }}" target="_blank">
                <img src="{{ getValidImage(path: 'storage/app/public/banner/' . $banner['photo'], type: 'banner') }}"
                    alt="">
            </a>
        @endforeach
    </div>
    <div class="at-header-social d-none  align-items-center position-absolute">
        <span class="title">Follow on</span>
        <div
            class="max-sm-100 justify-content-start d-flex flex-wrap mt-md-3 mt-0 mb-md-3 text-align-direction footer-social_media">
            @if ($web_config['social_media'])
                @foreach ($web_config['social_media'] as $item)
                    <span class="social-media " style="transform: rotate(90deg);">
                        @if ($item->name == 'twitter')
                            <a class="social-btn  sb-{{ $item->name }} mb-2 d-flex justify-content-center align-items-center bg-unset"
                                target="_blank" href="{{ $item->link }}">
                                <svg xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" width="16" height="16"
                                    viewBox="0 0 24 24">
                                    <g opacity=".3">
                                        <polygon fill="#fff" fill-rule="evenodd"
                                            points="16.002,19 6.208,5 8.255,5 18.035,19" clip-rule="evenodd">
                                        </polygon>
                                        <polygon points="8.776,4 4.288,4 15.481,20 19.953,20 8.776,4">
                                        </polygon>
                                    </g>
                                    <polygon fill-rule="evenodd" points="10.13,12.36 11.32,14.04 5.38,21 2.74,21"
                                        clip-rule="evenodd">
                                    </polygon>
                                    <polygon fill-rule="evenodd" points="20.74,3 13.78,11.16 12.6,9.47 18.14,3"
                                        clip-rule="evenodd">
                                    </polygon>
                                    <path
                                        d="M8.255,5l9.779,14h-2.032L6.208,5H8.255 M9.298,3h-6.93l12.593,18h6.91L9.298,3L9.298,3z"
                                        fill="currentColor">
                                    </path>
                                </svg>
                            </a>
                        @else
                            <a class="social-btn sb-{{ $item->name }} mb-2 bg-unset" target="_blank"
                                href="{{ $item->link }}">
                                <i class="{{ $item->icon }}" aria-hidden="true" style="color: #191d28;"></i>
                            </a>
                        @endif
                    </span>
                @endforeach
            @endif
        </div>
    </div>
</div>
