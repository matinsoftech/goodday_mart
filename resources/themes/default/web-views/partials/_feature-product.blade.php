<div class="product-single-hover shadow-none rtl">
    <div class="overflow-hidden position-relative">
        <div class="inline_product clickable">
            @if ($product->discount > 0)
                <span class="for-discount-value p-1 pl-2 pr-2 font-bold fs-13">
                    <span class="direction-ltr d-block">
                        @if ($product->discount_type == 'percent')
                            -{{ round($product->discount, $decimal_point_settings ?? 0) }}% OFF
                        @elseif($product->discount_type == 'flat')
                            -{{ webCurrencyConverter(amount: $product->discount) }} OFF
                        @endif
                    </span>
                </span>
            @else
                <span class="for-discount-value-null"></span>
            @endif
            <a href="{{ route('product', $product->slug) }}">
                <img src="{{ getValidImage(path: 'storage/app/public/product/thumbnail/' . $product['thumbnail'], type: 'product') }}" alt="">
            </a>
            @if ($product->product_type == 'physical' && $product->current_stock <= 0)
                <span class="out_fo_stock">{{ translate('out_of_stock') }}</span>
            @endif
        </div>
        <div class="single-product-details text-center">
            <div>
                <a href="{{ route('product', $product->slug) }}" class="text-capitalize fw-semibold font-15">
                    {{ Str::limit($product['name'], 23) }}
                </a>
            </div>
            <div class="justify-content-between">
                <div class="product-price justify-content-center">
                    @if ($product->discount > 0)
                        <del class="category-single-product-price">
                            {{ webCurrencyConverter(amount: $product->unit_price) }}
                        </del>
                    @endif
                    <span class="text-accent text-dark">
                        {{ webCurrencyConverter(amount: $product->unit_price - getProductDiscount(product: $product, price: $product->unit_price)) }}
                    </span>
                </div>
            </div>
            <form method="POST" class="product __btn-grp mt-2 mb-3 mx-2 d-none d-sm-flex">
                @csrf
                <input type="hidden" name="id" value="{{ $product->id }}">
                <input type="hidden" class="cart-qty-field cartQuantity{{ $product->id }}" name="quantity" value="1"
                       data-cart-id="" data-cart-quantity="1" data-min="1" data-max="100" data-producttype="{{ $product->id }}">
                @php
                    $isClosed = (
                        ($product->added_by === 'seller' &&
                            ($sellerTemporaryClose ||
                            (isset($product->seller->shop) && $product->seller->shop->vacation_status &&
                            $currentDate >= $sellerVacationStartDate && $currentDate <= $sellerVacationEndDate))) ||
                        ($product->added_by === 'admin' &&
                            ($inHouseTemporaryClose ||
                            ($inHouseVacationStatus &&
                            $currentDate >= $inHouseVacationStartDate && $currentDate <= $inHouseVacationEndDate)))
                    );
                @endphp
                @if ($isClosed)
                    <button class="btn add-to-cart" type="button" disabled>
                        Add To Cart <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                    </button>
                    <div class="alert alert-danger mt-2" role="alert">
                        {{ translate('this_shop_is_temporary_closed_or_on_vacation._You_cannot_add_product_to_cart_from_this_shop_for_now') }}
                    </div>
                @else
                    <button type="button" class="btn add-to-cart">
                        Add To Cart <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                    </button>
                @endif
                <div class="cart-controls m-auto quantity-box d-none">
                    <button type="button" class="btn btn-number quantity-control decrease-btn quantity__minus"
                        data-type="minus">-</button>
                    <input type="number" class="cart-qty-field cartQuantity{{ $product->id }}"
                           value="1" min="1" max="100"
                           data-cart-id="" data-cart-quantity="1" data-min="1"
                           data-producttype="{{ $product->id }}">
                    <button type="button" class="btn btn-number quantity-control increase-btn quantity__plus"
                        data-type="plus">+</button>
                </div>
            </form>
        </div>
    </div>
</div>
