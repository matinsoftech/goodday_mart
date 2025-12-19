<style>
    .remove--icon.function-remove-wishList {
        position: absolute;
        top: 5px;
        right: 5px;
        border: 1px solid rgba(139, 139, 139, 0.16);
        filter: drop-shadow(0px 4px 5px rgba(27, 127, 237, 0.07));
        width: 32px;
        height: 32px;
        border-radius: 50%;
        display: flex;
        align-items: center;
        justify-content: center;
        z-index: 1;
        background-color: #28a745;
    }
</style>
@php($decimal_point_settings = getWebConfig(name: 'decimal_point_settings'))
@if ($wishlists->count() > 0)
    <div class="row">
        @foreach ($wishlists as $key => $wishlist)
            @php($product = $wishlist->productFullInfo)
            @if ($wishlist->productFullInfo)
                <div class="col-xl-3 col-lg-4 col-md-6 col-sm-12 col-12 mb-2" id="row_id{{ $product->id }}">
                    @php($overallRating = getOverallRating($product->reviews))
                    <div class="product-single-hover product-card-slider">
                        <div class="overflow-hidden position-relative w-100">
                            <div class=" inline_product clickable d-flex justify-content-center">
                                <a href="javascript:" class="remove--icon function-remove-wishList"
                                    data-id="{{ $product['id'] }}" data-modal="remove-wishlist-modal">
                                    <i class="fa fa-heart" style="color: #ffff;"></i>
                                </a>
                                @if ($product->discount > 0)
                                    <div class="d-flex">
                                        <span class="for-discount-value p-1 pl-2 pr-2 font-bold fs-13">
                                            <span class="direction-ltr d-block">
                                                @if ($product->discount_type == 'percent')
                                                    -{{ round($product->discount, $decimal_point_settings ?? 0) }}%
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
                                <div class="pb-0 d-flex align-items-center justify-content-center">
                                    <a class="best-selleing-image" href="{{ route('product', $product->slug) }}">
                                        <img alt="{{ translate('wishlist') }}"
                                            src="{{ getValidImage(path: 'storage/app/public/product/thumbnail/' . $product['thumbnail'], type: 'product') }}">
                                    </a>
                                </div>
                                @if ($product->product_type == 'physical' && $product->current_stock <= 0)
                                    <span class="out_fo_stock">{{ translate('out_of_stock') }}</span>
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
                                {{-- Add to Cart Form --}}
                                <form id="add-to-cart-form-{{ $product->id }}" class="mb-2"
                                    action="{{ route('cart.add') }}">
                                    @csrf
                                    <input type="hidden" name="id" value="{{ $product->id }}">
                                    <input type="hidden" name="product_variation_code"
                                        class="product-generated-variation-code">
                                    <input type="hidden" value="" class="in_cart_key form-control w-50"
                                        name="key">
                                    <input type="hidden" name="quantity"
                                        value="{{ $product->minimum_order_qty ?? 1 }}"
                                        min="{{ $product->minimum_order_qty ?? 1 }}"
                                        max="{{ $product->product_type == 'physical' ? $product->current_stock : 100 }}">
                                    <div class="product __btn-grp mt-2 mb-3 d-sm-flex justify-content-center">
                                        <button type="button" class="btn add-to-cart width-90"
                                            data-form-id="add-to-cart-form-{{ $product->id }}">
                                            Add To Cart
                                            <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            @else
                <span class="badge badge-danger">{{ translate('item_removed') }}</span>
            @endif
        @endforeach
    </div>
@else
    <div class="login-card">
        <div class="text-center py-3 text-capitalize">
            <img src="{{ theme_asset(path: 'public/assets/front-end/img/icons/wishlist.png') }}" alt=""
                class="mb-4" width="70">
            <h5 class="fs-14">{{ translate('no_product_found_in_wishlist') }}!</h5>
        </div>
    </div>
@endif
<div class="card-footer border-0">{{ $wishlists->links() }}</div>
{{-- Scripts --}}
<script src="{{ theme_asset(path: 'public/assets/front-end/vendor/jquery/dist/jquery-2.2.4.min.js') }}"></script>
<script src="https://cdn.jsdelivr.net/npm/toastr@2.1.4/build/toastr.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/toastr@2.1.4/build/toastr.min.css" rel="stylesheet" />
{!! Toastr::message() !!}
<script>
    $(document).ready(function() {
        function addToCart(formId) {
            const form = $('#' + formId);
            const quantity = form.find('input[name="quantity"]').val();
            if (parseInt(quantity) <= 0) {
                toastr.warning("{{ translate('quantity_must_be_at_least_1') }}");
                return;
            }
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="_token"]').attr('content')
                }
            });
            $.post({
                url: form.attr('action'),
                data: form.serialize(),
                success: function(response) {
                    if (response.status === 1) {
                        updateNavCart(); // Optional if defined globally
                        toastr.success(response.message);
                    } else {
                        toastr.warning(response.message);
                    }
                }
                // error: function() {
                //     toastr.error("{{ translate('something_went_wrong') }}");
                // }
            });
        }
        $('.add-to-cart').on('click', function() {
            const formId = $(this).data('form-id');
            addToCart(formId);
        });
    });
</script>
