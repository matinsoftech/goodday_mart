<div class="col-lg-12 px-max-md-0">

    <div class="h-100">

        <div class="card-body p-0">

            <div class="row d-flex justify-content-between align-items-center mb-4 pb-2 home-title-border">

                <div class="text-black home-title">

                    <h3 class="barlow-bold text-capitalize mb-4">Top Trending Products</h3>

                </div>

                <div>

                    <a class="text-capitalize view-all-text web-text-primary d-flex align-items-center gap-3"

                        href="{{ route('products', ['data_from' => 'best-selling', 'page' => 1]) }}">{{ translate('view_all') }}

                        <svg width="1.2rem" clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round"

                            stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">

                            <path

                                d="m12.007 2c-5.518 0-9.998 4.48-9.998 9.998 0 5.517 4.48 9.997 9.998 9.997s9.998-4.48 9.998-9.997c0-5.518-4.48-9.998-9.998-9.998zm1.523 6.21s1.502 1.505 3.255 3.259c.147.147.22.339.22.531s-.073.383-.22.53c-1.753 1.754-3.254 3.258-3.254 3.258-.145.145-.335.217-.526.217-.192-.001-.384-.074-.531-.221-.292-.293-.294-.766-.003-1.057l1.977-1.977h-6.693c-.414 0-.75-.336-.75-.75s.336-.75.75-.75h6.693l-1.978-1.979c-.29-.289-.287-.762.006-1.054.147-.147.339-.221.53-.222.19 0 .38.071.524.215z"

                                fill-rule="nonzero" />

                        </svg>

                        <!--<i class="czi-arrow-{{ Session::get('direction') === 'rtl' ? 'left mr-1 ml-n1 mt-1 float-left' : 'right ml-1 mr-n1' }}"></i>-->

                    </a>

                </div>

            </div>

            {{-- <div class="row g-3"> --}}

            <div class="owl-carousel" id="best-selling-slider">

                @php

                    $productsFound = false;

                @endphp

                @foreach ($bestSellProduct as $key => $bestSell)

                    @if ($bestSell->product != null)

                        @if ($bestSell->product && $key < 6)

                            @php

                                $productsFound = true;

                            @endphp

                            {{-- <div class="col-sm-6"> --}}

                            <a class="__best-selling" href="{{ route('product', $bestSell->product->slug) }}">

                                @if ($bestSell->product->discount > 0)

                                    <div class="d-flex">

                                        <span class="for-discount-value p-1 pl-2 pr-2 font-bold fs-13">

                                            <span class="direction-ltr d-block">

                                                @if ($bestSell->product->discount_type == 'percent')

                                                    -{{ round($bestSell->product->discount) }}%

                                                @elseif($bestSell->product->discount_type == 'flat')

                                                    -{{ webCurrencyConverter(amount: $bestSell->product->discount) }}

                                                @endif

                                            </span>

                                        </span>

                                    </div>

                                @endif

                                <div class="product-card-slider">

                                    <div class="best-selleing-image">

                                        <img class="rounded"

                                            src="{{ getValidImage(path: 'storage/app/public/product/thumbnail/' . $bestSell->product['thumbnail'], type: 'product') }}"

                                            alt="{{ translate('product') }}" />

                                    </div>

                                    <div class="best-selling-details w-100">

                                        @php($overallRating = getOverallRating($bestSell->product['reviews']))

                                        @if ($overallRating[0] != 0)

                                            <div class="rating-show">

                                                <span class="d-flex font-size-sm text-body">

                                                    @for ($inc = 1; $inc <= 5; $inc++)

                                                        @if ($inc <= (int) $overallRating[0])

                                                            <i class="tio-star text-warning"></i>

                                                        @elseif ($overallRating[0] != 0 && $inc <= (int) $overallRating[0] + 1.1 && $overallRating[0] > ((int) $overallRating[0]))

                                                            <i class="tio-star-half text-warning"></i>

                                                        @else

                                                            <i class="tio-star-outlined text-warning"></i>

                                                        @endif

                                                    @endfor

                                                    {{-- <label class="badge-style">( {{ count($bestSell->product['reviews']) }} )</label> --}}

                                                </span>

                                            </div>

                                        @endif

                                        <h6 class="widget-product-title m-0">

                                            <span class="ptr fw-semibold">

                                                {{ Str::limit($bestSell->product['name'], 100) }}

                                            </span>

                                        </h6>

                                        {{--

                                                <p class="m-0 py-1 productsize">

                                                    500g Pack

                                                </p>

                                            --}}

                                        <div

                                            class="widget-product-meta d-flex flex-wrap gap-8 align-items-center row-gap-0">

                                            <span class="actual-product-price">

                                                {{ webCurrencyConverter(

                                                    amount: $bestSell->product->unit_price -

                                                        getProductDiscount(product: $bestSell->product, price: $bestSell->product->unit_price),

                                                ) }}

                                            </span>

                                            <span>

                                                @if ($bestSell->product->discount > 0)

                                                    <del class="discount-product-price">

                                                        {{ webCurrencyConverter(amount: $bestSell->product->unit_price) }}

                                                    </del>

                                                @endif

                                            </span>

                                        </div>

                                        <form id="add-to-cart-form" class="mb-2">

                                            @csrf

                                            <input type="hidden" name="id" value="{{ $bestSell->product->id }}">

                                            <div>

                                                <div class="d-none">

                                                    <div

                                                        class="d-flex justify-content-center align-items-center quantity-box border rounded border-base web-text-primary">

                                                        <span class="input-group-btn">

                                                            <button class="btn btn-number __p-10 web-text-primary"

                                                                type="button" data-type="minus" data-field="quantity"

                                                                disabled="disabled">

                                                                -

                                                            </button>

                                                        </span>

                                                        <input type="text" name="quantity"

                                                            class="form-control input-number text-center cart-qty-field __inline-29 border-0 "

                                                            placeholder="{{ translate('1') }}"

                                                            value="{{ $product->minimum_order_qty ?? 1 }}"

                                                            data-producttype="{{ $product->product_type }}"

                                                            min="{{ $product->minimum_order_qty ?? 1 }}"

                                                            max="{{ $product['product_type'] == 'physical' ? $product->current_stock : 100 }}">

                                                        <span class="input-group-btn">

                                                            <button class="btn btn-number __p-10 web-text-primary"

                                                                type="button"

                                                                data-producttype="{{ $product->product_type }}"

                                                                data-type="plus" data-field="quantity">

                                                                +

                                                            </button>

                                                        </span>

                                                    </div>

                                                </div>

                                            </div>

                                            <input type="hidden" class="product-generated-variation-code"

                                                name="product_variation_code">

                                            <input type="hidden" value="" class="in_cart_key form-control w-50"

                                                name="key">

                                            <div class="__btn-grp mt-2 mb-3 d-none d-sm-flex">

                                                @if (

                                                    ($product->added_by == 'seller' &&

                                                        ($sellerTemporaryClose ||

                                                            (isset($product->seller->shop) &&

                                                                $product->seller->shop->vacation_status &&

                                                                $currentDate >= $sellerVacationStartDate &&

                                                                $currentDate <= $sellerVacationEndDate))) ||

                                                        ($product->added_by == 'admin' &&

                                                            ($inHouseTemporaryClose ||

                                                                ($inHouseVacationStatus &&

                                                                    $currentDate >= $inHouseVacationStartDate &&

                                                                    $currentDate <= $inHouseVacationEndDate))))

                                                    <button

                                                        class="btn add-to-cart text-white d-flex align-items-center string-limit"

                                                        type="button" disabled>

                                                        Add To Cart

                                                        <img src="{{ asset('public/assets/front-end/img/icons/cart.png') }}"

                                                            alt="cart">

                                                    </button>

                                                @else

                                                    @if (isset($cartItems[$bestSell->product->id]))

                                                        <div class="quantity-wrapper d-flex align-items-center"

                                                            style="height: 38px; padding: 0.2rem 0.4rem; gap: 4px; border: 1px solid #ced4da; border-radius: 0.25rem;"

                                                            data-id="{{ $product->id }}">



                                                            <button type="button"

                                                                class="btn btn-secondary btn-sm remove-item-btn"

                                                                style="display: {{ $cartItems[$product->id]->quantity == 1 ?: 'none' }};"

                                                                data-id="{{ $product->id }}">

                                                                <i class="fa fa-trash text-danger"></i>

                                                            </button>



                                                            <button type="button"

                                                                class="btn btn-secondary btn-sm decrement-btn"

                                                                style="display: {{ $cartItems[$product->id]->quantity > 1 ? 'block' : 'none' }};"

                                                                data-id="{{ $product->id }}">

                                                                <i class="fa fa-minus text-danger"></i>

                                                            </button>



                                                            <input type="number" min="1"

                                                                class="form-control cart-quantity-input text-center"

                                                                style="width: 50px; height: 100%;"

                                                                value="{{ $cartItems[$product->id]->quantity }}"

                                                                readonly>



                                                            <button type="button"

                                                                class="btn btn-secondary btn-sm increment-btn"

                                                                data-id="{{ $product->id }}">

                                                                <i class="fa fa-plus text-success"></i>

                                                            </button>

                                                        </div>

                                                    @else

                                                        <button type="button" class="btn btn-primary add-to-cart"

                                                            data-id="{{ $bestSell->product->id }}">

                                                            Add To Cart

                                                            <i class="fa fa-shopping-cart" aria-hidden="true"></i>

                                                        </button>

                                                    @endif



                                                    {{-- <button type="button" class="btn add-to-cart text-white d-flex align-items-center"

                                                            data-id="{{ $bestSell->product->id }}">

                                                            Add To Cart

                                                            <img src="{{ asset('public/assets/front-end/img/icons/cart.png') }}" alt="cart">

                                                        </button> --}}

                                                @endif

                                                @if (

                                                    ($product->added_by == 'seller' &&

                                                        ($sellerTemporaryClose ||

                                                            (isset($product->seller->shop) &&

                                                                $product->seller->shop->vacation_status &&

                                                                $currentDate >= $sellerVacationStartDate &&

                                                                $currentDate <= $sellerVacationEndDate))) ||

                                                        ($product->added_by == 'admin' &&

                                                            ($inHouseTemporaryClose ||

                                                                ($inHouseVacationStatus &&

                                                                    $currentDate >= $inHouseVacationStartDate &&

                                                                    $currentDate <= $inHouseVacationEndDate))))

                                                    <div class="alert alert-danger" role="alert">

                                                        {{ translate('this_shop_is_temporary_closed_or_on_vacation._You_cannot_add_product_to_cart_from_this_shop_for_now') }}

                                                    </div>

                                                @endif

                                            </div>

                                        </form>

                                    </div>

                                </div>

                            </a>

                            {{-- </div> --}}

                        @endif

                    @endif

                @endforeach

                @if (!$productsFound)

                    <div class="row align-items-center justify-content-center bg-white w-100 p-4">

                        <p>No Products Found.</p>

                    </div>

                @endif

            </div>

        </div>

    </div>

</div>

@push('script')

<script>

    $(document).ready(function() {

        const csrfToken = "{{ csrf_token() }}";



        // Function to bind quantity controls for a given wrapper

        function bindQuantityControls(wrapper) {

            const productId = wrapper.data('id');

            const input = wrapper.find('.cart-quantity-input');

            const btnMinus = wrapper.find('.decrement-btn');

            const btnPlus = wrapper.find('.increment-btn');

            const btnRemove = wrapper.find('.remove-item-btn');



            btnPlus.off('click').on('click', function() {

                let qty = parseInt(input.val()) + 1;

                input.val(qty);



                if (qty > 1) {

                    btnMinus.css('display', 'block');

                    btnRemove.css('display', 'none');

                }



                $.ajax({

                    url: "{{ route('cart.update-cart-quantity') }}",

                    type: 'POST',

                    data: {

                        _token: csrfToken,

                        product_id: productId,

                        quantity: qty

                    },

                    success: function(data) {

                        console.log('Quantity increased:', data);

                    },

                    error: function(xhr) {

                        console.error('Increase error:', xhr.responseText);

                    }

                });

            });



            btnMinus.off('click').on('click', function() {

                let qty = parseInt(input.val());

                if (qty > 1) {

                    qty--;

                    input.val(qty);



                    if (qty === 1) {

                        btnMinus.css('display', 'none');

                        btnRemove.css('display', 'block');

                    }



                    $.ajax({

                        url: "{{ route('cart.update-cart-quantity') }}",

                        type: 'POST',

                        data: {

                            _token: csrfToken,

                            product_id: productId,

                            quantity: qty

                        },

                        success: function(data) {

                            console.log('Quantity decreased:');

                        },

                        error: function(xhr) {

                            console.error('Decrease error:', xhr.responseText);

                        }

                    });

                }

            });



            btnRemove.off('click').on('click', function() {

                $.ajax({

                    url: "{{ route('cart.delete-carts') }}",

                    type: 'POST',

                    data: {

                        _method: 'DELETE',

                        _token: csrfToken,

                        product_id: productId

                    },

                    success: function(data) {

                        console.log('Item removed:', data);

                        if (data.success) {

                            const addToCartBtn = `

                            <button type="button" class="btn btn-primary add-to-cart" data-id="${productId}">

                                Add To Cart

                                <i class="fa fa-shopping-cart" aria-hidden="true"></i>

                            </button>

                        `;

                            wrapper.replaceWith(addToCartBtn);

                            location.reload();

                        }

                    },

                    error: function(xhr) {

                        console.error('Remove error:', xhr.responseText);

                    }

                });

            });

        }



        // Initial binding for existing quantity wrappers

        $('.quantity-wrapper').each(function() {

            bindQuantityControls($(this));

        });



        // Delegated event handler for dynamically added "Add To Cart" buttons





    });

</script>

@endpush

