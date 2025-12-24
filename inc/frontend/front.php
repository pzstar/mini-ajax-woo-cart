<?php
global $post;

if (!empty($post)) {
    $majc_current_page_id = is_front_page() ? null : ($post ? $post->ID : null);

    if (class_exists('WooCommerce') && is_shop()) {
        $majc_current_page_id = wc_get_page_id('shop');
    } else if (is_single() || is_front_page()) {
        $majc_current_page_id = $post->ID;
    } else if (is_archive()) {
        $majc_current_page_id = get_queried_object_id();
    } else if (is_home()) {
        $majc_current_page_id = get_queried_object_id();
    }

    $majc_current_archive = is_front_page() ? 'front' : ($post ? $post->post_type : get_queried_object()->name);
    $majc_current_post_type = is_archive() ? null : $majc_current_archive;

    $majc_query = new WP_Query(array('post_type' => 'ultimate-woo-cart', 'posts_per_page' => -1));

    if ($majc_query->have_posts()):
        while ($majc_query->have_posts()):

            $majc_query->the_post();

            $majc_post_id = get_the_ID();
            $majc_settings = get_post_meta($majc_post_id, 'uwcc_settings', true);

            if (!empty($majc_settings)) {

                WC()->cart->calculate_totals();
                WC()->cart->maybe_set_cart_cookies();

                // Main Settings
                $majc_layout_type = 'slidein';

                $majc_basket_position = isset($majc_settings['basket_position']) ? $majc_settings['basket_position'] : 'left-middle';
                if ($majc_basket_position == 'left-top' || $majc_basket_position == 'left-middle' || $majc_basket_position == 'left-bottom') {
                    $majc_basket_position_class = 'majc-position-left';
                } else if ($majc_basket_position == 'right-top' || $majc_basket_position == 'right-middle' || $majc_basket_position == 'right-bottom') {
                    $majc_basket_position_class = 'majc-position-right';
                }
                $majc_cart_item_layout = isset($majc_settings['cart_item_layout']) ? $majc_settings['cart_item_layout'] : 'layout-1';
                $majc_show_animation = isset($majc_settings['show_animation']) && $majc_settings['show_animation'] != 'none' ? $majc_settings['show_animation'] : '';
                $majc_hide_animation = isset($majc_settings['hide_animation']) && $majc_settings['hide_animation'] != 'none' ? $majc_settings['hide_animation'] : '';
                $majc_enable_overlay = isset($majc_settings['enable_overlay']) ? $majc_settings['enable_overlay'] : 'off';

                // Header Settings
                $majc_header = isset($majc_settings['header']) ? $majc_settings['header'] : null;
                $majc_header_title = isset($majc_header['title_text']) ? $majc_header['title_text'] : '';
                $majc_header_icon_type = isset($majc_header['icon_type']) ? $majc_header['icon_type'] : 'default_icon';
                $majc_header_available_icon = isset($majc_header['available_icon']) ? $majc_header['available_icon'] : null;
                $majc_header_custom_icon = isset($majc_header['custom_icon']) ? $majc_header['custom_icon'] : null;
                $majc_header_show_total_items = isset($majc_header['show_cart_item_count']) ? $majc_header['show_cart_item_count'] : 'off';

                // Buttons Settings
                $majc_buttons = isset($majc_settings['buttons']) ? $majc_settings['buttons'] : null;
                $majc_show_view_cart = isset($majc_buttons['show_view_cart']) ? $majc_buttons['show_view_cart'] : 'off';
                $majc_show_checkout = isset($majc_buttons['show_checkout']) ? $majc_buttons['show_checkout'] : 'off';
                $majc_show_continue_shopping = isset($majc_buttons['show_continue_shopping']) ? $majc_buttons['show_continue_shopping'] : 'off';
                $majc_continue_shopping_link = isset($majc_buttons['continue_shopping_link']) ? $majc_buttons['continue_shopping_link'] : '#';
                $majc_view_cart_text = isset($majc_buttons['view_cart_label']) ? $majc_buttons['view_cart_label'] : esc_html__('View Cart', 'mini-ajax-cart');
                $majc_checkout_text = isset($majc_buttons['checkout_label']) ? $majc_buttons['checkout_label'] : esc_html__('View Checkout', 'mini-ajax-cart');
                $majc_continue_shopping_text = isset($majc_buttons['continue_shopping_label']) ? $majc_buttons['continue_shopping_label'] : esc_html__('Continue Shopping', 'mini-ajax-cart');
                $majc_shipping_text = isset($majc_buttons['shipping_text']) ? $majc_buttons['shipping_text'] : esc_html__('To find out your shipping cost , Please proceed to checkout.', 'mini-ajax-cart');

                // Coupon Settings
                $majc_coupon = isset($majc_settings['coupon']) ? $majc_settings['coupon'] : null;
                $majc_enable_coupon = isset($majc_coupon['enable']) ? $majc_coupon['enable'] : 'off';
                $majc_apply_coupon_btn_text = isset($majc_coupon['button_text']) ? $majc_coupon['button_text'] : esc_html__('Apply Coupon', 'mini-ajax-cart');
                $majc_promocode_placeholder = isset($majc_coupon['promocode_placeholder']) ? $majc_coupon['promocode_placeholder'] : esc_html__('Enter your promo code', 'mini-ajax-cart');

                // Cart Basket Settings
                $majc_cart_basket = isset($majc_settings['cart_basket']) ? $majc_settings['cart_basket'] : null;
                $majc_cart_basket_icon_type = isset($majc_cart_basket['icon_type']) ? $majc_cart_basket['icon_type'] : 'default_icon';
                $majc_cart_basket_open_available_icon = isset($majc_cart_basket['open_available_icon']) ? $majc_cart_basket['open_available_icon'] : null;
                $majc_cart_basket_open_custom_icon = isset($majc_cart_basket['open_custom_icon']) ? $majc_cart_basket['open_custom_icon'] : null;
                $majc_cart_basket_close_available_icon = isset($majc_cart_basket['close_available_icon']) ? $majc_cart_basket['close_available_icon'] : null;
                $majc_cart_basket_close_custom_icon = isset($majc_cart_basket['close_custom_icon']) ? $majc_cart_basket['close_custom_icon'] : null;
                $majc_cart_basket_shape = isset($majc_cart_basket['shape']) ? $majc_cart_basket['shape'] : null;
                $majc_cart_basket_product_count = isset($majc_cart_basket['product_count']) ? $majc_cart_basket['product_count'] : 'off';
                $majc_cart_basket_hover_animation = isset($majc_cart_basket['hover_animation']) && $majc_cart_basket['hover_animation'] != 'none' ? $majc_cart_basket['hover_animation'] : null;

                // Summary Settings
                $majc_summary = isset($majc_settings['summary']) ? $majc_settings['summary'] : null;
                $majc_hide_cart_total = isset($majc_summary['hide_cart_total']) ? $majc_summary['hide_cart_total'] : 'off';
                $majc_hide_discount = isset($majc_summary['hide_discount']) ? $majc_summary['hide_discount'] : 'off';
                $majc_hide_subtotal = isset($majc_summary['hide_subtotal']) ? $majc_summary['hide_subtotal'] : 'off';

                // Custom Settings
                $majc_custom = isset($majc_settings['custom']) ? $majc_settings['custom'] : null;

                // Display Settings
                $majc_specific_pages = isset($majc_settings['display']['specific_pages']) && !empty($majc_settings['display']['specific_pages']) ? $majc_settings['display']['specific_pages'] : array();
                $majc_display_condition = isset($majc_settings['display']['display_condition']) ? $majc_settings['display']['display_condition'] : null;
                $majc_front_pages = isset($majc_settings['display']['front_pages']) ? $majc_settings['display']['front_pages'] : 'off';
                $majc_blog_pages = isset($majc_settings['display']['blog_pages']) ? $majc_settings['display']['blog_pages'] : 'off';
                $majc_error_pages = isset($majc_settings['display']['error_pages']) ? $majc_settings['display']['error_pages'] : 'off';
                $majc_search_pages = isset($majc_settings['display']['search_pages']) ? $majc_settings['display']['search_pages'] : 'off';
                $majc_archive_pages = isset($majc_settings['display']['archive_pages']) ? $majc_settings['display']['archive_pages'] : 'off';
                $majc_enable_flymenu = isset($majc_settings['display']['enable_flying_cart']) ? $majc_settings['display']['enable_flying_cart'] : 'off';
                $majc_cpt_pages = !empty($majc_settings['display']['cpt_pages']) ? $majc_settings['display']['cpt_pages'] : array();
                $majc_specific_archive = !empty($majc_settings['display']['specific_archive']) ? $majc_settings['display']['specific_archive'] : array();
                $majc_hide_screen = !empty($majc_settings['display']['hide_screen']) ? $majc_settings['display']['hide_screen'] : array();

                if ($majc_enable_flymenu != 'on') {
                    continue;
                }

                $majc_show = $this->hide_show_pages($majc_current_page_id, $majc_specific_pages, $majc_display_condition, $majc_front_pages, $majc_blog_pages, $majc_cpt_pages, $majc_error_pages, $majc_search_pages, $majc_archive_pages, $majc_current_post_type, $majc_specific_archive, $majc_current_archive);

                // Hide the fly menu if false
                if (!$majc_show) {
                    continue;
                }

                $majc_content_width = isset($majc_settings['content_width']) ? $majc_settings['content_width'] : 400;

                $majc_wrapper_class = array(
                    'majc-main-wrapper',
                    'majc-main-wrapper-' . $majc_post_id,
                    'majc-layout-' . $majc_layout_type,
                    'majc-' . $majc_basket_position,
                    'majc-cartitem-' . $majc_cart_item_layout,
                    $majc_basket_position_class,
                    $majc_hide_screen ? 'majc-hide-' . implode(' majc-hide-', $majc_hide_screen) : ''
                );
                ?>

                <div id="majc-main-wrapper-<?php echo esc_attr($post->ID); ?>" class="<?php echo esc_attr(implode(' ', $majc_wrapper_class)); ?>" data-overlayenable="<?php echo ($majc_enable_overlay == 'on') ? 'majc-overlay-enabled' : ''; ?>" data-pageid="<?php echo esc_attr($majc_current_page_id); ?>">
                    <div class="majc-check-cart <?php echo esc_attr(WC()->cart->is_empty() ? 'majc-hide-cart-items' : ''); ?>"></div>
                    <div class="majc-main-inner-wrapper">
                        <div class="majc-toggle-button <?php echo esc_attr('majc-' . $majc_cart_basket_shape); ?>">
                            <div class="majc-toggle-open-btn majc-cartbasket-toggle-btn <?php echo esc_attr($majc_cart_basket_hover_animation); ?>">

                                <?php if (isset($majc_cart_basket_icon_type) && $majc_cart_basket_icon_type == 'available_icon') { ?>
                                    <span class="majc-cartbasket-icon majc-cartbasket-open-icon <?php echo esc_attr($majc_cart_basket_open_available_icon); ?>"></span>
                                <?php } else if (isset($majc_cart_basket_icon_type) && $majc_cart_basket_icon_type == 'custom_icon') { ?>
                                        <div class="majc-cartbasket-img majc-cartbasket-icon majc-cartbasket-open-icon">
                                            <img src="<?php echo esc_url($majc_cart_basket_open_custom_icon); ?>">
                                        </div>
                                <?php } else if (isset($majc_cart_basket_icon_type) && $majc_cart_basket_icon_type == 'default_icon') { ?>
                                            <span class="majc-cartbasket-icon majc-cartbasket-open-icon icon_cart_alt"></span>
                                <?php } ?>

                                <?php if (isset($majc_cart_basket_icon_type) && $majc_cart_basket_icon_type == 'available_icon') { ?>
                                    <span class="majc-cartbasket-icon majc-cartbasket-close-icon <?php echo esc_attr($majc_cart_basket_close_available_icon); ?>"></span>
                                <?php } else if (isset($majc_cart_basket_icon_type) && $majc_cart_basket_icon_type == 'custom_icon') { ?>
                                        <div class="majc-cartbasket-img majc-cartbasket-icon majc-cartbasket-close-icon">
                                            <img src="<?php echo esc_url($majc_cart_basket_close_custom_icon); ?>">
                                        </div>
                                <?php } else if (isset($majc_cart_basket_icon_type) && $majc_cart_basket_icon_type == 'default_icon') { ?>
                                            <span class="majc-cartbasket-icon majc-cartbasket-close-icon icon_close"></span>
                                <?php } ?>

                                <?php if ($majc_cart_basket_product_count == 'on') { ?>
                                    <div class="majc-item-count-wrap">
                                        <span class="majc-cart-item-count"><?php echo wp_kses_post(WC()->cart->get_cart_contents_count()); ?></span>
                                    </div>
                                <?php } ?>
                            </div>
                        </div>

                        <?php
                        if (!empty($majc_show_animation) && !empty($majc_hide_animation)) {
                            $majc_popup_class = 'majc-cartpop-animation-enabled majc-cartpop-both-animation-enabled';
                        } elseif (!empty($majc_show_animation)) {
                            $majc_popup_class = 'majc-cartpop-animation-enabled majc-cartpop-show-animation-enabled';
                        } elseif (!empty($majc_hide_animation)) {
                            $majc_popup_class = 'majc-cartpop-animation-enabled majc-cartpop-hide-animation-enabled';
                        } else {
                            $majc_popup_class = '';
                        }
                        ?>
                        <div class="majc-cart-popup <?php echo esc_attr($majc_popup_class); ?>" <?php if (!empty($majc_show_animation)) { ?> data-showanimation="<?php echo 'animate--' . esc_attr($majc_show_animation); ?>" <?php
                           }
                           if (!empty($majc_hide_animation)) {
                               ?> data-hideanimation="<?php echo 'animate--' . esc_attr($majc_hide_animation); ?>" <?php } ?> style="width:<?php echo esc_attr($majc_content_width); ?>px">
                            <div class="majc-cart-popup-inner">

                                <div class="majc-header">
                                    <h2>
                                        <?php if (isset($majc_header_icon_type) && $majc_header_icon_type == 'available_icon') { ?>
                                            <div class="majc-header-icon"><span class="<?php echo esc_attr($majc_header_available_icon); ?>"></span></div>
                                        <?php } else if (isset($majc_header_icon_type) && $majc_header_icon_type == 'custom_icon') { ?>
                                                <div class="majc-header-icon"><img src="<?php echo esc_url($majc_header_custom_icon); ?>"></div>
                                        <?php } else if (isset($majc_header_icon_type) && $majc_header_icon_type == 'default_icon') { ?>
                                                    <div class="majc-header-icon"><span class="fa fa-shopping-cart"></span></div>
                                        <?php } ?>
                                        <?php echo esc_html($majc_header_title); ?>
                                    </h2>
                                    <?php if ($majc_header_show_total_items == 'on') { ?>
                                        <div class="majc-sub-header">
                                            <span class="majc-cart-qty-count"><?php esc_html_e('Quantity: ', 'mini-ajax-cart'); ?><?php echo wp_kses_post(WC()->cart->get_cart_contents_count()); ?></span>
                                            <span class="majc-cart-items-count"><?php esc_html_e('Items: ', 'mini-ajax-cart'); ?><?php echo wp_kses_post(sizeof(WC()->cart->get_cart())); ?></span>
                                        </div>
                                    <?php } ?>
                                    <span class="majc-cart-close icofont-close-line"></span>
                                </div>

                                <div class="majc-body">
                                    <div class="majc-cart-item-wrap">
                                        <?php if (!WC()->cart->is_empty()) { ?>
                                            <div class="majc-mini-cart">
                                                <?php
                                                $majc_items = WC()->cart->get_cart();
                                                foreach ($majc_items as $majc_item_key => $majc_item_val) {
                                                    $majc__product = apply_filters('woocommerce_cart_item_product', $majc_item_val['data'], $majc_item_val, $majc_item_key);
                                                    ?>
                                                    <div class="majc-cart-items" data-itemId="<?php echo esc_attr($majc_item_val['product_id']); ?>" data-cKey="<?php echo esc_attr($majc_item_val['key']); ?>">
                                                        <div class="majc-cart-items-inner">
                                                            <?php
                                                            $majc_product = wc_get_product($majc_item_val['data']->get_id());
                                                            $majc_product_id = apply_filters('woocommerce_cart_item_product_id', $majc_item_val['product_id'], $majc_item_val, $majc_item_key);
                                                            $majc_product_detail = wc_get_product($majc_item_val['product_id']);
                                                            ?>
                                                            <div class="majc-item-img">
                                                                <?php echo wp_kses_post($majc_product_detail->get_image('thumbnail')); ?>
                                                            </div>

                                                            <div class="majc-item-desc">
                                                                <div class="majc-item-remove">
                                                                    <?php
                                                                    echo wp_kses_post(apply_filters('woocommerce_cart_item_remove_link', sprintf('<a href="%s" class="majc-remove"  aria-label="%s" data-cart_item_id="%s" data-cart_item_sku="%s" data-cart_item_key="%s"><span class="icon_trash_alt"></span></a>', esc_url(wc_get_cart_remove_url($majc_item_key)), esc_html__('Remove this item', 'mini-ajax-cart'), esc_attr($majc_product_id), esc_attr($majc_product->get_sku()), esc_attr($majc_item_key)), $majc_item_key));
                                                                    ?>
                                                                </div>

                                                                <div class="majc-item-name">
                                                                    <?php echo esc_html($majc_product->get_name()); ?>
                                                                </div>

                                                                <div class="majc-item-qty">
                                                                    <span class="majc-qty-minus majc-qty-chng icon_minus-06"></span>

                                                                    <?php
                                                                    if ($majc__product->is_sold_individually()) {
                                                                        $majc_product_quantity = sprintf('1 <input type="hidden" name="cart[%s][qty]" value="1" />', $majc_item_key);

                                                                    } else {
                                                                        $majc_product_quantity = woocommerce_quantity_input(array(
                                                                            'input_name' => "majc-qty-input",
                                                                            'input_value' => $majc_item_val['quantity'],
                                                                            'max_value' => $majc__product->get_max_purchase_quantity(),
                                                                            'min_value' => '0',
                                                                            'product_name' => $majc__product->get_name(),
                                                                        ), $majc__product, false);
                                                                    }
                                                                    echo apply_filters('woocommerce_cart_item_quantity', $majc_product_quantity, $majc_item_key, $majc_item_val); // PHPCS: XSS ok.
                                                                    ?>

                                                                    <span class="majc-qty-plus majc-qty-chng icon_plus"></span>
                                                                </div>

                                                                <div class="majc-item-price">
                                                                    <?php
                                                                    $majc_wc_product = $majc_item_val['data'];
                                                                    echo wp_kses_post(WC()->cart->get_product_subtotal($majc_wc_product, $majc_item_val['quantity']));
                                                                    ?>
                                                                </div>
                                                            </div> <!-- majc-item-desc -->
                                                        </div> <!-- majc-cart-items-inner -->
                                                    </div> <!-- majc-car-items -->
                                                    <?php
                                                } // product foreach loop ends
                                                ?>
                                            </div> <!-- majc-mini-cart -->
                                        <?php } else { ?>
                                            <div class="majc-empty-cart">
                                                <?php esc_html_e('The Cart is Empty', 'mini-ajax-cart'); ?>
                                            </div>
                                        <?php } ?>
                                    </div>

                                    <div class="majc-empty-cart">
                                        <div class="majc-empty-cart-icon">
                                            <span class="mdi mdi-cart-arrow-down"></span>
                                        </div>
                                        <?php esc_html_e('No Product in the Cart!', 'mini-ajax-cart'); ?>
                                    </div>

                                    <!-- Coupons -->
                                    <?php if ($majc_enable_coupon == 'on') { ?>
                                        <div class='majc-coupon'>

                                            <div class="majc-cpn-resp" style="display: none;"></div>

                                            <div class="majc-coupon-field">
                                                <input type="text" class="majc-coupon-code" placeholder="<?php echo esc_attr($majc_promocode_placeholder); ?>">
                                                <button class="majc-coupon-submit majc-button"><?php echo esc_html($majc_apply_coupon_btn_text); ?></button>
                                            </div>

                                            <?php
                                            $majc_applied_coupons = WC()->cart->get_applied_coupons();

                                            if (!empty($majc_applied_coupons)) {
                                                ?>
                                                <ul class='majc-applied-cpns'>
                                                    <?php foreach ($majc_applied_coupons as $majc_cpns) { ?>
                                                        <li data-code='<?php echo esc_attr($majc_cpns); ?>'>
                                                            <?php echo esc_html($majc_cpns); ?><span class='majc-remove-cpn icofont-close-line'></span>
                                                        </li>
                                                    <?php } ?>
                                                </ul>
                                                <?php
                                            } else {
                                                echo '<ul class="majc-applied-cpns" style="display: none;"><li></li></ul>';
                                            }
                                            ?>
                                        </div>
                                    <?php } ?>

                                    <!-- Summary -->
                                    <div class="majc-buy-summary">

                                        <?php if ($majc_hide_cart_total != 'on') { ?>
                                            <div class="majc-cart-total-wrap">
                                                <label><?php echo esc_html__('Cart Total', 'mini-ajax-cart'); ?></label>
                                                <div class="majc-cart-total-amount"><?php echo wp_kses_post(wc_price(WC()->cart->get_subtotal() + WC()->cart->get_subtotal_tax())); ?></div>
                                            </div>
                                        <?php } ?>

                                        <?php if ($majc_hide_discount != 'on') { ?>
                                            <div class="majc-cart-discount-wrap">
                                                <label><?php echo esc_html__('Discount', 'mini-ajax-cart'); ?></label>
                                                <div class="majc-cart-discount-amount"><?php echo wp_kses_post(wc_price(WC()->cart->get_cart_discount_total() + WC()->cart->get_cart_discount_tax_total())); ?></div>
                                            </div>
                                        <?php } ?>

                                        <?php if ($majc_hide_subtotal != 'on') { ?>
                                            <div class='majc-cart-subtotal-wrap'>
                                                <?php
                                                $majc_totals = WC()->cart->get_totals();
                                                $majc_cart_total = $majc_totals['subtotal'];
                                                $majc_cart_discount = $majc_totals['discount_total'];
                                                $majc_final_subtotal = $majc_cart_total - $majc_cart_discount;
                                                ?>
                                                <label class='majc-total-label'><?php echo esc_html__('Subtotal', 'mini-ajax-cart'); ?></label>

                                                <div class='majc-subtotal-amount'>
                                                    <?php echo wp_kses_post(get_woocommerce_currency_symbol() . number_format($majc_final_subtotal, 2)); ?>
                                                </div>
                                            </div>
                                        <?php } ?>
                                    </div>

                                    <div class="majc-cart-action-btn-wrap">
                                        <?php if (trim($majc_shipping_text)) { ?>
                                            <p><?php echo esc_html($majc_shipping_text); ?></p>
                                        <?php } ?>

                                        <?php if ($majc_show_continue_shopping == 'on') { ?>
                                            <a class="majc-continue-shoping-btn majc-cart-action-btn majc-button" href="<?php echo esc_url($majc_continue_shopping_link); ?>">
                                                <?php echo esc_html($majc_continue_shopping_text); ?>
                                            </a>
                                        <?php } ?>

                                        <div class="majc-cart-checkout-btn">
                                            <?php if ($majc_show_view_cart == 'on') { ?>
                                                <a class="majc-view-cart-btn majc-cart-action-btn majc-button" href="<?php echo esc_url(wc_get_cart_url()); ?>">
                                                    <?php echo esc_html($majc_view_cart_text); ?>
                                                </a>
                                            <?php } ?>

                                            <?php if ($majc_show_checkout == 'on') { ?>
                                                <a class="majc-checkout-btn majc-cart-action-btn majc-button" href="<?php echo esc_url(wc_get_checkout_url()); ?>">
                                                    <?php echo esc_html($majc_checkout_text); ?>
                                                </a>
                                            <?php } ?>
                                        </div>
                                    </div> <!-- majc-footer -->
                                </div> <!-- majc-body -->

                            </div> <!-- majc-cart-popup-inner -->
                        </div> <!-- majc-cart-popup -->
                    </div> <!-- majc-main-inner-wrap -->

                    <div class="majc-main-wrapper-bg"></div>
                </div> <!-- majc-main-wrapper -->
                <?php
                // Custom CSS
                include MAJC_PATH . '/inc/frontend/custom-css.php';
            } //Not empty $majc_settings
        endwhile;
        wp_reset_postdata();
    endif;
}
?>