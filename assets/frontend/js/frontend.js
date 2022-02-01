(function ($) {
    "use strict";

    $(document).ready(function () {

        var ajaxUrl = majc_frontend_js_obj.ajax_url;
        var wpNonce = majc_frontend_js_obj.ajax_nonce;

        $('body').addClass($('.majc-main-wrapper').data('overlayenable'));
        /*
        $('.majc-cart-popup').draggable({
            axis: "y",
            containment: 'body',
            cursor: 'crosshair'
        });*/

        $(document.body).trigger('wc_fragment_refresh');

        $.ajax({
            url: ajaxUrl,
            type: 'POST',
            data: {
                action: 'get_refresh_fragments',
                wp_nonce: wpNonce
            },
            success: function (response) {

                if (response.fragments) {

                    //Set fragments
                    $.each(response.fragments, function (key, value) {
                        $(key).replaceWith(value);
                    });

                    if (('sessionStorage' in window && window.sessionStorage !== null)) {

                        sessionStorage.setItem(wc_cart_fragments_params.fragment_name, JSON.stringify(response.fragments));
                        sessionStorage.setItem(wc_cart_fragments_params.cart_hash_key, response.cart_hash);
                        localStorage.setItem(wc_cart_fragments_params.cart_hash_key, response.cart_hash);

                        if (response.cart_hash) {
                            sessionStorage.setItem('wc_cart_created', (new Date()).getTime());
                        }
                    }

                    $('body').find(".majc-body").mCustomScrollbar({
                        autoDraggerLength: true,
                    });

                    $(document.body).trigger('wc_fragments_refreshed');
                }
            }
        });

        $('body').find(".majc-cartbasket-toggle-btn").on('click', function () {
            if ($(this).parent().next('.majc-cart-popup').hasClass('animate__animated')) {
                var $popup = $(this).parent().next('.majc-cart-popup');
                var showAnimation = $popup.data('showanimation');
                var hideAnimation = $popup.data('hideanimation');

                // Add Toggle class on buton toggle
                $('body').toggleClass('majc-cartbasket-open');
                $(this).parent('.majc-toggle-button').toggleClass('majc-toggle-btn-open');

                if ($popup.hasClass(showAnimation)) {
                    $popup.removeClass(showAnimation + ' ' + hideAnimation);
                    $popup.addClass(hideAnimation);
                    $popup.removeClass('majc-cart-anim-show');
                    $popup.addClass('majc-cart-anim-hide');
                } else if ($popup.hasClass(hideAnimation)) {
                    $popup.removeClass(showAnimation + ' ' + hideAnimation);
                    $popup.addClass(showAnimation);
                    $popup.removeClass('majc-cart-anim-hide');
                    $popup.addClass('majc-cart-anim-show');
                } else if (!$popup.hasClass(showAnimation) || !$popup.hasClass(hideAnimation)) {
                    $popup.addClass(showAnimation);
                    $popup.addClass('majc-cart-anim-show');
                }

            } else {
                $(this).toggleClass('active');
                $('body').toggleClass('majc-cartbasket-open');
                $('.majc-cart-popup').toggleClass('active');
            }

        });

        $('body').find(".majc-cart-close").on('click', function () {

            var $popup = $(this).closest('.majc-main-inner-wrapper').find('.majc-cart-popup');

            $(this).closest('.majc-cart-popup').removeClass('active');
            $(this).closest('.majc-main-inner-wrapper').find(".majc-cartbasket-toggle-btn").removeClass('active');
            if ($popup.hasClass('majc-cartpop-animation-enabled')) {
                $('body').find(".majc-cartbasket-toggle-btn").trigger('click');
            }
            $('body').removeClass('majc-cartbasket-open');
        });

        $(document).on('click', '.add_to_cart_button', function () {
            var cart = $('body').find('.majc-toggle-open-btn');

            var imgtodrag = $(this).closest('.product').find("img").eq(0);

            if (imgtodrag.length) {
                var imgclone = imgtodrag.clone()
                        .offset({
                            top: imgtodrag.offset().top,
                            left: imgtodrag.offset().left
                        })
                        .css({
                            'opacity': '0.8',
                            'position': 'absolute',
                            'height': '150px',
                            'width': '150px',
                            'z-index': '100'
                        })
                        .appendTo($('body'))
                        .animate({
                            'top': cart.offset().top + 10,
                            'left': cart.offset().left + 10,
                            'width': 75,
                            'height': 75
                        }, 1000);

                setTimeout(function () {
                    cart.effect("shake", {
                        times: 2,
                        distance: 150
                    }, 200);
                }, 1500);

                imgclone.animate({
                    'width': 0,
                    'height': 0
                }, function () {
                    $(this).detach()
                });
            }
        });

        $(document).on('click', '.majc-remove', function (e) {
            e.preventDefault();

            $('.majc-body').addClass('majc-loader');

            var cart_item_id = $(this).attr("data-cart_item_id"),
                    cart_item_key = $(this).attr("data-cart_item_key"),
                    product_container = $(this).parents('.majc-body');

            $.ajax({
                type: 'POST',
                dataType: 'json',
                url: ajaxUrl,
                data: {
                    action: "remove_item",
                    cart_item_id: cart_item_id,
                    cart_item_key: cart_item_key,
                    wp_nonce: wpNonce
                },
                success: function (response) {

                    if (!response || response.error) {
                        return;
                    }

                    var fragments = response.fragments;

                    // Replace fragments
                    if (fragments) {
                        $.each(fragments, function (key, value) {
                            $(key).replaceWith(value);
                        });
                    }

                    $('.majc-body').removeClass('majc-loader');
                }
            });
        });

        // Apply Discount Coupons
        $('body').find('.majc-coupon-submit').on('click', function (e) {
            e.preventDefault();
            var couponCode = jQuery("#majc-coupon-code").val();
            $.ajax({
                url: ajaxUrl,
                type: 'POST',
                data: {
                    action: "add_coupon_code",
                    couponCode: couponCode,
                    wp_nonce: wpNonce
                },
                success: function (response) {
                    $(".majc-cpn-resp").html(response.msg);
                    if (response.result == 'not valid' || response.result == 'already applied') {
                        $(".majc-cpn-resp").css({'background-color': '#e2401c', 'color': '#fff'});
                    } else {
                        $(".majc-cpn-resp").css({'background-color': '#0f834d', 'color': '#fff'});
                    }
                    $(".majc-cpn-resp").fadeIn().delay(2000).fadeOut();
                    $(document.body).trigger('wc_fragment_refresh');
                }
            });
        });

        // Remove Applied Discount Coupons
        $('body').on('click', '.majc-remove-cpn', function () {

            var couponCode = $(this).parent('li').attr('cpcode');

            $.ajax({
                url: ajaxUrl,
                type: 'POST',
                data: {
                    action: "remove_coupon_code",
                    couponCode: couponCode,
                    wp_nonce: wpNonce
                },
                success: function (response) {
                    $(".majc-cpn-resp").html(response);
                    $(".majc-cpn-resp").css({'background-color': '#0f834d', 'color': '#fff'});
                    $(".majc-cpn-resp").fadeIn().delay(2000).fadeOut();
                    $(document.body).trigger('wc_fragment_refresh');
                }
            });

        });

        /* Increment Cart Item Quantity */
        $("body").on("click", ".majc-qty-plus", function (e) {

            var input = $(this).closest('.majc-cart-items').find("input.majc-qty:not(:disabled)");

            if (input) {
                var pre = parseInt(input.val());
                input.val(pre + 1);
                input.trigger("change");
            }
        });

        /* Decrement Cart Item Quantity */
        $("body").on("click", ".majc-qty-minus", function (e) {

            var input = $(this).closest('.majc-cart-items').find("input.majc-qty:not(:disabled)");

            if (input) {
                var pre = parseInt(input.val()) - 1;

                // Do Nothing if Only 1 Item Left in Cart
                if (pre > 0) {
                    input.val(pre);
                    input.trigger("change");
                }
            }
        });

        // Quantity change 
        $('body').on('change', 'input[name="majc-qty-input"]', function () {

            var item_id = $(this).closest('.majc-cart-items').data('itemid');
            var qty = $(this).val();
            var ckey = $(this).closest('.majc-cart-items').data('ckey');

            $(this).prop('disabled', true);

            $.ajax({
                url: ajaxUrl,
                type: 'POST',
                data: 'action=change_item_qty&ckey=' + ckey + '&qty=' + qty + '&wp_nonce=' + wpNonce,
                success: function (response) {
                    $(this).prop('disabled', false);
                    $(document.body).trigger('wc_fragment_refresh');
                }
            });
        });

        $('body').find('.majc-coupons-lists-wrap h2').on('click', function () {
            $(this).parent().find('.majc-coupons-lists').slideToggle();
        });
    });

})(jQuery);