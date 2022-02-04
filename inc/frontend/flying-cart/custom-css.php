<style type="text/css">
<?php
$custom_css = '';
$custom_id = '#majc-main-wrapper-' . $post->ID;
$custom = isset($majc_settings['custom']) ? $majc_settings['custom'] : null;

if (majc_verify_settings($custom['trigger_btn_bg_color'])) {
    $custom_css .= "{$custom_id} .majc-toggle-button .majc-cartbasket-toggle-btn{background:{$custom['trigger_btn_bg_color']}}";
}

if (majc_verify_settings($custom['trigger_btn_hover_bg_color'])) {
    $custom_css .= "{$custom_id} .majc-toggle-button .majc-cartbasket-toggle-btn:hover{background:{$custom['trigger_btn_hover_bg_color']}}";
}

if (majc_verify_settings($custom['trigger_btn_font_color'])) {
    $custom_css .= "{$custom_id} .majc-toggle-button .majc-cartbasket-toggle-btn{color:{$custom['trigger_btn_font_color']}}";
}

if (majc_verify_settings($custom['trigger_btn_hover_font_color'])) {
    $custom_css .= "{$custom_id} .majc-toggle-button .majc-cartbasket-toggle-btn:hover{color:{$custom['trigger_btn_hover_font_color']}}";
}

if (majc_verify_settings($custom['cart_total_box_bg_color'])) {
    $custom_css .= "{$custom_id} .majc-item-count-wrap{background:{$custom['cart_total_box_bg_color']}}";
}

if (majc_verify_settings($custom['cart_total_box_text_color'])) {
    $custom_css .= "{$custom_id} .majc-item-count-wrap{color:{$custom['cart_total_box_text_color']}}";
}

$drawer_content_bg_type = isset($custom['drawer_content_bg_type']) && !empty($custom['drawer_content_bg_type']) ? $custom['drawer_content_bg_type'] : null;

if ($drawer_content_bg_type == 'choose_color' && majc_verify_settings($custom['drawer_content_bg_color'])) {
    $custom_css .= "{$custom_id}.majc-layout-slidein .majc-cart-popup{background-color:{$custom['drawer_content_bg_color']}}";
}

if ($drawer_content_bg_type == 'custom_image_bg' && majc_verify_settings($custom['drawer_content_bg_image'])) {
    $custom_css .= "{$custom_id}.majc-layout-slidein .majc-cart-popup{background-image:url({$custom['drawer_content_bg_image']}); background-size: cover;}";
}

if (majc_verify_settings($custom['default_text_color'])) {
    $custom_css .= "{$custom_id}.majc-layout-slidein .majc-cart-popup{color:{$custom['default_text_color']}}";
}

if (majc_verify_settings($custom['default_border_color'])) {
    $custom_css .= "{$custom_id} .majc-header .majc-sub-header, {$custom_id} .majc-header h2, {$custom_id}.majc-cartitem-list .majc-cart-items-inner, {$custom_id} .majc-coupon, {$custom_id} .majc-buy-summary, {$custom_id} .majc-buy-summary > div{border-color:{$custom['default_border_color']}}";
}

if (majc_verify_settings($custom['close_icon_color'])) {
    $custom_css .= "{$custom_id} .majc-header .majc-cart-close{color:{$custom['close_icon_color']}}";
}

if (majc_verify_settings($custom['close_bg_color'])) {
    $custom_css .= "{$custom_id} .majc-header .majc-cart-close{background:{$custom['close_bg_color']}}";
}

if (majc_verify_settings($custom['qty_change_btn_bg_color'])) {
    $custom_css .= "{$custom_id} .majc-item-qty .majc-qty-chng{background:{$custom['qty_change_btn_bg_color']}}";
}

if (majc_verify_settings($custom['qty_change_icon_color'])) {
    $custom_css .= "{$custom_id} .majc-item-qty .majc-qty-chng{color:{$custom['qty_change_icon_color']}}";
}

if (majc_verify_settings($custom['qty_change_border_color'])) {
    $custom_css .= "{$custom_id} .majc-item-qty, {$custom_id} .majc-item-qty .majc-qty[type=number]{border-color:{$custom['qty_change_border_color']}}";
}

if (majc_verify_settings($custom['coupon_btn_bg_color'])) {
    $custom_css .= "{$custom_id} .majc-coupon .majc-coupon-field .majc-coupon-submit{background:{$custom['coupon_btn_bg_color']}}";
    $custom_css .= "{$custom_id} .majc-coupon .majc-coupon-field{border-color:{$custom['coupon_btn_bg_color']}}";
}

if (majc_verify_settings($custom['coupon_btn_hover_bg_color'])) {
    $custom_css .= "{$custom_id} .majc-coupon .majc-coupon-field .majc-coupon-submit:hover{background:{$custom['coupon_btn_hover_bg_color']}}";
}

if (majc_verify_settings($custom['coupon_btn_font_color'])) {
    $custom_css .= "{$custom_id} .majc-coupon .majc-coupon-field .majc-coupon-submit{color:{$custom['coupon_btn_font_color']}}";
}

if (majc_verify_settings($custom['coupon_btn_hover_font_color'])) {
    $custom_css .= "{$custom_id} .majc-coupon .majc-coupon-field .majc-coupon-submit:hover{color:{$custom['coupon_btn_hover_font_color']}}";
}

if (majc_verify_settings($custom['continueshop_btn_bg_color'])) {
    $custom_css .= "{$custom_id} .majc-cart-action-btn-wrap .majc-button.majc-continue-shoping-btn{background:{$custom['continueshop_btn_bg_color']}}";
}

if (majc_verify_settings($custom['continueshop_btn_hover_bg_color'])) {
    $custom_css .= "{$custom_id} .majc-cart-action-btn-wrap .majc-button.majc-continue-shoping-btn:hover{background:{$custom['continueshop_btn_hover_bg_color']}}";
}

if (majc_verify_settings($custom['continueshop_btn_font_color'])) {
    $custom_css .= "{$custom_id} .majc-cart-action-btn-wrap .majc-button.majc-continue-shoping-btn{color:{$custom['continueshop_btn_font_color']}}";
}

if (majc_verify_settings($custom['continueshop_btn_hover_font_color'])) {
    $custom_css .= "{$custom_id} .majc-cart-action-btn-wrap .majc-button.majc-continue-shoping-btn:hover{color:{$custom['continueshop_btn_hover_font_color']}}";
}

if (majc_verify_settings($custom['continueshop_btn_normal_border_color'])) {
    $custom_css .= "{$custom_id} .majc-cart-action-btn-wrap .majc-button.majc-continue-shoping-btn{border-color:{$custom['continueshop_btn_normal_border_color']}}";
}

if (majc_verify_settings($custom['continueshop_btn_hover_border_color'])) {
    $custom_css .= "{$custom_id} .majc-cart-action-btn-wrap .majc-button.majc-continue-shoping-btn:hover{border-color:{$custom['continueshop_btn_hover_border_color']}}";
}

if (majc_verify_settings($custom['viewcart_btn_bg_color'])) {
    $custom_css .= "{$custom_id} .majc-cart-action-btn-wrap .majc-cart-checkout-btn .majc-button{background:{$custom['viewcart_btn_bg_color']}}";
}

if (majc_verify_settings($custom['viewcart_btn_hover_bg_color'])) {
    $custom_css .= "{$custom_id} .majc-cart-action-btn-wrap .majc-cart-checkout-btn .majc-button:hover{background:{$custom['viewcart_btn_hover_bg_color']}}";
}

if (majc_verify_settings($custom['viewcart_btn_font_color'])) {
    $custom_css .= "{$custom_id} .majc-cart-action-btn-wrap .majc-cart-checkout-btn .majc-button{color:{$custom['viewcart_btn_font_color']}}";
}

if (majc_verify_settings($custom['viewcart_btn_hover_font_color'])) {
    $custom_css .= "{$custom_id} .majc-cart-action-btn-wrap .majc-cart-checkout-btn .majc-button:hover{color:{$custom['viewcart_btn_hover_font_color']}}";
}

if (majc_verify_settings($custom['viewcart_btn_normal_border_color'])) {
    $custom_css .= "{$custom_id} .majc-cart-action-btn-wrap .majc-cart-checkout-btn .majc-button{border-color:{$custom['viewcart_btn_normal_border_color']}}";
}

if (majc_verify_settings($custom['viewcart_btn_hover_border_color'])) {
    $custom_css .= "{$custom_id} .majc-cart-action-btn-wrap .majc-cart-checkout-btn .majc-button:hover{border-color:{$custom['viewcart_btn_hover_border_color']}}";
}

if (majc_verify_settings($custom['remove_product_btn_bg_color'])) {
    $custom_css .= "{$custom_id}.majc-cartitem-grid .majc-cart-items-inner .majc-item-remove a{background:{$custom['remove_product_btn_bg_color']}}";
}

if (majc_verify_settings($custom['remove_product_btn_font_color'])) {
    $custom_css .= "{$custom_id}.majc-cartitem-grid .majc-cart-items-inner .majc-item-remove a{color:{$custom['remove_product_btn_font_color']}}";
}

$custom_css .= majc_typography_css($custom, 'header_title', $custom_id . ' .majc-header h2');
$custom_css .= majc_typography_css($custom, 'content', $custom_id . '.majc-layout-slidein .majc-cart-popup');
$custom_css .= majc_typography_css($custom, 'product_title', $custom_id . ' .majc-cart-items-inner .majc-item-name');
$custom_css .= majc_typography_css($custom, 'button_text', $custom_id . ' .majc-cart-action-btn-wrap .majc-button');
echo $custom_css;
?>
</style>