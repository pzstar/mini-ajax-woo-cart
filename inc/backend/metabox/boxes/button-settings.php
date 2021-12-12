<div id="button-settings" class="tab-content" style="display: none;">
    <div class="majc-settings-field-wrap">
        <h2><?php esc_html_e('Button', 'mini-ajax-cart'); ?></h2>

        <div class="majc-settings-field">
            <label><?php esc_html_e('Show View Cart Button', 'mini-ajax-cart'); ?></label>
            <div class="majc-settings-input-field">
                <input type="checkbox" name="majc_settings[buttons][show_view_cart]" <?php
                if (isset($buttons['show_view_cart'])) {
                    checked($buttons['show_view_cart'], 'on', true);
                }
                ?>>
            </div>
        </div>

        <div class="majc-settings-field">
            <label><?php esc_html_e('Show Checkout Button', 'mini-ajax-cart'); ?></label>
            <div class="majc-settings-input-field">
                <input type="checkbox" name="majc_settings[buttons][show_checkout]" <?php
                if (isset($buttons['show_checkout'])) {
                    checked($buttons['show_checkout'], 'on', true);
                }
                ?>>
            </div>
        </div>

        <div class="majc-settings-field">
            <label><?php esc_html_e('Show Continue Shopping Button', 'mini-ajax-cart'); ?></label>
            <div class="majc-settings-input-field">
                <input type="checkbox" name="majc_settings[buttons][show_continue_shopping]" <?php
                if (isset($buttons['show_continue_shopping'])) {
                    checked($buttons['show_continue_shopping'], 'on', true);
                }
                ?>>
            </div>
        </div>

        <div class="majc-settings-field">
            <label><?php esc_html_e('Show Continue Shopping Link', 'mini-ajax-cart'); ?></label>
            <div class="majc-settings-input-field">
                <input type="url" name="majc_settings[buttons][continue_shopping_link]" value="<?php echo isset($buttons['continue_shopping_link']) ? esc_url($buttons['continue_shopping_link']) : ""; ?>">
            </div>
        </div>

        <div class="majc-settings-field">
            <label><?php esc_html_e('View Cart Label', 'mini-ajax-cart'); ?></label>
            <div class="majc-settings-input-field">
                <input type="text" name="majc_settings[buttons][view_cart_label]" value="<?php echo isset($buttons['view_cart_label']) ? esc_html($buttons['view_cart_label']) : esc_html__('View Cart', 'mini-ajax-cart'); ?>">
            </div>
        </div>

        <div class="majc-settings-field">
            <label><?php esc_html_e('View Checkout Label', 'mini-ajax-cart'); ?></label>
            <div class="majc-settings-input-field">
                <input type="text" name="majc_settings[buttons][checkout_label]" value="<?php echo isset($buttons['checkout_label']) ? esc_html($buttons['checkout_label']) : esc_html__('View Checkout', 'mini-ajax-cart'); ?>">
            </div>
        </div>

        <div class="majc-settings-field">
            <label><?php esc_html_e('View Continue Shopping Label', 'mini-ajax-cart'); ?></label>
            <div class="majc-settings-input-field">
                <input type="text" name="majc_settings[buttons][continue_shopping_label]" value="<?php echo isset($buttons['continue_shopping_label']) ? esc_html($buttons['continue_shopping_label']) : esc_html__('Continue Shopping', 'mini-ajax-cart'); ?>">
            </div>
        </div>

        <div class="majc-settings-field">
            <label><?php esc_html_e('Shipping Text', 'mini-ajax-cart'); ?></label>
            <div class="majc-settings-input-field">
                <input type="text" name="majc_settings[buttons][shipping_text]" value="<?php echo isset($buttons['shipping_text']) ? esc_html($buttons['shipping_text']) : null; ?>">
            </div>
        </div>
    </div>
</div>