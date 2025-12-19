@if ($product->current_stock > 0)
    @php
        $wishlistStatus = \App\Models\Wishlist::where([
            'product_id' => $product->id,
            'customer_id' => auth('customer')->id() ?? 0,
        ])->exists();
    @endphp
    <div class="product-single-hover product-card-slider">
        <div class="overflow-hidden position-relative w-100">
            <div class=" inline_product clickable d-flex justify-content-center">
                <div class="wishlist-btn-container">
                    <button type="button"
                        class="wishlist-btn product-action-add-wishlist-single {{ $wishlistStatus ? 'activeheart' : '' }}"
                        data-product-id="{{ $product->id }}">
                        <i class="fa {{ $wishlistStatus ? 'fa-heart' : 'fa-heart-o' }}"></i>
                    </button>
                </div>
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
                <div class="pb-0 ">
                    <a class="best-selleing-image" href="{{ route('product', $product->slug) }}" class="w-100">
                        <img alt=""
                            src="{{ getValidImage(path: 'storage/app/public/product/thumbnail/' . $product['thumbnail'], type: 'product') }}">
                    </a>
                </div>
                {{-- <div class="quick-view">
                    <a class="btn-circle stopPropagation action-product-quick-view" href="javascript:"
                        data-product-id="{{ $product->id }}">
                        <i class="czi-eye align-middle"></i>
                    </a>
                </div> --}}
                @if ($product->product_type == 'physical' && $product->current_stock <= 0)
                    <span class="out_fo_stock">{{ translate('out_of_stock') }}</span>
                @endif
            </div>
            @php($overallRating = getOverallRating($product->reviews))
            <div class="single-product-details">
                @if ($overallRating[0] != 0)
                    <div class="rating-show justify-content-between text-center">
                        {{-- <span class="d-inline-block font-size-sm text-body">
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
                        </span> --}}
                    </div>
                @endif
                <div class="home-item-title">
                    <a href="{{ route('product', $product->slug) }}">
                        {{ Str::limit($product['name'], 23) }}
                    </a>
                </div>
                <!--<p class="m-0 py-1 productsize">-->
                <!--    500g Pack-->
                <!--</p>-->
                <div class="justify-content-between">
                    <div class="product-price d-flex flex-wrap align-items-center gap-8">
                        <span class="actual-product-price">
                            {{ webCurrencyConverter(
                                amount: $product->unit_price - getProductDiscount(product: $product, price: $product->unit_price),
                            ) }}
                        </span>
                        @if ($product->discount > 0)
                            <del class="discount-product-price">
                                {{ webCurrencyConverter(amount: $product->unit_price) }}
                            </del>
                        @endif
                    </div>
                </div>
                <form id="add-to-cart-form" class="mb-2">
                    @csrf
                    <input type="hidden" name="id" value="{{ $product->id }}">
                    <div>
                        <div class="d-none">
                            <div
                                class="d-flex justify-content-center align-items-center quantity-box border rounded border-base web-text-primary">
                                <span class="input-group-btn">
                                    <button class="btn btn-number __p-10 web-text-primary" type="button"
                                        data-type="minus" data-field="quantity" disabled="disabled">
                                        -
                                    </button>
                                </span>
                                <input type="text" name="quantity"
                                    class="form-control input-number text-center cart-qty-field __inline-29 border-0 "
                                    placeholder="{{ translate('1') }}" value="{{ $product->minimum_order_qty ?? 1 }}"
                                    data-producttype="{{ $product->product_type }}"
                                    min="{{ $product->minimum_order_qty ?? 1 }}"
                                    max="{{ $product['product_type'] == 'physical' ? $product->current_stock : 100 }}">
                                <span class="input-group-btn">
                                    <button class="btn btn-number __p-10 web-text-primary" type="button"
                                        data-producttype="{{ $product->product_type }}" data-type="plus"
                                        data-field="quantity">
                                        +
                                    </button>
                                </span>
                            </div>
                        </div>
                    </div>
                    <input type="hidden" class="product-generated-variation-code" name="product_variation_code">
                    <input type="hidden" value="" class="in_cart_key form-control w-50" name="key">
                    <div class="product __btn-grp mt-2 mb-3 d-sm-flex">
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
                            <button class="btn add-to-cart" {{-- <button class="btn add-to-cart text-white d-flex align-items-center string-limit" --}} type="button" disabled>
                                Add To Cart
                                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                            </button>
                        @else
                            @if (isset($cartItems[$product->id]))
                                <div class="quantity-wrapper d-flex align-items-center"
                                    style="height: 38px; padding: 0.2rem 0.4rem; gap: 4px; border: 1px solid #ced4da; border-radius: 0.25rem;"
                                    data-id="{{ $product->id }}">

                                    <button type="button" class="btn btn-secondary btn-sm remove-item-btn"
                                        style="display: {{ $cartItems[$product->id]->quantity == 1 ?: 'none' }};"
                                        data-id="{{ $product->id }}">
                                        <i class="fa fa-trash text-danger"></i>
                                    </button>

                                    <button type="button" class="btn btn-secondary btn-sm decrement-btn"
                                        style="display: {{ $cartItems[$product->id]->quantity > 1 ? 'block' : 'none' }};"
                                        data-id="{{ $product->id }}">
                                        <i class="fa fa-minus text-danger"></i>
                                    </button>

                                    <input type="number" min="1"
                                        class="form-control cart-quantity-input text-center"
                                        style="width: 50px; height: 100%;"
                                        value="{{ $cartItems[$product->id]->quantity }}" readonly>

                                    <button type="button" class="btn btn-secondary btn-sm increment-btn"
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
                            {{-- <button type="button" class="btn add-to-cart"
                                data-id="{{ $product->id }}">
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
                                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                        </button> --}}
                        <div class="cart-controls m-auto text-center" style="display: none; ">
                            <button type="button" class="btn quantity-control decrease-btn ">-</button>
                            <span class="quantity-display" style="font-weight: 600;">1</span>
                            <button type="button" class="btn quantity-control increase-btn ">+</button>
                        </div>
                    </div>
                </form>
                {{-- <button class="btn add-to-cart text-white d-flex align-items-center">
                    Add To Cart
                    <img src="{{ asset('public/assets/front-end/img/icons/cart.png') }}" alt="cart">
                </button> --}}
            </div>
        </div>
    </div>
@endif

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
