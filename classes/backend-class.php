<?php
defined('ABSPATH') or die('No script please!!');

if (!class_exists('MAJC_Backend')) {

    class MAJC_Backend extends MAJC_Library {

        function __construct() {
            add_action('init', array($this, 'register_post_type'));

            add_action('add_meta_boxes', array($this, 'settings_metabox'));
            add_action('save_post', array($this, 'save_metabox_settings'));
        }

        public function settings_metabox() {
            add_meta_box('majc-settings-metabox', esc_html__('Mini Ajax Cart', 'mini-ajax-cart'), array($this, 'settings_metabox_callback'), 'ultimate-woo-cart', 'normal', 'high');
        }

        public function settings_metabox_callback() {
            include MAJC_PATH . 'inc/backend/settings.php';
        }

        public function save_metabox_settings($post_id) {
            if (isset($_POST['majc_settings_nonce']) && wp_verify_nonce($_POST['majc_settings_nonce'], 'majc-settings-nonce')) {
                $majc_settings = parent::recursive_parse_args($_POST['majc_settings'], parent::checkbox_settings());
                $majc_settings = parent::sanitize_array($majc_settings);

                update_post_meta($post_id, 'uwcc_settings', $majc_settings);
            }
            return;
        }

        public function register_post_type() {
            $labels = array(
                'name' => _x('Mini Ajax Cart', 'post type general name', 'mini-ajax-cart'),
                'singular_name' => _x('Mini Ajax Cart', 'post type singular name', 'mini-ajax-cart'),
                'menu_name' => _x('Mini Ajax Cart', 'admin menu', 'mini-ajax-cart'),
                'name_admin_bar' => _x('Mini Ajax Cart', 'add new on admin bar', 'mini-ajax-cart'),
                'add_new' => _x('Add New', 'Mini Ajax Cart', 'mini-ajax-cart'),
                'add_new_item' => esc_html__('Add New Mini Ajax Cart', 'mini-ajax-cart'),
                'new_item' => esc_html__('New Cart', 'mini-ajax-cart'),
                'edit_item' => esc_html__('Edit Cart', 'mini-ajax-cart'),
                'view_item' => esc_html__('View Cart', 'mini-ajax-cart'),
                'all_items' => esc_html__('All Cart', 'mini-ajax-cart'),
                'search_items' => esc_html__('Search Cart', 'mini-ajax-cart'),
                'parent_item_colon' => esc_html__('Parent Cart:', 'mini-ajax-cart'),
                'not_found' => esc_html__('No Cart found.', 'mini-ajax-cart'),
                'not_found_in_trash' => esc_html__('No Cart found in Trash.', 'mini-ajax-cart')
            );

            $args = array(
                'labels' => $labels,
                'public' => false,
                'publicly_queryable' => false,
                'show_ui' => true,
                'show_in_menu' => true,
                'menu_icon' => 'dashicons-cart',
                'query_var' => true,
                'rewrite' => array('slug' => 'ultimate-woo-cart'),
                'capability_type' => 'post',
                'has_archive' => false,
                'hierarchical' => false,
                'menu_position' => null,
                'supports' => array('title')
            );

            register_post_type('ultimate-woo-cart', $args);
        }

        public function icon_field($inputName, $iconName) {
            $inputName = isset($inputName) ? $inputName : '';
            $iconName = isset($iconName) ? $iconName : '';
            if (!isset($iconName))
                return;
            ?>
            <div class="majc-icon-box-wrap">
                <div class="majc-selected-icon">
                    <i class="<?php echo esc_attr($iconName); ?>"></i>
                    <span><i class="majc-down-icon"></i></span>
                </div>

                <div class="majc-icon-box">
                    <div class="majc-icon-search">
                        <select>
                            <option value="majc-icofont-list"><?php esc_html_e('Ico Font', 'mini-ajax-cart'); ?> </option>
                            <option value="majc-fontawesome-list"><?php esc_html_e('Font Awesome', 'mini-ajax-cart'); ?> </option>
                            <option value="majc-essentialicon-list"><?php esc_html_e('Essential Icon', 'mini-ajax-cart'); ?> </option>
                            <option value="majc-material-icon-list"><?php esc_html_e('Material Icon', 'mini-ajax-cart'); ?> </option>
                            <option value="majc-elegant-icon-list"><?php esc_html_e('Elegant Icon', 'mini-ajax-cart'); ?> </option>
                        </select>
                        <input type="text" class="majc-icon-search-input" placeholder="<?php esc_html_e('Type to filter', 'mini-ajax-cart'); ?>" />
                    </div>
                    <?php
                    echo '<ul class="majc-icon-list majc-icofont-list clearfix active">';
                    $majc_icofont_icon_array = majc_icofont_icon_array();
                    foreach ($majc_icofont_icon_array as $majc_icofont_icon) {
                        $icon_class = $iconName == $majc_icofont_icon ? 'icon-active' : '';
                        echo '<li class=' . esc_attr($icon_class) . '><i class="' . esc_attr($majc_icofont_icon) . '"></i></li>';
                    }
                    echo '</ul>';


                    echo '<ul class="majc-icon-list majc-fontawesome-list clearfix">';
                    $majc_font_awesome_icon_array = majc_font_awesome_icon_array();
                    foreach ($majc_font_awesome_icon_array as $majc_font_awesome_icon) {
                        $icon_class = $iconName == $majc_font_awesome_icon ? 'icon-active' : '';
                        echo '<li class=' . esc_attr($icon_class) . '><i class="' . esc_attr($majc_font_awesome_icon) . '"></i></li>';
                    }
                    echo '</ul>';


                    echo '<ul class="majc-icon-list majc-essentialicon-list clearfix">';
                    $majc_essential_icon_array = majc_essential_icon_array();
                    foreach ($majc_essential_icon_array as $majc_essential_icon) {
                        $icon_class = $iconName == $majc_essential_icon ? 'icon-active' : '';
                        echo '<li class=' . esc_attr($icon_class) . '><i class="' . esc_attr($majc_essential_icon) . '"></i></li>';
                    }
                    echo '</ul>';


                    echo '<ul class="majc-icon-list majc-material-icon-list clearfix">';
                    $majc_materialdesignicons_icon_array = majc_materialdesignicons_array();
                    foreach ($majc_materialdesignicons_icon_array as $majc_materialdesignicons_icon) {
                        $icon_class = $iconName == $majc_materialdesignicons_icon ? 'icon-active' : '';
                        echo '<li class=' . esc_attr($icon_class) . '><i class="' . esc_attr($majc_materialdesignicons_icon) . '"></i></li>';
                    }
                    echo '</ul>';


                    echo '<ul class="majc-icon-list majc-elegant-icon-list clearfix">';
                    $majc_eleganticons_icon_array = majc_eleganticons_array();
                    foreach ($majc_eleganticons_icon_array as $majc_eleganticons_icon) {
                        $icon_class = $iconName == $majc_eleganticons_icon ? 'icon-active' : '';
                        echo '<li class=' . esc_attr($icon_class) . '><i class="' . esc_attr($majc_eleganticons_icon) . '"></i></li>';
                    }
                    echo '</ul>';
                    ?>
                </div>
                <input class="majc-icon" type="hidden" value="<?php echo esc_attr($iconName); ?>" name="<?php echo esc_attr($inputName); ?>"/>
            </div>
            <?php
        }

    }

    $menu_class_obj = new MAJC_Backend();
}