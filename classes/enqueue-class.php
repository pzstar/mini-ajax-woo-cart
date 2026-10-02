<?php

defined('ABSPATH') or die('No script please!!');

if (!class_exists('MAJC_Enqueue')) {

    class MAJC_Enqueue extends MAJC_Library {

        function __construct() {
            add_action('admin_enqueue_scripts', array($this, 'majc_register_backend_assets'));
            add_action('wp_enqueue_scripts', array($this, 'majc_register_frontend_assets'));
        }

        public function majc_register_backend_assets() {
            /* The review notice on other screens only needs the stylesheet */
            if (is_rtl()) {
                wp_enqueue_style('majc-admin-style', MAJC_BACKEND_CSS_DIR . 'admin-style.rtl.css', '', MAJC_VERSION);
            } else {
                wp_enqueue_style('majc-admin-style', MAJC_BACKEND_CSS_DIR . 'admin-style.css', '', MAJC_VERSION);
            }

            $screen = get_current_screen();
            if (!$screen || $screen->post_type !== 'ultimate-woo-cart') {
                return;
            }

            wp_enqueue_media();

            wp_enqueue_style('fontawesome-6.3.0', MAJC_BACKEND_CSS_DIR . '/icons/fontawesome-6.3.0.css', array(), MAJC_VERSION);
            wp_enqueue_style('eleganticons', MAJC_BACKEND_CSS_DIR . '/icons/eleganticons.css', array(), MAJC_VERSION);
            wp_enqueue_style('essentialicon', MAJC_BACKEND_CSS_DIR . '/icons/essentialicon.css', array(), MAJC_VERSION);
            wp_enqueue_style('icofont', MAJC_BACKEND_CSS_DIR . '/icons/icofont.css', array(), MAJC_VERSION);
            wp_enqueue_style('materialdesignicons', MAJC_BACKEND_CSS_DIR . '/icons/materialdesignicons.css', array(), MAJC_VERSION);

            /* Enqueue jQuery Chosen */
            wp_enqueue_style('chosen', MAJC_BACKEND_CSS_DIR . 'chosen.css', '', MAJC_VERSION);
            wp_enqueue_script('chosen-script', MAJC_BACKEND_JS_DIR . 'chosen.jquery.js', array('jquery'), MAJC_VERSION);

            /* For color picker */
            wp_enqueue_style('wp-color-picker');
            wp_enqueue_script('wp-color-picker');

            /* Register Custom Scrollbar */
            wp_enqueue_style('jquery-mCustomScrollbar', MAJC_BACKEND_CSS_DIR . '../../mcscrollbar/jquery.mCustomScrollbar.css', array(), MAJC_VERSION);
            wp_enqueue_script('jquery-mCustomScrollbar-style', MAJC_BACKEND_JS_DIR . '../../mcscrollbar/jquery.mCustomScrollbar.js', array('jquery'), MAJC_VERSION);

            /* Register condition Script */
            wp_enqueue_script('jquery-condition', MAJC_BACKEND_JS_DIR . 'jquery-condition.js', array('jquery'), MAJC_VERSION, true);

            /* Register Backend Script */
            wp_enqueue_script('majc-admin-script', MAJC_BACKEND_JS_DIR . 'admin-script.js', array('jquery', 'jquery-ui-sortable', 'chosen-script'), MAJC_VERSION, true);

            /* Send php values to JS script */
            wp_localize_script('majc-admin-script', 'majc_admin_js_obj', array(
                'image_path' => MAJC_BACKEND_IMG_DIR,
                'js_path' => MAJC_BACKEND_JS_DIR,
                'ajax_url' => admin_url('admin-ajax.php'),
                'ajax_nonce' => wp_create_nonce('majc-backend-ajax-nonce')
            ));
        }

        // Settings of the carts that are switched on, read once per request.
        public static function enabled_carts() {
            static $carts = null;
            if (null === $carts) {
                $carts = array();
                $ids = get_posts(array('post_type' => 'ultimate-woo-cart', 'post_status' => 'publish', 'posts_per_page' => -1, 'fields' => 'ids', 'no_found_rows' => true));
                foreach ($ids as $id) {
                    $settings = get_post_meta($id, 'uwcc_settings', true);
                    if (isset($settings['display']['enable_flying_cart']) && $settings['display']['enable_flying_cart'] == 'on') {
                        $carts[$id] = $settings;
                    }
                }
            }
            return $carts;
        }

        // Which full icon stylesheet an icon class needs.
        private static function icon_set($icon) {
            if (strpos($icon, 'icofont-') === 0) {
                return 'icofont';
            } elseif (strpos($icon, 'mdi') === 0) {
                return 'materialdesignicons';
            } elseif (strpos($icon, 'essentialicon-') === 0) {
                return 'essentialicon';
            } elseif (strpos($icon, 'fa') === 0) {
                return 'fontawesome-6.3.0';
            } elseif (in_array($icon, majc_eleganticons_array())) {
                return 'eleganticons';
            }
            // e.g. icons saved by Ultimate WooCommerce Cart from sets this plugin does not ship.
            return null;
        }

        public function majc_register_frontend_assets() {
            $carts = self::enabled_carts();
            if (!$carts) {
                return;
            }

            // The template's fixed icons come from a small subset; full sets only load for icons picked in the settings.
            $icon_sets = $animations = array();
            foreach ($carts as $settings) {
                $basket = isset($settings['cart_basket']) ? $settings['cart_basket'] : array();
                $header = isset($settings['header']) ? $settings['header'] : array();
                if (isset($basket['icon_type']) && $basket['icon_type'] == 'available_icon') {
                    foreach (array('open_available_icon', 'close_available_icon') as $key) {
                        if (!empty($basket[$key])) {
                            $icon_sets[] = self::icon_set($basket[$key]);
                        }
                    }
                }
                if (isset($header['icon_type']) && $header['icon_type'] == 'available_icon' && !empty($header['available_icon'])) {
                    $icon_sets[] = self::icon_set($header['available_icon']);
                }
                foreach (array(isset($settings['show_animation']) ? $settings['show_animation'] : '', isset($settings['hide_animation']) ? $settings['hide_animation'] : '', isset($basket['hover_animation']) ? $basket['hover_animation'] : '') as $animation) {
                    if ($animation && $animation != 'none') {
                        $animations[] = $animation;
                    }
                }
            }

            wp_enqueue_script('wc-cart-fragments');

            wp_enqueue_style('majc-cart-icons', MAJC_BACKEND_CSS_DIR . 'icons/majc-cart-icons.css', array(), MAJC_VERSION);
            foreach (array_unique(array_filter($icon_sets)) as $icon_set) {
                wp_enqueue_style('majc-' . $icon_set, MAJC_BACKEND_CSS_DIR . 'icons/' . $icon_set . '.css', array(), MAJC_VERSION);
            }

            // Effects offered in the settings are in a small subset; anything else (e.g. saved by the Pro plugin) needs the full library.
            if ($animations) {
                $offered = array();
                $all_animations = $this->majc_animations();
                array_walk_recursive($all_animations, function ($animation) use (&$offered) {
                    $offered[] = $animation;
                });
                wp_enqueue_style('majc-animations', MAJC_FRONTEND_CSS_DIR . 'majc-animations.css', array(), MAJC_VERSION);
                foreach (array_diff($animations, $offered) as $animation) {
                    $file = strpos($animation, 'hvr-') === 0 ? 'hover-min' : 'animate';
                    wp_enqueue_style('majc-' . $file, MAJC_FRONTEND_CSS_DIR . $file . '.css', array(), MAJC_VERSION);
                }
            }

            wp_enqueue_script('jquery-effects-shake');

            /* Register Custom Scrollbar */
            wp_enqueue_style('majc-mcustomscrollbar', MAJC_FRONTEND_CSS_DIR . '../../mcscrollbar/jquery.mCustomScrollbar.css', array(), MAJC_VERSION);
            wp_enqueue_script('majc-mcustomscrollbar', MAJC_FRONTEND_JS_DIR . '../../mcscrollbar/jquery.mCustomScrollbar.js', array('jquery'), MAJC_VERSION);

            // Plugins Frontend Styles
            $fonts_url = majc_fonts_url();
            if ($fonts_url) {
                wp_enqueue_style('majc-fonts', $fonts_url, array(), MAJC_VERSION);
            }
            if (is_rtl()) {
                wp_enqueue_style('majc-frontend-flymenu-style', MAJC_FRONTEND_CSS_DIR . 'frontend.rtl.css', array(), MAJC_VERSION);
            } else {
                wp_enqueue_style('majc-frontend-flymenu-style', MAJC_FRONTEND_CSS_DIR . 'frontend.css', array(), MAJC_VERSION);
            }

            // Plugins Frontend Scripts
            wp_enqueue_script('majc-frontend-script', MAJC_FRONTEND_JS_DIR . 'frontend.js', array('jquery', 'jquery-effects-shake', 'majc-mcustomscrollbar'), MAJC_VERSION);

            $majc_frontend_js_obj = array(
                'ajax_url' => admin_url('admin-ajax.php'),
                'ajax_nonce' => wp_create_nonce('majc-frontend-ajax-nonce')
            );
            wp_localize_script('majc-frontend-script', 'majc_frontend_js_obj', $majc_frontend_js_obj);
        }

    }

    new MAJC_Enqueue();
}