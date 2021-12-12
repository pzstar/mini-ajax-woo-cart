<?php
global $post;
$post_id = $post->ID;
$majc_settings = get_post_meta($post_id, 'uwcc_settings', true);
wp_nonce_field('majc-settings-nonce', 'majc_settings_nonce');
?>

<div class="majc-settings-outer-wrap">

    <div class="majc-settings-inner-wrap">
        <div class="majc-menu-option-wrap">
            <ul class="majc-side-menus">
                <li class="majc-tab majc-tab-active" data-tab="layout-settings" data-tohide="tab-content"><?php esc_html_e('Main Settings', 'mini-ajax-cart'); ?></li>
                <li class="majc-tab" data-tab="coupon-settings" data-tohide="tab-content"><?php esc_html_e('Coupons Settings', 'mini-ajax-cart'); ?></li>
                <li class="majc-tab" data-tab="display-settings" data-tohide="tab-content"><?php esc_html_e('Display Settings', 'mini-ajax-cart'); ?></li>
                <li class="majc-tab" data-tab="button-settings" data-tohide="tab-content"><?php esc_html_e('Button Settings', 'mini-ajax-cart'); ?></li>
                <li class="majc-tab" data-tab="custom-settings" data-tohide="tab-content"><?php esc_html_e('Custom Settings', 'mini-ajax-cart'); ?></li>
            </ul>
        </div>

        <div class="majc-menu-field-wrap">
            <?php
            include MAJC_PATH . 'inc/backend/metabox/boxes/main-settings.php';
            include MAJC_PATH . 'inc/backend/metabox/boxes/coupon-settings.php';
            include MAJC_PATH . 'inc/backend/metabox/boxes/display-settings.php';
            include MAJC_PATH . 'inc/backend/metabox/boxes/button-settings.php';
            include MAJC_PATH . 'inc/backend/metabox/boxes/custom-settings.php';
            ?>
        </div>
    </div>


</div>