<?php

defined('ABSPATH') or die('No Script Found!');

if (!class_exists('MAJC_Library')) {

    class MAJC_Library {

        static function sanitize_array($array = array(), $sanitize_rule = array()) {
            if (!is_array($array) || count($array) == 0) {
                return array();
            }

            foreach ($array as $k => $v) {
                if (!is_array($v)) {
                    $default_sanitize_rule = (is_numeric($k)) ? 'html' : 'text';
                    $sanitize_type = isset($sanitize_rule[$k]) ? $sanitize_rule[$k] : $default_sanitize_rule;
                    $array[$k] = self:: sanitize_value($v, $sanitize_type);
                }

                if (is_array($v)) {
                    $array[$k] = self:: sanitize_array($v, $sanitize_rule);
                }
            }

            return $array;
        }

        static function sanitize_value($value = '', $sanitize_type = 'html') {
            switch ($sanitize_type) {
                case 'text':
                    $allowed_html = wp_kses_allowed_html('post');
                    return wp_kses($value, $allowed_html);
                    break;
                default:
                    return sanitize_text_field($value);
                    break;
            }
        }

        public function pr($array) {
            echo "<pre>";
            print_r($array);
            echo "</pre>";
        }

        public function majc_sanitize_url($url) {
            $sanitized_url = strip_tags(stripslashes(filter_var($url, FILTER_VALIDATE_URL)));
            return $sanitized_url;
        }

        public function majc_animations() {
            $animations = [
                'show_animation' => array(
                    'Fading Entrances' => array('fadeIn', 'fadeInLeft', 'fadeInRight'),
                    'Slide Entrance' => array('slideInLeft', 'slideInRight')
                ),
                'hide_animation' => array(
                    'Fading Exits' => array('fadeOut', 'fadeOutLeft', 'fadeOutRight'),
                    'Slide Exits' => array('slideOutLeft', 'slideOutRight')
                ),
                'hover_animation' => array(
                    '2D Transitions' => array(
                        'Grow' => 'hvr-grow',
                        'Shrink' => 'hvr-shrink',
                        'Pulse' => 'hvr-pulse'
                    )
                ),
            ];
            return $animations;
        }

        public static function default_values() {
            return array(
                'cart_basket' =>
                array(
                    'open_icon_type' => 'default_icon',
                    'open_available_icon' => 'mdi mdi-cart-check',
                    'open_custom_icon' => '',
                    'close_icon_type' => 'default_icon',
                    'close_available_icon' => 'mdi mdi-cart-remove',
                    'close_custom_icon' => '',
                    'shape' => 'round',
                    'hover_animation' => 'hvr-grow',
                    'product_count' => 'on',
                ),
                'basket_position' => 'left-middle',
                'layout_type' => 'slidein',
                'show_animation' => 'none',
                'hide_animation' => 'none',
                'cart_item_layout' => 'list',
                'content_width' => '400',
                'enable_overlay' => 'on',
                'enable_ajax_atc' => 'on',
                'header' =>
                array(
                    'title_text' => 'Your Product Basket',
                    'icon_type' => 'none',
                    'available_icon' => 'icofont-basket',
                    'custom_icon' => '',
                    'show_cart_item_count' => 'on',
                ),
                'coupon' =>
                array(
                    'enable' => 'on',
                    'button_text' => 'Apply Coupon',
                    'promocode_placeholder' => 'Promo Code',
                ),
                'summary' =>
                array(
                    'hide_cart_total' => '',
                    'hide_discount' => '',
                    'hide_subtotal' => ''
                ),
                'display' =>
                array(
                    'enable_flying_cart' => 'on',
                    'hide_show_pages' => 'hide_in_pages',
                    'mobile_hide' => '',
                    'desktop_hide' => ''
                ),
                'buttons' =>
                array(
                    'show_view_cart' => 'on',
                    'show_checkout' => 'on',
                    'show_continue_shopping' => 'on',
                    'continue_shopping_link' => '',
                    'view_cart_label' => 'View Cart',
                    'checkout_label' => 'View Checkout',
                    'continue_shopping_label' => 'Continue Shopping',
                    'shipping_text' => 'Shipping',
                ),
                'custom' =>
                array(
                    'enable' => '',
                    'header_title_font_family' => 'default',
                    'header_title_font_style' => 'default',
                    'header_title_text_transform' => 'default',
                    'header_title_text_decoration' => 'default',
                    'header_title_font_size' => '',
                    'header_title_line_height' => '',
                    'header_title_letter_spacing' => '',
                    'header_title_font_color' => '',
                    'content_font_family' => 'default',
                    'content_font_style' => 'default',
                    'content_text_transform' => 'default',
                    'content_text_decoration' => 'default',
                    'content_font_size' => '',
                    'content_line_height' => '',
                    'content_letter_spacing' => '',
                    'content_font_color' => '',
                    'button_text_font_family' => 'default',
                    'button_text_font_style' => 'default',
                    'button_text_text_transform' => 'default',
                    'button_text_text_decoration' => 'default',
                    'button_text_font_size' => '',
                    'button_text_line_height' => '',
                    'button_text_letter_spacing' => '',
                    'product_title_font_family' => 'default',
                    'product_title_font_style' => 'default',
                    'product_title_text_transform' => 'default',
                    'product_title_text_decoration' => 'default',
                    'product_title_font_size' => '',
                    'product_title_line_height' => '',
                    'product_title_letter_spacing' => '',
                    'product_title_font_color' => '',
                    'coupon_btn_bg_color' => '',
                    'coupon_btn_hover_bg_color' => '',
                    'coupon_btn_font_color' => '',
                    'coupon_btn_hover_font_color' => '',
                    'continueshop_btn_bg_color' => '',
                    'continueshop_btn_hover_bg_color' => '',
                    'continueshop_btn_font_color' => '',
                    'continueshop_btn_hover_font_color' => '',
                    'continueshop_btn_normal_border_color' => '',
                    'continueshop_btn_hover_border_color' => '',
                    'viewcart_btn_bg_color' => '',
                    'viewcart_btn_hover_bg_color' => '',
                    'viewcart_btn_font_color' => '',
                    'viewcart_btn_hover_font_color' => '',
                    'viewcart_btn_normal_border_color' => '',
                    'viewcart_btn_hover_border_color' => '',
                    'checkout_btn_bg_color' => '',
                    'checkout_btn_hover_bg_color' => '',
                    'checkout_btn_font_color' => '',
                    'checkout_btn_hover_font_color' => '',
                    'checkout_btn_normal_border_color' => '',
                    'checkout_btn_hover_border_color' => '',
                    'trigger_btn_bg_color' => '',
                    'trigger_btn_hover_bg_color' => '',
                    'trigger_btn_font_color' => '',
                    'trigger_btn_hover_font_color' => '',
                    'cart_total_box_bg_color' => '',
                    'cart_total_box_text_color' => '',
                    'drawer_content_bg_type' => 'default',
                    'drawer_content_bg_color' => '',
                    'drawer_content_bg_image' => '',
                    'remove_product_btn_bg_color' => '',
                    'remove_product_btn_font_color' => '',
                    'close_icon_color' => '',
                    'default_border_color' => '',
                    'qty_change_btn_bg_color' => '',
                    'qty_change_icon_color' => '',
                ),
            );
        }

    }

    new MAJC_Library();
}