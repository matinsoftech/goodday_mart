@php

    $wishlistStatus = \App\Models\Wishlist::where([

        'product_id' => $product->id,

        'customer_id' => auth('customer')->id() ?? 0,

    ])->exists();

@endphp

<div class="product-single-hover style--card">

    <div class="overflow-hidden position-relative">

        <div class="inline_product clickable d-flex justify-content-center">

            <div class="wishlist-btn-container">

                <button type="button"

                    class="wishlist-btn product-action-add-wishlist-single {{ $wishlistStatus ? 'activeheart' : '' }}"

                    data-product-id="{{ $product->id }}">

                    <i class="fa {{ $wishlistStatus ? 'fa-heart' : 'fa-heart-o' }}"></i>

                </button>

            </div>

            {{-- @include('component.wishlist-button', ['product' => $product, 'wishlistStatus' => $wishlistStatus]) --}}

            @if ($product->discount > 0)

                <div class="d-flex">

                    <span class="for-discount-value p-1 pl-2 pr-2 font-bold fs-13">

                        <span class="direction-ltr d-block">

                            @if ($product->discount_type == 'percent')

                                -{{ round($product->discount, !empty($decimalPointSettings) ? $decimalPointSettings : 0) }}%

                            @elseif($product->discount_type == 'flat')

                                -{{ webCurrencyConverter(amount: $product->discount) }}

                            @endif

                        </span>

                    </span>

                </div>

            @else

                <div class="d-flex justify-content-end">

                    <span class="for-discount-value-null"></span>

                </div>

            @endif

            <div class="p-10px pb-0">

                <a href="{{ route('product', $product->slug) }}" class="w-100">

                    <img alt=""

                        src="{{ getValidImage(path: 'storage/app/public/product/thumbnail/' . $product['thumbnail'], type: 'product') }}">

                </a>

            </div>

            @if ($product->product_type == 'physical' && $product->current_stock <= 0)

                <span class="out_fo_stock">{{ translate('out_of_stock') }}</span>

            @endif

        </div>

        @php($overallRating = getOverallRating($product->reviews))

        <div class="single-product-details">

            @if ($overallRating[0] != 0)

                <div class="rating-show justify-content-between text-center">

                    <span class="d-inline-block font-size-sm text-body">

                        @for ($inc = 1; $inc <= 5; $inc++)

                            @if ($inc <= (int) $overallRating[0])

                                <i class="tio-star text-warning"></i>

                            @elseif ($overallRating[0] != 0 && $inc <= (int) $overallRating[0] + 1.1 && $overallRating[0] > ((int) $overallRating[0]))

                                <i class="tio-star-half text-warning"></i>

                            @else

                                <i class="tio-star-outlined text-warning"></i>

                            @endif

                        @endfor

                        <label class="badge-style">( {{ count($product->reviews) }} )</label>

                    </span>

                </div>

            @endif

            <div class="text-center">

                <a href="{{ route('product', $product->slug) }}">

                    {{ Str::limit($product['name'], 23) }}

                </a>

            </div>

            <div class="justify-content-between text-center">

                <div class="product-price text-center d-flex flex-wrap justify-content-center align-items-center gap-8">

                    @if ($product->discount > 0)

                        <del class="category-single-product-price">

                            {{ webCurrencyConverter(amount: $product->unit_price) }}

                        </del>

                    @endif

                    <span class="text-accent text-dark">

                        {{ webCurrencyConverter(

                            amount: $product->unit_price - getProductDiscount(product: $product, price: $product->unit_price),

                        ) }}

                    </span>

                </div>

            </div>

            {{-- Add to cart form --}}

            <form id="add-to-cart-form-{{ $product->id }}" class="mb-2">

                @csrf

                <input type="hidden" name="id" value="{{ $product->id }}">

                <input type="hidden" name="quantity"

                    class="form-control input-number text-center cart-qty-field __inline-29 border-0"

                    value="{{ $product->minimum_order_qty ?? 1 }}" min="{{ $product->minimum_order_qty ?? 1 }}"

                    max="{{ $product['product_type'] == 'physical' ? $product->current_stock : 100 }}"

                    data-producttype="{{ $product->product_type }}">

                <input type="hidden" class="product-generated-variation-code" name="product_variation_code">

                <input type="hidden" value="" class="in_cart_key form-control w-50" name="key">

                <div class="product __btn-grp mt-2 mb-3 mx-2 d-sm-flex">
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
                                    {{-- <button class="btn add-to-cart d-flex align-items-center string-limit" --}}
                                    <button class="btn add-to-cart " type="button" disabled>
                                        Add To Cart
                                        <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                    </button>
                                @else
                                    {{-- <button type="button" class="btn add-to-cart d-flex align-items-center" --}}
                                    @if (isset($cartItems[$product->id]))
                                        <div class="quantity-wrapper d-flex align-items-center"
                                            style="height: 38px; padding: 0.2rem 0.4rem; gap: 4px; border: 1px solid #ced4da; border-radius: 0.25rem;"
                                            data-id="{{ $product->id }}">

                                            <button type="button" class="btn btn-sm remove-item-btn"
                                                style="display: {{ $cartItems[$product->id]->quantity == 1 ?: 'none' }};"
                                                data-id="{{ $product->id }}">
                                                <i class="fa fa-trash text-danger"></i>
                                            </button>

                                            <button type="button" class="btn btn-sm decrement-btn"
                                                style="display: {{ $cartItems[$product->id]->quantity > 1 ? 'block' : 'none' }};"
                                                data-id="{{ $product->id }}">
                                                <i class="fa fa-minus text-danger"></i>
                                            </button>

                                            <input type="number" min="1"
                                                class="form-control cart-quantity-input text-center"
                                                style="width: 50px; height: 100%;"
                                                value="{{ $cartItems[$product->id]->quantity }}" readonly>

                                            <button type="button" class="btn btn-sm increment-btn"
                                                data-id="{{ $product->id }}">
                                                <i class="fa fa-plus text-success"></i>
                                            </button>
                                        </div>
                                    @else
                                        <button type="button" class="btn btn-primary add-to-cart"
                                            data-id="{{ $product->id }}">
                                            Add To Cart
                                            <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                        </button>
                                    @endif
                                    {{-- <button type="button" class="btn add-to-cart " data-id="{{ $product->id }}">
                                        Add To Cart
                                        <i class="fa fa-shopping-cart" aria-hidden="true"></i>
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
                                {{-- <button type="button" class="btn  add-to-cart-btn "
                                data-id="{{ $product->id }}">
                                Add To Cart
                                <i class="fa fa-shopping-cart" aria-hidden="true"></i> --}}
                                </button>
                                <div class="cart-controls m-auto text-center" style="display: none; ">
                                    <button type="button" class="btn quantity-control decrease-btn ">-</button>
                                    <span class="quantity-display" style="font-weight: 600;">1</span>
                                    <button type="button" class="btn quantity-control increase-btn ">+</button>
                                </div>
                            </div>

            </form>

        </div>

    </div>

</div>

{{-- jQuery CDN --}}

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

{{-- Toast Styling --}}

<style>

    .custom-toast {

        position: fixed;

        top: 20px;

        right: 20px;

        background-color: #63bb6e;

        color: white;

        padding: 15px 20px;

        border-radius: 6px;

        box-shadow: 0 0 10px rgba(0, 0, 0, 0.2);

        font-weight: bold;

        z-index: 9999;

        display: none;

    }



    .custom-toast .checkmark {

        font-size: 20px;

        margin-right: 8px;

    }



    .wishlist-btn-container {

        position: absolute;

        top: 10px;

        right: 10px;

        z-index: 10;

    }



    .wishlist-btn-container {

        position: absolute;

        top: 10px;

        right: 10px;

        z-index: 10;

    }



    .wishlist-btn {

        width: 32px;

        height: 33px;

        border-radius: 50%;

        border: none;

        background-color: #ffffff;

        display: flex;

        align-items: center;

        justify-content: center;

        box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);

        transition: all 0.3s ease;

        cursor: pointer;

    }



    /* Default state (deselected): outline heart */

    .wishlist-btn:not(.activeheart) i {

        font-size: 18px;

        color: #28a745;

        /* green outline only */

    }



    /* Hover effect */

    .wishlist-btn:hover {

        transform: scale(1.05);

    }



    /* Active state: green circle with white heart */

    .wishlist-btn.activeheart {

        background-color: #28a745;

    }



    .wishlist-btn.activeheart i {

        font-size: 17px;

        color: #ffffff;

    }

</style>

{{-- Toast + AJAX --}}

{{-- <script>

    $.ajaxSetup({

        headers: {

            'X-CSRF-TOKEN': $('input[name="_token"]').val()

        }

    });

    $(document).on('click', '.add-to-cart', function() {

        let productId = $(this).data('id');

        let form = $('#add-to-cart-form-' + productId);

        let formData = form.serialize();

        $.ajax({

            url: "{{ route('cart.add') }}",

            type: "POST",

            data: formData,

            success: function(response) {

                $('.custom-toast').remove(); // Remove any existing

                let toastColor = response.status === 'exists' ? '#ffc107' :

                    '#63bb6e'; // yellow or green

                let icon = response.status === 'exists' ? '?' : '?';

                let toast = $(`

                    <div class="custom-toast" style="background-color: ${toastColor};">

                        <span class="checkmark">${icon}</span> ${response.message}

                    </div>

                `);

                $('body').append(toast);

                toast.fadeIn();

                setTimeout(() => {

                    toast.fadeOut(500, function() {

                        $(this).remove();

                    });

                }, 3000);

            },

            error: function(xhr) {

                $('.custom-toast').remove();

                let errorToast = $(`

                    <div class="custom-toast" style="background-color: #e74c3c;">

                        <span class="checkmark">?</span> Something went wrong!

                    </div>

                `);

                $('body').append(errorToast);

                errorToast.fadeIn();

                setTimeout(() => {

                    errorToast.fadeOut(500, function() {

                        $(this).remove();

                    });

                }, 3000);

            }

        });

    });

</script> --}}

<script>

    $.ajaxSetup({

        headers: {

            'X-CSRF-TOKEN': $('input[name="_token"]').val()

        }

    });



    // Use event delegation and prevent multiple bindings

    $(document).off('click', '.add-to-cart').on('click', '.add-to-cart', function() {

        let $btn = $(this);



        // Prevent multiple clicks while request is in progress

        if ($btn.prop('disabled')) return;



        $btn.prop('disabled', true); // disable button immediately



        let productId = $btn.data('id');

        let form = $('#add-to-cart-form-' + productId);

        let formData = form.serialize();



        $.ajax({

            url: "{{ route('cart.add') }}",

            type: "POST",

            data: formData,

            success: function(response) {

                $('.custom-toast').remove();

                let toastColor = response.status === 'exists' ? '#ffc107' :

                    '#63bb6e'; // yellow or green

                let icon = response.status === 'exists' ? '⚠️' : '✅';

                let toast = $(`

                    <div class="custom-toast" style="background-color: ${toastColor};">

                        <span class="checkmark">${icon}</span> ${response.message}

                    </div>

                `);

                $('body').append(toast);

                toast.fadeIn();



                setTimeout(() => {

                    toast.fadeOut(500, function() {

                        $(this).remove();

                    });

                }, 3000);

                location.reload();

            },

            error: function(xhr) {

                $('.custom-toast').remove();

                let errorToast = $(`

                    <div class="custom-toast" style="background-color: #e74c3c;">

                        <span class="checkmark">❌</span> Something went wrong!

                    </div>

                `);

                $('body').append(errorToast);

                errorToast.fadeIn();



                setTimeout(() => {

                    errorToast.fadeOut(500, function() {

                        $(this).remove();

                    });

                }, 3000);

            },

            complete: function() {

                // Re-enable button after request completes (success or error)

                $btn.prop('disabled', false);

            }

        });

    });

</script>

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

