
"use strict";


updateFlashDealProgressBar();
setInterval(updateFlashDealProgressBar, 10000);
    $(document).ready(function () {
        var directionFromSession = $('#direction-from-session').data('value');
        directionFromSession = directionFromSession ? directionFromSession : 'ltr';

        $('.flash-deal-slider').owlCarousel({
            loop: false,
            autoplay: true,
            center: false,
            margin: 10,
            nav: true,
            navText: directionFromSession === 'rtl' ? ["<i class='czi-arrow-right'></i>", "<i class='czi-arrow-left'></i>"] : ["<i class='czi-arrow-left'></i>", "<i class='czi-arrow-right'></i>"],
            dots: false,
            autoplayHoverPause: true,
            rtl: directionFromSession === 'rtl',
            ltr: directionFromSession === 'ltr',
            responsive: {
                0: {
                    items: 2
                },
                360: {
                    items: 2
                },
                375: {
                    items: 2
                },
                480: {
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
                    items: 4
                },
            },
        })

        $('.flash-deal-slider-mobile').owlCarousel({
            loop: false,
            autoplay: true,
            center: true,
            margin: 10,
            nav: true,
            navText: directionFromSession === 'rtl' ? ["<i class='czi-arrow-right'></i>", "<i class='czi-arrow-left'></i>"] : ["<i class='czi-arrow-left'></i>", "<i class='czi-arrow-right'></i>"],
            dots: false,
            autoplayHoverPause: true,
            rtl: directionFromSession === 'rtl',
            ltr: directionFromSession === 'ltr',
            responsive: {
                0: {
                    items: 2
                },
                360: {
                    items: 2
                },
                375: {
                    items: 2
                },
                480: {
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
                    items: 4
                },
            },
        })

        $('#featured_products_list').owlCarousel({
            loop: true,
            autoplay: true,
            margin: 20,
            nav: true,
            navText: directionFromSession === 'rtl' ? ["<i class='czi-arrow-right'></i>", "<i class='czi-arrow-left'></i>"] : ["<i class='czi-arrow-left'></i>", "<i class='czi-arrow-right'></i>"],
            dots: false,
            autoplayHoverPause: true,
            autoplaySpeed: 1500,
            rtl: directionFromSession === 'rtl',
            ltr: directionFromSession === 'ltr',
            responsive: {
                0: {
                    items: 1
                },
                360: {
                    items: 1
                },
                375: {
                    items: 1
                },
                540: {
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
                },
            },
        });
        $('#featured-products-list').owlCarousel({
            loop: true,
            autoplay: true,
            margin: 20,
            nav: true,
            navText: directionFromSession === 'rtl' ? ["<i class='czi-arrow-right'></i>", "<i class='czi-arrow-left'></i>"] : ["<i class='czi-arrow-left'></i>", "<i class='czi-arrow-right'></i>"],
            dots: false,
            autoplayHoverPause: true,
            autoplaySpeed: 1500,
            rtl: directionFromSession === 'rtl',
            ltr: directionFromSession === 'ltr',
            responsive: {
                0: {
                    items: 2
                },
                360: {
                    items: 2
                },
                375: {
                    items: 2
                },
                540: {
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
                },
            },
        });
        $('.new-arrivals-product').owlCarousel({
            loop: true,
            autoplay: true,
            margin: 20,
            nav: true,
            navText: directionFromSession === 'rtl' ? ["<i class='czi-arrow-right'></i>", "<i class='czi-arrow-left'></i>"] : ["<i class='czi-arrow-left'></i>", "<i class='czi-arrow-right'></i>"],
            dots: false,
            autoplayHoverPause: true,
            rtl: directionFromSession === 'rtl',
            ltr: directionFromSession === 'ltr',
            responsive: {
                0: {
                    items: 1
                },
                360: {
                    items: 1.02
                },
                375: {
                    items: 1.02
                },
                540: {
                    items: 2
                },
                576: {
                    items: 2
                },
                768: {
                    items: 2
                },
                992: {
                    items: 2
                },
                1200: {
                    items: 4
                },
                1400: {
                    items: 4
                }
            },
        })
        $('.category-wise-product-slider').each(function () {
            $(this).owlCarousel({
                loop: true,
                autoplay: true,
                margin: 20,
                nav: true,
                navText: directionFromSession === 'rtl' ? ["<i class='czi-arrow-right'></i>", "<i class='czi-arrow-left'></i>"] : ["<i class='czi-arrow-left'></i>", "<i class='czi-arrow-right'></i>"],
                dots: false,
                autoplayHoverPause: true,
                rtl: directionFromSession === 'rtl',
                ltr: directionFromSession === 'ltr',
                responsive: {
                    0: {
                        items: 1.2
                    },
                    375: {
                        items: 1.4
                    },
                    425: {
                        items: 2
                    },
                    576: {
                        items: 3
                    },
                    768: {
                        items: 4
                    },
                    992: {
                        items: 5
                    },
                    1200: {
                        items: 6
                    },
                },
                onInitialized: checkNavigationButtons,
            });
        });
        function checkNavigationButtons(event) {
            var itemCount = event.item.count;
            let owlNav = $('.owl-nav');
            itemCount > 1 ? owlNav.show() : owlNav.hide()
        }
        $("#home-hero-slider").owlCarousel({
            items: 1,
            nav: false,
            loop: true,
            autoplay: true,
            autoplayTimeout: 5000,
            autoplayHoverPause: true,
            smartSpeed: 1000
        });
        //   });
        $("#home-category-slider").owlCarousel({
            loop: true,
            autoplay: true,
            // margin: 20,
            nav: true,
            navText: directionFromSession === 'rtl' ? ["<i class='czi-arrow-right'></i>", "<i class='czi-arrow-left'></i>"] : ["<i class='czi-arrow-left'></i>", "<i class='czi-arrow-right'></i>"],
            dots: false,
            autoplayHoverPause: true,
            rtl: directionFromSession === 'rtl',
            ltr: directionFromSession === 'ltr',
            autoplayHoverPause: true,
            smartSpeed: 5000,
            responsive: {
                0: {
                    items: 2,
                },
                360: {
                    items: 2,
                },
                576: {
                    items: 2,
                },
                768: {
                    items: 3,
                },
                992: {
                    items: 4,
                },
                1200: {
                    items: 5,
                },
            },
        });
        $('#best-selling-slider').owlCarousel({
            loop: true,
            autoplay: true,
            margin: 20,
            nav: true,
            navText: directionFromSession === 'rtl' ? ["<i class='czi-arrow-right'></i>", "<i class='czi-arrow-left'></i>"] : ["<i class='czi-arrow-left'></i>", "<i class='czi-arrow-right'></i>"],
            dots: false,
            autoplayHoverPause: true,
            autoplaySpeed: 1500,
            rtl: directionFromSession === 'rtl',
            ltr: directionFromSession === 'ltr',
            responsive: {
                0: {
                    items: 2
                },
                360: {
                    items: 2
                },
                375: {
                    items: 2
                },
                540: {
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
                },
            },
        });
        $('.latest-slider').owlCarousel({
            loop: true,
            autoplay: true,
            margin: 20,
            nav: false,
            navText: directionFromSession === 'rtl' ? ["<i class='czi-arrow-right'></i>", "<i class='czi-arrow-left'></i>"] : ["<i class='czi-arrow-left'></i>", "<i class='czi-arrow-right'></i>"],
            dots: false,
            autoplayHoverPause: true,
            autoplaySpeed: 1500,
            rtl: directionFromSession === 'rtl',
            ltr: directionFromSession === 'ltr',
            responsive: {
                0: {
                    items: 2,
                },
                360: {
                    items: 2,
                },
                576: {
                    items: 2,
                },
                768: {
                    items: 3,
                },
                992: {
                    items: 3,
                },
                1200: {
                    items: 5,
                },
                1400: {
                    items: 5,
                }
            },
        });
        $('#latest-slider').owlCarousel({
            loop: true,
            autoplay: true,
            margin: 20,
            nav: true,
            navText: directionFromSession === 'rtl' ? ["<i class='czi-arrow-right'></i>", "<i class='czi-arrow-left'></i>"] : ["<i class='czi-arrow-left'></i>", "<i class='czi-arrow-right'></i>"],
            dots: false,
            autoplayHoverPause: true,
            autoplaySpeed: 1500,
            rtl: directionFromSession === 'rtl',
            ltr: directionFromSession === 'ltr',
            responsive: {
                0: {
                    items: 2
                },
                360: {
                    items: 2
                },
                375: {
                    items: 2
                },
                540: {
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
                },
            },
        });
        $('.brands-slider').owlCarousel({
            loop: false,
            autoplay: true,
            margin: 10,
            nav: true,
            navText: directionFromSession === 'rtl' ? ["<i class='czi-arrow-right'></i>", "<i class='czi-arrow-left'></i>"] : ["<i class='czi-arrow-left'></i>", "<i class='czi-arrow-right'></i>"],
            dots: false,
            rtl: directionFromSession === 'rtl',
            ltr: directionFromSession === 'ltr',
            autoplayHoverPause: true,
            responsive: {
                0: {
                    items: 4,
                },
                360: {
                    items: 5,
                },
                576: {
                    items: 6,
                },
                768: {
                    items: 7,
                },
                992: {
                    items: 9,
                },
                1200: {
                    items: 11,
                },
                1400: {
                    items: 12,
                }
            },
        })
        $('.footer-banner-slider').owlCarousel({
            loop: true,
            autoplay: true,
            margin: 10,
            nav: false,
            rtl: directionFromSession === 'rtl',
            ltr: directionFromSession === 'ltr',
            autoplayHoverPause: true,
            responsive: {
                0: {
                    items: 1,
                },
                360: {
                    items: 1,
                },
                576: {
                    items: 2,
                },
                768: {
                    items: 2,
                },
                992: {
                    items: 3,
                },
                1200: {
                    items: 3,
                },
                1400: {
                    items: 3,
                }
            },
        })
        $('#category-slider, #top-seller-slider').owlCarousel({
            loop: false,
            autoplay: true,
            margin: 20,
            nav: false,
            dots: true,
            autoplayHoverPause: true,
            rtl: directionFromSession === 'rtl',
            ltr: directionFromSession === 'ltr',
            responsive: {
                0: {
                    items: 2
                },
                360: {
                    items: 3
                },
                375: {
                    items: 3
                },
                540: {
                    items: 4
                },
                576: {
                    items: 5
                },
                768: {
                    items: 6
                },
                992: {
                    items: 8
                },
                1200: {
                    items: 10
                },
                1400: {
                    items: 11
                }
            },
        })
        const othersStore = $(".others-store-slider").owlCarousel({
            responsiveClass: true,
            nav: false,
            dots: false,
            loop: true,
            autoplay: true,
            autoplayTimeout: 5000,
            autoplayHoverPause: true,
            smartSpeed: 600,
            rtl: directionFromSession === 'rtl',
            ltr: directionFromSession === 'ltr',
            responsive: {
                0: {
                    items: 1.3,
                    margin: 10,
                },
                480: {
                    items: 2,
                    margin: 26,
                },
                768: {
                    items: 2,
                    margin: 26,
                },
                992: {
                    items: 3,
                    margin: 26,
                },
                1200: {
                    items: 4,
                    margin: 26,
                },
            },
        });
        $(".store-next").on("click", function () {
            othersStore.trigger("next.owl.carousel", [600]);
        });
        $(".store-prev").on("click", function () {
            othersStore.trigger("prev.owl.carousel", [600]);
        });
    })
    $('.product').each(function () {
        var $this = $(this);
        var hoverDetail = $this.find('.product-hover_details');
        $this.hover(function () {
            hoverDetail.toggleClass('d-none');
        });
    });
    $("#owl-testimonial").owlCarousel({
        loop: true,
        autoplay: true,
        margin: 20,
        nav: false,
        navText: directionFromSession === 'rtl' ? ["<i class='czi-arrow-right'></i>",
            "<i class='czi-arrow-left'></i>"
        ] : ["<i class='czi-arrow-left'></i>", "<i class='czi-arrow-right'></i>"],
        dots: false,
        autoplayHoverPause: true,
        autoplaySpeed: 1500,
        slideTransition: 'linear',
        rtl: directionFromSession === 'rtl',
        ltr: directionFromSession === 'ltr',
        items: 1,
    });
    document.addEventListener('DOMContentLoaded', function () {
        // Set the third button (3 items per row) as active and apply its layout by default
        changeItemsPerRow(1, document.querySelector('.button-group .btn:nth-child(3)'));
    });

    function changeItemsPerRow(numItems, element) {
        const container = document.querySelector('.items-container');
        if (!container) return; // Safely exit if not found
        container.style.gridTemplateColumns = `repeat(${numItems}, 1fr)`;
        const items = document.querySelectorAll('.product-single-hover .muntiple-designs');
        items.forEach(item => {
            item.classList.remove('design-1', 'design-2');
            item.classList.add(numItems === 1 ? 'design-1' : 'design-2');
        });
        const buttons = document.querySelectorAll('.button-group button');
        buttons.forEach(button => button.classList.remove('active'));
        element.classList.add('active');
    }
    $(document).ready(function () {
        $(document).on('click', '.add-to-cart', function (e) {
            console.log('hello');
        });
    });

    $(document).on('click', '.btn-number', function () {
        let form = $(this).closest('form');
        let quantityInput = form.find('.cart-qty-field');
        let quantityBox = form.find('.quantity-box');
        let quantity = parseInt(quantityInput.val());
        let minQty = parseInt(quantityInput.attr('min')) || 1;
        let maxQty = parseInt(quantityInput.attr('max')) || 100;
        let newQty = quantity;

        if ($(this).hasClass('plus')) {
            if (quantity < maxQty) {
                newQty++;
            }
        } else if ($(this).hasClass('minus')) {
            if (quantity > minQty) {
                newQty--;
            }
        }

        if (newQty !== quantity) {
            quantityInput.val(newQty);
            $.ajax({
                url: "{{ route('cart.updateQuantity') }}",
                type: 'POST',
                data: {
                    _token: '{{ csrf_token() }}',
                    cart_id: quantityInput.data('cart-id'),
                    key: quantityInput.data('cart-id'), // for guest users
                    quantity: newQty
                },
                success: function (response) {
                    if (response.status === 1) {
                        toastr.success(response.message);
                        updateMinusButton(quantityInput, quantityBox);
                    } else {
                        toastr.error(response.message || 'Failed to update quantity');
                    }
                },
                error: function () {
                    toastr.error('Something went wrong. Please try again.');
                }
            });
        }
    });

    function updateMinusButton(quantityInput, quantityBox) {
        let quantity = parseInt(quantityInput.val());
        let minQty = parseInt(quantityInput.attr('min')) || 1;
        let minusBtn = quantityBox.find('.minus');

        if (quantity <= minQty) {
            minusBtn.attr('disabled', true);
        } else {
            minusBtn.removeAttr('disabled');
        }
    }

    $('.btn-number').on('click', function (e) {
        e.preventDefault();
        let button = $(this);
        let input = button.closest(".cart-controls").find(".cart-qty-field");
        let cart_id = input.attr("data-cart-id");
        let product_id = input.data("producttype");
        let action = button.attr("data-type") === "plus" ? 1 : -1;
        if (!cart_id) {
            console.error("Cart ID is missing! Ensure product is added to the cart first.");
            return;
        }
        updateCartQuantity(cart_id, product_id, action);
    });

    $(".cart-qty-field").on("change", function () {
        let input = $(this);
        let newValue = parseInt(input.val()) || 1;
        let minValue = parseInt(input.attr("min")) || 1;
        let maxValue = parseInt(input.attr("max")) || 100;
        let cart_id = input.data("cart-id");
        let product_id = input.data("producttype");
        if (newValue < minValue) newValue = minValue;
        if (newValue > maxValue) newValue = maxValue;
        input.val(newValue);
        if (cart_id) {
            updateCartQuantity(cart_id, product_id, newValue);
        } else {
            console.error("Cart ID is missing!");
        }
    });
// });
function updateCartQuantity(cart_id, product_id, action, event = null) {
    let remove_url = $("#route-cart-remove").data("url");
    let update_url = $("#route-cart-updateQuantity-guest").data("url");
    let token = $('meta[name="_token"]').attr("content");
    let input = $(`.cartQuantity${cart_id}`);
    let currentQty = parseInt(input.attr('data-cart-quantity')) || 1;
    let newQty = (typeof action === 'number') ? (currentQty + action) : action;
    if (newQty <= 0) {
        toastr.info('Cannot use zero quantity.');
        input.val(input.data("min"));
        return;
    }
    if (newQty < input.data("min")) {
        toastr.error('Minimum quantity is ' + input.data("min"));
        input.val(input.data("min"));
        return;
    }
    if (currentQty === input.data("min") && action === -1) {
        $.post(remove_url, {
            _token: token,
            key: cart_id
        }, function (response) {
            updateNavCart();
            toastr.info(response.message);
            location.reload();
        });
        return;
    }
    $.post(update_url, {
        _token: token,
        key: cart_id,
        product_id: product_id,
        quantity: newQty
    }, function (response) {
        if (response.status === 0) {
            toastr.error(response.message);
        } else {
            toastr.success(response.message);
            $(`.cartQuantity${cart_id}`).val(response.qty).attr('data-cart-quantity', response.qty);
            $(`.cart_quantity_multiply${cart_id}`).html(response.qty);
            $(`.discount_price_of_${cart_id}`).html(response.discount_price);
            $(`.quantity_price_of_${cart_id}`).html(response.quantity_price);
            $(".cart_total_amount, .cart-total-price").html(response.total_price);
            $(`.total_discount`).html(response.total_discount_price);
            $(`.free_delivery_amount_need`).html(response.free_delivery_status.amount_need);
            if (response.free_delivery_status.amount_need <= 0) {
                $('.amount_fullfill').removeClass('d-none');
                $('.amount_need_to_fullfill').addClass('d-none');
            } else {
                $('.amount_fullfill').addClass('d-none');
                $('.amount_need_to_fullfill').removeClass('d-none');
            }
            const progressBar = document.querySelector('.progress-bar');
            if (progressBar) {
                progressBar.style.width = response.free_delivery_status.percentage + '%';
            }
            let iconHtml = (response.qty === input.data("min")) ?
                '<i class="tio-delete-outlined text-danger fs-10"></i>' :
                '<i class="tio-remove fs-10"></i>';
            input.closest('.cart-controls').find(".quantity__minus").html(iconHtml);
            if (["shop-cart", "checkout-payment", "checkout-details"].includes(window.location.pathname
                .split("/").pop())) {
                location.reload();
            }
        }
    });
}
