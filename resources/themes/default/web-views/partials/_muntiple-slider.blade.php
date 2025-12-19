<style>
    .tablink {
        padding: 10px 20px;
        background-color: #f1f1f1;
        border: none;
        cursor: pointer;
        margin-right: 5px;
        font-weight: 600;
        font-size: 15px;
    }

    .tablink.active {
        background-color: #4CAF50;
        color: white;
    }

    .tabs {
        margin-bottom: 20px;
    }

    .muntiple-product-carosel {
        display: none !important;
    }

    .muntiple-product-carosel.active {
        display: block !important;
    }
</style>

<div class="tabs text-center">
    <button class="tablink active" onclick="showCarousel('featured')">Featured</button>
    <button class="tablink" onclick="showCarousel('best-selling')">Best Sellers</button>
    <button class="tablink" onclick="showCarousel('popular')">Popular</button>
</div>

<!-- Featured Products -->
<div class="carousel-wrap p-1 owl-carousel owl-theme muntiple-product-carosel active" id="featured-products-list">
    {{-- @php $productsFound = false; @endphp --}}

    @foreach ($featured_products as $product)
        @if ($product->current_stock > 0)
            {{-- @php $productsFound = true; @endphp --}}
            @php
                $wishlistStatus = \App\Models\Wishlist::where([
                    'product_id' => $product->id,
                    'customer_id' => auth('customer')->id() ?? 0,
                ])->exists();
            @endphp
            <div>
                {{-- @php($overallRating = getOverallRating($product->reviews)) @endphp --}}
                <div class="product-single-hover shadow-none rtl">
                    <div class="overflow-hidden position-relative">
                        <div class="wishlist-btn-container">
                            <div class="wishlist-btn-container">
                                <button type="button"
                                    class="wishlist-btn product-action-add-wishlist-single {{ $wishlistStatus ? 'activeheart' : '' }}"
                                    data-product-id="{{ $product->id }}">
                                    <i class="fa {{ $wishlistStatus ? 'fa-heart' : 'fa-heart-o' }}"></i>
                                </button>
                            </div>
                        </div>
                        <div class="inline_product clickable">
                            @if ($product->discount > 0)
                                <span class="for-discount-value p-1 pl-2 pr-2 font-bold fs-13">
                                    <span class="direction-ltr d-block">
                                        @if ($product->discount_type == 'percent')
                                            -{{ round($product->discount, !empty($decimal_point_settings) ? $decimal_point_settings : 0) }}%
                                            OFF
                                        @elseif($product->discount_type == 'flat')
                                            -{{ webCurrencyConverter(amount: $product->discount) }} OFF
                                        @endif
                                    </span>
                                </span>
                            @else
                                <span class="for-discount-value-null"></span>
                            @endif
                            <a href="{{ route('product', $product->slug) }}">
                                <img src="{{ getValidImage(path: 'storage/app/public/product/thumbnail/' . $product['thumbnail'], type: 'product') }}"
                                    alt="">
                            </a>
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
                        <div class="single-product-details">
                            <div>
                                <a href="{{ route('product', $product->slug) }}"
                                    class="text-capitalize fw-semibold font-15">
                                    {{ Str::limit($product['name'], 23) }}
                                </a>
                            </div>
                            <div class="justify-content-between">
                                <div class="product-price">
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
                            {{-- @if ($overallRating[0] != 0)
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
                                        <label class="badge-style">( {{ count($product->reviews) }} Reviews)</label>
                                    </span>
                                </div>
                            @endif --}}
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
                                            placeholder="{{ translate('1') }}"
                                            value="{{ $product->minimum_order_qty ?? 1 }}"
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
                            <input type="hidden" class="product-generated-variation-code"
                                name="product_variation_code">
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
        @endif
    @endforeach
</div>
<!-- Best Selling Products -->
<div class="carousel-wrap p-1 owl-carousel owl-theme muntiple-product-carosel" id="best-selling-slider">
    @foreach ($bestSellProduct as $key => $bestSell)
        @if ($bestSell->product != null && $key < 6 && $bestSell->product->current_stock > 0)
            @php
                $wishlistStatus = \App\Models\Wishlist::where([
                    'product_id' => $bestSell->product->id,
                    'customer_id' => auth('customer')->id() ?? 0,
                ])->exists();
            @endphp
            <div>
                <div class="product-single-hover shadow-none rtl">
                    <div class="overflow-hidden position-relative">
                        <div class="wishlist-btn-container">
                            <div class="wishlist-btn-container">
                                <button type="button"
                                    class="wishlist-btn product-action-add-wishlist-single {{ $wishlistStatus ? 'activeheart' : '' }}"
                                    data-product-id="{{ $bestSell->product->id }}">
                                    <i class="fa {{ $wishlistStatus ? 'fa-heart' : 'fa-heart-o' }}"></i>
                                </button>
                            </div>
                        </div>
                        <div class="inline_product clickable">
                            @if ($bestSell->product->discount > 0)
                                <span class="for-discount-value p-1 pl-2 pr-2 font-bold fs-13">
                                    <span class="direction-ltr d-block">
                                        @if ($bestSell->product->discount_type == 'percent')
                                            -{{ round($bestSell->product->discount, !empty($decimalPointSettings) ? $decimalPointSettings : 0) }}%
                                            OFF
                                        @elseif($bestSell->product->discount_type == 'flat')
                                            -{{ webCurrencyConverter(amount: $bestSell->product->discount) }} OFF
                                        @endif
                                    </span>
                                </span>
                            @else
                                <span class="for-discount-value-null"></span>
                            @endif
                            <a href="{{ route('product', $bestSell->product->slug) }}">
                                <img src="{{ getValidImage(path: 'storage/app/public/product/thumbnail/' . $bestSell->product['thumbnail'], type: 'product') }}"
                                    alt="">
                            </a>
                            @if ($bestSell->product->product_type == 'physical' && $bestSell->product->current_stock <= 0)
                                <span class="out_fo_stock">{{ translate('out_of_stock') }}</span>
                            @endif
                        </div>
                        <div class="single-product-details">
                            <div>
                                <a href="{{ route('product', $bestSell->product->slug) }}"
                                    class="text-capitalize fw-semibold font-15">
                                    {{ Str::limit($bestSell->product['name'], 23) }}
                                </a>
                            </div>
                            <div class="justify-content-between">
                                <div class="product-price">
                                    @if ($bestSell->product->discount > 0)
                                        <del class="category-single-product-price">
                                            {{ webCurrencyConverter(amount: $bestSell->product->unit_price) }}
                                        </del>
                                    @endif
                                    <span class="text-accent text-dark">
                                        {{ webCurrencyConverter(
                                            amount: $bestSell->product->unit_price -
                                                getProductDiscount(product: $bestSell->product, price: $bestSell->product->unit_price),
                                        ) }}
                                    </span>
                                </div>
                            </div>
                        </div>
                        <form id="add-to-cart-form" class="mb-2">
                            @csrf
                            <input type="hidden" name="id" value="{{ $bestSell->product->id }}">
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
                                            placeholder="{{ translate('1') }}"
                                            value="{{ $bestSell->product->minimum_order_qty ?? 1 }}"
                                            data-producttype="{{ $bestSell->product->product_type }}"
                                            min="{{ $bestSell->product->minimum_order_qty ?? 1 }}"
                                            max="{{ $bestSell->product['product_type'] == 'physical' ? $bestSell->product->current_stock : 100 }}">
                                        <span class="input-group-btn">
                                            <button class="btn btn-number __p-10 web-text-primary" type="button"
                                                data-producttype="{{ $bestSell->product->product_type }}"
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
                            <div class="product __btn-grp mt-2 mb-3 mx-2 d-sm-flex">
                                @if (
                                    ($bestSell->product->added_by == 'seller' &&
                                        ($sellerTemporaryClose ||
                                            (isset($bestSell->product->seller->shop) &&
                                                $bestSell->product->seller->shop->vacation_status &&
                                                $currentDate >= $sellerVacationStartDate &&
                                                $currentDate <= $sellerVacationEndDate))) ||
                                        ($bestSell->product->added_by == 'admin' &&
                                            ($inHouseTemporaryClose ||
                                                ($inHouseVacationStatus &&
                                                    $currentDate >= $inHouseVacationStartDate &&
                                                    $currentDate <= $inHouseVacationEndDate))))
                                    <button class="btn add-to-cart " type="button" disabled>
                                        Add To Carts
                                        <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                    </button>
                                @else
                                    @if (isset($cartItems[$bestSell->product->id]))
                                        <div class="quantity-wrapper d-flex align-items-center"
                                            style="height: 38px; padding: 0.2rem 0.4rem; gap: 4px; border: 1px solid #ced4da; border-radius: 0.25rem;"
                                            data-id="{{ $bestSell->product->id }}">

                                            <button type="button" class="btn btn-sm remove-item-btn"
                                                style="display: {{ $cartItems[$bestSell->product->id]->quantity == 1 ?: 'none' }};"
                                                data-id="{{ $bestSell->product->id }}">
                                                <i class="fa fa-trash text-danger"></i>
                                            </button>

                                            <button type="button" class="btn btn-sm decrement-btn"
                                                style="display: {{ $cartItems[$bestSell->product->id]->quantity > 1 ? 'block' : 'none' }};"
                                                data-id="{{ $bestSell->product->id }}">
                                                <i class="fa fa-minus text-danger"></i>
                                            </button>

                                            <input type="number" min="1"
                                                class="form-control cart-quantity-input text-center"
                                                style="width: 50px; height: 100%;"
                                                value="{{ $cartItems[$bestSell->product->id]->quantity }}" readonly>

                                            <button type="button" class="btn btn-sm increment-btn"
                                                data-id="{{ $bestSell->product->id }}">
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
                                @endif
                                @if (
                                    ($bestSell->product->added_by == 'seller' &&
                                        ($sellerTemporaryClose ||
                                            (isset($bestSell->product->seller->shop) &&
                                                $bestSell->product->seller->shop->vacation_status &&
                                                $currentDate >= $sellerVacationStartDate &&
                                                $currentDate <= $sellerVacationEndDate))) ||
                                        ($bestSell->product->added_by == 'admin' &&
                                            ($inHouseTemporaryClose ||
                                                ($inHouseVacationStatus &&
                                                    $currentDate >= $inHouseVacationStartDate &&
                                                    $currentDate <= $inHouseVacationEndDate))))
                                    <div class="alert alert-danger" role="alert">
                                        {{ translate('this_shop_is_temporary_closed_or_on_vacation._You_cannot_add_product_to_cart_from_this_shop_for_now') }}
                                    </div>
                                @endif
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
        @endif
    @endforeach
</div>
<!-- Popular Products -->
<div class="carousel-wrap p-1 owl-carousel owl-theme muntiple-product-carosel" id="latest-slider">
    @foreach ($latest_products as $product)
        @if ($product->current_stock > 0)
            @php
                $wishlistStatus = \App\Models\Wishlist::where([
                    'product_id' => $product->id,
                    'customer_id' => auth('customer')->id() ?? 0,
                ])->exists();
            @endphp
            <div>
                <div class="product-single-hover shadow-none rtl">
                    <div class="overflow-hidden position-relative">
                        <div class="wishlist-btn-container">
                            <div class="wishlist-btn-container">
                                <button type="button"
                                    class="wishlist-btn product-action-add-wishlist-single {{ $wishlistStatus ? 'activeheart' : '' }}"
                                    data-product-id="{{ $product->id }}">
                                    <i class="fa {{ $wishlistStatus ? 'fa-heart' : 'fa-heart-o' }}"></i>
                                </button>
                            </div>
                        </div>
                        <div class="inline_product clickable">
                            @if ($product->discount > 0)
                                <span class="for-discount-value p-1 pl-2 pr-2 font-bold fs-13">
                                    <span class="direction-ltr d-block">
                                        @if ($product->discount_type == 'percent')
                                            -{{ round($product->discount, !empty($decimal_point_settings) ? $decimal_point_settings : 0) }}%
                                            OFF
                                        @elseif($product->discount_type == 'flat')
                                            -{{ webCurrencyConverter(amount: $product->discount) }} OFF
                                        @endif
                                    </span>
                                </span>
                            @else
                                <span class="for-discount-value-null"></span>
                            @endif
                            <a href="{{ route('product', $product->slug) }}">
                                <img src="{{ getValidImage(path: 'storage/app/public/product/thumbnail/' . $product['thumbnail'], type: 'product') }}"
                                    alt="">
                            </a>
                            @if ($product->product_type == 'physical' && $product->current_stock <= 0)
                                <span class="out_fo_stock">{{ translate('out_of_stock') }}</span>
                            @endif
                        </div>
                        <div class="single-product-details">
                            <div>
                                <a href="{{ route('product', $product->slug) }}"
                                    class="text-capitalize fw-semibold font-15">
                                    {{ Str::limit($product['name'], 23) }}
                                </a>
                            </div>
                            <div class="justify-content-between">
                                <div class="product-price">
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
                                            placeholder="{{ translate('1') }}"
                                            value="{{ $product->minimum_order_qty ?? 1 }}"
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
                            <input type="hidden" class="product-generated-variation-code"
                                name="product_variation_code">
                            <input type="hidden" value="" class="in_cart_key form-control w-50"
                                name="key">
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
                                    <button class="btn add-to-cart " type="button" disabled>
                                        Add To Cart
                                        <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                    </button>
                                @else
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
        @endif
    @endforeach
</div>

{{-- @push('script')
    <script>
        // Function to initialize carousels
        function initializeCarousels() {
            // Destroy existing carousels before re-initializing
            $('.muntiple-product-carosel').each(function() {
                if ($(this).hasClass('owl-loaded')) {
                    $(this).trigger('destroy.owl.carousel');
                    $(this).find('.owl-stage-outer').children().unwrap(); // remove extra wrapper
                }
            });

            // Initialize each carousel separately
            initializeCarousel('featured-products-list');
            initializeCarousel('best-selling-slider');
            initializeCarousel('latest-slider');
        }

        // Function to initialize an individual carousel
        function initializeCarousel(carouselId) {
            const carousel = document.getElementById(carouselId);
            if (!carousel) return;

            const productItems = carousel.querySelectorAll('div > div');
            const seenProducts = new Set(); // Track duplicates only within this carousel
            const filteredItems = [];

            productItems.forEach(item => {
                const wishlistBtn = item.querySelector('.wishlist-btn[data-product-id]');
                if (!wishlistBtn) return;

                const productId = wishlistBtn.getAttribute('data-product-id');

                if (!seenProducts.has(productId)) {
                    seenProducts.add(productId);
                    filteredItems.push(item);
                } else {
                    // Remove duplicate product within this carousel
                    item.remove();
                }
            });

            // If no products remain, show a message
            if (filteredItems.length === 0) {
                const noProductsMessage = document.createElement('div');
                noProductsMessage.className = 'col-12 text-center py-4';
                noProductsMessage.innerHTML = '<p class="text-muted">No products available.</p>';
                carousel.appendChild(noProductsMessage);
                return;
            }

            // Initialize Owl Carousel
            $(carousel).owlCarousel({
                loop: false,
                margin: 10,
                nav: true,
                dots: false,
                autoplay: true,
                autoplayTimeout: 5000,
                autoplayHoverPause: true,
                responsive: {
                    0: {
                        items: 2
                    },
                    576: {
                        items: 2
                    },
                    768: {
                        items: 3
                    },
                    992: {
                        items: 4
                    },
                    1200: {
                        items: 6
                    }
                }
            });
        }

        // Tab switcher function
        function showCarousel(carousel) {
            // Remove active class from all tab links and carousels
            $('.tablink').removeClass('active');
            $('.muntiple-product-carosel').removeClass('active');

            // Show the selected carousel
            switch (carousel) {
                case 'featured':
                    $('#featured-products-list').addClass('active');
                    $('.tablink').filter(function() {
                        return $(this).text() === 'Featured';
                    }).addClass('active');
                    break;
                case 'best-selling':
                    $('#best-selling-slider').addClass('active');
                    $('.tablink').filter(function() {
                        return $(this).text() === 'Best Sellers';
                    }).addClass('active');
                    break;
                case 'popular':
                    $('#latest-slider').addClass('active');
                    $('.tablink').filter(function() {
                        return $(this).text() === 'Popular';
                    }).addClass('active');
                    break;
            }
        }

        // Initialize carousels when DOM is ready
        $(document).ready(function() {
            setTimeout(() => initializeCarousels(), 100);
        });

        // Re-initialize if content is loaded dynamically
        $(document).on('DOMNodeInserted', '.muntiple-product-carosel', function() {
            setTimeout(() => initializeCarousels(), 200);
        });

        $(document).ajaxComplete(function() {
            setTimeout(() => initializeCarousels(), 200);
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
@endpush --}}

{{-- @push('script') --}}
    <script>
        // Initialize all carousels: destroy existing then re-initialize
        function initializeCarousels() {
            $('.muntiple-product-carosel').each(function() {
                if ($(this).hasClass('owl-loaded')) {
                    $(this).trigger('destroy.owl.carousel');
                    $(this).find('.owl-stage-outer').children()
                .unwrap(); // Clean up extra wrappers added by Owl Carousel
                }
            });

            initializeCarousel('featured-products-list');
            initializeCarousel('best-selling-slider');
            initializeCarousel('latest-slider');
        }

        // Initialize individual carousel by ID with duplicate product filtering
        function initializeCarousel(carouselId) {
            const carousel = document.getElementById(carouselId);
            if (!carousel) return;

            // Select potential product items assuming two-level divs: adjust if your structure differs
            const productItems = carousel.querySelectorAll('div > div');
            const seenProducts = new Set();
            const filteredItems = [];

            productItems.forEach(item => {
                const wishlistBtn = item.querySelector('.wishlist-btn[data-product-id]');
                if (!wishlistBtn) return; // skip if no product id

                const productId = wishlistBtn.getAttribute('data-product-id');
                if (!seenProducts.has(productId)) {
                    seenProducts.add(productId);
                    filteredItems.push(item);
                } else {
                    item.remove(); // remove duplicate product item within this carousel
                }
            });

            if (filteredItems.length === 0) {
                const noProductsMessage = document.createElement('div');
                noProductsMessage.className = 'col-12 text-center py-4';
                noProductsMessage.innerHTML = '<p class="text-muted">No products available.</p>';
                carousel.appendChild(noProductsMessage);
                return;
            }

            // Initialize Owl Carousel
            $(carousel).owlCarousel({
                loop: false,
                margin: 10,
                nav: true,
                dots: false,
                autoplay: true,
                autoplayTimeout: 5000,
                autoplayHoverPause: true,
                responsive: {
                    0: {
                        items: 2
                    },
                    576: {
                        items: 2
                    },
                    768: {
                        items: 3
                    },
                    992: {
                        items: 4
                    },
                    1200: {
                        items: 6
                    }
                }
            });
        }

        // Switch visible carousel tab
        function showCarousel(carousel) {
            $('.tablink').removeClass('active');
            $('.muntiple-product-carosel').removeClass('active');

            switch (carousel) {
                case 'featured':
                    $('#featured-products-list').addClass('active');
                    $('.tablink').filter(function() {
                        return $(this).text() === 'Featured';
                    }).addClass('active');
                    break;
                case 'best-selling':
                    $('#best-selling-slider').addClass('active');
                    $('.tablink').filter(function() {
                        return $(this).text() === 'Best Sellers';
                    }).addClass('active');
                    break;
                case 'popular':
                    $('#latest-slider').addClass('active');
                    $('.tablink').filter(function() {
                        return $(this).text() === 'Popular';
                    }).addClass('active');
                    break;
            }
        }

        // Run carousel initialization on DOM ready
        $(document).ready(function() {
            initializeCarousels();
        });

        // Re-initialize on dynamic content changes (optional, can cause repeated init)
        $(document).on('DOMNodeInserted', '.muntiple-product-carosel', function() {
            setTimeout(() => initializeCarousels(), 200);
        });

        $(document).ajaxComplete(function() {
            setTimeout(() => initializeCarousels(), 200);
        });
    </script>

    <script>
        $(document).ready(function() {
            const csrfToken = "{{ csrf_token() }}";

            // Bind quantity control buttons for cart items inside a wrapper
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

            // Bind controls to existing quantity wrappers
            $('.quantity-wrapper').each(function() {
                bindQuantityControls($(this));
            });

            // Further delegated event handling can be added here for dynamically added items

        });
    </script>
{{-- @endpush --}}
