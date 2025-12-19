@if($products->count() > 0)
    {{-- <div class="items-container row"> --}}
        @php($decimal_point_settings = getWebConfig('decimal_point_settings'))
        @foreach($products as $p)
            @php($product = !empty($p->product_id) ? $p->product : $p)
            @if(!empty($product))
                <div class="items-card-container col-lg-3 col-md-4 col-sm-6 col-6 mb-2">
                    @include('web-views.partials._filter-single-product', [
                        'product' => $product,
                        'decimal_point_settings' => $decimal_point_settings
                    ])
                </div>
            @endif
        @endforeach
    {{-- </div> --}}
@else
    <div class="top-50 left-50 d-flex justify-content-center align-items-center w-100 py-5">
        <div>
            <img src="{{ theme_asset('public/assets/front-end/img/media/product.svg') }}" class="img-fluid" alt="">
            <h6 class="text-muted">{{ translate('no_product_found') }}</h6>
        </div>
    </div>
@endif
