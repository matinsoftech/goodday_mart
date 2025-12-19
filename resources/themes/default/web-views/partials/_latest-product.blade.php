<section class="container">
    <div class="col-xl-12 col-md-12">
        <div>
            <div class="d-flex justify-content-between align-items-center mb-4 pb-2 home-title-border">
                <div class="home-title">
                    <span class="barlow-bold">{{ translate('latest_products') }}</span>
                </div>
                <div class="mr-1">
                    <a class="text-capitalize view-all-text web-text-primary d-flex align-items-center gap-3"
                        href="{{ route('products', ['data_from' => 'latest']) }}">
                        {{ translate('view_all') }}
                        <svg width="1.2rem" clip-rule="evenodd" fill-rule="evenodd" stroke-linejoin="round"
                            stroke-miterlimit="2" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path
                                d="m12.007 2c-5.518 0-9.998 4.48-9.998 9.998 0 5.517 4.48 9.997 9.998 9.997s9.998-4.48 9.998-9.997c0-5.518-4.48-9.998-9.998-9.998zm1.523 6.21s1.502 1.505 3.255 3.259c.147.147.22.339.22.531s-.073.383-.22.53c-1.753 1.754-3.254 3.258-3.254 3.258-.145.145-.335.217-.526.217-.192-.001-.384-.074-.531-.221-.292-.293-.294-.766-.003-1.057l1.977-1.977h-6.693c-.414 0-.75-.336-.75-.75s.336-.75.75-.75h6.693l-1.978-1.979c-.29-.289-.287-.762.006-1.054.147-.147.339-.221.53-.222.19 0 .38.071.524.215z"
                                fill-rule="nonzero" />
                        </svg>
                    </a>
                </div>
            </div>

            <div class="row">
                @foreach ($latest_products as $product)
                    @php
                        $wishlistStatus = \App\Models\Wishlist::where([
                            'product_id' => $product->id,
                            'customer_id' => auth('customer')->id() ?? 0,
                        ])->exists();
                        $cartItem = $cartItems[$product->id] ?? null;
                        $cartQty = $cartItem->quantity ?? 0;
                        $cartId = $cartItem->id ?? '';
                    @endphp

                    <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6 col-6 mb-2">
                        <div class="product-single-hover product-card-slider">
                            <div class="overflow-hidden position-relative w-100">
                                <div class="inline_product clickable d-flex justify-content-center">
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
                                                    @else
                                                        -{{ webCurrencyConverter(amount: $product->discount) }}
                                                    @endif
                                                </span>
                                            </span>
                                        </div>
                                    @endif

                                    <div class="pb-0 ">
                                        <a class="best-selleing-image" href="{{ route('product', $product->slug) }}">
                                            <img alt=""
                                                src="{{ getValidImage('storage/app/public/product/thumbnail/' . $product['thumbnail'], 'product') }}">
                                        </a>
                                    </div>

                                    @if ($product->product_type == 'physical' && $product->current_stock <= 0)
                                        <span class="out_of_stock">{{ translate('out_of_stock') }}</span>
                                    @endif
                                </div>

                                <div class="single-product-details">
                                    <div class="home-item-title">
                                        <a href="{{ route('product', $product->slug) }}">
                                            {{ Str::limit($product['name'], 23) }}
                                        </a>
                                    </div>

                                    <div class="justify-content-between">
                                        <div class="product-price d-flex flex-wrap align-items-center gap-8">
                                            <span class="actual-product-price">
                                                {{ webCurrencyConverter(amount: $product->unit_price - getProductDiscount(product: $product, price: $product->unit_price)) }}
                                            </span>
                                            @if ($product->discount > 0)
                                                <del class="discount-product-price">
                                                    {{ webCurrencyConverter(amount: $product->unit_price) }}
                                                </del>
                                            @endif
                                        </div>
                                    </div>

                                    {{-- Cart Controls --}}
                                    <form class="mb-2" id="add-to-cart-form-{{ $product->id }}">
                                        @csrf
                                        <input type="hidden" name="id" value="{{ $product->id }}">

                                        <div class="quantity-wrapper align-items-center justify-content-center {{ $cartQty > 0 ? 'd-flex' : 'd-none' }}"
                                            style="height: 38px; padding: 0.2rem 0.4rem; gap: 4px;  border-radius: 0.25rem;"
                                            data-id="{{ $product->id }}">

                                            {{-- Remove --}}
                                            {{-- <button type="button"
                                                class="btn btn-sm remove-item-btn {{ $cartQty == 1 ? '' : 'd-none' }}"
                                                data-cart-id="{{ $cartId }}"
                                                data-product-id="{{ $product->id }}">
                                                <i class="fa fa-trash text-danger"></i>
                                            </button> --}}
                                            <button type="button"
                                                class="btn btn-outline-danger btn-sm remove-item-btn d-flex align-items-center gap-2 px-3 py-1"
                                                data-cart-id="{{ $cartId }}"
                                                data-product-id="{{ $product->id }}">
                                                <i class="fa fa-trash"></i>
                                                <span>Remove from Cart</span>
                                            </button>


                                            {{-- Decrement --}}
                                            {{-- <button type="button"
                                                class="btn btn-sm decrement-btn action-update-cart-quantity {{ $cartQty > 1 ? '' : 'd-none' }}"
                                                data-cart-id="{{ $cartId }}"
                                                data-product-id="{{ $product->id }}">
                                                <i class="fa fa-minus text-danger"></i>
                                            </button> --}}

                                            {{-- Quantity --}}
                                            {{-- <input type="number" min="1"
                                                class="form-control cart-quantity-input text-center cartQuantity{{ $cartId }}"
                                                style="width: 50px; height: 100%;"
                                                value="{{ $cartQty > 0 ? $cartQty : 1 }}" readonly
                                                data-cart-id="{{ $cartId }}"
                                                data-producttype="{{ $product->id }}"
                                                data-cart-quantity="{{ $cartQty > 0 ? $cartQty : 1 }}"> --}}

                                            {{-- Increment --}}
                                            {{-- <button type="button"
                                                class="btn btn-sm increment-btn action-update-cart-quantity"
                                                data-cart-id="{{ $cartId }}"
                                                data-product-id="{{ $product->id }}">
                                                <i class="fa fa-plus text-success"></i>
                                            </button> --}}
                                        </div>

                                        {{-- Add To Cart button --}}
                                        <button type="button"
                                            class="btn btn-primary add-to-cart align-items-center {{ $cartQty > 0 ? 'd-none' : 'd-flex' }}"
                                            data-id="{{ $product->id }}">
                                            Add To Cart
                                            <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                        </button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</section>

<style>
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

    .remove-item-btn {
        border-radius: 0.25rem;
        transition: all 0.3s ease;
        font-weight: 500;
    }

    .remove-item-btn i {
        font-size: 16px;
    }

    .remove-item-btn:hover {
        background-color: #dc3545;
        color: #fff;
        transform: scale(1.05);
    }
</style>
