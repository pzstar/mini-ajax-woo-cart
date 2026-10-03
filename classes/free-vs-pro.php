<?php
defined('ABSPATH') or die('No script please!!');

if (!class_exists('MAJC_Free_Vs_Pro')) {

    // The Free vs Pro page: what Ultimate WooCommerce Cart (Pro) adds to this plugin.
    // Every number is the count of choices each plugin actually offers, so check both plugins before changing one.
    class MAJC_Free_Vs_Pro {

        const PRO_URL = 'https://1.envato.market/2rKYB0';
        const DEMO_URL = 'https://demo.hashthemes.com/ultimate-woocommerce-cart/';

        private $section_open = false;

        function __construct() {
            add_action('admin_menu', array($this, 'add_page'), 9);
        }

        public function add_page() {
            add_submenu_page('edit.php?post_type=ultimate-woo-cart', esc_html__('Free vs Pro', 'mini-ajax-cart'), esc_html__('Free vs Pro', 'mini-ajax-cart'), 'manage_woocommerce', 'majc-free-vs-pro', array($this, 'page'));
        }

        // $free and $pro are array(text, state); state is yes, no or plain.
        private function row($feature, $desc, $free, $pro, $demo = '') {
            echo '<tr><td class="majc-compare-feature"><span class="majc-compare-name">' . esc_html($feature) . '</span>';
            if ($demo) {
                echo ' <a class="majc-compare-demo" href="' . esc_url(self::DEMO_URL . $demo) . '" target="_blank" rel="noopener">' . esc_html__('Demo', 'mini-ajax-cart') . '</a>';
            }
            if ($desc) {
                echo '<span class="majc-compare-desc">' . esc_html($desc) . '</span>';
            }
            echo '</td>';
            $this->cell($free);
            $this->cell($pro);
            echo '</tr>';
        }

        private function cell($value) {
            list($text, $state) = $value;
            $icons = array('yes' => 'dashicons-yes', 'no' => 'dashicons-no-alt');
            echo '<td class="majc-compare-' . esc_attr($state) . '">';
            if (isset($icons[$state])) {
                echo '<span class="dashicons ' . esc_attr($icons[$state]) . '" aria-hidden="true"></span>';
            }
            echo esc_html($text) . '</td>';
        }

        private function cols() {
            return '<colgroup><col><col class="majc-compare-col-free"><col class="majc-compare-col-pro"></colgroup>';
        }

        // Each group is its own card; opening one closes the previous.
        private function heading($title) {
            $this->end();
            $this->section_open = true;
            echo '<div class="majc-compare-section"><h3>' . esc_html($title) . '</h3><table>' . $this->cols(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- fixed markup.
        }

        private function end() {
            if ($this->section_open) {
                echo '</table></div>';
                $this->section_open = false;
            }
        }

        public function page() {
            $yes = array(__('Yes', 'mini-ajax-cart'), 'yes');
            $no = array(__('No', 'mini-ajax-cart'), 'no');
            $pro_yes = $yes;
            ?>
            <div class="wrap majc-compare-wrap">
                <?php // Admin notices are placed here, not inside the intro card. ?>
                <hr class="wp-header-end">
                <div class="majc-compare-hero">
                    <div>
                        <h1><?php esc_html_e('Mini Ajax Cart vs Ultimate WooCommerce Cart', 'mini-ajax-cart'); ?></h1>
                        <p><?php esc_html_e('Ultimate WooCommerce Cart is the Pro version of Mini Ajax Cart. It adds more cart layouts and designs, plus tools that grow every order: cart rewards, special offers, a countdown timer, an Added to Cart popup and analytics.', 'mini-ajax-cart'); ?></p>
                        <p class="majc-compare-note"><?php esc_html_e('Pro uses the same carts, so the carts you build here carry over when you upgrade.', 'mini-ajax-cart'); ?></p>
                    </div>
                    <div class="majc-compare-actions">
                        <a class="button button-primary button-hero" href="<?php echo esc_url(self::PRO_URL); ?>" target="_blank" rel="noopener"><?php esc_html_e('Get Pro', 'mini-ajax-cart'); ?></a>
                        <a class="button button-hero" href="<?php echo esc_url(self::DEMO_URL); ?>" target="_blank" rel="noopener"><?php esc_html_e('View Demos', 'mini-ajax-cart'); ?></a>
                    </div>
                </div>

                <div class="majc-compare-table">
                    <table class="majc-compare-head">
                        <?php echo $this->cols(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped -- fixed markup. ?>
                        <tr>
                            <th><?php esc_html_e('Feature', 'mini-ajax-cart'); ?></th>
                            <th><?php esc_html_e('Free', 'mini-ajax-cart'); ?></th>
                            <th class="majc-compare-pro-head"><?php esc_html_e('Pro', 'mini-ajax-cart'); ?></th>
                        </tr>
                    </table>

                    <?php
                    $this->heading(__('Cart Layouts & Templates', 'mini-ajax-cart'));
                    $this->row(__('Cart Layouts', 'mini-ajax-cart'), __('Slide In opens from the side, Floating opens beside the button and Popup opens in the middle of the screen.', 'mini-ajax-cart'), array(__('Slide In', 'mini-ajax-cart'), 'yes'), array(__('Slide In, Floating & Popup', 'mini-ajax-cart'), 'plain'), 'floating-cart/');
                    $this->row(__('Ready-Made Templates', 'mini-ajax-cart'), __('Complete cart designs, imported in one click.', 'mini-ajax-cart'), $no, array(__('15 templates', 'mini-ajax-cart'), 'plain'), 'templates/');
                    $this->row(__('Design the Cart with Elementor', 'mini-ajax-cart'), __('Build the cart content in Elementor with dedicated cart widgets.', 'mini-ajax-cart'), $no, array(__('17 cart widgets', 'mini-ajax-cart'), 'plain'), 'cart-elementor-widgets/');
                    $this->row(__('Multiple Carts', 'mini-ajax-cart'), __('Create different carts for different pages or devices.', 'mini-ajax-cart'), $yes, $pro_yes);
                    $this->row(__('Import & Export Settings', 'mini-ajax-cart'), __('Copy a cart\'s settings to another cart or another site.', 'mini-ajax-cart'), $no, $pro_yes);

                    $this->heading(__('Cart Button', 'mini-ajax-cart'));
                    $this->row(__('Button Icon', 'mini-ajax-cart'), __('The default icon, an icon from 5 icon libraries, or your own image.', 'mini-ajax-cart'), $yes, $pro_yes);
                    $this->row(__('Button Shapes', 'mini-ajax-cart'), __('Pro adds triangle, oval, star, rhombus, pentagon, hexagon, rabbet and an animated blob.', 'mini-ajax-cart'), array(__('3 shapes', 'mini-ajax-cart'), 'yes'), array(__('11 shapes', 'mini-ajax-cart'), 'plain'), 'add-to-cart-animations/');
                    $this->row(__('Button Positions', 'mini-ajax-cart'), __('Pro places the button in any corner, the middle of either side or the bottom center, with custom offsets.', 'mini-ajax-cart'), array(__('Left or right middle', 'mini-ajax-cart'), 'yes'), array(__('7 positions + offsets', 'mini-ajax-cart'), 'plain'));
                    $this->row(__('Hover Animations', 'mini-ajax-cart'), '', array(__('3 animations', 'mini-ajax-cart'), 'yes'), array(__('29 animations', 'mini-ajax-cart'), 'plain'), 'add-to-cart-animations/');
                    $this->row(__('Idle Animations', 'mini-ajax-cart'), __('A repeating animation that draws the eye to the button.', 'mini-ajax-cart'), $no, array(__('9 animations', 'mini-ajax-cart'), 'plain'), 'add-to-cart-animations/');
                    $this->row(__('Item Count Badge', 'mini-ajax-cart'), '', $yes, $pro_yes);
                    $this->row(__('Hide the Button When the Cart Is Empty', 'mini-ajax-cart'), '', $no, $pro_yes);
                    $this->row(__('Open the Cart from Any Link', 'mini-ajax-cart'), __('Add a class to a menu item, button or icon to open the cart from it.', 'mini-ajax-cart'), $no, $pro_yes, 'open-add-to-cart-panel/');
                    $this->row(__('Glassmorphism Background', 'mini-ajax-cart'), __('A frosted glass look for the button and the cart.', 'mini-ajax-cart'), $no, $pro_yes, 'glassmorphism/');

                    $this->heading(__('Cart Panel', 'mini-ajax-cart'));
                    $this->row(__('Open & Close Animations', 'mini-ajax-cart'), '', array(__('5 each', 'mini-ajax-cart'), 'yes'), array(__('37 each', 'mini-ajax-cart'), 'plain'), 'add-to-cart-animations/');
                    $this->row(__('Content Width & Overlay', 'mini-ajax-cart'), '', $yes, $pro_yes);
                    $this->row(__('Open the Cart When a Product Is Added', 'mini-ajax-cart'), '', $no, $pro_yes, 'open-cart-on-add-to-cart/');
                    $this->row(__('Lock Page Scroll', 'mini-ajax-cart'), __('The page behind stays still while the cart is open.', 'mini-ajax-cart'), $no, $pro_yes);
                    $this->row(__('Cart Shortcode', 'mini-ajax-cart'), __('Place the cart anywhere, or only its contents in a sidebar.', 'mini-ajax-cart'), $no, $pro_yes);
                    $this->row(__('RTL Languages', 'mini-ajax-cart'), '', $yes, $pro_yes, 'rtl-cart/');

                    $this->heading(__('Cart Content', 'mini-ajax-cart'));
                    $this->row(__('Header, Products, Coupon & Buttons', 'mini-ajax-cart'), __('Change quantities, remove items, apply coupons, and the View Cart, Checkout and Continue Shopping buttons.', 'mini-ajax-cart'), $yes, $pro_yes);
                    $this->row(__('Products as a List or Grid', 'mini-ajax-cart'), '', $yes, array(__('Yes, with grid columns', 'mini-ajax-cart'), 'yes'));
                    $this->row(__('Reorder & Turn Off Sections', 'mini-ajax-cart'), __('Drag the cart sections into any order.', 'mini-ajax-cart'), $no, $pro_yes);
                    $this->row(__('Available Coupons List', 'mini-ajax-cart'), __('Shows the coupons any shopper can use, next to the coupon field.', 'mini-ajax-cart'), $no, $pro_yes);
                    $this->row(__('Suggested Products', 'mini-ajax-cart'), __('A carousel of cross-sells, upsells, related or hand-picked products.', 'mini-ajax-cart'), $no, $pro_yes);
                    $this->row(__('Free Shipping Bar', 'mini-ajax-cart'), __('Shows how much more to spend for free shipping, with a progress bar.', 'mini-ajax-cart'), $no, $pro_yes);
                    $this->row(__('Shipping Methods & Order Note', 'mini-ajax-cart'), __('Shoppers pick a shipping method and add a note without leaving the cart.', 'mini-ajax-cart'), $no, $pro_yes);
                    $this->row(__('Checkout Inside the Cart', 'mini-ajax-cart'), __('Shoppers fill in their details and place the order right in the cart.', 'mini-ajax-cart'), $no, $pro_yes, 'checkout-in-cart/');
                    $this->row(__('Change Options in the Cart', 'mini-ajax-cart'), __('Switch a product\'s size or color from the cart.', 'mini-ajax-cart'), $no, $pro_yes, 'change-options-save-for-later/');
                    $this->row(__('Save for Later', 'mini-ajax-cart'), __('Move items out of the cart into a saved list, and back.', 'mini-ajax-cart'), $no, $pro_yes, 'change-options-save-for-later/');
                    $this->row(__('Remove All Button', 'mini-ajax-cart'), __('Empties the cart in one click.', 'mini-ajax-cart'), $no, $pro_yes);
                    $this->row(__('Empty Cart Message', 'mini-ajax-cart'), __('What the cart shows when it has no products.', 'mini-ajax-cart'), array(__('Fixed text & icon', 'mini-ajax-cart'), 'yes'), array(__('Your own text & icon', 'mini-ajax-cart'), 'plain'));

                    $this->heading(__('Grow Your Sales', 'mini-ajax-cart'));
                    $this->row(__('Cart Rewards', 'mini-ajax-cart'), __('A progress bar that unlocks free shipping, discounts and free gifts as the cart grows.', 'mini-ajax-cart'), $no, $pro_yes, 'cart-rewards/');
                    $this->row(__('Cart Offers', 'mini-ajax-cart'), __('Hand-picked products at a special price inside the cart, added in one click.', 'mini-ajax-cart'), $no, $pro_yes, 'cart-offers/');
                    $this->row(__('Cart Timer & Low Stock Notice', 'mini-ajax-cart'), __('A countdown in the cart, and a notice when an item is running low.', 'mini-ajax-cart'), $no, $pro_yes, 'cart-timer-low-stock/');
                    $this->row(__('Added to Cart Popup', 'mini-ajax-cart'), __('Shows the added product with suggested products, rewards and offers.', 'mini-ajax-cart'), $no, $pro_yes, 'added-to-cart-popup/');
                    $this->row(__('Popup Animations', 'mini-ajax-cart'), '', $no, array(__('37 each, in & out', 'mini-ajax-cart'), 'plain'), 'added-to-cart-popup-animations/');
                    $this->row(__('Sticky Add to Cart Bar', 'mini-ajax-cart'), __('Keeps the Add to Cart button in view on product pages.', 'mini-ajax-cart'), $no, $pro_yes);
                    $this->row(__('Cart Analytics', 'mini-ajax-cart'), __('See the revenue your offers and rewards bring in.', 'mini-ajax-cart'), $no, $pro_yes);

                    $this->heading(__('Display & Store Settings', 'mini-ajax-cart'));
                    $this->row(__('Hide on Desktop, Tablet or Mobile', 'mini-ajax-cart'), '', $yes, $pro_yes);
                    $this->row(__('Show or Hide on Chosen Pages', 'mini-ajax-cart'), '', $yes, $pro_yes);
                    $this->row(__('Show to Chosen Users', 'mini-ajax-cart'), __('Everyone, logged-in customers, guests or chosen user roles.', 'mini-ajax-cart'), $no, $pro_yes);
                    $this->row(__('Ajax Add to Cart on Product Pages', 'mini-ajax-cart'), __('Add to cart from a product page without the page reloading.', 'mini-ajax-cart'), $no, $pro_yes);
                    $this->row(__('Open from the Mini-Cart Block', 'mini-ajax-cart'), __('For block themes: the header Mini-Cart block opens this cart.', 'mini-ajax-cart'), $no, $pro_yes);
                    $this->row(__('Colors & Typography', 'mini-ajax-cart'), '', $yes, $pro_yes);
                    $this->row(__('Load Google Fonts Locally', 'mini-ajax-cart'), __('Serves the fonts from your own site instead of Google\'s, which helps with GDPR.', 'mini-ajax-cart'), $no, $pro_yes);
                    $this->row(__('Custom CSS', 'mini-ajax-cart'), '', $no, $pro_yes);

                    $this->heading(__('Updates & Support', 'mini-ajax-cart'));
                    $this->row(__('Updates', 'mini-ajax-cart'), '', array(__('One click, from WordPress.org', 'mini-ajax-cart'), 'plain'), array(__('One click, once your license is activated', 'mini-ajax-cart'), 'plain'));
                    $this->row(__('Support', 'mini-ajax-cart'), '', array(__('WordPress.org forum', 'mini-ajax-cart'), 'plain'), array(__('Direct support from us', 'mini-ajax-cart'), 'plain'));
                    $this->row(__('Price', 'mini-ajax-cart'), '', array(__('Free', 'mini-ajax-cart'), 'plain'), array(__('One-time payment', 'mini-ajax-cart'), 'plain'));
                    $this->end();
                    ?>

                    <div class="majc-compare-footer">
                        <a class="button button-hero" href="<?php echo esc_url(self::DEMO_URL); ?>" target="_blank" rel="noopener"><?php esc_html_e('View Demos', 'mini-ajax-cart'); ?></a>
                        <a class="button button-primary button-hero" href="<?php echo esc_url(self::PRO_URL); ?>" target="_blank" rel="noopener"><?php esc_html_e('Get Pro', 'mini-ajax-cart'); ?></a>
                    </div>
                </div>
            </div>
            <?php
        }

    }

    new MAJC_Free_Vs_Pro();
}
