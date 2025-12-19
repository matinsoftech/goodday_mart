<aside class="col-lg-4 pt-4 pt-lg-2 px-max-md-0 order-summery-aside">

    @php($shippingMethod=getWebConfig(name: 'shipping_method'))
    @php($cart=\App\Models\Cart::where(['customer_id' => (auth('customer')->check() ? auth('customer')->id() : session('guest_id'))])->get()->groupBy('cart_group_id'))

    <!-- Checkout order details -->
    @if(count($cart)==0)
        @php($isPhysicalProductExist = false)
    @endif
    <div class="table-responsive d-none d-lg-block side-bar-cart">
        @foreach($cart as $group_key=>$group)
            <div class="card __card cart_information __cart-table mb-3">
                    <?php
                    $isPhysicalProductExist = false;
                    $total_shipping_cost = 0;
                    foreach ($group as $row) {
                        if ($row->product_type == 'physical') {
                            $isPhysicalProductExist = true;
                        }
                        if ($row->product_type == 'physical' && $row->shipping_type != "order_wise") {
                            $total_shipping_cost += $row->shipping_cost;
                        }
                    }

                    ?>

                @foreach($group as $cart_key=>$cartItem)
                    @if ($shippingMethod=='inhouse_shipping')
                            <?php
                            $admin_shipping = \App\Models\ShippingType::where('seller_id', 0)->first();
                            $shipping_type = isset($admin_shipping) == true ? $admin_shipping->shipping_type : 'order_wise';
                            ?>
                    @else
                            <?php
                            if ($cartItem->seller_is == 'admin') {
                                $admin_shipping = \App\Models\ShippingType::where('seller_id', 0)->first();
                                $shipping_type = isset($admin_shipping) == true ? $admin_shipping->shipping_type : 'order_wise';
                            } else {
                                $seller_shipping = \App\Models\ShippingType::where('seller_id', $cartItem->seller_id)->first();
                                $shipping_type = isset($seller_shipping) == true ? $seller_shipping->shipping_type : 'order_wise';
                            }
                            ?>
                    @endif

                    @if($cart_key==0)
                        <div
                            class="card-header d-flex flex-wrap justify-content-between align-items-center gap-2">
                            @php($verify_status = \App\Utils\OrderManager::minimum_order_amount_verify($request, $group_key))
                            @if($cartItem->seller_is=='admin')
                                <div class="d-flex gap-2">
                                    {{-- <a href="{{route('shopView',['id'=>0])}}"
                                       class="company-name d-flex align-items-center gap-2 fs-16">
                                        <img src="{{theme_asset(path: 'public/assets/front-end/img/cart-store.png')}}" alt="">
                                        {{getWebConfig(name: 'company_name')}}
                                    </a> --}}
                                    <a href="{{ url('/') }}"
                                       class="company-name d-flex align-items-center gap-2 fs-16">
                                        <img src="{{theme_asset(path: 'public/assets/front-end/img/cart-store.png')}}" alt="">
                                        {{getWebConfig(name: 'company_name')}}
                                    </a>
                                    {{-- @if ($verify_status['minimum_order_amount'] > $verify_status['amount'])
                                        <span class="pl-1 text-danger pulse-button minimum-order-amount-message" data-toggle="tooltip"
                                              data-placement="right"
                                              data-title="{{ translate('minimum_Order_Amount') }} {{ webCurrencyConverter(amount: $verify_status['minimum_order_amount']) }} {{ translate('for') }} @if($cartItem->seller_is=='admin') {{getWebConfig(name: 'company_name')}} @else {{ \App\Utils\get_shop_name($cartItem['seller_id']) }} @endif"
                                              title="{{ translate('minimum_Order_Amount') }} {{ webCurrencyConverter(amount: $verify_status['minimum_order_amount']) }} {{ translate('for') }} @if($cartItem->seller_is=='admin') {{getWebConfig(name: 'company_name')}} @else {{ \App\Utils\get_shop_name($cartItem['seller_id']) }} @endif">
                                                <i class="czi-security-announcement"></i>
                                            </span>
                                    @endif --}}
                                </div>
                            @else
                                <?php
                                    $shopIdentity = \App\Models\Shop::where(['seller_id'=>$cartItem['seller_id']])->first();
                                ?>
                                <div class="d-flex gap-2">
                                    @if($shopIdentity)
                                        <a href="{{ route('shopView',['id'=>$cartItem->seller_id]) }}"
                                           class="company-name d-flex align-items-center gap-2 fs-16">
                                            <img src="{{theme_asset(path: 'public/assets/front-end/img/cart-store.png')}}" alt="">
                                                {{ $shopIdentity->name }}
                                        </a>
                                        @if ($verify_status['minimum_order_amount'] > $verify_status['amount'])
                                            <span class="pl-1 text-danger pulse-button minimum-order-amount-message" data-toggle="tooltip"
                                                  data-placement="right"
                                                  data-title="{{ translate('minimum_Order_Amount') }} {{ webCurrencyConverter(amount: $verify_status['minimum_order_amount']) }} {{ translate('for') }} @if($cartItem->seller_is=='admin') {{getWebConfig(name: 'company_name')}} @else {{ \App\Utils\get_shop_name($cartItem['seller_id']) }} @endif"
                                                  title="{{ translate('minimum_Order_Amount') }} {{ webCurrencyConverter(amount: $verify_status['minimum_order_amount']) }} {{ translate('for') }} @if($cartItem->seller_is=='admin') {{getWebConfig(name: 'company_name')}} @else {{ \App\Utils\get_shop_name($cartItem['seller_id']) }} @endif">
                                                <i class="czi-security-announcement"></i>
                                            </span>
                                        @endif
                                    @else
                                        <a href="javascript:"
                                           class="company-name d-flex align-items-center gap-2 fs-16">
                                            <img src="{{theme_asset(path: 'public/assets/front-end/img/cart-store.png')}}" alt="">
                                            <span class="text-danger">{{ translate('vendor_not_available') }}</span>
                                        </a>
                                    @endif
                                </div>
                            @endif

                            @php($chosenShipping=\App\Models\CartShipping::where(['cart_group_id'=>$cartItem['cart_group_id']])->first())

                            <div class=" bg-white select-method-border rounded">
                                <a href="{{ url('shop-cart') }}"
                                    class="company-name d-flex align-items-center gap-2 fs-16">
                                    <i class="navbar-tool-icon fa fa-shopping-cart nav-def-icon"></i>
                                </a>
                                {{-- @if($isPhysicalProductExist && $shippingMethod=='sellerwise_shipping' && $shipping_type == 'order_wise')
                                    @if(isset($chosenShipping)==false)
                                        @php($chosenShipping['shipping_method_id']=0)
                                    @endif
                                    @php( $shippings=\App\Utils\Helpers::get_shipping_methods($cartItem['seller_id'], $cartItem['seller_is']))
                                    @if($isPhysicalProductExist && $shippingMethod=='sellerwise_shipping' && $shipping_type == 'order_wise')

                                        <div class="d-sm-flex">
                                            @isset($chosenShipping['shipping_cost'])
                                                <div class="text-sm-nowrap mx-sm-2 mt-sm-2 mb-1">
                                                    <span class="font-weight-bold">
                                                        {{ translate('shipping_cost')}}
                                                    </span>:
                                                    <span>
                                                        {{App\Utils\Helpers::currency_converter($chosenShipping['shipping_cost'])}}
                                                    </span>
                                                </div>
                                            @endisset

                                            @if(count($shippings) > 0)
                                                <select class="form-control fs-13 font-weight-bold text-capitalize border-aliceblue max-240px action-set-shipping-id"
                                                        data-product-id="{{ $cartItem['cart_group_id'] }}">
                                                    <option>{{ translate('choose_shipping_method')}}</option>
                                                    @foreach($shippings as $shipping)
                                                        <option value="{{$shipping['id']}}" {{$chosenShipping['shipping_method_id']==$shipping['id']?'selected':''}}>
                                                            {{ translate('shipping_method')}}
                                                            : {{$shipping['title'].' ( '.$shipping['duration'].' ) '.webCurrencyConverter(amount: $shipping['cost'])}}
                                                        </option>
                                                    @endforeach
                                                </select>
                                            @else
                                                <span class="text-danger d-flex align-items-center gap-1 fs-14 font-semi-bold user-select-none" data-toggle="tooltip"
                                                              data-placement="top"
                                                              title="{{ translate('No_shipping_options_available_at_this_shop') }}, {{ translate('please_remove_all_items_from_this_shop') }}">
                                                    <i class="czi-security-announcement"></i> {{ translate('shipping_Not_Available') }}
                                                </span>
                                            @endif

                                        </div>
                                    @endif
                                @else
                                    @if ($isPhysicalProductExist && $shipping_type != 'order_wise')
                                        <div class="">
                                            <span class="font-weight-bold">{{ translate('total_shipping_cost')}}</span>
                                            :
                                            <span>{{ webCurrencyConverter(amount: $total_shipping_cost)}}</span>
                                        </div>
                                    @elseif($isPhysicalProductExist && $shipping_type == 'order_wise' && $chosenShipping)
                                        <div class="">
                                            <span class="font-weight-bold">{{ translate('total_shipping_cost')}}</span>
                                            :
                                            <span>{{ webCurrencyConverter(amount: $chosenShipping->shipping_cost)}}</span>
                                        </div>
                                    @endif
                                @endif --}}

                            </div>
                        </div>
                    @endif
                @endforeach
                <table
                    class="table table-borderless table-thead-bordered table-nowrap table-align-middle card-table __cart-table">
                    <tbody>
                        <?php
                        $isPhysicalProductExist = false;
                        foreach ($group as $row) {
                            if ($row->product_type == 'physical') {
                                $isPhysicalProductExist = true;
                            }
                        }
                        ?>
                    @foreach($group as $cart_key=>$cartItem)
                        @php($product = $cartItem->allProducts)
                        <?php
                            $checkProductStatus = $cartItem->allProducts?->status ?? 0;
                            if($cartItem->seller_is == 'admin') {
                                $inhouseTemporaryClose = getWebConfig(name: 'temporary_close') ? getWebConfig(name: 'temporary_close')['status'] : 0;
                                $inhouseVacation = getWebConfig(name: 'vacation_add');
                                $vacationStartDate = $inhouseVacation['vacation_start_date'] ? date('Y-m-d', strtotime($inhouseVacation['vacation_start_date'])) : null;
                                $vacationEndDate = $inhouseVacation['vacation_end_date'] ? date('Y-m-d', strtotime($inhouseVacation['vacation_end_date'])) : null;
                                $vacationStatus = $inhouseVacation['status'] ?? 0;
                                if ($inhouseTemporaryClose || ($vacationStatus && (date('Y-m-d') >= $vacationStartDate) && (date('Y-m-d') <= $vacationEndDate))) {
                                    $checkProductStatus = 0;
                                }
                            }else{
                                if (!isset($cartItem->allProducts->seller) || (isset($cartItem->allProducts->seller) && $cartItem->allProducts->seller->status != 'approved')) {
                                    $checkProductStatus = 0;
                                }
                                if (!isset($cartItem->allProducts->seller->shop) || $cartItem->allProducts->seller->shop->temporary_close) {
                                    $checkProductStatus = 0;
                                }
                                if(isset($cartItem->allProducts->seller->shop) && ($cartItem->allProducts->seller->shop->vacation_status && (date('Y-m-d') >= $cartItem->allProducts->seller->shop->vacation_start_date) && (date('Y-m-d') <= $cartItem->allProducts->seller->shop->vacation_end_date))) {
                                    $checkProductStatus = 0;
                                }
                            }
                        ?>

                        <tr>
                            <td class="__w-45">
                                <div class="d-flex gap-3 align-items-center">
                                    <div class="">
                                        <a href="{{ $checkProductStatus == 1 ? route('product', $cartItem['slug']) : 'javascript:'}}"
                                            class="position-relative overflow-hidden">
                                            <img class="rounded __img-62 {{ $checkProductStatus == 0?'custom-cart-opacity-50':'' }}"
                                                    src="{{ getValidImage(path: 'storage/app/public/product/thumbnail/'.$cartItem['thumbnail'], type: 'product') }}"
                                                alt="{{ translate('product') }}">
                                            @if ($checkProductStatus == 0)
                                                <span class="temporary-closed position-absolute text-center p-2">
                                                    <span class="fs-12 font-weight-bolder">{{ translate('N/A') }}</span>
                                                </span>
                                            @endif
                                        </a>
                                    </div>
                                    <div class="d-flex flex-column gap-1">
                                        <div
                                            class="text-break __line-2 __w-18rem {{ $checkProductStatus == 0?'custom-cart-opacity-50':'' }}" style="width: 10rem;">
                                            <a href="{{ $checkProductStatus == 1 ? route('product',$cartItem['slug']) : 'javascript:'}}" class="cart-item-name" style="font-size: 12px;">
                                                {{$cartItem['name']}}
                                            </a>
                                        </div>

                                        <div
                                            class="d-flex flex-wrap gap-2 {{ $checkProductStatus == 0?'custom-cart-opacity-50':'' }}">
                                            @foreach(json_decode($cartItem['variations'],true) as $key1 =>$variation)
                                                <div class="">
                                                        <span class="__text-12px text-capitalize">
                                                            <span class="text-muted">{{$key1}} </span> : <span
                                                                class="fw-semibold">{{$variation}}</span>
                                                        </span>
                                                </div>
                                            @endforeach
                                        </div>
                                        @if ( $shipping_type != 'order_wise')
                                            <div
                                                class="d-flex flex-wrap gap-2 {{ $checkProductStatus == 0?'custom-cart-opacity-50':'' }}">
                                                <span class="fw-semibold">
                                                    {{ translate('shipping_cost')}}
                                                </span>:
                                                <span>
                                                    {{ webCurrencyConverter(amount: $cartItem['shipping_cost']) }}
                                                </span>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </td>
                            {{-- <td class="{{ $checkProductStatus == 0?'custom-cart-opacity-50':'' }} __w-15p">
                                <div class="text-center">
                                    <div class="fw-semibold">
                                        {{ webCurrencyConverter(amount: $cartItem['price']-$cartItem['discount']) }}
                                    </div>
                                    <span class="text-nowrap fs-10">
                                            @if ($cartItem->tax_model === "exclude")
                                            ({{ translate('tax')}}
                                            : {{ webCurrencyConverter(amount: $cartItem['tax']*$cartItem['quantity'])}}
                                            )
                                        @else
                                            ({{ translate('tax_included')}})
                                        @endif
                                         </span>
                                </div>
                            </td> --}}
                            <td class="__w-15p text-center">

                                @php($minimum_order=\App\Utils\ProductManager::get_product($cartItem['product_id']))
                                @if ($checkProductStatus == 1)
                                    <div class="qty d-flex justify-content-center align-items-center gap-3">
                                            <span class="qty_minus action-update-cart-quantity-list d-none"
                                                    data-minimum-order="{{ $product->minimum_order_qty }}"
                                                    data-cart-id="{{ $cartItem['id'] }}"
                                                    data-increment="{{ '-1' }}"
                                                    data-event="{{ $cartItem['quantity'] == $product->minimum_order_qty ? 'delete':'minus' }}">
                                                <i class="{{ $cartItem['quantity'] == (isset($cartItem->product->minimum_order_qty) ? $cartItem->product->minimum_order_qty : 1) ? 'tio-delete text-danger' : 'tio-remove' }}"></i>
                                            </span>
                                        <input type="text" class="qty_input cartQuantity{{ $cartItem['id'] }} action-change-update-cart-quantity-list"
                                                value="{{$cartItem['quantity']}}"
                                                name="quantity[{{ $cartItem['id'] }}]"
                                                id="cart_quantity_web{{$cartItem['id']}}"

                                                data-minimum-order="{{ $product->minimum_order_qty }}"
                                                data-cart-id="{{ $cartItem['id'] }}"
                                                data-increment="{{ '0' }}"

                                                data-min="{{ isset($cartItem->product->minimum_order_qty) ? $cartItem->product->minimum_order_qty : 1 }}"
                                                oninput="this.value = this.value.replace(/[^0-9]/g, '')"
                                                disabled>
                                        <span class="qty_plus action-update-cart-quantity-list d-none"
                                                data-minimum-order="{{ $product->minimum_order_qty }}"
                                                data-cart-id="{{ $cartItem['id'] }}"
                                                data-increment="{{ '1' }}">
                                                <i class="tio-add"></i>
                                        </span>
                                    </div>
                                @else
                                    <div class="qty d-flex justify-content-center align-items-center gap-3 d-none">
                                        <span class="action-update-cart-quantity-list cursor-pointer"
                                                data-minimum-order="{{ $product?->minimum_order_qty ?? 1 }}"
                                                data-cart-id="{{ $cartItem['id'] }}"
                                                data-increment="-{{ $cartItem['quantity'] }}"
                                                data-event="delete">
                                            <i class="tio-delete text-danger" data-toggle="tooltip"
                                                data-title="{{ translate('product_not_available_right_now')}}"></i>
                                        </span>
                                    </div>
                                @endif
                            </td>
                            <td class="__w-15p text-end {{ $checkProductStatus == 0?'custom-cart-opacity-50':'' }}">
                                <div style="font-weight: 500;">
                                    {{ webCurrencyConverter(amount: ($cartItem['price']-$cartItem['discount'])*$cartItem['quantity']) }}
                                </div>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>

            </div>
        @endforeach
    </div>
    <!-- Checkout order details ends -->

    <!-- Checkout sub total -->
    {{-- <div class="__cart-total __cart-total_sticky"> --}}
    <div class="__cart-total">
        <div class="cart_total p-0">
            @php($shippingMethod=getWebConfig(name: 'shipping_method'))
            @php($subTotal=0)
            @php($totalTax=0)
            @php($totalShippingCost=0)
            @php($orderWiseShippingDiscount=\App\Utils\CartManager::order_wise_shipping_discount())
            @php($totalDiscountOnProduct=0)
            @php($cart=\App\Utils\CartManager::get_cart())
            @php($cartGroupIds=\App\Utils\CartManager::get_cart_group_ids())
            @php($getShippingCost=\App\Utils\CartManager::get_shipping_cost())
            @php($getShippingCostSavedForFreeDelivery=\App\Utils\CartManager::get_shipping_cost_saved_for_free_delivery())
            @if($cart->count() > 0)
                @foreach($cart as $key => $cartItem)
                    @php($subTotal+=$cartItem['price']*$cartItem['quantity'])
                    @php($totalTax+=$cartItem['tax_model']=='exclude' ? ($cartItem['tax']*$cartItem['quantity']):0)
                    @php($totalDiscountOnProduct+=$cartItem['discount']*$cartItem['quantity'])
                @endforeach

                @if(session()->missing('coupon_type') || session('coupon_type') !='free_delivery')
                    @php($totalShippingCost=$getShippingCost - $getShippingCostSavedForFreeDelivery)
                @else
                    @php($totalShippingCost=$getShippingCost)
                @endif
            @endif

            @php($totalSavedAmount = $totalDiscountOnProduct)

            @if(session()->has('coupon_discount') && session('coupon_discount') > 0 && session('coupon_type') !='free_delivery')
                @php($totalSavedAmount += session('coupon_discount'))
            @endif

            @if($getShippingCostSavedForFreeDelivery > 0)
                @php($totalSavedAmount += $getShippingCostSavedForFreeDelivery)
            @endif

            @if($totalSavedAmount > 0)
                <h6 class="text-center aside-text-custom-green mb-4 d-flex align-items-center justify-content-center gap-2">
                    <img src="{{theme_asset(path: 'public/assets/front-end/img/icons/offer.svg')}}" alt="">
                    {{translate('you_have_Saved')}}
                    <strong>{{ webCurrencyConverter(amount: $totalSavedAmount) }}!</strong>
                </h6>
            @endif

            <div class="d-flex justify-content-between">
                <span class="cart_title">{{translate('sub_total')}}</span>
                <span class="cart_value">
                    {{ webCurrencyConverter(amount: $subTotal) }}
                </span>
            </div>
            <div class="d-flex justify-content-between">
                <span class="cart_title">{{translate('tax')}}</span>
                <span class="cart_value">
                    {{ webCurrencyConverter(amount: $totalTax) }}
                </span>
            </div>
            <div class="d-flex justify-content-between">
                <span class="cart_title">{{translate('shipping')}}</span>
                <span class="cart_value">
                    {{ webCurrencyConverter(amount: $totalShippingCost) }}
                </span>
            </div>
            <div class="d-flex justify-content-between">
                <span class="cart_title">{{translate('discount_on_product')}}</span>
                <span class="cart_value">
                    - {{ webCurrencyConverter(amount: $totalDiscountOnProduct) }}
                </span>
            </div>
            @php($coupon_dis=0)
            @if(auth('customer')->check())

                @if(session()->has('coupon_discount'))
                    @php($couponDiscount = session()->has('coupon_discount')?session('coupon_discount'):0)

                    <div class="d-flex justify-content-between">
                            <span class="cart_title">{{translate('coupon_discount')}}</span>
                            <span class="cart_value">
                        - {{ webCurrencyConverter(amount: $couponDiscount) }}
                    </span>
                        </div>

                    <div class="pt-2">
                        <div class="d-flex align-items-center form-control rounded-pill pl-3 p-1">
                            <img width="24" src="{{asset('public/assets/front-end/img/icons/coupon.svg')}}" alt="">
                            <div class="px-2 d-flex justify-content-between w-100">
                                <div>
                                    {{ session('coupon_code') }}
                                    <span class="text-primary small">( -{{ webCurrencyConverter(amount: $couponDiscount) }} )</span>
                                </div>
                                <div class="bg-transparent text-danger cursor-pointer px-2 get-view-by-onclick" data-link="{{ route('coupon.remove') }}">x</div>
                            </div>
                        </div>
                    </div>
                    @php($coupon_dis=session('coupon_discount'))
                @else
                    <div class="pt-2">
                        <form class="needs-validation coupon-code-form" action="javascript:" method="post" novalidate
                              id="coupon-code-ajax">
                            <div class="d-flex form-control rounded-pill ps-3 p-1">
                                <img width="24" src="{{theme_asset(path: 'public/assets/front-end/img/icons/coupon.svg')}}" alt="">
                                <input class="input_code border-0 px-2 text-dark bg-transparent outline-0 w-100"
                                       type="text" name="code" placeholder="{{translate('coupon_code')}}" required>
                                <button class="btn btn-green-custom rounded-pill text-uppercase py-1 fs-12" type="button" id="apply-coupon-code">
                                        {{translate('apply')}}
                                    </button>
                            </div>
                            <div class="invalid-feedback">{{translate('please_provide_coupon_code')}}</div>
                        </form>
                    </div>
                    @php($coupon_dis=0)
                @endif
            @endif
            <hr class="my-2">
            <div class="d-flex justify-content-between">
                <span class="cart_title_total  font-weight-bold">{{translate('total')}}</span>
                <span class="cart_value">
                {{ webCurrencyConverter(amount: $subTotal+$totalTax+$totalShippingCost-$coupon_dis-$totalDiscountOnProduct-$orderWiseShippingDiscount) }}
                </span>
            </div>
        </div>
        @php($company_reliability = getWebConfig(name: 'company_reliability'))
        @if($company_reliability != null)
            <div class="mt-5">
                <div class="row justify-content-center g-4">
                    @foreach ($company_reliability as $key=>$value)
                        @if ($value['status'] == 1 && !empty($value['title']))
                            <div class="col-sm-3 px-0 text-center mobile-padding">
                                <img class="order-summery-footer-image" alt=""
                                     src="{{ getValidImage(path: 'storage/app/public/company-reliability/'.$value['image'], type: 'source', source: theme_asset(path: 'public/assets/front-end/img').'/'.$value['item'].'.png') }}">
                                <div class="deal-title">{{translate($value['title'])}}</div>
                            </div>
                        @endif
                    @endforeach
                </div>
            </div>
        @endif


        @include('web-views.partials.infinite-slider')

        <div class="mt-4">
            <a class="btn btn-green-custom btn-block proceed_to_next_button {{$cart->count() <= 0 ? 'disabled' : ''}} action-checkout-function">{{translate('proceed_to_Checkout')}}</a>
        </div>

        @if( $cart->count() != 0)
            <div class="d-flex justify-content-center mt-3">
                <a href="{{route('home')}}" class="d-flex align-items-center gap-2 cart_title_total font-weight-bold">
                    <i class="tio-back-ui fs-12"></i> {{translate('continue_Shopping')}}
                </a>
            </div>
        @endif

    </div>
    <!-- Checkout sub total ends -->
</aside>

<div class="bottom-sticky3 bg-white p-3 shadow-sm w-100 d-lg-none">
    <div class="d-flex justify-content-center align-items-center fs-14 mb-2">
        <div class="product-description-label fw-semibold text-capitalize">{{translate('total_price')}} :</div>
        &nbsp; <strong
                class="text-base">{{ webCurrencyConverter(amount: $subTotal+$totalTax+$totalShippingCost-$coupon_dis-$totalDiscountOnProduct-$orderWiseShippingDiscount) }}</strong>
    </div>
    <a data-route="{{ Route::currentRouteName() }}"
       class="btn btn--primary btn-block proceed_to_next_button text-capitalize {{$cart->count() <= 0 ? 'disabled' : ''}} action-checkout-function">{{translate('proceed_to_next')}}</a>
</div>

@push('script')
    <script>
        "use strict";
        $(document).ready(function () {
            orderSummaryStickyFunction()
        });
    </script>
@endpush
