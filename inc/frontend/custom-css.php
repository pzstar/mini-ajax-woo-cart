<style type="text/css">
    <?php
    $majc_custom_css = '';
    $majc_custom_id = '#majc-main-wrapper-' . $post->ID;
    $majc_custom = isset($majc_settings['custom']) ? $majc_settings['custom'] : null;

    if (isset($majc_custom['trigger_btn_bg_color']) && !empty($majc_custom['trigger_btn_bg_color'])) {
        $majc_custom_css .= "{$majc_custom_id} .majc-toggle-button .majc-cartbasket-toggle-btn{background:{$majc_custom['trigger_btn_bg_color']}}";
    }

    if (isset($majc_custom['trigger_btn_hover_bg_color']) && !empty($majc_custom['trigger_btn_hover_bg_color'])) {
        $majc_custom_css .= "{$majc_custom_id} .majc-toggle-button .majc-cartbasket-toggle-btn:hover{background:{$majc_custom['trigger_btn_hover_bg_color']}}";
    }

    if (isset($majc_custom['trigger_btn_font_color']) && !empty($majc_custom['trigger_btn_font_color'])) {
        $majc_custom_css .= "{$majc_custom_id} .majc-toggle-button .majc-cartbasket-toggle-btn{color:{$majc_custom['trigger_btn_font_color']}}";
    }

    if (isset($majc_custom['trigger_btn_hover_font_color']) && !empty($majc_custom['trigger_btn_hover_font_color'])) {
        $majc_custom_css .= "{$majc_custom_id} .majc-toggle-button .majc-cartbasket-toggle-btn:hover{color:{$majc_custom['trigger_btn_hover_font_color']}}";
    }

    if (isset($majc_custom['cart_total_box_bg_color']) && !empty($majc_custom['cart_total_box_bg_color'])) {
        $majc_custom_css .= "{$majc_custom_id} .majc-item-count-wrap{background:{$majc_custom['cart_total_box_bg_color']}}";
    }

    if (isset($majc_custom['cart_total_box_text_color']) && !empty($majc_custom['cart_total_box_text_color'])) {
        $majc_custom_css .= "{$majc_custom_id} .majc-item-count-wrap{color:{$majc_custom['cart_total_box_text_color']}}";
    }

    $majc_drawer_content_bg_type = isset($majc_custom['drawer_content_bg_type']) && !empty($majc_custom['drawer_content_bg_type']) ? $majc_custom['drawer_content_bg_type'] : null;

    if ($majc_drawer_content_bg_type == 'choose_color' && isset($majc_custom['drawer_content_bg_color']) && !empty($majc_custom['drawer_content_bg_color'])) {
        $majc_custom_css .= "{$majc_custom_id}.majc-layout-slidein .majc-cart-popup{background-color:{$majc_custom['drawer_content_bg_color']}}";
    }

    if ($majc_drawer_content_bg_type == 'custom_image_bg' && isset($majc_custom['drawer_content_bg_image']) && !empty($majc_custom['drawer_content_bg_image'])) {
        $majc_custom_css .= "{$majc_custom_id}.majc-layout-slidein .majc-cart-popup{background-image:url({$majc_custom['drawer_content_bg_image']}); background-size: cover;}";
    }

    if (isset($majc_custom['default_text_color']) && !empty($majc_custom['default_text_color'])) {
        $majc_custom_css .= "{$majc_custom_id}.majc-layout-slidein .majc-cart-popup{color:{$majc_custom['default_text_color']}}";
    }

    if (isset($majc_custom['default_border_color']) && !empty($majc_custom['default_border_color'])) {
        $majc_custom_css .= "{$majc_custom_id} .majc-header .majc-sub-header, {$majc_custom_id} .majc-header h2, {$majc_custom_id}.majc-cartitem-list .majc-cart-items-inner, {$majc_custom_id} .majc-coupon, {$majc_custom_id} .majc-buy-summary, {$majc_custom_id} .majc-buy-summary > div, {$majc_custom_id} .majc-applied-cpns li, {$majc_custom_id}.majc-cartitem-grid .majc-cart-items-inner, {$majc_custom_id} .majc-coupon .majc-coupon-field{border-color:{$majc_custom['default_border_color']}}";
    }

    if (isset($majc_custom['close_icon_color']) && !empty($majc_custom['close_icon_color'])) {
        $majc_custom_css .= "{$majc_custom_id} .majc-header .majc-cart-close{color:{$majc_custom['close_icon_color']}}";
    }

    if (isset($majc_custom['close_bg_color']) && !empty($majc_custom['close_bg_color'])) {
        $majc_custom_css .= "{$majc_custom_id} .majc-header .majc-cart-close{background:{$majc_custom['close_bg_color']}}";
    }

    if (isset($majc_custom['qty_change_btn_bg_color']) && !empty($majc_custom['qty_change_btn_bg_color'])) {
        $majc_custom_css .= "{$majc_custom_id} .majc-item-qty .majc-qty-chng{background:{$majc_custom['qty_change_btn_bg_color']}}";
    }

    if (isset($majc_custom['qty_change_icon_color']) && !empty($majc_custom['qty_change_icon_color'])) {
        $majc_custom_css .= "{$majc_custom_id} .majc-item-qty .majc-qty-chng{color:{$majc_custom['qty_change_icon_color']}}";
    }

    if (isset($majc_custom['qty_change_border_color']) && !empty($majc_custom['qty_change_border_color'])) {
        $majc_custom_css .= "{$majc_custom_id} .majc-item-qty, {$majc_custom_id} .majc-item-qty .majc-qty[type=number]{border-color:{$majc_custom['qty_change_border_color']}}";
    }

    if (isset($majc_custom['coupon_btn_bg_color']) && !empty($majc_custom['coupon_btn_bg_color'])) {
        $majc_custom_css .= "{$majc_custom_id} .majc-coupon .majc-coupon-field .majc-coupon-submit{background:{$majc_custom['coupon_btn_bg_color']}}";
        $majc_custom_css .= "{$majc_custom_id} .majc-coupon .majc-coupon-field{border-color:{$majc_custom['coupon_btn_bg_color']}}";
    }

    if (isset($majc_custom['coupon_btn_hover_bg_color']) && !empty($majc_custom['coupon_btn_hover_bg_color'])) {
        $majc_custom_css .= "{$majc_custom_id} .majc-coupon .majc-coupon-field .majc-coupon-submit:hover{background:{$majc_custom['coupon_btn_hover_bg_color']}}";
    }

    if (isset($majc_custom['coupon_btn_font_color']) && !empty($majc_custom['coupon_btn_font_color'])) {
        $majc_custom_css .= "{$majc_custom_id} .majc-coupon .majc-coupon-field .majc-coupon-submit{color:{$majc_custom['coupon_btn_font_color']}}";
    }

    if (isset($majc_custom['coupon_btn_hover_font_color']) && !empty($majc_custom['coupon_btn_hover_font_color'])) {
        $majc_custom_css .= "{$majc_custom_id} .majc-coupon .majc-coupon-field .majc-coupon-submit:hover{color:{$majc_custom['coupon_btn_hover_font_color']}}";
    }

    if (isset($majc_custom['continueshop_btn_bg_color']) && !empty($majc_custom['continueshop_btn_bg_color'])) {
        $majc_custom_css .= "{$majc_custom_id} .majc-cart-action-btn-wrap .majc-button.majc-continue-shoping-btn{background:{$majc_custom['continueshop_btn_bg_color']}}";
    }

    if (isset($majc_custom['continueshop_btn_hover_bg_color']) && !empty($majc_custom['continueshop_btn_hover_bg_color'])) {
        $majc_custom_css .= "{$majc_custom_id} .majc-cart-action-btn-wrap .majc-button.majc-continue-shoping-btn:hover{background:{$majc_custom['continueshop_btn_hover_bg_color']}}";
    }

    if (isset($majc_custom['continueshop_btn_font_color']) && !empty($majc_custom['continueshop_btn_font_color'])) {
        $majc_custom_css .= "{$majc_custom_id} .majc-cart-action-btn-wrap .majc-button.majc-continue-shoping-btn{color:{$majc_custom['continueshop_btn_font_color']}}";
    }

    if (isset($majc_custom['continueshop_btn_hover_font_color']) && !empty($majc_custom['continueshop_btn_hover_font_color'])) {
        $majc_custom_css .= "{$majc_custom_id} .majc-cart-action-btn-wrap .majc-button.majc-continue-shoping-btn:hover{color:{$majc_custom['continueshop_btn_hover_font_color']}}";
    }

    if (isset($majc_custom['continueshop_btn_normal_border_color']) && !empty($majc_custom['continueshop_btn_normal_border_color'])) {
        $majc_custom_css .= "{$majc_custom_id} .majc-cart-action-btn-wrap .majc-button.majc-continue-shoping-btn{border-color:{$majc_custom['continueshop_btn_normal_border_color']}}";
    }

    if (isset($majc_custom['continueshop_btn_hover_border_color']) && !empty($majc_custom['continueshop_btn_hover_border_color'])) {
        $majc_custom_css .= "{$majc_custom_id} .majc-cart-action-btn-wrap .majc-button.majc-continue-shoping-btn:hover{border-color:{$majc_custom['continueshop_btn_hover_border_color']}}";
    }

    if (isset($majc_custom['viewcart_btn_bg_color']) && !empty($majc_custom['viewcart_btn_bg_color'])) {
        $majc_custom_css .= "{$majc_custom_id} .majc-cart-action-btn-wrap .majc-cart-checkout-btn .majc-button{background:{$majc_custom['viewcart_btn_bg_color']}}";
    }

    if (isset($majc_custom['viewcart_btn_hover_bg_color']) && !empty($majc_custom['viewcart_btn_hover_bg_color'])) {
        $majc_custom_css .= "{$majc_custom_id} .majc-cart-action-btn-wrap .majc-cart-checkout-btn .majc-button:hover{background:{$majc_custom['viewcart_btn_hover_bg_color']}}";
    }

    if (isset($majc_custom['viewcart_btn_font_color']) && !empty($majc_custom['viewcart_btn_font_color'])) {
        $majc_custom_css .= "{$majc_custom_id} .majc-cart-action-btn-wrap .majc-cart-checkout-btn .majc-button{color:{$majc_custom['viewcart_btn_font_color']}}";
    }

    if (isset($majc_custom['viewcart_btn_hover_font_color']) && !empty($majc_custom['viewcart_btn_hover_font_color'])) {
        $majc_custom_css .= "{$majc_custom_id} .majc-cart-action-btn-wrap .majc-cart-checkout-btn .majc-button:hover{color:{$majc_custom['viewcart_btn_hover_font_color']}}";
    }

    if (isset($majc_custom['viewcart_btn_normal_border_color']) && !empty($majc_custom['viewcart_btn_normal_border_color'])) {
        $majc_custom_css .= "{$majc_custom_id} .majc-cart-action-btn-wrap .majc-cart-checkout-btn .majc-button{border-color:{$majc_custom['viewcart_btn_normal_border_color']}}";
    }

    if (isset($majc_custom['viewcart_btn_hover_border_color']) && !empty($majc_custom['viewcart_btn_hover_border_color'])) {
        $majc_custom_css .= "{$majc_custom_id} .majc-cart-action-btn-wrap .majc-cart-checkout-btn .majc-button:hover{border-color:{$majc_custom['viewcart_btn_hover_border_color']}}";
    }

    if (isset($majc_custom['remove_product_btn_bg_color']) && !empty($majc_custom['remove_product_btn_bg_color'])) {
        $majc_custom_css .= "{$majc_custom_id}.majc-cartitem-grid .majc-cart-items-inner .majc-item-remove a{background:{$majc_custom['remove_product_btn_bg_color']}}";
    }

    if (isset($majc_custom['remove_product_btn_font_color']) && !empty($majc_custom['remove_product_btn_font_color'])) {
        $majc_custom_css .= "{$majc_custom_id}.majc-cartitem-grid .majc-cart-items-inner .majc-item-remove a{color:{$majc_custom['remove_product_btn_font_color']}}";
    }

    $majc_custom_css .= majc_typography_css($majc_custom, 'header_title', $majc_custom_id . ' .majc-header h2');
    $majc_custom_css .= majc_typography_css($majc_custom, 'content', $majc_custom_id . '.majc-layout-slidein .majc-cart-popup');
    $majc_custom_css .= majc_typography_css($majc_custom, 'product_title', $majc_custom_id . ' .majc-cart-items-inner .majc-item-name');
    $majc_custom_css .= majc_typography_css($majc_custom, 'button_text', $majc_custom_id . ' .majc-cart-action-btn-wrap .majc-button');
    echo $majc_custom_css;
    ?>
</style>