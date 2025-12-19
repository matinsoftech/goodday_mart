<section class="overflow-hidden">
    <div
        style="background-image: url('{{ asset('storage/app/public/deal/' . $web_config['flash_deals']->banner) }}'); background-size: cover; background-position: center; background-repeat: no-repeat; padding: 60px 12px 100px 12px;">
        <div class="container px-0 px-md-3">
            <div class="flash-deals-wrapper">
                {{-- <div class="flash-deal-view-all-web row d-flex justify-content-end mb-3">
                    @if (count($web_config['flash_deals']->products) > 0)
                        <a class="text-capitalize view-all-text text-white d-flex align-items-center gap-3"
                            href="{{ route('flash-deals', [$web_config['flash_deals'] ? $web_config['flash_deals']['id'] : 0]) }}">
                            {{ translate('view_all') }}
                            <!-- <svg width="1.2rem" clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round" stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="m12.007 2c-5.518 0-9.998 4.48-9.998 9.998 0 5.517 4.48 9.997 9.998 9.997s9.998-4.48 9.998-9.997c0-5.518-4.48-9.998-9.998-9.998zm1.523 6.21s1.502 1.505 3.255 3.259c.147.147.22.339.22.531s-.073.383-.22.53c-1.753 1.754-3.254 3.258-3.254 3.258-.145.145-.335.217-.526.217-.192-.001-.384-.074-.531-.221-.292-.293-.294-.766-.003-1.057l1.977-1.977h-6.693c-.414 0-.75-.336-.75-.75s.336-.75.75-.75h6.693l-1.978-1.979c-.29-.289-.287-.762.006-1.054.147-.147.339-.221.53-.222.19 0 .38.071.524.215z" fill-rule="nonzero"/></svg>
                            <i class="czi-arrow-{{ Session::get('direction') === 'rtl' ? 'left mr-1 ml-n1 mt-1 float-left' : 'right ml-1 mr-n1' }}"></i>-->
                        </a>
                    @endif
                </div> --}}

                <?php
                $startDate = \Carbon\Carbon::parse($web_config['flash_deals']['start_date']);
                $endDate = \Carbon\Carbon::parse($web_config['flash_deals']['end_date']);
                $now = \Carbon\Carbon::now();
                $totalDuration = $endDate->diffInSeconds($startDate);
                $elapsedDuration = $now->diffInSeconds($startDate);
                $flashDealsPercentage = ($elapsedDuration / max($totalDuration, 1)) * 100;
                ?>

                <div class="row g-3 mx-max-md-0">
                    <div class="col-lg-12 px-max-md-0">
                        <div class="countdown-card bg-transparent">
                            <div class="flash-deal-text text-white text-center">
                                <div>
                                    <span>{{ $web_config['flash_deals']->title }}</span>
                                </div>
                                <small>{{ translate('hurry_Up') }} ! {{ translate('the_offer_is_limited') }}.
                                    {{ translate('grab_while_it_lasts') }}</small>
                            </div>
                            <div class="text-center text-white">
                                {{-- old counter --}}
                                {{-- <div class="countdown-background">
                                    <span class="cz-countdown d-flex justify-content-center align-items-center flash-deal-countdown"
                                        data-countdown="{{$web_config['flash_deals']?date('m/d/Y',strtotime($web_config['flash_deals']['end_date'])):''}} 23:59:00 ">
                                        <span class="cz-countdown-days">
                                            <span class="cz-countdown-value"></span>
                                            <span class="cz-countdown-text">{{ translate('days')}}</span>
                                        </span>
                                        <span class="cz-countdown-value p-1">:</span>
                                        <span class="cz-countdown-hours">
                                            <span class="cz-countdown-value"></span>
                                            <span class="cz-countdown-text">{{ translate('hrs')}}</span>
                                        </span>
                                        <span class="cz-countdown-value p-1">:</span>
                                        <span class="cz-countdown-minutes">
                                            <span class="cz-countdown-value"></span>
                                            <span class="cz-countdown-text">{{ translate('min')}}</span>
                                        </span>
                                        <span class="cz-countdown-value p-1">:</span>
                                        <span class="cz-countdown-seconds">
                                            <span class="cz-countdown-value"></span>
                                            <span class="cz-countdown-text">{{ translate('sec')}}</span>
                                        </span>
                                    </span>
                                    <div class="progress __progress">
                                    <div class="progress-bar flash-deal-progress-bar" role="progressbar" style="width: {{ number_format($flashDealsPercentage, 2) }}%" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div> --}}
                                {{-- old counter ends --}}

                                <div class="countdown-background">
                                    <span
                                        class="cz-countdown d-flex justify-content-center align-items-center flash-deal-countdown"
                                        data-countdown="{{ $web_config['flash_deals'] ? date('m/d/Y', strtotime($web_config['flash_deals']['end_date'])) : '' }} 23:59:00">
                                        <span class="cz-countdown-days countdown-item">
                                            <span class="cz-countdown-value"></span>
                                            <span class="cz-countdown-text">{{ translate('Days') }}</span>
                                        </span>
                                        <span class="cz-countdown-value p-1">:</span>
                                        <span class="cz-countdown-hours countdown-item">
                                            <span class="cz-countdown-value"></span>
                                            <span class="cz-countdown-text">{{ translate('Hrs') }}</span>
                                        </span>
                                        <span class="cz-countdown-value p-1">:</span>
                                        <span class="cz-countdown-minutes countdown-item">
                                            <span class="cz-countdown-value"></span>
                                            <span class="cz-countdown-text">{{ translate('Min') }}</span>
                                        </span>
                                        <span class="cz-countdown-value p-1">:</span>
                                        <span class="cz-countdown-seconds countdown-item">
                                            <span class="cz-countdown-value"></span>
                                            <span class="cz-countdown-text">{{ translate('Sec') }}</span>
                                        </span>
                                    </span>
                                    <div class="progress __progress d-none">
                                        <div class="progress-bar flash-deal-progress-bar" role="progressbar"
                                            style="width: {{ number_format($flashDealsPercentage, 2) }}%"
                                            aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
                                    </div>
                                </div>


                            </div>
                        </div>
                    </div>

                    <div class="col-12 pb-0 d-md-none px-max-md-0 d-none">
                        <div class="owl-theme owl-carousel flash-deal-slider-mobile">
                            @foreach ($web_config['flash_deals']->products as $key => $deal)
                                @if ($key < 10 && $deal->product)
                                    @include('web-views.partials._product-card-1', [
                                        'product' => $deal->product,
                                        'decimal_point_settings' => $decimal_point_settings,
                                    ])
                                @endif
                            @endforeach
                        </div>
                    </div>
                    {{-- @if (count($web_config['flash_deals']->products) > 0)
                        <div class="col-12 d-md-none text-center px-max-md-0">
                            <a class="text-capitalize view-all-text web-text-primary d-flex align-items-center"
                                href="{{ route('flash-deals', [$web_config['flash_deals'] ? $web_config['flash_deals']['id'] : 0]) }}">
                                {{ translate('view_all') }}fasdfasdf
                                <svg width="1.2rem" clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round"
                                    stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                    <path
                                        d="m12.007 2c-5.518 0-9.998 4.48-9.998 9.998 0 5.517 4.48 9.997 9.998 9.997s9.998-4.48 9.998-9.997c0-5.518-4.48-9.998-9.998-9.998zm1.523 6.21s1.502 1.505 3.255 3.259c.147.147.22.339.22.531s-.073.383-.22.53c-1.753 1.754-3.254 3.258-3.254 3.258-.145.145-.335.217-.526.217-.192-.001-.384-.074-.531-.221-.292-.293-.294-.766-.003-1.057l1.977-1.977h-6.693c-.414 0-.75-.336-.75-.75s.336-.75.75-.75h6.693l-1.978-1.979c-.29-.289-.287-.762.006-1.054.147-.147.339-.221.53-.222.19 0 .38.071.524.215z"
                                        fill-rule="nonzero" />
                                </svg>
                                <!--<i class="czi-arrow-{{ Session::get('direction') === 'rtl' ? 'left mr-1 ml-n1 mt-1 float-left' : 'right ml-1 mr-n1' }}"></i>-->
                            </a>
                        </div>
                    @endif --}}
                </div>

            </div>
        </div>
    </div>

    <div class="container" style="margin-top: -120px;">
        {{-- <div class="row"> --}}
        @php($nullFilter = 0)
        @foreach ($web_config['flash_deals']->products as $key => $deal)
            @if ($deal->product)
                @php($nullFilter = $nullFilter + 1)
            @endif
        @endforeach

        @if ($nullFilter <= 10)
            <div class="col-lg-12 px-max-md-0">
                <div class="owl-theme owl-carousel flash-deal-slider">
                    @foreach ($web_config['flash_deals']->products as $key => $deal)
                        @if ($deal->product)
                            @include('web-views.partials._feature-product', [
                                'product' => $deal->product,
                                'decimal_point_settings' => $decimal_point_settings,
                            ])
                        @endif
                    @endforeach
                </div>
            </div>
        @else
            <div class="owl-theme owl-carousel flash-deal-slider">
            @php($index = 0)
            @foreach ($web_config['flash_deals']->products as $key => $deal)
                @if ($index < 10 && $deal->product)
                    @php($index = $index + 1)
                    {{-- class="col-lg-2 col-6 col-sm-4 col-md-3 d-none d-md-block px-max-md-0" --}}
                    <div>
                        @include('web-views.partials._feature-product', [
                            'product' => $deal->product,
                            'decimal_point_settings' => $decimal_point_settings,
                        ])
                    </div>
                @endif
            @endforeach
            </div>
        @endif
        </div>
    {{-- </div> --}}
</section>
