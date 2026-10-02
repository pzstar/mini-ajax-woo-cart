<?php
defined('ABSPATH') or die('No script please!!');

if (!class_exists('MAJC_Frontend')) {

    class MAJC_Frontend extends MAJC_Library {

        function __construct() {
            add_action('wp_footer', array($this, 'majc_menu'));

            add_filter('woocommerce_add_to_cart_fragments', array($this, 'add_to_cart_fragments'), 10, 1);

            add_action('wp_ajax_majc_change_item_qty', array($this, 'change_item_qty'));
            add_action('wp_ajax_nopriv_majc_change_item_qty', array($this, 'change_item_qty'));

            add_action('wp_ajax_majc_add_coupon_code', array($this, 'add_coupon_code'));
            add_action('wp_ajax_nopriv_majc_add_coupon_code', array($this, 'add_coupon_code'));

            add_action('wp_ajax_majc_remove_coupon_code', array($this, 'remove_coupon_code'));
            add_action('wp_ajax_nopriv_majc_remove_coupon_code', array($this, 'remove_coupon_code'));

            add_action('wp_ajax_majc_get_refresh_fragments', array($this, 'get_refreshed_fragments'));
            add_action('wp_ajax_nopriv_majc_get_refresh_fragments', array($this, 'get_refreshed_fragments'));

            add_action('wp_ajax_majc_remove_item', array($this, 'cart_remove_item'));
            add_action('wp_ajax_nopriv_majc_remove_item', array($this, 'cart_remove_item'));

            // Prevent Refresh from Adding Another Product in WooCommerce
            add_action('woocommerce_add_to_cart_redirect', array($this, 'prevent_add_to_cart_on_redirect'));
        }

        private function check_nonce() {
            if (!wp_verify_nonce(majc_get_post('wp_nonce'), 'majc-frontend-ajax-nonce')) {
                wp_send_json_error(array('msg' => esc_html__('Your session has expired. Please reload the page.', 'mini-ajax-cart')), 403);
            }
        }

        function prevent_add_to_cart_on_redirect($url = false) {
            if (!empty($url)) {
                return $url;
            }

            return add_query_arg(array(), remove_query_arg('add-to-cart'));
        }

        public function change_item_qty() {
            $this->check_nonce();

            $cart_key = majc_get_post('ckey');
            $qty = majc_get_post('qty');
            $cart_item = WC()->cart->get_cart_item($cart_key);
            if (!$cart_item || !is_numeric($qty)) {
                wp_send_json_error();
            }

            // Respect stock and "sold individually" limits, which set_quantity() does not check.
            $product = $cart_item['data'];
            $qty = max(0, wc_stock_amount($qty));
            $max = $product->is_sold_individually() ? 1 : $product->get_max_purchase_quantity();
            if ($max > 0) {
                $qty = min($qty, $max);
            }

            WC()->cart->set_quantity($cart_key, $qty, true);
            wp_send_json_success();
        }

        public function remove_coupon_code() {
            $this->check_nonce();

            $code = wc_format_coupon_code(majc_get_post('couponCode'));
            if (!$code || !WC()->cart->remove_coupon($code)) {
                wp_send_json_error();
            }

            WC()->cart->calculate_totals();
            wc_clear_notices();
            wp_send_json_success(array('msg' => esc_html__('Coupon Removed Successfully.', 'mini-ajax-cart')));
        }

        public function add_coupon_code() {
            $this->check_nonce();

            $code = wc_format_coupon_code(majc_get_post('couponCode'));

            if (!$code) {
                wp_send_json_error(array('msg' => esc_html__('Coupon Code Field is Empty!', 'mini-ajax-cart')));
            }

            if (WC()->cart->has_discount($code)) {
                wp_send_json_error(array('msg' => esc_html__('Coupon Code Already Applied.', 'mini-ajax-cart')));
            }

            // apply_coupon() runs WooCommerce's full validation (usage limits, emails, products) and leaves its own notices.
            $applied = WC()->cart->apply_coupon($code);
            wc_clear_notices();

            if (!$applied) {
                wp_send_json_error(array('msg' => esc_html__('Invalid code entered. Please try again.', 'mini-ajax-cart')));
            }

            WC()->cart->calculate_totals();
            wp_send_json_success(array('msg' => esc_html__('Coupon Applied Successfully.', 'mini-ajax-cart')));
        }

        public static function cart_items_html() {
            ob_start();
            ?>
            <div class="majc-cart-item-wrap">
                <?php if (!WC()->cart->is_empty()) { ?>
                    <div class="majc-mini-cart">
                        <?php
                        foreach (WC()->cart->get_cart() as $majc_item_key => $majc_item_val) {
                            $majc_product = apply_filters('woocommerce_cart_item_product', $majc_item_val['data'], $majc_item_val, $majc_item_key);
                            if (!$majc_product || !$majc_product->exists()) {
                                continue;
                            }
                            $majc_product_id = apply_filters('woocommerce_cart_item_product_id', $majc_item_val['product_id'], $majc_item_val, $majc_item_key);
                            $majc_parent_product = wc_get_product($majc_item_val['product_id']);
                            ?>
                            <div class="majc-cart-items" data-itemId="<?php echo esc_attr($majc_item_val['product_id']); ?>" data-cKey="<?php echo esc_attr($majc_item_key); ?>">
                                <div class="majc-cart-items-inner">
                                    <div class="majc-item-img">
                                        <?php echo wp_kses_post($majc_parent_product ? $majc_parent_product->get_image('thumbnail') : $majc_product->get_image('thumbnail')); ?>
                                    </div>

                                    <div class="majc-item-desc">
                                        <div class="majc-item-remove">
                                            <?php
                                            echo wp_kses_post(apply_filters('woocommerce_cart_item_remove_link', sprintf('<a href="%s" class="majc-remove" aria-label="%s" data-cart_item_id="%s" data-cart_item_sku="%s" data-cart_item_key="%s"><span class="icon_trash_alt"></span></a>', esc_url(wc_get_cart_remove_url($majc_item_key)), esc_attr__('Remove this item', 'mini-ajax-cart'), esc_attr($majc_product_id), esc_attr($majc_product->get_sku()), esc_attr($majc_item_key)), $majc_item_key));
                                            ?>
                                        </div>

                                        <div class="majc-item-name">
                                            <?php echo esc_html($majc_product->get_name()); ?>
                                        </div>

                                        <div class="majc-item-price">
                                            <?php echo wp_kses_post(WC()->cart->get_product_subtotal($majc_product, $majc_item_val['quantity'])); ?>
                                        </div>

                                        <div class="majc-item-qty">
                                            <span class="majc-qty-minus majc-qty-chng icon_minus-06"></span>
                                            <?php
                                            if ($majc_product->is_sold_individually()) {
                                                $majc_product_quantity = sprintf('1 <input type="hidden" name="cart[%s][qty]" value="1" />', esc_attr($majc_item_key));
                                            } else {
                                                $majc_product_quantity = woocommerce_quantity_input(array(
                                                    'input_name' => 'majc-qty-input',
                                                    'input_value' => $majc_item_val['quantity'],
                                                    'max_value' => $majc_product->get_max_purchase_quantity(),
                                                    'min_value' => '0',
                                                    'product_name' => $majc_product->get_name(),
                                                ), $majc_product, false);
                                            }
                                            echo apply_filters('woocommerce_cart_item_quantity', $majc_product_quantity, $majc_item_key, $majc_item_val); // PHPCS: XSS ok.
                                            ?>
                                            <span class="majc-qty-plus majc-qty-chng icon_plus"></span>
                                        </div>
                                    </div> <!-- majc-item-desc -->
                                </div> <!-- majc-cart-items-inner -->
                            </div> <!-- majc-cart-items -->
                            <?php
                        }
                        ?>
                    </div>
                <?php } ?>
            </div>
            <?php
            return ob_get_clean();
        }

        public static function applied_coupons_html() {
            $majc_applied_coupons = WC()->cart->get_applied_coupons();
            if (empty($majc_applied_coupons)) {
                return '<ul class="majc-applied-cpns" style="display: none;"><li></li></ul>';
            }

            ob_start();
            ?>
            <ul class="majc-applied-cpns">
                <?php foreach ($majc_applied_coupons as $majc_cpns) { ?>
                    <li data-code="<?php echo esc_attr($majc_cpns); ?>"><?php echo esc_html($majc_cpns); ?> <span class="majc-remove-cpn icofont-close-line"></span></li>
                <?php } ?>
            </ul>
            <?php
            return ob_get_clean();
        }

        // Cart subtotal after discounts.
        public static function subtotal_html() {
            $majc_totals = WC()->cart->get_totals();
            return '<div class="majc-subtotal-amount">' . wc_price($majc_totals['subtotal'] - $majc_totals['discount_total']) . '</div>';
        }

        public static function cart_total_html() {
            return '<div class="majc-cart-total-amount">' . wc_price(WC()->cart->get_subtotal() + WC()->cart->get_subtotal_tax()) . '</div>';
        }

        public static function discount_html() {
            return '<div class="majc-cart-discount-amount">' . wc_price(WC()->cart->get_cart_discount_total() + WC()->cart->get_cart_discount_tax_total()) . '</div>';
        }

        public function add_to_cart_fragments($fragments) {
            $fragments['div.majc-cart-item-wrap'] = self::cart_items_html();
            $fragments['div.majc-subtotal-amount'] = self::subtotal_html();
            $fragments['div.majc-cart-total-amount'] = self::cart_total_html();
            $fragments['div.majc-cart-discount-amount'] = self::discount_html();
            $fragments['.majc-check-cart'] = WC()->cart->is_empty() ? '<div class="majc-check-cart majc-hide-cart-items"></div>' : '<div class="majc-check-cart"></div>';
            $fragments['ul.majc-applied-cpns'] = self::applied_coupons_html();

            // Update the Items Count In the Cart
            $fragments['.majc-cart-qty-count'] = '<span class="majc-cart-qty-count">' . esc_html__('Quantity: ', 'mini-ajax-cart') . absint(WC()->cart->get_cart_contents_count()) . '</span>';
            $fragments['.majc-cart-items-count'] = '<span class="majc-cart-items-count">' . esc_html__('Items: ', 'mini-ajax-cart') . count(WC()->cart->get_cart()) . '</span>';

            // Cart Basket Items Count
            $fragments['.majc-item-count-wrap .majc-cart-item-count'] = '<span class="majc-cart-item-count">' . absint(WC()->cart->get_cart_contents_count()) . '</span>';

            return $fragments;
        }

        public function majc_menu() {
            if (!(defined('REST_REQUEST') && REST_REQUEST)) {
                include MAJC_PATH . '/inc/frontend/front.php';
            }
        }

        // Read-only, like WooCommerce's own wc-ajax=get_refreshed_fragments, so it needs no nonce.
        public function get_refreshed_fragments() {
            WC_AJAX::get_refreshed_fragments();
        }

        public function cart_remove_item() {
            $this->check_nonce();

            $cart_key = majc_get_post('cart_item_key');
            if (WC()->cart->get_cart_item($cart_key)) {
                WC()->cart->remove_cart_item($cart_key);
            }

            WC_AJAX::get_refreshed_fragments();
        }

        public static function hide_show_pages($pageid, $majc_specific_page, $majc_hide_show, $majc_front, $majc_blog, $majc_cpt, $majc_error, $majc_search, $majc_archive, $posttype, $majc_specific_archive, $majc_current_archive) {
            $majc_show = true;

            switch ($majc_hide_show) {
                case 'show_all':
                    $majc_show = true;
                    break;

                case 'hide_all':
                    $majc_show = false;
                    break;

                case 'show_selected':
                    $majc_show = false;
                    if (in_array($pageid, $majc_specific_page)) {
                        $majc_show = true;
                    }
                    if (is_singular() && !is_archive() && in_array($posttype, $majc_cpt)) {
                        $majc_show = true;
                    }
                    if ($majc_front == 'on' && ('front' == $majc_current_archive)) {
                        $majc_show = true;
                    }
                    if ($majc_blog == 'on' && ('front' == $majc_current_archive)) {
                        $majc_show = true;
                    }
                    if ($majc_error == 'on' && is_404()) {
                        $majc_show = true;
                    }
                    if ($majc_search == 'on' && is_search()) {
                        $majc_show = true;
                    }
                    if ($majc_archive == 'on' && is_archive()) {
                        $majc_show = true;
                    }
                    if ($majc_archive == 'on' && ('post' == $majc_current_archive && !is_singular())) {
                        $majc_show = true;
                    }
                    if (!is_singular() && in_array($majc_current_archive, $majc_specific_archive)) {
                        $majc_show = true;
                    }
                    break;

                case 'hide_selected':
                    $majc_show = true;
                    if (is_singular() && !is_archive() && in_array($posttype, $majc_cpt)) {
                        $majc_show = false;
                    }
                    if (in_array($pageid, $majc_specific_page)) {
                        $majc_show = false;
                    }
                    if ($majc_front == 'on' && ('front' == $majc_current_archive)) {
                        $majc_show = false;
                    }
                    if ($majc_blog == 'on' && ('front' == $majc_current_archive)) {
                        $majc_show = false;
                    }
                    if ($majc_error == 'on' && is_404()) {
                        $majc_show = false;
                    }
                    if ($majc_search == 'on' && is_search()) {
                        $majc_show = false;
                    }
                    if ($majc_archive == 'on' && ('post' == $majc_current_archive && !is_singular())) {
                        $majc_show = false;
                    }
                    if (!is_singular() && in_array($majc_current_archive, $majc_specific_archive)) {
                        $majc_show = false;
                    }
                    break;
            }
            return $majc_show;
        }

    }

    new MAJC_Frontend();
}