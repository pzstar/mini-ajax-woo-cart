<?php
$majc_custom = isset($majc_settings['custom']) ? $majc_settings['custom'] : null;
$majc_standard_fonts = majc_get_standard_font_families();
$majc_google_fonts = majc_get_google_font_families();
$majc_text_transforms = majc_get_text_transform_choices();
$majc_text_decorations = majc_get_text_decoration_choices();
?>

<div id="design-settings" class="tab-content" style="display: none;">
    <div class="majc-submenu">
        <div class="majc-submenu-tab majc-tab-active" data-tab="majc-cart-button-design"><?php esc_html_e('Cart Button', 'mini-ajax-cart'); ?></div>
        <div class="majc-submenu-tab" data-tab="majc-cart-panel-design"><?php esc_html_e('Cart Panel', 'mini-ajax-cart'); ?></div>
        <div class="majc-submenu-tab" data-tab="majc-button-design"><?php esc_html_e('Buttons', 'mini-ajax-cart'); ?></div>
    </div>

    <div class="majc-submenu-content">
        <div class="majc-submenu-section" id="majc-cart-button-design">
            <h2><?php esc_html_e('Cart Basket/Button', 'mini-ajax-cart'); ?></h2>
            <div class="majc-settings-row">
                <label><?php esc_html_e('Cart Basket/Button Colors', 'mini-ajax-cart'); ?></label>
                <div class="majc-settings-fields">
                    <ul class="majc-color-fields">
                        <li class="majc-color-settings-field">
                            <label><?php esc_html_e('Background Color', 'mini-ajax-cart'); ?></label>
                            <div class="majc-color-input-field">
                                <input type="text" class="color-picker majc-color-picker" name="majc_settings[custom][trigger_btn_bg_color]" value="<?php echo isset($majc_custom['trigger_btn_bg_color']) ? esc_attr($majc_custom['trigger_btn_bg_color']) : null; ?>">
                            </div>
                        </li>

                        <li class="majc-color-settings-field">
                            <label><?php esc_html_e('Background Color (Hover)', 'mini-ajax-cart'); ?></label>
                            <div class="majc-color-input-field">
                                <input type="text" class="color-picker majc-color-picker" name="majc_settings[custom][trigger_btn_hover_bg_color]" value="<?php echo isset($majc_custom['trigger_btn_hover_bg_color']) ? esc_attr($majc_custom['trigger_btn_hover_bg_color']) : null; ?>">
                            </div>
                        </li>

                        <li class="majc-color-settings-field">
                            <label><?php esc_html_e('Icon Color', 'mini-ajax-cart'); ?></label>
                            <div class="majc-color-input-field">
                                <input type="text" class="color-picker majc-color-picker" name="majc_settings[custom][trigger_btn_font_color]" value="<?php echo isset($majc_custom['trigger_btn_font_color']) ? esc_attr($majc_custom['trigger_btn_font_color']) : null; ?>">
                            </div>
                        </li>

                        <li class="majc-color-settings-field">
                            <label><?php esc_html_e('Icon Color (Hover)', 'mini-ajax-cart'); ?></label>
                            <div class="majc-color-input-field">
                                <input type="text" class="color-picker majc-color-picker" name="majc_settings[custom][trigger_btn_hover_font_color]" value="<?php echo isset($majc_custom['trigger_btn_hover_font_color']) ? esc_attr($majc_custom['trigger_btn_hover_font_color']) : null; ?>">
                            </div>
                        </li>

                        <li class="majc-color-settings-field">
                            <label><?php esc_html_e('Counter Background Color', 'mini-ajax-cart'); ?></label>
                            <div class="majc-color-input-field">
                                <input type="text" class="color-picker majc-color-picker" name="majc_settings[custom][cart_total_box_bg_color]" value="<?php echo isset($majc_custom['cart_total_box_bg_color']) ? esc_attr($majc_custom['cart_total_box_bg_color']) : null; ?>">
                            </div>
                        </li>

                        <li class="majc-color-settings-field">
                            <label><?php esc_html_e('Counter Text Color', 'mini-ajax-cart'); ?></label>
                            <div class="majc-color-input-field">
                                <input type="text" class="color-picker majc-color-picker" name="majc_settings[custom][cart_total_box_text_color]" value="<?php echo isset($majc_custom['cart_total_box_text_color']) ? esc_attr($majc_custom['cart_total_box_text_color']) : null; ?>">
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>

        <div class="majc-submenu-section" id="majc-cart-panel-design" style="display: none">
            <h2><?php esc_html_e('Cart Content', 'mini-ajax-cart'); ?></h2>

            <div class="majc-settings-row">
                <label><?php esc_html_e('Background Type', 'mini-ajax-cart'); ?></label>
                <div class="majc-settings-fields">
                    <select name="majc_settings[custom][drawer_content_bg_type]" data-condition="toggle" id="majc-drawer-content_bg-type">
                        <option value="choose_color" <?php
                        if (isset($majc_custom['drawer_content_bg_type'])) {
                            selected($majc_custom['drawer_content_bg_type'], 'choose_color');
                        }
                        ?>><?php esc_html_e('Choose Color', 'mini-ajax-cart'); ?></option>
                        <option value="custom_image_bg" <?php
                        if (isset($majc_custom['drawer_content_bg_type'])) {
                            selected($majc_custom['drawer_content_bg_type'], 'custom_image_bg');
                        }
                        ?>><?php esc_html_e('Custom Image Background', 'mini-ajax-cart'); ?></option>
                    </select>
                </div>
            </div>

            <div class="majc-settings-row" data-condition-toggle="majc-drawer-content_bg-type" data-condition-val="choose_color">
                <label><?php esc_html_e('Background Color', 'mini-ajax-cart'); ?></label>
                <div class="majc-settings-fields">
                    <input type="text" class="color-picker majc-color-picker" name="majc_settings[custom][drawer_content_bg_color]" value="<?php echo isset($majc_custom['drawer_content_bg_color']) ? esc_attr($majc_custom['drawer_content_bg_color']) : ''; ?>">
                </div>
            </div>

            <div class="majc-settings-row" data-condition-toggle="majc-drawer-content_bg-type" data-condition-val="custom_image_bg">
                <label for="majc-header-icon"><?php esc_html_e('Upload Background Image', 'mini-ajax-cart'); ?></label>
                <div class="majc-settings-fields">
                    <div class="majc-icon-image-uploader">
                        <div class="majc-custom-img-icon-btn">
                            <div class="majc-custom-menu-image-icon current-bg-image">
                                <?php if (isset($majc_custom['drawer_content_bg_image']) && !empty($majc_custom['drawer_content_bg_image'])) { ?>
                                    <img src="<?php echo isset($majc_custom['drawer_content_bg_image']) ? esc_url($majc_custom['drawer_content_bg_image']) : ''; ?>" />
                                <?php } ?>
                            </div>
                            <div class="majc-image-remove"><?php esc_html_e('Remove', 'mini-ajax-cart'); ?></div>
                        </div>

                        <div class="button majc-image-upload"><?php esc_html_e('Upload', 'mini-ajax-cart') ?></div>
                        <input type="hidden" class="majc-upload-background-url" name="majc_settings[custom][drawer_content_bg_image]" id="majc-header-icon" value="<?php echo isset($majc_custom['drawer_content_bg_image']) ? esc_url($majc_custom['drawer_content_bg_image']) : ''; ?>" />
                    </div> <!-- majc-icon-image-uploader -->
                </div>
            </div>

            <div class="majc-settings-row">
                <label><?php esc_html_e('Color Settings', 'mini-ajax-cart'); ?></label>
                <div class="majc-settings-fields">
                    <ul class="majc-color-fields">

                        <li class="majc-color-settings-field">
                            <label><?php esc_html_e('Text Color', 'mini-ajax-cart'); ?></label>
                            <div class="majc-color-input-field">
                                <input type="text" class="color-picker majc-color-picker" name="majc_settings[custom][default_text_color]" value="<?php echo isset($majc_custom['default_text_color']) ? esc_attr($majc_custom['default_text_color']) : null; ?>">
                            </div>
                        </li>

                        <li class="majc-color-settings-field">
                            <label><?php esc_html_e('Border Color', 'mini-ajax-cart'); ?></label>
                            <div class="majc-color-input-field">
                                <input type="text" class="color-picker majc-color-picker" name="majc_settings[custom][default_border_color]" value="<?php echo isset($majc_custom['default_border_color']) ? esc_attr($majc_custom['default_border_color']) : null; ?>">
                            </div>
                        </li>

                        <li class="majc-color-settings-field">
                            <label><?php esc_html_e('Close Icon Color', 'mini-ajax-cart'); ?></label>
                            <div class="majc-color-input-field">
                                <input type="text" class="color-picker majc-color-picker" name="majc_settings[custom][close_icon_color]" value="<?php echo isset($majc_custom['close_icon_color']) ? esc_attr($majc_custom['close_icon_color']) : null; ?>">
                            </div>
                        </li>

                        <li class="majc-color-settings-field">
                            <label><?php esc_html_e('Close Background Color', 'mini-ajax-cart'); ?></label>
                            <div class="majc-color-input-field">
                                <input type="text" class="color-picker majc-color-picker" name="majc_settings[custom][close_bg_color]" value="<?php echo isset($majc_custom['close_bg_color']) ? esc_attr($majc_custom['close_bg_color']) : null; ?>">
                            </div>
                        </li>

                        <li class="majc-color-settings-field">
                            <label><?php esc_html_e('Quantity +/- Background Color', 'mini-ajax-cart'); ?></label>
                            <div class="majc-color-input-field">
                                <input type="text" class="color-picker majc-color-picker" name="majc_settings[custom][qty_change_btn_bg_color]" value="<?php echo isset($majc_custom['qty_change_btn_bg_color']) ? esc_attr($majc_custom['qty_change_btn_bg_color']) : null; ?>">
                            </div>
                        </li>

                        <li class="majc-color-settings-field">
                            <label><?php esc_html_e('Quantity +/- Icon Color', 'mini-ajax-cart'); ?></label>
                            <div class="majc-color-input-field">
                                <input type="text" class="color-picker majc-color-picker" name="majc_settings[custom][qty_change_icon_color]" value="<?php echo isset($majc_custom['qty_change_icon_color']) ? esc_attr($majc_custom['qty_change_icon_color']) : null; ?>">
                            </div>
                        </li>

                        <li class="majc-color-settings-field">
                            <label><?php esc_html_e('Quantity +/- Border Color', 'mini-ajax-cart'); ?></label>
                            <div class="majc-color-input-field">
                                <input type="text" class="color-picker majc-color-picker" name="majc_settings[custom][qty_change_border_color]" value="<?php echo isset($majc_custom['qty_change_border_color']) ? esc_attr($majc_custom['qty_change_border_color']) : null; ?>">
                            </div>
                        </li>
                    </ul>
                </div>
            </div> <!-- majc-custom-fields -->

            <div class="majc-settings-row">
                <label><?php esc_html_e('Header Title Typography', 'mini-ajax-cart'); ?></label>
                <div class="majc-settings-fields">
                    <ul class="majc-typography-fields">
                        <li class="majc-typography-font-family-field">
                            <label><?php esc_html_e('Font Family', 'mini-ajax-cart'); ?></label>
                            <div class="majc-typography-input-field">
                                <select name="majc_settings[custom][header_title_font_family]" class="majc-typography-font-family">
                                    <option value="Default" <?php
                                    if (isset($majc_custom['header_title_font_family'])) {
                                        selected($majc_custom['header_title_font_family'], 'default');
                                    }
                                    ?>><?php echo esc_html('Default', 'mini-ajax-cart'); ?></option>

                                    <?php
                                    if ($majc_standard_fonts) {
                                        ?>
                                        <optgroup label="Standard Fonts">
                                            <?php foreach ($majc_standard_fonts as $majc_standard_font) { ?>
                                                <option value="<?php echo esc_attr($majc_standard_font); ?>" <?php
                                                   if (isset($majc_custom['header_title_font_family'])) {
                                                       selected($majc_custom['header_title_font_family'], $majc_standard_font);
                                                   }
                                                   ?>><?php echo esc_html($majc_standard_font); ?></option>
                                            <?php } ?>
                                        </optgroup>
                                    <?php } ?>

                                    <?php
                                    if ($majc_google_fonts) {
                                        ?>
                                        <optgroup label="Google Fonts">
                                            <?php foreach ($majc_google_fonts as $majc_google_font) { ?>
                                                <option value="<?php echo esc_attr($majc_google_font); ?>" <?php
                                                   if (isset($majc_custom['header_title_font_family'])) {
                                                       selected($majc_custom['header_title_font_family'], $majc_google_font);
                                                   }
                                                   ?>><?php echo esc_html($majc_google_font); ?></option>
                                            <?php } ?>
                                        </optgroup>
                                    <?php } ?>

                                </select>
                            </div>
                        </li>

                        <li class="majc-typography-font-style-field">
                            <label><?php esc_html_e('Font Style', 'mini-ajax-cart'); ?></label>

                            <?php
                            $majc_header_title_family = isset($majc_custom['header_title_font_family']) ? $majc_custom['header_title_font_family'] : 'Helvetica';
                            $majc_font_weights = majc_get_font_weight_choices($majc_header_title_family);
                            if ($majc_font_weights) {
                                ?>
                                <div class="majc-typography-input-field">
                                    <select name="majc_settings[custom][header_title_font_style]" class="majc-typography-font-style">

                                        <?php foreach ($majc_font_weights as $majc_font_weight => $majc_font_weight_label) { ?>

                                            <option value="<?php echo esc_attr($majc_font_weight); ?>" <?php
                                               if (isset($majc_custom['header_title_font_style'])) {
                                                   selected($majc_custom['header_title_font_style'], $majc_font_weight);
                                               }
                                               ?>><?php echo esc_html($majc_font_weight_label); ?></option>

                                        <?php } ?>

                                    </select>
                                </div>
                            <?php } ?>
                        </li>

                        <li class="majc-typography-text-transform-field">
                            <label><?php esc_html_e('Text Transform', 'mini-ajax-cart'); ?></label>

                            <?php
                            if ($majc_text_transforms) {
                                ?>
                                <div class="majc-typography-input-field">
                                    <select name="majc_settings[custom][header_title_text_transform]" class="majc-typography-text-transform">

                                        <?php foreach ($majc_text_transforms as $majc_key => $majc_value) { ?>

                                            <option value="<?php echo esc_attr($majc_key) ?>" <?php
                                               if (isset($majc_custom['header_title_text_transform'])) {
                                                   selected($majc_custom['header_title_text_transform'], $majc_key);
                                               }
                                               ?>><?php echo esc_html($majc_value); ?></option>

                                        <?php } ?>
                                    </select>
                                </div>
                            <?php } ?>
                        </li>

                        <li class="majc-typography-text-decoration-field">
                            <label><?php esc_html_e('Text Decoration', 'mini-ajax-cart'); ?></label>

                            <?php
                            if ($majc_text_decorations) {
                                ?>
                                <div class="majc-typography-input-field">
                                    <select name="majc_settings[custom][header_title_text_decoration]" class="majc-typography-text-decoration">

                                        <?php foreach ($majc_text_decorations as $majc_key => $majc_value) { ?>

                                            <option value="<?php echo esc_attr($majc_key) ?>" <?php
                                               if (isset($majc_custom['header_title_text_decoration'])) {
                                                   selected($majc_custom['header_title_text_decoration'], $majc_key);
                                               }
                                               ?>><?php echo esc_html($majc_value); ?></option>

                                        <?php } ?>
                                    </select>
                                </div>
                            <?php } ?>
                        </li>

                        <li class="majc-typography-font-size-field">
                            <label><?php esc_html_e('Font Size', 'mini-ajax-cart'); ?></label>

                            <div class="majc-typography-input-field majc-range-slider-wrap">
                                <div class="majc-range-slider"></div>
                                <input class="majc-range-input-selector" type="number" min="0" max="100" step="1" value="<?php echo esc_attr($majc_custom['header_title_font_size']); ?>" name="majc_settings[custom][header_title_font_size]" /> px
                            </div>
                        </li>

                        <li class="majc-typography-line-height-field">
                            <label><?php esc_html_e('Line Height', 'mini-ajax-cart'); ?></label>

                            <div class="majc-typography-input-field majc-range-slider-wrap">
                                <div class="majc-range-slider"></div>
                                <input class="majc-range-input-selector" type="number" min="0.5" max="5" step="0.1" value="<?php echo esc_attr($majc_custom['header_title_line_height']); ?>" name="majc_settings[custom][header_title_line_height]" /> px
                            </div>
                        </li>


                        <li class="majc-typography-letter-spacing-field">
                            <label><?php esc_html_e('Letter Spacing', 'mini-ajax-cart'); ?></label>

                            <div class="majc-typography-input-field majc-range-slider-wrap">
                                <div class="majc-range-slider"></div>
                                <input class="majc-range-input-selector" type="number" min="-5" max="5" step="0.1" value="<?php echo esc_attr($majc_custom['header_title_letter_spacing']); ?>" name="majc_settings[custom][header_title_letter_spacing]" /> px
                            </div>
                        </li>

                        <li class="majc-typography-color-field">
                            <label><?php esc_html_e('Text Color', 'mini-ajax-cart'); ?></label>
                            <div class="majc-typography-input-field">
                                <input type="text" class="color-picker majc-color-picker" name="majc_settings[custom][header_title_font_color]" value="<?php echo isset($majc_custom['header_title_font_color']) ? esc_attr($majc_custom['header_title_font_color']) : null; ?>">
                            </div>
                        </li>

                    </ul>
                </div>
            </div>

            <div class="majc-settings-row">
                <label><?php esc_html_e('Content Typography', 'mini-ajax-cart'); ?></label>
                <div class="majc-settings-fields">
                    <ul class="majc-typography-fields">
                        <li class="majc-typography-font-family-field">
                            <label><?php esc_html_e('Font Family', 'mini-ajax-cart'); ?></label>
                            <div class="majc-typography-input-field">
                                <select name="majc_settings[custom][content_font_family]" class="majc-typography-font-family">
                                    <option value="Default" <?php
                                    if (isset($majc_custom['content_font_family'])) {
                                        selected($majc_custom['content_font_family'], 'default');
                                    }
                                    ?>><?php echo esc_html('Default', 'mini-ajax-cart'); ?></option>

                                    <?php
                                    if ($majc_standard_fonts) {
                                        ?>
                                        <optgroup label="Standard Fonts">
                                            <?php foreach ($majc_standard_fonts as $majc_standard_font) { ?>
                                                <option value="<?php echo esc_attr($majc_standard_font); ?>" <?php
                                                   if (isset($majc_custom['content_font_family'])) {
                                                       selected($majc_custom['content_font_family'], $majc_standard_font);
                                                   }
                                                   ?>><?php echo esc_html($majc_standard_font); ?></option>
                                            <?php } ?>
                                        </optgroup>
                                    <?php } ?>

                                    <?php
                                    if ($majc_google_fonts) {
                                        ?>
                                        <optgroup label="Google Fonts">
                                            <?php foreach ($majc_google_fonts as $majc_google_font) { ?>
                                                <option value="<?php echo esc_attr($majc_google_font); ?>" <?php
                                                   if (isset($majc_custom['content_font_family'])) {
                                                       selected($majc_custom['content_font_family'], $majc_google_font);
                                                   }
                                                   ?>><?php echo esc_html($majc_google_font); ?></option>
                                            <?php } ?>
                                        </optgroup>
                                    <?php } ?>

                                </select>
                            </div>
                        </li>

                        <li class="majc-typography-font-style-field">
                            <label><?php esc_html_e('Font Style', 'mini-ajax-cart'); ?></label>

                            <?php
                            $majc_content_family = isset($majc_custom['content_font_family']) ? $majc_custom['content_font_family'] : 'Helvetica';
                            $majc_font_weights = majc_get_font_weight_choices($majc_content_family);
                            if ($majc_font_weights) {
                                ?>
                                <div class="majc-typography-input-field">
                                    <select name="majc_settings[custom][content_font_style]" class="majc-typography-font-style">

                                        <?php foreach ($majc_font_weights as $majc_font_weight => $majc_font_weight_label) { ?>

                                            <option value="<?php echo esc_attr($majc_font_weight); ?>" <?php
                                               if (isset($majc_custom['content_font_style'])) {
                                                   selected($majc_custom['content_font_style'], $majc_font_weight);
                                               }
                                               ?>><?php echo esc_html($majc_font_weight_label); ?></option>

                                        <?php } ?>

                                    </select>
                                </div>
                            <?php } ?>
                        </li>

                        <li class="majc-typography-text-transform-field">
                            <label><?php esc_html_e('Text Transform', 'mini-ajax-cart'); ?></label>

                            <?php
                            if ($majc_text_transforms) {
                                ?>
                                <div class="majc-typography-input-field">
                                    <select name="majc_settings[custom][content_text_transform]" class="majc-typography-text-transform">

                                        <?php foreach ($majc_text_transforms as $majc_key => $majc_value) { ?>

                                            <option value="<?php echo esc_attr($majc_key) ?>" <?php
                                               if (isset($majc_custom['content_text_transform'])) {
                                                   selected($majc_custom['content_text_transform'], $majc_key);
                                               }
                                               ?>><?php echo esc_html($majc_value); ?></option>

                                        <?php } ?>
                                    </select>
                                </div>
                            <?php } ?>
                        </li>

                        <li class="majc-typography-text-decoration-field">
                            <label><?php esc_html_e('Text Decoration', 'mini-ajax-cart'); ?></label>

                            <?php
                            if ($majc_text_decorations) {
                                ?>
                                <div class="majc-typography-input-field">
                                    <select name="majc_settings[custom][content_text_decoration]" class="majc-typography-text-decoration">

                                        <?php foreach ($majc_text_decorations as $majc_key => $majc_value) { ?>

                                            <option value="<?php echo esc_attr($majc_key) ?>" <?php
                                               if (isset($majc_custom['content_text_decoration'])) {
                                                   selected($majc_custom['content_text_decoration'], $majc_key);
                                               }
                                               ?>><?php echo esc_html($majc_value); ?></option>

                                        <?php } ?>
                                    </select>
                                </div>
                            <?php } ?>
                        </li>

                        <li class="majc-typography-font-size-field">
                            <label><?php esc_html_e('Font Size', 'mini-ajax-cart'); ?></label>

                            <div class="majc-typography-input-field majc-range-slider-wrap">
                                <div class="majc-range-slider"></div>
                                <input class="majc-range-input-selector" type="number" min="0" max="100" step="1" value="<?php echo esc_attr($majc_custom['content_font_size']); ?>" name="majc_settings[custom][content_font_size]" /> px
                            </div>
                        </li>


                        <li class="majc-typography-line-height-field">
                            <label><?php esc_html_e('Line Height', 'mini-ajax-cart'); ?></label>

                            <div class="majc-typography-input-field majc-range-slider-wrap">
                                <div class="majc-range-slider"></div>
                                <input class="majc-range-input-selector" type="number" min="0.5" max="5" step="0.1" value="<?php echo esc_attr($majc_custom['content_line_height']); ?>" name="majc_settings[custom][content_line_height]" /> px
                            </div>
                        </li>


                        <li class="majc-typography-letter-spacing-field">
                            <label><?php esc_html_e('Letter Spacing', 'mini-ajax-cart'); ?></label>

                            <div class="majc-typography-input-field majc-range-slider-wrap">
                                <div class="majc-range-slider"></div>
                                <input class="majc-range-input-selector" type="number" min="-5" max="5" step="0.1" value="<?php echo esc_attr($majc_custom['content_letter_spacing']); ?>" name="majc_settings[custom][content_letter_spacing]" /> px
                            </div>
                        </li>

                        <li class="majc-typography-color-field">
                            <label><?php esc_html_e('Text Color', 'mini-ajax-cart'); ?></label>
                            <div class="majc-typography-input-field">
                                <input type="text" class="color-picker majc-color-picker" name="majc_settings[custom][content_font_color]" value="<?php echo isset($majc_custom['content_font_color']) ? esc_attr($majc_custom['content_font_color']) : null; ?>">
                            </div>
                        </li>

                    </ul>
                </div>
            </div>

            <div class="majc-settings-row">
                <label><?php esc_html_e('Product Title Typography', 'mini-ajax-cart'); ?></label>
                <div class="majc-settings-fields">
                    <ul class="majc-typography-fields">
                        <li class="majc-typography-font-family-field">
                            <label><?php esc_html_e('Font Family', 'mini-ajax-cart'); ?></label>
                            <div class="majc-typography-input-field">
                                <select name="majc_settings[custom][product_title_font_family]" class="majc-typography-font-family">
                                    <option value="Default" <?php
                                    if (isset($majc_custom['product_title_font_family'])) {
                                        selected($majc_custom['product_title_font_family'], 'default');
                                    }
                                    ?>><?php echo esc_html('Default', 'mini-ajax-cart'); ?></option>

                                    <?php
                                    if ($majc_standard_fonts) {
                                        ?>
                                        <optgroup label="Standard Fonts">
                                            <?php foreach ($majc_standard_fonts as $majc_standard_font) { ?>
                                                <option value="<?php echo esc_attr($majc_standard_font); ?>" <?php
                                                   if (isset($majc_custom['product_title_font_family'])) {
                                                       selected($majc_custom['product_title_font_family'], $majc_standard_font);
                                                   }
                                                   ?>><?php echo esc_html($majc_standard_font); ?></option>
                                            <?php } ?>
                                        </optgroup>
                                    <?php } ?>

                                    <?php
                                    if ($majc_google_fonts) {
                                        ?>
                                        <optgroup label="Google Fonts">
                                            <?php foreach ($majc_google_fonts as $majc_google_font) { ?>
                                                <option value="<?php echo esc_attr($majc_google_font); ?>" <?php
                                                   if (isset($majc_custom['product_title_font_family'])) {
                                                       selected($majc_custom['product_title_font_family'], $majc_google_font);
                                                   }
                                                   ?>><?php echo esc_html($majc_google_font); ?></option>
                                            <?php } ?>
                                        </optgroup>
                                    <?php } ?>

                                </select>
                            </div>
                        </li>

                        <li class="majc-typography-font-style-field">
                            <label><?php esc_html_e('Font Style', 'mini-ajax-cart'); ?></label>

                            <?php
                            $majc_product_title_family = isset($majc_custom['product_title_font_family']) ? $majc_custom['product_title_font_family'] : 'Helvetica';
                            $majc_font_weights = majc_get_font_weight_choices($majc_product_title_family);
                            if ($majc_font_weights) {
                                ?>
                                <div class="majc-typography-input-field">
                                    <select name="majc_settings[custom][product_title_font_style]" class="majc-typography-font-style">

                                        <?php foreach ($majc_font_weights as $majc_font_weight => $majc_font_weight_label) { ?>

                                            <option value="<?php echo esc_attr($majc_font_weight); ?>" <?php
                                               if (isset($majc_custom['product_title_font_style'])) {
                                                   selected($majc_custom['product_title_font_style'], $majc_font_weight);
                                               }
                                               ?>><?php echo esc_html($majc_font_weight_label); ?></option>

                                        <?php } ?>

                                    </select>
                                </div>
                            <?php } ?>
                        </li>

                        <li class="majc-typography-text-transform-field">
                            <label><?php esc_html_e('Text Transform', 'mini-ajax-cart'); ?></label>

                            <?php
                            if ($majc_text_transforms) {
                                ?>
                                <div class="majc-typography-input-field">
                                    <select name="majc_settings[custom][product_title_text_transform]" class="majc-typography-text-transform">

                                        <?php foreach ($majc_text_transforms as $majc_key => $majc_value) { ?>

                                            <option value="<?php echo esc_attr($majc_key) ?>" <?php
                                               if (isset($majc_custom['product_title_text_transform'])) {
                                                   selected($majc_custom['product_title_text_transform'], $majc_key);
                                               }
                                               ?>><?php echo esc_html($majc_value); ?></option>

                                        <?php } ?>
                                    </select>
                                </div>
                            <?php } ?>
                        </li>

                        <li class="majc-typography-text-decoration-field">
                            <label><?php esc_html_e('Text Decoration', 'mini-ajax-cart'); ?></label>

                            <?php
                            if ($majc_text_decorations) {
                                ?>
                                <div class="majc-typography-input-field">
                                    <select name="majc_settings[custom][product_title_text_decoration]" class="majc-typography-text-decoration">

                                        <?php foreach ($majc_text_decorations as $majc_key => $majc_value) { ?>

                                            <option value="<?php echo esc_attr($majc_key) ?>" <?php
                                               if (isset($majc_custom['product_title_text_decoration'])) {
                                                   selected($majc_custom['product_title_text_decoration'], $majc_key);
                                               }
                                               ?>><?php echo esc_html($majc_value); ?></option>

                                        <?php } ?>
                                    </select>
                                </div>
                            <?php } ?>
                        </li>


                        <li class="majc-typography-font-size-field">
                            <label><?php esc_html_e('Font Size', 'mini-ajax-cart'); ?></label>

                            <div class="majc-typography-input-field majc-range-slider-wrap">
                                <div class="majc-range-slider"></div>
                                <input class="majc-range-input-selector" type="number" min="0" max="100" step="1" value="<?php echo esc_attr($majc_custom['product_title_font_size']); ?>" name="majc_settings[custom][product_title_font_size]" /> px
                            </div>
                        </li>


                        <li class="majc-typography-line-height-field">
                            <label><?php esc_html_e('Line Height', 'mini-ajax-cart'); ?></label>

                            <div class="majc-typography-input-field majc-range-slider-wrap">
                                <div class="majc-range-slider"></div>
                                <input class="majc-range-input-selector" type="number" min="0.5" max="5" step="0.1" value="<?php echo esc_attr($majc_custom['product_title_line_height']); ?>" name="majc_settings[custom][product_title_line_height]" /> px
                            </div>
                        </li>


                        <li class="majc-typography-letter-spacing-field">
                            <label><?php esc_html_e('Letter Spacing', 'mini-ajax-cart'); ?></label>

                            <div class="majc-typography-input-field majc-range-slider-wrap">
                                <div class="majc-range-slider"></div>
                                <input class="majc-range-input-selector" type="number" min="-5" max="5" step="0.1" value="<?php echo esc_attr($majc_custom['product_title_letter_spacing']); ?>" name="majc_settings[custom][product_title_letter_spacing]" /> px
                            </div>
                        </li>

                        <li class="majc-typography-color-field">
                            <label><?php esc_html_e('Text Color', 'mini-ajax-cart'); ?></label>
                            <div class="majc-typography-input-field">
                                <input type="text" class="color-picker majc-color-picker" name="majc_settings[custom][product_title_font_color]" value="<?php echo isset($majc_custom['product_title_font_color']) ? esc_attr($majc_custom['product_title_font_color']) : null; ?>">
                            </div>
                        </li>

                    </ul>
                </div>
            </div>
        </div>

        <div class="majc-submenu-section" id="majc-button-design" style="display: none">
            <div class="majc-settings-row">
                <label><?php esc_html_e('Button Typography', 'mini-ajax-cart'); ?></label>
                <div class="majc-settings-fields">
                    <ul class="majc-typography-fields">
                        <li class="majc-typography-font-family-field">
                            <label><?php esc_html_e('Font Family', 'mini-ajax-cart'); ?></label>
                            <div class="majc-typography-input-field">
                                <select name="majc_settings[custom][button_text_font_family]" class="majc-typography-font-family">

                                    <option value="Default" <?php
                                    if (isset($majc_custom['header_title_font_family'])) {
                                        selected($majc_custom['header_title_font_family'], 'default');
                                    }
                                    ?>><?php echo esc_html('Default', 'mini-ajax-cart'); ?></option>

                                    <?php
                                    if ($majc_standard_fonts) {
                                        ?>
                                        <optgroup label="Standard Fonts">
                                            <?php foreach ($majc_standard_fonts as $majc_standard_font) { ?>
                                                <option value="<?php echo esc_attr($majc_standard_font); ?>" <?php
                                                   if (isset($majc_custom['button_text_font_family'])) {
                                                       selected($majc_custom['button_text_font_family'], $majc_standard_font);
                                                   }
                                                   ?>><?php echo esc_attr($majc_standard_font); ?></option>
                                            <?php } ?>
                                        </optgroup>
                                    <?php } ?>

                                    <?php
                                    if ($majc_google_fonts) {
                                        ?>
                                        <optgroup label="Google Fonts">
                                            <?php foreach ($majc_google_fonts as $majc_google_font) { ?>
                                                <option value="<?php echo esc_attr($majc_google_font); ?>" <?php
                                                   if (isset($majc_custom['button_text_font_family'])) {
                                                       selected($majc_custom['button_text_font_family'], $majc_google_font);
                                                   }
                                                   ?>><?php echo esc_attr($majc_google_font); ?></option>
                                            <?php } ?>
                                        </optgroup>
                                    <?php } ?>

                                </select>
                            </div>
                        </li>

                        <li class="majc-typography-font-style-field">
                            <label><?php esc_html_e('Font Style', 'mini-ajax-cart'); ?></label>

                            <?php
                            $majc_header_title_family = isset($majc_custom['button_text_font_family']) ? $majc_custom['button_text_font_family'] : 'Helvetica';
                            $majc_font_weights = majc_get_font_weight_choices($majc_header_title_family);
                            if ($majc_font_weights) {
                                ?>
                                <div class="majc-typography-input-field">
                                    <select name="majc_settings[custom][button_text_font_style]" class="majc-typography-font-style">
                                        <?php foreach ($majc_font_weights as $majc_font_weight => $majc_font_weight_label) { ?>
                                            <option value="<?php echo esc_attr($majc_font_weight); ?>" <?php
                                               if (isset($majc_custom['button_text_font_style'])) {
                                                   selected($majc_custom['button_text_font_style'], $majc_font_weight);
                                               }
                                               ?>><?php echo esc_html($majc_font_weight_label); ?></option>
                                        <?php } ?>
                                    </select>
                                </div>
                            <?php } ?>
                        </li>

                        <li class="majc-typography-text-transform-field">
                            <label><?php esc_html_e('Text Transform', 'mini-ajax-cart'); ?></label>

                            <?php
                            if ($majc_text_transforms) {
                                ?>
                                <div class="majc-typography-input-field">
                                    <select name="majc_settings[custom][button_text_text_transform]" class="majc-typography-text-transform">

                                        <?php foreach ($majc_text_transforms as $majc_key => $majc_value) { ?>

                                            <option value="<?php echo esc_attr($majc_key) ?>" <?php
                                               if (isset($majc_custom['button_text_text_transform'])) {
                                                   selected($majc_custom['button_text_text_transform'], $majc_key);
                                               }
                                               ?>><?php echo esc_html($majc_value); ?></option>

                                        <?php } ?>
                                    </select>
                                </div>
                            <?php } ?>
                        </li>

                        <li class="majc-typography-text-decoration-field">
                            <label><?php esc_html_e('Text Decoration', 'mini-ajax-cart'); ?></label>

                            <?php
                            if ($majc_text_decorations) {
                                ?>
                                <div class="majc-typography-input-field">
                                    <select name="majc_settings[custom][button_text_text_decoration]" class="majc-typography-text-decoration">

                                        <?php foreach ($majc_text_decorations as $majc_key => $majc_value) { ?>

                                            <option value="<?php echo esc_attr($majc_key) ?>" <?php
                                               if (isset($majc_custom['button_text_text_decoration'])) {
                                                   selected($majc_custom['button_text_text_decoration'], $majc_key);
                                               }
                                               ?>><?php echo esc_html($majc_value); ?></option>

                                        <?php } ?>
                                    </select>
                                </div>
                            <?php } ?>
                        </li>

                        <li class="majc-typography-font-size-field">
                            <label><?php esc_html_e('Font Size', 'mini-ajax-cart'); ?></label>

                            <div class="majc-typography-input- majc-range-slider-wrap">
                                <div class="majc-range-slider"></div>
                                <input class="majc-range-input-selector" type="number" min="0" max="100" step="1" value="<?php echo esc_attr($majc_custom['button_text_font_size']); ?>" name="majc_settings[custom][button_text_font_size]" /> px
                            </div>
                        </li>


                        <li class="majc-typography-line-height-field">
                            <label><?php esc_html_e('Line Height', 'mini-ajax-cart'); ?></label>

                            <div class="majc-typography-input-field majc-range-slider-wrap">
                                <div class="majc-range-slider"></div>
                                <input class="majc-range-input-selector" type="number" min="0.5" max="5" step="0.1" value="<?php echo esc_attr($majc_custom['button_text_line_height']); ?>" name="majc_settings[custom][button_text_line_height]" /> px
                            </div>
                        </li>


                        <li class="majc-typography-letter-spacing-field">
                            <label><?php esc_html_e('Letter Spacing', 'mini-ajax-cart'); ?></label>

                            <div class="majc-typography-input-field majc-range-slider-wrap">
                                <div class="majc-range-slider"></div>
                                <input class="majc-range-input-selector" type="number" min="-5" max="5" step="0.1" value="<?php echo esc_attr($majc_custom['button_text_letter_spacing']); ?>" name="majc_settings[custom][button_text_letter_spacing]" /> px
                            </div>
                        </li>

                    </ul>
                </div>
            </div>

            <!-- ***************** -->
            <!-- ** Coupon Button Text ** -->
            <!-- ***************** -->
            <div class="majc-settings-row">
                <label><?php esc_html_e('Coupon Button', 'mini-ajax-cart'); ?></label>
                <div class="majc-settings-fields">
                    <ul class="majc-color-fields">
                        <li class="majc-color-settings-field">
                            <label><?php esc_html_e('Background Color', 'mini-ajax-cart'); ?></label>
                            <div class="majc-color-settings-input-field">
                                <input type="text" class="color-picker majc-color-picker" name="majc_settings[custom][coupon_btn_bg_color]" value="<?php echo isset($majc_custom['coupon_btn_bg_color']) ? esc_attr($majc_custom['coupon_btn_bg_color']) : null; ?>">
                            </div>
                        </li>

                        <li class="majc-color-settings-field">
                            <label><?php esc_html_e('Background Color (Hover)', 'mini-ajax-cart'); ?></label>
                            <div class="majc-color-settings-input-field">
                                <input type="text" class="color-picker majc-color-picker" name="majc_settings[custom][coupon_btn_hover_bg_color]" value="<?php echo isset($majc_custom['coupon_btn_hover_bg_color']) ? esc_attr($majc_custom['coupon_btn_hover_bg_color']) : null; ?>">
                            </div>
                        </li>

                        <li class="majc-color-settings-field">
                            <label><?php esc_html_e('Text Color', 'mini-ajax-cart'); ?></label>
                            <div class="majc-color-settings-input-field">
                                <input type="text" class="color-picker majc-color-picker" name="majc_settings[custom][coupon_btn_font_color]" value="<?php echo isset($majc_custom['coupon_btn_font_color']) ? esc_attr($majc_custom['coupon_btn_font_color']) : null; ?>">
                            </div>
                        </li>

                        <li class="majc-color-settings-field">
                            <label><?php esc_html_e('Text Color (Hover)', 'mini-ajax-cart'); ?></label>
                            <div class="majc-color-settings-input-field">
                                <input type="text" class="color-picker majc-color-picker" name="majc_settings[custom][coupon_btn_hover_font_color]" value="<?php echo isset($majc_custom['coupon_btn_hover_font_color']) ? esc_attr($majc_custom['coupon_btn_hover_font_color']) : null; ?>">
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- ***************** -->
            <!-- ** Continue Shopping Button Text ** -->
            <!-- ***************** -->
            <div class="majc-settings-row">
                <label><?php esc_html_e('Continue Shopping Button', 'mini-ajax-cart'); ?></label>
                <div class="majc-settings-fields">
                    <ul class="majc-color-fields">
                        <li class="majc-color-settings-field">
                            <label><?php esc_html_e('Background Color', 'mini-ajax-cart'); ?></label>
                            <div class="majc-color-input-field">
                                <input type="text" class="color-picker majc-color-picker" name="majc_settings[custom][continueshop_btn_bg_color]" value="<?php echo isset($majc_custom['continueshop_btn_bg_color']) ? esc_attr($majc_custom['continueshop_btn_bg_color']) : null; ?>">
                            </div>
                        </li>

                        <li class="majc-color-settings-field">
                            <label><?php esc_html_e('Background Color (Hover)', 'mini-ajax-cart'); ?></label>
                            <div class="majc-color-input-field">
                                <input type="text" class="color-picker majc-color-picker" name="majc_settings[custom][continueshop_btn_hover_bg_color]" value="<?php echo isset($majc_custom['continueshop_btn_hover_bg_color']) ? esc_attr($majc_custom['continueshop_btn_hover_bg_color']) : null; ?>">
                            </div>
                        </li>

                        <li class="majc-color-settings-field">
                            <label><?php esc_html_e('Text Color', 'mini-ajax-cart'); ?></label>
                            <div class="majc-color-input-field">
                                <input type="text" class="color-picker majc-color-picker" name="majc_settings[custom][continueshop_btn_font_color]" value="<?php echo isset($majc_custom['continueshop_btn_font_color']) ? esc_attr($majc_custom['continueshop_btn_font_color']) : null; ?>">
                            </div>
                        </li>

                        <li class="majc-color-settings-field">
                            <label><?php esc_html_e('Text Color (Hover)', 'mini-ajax-cart'); ?></label>
                            <div class="majc-color-input-field">
                                <input type="text" class="color-picker majc-color-picker" name="majc_settings[custom][continueshop_btn_hover_font_color]" value="<?php echo isset($majc_custom['continueshop_btn_hover_font_color']) ? esc_attr($majc_custom['continueshop_btn_hover_font_color']) : null; ?>">
                            </div>
                        </li>

                        <li class="majc-color-settings-field">
                            <label><?php esc_html_e('Border Color', 'mini-ajax-cart'); ?></label>
                            <div class="majc-color-input-field">
                                <input type="text" class="color-picker majc-color-picker" name="majc_settings[custom][continueshop_btn_normal_border_color]" value="<?php echo isset($majc_custom['continueshop_btn_normal_border_color']) ? esc_attr($majc_custom['continueshop_btn_normal_border_color']) : null; ?>">
                            </div>
                        </li>

                        <li class="majc-color-settings-field">
                            <label><?php esc_html_e('Border Color (Hover)', 'mini-ajax-cart'); ?></label>
                            <div class="majc-color-input-field">
                                <input type="text" class="color-picker majc-color-picker" name="majc_settings[custom][continueshop_btn_hover_border_color]" value="<?php echo isset($majc_custom['continueshop_btn_hover_border_color']) ? esc_attr($majc_custom['continueshop_btn_hover_border_color']) : null; ?>">
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <!-- ***************** -->
            <!-- ** View Cart Button Text ** -->
            <!-- ***************** -->
            <div class="majc-settings-row">
                <label><?php esc_html_e('Cart/CheckOut Button', 'mini-ajax-cart'); ?></label>
                <div class="majc-settings-fields">
                    <ul class="majc-color-fields">
                        <li class="majc-color-settings-field">
                            <label><?php esc_html_e('Background Color', 'mini-ajax-cart'); ?></label>
                            <div class="majc-color-input-field">
                                <input type="text" class="color-picker majc-color-picker" name="majc_settings[custom][viewcart_btn_bg_color]" value="<?php echo isset($majc_custom['viewcart_btn_bg_color']) ? esc_attr($majc_custom['viewcart_btn_bg_color']) : null; ?>">
                            </div>
                        </li>

                        <li class="majc-color-settings-field">
                            <label><?php esc_html_e('Background Color (Hover)', 'mini-ajax-cart'); ?></label>
                            <div class="majc-color-input-field">
                                <input type="text" class="color-picker majc-color-picker" name="majc_settings[custom][viewcart_btn_hover_bg_color]" value="<?php echo isset($majc_custom['viewcart_btn_hover_bg_color']) ? esc_attr($majc_custom['viewcart_btn_hover_bg_color']) : null; ?>">
                            </div>
                        </li>

                        <li class="majc-color-settings-field">
                            <label><?php esc_html_e('Text Color', 'mini-ajax-cart'); ?></label>
                            <div class="majc-color-input-field">
                                <input type="text" class="color-picker majc-color-picker" name="majc_settings[custom][viewcart_btn_font_color]" value="<?php echo isset($majc_custom['viewcart_btn_font_color']) ? esc_attr($majc_custom['viewcart_btn_font_color']) : null; ?>">
                            </div>
                        </li>

                        <li class="majc-color-settings-field">
                            <label><?php esc_html_e('Text Color (Hover)', 'mini-ajax-cart'); ?></label>
                            <div class="majc-color-input-field">
                                <input type="text" class="color-picker majc-color-picker" name="majc_settings[custom][viewcart_btn_hover_font_color]" value="<?php echo isset($majc_custom['viewcart_btn_hover_font_color']) ? esc_attr($majc_custom['viewcart_btn_hover_font_color']) : null; ?>">
                            </div>
                        </li>

                        <li class="majc-color-settings-field">
                            <label><?php esc_html_e('Border Color', 'mini-ajax-cart'); ?></label>
                            <div class="majc-color-input-field">
                                <input type="text" class="color-picker majc-color-picker" name="majc_settings[custom][viewcart_btn_normal_border_color]" value="<?php echo isset($majc_custom['viewcart_btn_normal_border_color']) ? esc_attr($majc_custom['viewcart_btn_normal_border_color']) : null; ?>">
                            </div>
                        </li>

                        <li class="majc-color-settings-field">
                            <label><?php esc_html_e('Border Color (Hover)', 'mini-ajax-cart'); ?></label>
                            <div class="majc-color-input-field">
                                <input type="text" class="color-picker majc-color-picker" name="majc_settings[custom][viewcart_btn_hover_border_color]" value="<?php echo isset($majc_custom['viewcart_btn_hover_border_color']) ? esc_attr($majc_custom['viewcart_btn_hover_border_color']) : null; ?>">
                            </div>
                        </li>
                    </ul>
                </div>
            </div>

            <!-- ***************** -->
            <!-- ** Remove Product Button ** -->
            <!-- ***************** -->
            <div class="majc-settings-row">
                <label><?php esc_html_e('Remove Product Button (Grid Layout)', 'mini-ajax-cart'); ?></label>
                <div class="majc-settings-fields">
                    <ul class="majc-color-fields">
                        <li class="majc-color-settings-field">
                            <label><?php esc_html_e('Background Color', 'mini-ajax-cart'); ?></label>
                            <div class="majc-color-input-field">
                                <input type="text" class="color-picker majc-color-picker" name="majc_settings[custom][remove_product_btn_bg_color]" value="<?php echo isset($majc_custom['remove_product_btn_bg_color']) ? esc_attr($majc_custom['remove_product_btn_bg_color']) : null; ?>">
                            </div>
                        </li>

                        <li class="majc-color-settings-field">
                            <label><?php esc_html_e('Text Color', 'mini-ajax-cart'); ?></label>
                            <div class="majc-color-input-field">
                                <input type="text" class="color-picker majc-color-picker" name="majc_settings[custom][remove_product_btn_font_color]" value="<?php echo isset($majc_custom['remove_product_btn_font_color']) ? esc_attr($majc_custom['remove_product_btn_font_color']) : null; ?>">
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>