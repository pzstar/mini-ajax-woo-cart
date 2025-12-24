<?php
defined('ABSPATH') or die('No script please!!');

if (!class_exists('MAJC_Frontend')) {

    class MAJC_Frontend extends MAJC_Library {

        function __construct() {
            add_action('wp_footer', array($this, 'majc_menu'));

            add_filter('woocommerce_add_to_cart_fragments', array($this, 'add_to_cart_fragments'), 10, 1);

            // Change The Quantiy of the Woocommerce Product
            add_action('wp_ajax_change_item_qty', array($this, 'change_item_qty'));
            add_action('wp_ajax_nopriv_change_item_qty', array($this, 'change_item_qty'));

            add_action('wp_ajax_add_coupon_code', array($this, 'addCouponCode'));
            add_action('wp_ajax_nopriv_add_coupon_code', array($this, 'addCouponCode'));

            add_action('wp_ajax_remove_coupon_code', array($this, 'remove_coupon_code'));
            add_action('wp_ajax_nopriv_remove_coupon_code', array($this, 'remove_coupon_code'));

            add_action('wp_ajax_get_refresh_fragments', array($this, 'get_refreshed_fragments'));
            add_action('wp_ajax_nopriv_get_refresh_fragments', array($this, 'get_refreshed_fragments'));

            add_action('wp_ajax_remove_item', array($this, 'cart_remove_item'));
            add_action('wp_ajax_nopriv_remove_item', array($this, 'cart_remove_item'));

            // Prevent Refresh from Adding Another Product in WooCommerce
            add_action('woocommerce_add_to_cart_redirect', array($this, 'prevent_add_to_cart_on_redirect'));
        }

        private function checkNonce() {
            if (wp_verify_nonce(majc_get_post('wp_nonce'), 'majc-frontend-ajax-nonce')) {
                return true;
            } else {
                return false;
            }
        }

        function prevent_add_to_cart_on_redirect($url = false) {
            if (!empty($url)) {
                return $url;
            }

            return add_query_arg(array(), remove_query_arg('add-to-cart'));
        }

        function change_item_qty() {
            if (!$this->checkNonce()) {
                return false;
            }

            $c_key = majc_get_request('ckey', 'sanitize_text_field', null);
            $qty = majc_get_request('qty', 'sanitize_text_field', null);
            WC()->cart->set_quantity($c_key, $qty, true);
            WC()->cart->set_session();
            die();
        }

        public function remove_coupon_code() {
            if (!$this->checkNonce()) {
                return;
            }

            $majc_couponCode = majc_get_post('couponCode', 'sanitize_text_field', null);

            if (WC()->cart->remove_coupon($majc_couponCode)) {
                esc_html_e('Coupon Removed Successfully.', 'mini-ajax-cart');
            }

            WC()->cart->calculate_totals();
            WC()->cart->maybe_set_cart_cookies();
            WC()->cart->set_session();

            die();
        }

        public function addCouponResponse($response) {
            header('Content-Type: application/json');
            echo json_encode($response);

            WC()->cart->calculate_totals();
            WC()->cart->maybe_set_cart_cookies();
            WC()->cart->set_session();
        }

        public function addCouponCode() {
            if (!$this->checkNonce()) {
                return;
            }

            $code = majc_get_post('couponCode', 'sanitize_text_field', null);
            $code = strtolower($code);

            /* Check if coupon code is empty */
            if (empty($code) || !isset($code)) {

                $response = array(
                    'result' => 'empty',
                    'msg' => esc_html__('Coupon Code Field is Empty!', 'mini-ajax-cart')
                );

                $this->addCouponResponse($response);

                exit();
            }

            /* Create an instance of WC_Coupon with our code */
            $majc_coupon = new WC_Coupon($code);
            $majc_applied_coupons = WC()->cart->get_applied_coupons();

            if (in_array($code, $majc_applied_coupons)) {

                $response = array(
                    'result' => 'already applied',
                    'msg' => esc_html__('Coupon Code Already Applied.', 'mini-ajax-cart')
                );

                $this->addCouponResponse($response);
            } else if (!$majc_coupon->is_valid()) {

                $response = array(
                    'result' => 'not valid',
                    'msg' => esc_html__('Invalid code entered. Please try again.', 'mini-ajax-cart')
                );

                $this->addCouponResponse($response);
            } else {

                WC()->cart->apply_coupon($code);

                $response = array(
                    'result' => 'success',
                    'msg' => esc_html__('Coupon Applied Successfully.', 'mini-ajax-cart')
                );

                $this->addCouponResponse($response);

                wc_clear_notices();
            }
            die();
        }

        public function add_to_cart_fragments($fragments) {
            WC()->cart->calculate_totals();
            WC()->cart->maybe_set_cart_cookies();
            global $woocommerce;
            ob_start();
            ?>
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

                                        <div class="majc-item-price">
                                            <?php
                                            $majc_wc_product = $majc_item_val['data'];
                                            echo wp_kses_post(WC()->cart->get_product_subtotal($majc_wc_product, $majc_item_val['quantity']));
                                            ?>
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
                                    </div> <!-- majc-item-desc -->
                                </div> <!-- majc-cart-items-inner -->
                            </div> <!-- majc-cart-items -->
                            <?php
                        } // product foreach loop ends
                        ?>
                    </div>
                <?php } ?>
            </div>
            <?php
            $majc_cart_body_contents = ob_get_clean();
            $fragments['div.majc-cart-item-wrap'] = $majc_cart_body_contents;

            // Update subtotal Amount
            $majc_totals = WC()->cart->get_totals();
            $majc_cart_total = $majc_totals['subtotal'];
            $majc_cart_discount = $majc_totals['discount_total'];
            $majc_final_subtotal = $majc_cart_total - $majc_cart_discount;
            $subtotal = "<div class='majc-subtotal-amount'>" . get_woocommerce_currency_symbol() . number_format($majc_final_subtotal, 2) . "</div>";
            $fragments['div.majc-subtotal-amount'] = $subtotal;

            // Update Total Amount
            $majc_cartTotal = '<div class="majc-cart-total-amount">' . wc_price(WC()->cart->get_subtotal() + WC()->cart->get_subtotal_tax()) . '</div>';
            $fragments['div.majc-cart-total-amount'] = $majc_cartTotal;

            // Update Discount Amount
            $discountTotal = '<div class="majc-cart-discount-amount">' . wc_price(WC()->cart->get_cart_discount_total() + WC()->cart->get_cart_discount_tax_total()) . '</div>';
            $fragments['div.majc-cart-discount-amount'] = $discountTotal;

            $fragments['.majc-check-cart'] = WC()->cart->is_empty() ? '<div class="majc-check-cart majc-hide-cart-items"></div>' : '<div class="majc-check-cart"></div>';

            // Update Applied Coupon
            $majc_applied_coupons = WC()->cart->get_applied_coupons();
            ob_start();
            if (!empty($majc_applied_coupons)) {
                ?>

                <ul class='majc-applied-cpns'>
                    <?php foreach ($majc_applied_coupons as $majc_cpns) { ?>
                        <li data-code='<?php echo esc_attr($majc_cpns); ?>'><?php echo esc_attr($majc_cpns); ?> <span class='majc-remove-cpn icofont-close-line'></span></li>
                    <?php } ?>
                </ul>
                <?php
            } else {
                echo '<ul class="majc-applied-cpns" style="display: none;"><li></li></ul>';
            }
            $majc_cart_cpn = ob_get_clean();
            $fragments['ul.majc-applied-cpns'] = $majc_cart_cpn;

            // Update the Items Count In the Cart
            $fragments['.majc-cart-qty-count'] = '<span class="majc-cart-qty-count">' . esc_html__('Quantity: ', 'mini-ajax-cart') . WC()->cart->get_cart_contents_count() . '</span>';
            $fragments['.majc-cart-items-count'] = '<span class="majc-cart-items-count">' . esc_html__('Items: ', 'mini-ajax-cart') . sizeof(WC()->cart->get_cart()) . '</span>';

            // Cart Basket Items Count
            $fragments['.majc-item-count-wrap .majc-cart-item-count'] = '<span class="majc-cart-item-count">' . WC()->cart->get_cart_contents_count() . '</span>';

            return $fragments;
        }

        public function majc_menu() {
            if (!(defined('REST_REQUEST') && REST_REQUEST)) {
                include MAJC_PATH . '/inc/frontend/front.php';
            }
        }

        public function get_refreshed_fragments() {

            if (!$this->checkNonce()) {
                return;
            }

            WC_AJAX::get_refreshed_fragments();
        }

        public function cart_remove_item() {

            if (!$this->checkNonce()) {
                return;
            }

            ob_start();
            foreach (WC()->cart->get_cart() as $majc_cart_item_key => $majc_cart_item) {
                if ($majc_cart_item['product_id'] == majc_get_post('cart_item_id') && $majc_cart_item_key == majc_get_post('cart_item_key')) {
                    WC()->cart->remove_cart_item($majc_cart_item_key);
                }
            }

            WC()->cart->calculate_totals();
            WC()->cart->maybe_set_cart_cookies();

            woocommerce_mini_cart();

            $mini_cart = ob_get_clean();

            // Fragments and mini cart are returned
            $data = array(
                'fragments' => apply_filters('woocommerce_add_to_cart_fragments', array(
                    'div.widget_shopping_cart_content' => '<div class="widget_shopping_cart_content">' . $mini_cart . '</div>'
                )),
                'cart_hash' => apply_filters('woocommerce_add_to_cart_hash', WC()->cart->get_cart_for_session() ? md5(json_encode(WC()->cart->get_cart_for_session())) : '', WC()->cart->get_cart_for_session())
            );

            wp_send_json($data);
            die();
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