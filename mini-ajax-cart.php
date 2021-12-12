<?php

defined('ABSPATH') or die('No script please!');
/*
  Plugin Name: Mini Ajax Cart for WooCommerce
  Plugin URI:  https://hashthemes.com/
  Description: Ajax, Floating, Slide In, Popup Cart For WordPress
  Version:     1.0.5
  Author:      Hash Themes
  Author URI:  http://hashthemes.com
  License:     GPLv2 or later
  License URI: https://www.gnu.org/licenses/gpl-2.0.html
  Domain Path: /languages
  Text Domain: mini-ajax-cart
 */
include( plugin_dir_path(__FILE__) . '/classes/library-class.php');

if (!class_exists('MAJC_Class')) {

    class MAJC_Class extends MAJC_Library {

        function __construct() {
            add_action('plugins_loaded', array($this, 'majc_text_domain'));

            $this->define_constants();

            $this->includes();
        }

        public function define_constants() {
            defined('MAJC_VERSION') or define('MAJC_VERSION', '1.0.5'); //plugin version

            defined('MAJC_TD') or define('MAJC_TD', 'mini-ajax-cart'); //plugin's text domain

            defined('MAJC_CSS_PREFIX') or define('MAJC_CSS_PREFIX', 'majc-'); //plugin's text domain

            defined('MAJC_IMG_DIR') or define('MAJC_IMG_DIR', plugin_dir_url(__FILE__) . 'assets/img/');

            defined('MAJC_BACKEND_IMG_DIR') or define('MAJC_BACKEND_IMG_DIR', plugin_dir_url(__FILE__) . 'assets/backend/img/');

            defined('MAJC_FRONTEND_IMG_DIR') or define('MAJC_FRONTEND_IMG_DIR', plugin_dir_url(__FILE__) . 'assets/frontend/img/');

            defined('MAJC_BACKEND_JS_DIR') or define('MAJC_BACKEND_JS_DIR', plugin_dir_url(__FILE__) . 'assets/backend/js/');

            defined('MAJC_FRONTEND_JS_DIR') or define('MAJC_FRONTEND_JS_DIR', plugin_dir_url(__FILE__) . 'assets/frontend/js/');

            defined('MAJC_BACKEND_CSS_DIR') or define('MAJC_BACKEND_CSS_DIR', plugin_dir_url(__FILE__) . 'assets/backend/css/');

            defined('MAJC_FRONTEND_CSS_DIR') or define('MAJC_FRONTEND_CSS_DIR', plugin_dir_url(__FILE__) . 'assets/frontend/css/');

            defined('MAJC_PATH') or define('MAJC_PATH', plugin_dir_path(__FILE__));

            defined('MAJC_URL') or define('MAJC_URL', plugin_dir_url(__FILE__));
        }

        public function includes() {
            include MAJC_PATH . '/Mobile_Detect.php';

            include plugin_dir_path(__FILE__) . '/font-icons.php';

            include plugin_dir_path(__FILE__) . '/google-fonts-list.php';

            include MAJC_PATH . '/classes/enqueue-class.php';

            include MAJC_PATH . '/classes/backend-class.php';

            include MAJC_PATH . '/classes/frontend-class.php';
        }

        public function majc_text_domain() {
            load_plugin_textdomain('mini-ajax-cart', false, plugin_dir_url(__FILE__) . 'languages');
        }

    }

    $woo_plugin_path = trailingslashit(WP_PLUGIN_DIR) . 'woocommerce/woocommerce.php';
    $uwc_plugin_path = trailingslashit(WP_PLUGIN_DIR) . 'ultimate-woocommerce-cart/ultimate-woocommerce-cart.php';

    if (in_array($woo_plugin_path, wp_get_active_and_valid_plugins()) || in_array($woo_plugin_path, wp_get_active_network_plugins())) {
        if (!in_array($uwc_plugin_path, wp_get_active_and_valid_plugins()) || !in_array($uwc_plugin_path, wp_get_active_network_plugins())) {
            new MAJC_Class();
        }
    }
}