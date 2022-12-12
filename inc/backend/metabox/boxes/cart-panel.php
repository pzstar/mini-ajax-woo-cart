<div id="cart-panel" class="tab-content" style="display:none">
    <h2><?php esc_html_e('Cart Panel Settings', 'mini-ajax-cart'); ?></h2>

    <div class="majc-settings-field">
        <label><?php esc_html_e('Layout', 'mini-ajax-cart'); ?></label>
        <div class="majc-settings-input-field">
            <select name="majc_settings[layout_type]" class="layout_type">			
                <option value="slidein" <?php
                if (isset($majc_settings['layout_type'])) {
                    selected($majc_settings['layout_type'], 'slidein');
                }
                ?>><?php esc_html_e('Slide In', 'mini-ajax-cart'); ?></option>
                <option disabled value="floating" <?php
                if (isset($majc_settings['layout_type'])) {
                    selected($majc_settings['layout_type'], 'floating');
                }
                ?>><?php esc_html_e('Floating (Available in Pro)', 'mini-ajax-cart'); ?></option>
                <option disabled value="popup" <?php
                if (isset($majc_settings['layout_type'])) {
                    selected($majc_settings['layout_type'], 'popup');
                }
                ?>><?php esc_html_e('Popup (Available in Pro)', 'mini-ajax-cart'); ?></option>
            </select>
        </div>
    </div>

    <div class="majc-settings-field">
        <label><?php esc_attr_e('Show Animation', 'mini-ajax-cart') ?></label>
        <div class="majc-settings-input-field">
            <select name="majc_settings[show_animation]">
                <option value="none"><?php esc_html_e('None', 'mini-ajax-cart'); ?></option>
                <?php foreach ($animations['show_animation'] as $key => $key_array): ?>
                    <optgroup label="<?php echo esc_attr($key) ?>">
                        <?php foreach ($key_array as $value): ?>
                            <option value="<?php echo esc_attr($value) ?>" <?php
                            if (isset($majc_settings['show_animation'])) {
                                selected($majc_settings['show_animation'], $value);
                            }
                            ?>><?php echo esc_attr($value) ?></option>
                                <?php endforeach ?>
                    </optgroup>
                <?php endforeach ?>
            </select>
        </div>
    </div>

    <div class="majc-settings-field">
        <label><?php esc_attr_e('Hide Animation', 'mini-ajax-cart') ?></label>
        <div class="majc-settings-input-field">
            <select name="majc_settings[hide_animation]">
                <option value="none"><?php esc_html_e('None', 'mini-ajax-cart'); ?></option>
                <?php foreach ($animations['hide_animation'] as $key => $key_array): ?>
                    <optgroup label="<?php echo esc_attr($key) ?>">
                        <?php foreach ($key_array as $value): ?>
                            <option value="<?php echo esc_attr($value) ?>" <?php
                            if (isset($majc_settings['hide_animation'])) {
                                selected($majc_settings['hide_animation'], $value);
                            }
                            ?>><?php echo esc_attr($value) ?></option>
                                <?php endforeach ?>
                    </optgroup>
                <?php endforeach ?>
            </select>
        </div>
    </div>

    <div class="majc-settings-field">
        <label><?php esc_html_e('Cart Items Layout', 'mini-ajax-cart'); ?></label>
        <div class="majc-settings-input-field">
            <select name="majc_settings[cart_item_layout]">
                <option value="list" <?php
                if (isset($majc_settings['cart_item_layout'])) {
                    selected($majc_settings['cart_item_layout'], 'list');
                }
                ?>><?php esc_html_e('List', 'mini-ajax-cart'); ?></option>\
                <option value="grid" <?php
                if (isset($majc_settings['cart_item_layout'])) {
                    selected($majc_settings['cart_item_layout'], 'grid');
                }
                ?>><?php esc_html_e('Grid', 'mini-ajax-cart'); ?></option>
            </select>
        </div>
    </div>		

    <div class="majc-settings-field">
        <label><?php esc_html_e('Content Width', 'mini-ajax-cart'); ?></label>
        <div class="majc-settings-input-field">
            <input type="number" name="majc_settings[content_width]" value="<?php echo isset($majc_settings['content_width']) ? intval($majc_settings['content_width']) : null; ?>"> px
        </div>	
    </div>

    <div class="majc-settings-field">
        <label><?php esc_html_e('Enable Overlay', 'mini-ajax-cart'); ?></label>
        <div class="majc-settings-input-field majc-toggle-input-field">
            <input type="checkbox" name="majc_settings[enable_overlay]" <?php
            if (isset($majc_settings['enable_overlay'])) {
                checked($majc_settings['enable_overlay'], 'on', true);
            }
            ?>>
        </div>
    </div>
</div>