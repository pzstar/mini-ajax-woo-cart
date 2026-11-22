<?php
defined('ABSPATH') or die('No script please!!');

/**
 * Seasonal sale promo for Ultimate WooCommerce Cart, drawn as a side cart.
 */
if (!class_exists('MAJC_Sale')) {

    class MAJC_Sale {

        const POST_TYPE = 'ultimate-woo-cart';

        private $sale = false;

        function __construct() {
            // admin_menu runs before admin_init, so each hook checks the sale itself.
            add_action('admin_menu', array($this, 'menu_badge'), 999);
            add_action('admin_init', array($this, 'init'));
        }

        /**
         * The sale running today, or false. Month-day windows, so they repeat yearly.
         */
        public static function active_sale() {
            $sales = apply_filters('majc_sale_campaigns', array(
                array(
                    'id' => 'blackfriday',
                    'start' => '11-20',
                    'end' => '12-02',
                    'label' => __('Black Friday', 'mini-ajax-cart'),
                    'button' => __('Checkout the Black Friday deal', 'mini-ajax-cart'),
                    'discount' => 40,
                ),
                array(
                    'id' => 'newyear',
                    'start' => '12-15',
                    'end' => '01-05',
                    'label' => __('Holiday Sale', 'mini-ajax-cart'),
                    'button' => __('Checkout the holiday deal', 'mini-ajax-cart'),
                    'discount' => 40,
                ),
            ));

            $today = current_time('m-d');

            foreach ($sales as $sale) {
                if (empty($sale['start']) || empty($sale['end'])) {
                    continue;
                }

                // An end before the start means the window crosses New Year.
                if ($sale['end'] < $sale['start']) {
                    $running = ($today >= $sale['start'] || $today <= $sale['end']);
                } else {
                    $running = ($today >= $sale['start'] && $today <= $sale['end']);
                }

                if ($running) {
                    $year = (int) current_time('Y');
                    if ($sale['end'] < $sale['start'] && $today <= $sale['end']) {
                        $year--;
                    }
                    $sale['key'] = sanitize_key('sale-' . $sale['id'] . '-' . $year);
                    $sale['discount'] = absint($sale['discount']);
                    /* translators: %d: discount percentage */
                    $sale['off'] = sprintf(__('%d%% OFF', 'mini-ajax-cart'), $sale['discount']);

                    return $sale;
                }
            }

            return false;
        }

        private function sale() {
            if (false === $this->sale) {
                $this->sale = current_user_can('manage_woocommerce') ? self::active_sale() : null;
            }

            return $this->sale;
        }

        public function init() {
            if (!$this->sale()) {
                return;
            }

            add_filter('plugin_action_links_' . plugin_basename(MAJC_FILE), array($this, 'action_link'), 20);
            add_action('admin_enqueue_scripts', array($this, 'enqueue'));

            if (!MAJC_Backend::is_dismissed($this->sale['key'])) {
                add_action('admin_footer', array($this, 'cart'));
            }
        }

        /* The cart list, cart editor and Free vs Pro screens. */
        private function is_plugin_screen() {
            $screen = function_exists('get_current_screen') ? get_current_screen() : null;

            return $screen && (self::POST_TYPE === $screen->post_type || false !== strpos($screen->id, 'majc-free-vs-pro'));
        }

        public function enqueue() {
            wp_enqueue_style('majc-sale', MAJC_URL . 'assets/backend/css/sale.css', array(), MAJC_VERSION);

            if ($this->is_plugin_screen() && !MAJC_Backend::is_dismissed($this->sale['key'])) {
                wp_enqueue_script('majc-sale', MAJC_URL . 'assets/backend/js/sale.js', array(), MAJC_VERSION, true);
            }
        }

        public function menu_badge() {
            global $submenu;
            $parent = 'edit.php?post_type=' . self::POST_TYPE;

            if (!$this->sale() || empty($submenu[$parent])) {
                return;
            }

            foreach ($submenu[$parent] as $i => $item) {
                if ('majc-free-vs-pro' === $item[2]) {
                    $submenu[$parent][$i][0] .= ' <span class="majc-sale-badge">' . esc_html__('Sale', 'mini-ajax-cart') . '</span>';
                }
            }
        }

        public function action_link($links) {
            $links['majc-sale-deal'] = sprintf('<a class="majc-sale-link" href="%s" target="_blank" rel="noopener">%s</a>', esc_url(MAJC_Free_Vs_Pro::PRO_URL), esc_html($this->sale['label'] . ' – ' . $this->sale['off']));

            return $links;
        }

        public function cart() {
            if (!$this->is_plugin_screen()) {
                return;
            }

            $sale = $this->sale;
            $perks = array(
                __('15 ready-made cart templates', 'mini-ajax-cart'),
                __('Cart rewards, offers and a countdown timer', 'mini-ajax-cart'),
                __('Checkout inside the cart', 'mini-ajax-cart'),
                __('Free shipping bar and suggested products', 'mini-ajax-cart'),
            );
            $hide_url = wp_nonce_url(add_query_arg('majc-hide-notice', $sale['key']), $sale['key'], 'majc_notice_nonce');
            ?>
            <div class="majc-sale majc-sale-<?php echo esc_attr($sale['id']); ?>">
                <button type="button" class="majc-sale-button" aria-expanded="false" aria-controls="majc-sale-panel">
                    <span class="majc-sale-pill"><?php echo esc_html($sale['label'] . ' · ' . $sale['off']); ?></span>
                    <span class="majc-sale-circle">
                        <span class="dashicons dashicons-cart" aria-hidden="true"></span>
                        <span class="majc-sale-count" aria-hidden="true">1</span>
                    </span>
                </button>

                <div class="majc-sale-overlay" hidden></div>

                <aside class="majc-sale-panel" id="majc-sale-panel" role="dialog" aria-modal="true" aria-labelledby="majc-sale-title" hidden>
                    <header class="majc-sale-head">
                        <h2 id="majc-sale-title"><span class="dashicons dashicons-cart" aria-hidden="true"></span><?php esc_html_e('Your cart', 'mini-ajax-cart'); ?></h2>
                        <button type="button" class="majc-sale-close" aria-label="<?php esc_attr_e('Close', 'mini-ajax-cart'); ?>"><span class="dashicons dashicons-no-alt" aria-hidden="true"></span></button>
                    </header>

                    <div class="majc-sale-reward">
                        <p><?php
                            /* translators: %s: discount, e.g. 40% OFF */
                            printf(esc_html__('%s unlocked', 'mini-ajax-cart'), '<strong>' . esc_html($sale['off']) . '</strong>');
                        ?></p>
                        <span class="majc-sale-bar"><span></span></span>
                    </div>

                    <div class="majc-sale-item">
                        <span class="majc-sale-thumb" aria-hidden="true"><span class="dashicons dashicons-cart"></span></span>
                        <div>
                            <strong><?php esc_html_e('Ultimate WooCommerce Cart', 'mini-ajax-cart'); ?></strong>
                            <span><?php esc_html_e('The Pro version of Mini Ajax Cart', 'mini-ajax-cart'); ?></span>
                        </div>
                        <span class="majc-sale-off"><?php echo esc_html('-' . $sale['discount'] . '%'); ?></span>
                    </div>

                    <ul class="majc-sale-perks">
                        <?php foreach ($perks as $perk) { ?>
                            <li><span class="dashicons dashicons-yes-alt" aria-hidden="true"></span><?php echo esc_html($perk); ?></li>
                        <?php } ?>
                    </ul>

                    <footer class="majc-sale-foot">
                        <div class="majc-sale-total">
                            <span><?php echo esc_html($sale['label']); ?></span>
                            <strong><?php echo esc_html($sale['off']); ?></strong>
                        </div>
                        <p><?php esc_html_e('Special price for a limited time. Your carts carry over when you upgrade.', 'mini-ajax-cart'); ?></p>
                        <a class="majc-sale-checkout" href="<?php echo esc_url(MAJC_Free_Vs_Pro::PRO_URL); ?>" target="_blank" rel="noopener"><?php echo esc_html($sale['button']); ?><span class="dashicons dashicons-arrow-right-alt" aria-hidden="true"></span></a>
                        <a class="majc-sale-hide" href="<?php echo esc_url($hide_url); ?>"><?php esc_html_e('Hide until the next sale', 'mini-ajax-cart'); ?></a>
                    </footer>
                </aside>
            </div>
            <?php
        }

    }

    new MAJC_Sale();
}
