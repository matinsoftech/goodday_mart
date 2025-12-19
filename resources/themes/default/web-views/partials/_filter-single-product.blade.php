<!-- Meta CSRF Token -->
<meta name="csrf-token" content="{{ csrf_token() }}">
<style>
    .btn-grp-container {
        display: flex;
        flex-wrap: wrap;
        gap: 10px;
    }

    .btn-grp-container .btn {
        flex: 1;
    }

    .quantity-box {
        padding: 0 !important;
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

    .wishlist-btn:not(.activeheart) i {
        font-size: 18px;
        color: #28a745;
    }

    .wishlist-btn:hover {
        transform: scale(1.05);
    }

    .wishlist-btn.activeheart {
        background-color: #28a745;
    }

    .wishlist-btn.activeheart i {
        font-size: 17px;
        color: #ffffff;
    }
</style>
@php
    $wishlistStatus = \App\Models\Wishlist::where([
        'product_id' => $product->id,
        'customer_id' => auth('customer')->id() ?? 0,
    ])->exists();
@endphp
<div class="product-single-hover">
    <div class="search-product-image">
        <div class="wishlist-btn-container">
            <button type="button"
                class="wishlist-btn product-action-add-wishlist-single {{ $wishlistStatus ? 'activeheart' : '' }}"
                data-product-id="{{ $product->id }}">
                <i class="fa {{ $wishlistStatus ? 'fa-heart' : 'fa-heart-o' }}"></i>
            </button>
        </div>
        @if ($product->discount > 0)
            <span class="for-discount-value p-1 pl-2 pr-2 font-bold fs-13">
                <span class="direction-ltr d-block">
                    @if ($product->discount_type == 'percent')
                        {{ round($product->discount, !empty($decimal_point_settings) ? $decimal_point_settings : 0) }}%
                        <p class="m-0">Off</p>
                    @elseif($product->discount_type == 'flat')
                        {{ webCurrencyConverter(amount: $product->discount) }}
                        <p class="m-0">Off</p>
                    @endif
                </span>
            </span>
        @endif
        <a href="{{ route('product', $product->slug) }}" class="w-100">
            <img alt=""
                src="{{ getValidImage(path: 'storage/app/public/product/thumbnail/' . $product['thumbnail'], type: 'product') }}">
        </a>
        @if ($product->product_type == 'physical' && $product->current_stock <= 0)
            <span class="out_fo_stock">{{ translate('out_of_stock') }}</span>
        @endif
    </div>
    <div class="search-product-details">
        <form method="POST" class="product __btn-grp mt-2 mb-3">
            @csrf
            <input type="hidden" name="id" value="{{ $product->id }}">
            <div class="single-product-details p-0">
                @php($overallRating = getOverallRating($product->reviews))
                @if ($overallRating[0] != 0)
                    <div class="rating-show justify-content-between">
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
                            <label class="badge-style review-text-container"> {{ count($product->reviews) }}
                                <span class="review-text">reviews</span>
                            </label>
                        </span>
                    </div>
                @endif
                <div class="product-item_container">
                    <a class="mb-1" href="{{ route('product', $product->slug) }}">
                        {{ Str::limit($product['name'], 23) }}
                    </a>

                </div>
                <!-- Color Variation -->
                <div>
                    @if (!empty($product->colors) && count(json_decode($product->colors)) > 0)
                        <div class="flex-start align-items-center">
                            <div class="w-100">
                                <ul class="list-inline checkbox-color product-search-page mb-0 flex-start ps-0">
                                    @foreach (json_decode($product->colors) as $key => $color)
                                        <li>
                                            <label style="background: {{ $color }};"
                                                class="focus-preview-image-by-color shadow-border"
                                                for="{{ $product->id }}-color-{{ str_replace('#', '', $color) }}"
                                                data-toggle="tooltip" data-key="{{ str_replace('#', '', $color) }}"
                                                data-colorid="preview-box-{{ str_replace('#', '', $color) }}">
                                                <span class="outline"></span></label>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    @endif
                </div>
                <!-- Color Variation Ends -->
                <div class="justify-content-between">
                    <div class="product-price d-flex flex-wrap align-items-center gap-8">
                        <span class="actual-product-price">
                            {{ webCurrencyConverter(
                                amount: $product->unit_price - getProductDiscount(product: $product, price: $product->unit_price),
                            ) }}
                            @if ($product->discount > 0)
                                <del class="discount-product-price">
                                    {{ webCurrencyConverter(amount: $product->unit_price) }}
                                </del>
                                <br>
                            @endif
                        </span>
                    </div>
                </div>
                <div class="product __btn-grp mt-2 mb-3">
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
                        <button class="btn add-to-cart" {{-- <button
                                class="btn add-to-cart d-flex align-items-center string-limit" --}} type="button" disabled>
                            Add To Cart
                            <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                        </button>
                    @else
                        @if (isset($cartItems[$product->id]))
                            <div class="quantity-wrapper d-flex gap-1 align-items-center justify-content-center"
                                data-id="{{ $product->id }}">
                                <!-- Remove button (shows when quantity is 1) -->
                                <button type="button" class="btn btn-outline-danger btn-sm remove-item-btn"
                                    style="display: {{ $cartItems[$product->id]->quantity == 1 ? 'inline-block' : 'none' }};"
                                    data-id="{{ $product->id }}" title="Remove from cart">
                                    <i class="fa fa-trash"></i>
                                </button>

                                <!-- Decrease button (shows when quantity > 1) -->
                                <button type="button" class="btn btn-outline-secondary btn-sm decrement-btn"
                                    style="display: {{ $cartItems[$product->id]->quantity > 1 ? 'inline-block' : 'none' }};"
                                    data-id="{{ $product->id }}" title="Decrease quantity">
                                    <i class="fa fa-minus"></i>
                                </button>

                                <!-- Quantity display -->
                                <span class="quantity-display mx-2 px-2 py-1 bg-light rounded text-center"
                                    style="min-width: 40px; font-weight: 600;">
                                    {{ $cartItems[$product->id]->quantity }}
                                </span>

                                <!-- Increase button -->
                                <button type="button" class="btn btn-outline-success btn-sm increment-btn"
                                    data-id="{{ $product->id }}" title="Increase quantity">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        @else
                            <button type="button" class="btn btn-primary add-to-cart" data-id="{{ $product->id }}">
                                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                Add To Cart
                            </button>
                        @endif

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

                    <input type="number" class="cart-qty-field d-none" min="1" value="1" />
                    <div class="cart-controls m-auto text-center" style="display: none; ">
                        <button type="button" class="btn quantity-control decrease-btn ">-</button>
                        <span class="quantity-display" style="font-weight: 600;">1</span>
                        <button type="button" class="btn quantity-control increase-btn ">+</button>
                    </div>
                </div>
            </div>
            <input type="hidden" class="product-generated-variation-code" name="product_variation_code">
            <input type="hidden" value="" class="in_cart_key form-control w-50" name="key">
        </form>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<!-- Your custom script here -->


<script>
    // Handle dropdown item click
    document.querySelectorAll('.dropdown-item').forEach(function(item) {
        item.addEventListener('click', function(e) {
            e.stopImmediatePropagation();
            window.location.href = this.href;
        });
    });
</script>
<script>
    $(document).ready(function() {
        console.log("?? Document ready, script running.");
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        // $('.add-to-cart').on('click', function(e) {
        $(document).on('click', '.add-to-cart', function(e) {
            e.preventDefault();
            console.log("?? Add to cart clicked");
            var button = $(this);
            var form = button.closest('form');
            var productId = form.find('input[name="id"]').val();
            var quantity = parseInt(form.find('.cart-qty-field').val(), 10) || 1;
            $.ajax({
                url: "{{ route('cart.add') }}",
                type: 'POST',
                dataType: 'json',
                data: {
                    id: productId,
                    quantity: quantity
                },
                beforeSend: function() {
                    button.prop('disabled', true);
                    button.html('<i class="fa fa-spinner fa-spin"></i> Adding...');
                },
                success: function(response) {
                    console.log("? SUCCESS BLOCK TRIGGERED:", response);
                    if (response && response.status === 1) {
                        toastr.success(response.message || 'Product added to cart!');
                        setTimeout(() => location.reload(), 1500);
                    } else {
                        toastr.error(response.message || 'Failed to add product.');
                    }
                },
                error: function(xhr) {
                    console.log("? ERROR BLOCK TRIGGERED:", xhr);
                    toastr.error('An error occurred. Please try again.');
                },
                complete: function() {
                    button.prop('disabled', false);
                    button.html('Add To Cart <i class="fa fa-shopping-cart"></i>');
                }
            });
        });
    });
</script>


<script>
    $(document).ready(function() {
        const csrfToken = $('meta[name="csrf-token"]').attr('content');

        // Function to bind quantity controls for a given wrapper
        function bindQuantityControls(wrapper) {
            const productId = wrapper.data('id');
            const quantityDisplay = wrapper.find('.quantity-display');
            const btnMinus = wrapper.find('.decrement-btn');
            const btnPlus = wrapper.find('.increment-btn');
            const btnRemove = wrapper.find('.remove-item-btn');

            // Increase quantity
            btnPlus.off('click').on('click', function(e) {
                e.preventDefault();
                const button = $(this);
                button.prop('disabled', true);

                let currentQty = parseInt(quantityDisplay.text());
                let newQty = currentQty + 1;

                $.ajax({
                    url: "{{ route('cart.update-cart-quantity') }}",
                    type: 'POST',
                    data: {
                        _token: csrfToken,
                        product_id: productId,
                        quantity: newQty
                    },
                    success: function(data) {
                        console.log('Quantity increased:', data);

                        // Update display
                        quantityDisplay.text(newQty);

                        // Show/hide appropriate buttons
                        if (newQty > 1) {
                            btnMinus.show();
                            btnRemove.hide();
                        }

                        // Show success message
                        toastr.success('Quantity updated!');
                    },
                    error: function(xhr) {
                        console.error('Increase error:', xhr.responseText);
                        toastr.error('Failed to update quantity');
                    },
                    complete: function() {
                        button.prop('disabled', false);
                    }
                });
            });

            // Decrease quantity
            btnMinus.off('click').on('click', function(e) {
                e.preventDefault();
                const button = $(this);
                button.prop('disabled', true);

                let currentQty = parseInt(quantityDisplay.text());

                if (currentQty > 1) {
                    let newQty = currentQty - 1;

                    $.ajax({
                        url: "{{ route('cart.update-cart-quantity') }}",
                        type: 'POST',
                        data: {
                            _token: csrfToken,
                            product_id: productId,
                            quantity: newQty
                        },
                        success: function(data) {
                            console.log('Quantity decreased:', data);

                            // Update display
                            quantityDisplay.text(newQty);

                            // Show/hide appropriate buttons
                            if (newQty === 1) {
                                btnMinus.hide();
                                btnRemove.show();
                            }

                            toastr.success('Quantity updated!');
                        },
                        error: function(xhr) {
                            console.error('Decrease error:', xhr.responseText);
                            toastr.error('Failed to update quantity');
                        },
                        complete: function() {
                            button.prop('disabled', false);
                        }
                    });
                }
            });

            // Remove item completely
            btnRemove.off('click').on('click', function(e) {
                e.preventDefault();
                const button = $(this);
                button.prop('disabled', true);

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
                            // Replace with add to cart button
                            const addToCartBtn = `
                            <button type="button" class="btn btn-primary add-to-cart" data-id="${productId}">
                                Add To Cart
                                <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                            </button>
                        `;
                            wrapper.replaceWith(addToCartBtn);
                            toastr.success('Item removed from cart!');

                            // Re-bind add to cart functionality for the new button
                            bindAddToCart();
                        }
                    },
                    error: function(xhr) {
                        console.error('Remove error:', xhr.responseText);
                        toastr.error('Failed to remove item');
                        button.prop('disabled', false);
                    }
                });
            });
        }

        // Function to bind add to cart functionality
        function bindAddToCart() {
            $('.add-to-cart').off('click').on('click', function(e) {
                e.preventDefault();
                console.log("Add to cart clicked");

                const button = $(this);
                const form = button.closest('form');
                const productId = button.data('id') || form.find('input[name="id"]').val();
                const quantity = parseInt(form.find('.cart-qty-field').val(), 10) || 1;

                $.ajax({
                    url: "{{ route('cart.add') }}",
                    type: 'POST',
                    dataType: 'json',
                    data: {
                        _token: csrfToken,
                        id: productId,
                        quantity: quantity
                    },
                    beforeSend: function() {
                        button.prop('disabled', true);
                        button.html('<i class="fa fa-spinner fa-spin"></i> Adding...');
                    },
                    success: function(response) {
                        console.log("SUCCESS:", response);
                        if (response && response.status === 1) {
                            toastr.success(response.message || 'Product added to cart!');

                            // Replace add to cart button with quantity controls
                            const quantityControls = `
                            <div class="quantity-wrapper d-flex gap-1 align-items-center justify-content-center" data-id="${productId}">
                                <button type="button" class="btn btn-outline-danger btn-sm remove-item-btn"
                                    data-id="${productId}" title="Remove from cart">
                                    <i class="fa fa-trash"></i>
                                </button>
                                <button type="button" class="btn btn-outline-secondary btn-sm decrement-btn"
                                    style="display: none;" data-id="${productId}" title="Decrease quantity">
                                    <i class="fa fa-minus"></i>
                                </button>
                                <span class="quantity-display mx-2 px-2 py-1 bg-light rounded text-center" style="min-width: 40px; font-weight: 600;">1</span>
                                <button type="button" class="btn btn-outline-success btn-sm increment-btn"
                                    data-id="${productId}" title="Increase quantity">
                                    <i class="fa fa-plus"></i>
                                </button>
                            </div>
                        `;

                            button.replaceWith(quantityControls);

                            // Bind controls to the new quantity wrapper
                            const newWrapper = $(
                                `.quantity-wrapper[data-id="${productId}"]`);
                            bindQuantityControls(newWrapper);

                        } else {
                            toastr.error(response.message || 'Failed to add product.');
                        }
                    },
                    error: function(xhr) {
                        console.log("ERROR:", xhr);
                        toastr.error('An error occurred. Please try again.');
                    },
                    complete: function() {
                        if (!button.hasClass('replaced')) {
                            button.prop('disabled', false);
                            button.html('Add To Cart <i class="fa fa-shopping-cart"></i>');
                        }
                    }
                });
            });
        }

        // Initial binding for existing quantity wrappers
        $('.quantity-wrapper').each(function() {
            bindQuantityControls($(this));
        });

        // Initial binding for add to cart buttons
        bindAddToCart();
    });
</script>



<!-- Optional: Add some CSS for better styling -->
<style>
    .quantity-wrapper {
        border: 1px solid #dee2e6;
        border-radius: 0.375rem;
        padding: 0.25rem;
        background: #f8f9fa;
    }

    .quantity-wrapper .btn {
        border: none !important;
        padding: 0.25rem 0.5rem;
    }

    .quantity-wrapper .btn:hover {
        transform: scale(1.05);
    }

    .quantity-display {
        user-select: none;
        font-size: 0.875rem;
    }

    .btn:disabled {
        opacity: 0.6;
        cursor: not-allowed;
    }
</style>
