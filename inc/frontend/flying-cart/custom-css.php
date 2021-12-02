<?php  
// Custom Settings
$custom = isset($majc_settings['custom']) ? $majc_settings['custom'] : null;

// Header Title Typography
$header_title_font_family = isset($custom['header_title_font_family']) ? esc_attr($custom['header_title_font_family']) : '';
if( !empty($header_title_font_family) ) {
	if($this->is_standard_font($header_title_font_family) === 'google') {
		$header_title_font_family = preg_replace('/\s+/', '+', $header_title_font_family);
		$header_title_font_id = str_replace('+', '-', $header_title_font_family);
		wp_enqueue_style($header_title_font_id,"https://fonts.googleapis.com/css?family=".esc_attr($header_title_font_family), array(), MAJC_VERSION);
		$header_title_font_family = str_replace('+',' ',$header_title_font_family);
	}
}
$header_title_font_style = isset($custom['header_title_font_style']) ? $custom['header_title_font_style'] : '';
$header_title_text_transform = isset($custom['header_title_text_transform']) ? $custom['header_title_text_transform'] : '';
$header_title_text_decoration = isset($custom['header_title_text_decoration']) ? $custom['header_title_text_decoration'] : '';
$header_title_font_size = isset($custom['header_title_font_size']) && $custom['header_title_font_size'] != 0  ? $custom['header_title_font_size'] : '16';
$header_title_line_height = isset($custom['header_title_line_height']) && $custom['header_title_line_height'] != 0 ? $custom['header_title_line_height'] : '1.2';
$header_title_letter_spacing = isset($custom['header_title_letter_spacing']) && $custom['header_title_letter_spacing'] != 0 ? $custom['header_title_letter_spacing'] : '1';
$header_title_font_color = isset($custom['header_title_font_color']) ? $custom['header_title_font_color'] : null;

// Summary Label Typography
$summary_label_font_family = isset($custom['summary_label_font_family']) ? esc_attr($custom['summary_label_font_family']) : '';
if( !empty($summary_label_font_family) ) {
	if($this->is_standard_font($summary_label_font_family) === 'google') {
		$summary_label_font_family = preg_replace('/\s+/', '+', $summary_label_font_family);
		$summary_label_font_id = str_replace('+', '-', $summary_label_font_family);
		wp_enqueue_style($summary_label_font_id,"https://fonts.googleapis.com/css?family=".esc_attr($summary_label_font_family), array(), MAJC_VERSION);
		$summary_label_font_family = str_replace('+',' ',$summary_label_font_family);
	}
}
$summary_label_font_style = isset($custom['summary_label_font_style']) ? $custom['summary_label_font_style'] : '';
$summary_label_text_transform = isset($custom['summary_label_text_transform']) ? $custom['summary_label_text_transform'] : '';
$summary_label_text_decoration = isset($custom['summary_label_text_decoration']) ? $custom['summary_label_text_decoration'] : '';
$summary_label_font_size = isset($custom['summary_label_font_size']) && $custom['summary_label_font_size'] != 0  ? $custom['summary_label_font_size'] : '16';
$summary_label_line_height = isset($custom['summary_label_line_height']) && $custom['summary_label_line_height'] != 0 ? $custom['summary_label_line_height'] : '1.2';
$summary_label_letter_spacing = isset($custom['summary_label_letter_spacing']) && $custom['summary_label_letter_spacing'] != 0 ? $custom['summary_label_letter_spacing'] : '1';
$summary_label_font_color = isset($custom['summary_label_font_color']) ? $custom['summary_label_font_color'] : null;

$summary_border_color = isset($custom['summary_border_color']) ? $custom['summary_border_color'] : null;

// Shipping Title Typography
$shipping_title_font_family = isset($custom['shipping_title_font_family']) ? esc_attr($custom['shipping_title_font_family']) : '';
if( !empty($shipping_title_font_family) ) {
	if($this->is_standard_font($shipping_title_font_family) === 'google') {
		$shipping_title_font_family = preg_replace('/\s+/', '+', $shipping_title_font_family);
		$shipping_title_font_id = str_replace('+', '-', $shipping_title_font_family);
		wp_enqueue_style($shipping_title_font_id,"https://fonts.googleapis.com/css?family=".esc_attr($shipping_title_font_family), array(), MAJC_VERSION);
		$shipping_title_font_family = str_replace('+',' ',$shipping_title_font_family);
	}
}
$shipping_title_font_style = isset($custom['shipping_title_font_style']) ? $custom['shipping_title_font_style'] : '';
$shipping_title_text_transform = isset($custom['shipping_title_text_transform']) ? $custom['shipping_title_text_transform'] : '';
$shipping_title_text_decoration = isset($custom['shipping_title_text_decoration']) ? $custom['shipping_title_text_decoration'] : '';
$shipping_title_font_size = isset($custom['shipping_title_font_size']) && $custom['shipping_title_font_size'] != 0  ? $custom['shipping_title_font_size'] : '16';
$shipping_title_line_height = isset($custom['shipping_title_line_height']) && $custom['shipping_title_line_height'] != 0 ? $custom['shipping_title_line_height'] : '1.2';
$shipping_title_letter_spacing = isset($custom['shipping_title_letter_spacing']) && $custom['shipping_title_letter_spacing'] != 0 ? $custom['shipping_title_letter_spacing'] : '1';
$shipping_title_font_color = isset($custom['shipping_title_font_color']) ? $custom['shipping_title_font_color'] : null;

// Button Text Typography
$button_text_font_family = isset($custom['button_text_font_family']) ? esc_attr($custom['button_text_font_family']) : '';
if( !empty($button_text_font_family) ) {
	if($this->is_standard_font($button_text_font_family) === 'google') {
		$button_text_font_family = preg_replace('/\s+/', '+', $button_text_font_family);
		$button_text_font_id = str_replace('+', '-', $button_text_font_family);
		wp_enqueue_style($button_text_font_id,"https://fonts.googleapis.com/css?family=".esc_attr($button_text_font_family), array(), MAJC_VERSION);
		$button_text_font_family = str_replace('+',' ',$button_text_font_family);
	}
}
$button_text_font_style = isset($custom['button_text_font_style']) ? $custom['button_text_font_style'] : '';
$button_text_text_transform = isset($custom['button_text_text_transform']) ? $custom['button_text_text_transform'] : '';
$button_text_text_decoration = isset($custom['button_text_text_decoration']) ? $custom['button_text_text_decoration'] : '';
$button_text_font_size = isset($custom['button_text_font_size']) && $custom['button_text_font_size'] != 0  ? $custom['button_text_font_size'] : '16';
$button_text_line_height = isset($custom['button_text_line_height']) && $custom['button_text_line_height'] != 0 ? $custom['button_text_line_height'] : '1.2';
$button_text_letter_spacing = isset($custom['button_text_letter_spacing']) && $custom['button_text_letter_spacing'] != 0 ? $custom['button_text_letter_spacing'] : '1';

$coupon_btn_bg_color = isset($custom['coupon_btn_bg_color']) ? $custom['coupon_btn_bg_color'] : null;
$coupon_btn_hover_bg_color = isset($custom['coupon_btn_hover_bg_color']) ? $custom['coupon_btn_hover_bg_color'] : null;
$coupon_btn_font_color = isset($custom['coupon_btn_font_color']) ? $custom['coupon_btn_font_color'] : null;
$coupon_btn_hover_font_color = isset($custom['coupon_btn_hover_font_color']) ? $custom['coupon_btn_hover_font_color'] : null;

$continueshop_btn_bg_color = isset($custom['continueshop_btn_bg_color']) ? $custom['continueshop_btn_bg_color'] : null;
$continueshop_btn_hover_bg_color = isset($custom['continueshop_btn_hover_bg_color']) ? $custom['continueshop_btn_hover_bg_color'] : null;
$continueshop_btn_font_color = isset($custom['continueshop_btn_font_color']) ? $custom['continueshop_btn_font_color'] : null;
$continueshop_btn_hover_font_color = isset($custom['continueshop_btn_hover_font_color']) ? $custom['continueshop_btn_hover_font_color'] : null;
$continueshop_btn_normal_border_color = isset($custom['continueshop_btn_normal_border_color']) ? $custom['continueshop_btn_normal_border_color'] : null;
$continueshop_btn_hover_border_color = isset($custom['continueshop_btn_hover_border_color']) ? $custom['continueshop_btn_hover_border_color'] : null;

$viewcart_btn_bg_color = isset($custom['viewcart_btn_bg_color']) ? $custom['viewcart_btn_bg_color'] : null;
$viewcart_btn_hover_bg_color = isset($custom['viewcart_btn_hover_bg_color']) ? $custom['viewcart_btn_hover_bg_color'] : null;
$viewcart_btn_font_color = isset($custom['viewcart_btn_font_color']) ? $custom['viewcart_btn_font_color'] : null;
$viewcart_btn_hover_font_color = isset($custom['viewcart_btn_hover_font_color']) ? $custom['viewcart_btn_hover_font_color'] : null;
$viewcart_btn_normal_border_color = isset($custom['viewcart_btn_normal_border_color']) ? $custom['viewcart_btn_normal_border_color'] : null;
$viewcart_btn_hover_border_color = isset($custom['viewcart_btn_hover_border_color']) ? $custom['viewcart_btn_hover_border_color'] : null;

$checkout_btn_bg_color = isset($custom['checkout_btn_bg_color']) ? $custom['checkout_btn_bg_color'] : null;
$checkout_btn_hover_bg_color = isset($custom['checkout_btn_hover_bg_color']) ? $custom['checkout_btn_hover_bg_color'] : null;
$checkout_btn_font_color = isset($custom['checkout_btn_font_color']) ? $custom['checkout_btn_font_color'] : null;
$checkout_btn_hover_font_color = isset($custom['checkout_btn_hover_font_color']) ? $custom['checkout_btn_hover_font_color'] : null;
$checkout_btn_normal_border_color = isset($custom['checkout_btn_normal_border_color']) ? $custom['checkout_btn_normal_border_color'] : null;
$checkout_btn_hover_border_color = isset($custom['checkout_btn_hover_border_color']) ? $custom['checkout_btn_hover_border_color'] : null;

$available_coupons_bg_color = isset($custom['available_coupons_bg_color']) ? $custom['available_coupons_bg_color'] : null;
$available_coupons_hover_bg_color = isset($custom['available_coupons_hover_bg_color']) ? $custom['available_coupons_hover_bg_color'] : null;
$available_coupons_font_color = isset($custom['available_coupons_font_color']) ? $custom['available_coupons_font_color'] : null;
$available_coupons_hover_font_color = isset($custom['available_coupons_hover_font_color']) ? $custom['available_coupons_hover_font_color'] : null;
$available_coupons_border_color = isset($custom['available_coupons_border_color']) ? $custom['available_coupons_border_color'] : null;
$available_coupons_hover_border_color = isset($custom['available_coupons_hover_border_color']) ? $custom['available_coupons_hover_border_color'] : null;

$trigger_btn_bg_color = isset($custom['trigger_btn_bg_color']) ? $custom['trigger_btn_bg_color'] : null;
$trigger_btn_hover_bg_color = isset($custom['trigger_btn_hover_bg_color']) ? $custom['trigger_btn_hover_bg_color'] : null;
$trigger_btn_font_color = isset($custom['trigger_btn_font_color']) ? $custom['trigger_btn_font_color'] : null;
$trigger_btn_hover_font_color = isset($custom['trigger_btn_hover_font_color']) ? $custom['trigger_btn_hover_font_color'] : null;
$cart_total_box_bg_color = isset($custom['cart_total_box_bg_color']) ? $custom['cart_total_box_bg_color'] : null;
$cart_total_box_text_color = isset($custom['cart_total_box_text_color']) ? $custom['cart_total_box_text_color'] : null;

// Added Product Title Typography
$added_product_title_font_family = isset($custom['added_product_title_font_family']) ? esc_attr($custom['added_product_title_font_family']) : '';
if( !empty($added_product_title_font_family) ) {
	if($this->is_standard_font($added_product_title_font_family) === 'google') {
		$added_product_title_font_family = preg_replace('/\s+/', '+', $added_product_title_font_family);
		$added_product_title_font_id = str_replace('+', '-', $added_product_title_font_family);
		wp_enqueue_style($added_product_title_font_id,"https://fonts.googleapis.com/css?family=".esc_attr($added_product_title_font_family), array(), MAJC_VERSION);
		$added_product_title_font_family = str_replace('+',' ',$added_product_title_font_family);
	}
}
$added_product_title_font_style = isset($custom['added_product_title_font_style']) ? $custom['added_product_title_font_style'] : '';
$added_product_title_text_transform = isset($custom['added_product_title_text_transform']) ? $custom['added_product_title_text_transform'] : '';
$added_product_title_text_decoration = isset($custom['added_product_title_text_decoration']) ? $custom['added_product_title_text_decoration'] : '';
$added_product_title_font_size = isset($custom['added_product_title_font_size']) && $custom['added_product_title_font_size'] != 0  ? $custom['added_product_title_font_size'] : '16';
$added_product_title_line_height = isset($custom['added_product_title_line_height']) && $custom['added_product_title_line_height'] != 0 ? $custom['added_product_title_line_height'] : '1.2';
$added_product_title_letter_spacing = isset($custom['added_product_title_letter_spacing']) && $custom['added_product_title_letter_spacing'] != 0 ? $custom['added_product_title_letter_spacing'] : '1';
$added_product_title_font_color = isset($custom['added_product_title_font_color']) ? $custom['added_product_title_font_color'] : null;

// Added Product Price Typography
$added_product_price_font_family = isset($custom['added_product_price_font_family']) ? esc_attr($custom['added_product_price_font_family']) : '';
if( !empty($added_product_price_font_family) ) {
	if($this->is_standard_font($added_product_price_font_family) === 'google') {
		$added_product_price_font_family = preg_replace('/\s+/', '+', $added_product_price_font_family);
		$added_product_price_font_id = str_replace('+', '-', $added_product_price_font_family);
		wp_enqueue_style($added_product_price_font_id,"https://fonts.googleapis.com/css?family=".esc_attr($added_product_price_font_family), array(), MAJC_VERSION);
		$added_product_price_font_family = str_replace('+',' ',$added_product_price_font_family);
	}
}
$added_product_price_font_style = isset($custom['added_product_price_font_style']) ? $custom['added_product_price_font_style'] : '';
$added_product_price_text_transform = isset($custom['added_product_price_text_transform']) ? $custom['added_product_price_text_transform'] : '';
$added_product_price_text_decoration = isset($custom['added_product_price_text_decoration']) ? $custom['added_product_price_text_decoration'] : '';
$added_product_price_font_size = isset($custom['added_product_price_font_size']) && $custom['added_product_price_font_size'] != 0  ? $custom['added_product_price_font_size'] : '16';
$added_product_price_line_height = isset($custom['added_product_price_line_height']) && $custom['added_product_price_line_height'] != 0 ? $custom['added_product_price_line_height'] : '1.2';
$added_product_price_letter_spacing = isset($custom['added_product_price_letter_spacing']) && $custom['added_product_price_letter_spacing'] != 0 ? $custom['added_product_price_letter_spacing'] : '1';
$added_product_price_font_color = isset($custom['added_product_price_font_color']) ? $custom['added_product_price_font_color'] : null;


// Summary Price Typography
$summary_price_font_family = isset($custom['summary_price_font_family']) ? esc_attr($custom['summary_price_font_family']) : '';
if( !empty($summary_price_font_family) ) {
	if($this->is_standard_font($summary_price_font_family) === 'google') {
		$summary_price_font_family = preg_replace('/\s+/', '+', $summary_price_font_family);
		$summary_price_font_id = str_replace('+', '-', $summary_price_font_family);
		wp_enqueue_style($summary_price_font_id,"https://fonts.googleapis.com/css?family=".esc_attr($summary_price_font_family), array(), MAJC_VERSION);
		$summary_price_font_family = str_replace('+',' ',$summary_price_font_family);
	}
}
$summary_price_font_style = isset($custom['summary_price_font_style']) ? $custom['summary_price_font_style'] : '';
$summary_price_text_transform = isset($custom['summary_price_text_transform']) ? $custom['summary_price_text_transform'] : '';
$summary_price_text_decoration = isset($custom['summary_price_text_decoration']) ? $custom['summary_price_text_decoration'] : '';
$summary_price_font_size = isset($custom['summary_price_font_size']) && $custom['summary_price_font_size'] != 0  ? $custom['summary_price_font_size'] : '16';
$summary_price_line_height = isset($custom['summary_price_line_height']) && $custom['summary_price_line_height'] != 0 ? $custom['summary_price_line_height'] : '1.2';
$summary_price_letter_spacing = isset($custom['summary_price_letter_spacing']) && $custom['summary_price_letter_spacing'] != 0 ? $custom['summary_price_letter_spacing'] : '1';
$summary_price_font_color = isset($custom['summary_price_font_color']) ? $custom['summary_price_font_color'] : null;

// Header Item Count Typography
$header_item_count_font_family = isset($custom['header_item_count_font_family']) ? esc_attr($custom['header_item_count_font_family']) : '';
if( !empty($header_item_count_font_family) ) {
	if($this->is_standard_font($header_item_count_font_family) === 'google') {
		$header_item_count_font_family = preg_replace('/\s+/', '+', $header_item_count_font_family);
		$header_item_count_font_id = str_replace('+', '-', $header_item_count_font_family);
		wp_enqueue_style($header_item_count_font_id,"https://fonts.googleapis.com/css?family=".esc_attr($header_item_count_font_family), array(), MAJC_VERSION);
		$header_item_count_font_family = str_replace('+',' ',$header_item_count_font_family);
	}
}
$header_item_count_font_style = isset($custom['header_item_count_font_style']) ? $custom['header_item_count_font_style'] : '';
$header_item_count_text_transform = isset($custom['header_item_count_text_transform']) ? $custom['header_item_count_text_transform'] : '';
$header_item_count_text_decoration = isset($custom['header_item_count_text_decoration']) ? $custom['header_item_count_text_decoration'] : '';
$header_item_count_font_size = isset($custom['header_item_count_font_size']) && $custom['header_item_count_font_size'] != 0  ? $custom['header_item_count_font_size'] : '16';
$header_item_count_line_height = isset($custom['header_item_count_line_height']) && $custom['header_item_count_line_height'] != 0 ? $custom['header_item_count_line_height'] : '1.2';
$header_item_count_letter_spacing = isset($custom['header_item_count_letter_spacing']) && $custom['header_item_count_letter_spacing'] != 0 ? $custom['header_item_count_letter_spacing'] : '1';
$header_item_count_font_color = isset($custom['header_item_count_font_color']) ? $custom['header_item_count_font_color'] : null;

// Remove Product Button
$remove_product_btn_bg_color = isset($custom['remove_product_btn_bg_color']) ? $custom['remove_product_btn_bg_color'] : null;
$remove_product_btn_font_color = isset($custom['remove_product_btn_font_color']) ? $custom['remove_product_btn_font_color'] : null;

// Available Coupon Color
$discount_offer_bg_color = isset($custom['discount_offer_bg_color']) ? $custom['discount_offer_bg_color'] : null;
$discount_offer_font_color = isset($custom['discount_offer_font_color']) ? $custom['discount_offer_font_color'] : null;
$coupon_code_bg_color = isset($custom['coupon_code_bg_color']) ? $custom['coupon_code_bg_color'] : null;
$coupon_code_font_color = isset($custom['coupon_code_font_color']) ? $custom['coupon_code_font_color'] : null;

// Extra Custom Settings
$close_icon_color = isset($custom['close_icon_color']) ? $custom['close_icon_color'] : null;
$default_border_color = isset($custom['default_border_color']) ? $custom['default_border_color'] : null;
$qty_change_btn_bg_color = isset($custom['qty_change_btn_bg_color']) ? $custom['qty_change_btn_bg_color'] : null;
$qty_change_icon_color = isset($custom['qty_change_icon_color']) ? $custom['qty_change_icon_color'] : null;
?>

<style type="text/css">
<?php if(isset($coupon_btn_bg_color) && !empty($coupon_btn_bg_color)) { ?>
.majc-button.majc-coupon-submit {
	background: <?php echo esc_attr( $coupon_btn_bg_color ); ?> !important;
}
<?php } ?>

<?php if(isset($coupon_btn_hover_bg_color) && !empty($coupon_btn_hover_bg_color)) { ?>
.majc-button.majc-coupon-submit:hover {
	background: <?php echo esc_attr($coupon_btn_hover_bg_color); ?> !important;
}
<?php } ?>

<?php if(isset($coupon_btn_font_color) && !empty($coupon_btn_font_color)) { ?>
.majc-button.majc-coupon-submit {
	color: <?php echo esc_attr($coupon_btn_font_color); ?> !important;
}
<?php } ?>

<?php if(isset($coupon_btn_hover_font_color) && !empty($coupon_btn_hover_font_color)) { ?>
.majc-button.majc-coupon-submit:hover {
	color: <?php echo esc_attr($coupon_btn_hover_font_color); ?> !important;
}
<?php } ?>

/*Continue Shop*/
<?php if(isset($continueshop_btn_bg_color) && !empty($continueshop_btn_bg_color)) { ?>
.majc-button.majc-continue-shoping-btn {
	background: <?php echo esc_attr($continueshop_btn_bg_color); ?> !important;
}
<?php } ?>

<?php if(isset($continueshop_btn_hover_bg_color) && !empty($continueshop_btn_hover_bg_color)) { ?>
.majc-button.majc-continue-shoping-btn:hover {
	background: <?php echo esc_attr($continueshop_btn_hover_bg_color); ?> !important;
}
<?php } ?>

<?php if(isset($continueshop_btn_font_color) && !empty($continueshop_btn_font_color)) { ?>
.majc-button.majc-continue-shoping-btn {
	color: <?php echo esc_attr($continueshop_btn_font_color); ?> !important;
}
<?php } ?>

<?php if(isset($continueshop_btn_hover_font_color) && !empty($continueshop_btn_hover_font_color)) { ?>
.majc-button.majc-continue-shoping-btn:hover {
	color: <?php echo esc_attr($continueshop_btn_hover_font_color); ?> !important;
}
<?php } ?>

<?php if(isset($continueshop_btn_normal_border_color) && !empty($continueshop_btn_normal_border_color)) { ?>
.majc-button.majc-continue-shoping-btn {
	border: 1px solid <?php echo esc_attr($continueshop_btn_normal_border_color); ?> !important;
}
<?php } ?>

<?php if(isset($continueshop_btn_hover_border_color) && !empty($continueshop_btn_hover_border_color)) { ?>
.majc-button.majc-continue-shoping-btn:hover {
	border: 1px solid <?php echo esc_attr($continueshop_btn_hover_border_color); ?> !important;
}
<?php } ?>

/*View Cart*/
<?php if(isset($viewcart_btn_bg_color) && !empty($viewcart_btn_bg_color)) { ?>
.majc-button.majc-view-cart-btn {
	background: <?php echo esc_attr($viewcart_btn_bg_color); ?> !important;
}
<?php } ?>

<?php if(isset($viewcart_btn_hover_bg_color) && !empty($viewcart_btn_hover_bg_color)) { ?>
.majc-button.majc-view-cart-btn:hover {
	background: <?php echo esc_attr($viewcart_btn_hover_bg_color); ?> !important;
}
<?php } ?>

<?php if(isset($viewcart_btn_font_color) && !empty($viewcart_btn_font_color)) { ?>
.majc-button.majc-view-cart-btn {
	color: <?php echo esc_attr($viewcart_btn_font_color); ?> !important;
}
<?php } ?>

<?php if(isset($viewcart_btn_hover_font_color) && !empty($viewcart_btn_hover_font_color)) { ?>
.majc-button.majc-view-cart-btn:hover {
	color: <?php echo esc_attr($viewcart_btn_hover_font_color); ?> !important;
}
<?php } ?>

<?php if(isset($viewcart_btn_normal_border_color) && !empty($viewcart_btn_normal_border_color)) { ?>
.majc-button.majc-view-cart-btn {
	border: 1px solid <?php echo esc_attr($viewcart_btn_normal_border_color); ?> !important;
}
<?php } ?>

<?php if(isset($viewcart_btn_hover_border_color) && !empty($viewcart_btn_hover_border_color)) { ?>
.majc-button.majc-view-cart-btn:hover {
	border: 1px solid <?php echo esc_attr($viewcart_btn_hover_border_color); ?> !important;
}
<?php } ?>

/*View checkout*/
<?php if(isset($checkout_btn_bg_color) && !empty($checkout_btn_bg_color)) { ?>
.majc-button.majc-checkout-btn {
	background: <?php echo esc_attr($checkout_btn_bg_color); ?> !important;
}
<?php } ?>

<?php if(isset($checkout_btn_hover_bg_color) && !empty($checkout_btn_hover_bg_color)) { ?>
.majc-button.majc-checkout-btn:hover {
	background: <?php echo esc_attr($checkout_btn_hover_bg_color); ?> !important;
}
<?php } ?>

<?php if(isset($checkout_btn_font_color) && !empty($checkout_btn_font_color)) { ?>
.majc-button.majc-checkout-btn {
	color: <?php echo esc_attr($checkout_btn_font_color); ?> !important;
}
<?php } ?>

<?php if(isset($checkout_btn_hover_font_color) && !empty($checkout_btn_hover_font_color)) { ?>
.majc-button.majc-checkout-btn:hover {
	color: <?php echo esc_attr($checkout_btn_hover_font_color); ?> !important;
}
<?php } ?>

<?php if(isset($checkout_btn_normal_border_color) && !empty($checkout_btn_normal_border_color)) { ?>
.majc-button.majc-checkout-btn {
	border: 1px solid <?php echo esc_attr($checkout_btn_normal_border_color); ?> !important;
}
<?php } ?>

<?php if(isset($checkout_btn_hover_border_color) && !empty($checkout_btn_hover_border_color)) { ?>
.majc-button.majc-checkout-btn:hover {
	border: 1px solid <?php echo esc_attr($checkout_btn_hover_border_color); ?> !important;
}
<?php } ?>

/*Available Coupons*/
<?php if(isset($available_coupons_bg_color) && !empty($available_coupons_bg_color)) { ?>
.majc-coupons-lists-wrap h2 {
	background: <?php echo esc_attr($available_coupons_bg_color); ?> !important;
}
<?php } ?>

<?php if(isset($available_coupons_hover_bg_color) && !empty($available_coupons_hover_bg_color)) { ?>
.majc-coupons-lists-wrap h2:hover {
	background: <?php echo esc_attr($available_coupons_hover_bg_color); ?> !important;
}
<?php } ?>

<?php if(isset($available_coupons_font_color) && !empty($available_coupons_font_color)) { ?>
.majc-coupons-lists-wrap h2 {
	color: <?php echo esc_attr($available_coupons_font_color); ?> !important;
}
<?php } ?>

<?php if(isset($available_coupons_hover_font_color) && !empty($available_coupons_hover_font_color)) { ?>
.majc-coupons-lists-wrap h2:hover {
	color: <?php echo esc_attr($available_coupons_hover_font_color); ?> !important;
}
<?php } ?>

<?php if(isset($available_coupons_border_color) && !empty($available_coupons_border_color)) { ?>
.majc-coupons-lists-wrap h2 {
	border: 1px solid <?php echo esc_attr($available_coupons_border_color); ?> !important;
}
<?php } ?>

<?php if(isset($available_coupons_hover_border_color) && !empty($available_coupons_hover_border_color)) { ?>
.majc-coupons-lists-wrap h2:hover {
	border: 1px solid <?php echo esc_attr($available_coupons_hover_border_color); ?> !important;
}
<?php } ?>

/* Header Title Typography */
.majc-header h2 {
	font-family: <?php echo esc_attr($header_title_font_family) .' !important';?>;
	text-transform: <?php echo esc_attr($header_title_text_transform) .' !important';?>;
	font-weight: <?php echo intval($header_title_font_style) .' !important';?>;
	font-size: <?php echo intval($header_title_font_size).'px !important'; ?>;
	line-height: <?php echo floatval($header_title_line_height) .' !important'; ?>;
	letter-spacing: <?php echo intval($header_title_letter_spacing).'px !important'; ?>;
	text-decoration: <?php echo esc_attr($header_title_text_decoration) .' !important'; ?>;
	color: <?php echo esc_attr($header_title_font_color); ?>;
}

/* Summary Label Typography */
.majc-cart-total-wrap label,
.majc-cart-discount-wrap label,
.majc-cart-subtotal-wrap label {
	font-family: <?php echo esc_attr($summary_label_font_family) .' !important';?>;
	text-transform: <?php echo esc_attr($summary_label_text_transform) .' !important';?>;
	font-weight: <?php echo intval($summary_label_font_style) .' !important';?>;
	font-size: <?php echo intval($summary_label_font_size).'px !important'; ?>;
	line-height: <?php echo floatval($summary_label_line_height) .' !important'; ?>;
	letter-spacing: <?php echo intval($summary_label_letter_spacing).'px !important'; ?>;
	text-decoration: <?php echo esc_attr($summary_label_text_decoration) .' !important'; ?>;
	color: <?php echo esc_attr($summary_label_font_color); ?>;
}

<?php if(isset($summary_border_color) && !empty($summary_border_color)) { ?>
.majc-buy-summary > div {
	border-color: <?php echo esc_attr($summary_border_color); ?>;
}
<?php } ?>

/* Shipping Title Typography */
.majc-cart-action-btn-wrap h4 {
	font-family: <?php echo esc_attr($shipping_title_font_family) .' !important';?>;
	text-transform: <?php echo esc_attr($shipping_title_text_transform) .' !important';?>;
	font-weight: <?php echo intval($shipping_title_font_style) .' !important';?>;
	font-size: <?php echo intval($shipping_title_font_size).'px !important'; ?>;
	line-height: <?php echo floatval($shipping_title_line_height) .' !important'; ?>;
	letter-spacing: <?php echo intval($shipping_title_letter_spacing).'px !important'; ?>;
	text-decoration: <?php echo esc_attr($shipping_title_text_decoration) .' !important'; ?>;
	color: <?php echo esc_attr($shipping_title_font_color); ?>;
}

/* All Buttons and "See Coupons Lists" Typography */ 
.majc-button,
.majc-coupons-lists-wrap h2 {
	font-family: <?php echo esc_attr($button_text_font_family) .' !important';?>;
	text-transform: <?php echo esc_attr($button_text_text_transform) .' !important';?>;
	font-weight: <?php echo intval($button_text_font_style) .' !important';?>;
	font-size: <?php echo intval($button_text_font_size).'px !important'; ?>;
	line-height: <?php echo floatval($button_text_line_height) .' !important'; ?>;
	letter-spacing: <?php echo intval($button_text_letter_spacing).'px !important'; ?>;
	text-decoration: <?php echo esc_attr($button_text_text_decoration) .' !important'; ?>;
}

/*Trigger Button*/
<?php if(isset($trigger_btn_bg_color) && !empty($trigger_btn_bg_color)) { ?>
.majc-cartbasket-toggle-btn {
	background: <?php echo esc_attr($trigger_btn_bg_color); ?> !important;
}
<?php } ?>

<?php if(isset($trigger_btn_hover_bg_color) && !empty($trigger_btn_hover_bg_color)) { ?>
.majc-cartbasket-toggle-btn:hover {
	background: <?php echo esc_attr($trigger_btn_hover_bg_color); ?> !important;
}
<?php } ?>

<?php if(isset($trigger_btn_font_color) && !empty($trigger_btn_font_color)) { ?>
.majc-cartbasket-toggle-btn span {
	color: <?php echo esc_attr($trigger_btn_font_color); ?> !important;
}
<?php } ?>

<?php if(isset($trigger_btn_hover_font_color) && !empty($trigger_btn_hover_font_color)) { ?>
.majc-cartbasket-toggle-btn:hover span {
	color: <?php echo esc_attr($trigger_btn_hover_font_color); ?> !important;
}
<?php } ?>

<?php if(isset($cart_total_box_bg_color) && !empty($cart_total_box_bg_color)) { ?>
.majc-item-count-wrap {
	background: <?php echo esc_attr($cart_total_box_bg_color); ?> !important;
}
<?php } ?>

<?php if(isset($cart_total_box_text_color) && !empty($cart_total_box_text_color)) { ?>
.majc-item-count-wrap span.majc-cart-item-count {
	color: <?php echo esc_attr($cart_total_box_text_color); ?> !important;
}
<?php } ?>

/* Added Product Title Typography */ 
.majc-item-name {
	font-family: <?php echo esc_attr($added_product_title_font_family) .' !important';?>;
	text-transform: <?php echo esc_attr($added_product_title_text_transform) .' !important';?>;
	font-weight: <?php echo intval($added_product_title_font_style) .' !important';?>;
	font-size: <?php echo intval($added_product_title_font_size).'px !important'; ?>;
	line-height: <?php echo floatval($added_product_title_line_height) .' !important'; ?>;
	letter-spacing: <?php echo intval($added_product_title_letter_spacing).'px !important'; ?>;
	text-decoration: <?php echo esc_attr($added_product_title_text_decoration) .' !important'; ?>;
	color: <?php echo esc_attr($added_product_title_font_color); ?>;
}

/* Added Product Price Typography */ 
.majc-item-price span.woocommerce-Price-amount.amount {
	font-family: <?php echo esc_attr($added_product_price_font_family) .' !important';?>;
	text-transform: <?php echo esc_attr($added_product_price_text_transform) .' !important';?>;
	font-weight: <?php echo intval($added_product_price_font_style) .' !important';?>;
	font-size: <?php echo intval($added_product_price_font_size).'px !important'; ?>;
	line-height: <?php echo floatval($added_product_price_line_height) .' !important'; ?>;
	letter-spacing: <?php echo intval($added_product_price_letter_spacing).'px !important'; ?>;
	text-decoration: <?php echo esc_attr($added_product_price_text_decoration) .' !important'; ?>;
	color: <?php echo esc_attr($added_product_price_font_color); ?>;
}

/* Summary Price Typography */ 
.majc-cart-total-amount span.woocommerce-Price-amount.amount,
.majc-cart-discount-amount span.woocommerce-Price-amount.amount,
.majc-cart-subtotal-wrap .majc-subtotal-amount {
	font-family: <?php echo esc_attr($summary_price_font_family) .' !important';?>;
	text-transform: <?php echo esc_attr($summary_price_text_transform) .' !important';?>;
	font-weight: <?php echo intval($summary_price_font_style) .' !important';?>;
	font-size: <?php echo intval($summary_price_font_size).'px !important'; ?>;
	line-height: <?php echo floatval($summary_price_line_height) .' !important'; ?>;
	letter-spacing: <?php echo intval($summary_price_letter_spacing).'px !important'; ?>;
	text-decoration: <?php echo esc_attr($summary_price_text_decoration) .' !important'; ?>;
	color: <?php echo esc_attr($summary_price_font_color); ?>;
} 

/* Remove Product Button Color */
<?php if(isset($remove_product_btn_bg_color) && !empty($remove_product_btn_bg_color)) { ?>
.majc-cartitem-grid .majc-cart-items-inner .majc-item-remove a {
	background: <?php echo esc_attr($remove_product_btn_bg_color); ?> !important;
}
<?php } ?>


<?php if(isset($remove_product_btn_font_color) && !empty($remove_product_btn_font_color)) { ?>
.majc-cartitem-grid .majc-cart-items-inner .majc-item-remove a {
	color: <?php echo esc_attr($remove_product_btn_font_color); ?> !important;
}
<?php } ?>


/* Header Item Count Typography */ 
.majc-cart-qty-count,
.majc-cart-items-count {
	font-family: <?php echo esc_attr($header_item_count_font_family) .' !important';?>;
	text-transform: <?php echo esc_attr($header_item_count_text_transform) .' !important';?>;
	font-weight: <?php echo intval($header_item_count_font_style) .' !important';?>;
	font-size: <?php echo intval($header_item_count_font_size).'px !important'; ?>;
	line-height: <?php echo floatval($header_item_count_line_height) .' !important'; ?>;
	letter-spacing: <?php echo intval($header_item_count_letter_spacing).'px !important'; ?>;
	text-decoration: <?php echo esc_attr($header_item_count_text_decoration) .' !important'; ?>;
	color: <?php echo esc_attr($header_item_count_font_color); ?>;
} 

/* Discount Offer */
<?php if(isset($discount_offer_bg_color) && !empty($discount_offer_bg_color)) { ?>
.majc-coupons-lists .majc-each-coupon-list .majc-coupon-discount-amt {
	background: <?php echo esc_attr($discount_offer_bg_color); ?> !important;
}
<?php } ?>

<?php if(isset($discount_offer_font_color) && !empty($discount_offer_font_color)) { ?>
.majc-coupons-lists .majc-each-coupon-list .majc-coupon-discount-amt {
	color: <?php echo esc_attr($discount_offer_font_color); ?> !important;
}
<?php } ?>

<?php if(isset($coupon_code_bg_color) && !empty($coupon_code_bg_color)) { ?>
.majc-coupons-lists .majc-each-coupon-list {
	background-color: <?php echo esc_attr($coupon_code_bg_color); ?> !important;
}
<?php } ?>

<?php if(isset($coupon_code_font_color) && !empty($coupon_code_font_color)) { ?>
.majc-coupons-lists .majc-each-coupon-list {
	color: <?php echo esc_attr($coupon_code_font_color); ?> !important;
}
<?php } ?>

/* Extra Settings */
<?php if(isset($close_icon_color) && !empty($close_icon_color)) { ?>
	.majc-cart-close{
		color: <?php echo esc_attr($close_icon_color); ?>;
	}
<?php } ?>

<?php if(isset($default_border_color) && !empty($default_border_color)) { ?>
.majc-cartitem-grid .majc-cart-items-inner,
.majc-item-qty .majc-qty,
.majc-coupon .majc-coupon-field input,
.majc-item-qty .majc-qty-minus, .majc-item-qty .majc-qty-plus, .majc-item-qty .majc-qty {
	border-color: <?php echo esc_attr($default_border_color); ?>;
}
<?php } ?>

<?php if(isset($qty_change_btn_bg_color) && !empty($qty_change_btn_bg_color)) { ?>
.majc-item-qty .majc-qty-minus, .majc-item-qty .majc-qty-plus, .majc-item-qty .majc-qty {
	background: <?php echo esc_attr($qty_change_btn_bg_color); ?> !important;
}
<?php } ?>

<?php if(isset($qty_change_icon_color) && !empty($qty_change_icon_color)) { ?>
.majc-item-qty .majc-qty-minus, .majc-item-qty .majc-qty-plus, .majc-item-qty .majc-qty {
	color: <?php echo esc_attr($qty_change_icon_color); ?> !important;
}
<?php } ?>

<?php if(isset($majc_settings['content_width']) && !empty($majc_settings['content_width'])) { ?>
	.majc-layout-slidein .majc-cart-popup,
	.majc-layout-floating .majc-cart-popup {
		width: <?php echo isset($majc_settings['content_width']) && $majc_settings['content_width'] != 0 ? intval($majc_settings['content_width']).'px' : '400px'; ?>;
	}
	.majc-layout-popup .majc-cart-popup {
		max-width: <?php echo isset($majc_settings['content_width']) && $majc_settings['content_width'] != 0 ? intval($majc_settings['content_width']).'px' : '700px'; ?>;
	}
<?php } ?>
</style>