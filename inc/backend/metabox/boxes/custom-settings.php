<?php
$custom = isset($majc_settings['custom']) ? $majc_settings['custom'] : null;
$standard_fonts = majc_get_standard_font_families();
$google_fonts = majc_get_google_font_families();
$text_transforms = majc_get_text_transform_choices();
$text_decorations = majc_get_text_decoration_choices();
?>

<div id="custom-settings" class="tab-content majc-settings-content" style="display: none;">

    <div class="majc-settings-field">
        <label><?php esc_html_e('Enable Customizations', 'mini-ajax-cart'); ?></label>
        <div class="majc-settings-input-field">
            <input type="checkbox" name="majc_settings[custom][enable]" onchange="hideShow(this)" target="majc-custom-fields" <?php
            if (isset($custom['enable'])) {
                checked($custom['enable'], 'on', true);
            }
            ?>>
        </div>
    </div><br>	

    <div class="majc-custom-fields majc-on" style="<?php echo isset($custom['enable']) ? 'display: block;' : 'display: none;'; ?>">
        <div class="majc-float-menu-field majc-header-title-field">
            <h2><?php esc_html_e('Header Title', 'mini-ajax-cart'); ?></h2>

            <ul class="majc-typography-fields">
                <li class="majc-settings-field typography-font-family">
                    <label><?php esc_html_e('Font Family', 'mini-ajax-cart'); ?></label>
                    <div class="majc-settings-input-field">
                        <select name="majc_settings[custom][header_title_font_family]" class="typography_face">

                            <?php
                            if ($standard_fonts) {
                                ?>
                                <optgroup label="Standard Fonts">
                                    <?php foreach ($standard_fonts as $standard_font) { ?>
                                        <option value="<?php echo esc_attr($standard_font); ?>" <?php
                                        if (isset($custom['header_title_font_family'])) {
                                            selected($custom['header_title_font_family'], $standard_font);
                                        }
                                        ?>><?php echo esc_attr($standard_font); ?></option>
                                            <?php } ?>
                                </optgroup>
                            <?php } ?>

                            <?php
                            if ($google_fonts) {
                                ?>
                                <optgroup label="Google Fonts">
                                    <?php foreach ($google_fonts as $google_font) { ?>
                                        <option value="<?php echo esc_attr($google_font); ?>" <?php
                                        if (isset($custom['header_title_font_family'])) {
                                            selected($custom['header_title_font_family'], $google_font);
                                        }
                                        ?>><?php echo esc_attr($google_font); ?></option>
                                            <?php } ?>
                                </optgroup>
                            <?php } ?>

                        </select>
                    </div>
                </li>

                <li class="majc-settings-field typography-font-style">
                    <label><?php esc_html_e('Font Style', 'mini-ajax-cart'); ?></label>

                    <?php
                    $header_title_family = isset($custom['header_title_font_family']) ? $custom['header_title_font_family'] : 'Helvetica';
                    $font_weights = majc_get_font_weight_choices($header_title_family);
                    if ($font_weights) {
                        ?>
                        <div class="majc-settings-input-field">
                            <select name="majc_settings[custom][header_title_font_style]" class="typography_font_style">
                                <?php foreach ($font_weights as $font_weight => $font_weight_label) { ?>
                                    <option value="<?php echo esc_attr($font_weight); ?>" <?php
                                    if (isset($custom['header_title_font_style'])) {
                                        selected($custom['header_title_font_style'], $font_weight);
                                    }
                                    ?>><?php echo esc_html($font_weight_label); ?></option>
                                        <?php } ?>
                            </select>
                        </div>
                    <?php } ?>
                </li>

                <li class="majc-settings-field typography-text-transform">
                    <label><?php esc_html_e('Text Transform', 'mini-ajax-cart'); ?></label>

                    <?php
                    if ($text_transforms) {
                        ?>
                        <div class="majc-settings-input-field">
                            <select name="majc_settings[custom][header_title_text_transform]" class="typography_text_transform">

                                <?php foreach ($text_transforms as $key => $value) { ?>

                                    <option value="<?php echo esc_attr($key) ?>" <?php
                                    if (isset($custom['header_title_text_transform'])) {
                                        selected($custom['header_title_text_transform'], $key);
                                    }
                                    ?>><?php echo esc_html($value); ?></option>

                                <?php } ?>
                            </select>
                        </div>
                    <?php } ?>
                </li>

                <li class="majc-settings-field typography-text-decoration">
                    <label><?php esc_html_e('Text Decoration', 'mini-ajax-cart'); ?></label>

                    <?php
                    if ($text_decorations) {
                        ?>
                        <div class="majc-settings-input-field">
                            <select name="majc_settings[custom][header_title_text_decoration]" class="typography_text_decoration">

                                <?php foreach ($text_decorations as $key => $value) { ?>

                                    <option value="<?php echo esc_attr($key) ?>" <?php
                                    if (isset($custom['header_title_text_decoration'])) {
                                        selected($custom['header_title_text_decoration'], $key);
                                    }
                                    ?>><?php echo esc_html($value); ?></option>

                                <?php } ?>
                            </select>
                        </div>
                    <?php } ?>
                </li>
            </ul>
        </div>

        <div class="majc-settings-field majc-typography-font-size">
            <label><?php esc_html_e('Font Size', 'mini-ajax-cart'); ?></label>

            <div class="majc-settings-input-field">
                <input min="0" max="60" type="number" value="<?php echo isset($custom['header_title_font_size']) ? intval($custom['header_title_font_size']) : null; ?>" name="majc_settings[custom][header_title_font_size]"/>
            </div>
        </div>


        <div class="majc-settings-field majc-typography-line-height">
            <label><?php esc_html_e('Line Height', 'mini-ajax-cart'); ?></label>

            <div class="majc-settings-input-field">
                <input class="range-input-selector" type="number" min="0" max="2" step="0.1" value="<?php echo isset($custom['header_title_line_height']) ? floatval($custom['header_title_line_height']) : null; ?>" name="majc_settings[custom][header_title_line_height]"/>
            </div>         
        </div>


        <div class="majc-settings-field majc-typography-letter-spacing">
            <label><?php esc_html_e('Letter Spacing', 'mini-ajax-cart'); ?></label>

            <div class="majc-settings-input-field">
                <input class="majc-range-input-selector" type="number" min="0" max="9" step="1" value="<?php echo isset($custom['header_title_letter_spacing']) ? esc_attr($custom['header_title_letter_spacing']) : null; ?>" name="majc_settings[custom][header_title_letter_spacing]"/>
            </div>           
        </div>

        <div class="majc-settings-field">
            <label><?php esc_html_e('Font Color', 'mini-ajax-cart'); ?></label>
            <div class="majc-settings-input-field">
                <input type="text" class="color-picker majc-color-picker" name="majc_settings[custom][header_title_font_color]" value="<?php echo isset($custom['header_title_font_color']) ? esc_attr($custom['header_title_font_color']) : null; ?>">
            </div>
        </div>

        <!-- ***************** -->
        <!-- ** Summary Label ** -->
        <!-- ***************** -->
        <div class="majc-float-menu-field majc-summary-title-field">
            <h2><?php esc_html_e('Summary Title', 'mini-ajax-cart'); ?></h2>

            <ul class="majc-typography-fields">
                <li class="majc-settings-field typography-font-family">
                    <label><?php esc_html_e('Font Family', 'mini-ajax-cart'); ?></label>
                    <div class="majc-settings-input-field">
                        <select name="majc_settings[custom][summary_label_font_family]" class="typography_face">

                            <?php
                            if ($standard_fonts) {
                                ?>
                                <optgroup label="Standard Fonts">
                                    <?php foreach ($standard_fonts as $standard_font) { ?>
                                        <option value="<?php echo esc_attr($standard_font); ?>" <?php
                                        if (isset($custom['summary_label_font_family'])) {
                                            selected($custom['summary_label_font_family'], $standard_font);
                                        }
                                        ?>><?php echo esc_attr($standard_font); ?></option>
                                            <?php } ?>
                                </optgroup>
                            <?php } ?>

                            <?php
                            if ($google_fonts) {
                                ?>
                                <optgroup label="Google Fonts">
                                    <?php foreach ($google_fonts as $google_font) { ?>
                                        <option value="<?php echo esc_attr($google_font); ?>" <?php
                                        if (isset($custom['summary_label_font_family'])) {
                                            selected($custom['summary_label_font_family'], $google_font);
                                        }
                                        ?>><?php echo esc_attr($google_font); ?></option>
                                            <?php } ?>
                                </optgroup>
                            <?php } ?>

                        </select>
                    </div>
                </li>

                <li class="majc-settings-field typography-font-style">
                    <label><?php esc_html_e('Font Style', 'mini-ajax-cart'); ?></label>

                    <?php
                    $header_title_family = isset($custom['summary_label_font_family']) ? $custom['summary_label_font_family'] : 'Helvetica';
                    $font_weights = majc_get_font_weight_choices($header_title_family);
                    if ($font_weights) {
                        ?>
                        <div class="majc-settings-input-field">
                            <select name="majc_settings[custom][summary_label_font_style]" class="typography_font_style">
                                <?php foreach ($font_weights as $font_weight => $font_weight_label) { ?>
                                    <option value="<?php echo esc_attr($font_weight); ?>" <?php
                                    if (isset($custom['summary_label_font_style'])) {
                                        selected($custom['summary_label_font_style'], $font_weight);
                                    }
                                    ?>><?php echo esc_html($font_weight_label); ?></option>
                                        <?php } ?>
                            </select>
                        </div>
                    <?php } ?>
                </li>

                <li class="majc-settings-field typography-text-transform">
                    <label><?php esc_html_e('Text Transform', 'mini-ajax-cart'); ?></label>

                    <?php
                    if ($text_transforms) {
                        ?>
                        <div class="majc-settings-input-field">
                            <select name="majc_settings[custom][summary_label_text_transform]" class="typography_text_transform">

                                <?php foreach ($text_transforms as $key => $value) { ?>

                                    <option value="<?php echo esc_attr($key) ?>" <?php
                                    if (isset($custom['summary_label_text_transform'])) {
                                        selected($custom['summary_label_text_transform'], $key);
                                    }
                                    ?>><?php echo esc_html($value); ?></option>

                                <?php } ?>
                            </select>
                        </div>
                    <?php } ?>
                </li>

                <li class="majc-settings-field typography-text-decoration">
                    <label><?php esc_html_e('Text Decoration', 'mini-ajax-cart'); ?></label>

                    <?php
                    if ($text_decorations) {
                        ?>
                        <div class="majc-settings-input-field">
                            <select name="majc_settings[custom][summary_label_text_decoration]" class="typography_text_decoration">

                                <?php foreach ($text_decorations as $key => $value) { ?>

                                    <option value="<?php echo esc_attr($key) ?>" <?php
                                    if (isset($custom['summary_label_text_decoration'])) {
                                        selected($custom['summary_label_text_decoration'], $key);
                                    }
                                    ?>><?php echo esc_html($value); ?></option>

                                <?php } ?>
                            </select>
                        </div>
                    <?php } ?>
                </li>
            </ul>
        </div>

        <div class="majc-settings-field majc-typography-font-size">
            <label><?php esc_html_e('Font Size', 'mini-ajax-cart'); ?></label>

            <div class="majc-settings-input-field">
                <input min="0" max="60" type="number" value="<?php echo isset($custom['summary_label_font_size']) ? intval($custom['summary_label_font_size']) : null; ?>" name="majc_settings[custom][summary_label_font_size]"/>
            </div>
        </div>


        <div class="majc-settings-field majc-typography-line-height">
            <label><?php esc_html_e('Line Height', 'mini-ajax-cart'); ?></label>

            <div class="majc-settings-input-field">
                <input class="range-input-selector" type="number" min="0" max="2" step="0.1" value="<?php echo isset($custom['summary_label_line_height']) ? floatval($custom['summary_label_line_height']) : null; ?>" name="majc_settings[custom][summary_label_line_height]"/>
            </div>         
        </div>


        <div class="majc-settings-field majc-typography-letter-spacing">
            <label><?php esc_html_e('Letter Spacing', 'mini-ajax-cart'); ?></label>

            <div class="majc-settings-input-field">
                <input class="majc-range-input-selector" type="number" min="0" max="9" step="1" value="<?php echo isset($custom['summary_label_letter_spacing']) ? esc_attr($custom['summary_label_letter_spacing']) : null; ?>" name="majc_settings[custom][summary_label_letter_spacing]"/>
            </div>           
        </div>

        <div class="majc-settings-field">
            <label><?php esc_html_e('Font Color', 'mini-ajax-cart'); ?></label>
            <div class="majc-settings-input-field">
                <input type="text" class="color-picker majc-color-picker" name="majc_settings[custom][summary_label_font_color]" value="<?php echo isset($custom['summary_label_font_color']) ? esc_attr($custom['summary_label_font_color']) : null; ?>">
            </div>
        </div>

        <div class="majc-settings-field">
            <label><?php esc_html_e('Bottom Border Color', 'mini-ajax-cart'); ?></label>
            <div class="majc-settings-input-field">
                <input type="text" class="color-picker majc-color-picker" name="majc_settings[custom][summary_border_color]" value="<?php echo isset($custom['summary_border_color']) ? esc_attr($custom['summary_border_color']) : null; ?>">
            </div>
        </div>

        <!-- ***************** -->
        <!-- ** Shipping Title Text ** -->
        <!-- ***************** -->
        <div class="majc-float-menu-field majc-shipping-title-field">
            <h2><?php esc_html_e('Shipping Title', 'mini-ajax-cart'); ?></h2>

            <ul class="majc-typography-fields">
                <li class="majc-settings-field typography-font-family">
                    <label><?php esc_html_e('Font Family', 'mini-ajax-cart'); ?></label>
                    <div class="majc-settings-input-field">
                        <select name="majc_settings[custom][shipping_title_font_family]" class="typography_face">

                            <?php
                            if ($standard_fonts) {
                                ?>
                                <optgroup label="Standard Fonts">
                                    <?php foreach ($standard_fonts as $standard_font) { ?>
                                        <option value="<?php echo esc_attr($standard_font); ?>" <?php
                                        if (isset($custom['shipping_title_font_family'])) {
                                            selected($custom['shipping_title_font_family'], $standard_font);
                                        }
                                        ?>><?php echo esc_attr($standard_font); ?></option>
                                            <?php } ?>
                                </optgroup>
                            <?php } ?>

                            <?php
                            if ($google_fonts) {
                                ?>
                                <optgroup label="Google Fonts">
                                    <?php foreach ($google_fonts as $google_font) { ?>
                                        <option value="<?php echo esc_attr($google_font); ?>" <?php
                                        if (isset($custom['shipping_title_font_family'])) {
                                            selected($custom['shipping_title_font_family'], $google_font);
                                        }
                                        ?>><?php echo esc_attr($google_font); ?></option>
                                            <?php } ?>
                                </optgroup>
                            <?php } ?>

                        </select>
                    </div>
                </li>

                <li class="majc-settings-field typography-font-style">
                    <label><?php esc_html_e('Font Style', 'mini-ajax-cart'); ?></label>

                    <?php
                    $header_title_family = isset($custom['shipping_title_font_family']) ? $custom['shipping_title_font_family'] : 'Helvetica';
                    $font_weights = majc_get_font_weight_choices($header_title_family);
                    if ($font_weights) {
                        ?>
                        <div class="majc-settings-input-field">
                            <select name="majc_settings[custom][shipping_title_font_style]" class="typography_font_style">
                                <?php foreach ($font_weights as $font_weight => $font_weight_label) { ?>
                                    <option value="<?php echo esc_attr($font_weight); ?>" <?php
                                    if (isset($custom['shipping_title_font_style'])) {
                                        selected($custom['shipping_title_font_style'], $font_weight);
                                    }
                                    ?>><?php echo esc_html($font_weight_label); ?></option>
                                        <?php } ?>
                            </select>
                        </div>
                    <?php } ?>
                </li>

                <li class="majc-settings-field typography-text-transform">
                    <label><?php esc_html_e('Text Transform', 'mini-ajax-cart'); ?></label>

                    <?php
                    if ($text_transforms) {
                        ?>
                        <div class="majc-settings-input-field">
                            <select name="majc_settings[custom][shipping_title_text_transform]" class="typography_text_transform">

                                <?php foreach ($text_transforms as $key => $value) { ?>

                                    <option value="<?php echo esc_attr($key) ?>" <?php
                                    if (isset($custom['shipping_title_text_transform'])) {
                                        selected($custom['shipping_title_text_transform'], $key);
                                    }
                                    ?>><?php echo esc_html($value); ?></option>

                                <?php } ?>
                            </select>
                        </div>
                    <?php } ?>
                </li>

                <li class="majc-settings-field typography-text-decoration">
                    <label><?php esc_html_e('Text Decoration', 'mini-ajax-cart'); ?></label>

                    <?php
                    if ($text_decorations) {
                        ?>
                        <div class="majc-settings-input-field">
                            <select name="majc_settings[custom][shipping_title_text_decoration]" class="typography_text_decoration">

                                <?php foreach ($text_decorations as $key => $value) { ?>

                                    <option value="<?php echo esc_attr($key) ?>" <?php
                                    if (isset($custom['shipping_title_text_decoration'])) {
                                        selected($custom['shipping_title_text_decoration'], $key);
                                    }
                                    ?>><?php echo esc_html($value); ?></option>

                                <?php } ?>
                            </select>
                        </div>
                    <?php } ?>
                </li>
            </ul>
        </div>

        <div class="majc-settings-field majc-typography-font-size">
            <label><?php esc_html_e('Font Size', 'mini-ajax-cart'); ?></label>

            <div class="majc-settings-input-field">
                <input min="0" max="60" type="number" value="<?php echo isset($custom['shipping_title_font_size']) ? intval($custom['shipping_title_font_size']) : null; ?>" name="majc_settings[custom][shipping_title_font_size]"/>
            </div>
        </div>


        <div class="majc-settings-field majc-typography-line-height">
            <label><?php esc_html_e('Line Height', 'mini-ajax-cart'); ?></label>

            <div class="majc-settings-input-field">
                <input class="range-input-selector" type="number" min="0" max="2" step="0.1" value="<?php echo isset($custom['shipping_title_line_height']) ? floatval($custom['shipping_title_line_height']) : null; ?>" name="majc_settings[custom][shipping_title_line_height]"/>
            </div>         
        </div>


        <div class="majc-settings-field majc-typography-letter-spacing">
            <label><?php esc_html_e('Letter Spacing', 'mini-ajax-cart'); ?></label>

            <div class="majc-settings-input-field">
                <input class="majc-range-input-selector" type="number" min="0" max="9" step="1" value="<?php echo isset($custom['shipping_title_letter_spacing']) ? esc_attr($custom['shipping_title_letter_spacing']) : null; ?>" name="majc_settings[custom][shipping_title_letter_spacing]"/>
            </div>           
        </div>

        <div class="majc-settings-field">
            <label><?php esc_html_e('Font Color', 'mini-ajax-cart'); ?></label>
            <div class="majc-settings-input-field">
                <input type="text" class="color-picker majc-color-picker" name="majc_settings[custom][shipping_title_font_color]" value="<?php echo isset($custom['shipping_title_font_color']) ? esc_attr($custom['shipping_title_font_color']) : null; ?>">
            </div>
        </div>

        <!-- ***************** -->
        <!-- ** Button Text Typography ** -->
        <!-- ***************** -->
        <div class="majc-float-menu-field majc-button-text-typography-field">
            <h2><?php esc_html_e('Button Text Typography', 'mini-ajax-cart'); ?></h2>

            <ul class="majc-typography-fields">
                <li class="majc-settings-field typography-font-family">
                    <label><?php esc_html_e('Font Family', 'mini-ajax-cart'); ?></label>
                    <div class="majc-settings-input-field">
                        <select name="majc_settings[custom][button_text_font_family]" class="typography_face">

                            <?php
                            if ($standard_fonts) {
                                ?>
                                <optgroup label="Standard Fonts">
                                    <?php foreach ($standard_fonts as $standard_font) { ?>
                                        <option value="<?php echo esc_attr($standard_font); ?>" <?php
                                        if (isset($custom['button_text_font_family'])) {
                                            selected($custom['button_text_font_family'], $standard_font);
                                        }
                                        ?>><?php echo esc_attr($standard_font); ?></option>
                                            <?php } ?>
                                </optgroup>
                            <?php } ?>

                            <?php
                            if ($google_fonts) {
                                ?>
                                <optgroup label="Google Fonts">
                                    <?php foreach ($google_fonts as $google_font) { ?>
                                        <option value="<?php echo esc_attr($google_font); ?>" <?php
                                        if (isset($custom['button_text_font_family'])) {
                                            selected($custom['button_text_font_family'], $google_font);
                                        }
                                        ?>><?php echo esc_attr($google_font); ?></option>
                                            <?php } ?>
                                </optgroup>
                            <?php } ?>

                        </select>
                    </div>
                </li>

                <li class="majc-settings-field typography-font-style">
                    <label><?php esc_html_e('Font Style', 'mini-ajax-cart'); ?></label>

                    <?php
                    $header_title_family = isset($custom['button_text_font_family']) ? $custom['button_text_font_family'] : 'Helvetica';
                    $font_weights = majc_get_font_weight_choices($header_title_family);
                    if ($font_weights) {
                        ?>
                        <div class="majc-settings-input-field">
                            <select name="majc_settings[custom][button_text_font_style]" class="typography_font_style">
                                <?php foreach ($font_weights as $font_weight => $font_weight_label) { ?>
                                    <option value="<?php echo esc_attr($font_weight); ?>" <?php
                                    if (isset($custom['button_text_font_style'])) {
                                        selected($custom['button_text_font_style'], $font_weight);
                                    }
                                    ?>><?php echo esc_html($font_weight_label); ?></option>
                                        <?php } ?>
                            </select>
                        </div>
                    <?php } ?>
                </li>

                <li class="majc-settings-field typography-text-transform">
                    <label><?php esc_html_e('Text Transform', 'mini-ajax-cart'); ?></label>

                    <?php
                    if ($text_transforms) {
                        ?>
                        <div class="majc-settings-input-field">
                            <select name="majc_settings[custom][button_text_text_transform]" class="typography_text_transform">

                                <?php foreach ($text_transforms as $key => $value) { ?>

                                    <option value="<?php echo esc_attr($key) ?>" <?php
                                    if (isset($custom['button_text_text_transform'])) {
                                        selected($custom['button_text_text_transform'], $key);
                                    }
                                    ?>><?php echo esc_html($value); ?></option>

                                <?php } ?>
                            </select>
                        </div>
                    <?php } ?>
                </li>

                <li class="majc-settings-field typography-text-decoration">
                    <label><?php esc_html_e('Text Decoration', 'mini-ajax-cart'); ?></label>

                    <?php
                    if ($text_decorations) {
                        ?>
                        <div class="majc-settings-input-field">
                            <select name="majc_settings[custom][button_text_text_decoration]" class="typography_text_decoration">

                                <?php foreach ($text_decorations as $key => $value) { ?>

                                    <option value="<?php echo esc_attr($key) ?>" <?php
                                    if (isset($custom['button_text_text_decoration'])) {
                                        selected($custom['button_text_text_decoration'], $key);
                                    }
                                    ?>><?php echo esc_html($value); ?></option>

                                <?php } ?>
                            </select>
                        </div>
                    <?php } ?>
                </li>
            </ul>
        </div>

        <div class="majc-settings-field majc-typography-font-size">
            <label><?php esc_html_e('Font Size', 'mini-ajax-cart'); ?></label>

            <div class="majc-settings-input-field">
                <input min="0" max="60" type="number" value="<?php echo isset($custom['button_text_font_size']) ? intval($custom['button_text_font_size']) : null; ?>" name="majc_settings[custom][button_text_font_size]"/>
            </div>
        </div>


        <div class="majc-settings-field majc-typography-line-height">
            <label><?php esc_html_e('Line Height', 'mini-ajax-cart'); ?></label>

            <div class="majc-settings-input-field">
                <input class="range-input-selector" type="number" min="0" max="2" step="0.1" value="<?php echo isset($custom['button_text_line_height']) ? floatval($custom['button_text_line_height']) : null; ?>" name="majc_settings[custom][button_text_line_height]"/>
            </div>         
        </div>


        <div class="majc-settings-field majc-typography-letter-spacing">
            <label><?php esc_html_e('Letter Spacing', 'mini-ajax-cart'); ?></label>

            <div class="majc-settings-input-field">
                <input class="majc-range-input-selector" type="number" min="0" max="9" step="1" value="<?php echo isset($custom['button_text_letter_spacing']) ? esc_attr($custom['button_text_letter_spacing']) : null; ?>" name="majc_settings[custom][button_text_letter_spacing]"/>
            </div>           
        </div>

        <!-- ***************** -->
        <!-- ** Coupon Button Text ** -->
        <!-- ***************** -->
        <h2><?php esc_html_e('Coupon Button', 'mini-ajax-cart'); ?></h2>

        <div class="majc-settings-field">
            <label><?php esc_html_e('Background Color', 'mini-ajax-cart'); ?></label>
            <div class="majc-settings-input-field">
                <input type="text" class="color-picker majc-color-picker" name="majc_settings[custom][coupon_btn_bg_color]" value="<?php echo isset($custom['coupon_btn_bg_color']) ? esc_attr($custom['coupon_btn_bg_color']) : null; ?>">
            </div>
        </div>

        <div class="majc-settings-field">
            <label><?php esc_html_e('Hover Background Color', 'mini-ajax-cart'); ?></label>
            <div class="majc-settings-input-field">
                <input type="text" class="color-picker majc-color-picker" name="majc_settings[custom][coupon_btn_hover_bg_color]" value="<?php echo isset($custom['coupon_btn_hover_bg_color']) ? esc_attr($custom['coupon_btn_hover_bg_color']) : null; ?>">
            </div>
        </div>

        <div class="majc-settings-field">
            <label><?php esc_html_e('Font Color', 'mini-ajax-cart'); ?></label>
            <div class="majc-settings-input-field">
                <input type="text" class="color-picker majc-color-picker" name="majc_settings[custom][coupon_btn_font_color]" value="<?php echo isset($custom['coupon_btn_font_color']) ? esc_attr($custom['coupon_btn_font_color']) : null; ?>">
            </div>
        </div>

        <div class="majc-settings-field">
            <label><?php esc_html_e('Hover Font Color', 'mini-ajax-cart'); ?></label>
            <div class="majc-settings-input-field">
                <input type="text" class="color-picker majc-color-picker" name="majc_settings[custom][coupon_btn_hover_font_color]" value="<?php echo isset($custom['coupon_btn_hover_font_color']) ? esc_attr($custom['coupon_btn_hover_font_color']) : null; ?>">
            </div>
        </div>

        <!-- ***************** -->
        <!-- ** Continue Shopping Button Text ** -->
        <!-- ***************** -->
        <h2><?php esc_html_e('Continue Shopping Button', 'mini-ajax-cart'); ?></h2>

        <div class="majc-settings-field">
            <label><?php esc_html_e('Background Color', 'mini-ajax-cart'); ?></label>
            <div class="majc-settings-input-field">
                <input type="text" class="color-picker majc-color-picker" name="majc_settings[custom][continueshop_btn_bg_color]" value="<?php echo isset($custom['continueshop_btn_bg_color']) ? esc_attr($custom['continueshop_btn_bg_color']) : null; ?>">
            </div>
        </div>

        <div class="majc-settings-field">
            <label><?php esc_html_e('Hover Background Color', 'mini-ajax-cart'); ?></label>
            <div class="majc-settings-input-field">
                <input type="text" class="color-picker majc-color-picker" name="majc_settings[custom][continueshop_btn_hover_bg_color]" value="<?php echo isset($custom['continueshop_btn_hover_bg_color']) ? esc_attr($custom['continueshop_btn_hover_bg_color']) : null; ?>">
            </div>
        </div>

        <div class="majc-settings-field">
            <label><?php esc_html_e('Font Color', 'mini-ajax-cart'); ?></label>
            <div class="majc-settings-input-field">
                <input type="text" class="color-picker majc-color-picker" name="majc_settings[custom][continueshop_btn_font_color]" value="<?php echo isset($custom['continueshop_btn_font_color']) ? esc_attr($custom['continueshop_btn_font_color']) : null; ?>">
            </div>
        </div>

        <div class="majc-settings-field">
            <label><?php esc_html_e('Hover Font Color', 'mini-ajax-cart'); ?></label>
            <div class="majc-settings-input-field">
                <input type="text" class="color-picker majc-color-picker" name="majc_settings[custom][continueshop_btn_hover_font_color]" value="<?php echo isset($custom['continueshop_btn_hover_font_color']) ? esc_attr($custom['continueshop_btn_hover_font_color']) : null; ?>">
            </div>
        </div>

        <div class="majc-settings-field">
            <label><?php esc_html_e('Normal Border Color', 'mini-ajax-cart'); ?></label>
            <div class="majc-settings-input-field">
                <input type="text" class="color-picker majc-color-picker" name="majc_settings[custom][continueshop_btn_normal_border_color]" value="<?php echo isset($custom['continueshop_btn_normal_border_color']) ? esc_attr($custom['continueshop_btn_normal_border_color']) : null; ?>">
            </div>
        </div>

        <div class="majc-settings-field">
            <label><?php esc_html_e('Hover Border Color', 'mini-ajax-cart'); ?></label>
            <div class="majc-settings-input-field">
                <input type="text" class="color-picker majc-color-picker" name="majc_settings[custom][continueshop_btn_hover_border_color]" value="<?php echo isset($custom['continueshop_btn_hover_border_color']) ? esc_attr($custom['continueshop_btn_hover_border_color']) : null; ?>">
            </div>
        </div>

        <!-- ***************** -->
        <!-- ** View Cart Button Text ** -->
        <!-- ***************** -->
        <h2><?php esc_html_e('View Cart Button', 'mini-ajax-cart'); ?></h2>

        <div class="majc-settings-field">
            <label><?php esc_html_e('Background Color', 'mini-ajax-cart'); ?></label>
            <div class="majc-settings-input-field">
                <input type="text" class="color-picker majc-color-picker" name="majc_settings[custom][viewcart_btn_bg_color]" value="<?php echo isset($custom['viewcart_btn_bg_color']) ? esc_attr($custom['viewcart_btn_bg_color']) : null; ?>">
            </div>
        </div>

        <div class="majc-settings-field">
            <label><?php esc_html_e('Hover Background Color', 'mini-ajax-cart'); ?></label>
            <div class="majc-settings-input-field">
                <input type="text" class="color-picker majc-color-picker" name="majc_settings[custom][viewcart_btn_hover_bg_color]" value="<?php echo isset($custom['viewcart_btn_hover_bg_color']) ? esc_attr($custom['viewcart_btn_hover_bg_color']) : null; ?>">
            </div>
        </div>

        <div class="majc-settings-field">
            <label><?php esc_html_e('Font Color', 'mini-ajax-cart'); ?></label>
            <div class="majc-settings-input-field">
                <input type="text" class="color-picker majc-color-picker" name="majc_settings[custom][viewcart_btn_font_color]" value="<?php echo isset($custom['viewcart_btn_font_color']) ? esc_attr($custom['viewcart_btn_font_color']) : null; ?>">
            </div>
        </div>

        <div class="majc-settings-field">
            <label><?php esc_html_e('Hover Font Color', 'mini-ajax-cart'); ?></label>
            <div class="majc-settings-input-field">
                <input type="text" class="color-picker majc-color-picker" name="majc_settings[custom][viewcart_btn_hover_font_color]" value="<?php echo isset($custom['viewcart_btn_hover_font_color']) ? esc_attr($custom['viewcart_btn_hover_font_color']) : null; ?>">
            </div>
        </div>

        <div class="majc-settings-field">
            <label><?php esc_html_e('Normal Border Color', 'mini-ajax-cart'); ?></label>
            <div class="majc-settings-input-field">
                <input type="text" class="color-picker majc-color-picker" name="majc_settings[custom][viewcart_btn_normal_border_color]" value="<?php echo isset($custom['viewcart_btn_normal_border_color']) ? esc_attr($custom['viewcart_btn_normal_border_color']) : null; ?>">
            </div>
        </div>

        <div class="majc-settings-field">
            <label><?php esc_html_e('Hover Border Color', 'mini-ajax-cart'); ?></label>
            <div class="majc-settings-input-field">
                <input type="text" class="color-picker majc-color-picker" name="majc_settings[custom][viewcart_btn_hover_border_color]" value="<?php echo isset($custom['viewcart_btn_hover_border_color']) ? esc_attr($custom['viewcart_btn_hover_border_color']) : null; ?>">
            </div>
        </div>

        <!-- ***************** -->
        <!-- ** Checkout Button Text ** -->
        <!-- ***************** -->
        <h2><?php esc_html_e('Checkout Button', 'mini-ajax-cart'); ?></h2>

        <div class="majc-settings-field">
            <label><?php esc_html_e('Background Color', 'mini-ajax-cart'); ?></label>
            <div class="majc-settings-input-field">
                <input type="text" class="color-picker majc-color-picker" name="majc_settings[custom][checkout_btn_bg_color]" value="<?php echo isset($custom['checkout_btn_bg_color']) ? esc_attr($custom['checkout_btn_bg_color']) : null; ?>">
            </div>
        </div>

        <div class="majc-settings-field">
            <label><?php esc_html_e('Hover Background Color', 'mini-ajax-cart'); ?></label>
            <div class="majc-settings-input-field">
                <input type="text" class="color-picker majc-color-picker" name="majc_settings[custom][checkout_btn_hover_bg_color]" value="<?php echo isset($custom['checkout_btn_hover_bg_color']) ? esc_attr($custom['checkout_btn_hover_bg_color']) : null; ?>">
            </div>
        </div>

        <div class="majc-settings-field">
            <label><?php esc_html_e('Font Color', 'mini-ajax-cart'); ?></label>
            <div class="majc-settings-input-field">
                <input type="text" class="color-picker majc-color-picker" name="majc_settings[custom][checkout_btn_font_color]" value="<?php echo isset($custom['checkout_btn_font_color']) ? esc_attr($custom['checkout_btn_font_color']) : null; ?>">
            </div>
        </div>

        <div class="majc-settings-field">
            <label><?php esc_html_e('Hover Font Color', 'mini-ajax-cart'); ?></label>
            <div class="majc-settings-input-field">
                <input type="text" class="color-picker majc-color-picker" name="majc_settings[custom][checkout_btn_hover_font_color]" value="<?php echo isset($custom['checkout_btn_hover_font_color']) ? esc_attr($custom['checkout_btn_hover_font_color']) : null; ?>">
            </div>
        </div>	

        <div class="majc-settings-field">
            <label><?php esc_html_e('Normal Border Color', 'mini-ajax-cart'); ?></label>
            <div class="majc-settings-input-field">
                <input type="text" class="color-picker majc-color-picker" name="majc_settings[custom][checkout_btn_normal_border_color]" value="<?php echo isset($custom['checkout_btn_normal_border_color']) ? esc_attr($custom['checkout_btn_normal_border_color']) : null; ?>">
            </div>
        </div>

        <div class="majc-settings-field">
            <label><?php esc_html_e('Hover Border Color', 'mini-ajax-cart'); ?></label>
            <div class="majc-settings-input-field">
                <input type="text" class="color-picker majc-color-picker" name="majc_settings[custom][checkout_btn_hover_border_color]" value="<?php echo isset($custom['checkout_btn_hover_border_color']) ? esc_attr($custom['checkout_btn_hover_border_color']) : null; ?>">
            </div>
        </div>

        <!-- ***************** -->
        <!-- ** Trigger Button ** -->
        <!-- ***************** -->
        <h2><?php esc_html_e('Basket Trigger Button', 'mini-ajax-cart'); ?></h2>

        <div class="majc-settings-field">
            <label><?php esc_html_e('Background Color', 'mini-ajax-cart'); ?></label>
            <div class="majc-settings-input-field">
                <input type="text" class="color-picker majc-color-picker" name="majc_settings[custom][trigger_btn_bg_color]" value="<?php echo isset($custom['trigger_btn_bg_color']) ? esc_attr($custom['trigger_btn_bg_color']) : null; ?>">
            </div>
        </div>

        <div class="majc-settings-field">
            <label><?php esc_html_e('Hover Background Color', 'mini-ajax-cart'); ?></label>
            <div class="majc-settings-input-field">
                <input type="text" class="color-picker majc-color-picker" name="majc_settings[custom][trigger_btn_hover_bg_color]" value="<?php echo isset($custom['trigger_btn_hover_bg_color']) ? esc_attr($custom['trigger_btn_hover_bg_color']) : null; ?>">
            </div>
        </div>

        <div class="majc-settings-field">
            <label><?php esc_html_e('Font Color', 'mini-ajax-cart'); ?></label>
            <div class="majc-settings-input-field">
                <input type="text" class="color-picker majc-color-picker" name="majc_settings[custom][trigger_btn_font_color]" value="<?php echo isset($custom['trigger_btn_font_color']) ? esc_attr($custom['trigger_btn_font_color']) : null; ?>">
            </div>
        </div>

        <div class="majc-settings-field">
            <label><?php esc_html_e('Hover Font Color', 'mini-ajax-cart'); ?></label>
            <div class="majc-settings-input-field">
                <input type="text" class="color-picker majc-color-picker" name="majc_settings[custom][trigger_btn_hover_font_color]" value="<?php echo isset($custom['trigger_btn_hover_font_color']) ? esc_attr($custom['trigger_btn_hover_font_color']) : null; ?>">
            </div>
        </div>

        <div class="majc-settings-field">
            <label><?php esc_html_e('Cart Total Box Background Color', 'mini-ajax-cart'); ?></label>
            <div class="majc-settings-input-field">
                <input type="text" class="color-picker majc-color-picker" name="majc_settings[custom][cart_total_box_bg_color]" value="<?php echo isset($custom['cart_total_box_bg_color']) ? esc_attr($custom['cart_total_box_bg_color']) : null; ?>">
            </div>
        </div>

        <div class="majc-settings-field">
            <label><?php esc_html_e('Cart Total Box Text Color', 'mini-ajax-cart'); ?></label>
            <div class="majc-settings-input-field">
                <input type="text" class="color-picker majc-color-picker" name="majc_settings[custom][cart_total_box_text_color]" value="<?php echo isset($custom['cart_total_box_text_color']) ? esc_attr($custom['cart_total_box_text_color']) : null; ?>">
            </div>
        </div>

        <!-- ****************************** -->
        <!-- ** Cart Basket Open Content ** -->
        <!-- ****************************** -->
        <div class="majc-cart-drawer-custom-fields majc-settings-content">
            <h2><?php esc_html_e('Cart Drawer Style', 'mini-ajax-cart'); ?></h2>

            <div class="majc-settings-field">
                <label><?php esc_html_e('Background Type', 'mini-ajax-cart'); ?></label>
                <div class="majc-settings-input-field">
                    <select name="majc_settings[custom][drawer_content_bg_type]" onchange="hideShow(this)" target="majc-content-bg-option-field">
                        <option value="none" <?php
                        if (isset($custom['drawer_content_bg_type'])) {
                            selected($custom['drawer_content_bg_type'], 'none');
                        }
                        ?>><?php esc_html_e('None', 'mini-ajax-cart'); ?></option>
                        <option value="choose_color" <?php
                        if (isset($custom['drawer_content_bg_type'])) {
                            selected($custom['drawer_content_bg_type'], 'choose_color');
                        }
                        ?>><?php esc_html_e('Choose Color', 'mini-ajax-cart'); ?></option>
                        <option value="custom_image_bg" <?php
                        if (isset($custom['drawer_content_bg_type'])) {
                            selected($custom['drawer_content_bg_type'], 'custom_image_bg');
                        }
                        ?>><?php esc_html_e('Custom Image', 'mini-ajax-cart'); ?></option>
                    </select>
                </div>
            </div>

            <div class="majc-settings-field majc-content-bg-option-field majc-choose_color" style="<?php echo isset($custom['drawer_content_bg_type']) && $custom['drawer_content_bg_type'] == 'choose_color' ? 'display: flex;' : 'display: none;'; ?>">
                <label><?php esc_html_e('Background Color', 'mini-ajax-cart'); ?></label>
                <div class="majc-settings-input-field">
                    <input type="text" class="color-picker majc-color-picker" name="majc_settings[custom][drawer_content_bg_color]" value="<?php echo isset($custom['drawer_content_bg_color']) ? esc_attr($custom['drawer_content_bg_color']) : ''; ?>">
                </div>
            </div>

            <div class="majc-settings-field majc-content-bg-option-field majc-custom_image_bg" style="<?php echo isset($custom['drawer_content_bg_type']) && $custom['drawer_content_bg_type'] == 'custom_image_bg' ? 'display: flex;' : 'display: none;'; ?>">
                <label for="majc-header-icon"><?php esc_html_e('Upload Custom Icon', 'mini-ajax-cart'); ?></label>
                <div class="majc-settings-input-field">
                    <div class="majc-icon-image-uploader">
                        <div class="button majc-custom-img-icon-btn">
                            <div class="majc-custom-menu-image-icon current-bg-image" >
                                <?php if (isset($custom['drawer_content_bg_image']) && !empty($custom['drawer_content_bg_image'])) { ?>
                                    <img src="<?php echo isset($custom['drawer_content_bg_image']) ? esc_url($custom['drawer_content_bg_image']) : ''; ?>"/>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="majc-image-remove"><?php esc_html_e('Remove', 'mini-ajax-cart'); ?></div>
                        <div class="majc-image-upload"><?php esc_html_e('Upload', 'mini-ajax-cart') ?></div>
                        <input type="hidden" class="majc-upload-background-url" name="majc_settings[custom][drawer_content_bg_image]" id="majc-header-icon" value="<?php echo isset($custom['drawer_content_bg_image']) ? esc_url($custom['drawer_content_bg_image']) : ''; ?>"/>
                    </div> <!-- majc-icon-image-uploader -->
                </div>
            </div>
        </div>


        <!-- ***************** -->
        <!-- ** Added Product Title ** -->
        <!-- ***************** -->
        <div class="majc-float-menu-field majc-added-product-title-field">
            <h2><?php esc_html_e('Added Product Title', 'mini-ajax-cart'); ?></h2>

            <ul class="majc-typography-fields">
                <li class="majc-settings-field typography-font-family">
                    <label><?php esc_html_e('Font Family', 'mini-ajax-cart'); ?></label>
                    <div class="majc-settings-input-field">
                        <select name="majc_settings[custom][added_product_title_font_family]" class="typography_face">

                            <?php
                            if ($standard_fonts) {
                                ?>
                                <optgroup label="Standard Fonts">
                                    <?php foreach ($standard_fonts as $standard_font) { ?>
                                        <option value="<?php echo esc_attr($standard_font); ?>" <?php
                                        if (isset($custom['added_product_title_font_family'])) {
                                            selected($custom['added_product_title_font_family'], $standard_font);
                                        }
                                        ?>><?php echo esc_attr($standard_font); ?></option>
                                            <?php } ?>
                                </optgroup>
                            <?php } ?>

                            <?php
                            if ($google_fonts) {
                                ?>
                                <optgroup label="Google Fonts">
                                    <?php foreach ($google_fonts as $google_font) { ?>
                                        <option value="<?php echo esc_attr($google_font); ?>" <?php
                                        if (isset($custom['added_product_title_font_family'])) {
                                            selected($custom['added_product_title_font_family'], $google_font);
                                        }
                                        ?>><?php echo esc_attr($google_font); ?></option>
                                            <?php } ?>
                                </optgroup>
                            <?php } ?>

                        </select>
                    </div>
                </li>

                <li class="majc-settings-field typography-font-style">
                    <label><?php esc_html_e('Font Style', 'mini-ajax-cart'); ?></label>

                    <?php
                    $header_title_family = isset($custom['added_product_title_font_family']) ? $custom['added_product_title_font_family'] : 'Helvetica';
                    $font_weights = majc_get_font_weight_choices($header_title_family);
                    if ($font_weights) {
                        ?>
                        <div class="majc-settings-input-field">
                            <select name="majc_settings[custom][added_product_title_font_style]" class="typography_font_style">
                                <?php foreach ($font_weights as $font_weight => $font_weight_label) { ?>
                                    <option value="<?php echo esc_attr($font_weight); ?>" <?php
                                    if (isset($custom['added_product_title_font_style'])) {
                                        selected($custom['added_product_title_font_style'], $font_weight);
                                    }
                                    ?>><?php echo esc_html($font_weight_label); ?></option>
                                        <?php } ?>
                            </select>
                        </div>
                    <?php } ?>
                </li>

                <li class="majc-settings-field typography-text-transform">
                    <label><?php esc_html_e('Text Transform', 'mini-ajax-cart'); ?></label>

                    <?php
                    if ($text_transforms) {
                        ?>
                        <div class="majc-settings-input-field">
                            <select name="majc_settings[custom][added_product_title_text_transform]" class="typography_text_transform">

                                <?php foreach ($text_transforms as $key => $value) { ?>

                                    <option value="<?php echo esc_attr($key) ?>" <?php
                                    if (isset($custom['added_product_title_text_transform'])) {
                                        selected($custom['added_product_title_text_transform'], $key);
                                    }
                                    ?>><?php echo esc_html($value); ?></option>

                                <?php } ?>
                            </select>
                        </div>
                    <?php } ?>
                </li>

                <li class="majc-settings-field typography-text-decoration">
                    <label><?php esc_html_e('Text Decoration', 'mini-ajax-cart'); ?></label>

                    <?php
                    if ($text_decorations) {
                        ?>
                        <div class="majc-settings-input-field">
                            <select name="majc_settings[custom][added_product_title_text_decoration]" class="typography_text_decoration">

                                <?php foreach ($text_decorations as $key => $value) { ?>

                                    <option value="<?php echo esc_attr($key) ?>" <?php
                                    if (isset($custom['added_product_title_text_decoration'])) {
                                        selected($custom['added_product_title_text_decoration'], $key);
                                    }
                                    ?>><?php echo esc_html($value); ?></option>

                                <?php } ?>
                            </select>
                        </div>
                    <?php } ?>
                </li>
            </ul>
        </div>

        <div class="majc-settings-field majc-typography-font-size">
            <label><?php esc_html_e('Font Size', 'mini-ajax-cart'); ?></label>

            <div class="majc-settings-input-field">
                <input min="0" max="60" type="number" value="<?php echo isset($custom['added_product_title_font_size']) ? intval($custom['added_product_title_font_size']) : null; ?>" name="majc_settings[custom][added_product_title_font_size]"/>
            </div>
        </div>


        <div class="majc-settings-field majc-typography-line-height">
            <label><?php esc_html_e('Line Height', 'mini-ajax-cart'); ?></label>

            <div class="majc-settings-input-field">
                <input class="range-input-selector" type="number" min="0" max="2" step="0.1" value="<?php echo isset($custom['added_product_title_line_height']) ? floatval($custom['added_product_title_line_height']) : null; ?>" name="majc_settings[custom][added_product_title_line_height]"/>
            </div>         
        </div>


        <div class="majc-settings-field majc-typography-letter-spacing">
            <label><?php esc_html_e('Letter Spacing', 'mini-ajax-cart'); ?></label>

            <div class="majc-settings-input-field">
                <input class="majc-range-input-selector" type="number" min="0" max="9" step="1" value="<?php echo isset($custom['added_product_title_letter_spacing']) ? esc_attr($custom['added_product_title_letter_spacing']) : null; ?>" name="majc_settings[custom][added_product_title_letter_spacing]"/>
            </div>           
        </div>

        <div class="majc-settings-field">
            <label><?php esc_html_e('Font Color', 'mini-ajax-cart'); ?></label>
            <div class="majc-settings-input-field">
                <input type="text" class="color-picker majc-color-picker" name="majc_settings[custom][added_product_title_font_color]" value="<?php echo isset($custom['added_product_title_font_color']) ? esc_attr($custom['added_product_title_font_color']) : null; ?>">
            </div>
        </div>


        <!-- ***************** -->
        <!-- ** Added Product Price ** -->
        <!-- ***************** -->
        <div class="majc-float-menu-field majc-added-product-price-field">
            <h2><?php esc_html_e('Added Product Price', 'mini-ajax-cart'); ?></h2>

            <ul class="majc-typography-fields">
                <li class="majc-settings-field typography-font-family">
                    <label><?php esc_html_e('Font Family', 'mini-ajax-cart'); ?></label>
                    <div class="majc-settings-input-field">
                        <select name="majc_settings[custom][added_product_price_font_family]" class="typography_face">

                            <?php
                            if ($standard_fonts) {
                                ?>
                                <optgroup label="Standard Fonts">
                                    <?php foreach ($standard_fonts as $standard_font) { ?>
                                        <option value="<?php echo esc_attr($standard_font); ?>" <?php
                                        if (isset($custom['added_product_price_font_family'])) {
                                            selected($custom['added_product_price_font_family'], $standard_font);
                                        }
                                        ?>><?php echo esc_attr($standard_font); ?></option>
                                            <?php } ?>
                                </optgroup>
                            <?php } ?>

                            <?php
                            if ($google_fonts) {
                                ?>
                                <optgroup label="Google Fonts">
                                    <?php foreach ($google_fonts as $google_font) { ?>
                                        <option value="<?php echo esc_attr($google_font); ?>" <?php
                                        if (isset($custom['added_product_price_font_family'])) {
                                            selected($custom['added_product_price_font_family'], $google_font);
                                        }
                                        ?>><?php echo esc_attr($google_font); ?></option>
                                            <?php } ?>
                                </optgroup>
                            <?php } ?>

                        </select>
                    </div>
                </li>

                <li class="majc-settings-field typography-font-style">
                    <label><?php esc_html_e('Font Style', 'mini-ajax-cart'); ?></label>

                    <?php
                    $header_title_family = isset($custom['added_product_price_font_family']) ? $custom['added_product_price_font_family'] : 'Helvetica';
                    $font_weights = majc_get_font_weight_choices($header_title_family);
                    if ($font_weights) {
                        ?>
                        <div class="majc-settings-input-field">
                            <select name="majc_settings[custom][added_product_price_font_style]" class="typography_font_style">
                                <?php foreach ($font_weights as $font_weight => $font_weight_label) { ?>
                                    <option value="<?php echo esc_attr($font_weight); ?>" <?php
                                    if (isset($custom['added_product_price_font_style'])) {
                                        selected($custom['added_product_price_font_style'], $font_weight);
                                    }
                                    ?>><?php echo esc_html($font_weight_label); ?></option>
                                        <?php } ?>
                            </select>
                        </div>
                    <?php } ?>
                </li>

                <li class="majc-settings-field typography-text-transform">
                    <label><?php esc_html_e('Text Transform', 'mini-ajax-cart'); ?></label>

                    <?php
                    if ($text_transforms) {
                        ?>
                        <div class="majc-settings-input-field">
                            <select name="majc_settings[custom][added_product_price_text_transform]" class="typography_text_transform">

                                <?php foreach ($text_transforms as $key => $value) { ?>

                                    <option value="<?php echo esc_attr($key) ?>" <?php
                                    if (isset($custom['added_product_price_text_transform'])) {
                                        selected($custom['added_product_price_text_transform'], $key);
                                    }
                                    ?>><?php echo esc_html($value); ?></option>

                                <?php } ?>
                            </select>
                        </div>
                    <?php } ?>
                </li>

                <li class="majc-settings-field typography-text-decoration">
                    <label><?php esc_html_e('Text Decoration', 'mini-ajax-cart'); ?></label>

                    <?php
                    if ($text_decorations) {
                        ?>
                        <div class="majc-settings-input-field">
                            <select name="majc_settings[custom][added_product_price_text_decoration]" class="typography_text_decoration">

                                <?php foreach ($text_decorations as $key => $value) { ?>

                                    <option value="<?php echo esc_attr($key) ?>" <?php
                                    if (isset($custom['added_product_price_text_decoration'])) {
                                        selected($custom['added_product_price_text_decoration'], $key);
                                    }
                                    ?>><?php echo esc_html($value); ?></option>

                                <?php } ?>
                            </select>
                        </div>
                    <?php } ?>
                </li>
            </ul>
        </div>

        <div class="majc-settings-field majc-typography-font-size">
            <label><?php esc_html_e('Font Size', 'mini-ajax-cart'); ?></label>

            <div class="majc-settings-input-field">
                <input min="0" max="60" type="number" value="<?php echo isset($custom['added_product_price_font_size']) ? intval($custom['added_product_price_font_size']) : null; ?>" name="majc_settings[custom][added_product_price_font_size]"/>
            </div>
        </div>


        <div class="majc-settings-field majc-typography-line-height">
            <label><?php esc_html_e('Line Height', 'mini-ajax-cart'); ?></label>

            <div class="majc-settings-input-field">
                <input class="range-input-selector" type="number" min="0" max="2" step="0.1" value="<?php echo isset($custom['added_product_price_line_height']) ? floatval($custom['added_product_price_line_height']) : null; ?>" name="majc_settings[custom][added_product_price_line_height]"/>
            </div>         
        </div>


        <div class="majc-settings-field majc-typography-letter-spacing">
            <label><?php esc_html_e('Letter Spacing', 'mini-ajax-cart'); ?></label>

            <div class="majc-settings-input-field">
                <input class="majc-range-input-selector" type="number" min="0" max="9" step="1" value="<?php echo isset($custom['added_product_price_letter_spacing']) ? esc_attr($custom['added_product_price_letter_spacing']) : null; ?>" name="majc_settings[custom][added_product_price_letter_spacing]"/>
            </div>           
        </div>

        <div class="majc-settings-field">
            <label><?php esc_html_e('Font Color', 'mini-ajax-cart'); ?></label>
            <div class="majc-settings-input-field">
                <input type="text" class="color-picker majc-color-picker" name="majc_settings[custom][added_product_price_font_color]" value="<?php echo isset($custom['added_product_price_font_color']) ? esc_attr($custom['added_product_price_font_color']) : null; ?>">
            </div>
        </div>


        <!-- ***************** -->
        <!-- ** Summary Price ** -->
        <!-- ***************** -->
        <div class="majc-float-menu-field majc-slider-summary-price-field">
            <h2><?php esc_html_e('Summary Price', 'mini-ajax-cart'); ?></h2>

            <ul class="majc-typography-fields">
                <li class="majc-settings-field typography-font-family">
                    <label><?php esc_html_e('Font Family', 'mini-ajax-cart'); ?></label>
                    <div class="majc-settings-input-field">
                        <select name="majc_settings[custom][summary_price_font_family]" class="typography_face">

                            <?php
                            if ($standard_fonts) {
                                ?>
                                <optgroup label="Standard Fonts">
                                    <?php foreach ($standard_fonts as $standard_font) { ?>
                                        <option value="<?php echo esc_attr($standard_font); ?>" <?php
                                        if (isset($custom['summary_price_font_family'])) {
                                            selected($custom['summary_price_font_family'], $standard_font);
                                        }
                                        ?>><?php echo esc_attr($standard_font); ?></option>
                                            <?php } ?>
                                </optgroup>
                            <?php } ?>

                            <?php
                            if ($google_fonts) {
                                ?>
                                <optgroup label="Google Fonts">
                                    <?php foreach ($google_fonts as $google_font) { ?>
                                        <option value="<?php echo esc_attr($google_font); ?>" <?php
                                        if (isset($custom['summary_price_font_family'])) {
                                            selected($custom['summary_price_font_family'], $google_font);
                                        }
                                        ?>><?php echo esc_attr($google_font); ?></option>
                                            <?php } ?>
                                </optgroup>
                            <?php } ?>

                        </select>
                    </div>
                </li>

                <li class="majc-settings-field typography-font-style">
                    <label><?php esc_html_e('Font Style', 'mini-ajax-cart'); ?></label>

                    <?php
                    $header_title_family = isset($custom['summary_price_font_family']) ? $custom['summary_price_font_family'] : 'Helvetica';
                    $font_weights = majc_get_font_weight_choices($header_title_family);
                    if ($font_weights) {
                        ?>
                        <div class="majc-settings-input-field">
                            <select name="majc_settings[custom][summary_price_font_style]" class="typography_font_style">
                                <?php foreach ($font_weights as $font_weight => $font_weight_label) { ?>
                                    <option value="<?php echo esc_attr($font_weight); ?>" <?php
                                    if (isset($custom['summary_price_font_style'])) {
                                        selected($custom['summary_price_font_style'], $font_weight);
                                    }
                                    ?>><?php echo esc_html($font_weight_label); ?></option>
                                        <?php } ?>
                            </select>
                        </div>
                    <?php } ?>
                </li>

                <li class="majc-settings-field typography-text-transform">
                    <label><?php esc_html_e('Text Transform', 'mini-ajax-cart'); ?></label>

                    <?php
                    if ($text_transforms) {
                        ?>
                        <div class="majc-settings-input-field">
                            <select name="majc_settings[custom][summary_price_text_transform]" class="typography_text_transform">

                                <?php foreach ($text_transforms as $key => $value) { ?>

                                    <option value="<?php echo esc_attr($key) ?>" <?php
                                    if (isset($custom['summary_price_text_transform'])) {
                                        selected($custom['summary_price_text_transform'], $key);
                                    }
                                    ?>><?php echo esc_html($value); ?></option>

                                <?php } ?>
                            </select>
                        </div>
                    <?php } ?>
                </li>

                <li class="majc-settings-field typography-text-decoration">
                    <label><?php esc_html_e('Text Decoration', 'mini-ajax-cart'); ?></label>

                    <?php
                    if ($text_decorations) {
                        ?>
                        <div class="majc-settings-input-field">
                            <select name="majc_settings[custom][summary_price_text_decoration]" class="typography_text_decoration">

                                <?php foreach ($text_decorations as $key => $value) { ?>

                                    <option value="<?php echo esc_attr($key) ?>" <?php
                                    if (isset($custom['summary_price_text_decoration'])) {
                                        selected($custom['summary_price_text_decoration'], $key);
                                    }
                                    ?>><?php echo esc_html($value); ?></option>

                                <?php } ?>
                            </select>
                        </div>
                    <?php } ?>
                </li>
            </ul>
        </div>

        <div class="majc-settings-field majc-typography-font-size">
            <label><?php esc_html_e('Font Size', 'mini-ajax-cart'); ?></label>

            <div class="majc-settings-input-field">
                <input min="0" max="60" type="number" value="<?php echo isset($custom['summary_price_font_size']) ? intval($custom['summary_price_font_size']) : null; ?>" name="majc_settings[custom][summary_price_font_size]"/>
            </div>
        </div>


        <div class="majc-settings-field majc-typography-line-height">
            <label><?php esc_html_e('Line Height', 'mini-ajax-cart'); ?></label>

            <div class="majc-settings-input-field">
                <input class="range-input-selector" type="number" min="0" max="2" step="0.1" value="<?php echo isset($custom['summary_price_line_height']) ? floatval($custom['summary_price_line_height']) : null; ?>" name="majc_settings[custom][summary_price_line_height]"/>
            </div>         
        </div>


        <div class="majc-settings-field majc-typography-letter-spacing">
            <label><?php esc_html_e('Letter Spacing', 'mini-ajax-cart'); ?></label>

            <div class="majc-settings-input-field">
                <input class="majc-range-input-selector" type="number" min="0" max="9" step="1" value="<?php echo isset($custom['summary_price_letter_spacing']) ? esc_attr($custom['summary_price_letter_spacing']) : null; ?>" name="majc_settings[custom][summary_price_letter_spacing]"/>
            </div>           
        </div>

        <div class="majc-settings-field">
            <label><?php esc_html_e('Font Color', 'mini-ajax-cart'); ?></label>
            <div class="majc-settings-input-field">
                <input type="text" class="color-picker majc-color-picker" name="majc_settings[custom][summary_price_font_color]" value="<?php echo isset($custom['summary_price_font_color']) ? esc_attr($custom['summary_price_font_color']) : null; ?>">
            </div>
        </div>


        <!-- ***************** -->
        <!-- ** Remove Product Button ** -->
        <!-- ***************** -->
        <h2><?php esc_html_e('Remove Product Button', 'mini-ajax-cart'); ?></h2>

        <div class="majc-settings-field">
            <label><?php esc_html_e('Background Color', 'mini-ajax-cart'); ?></label>
            <div class="majc-settings-input-field">
                <input type="text" class="color-picker majc-color-picker" name="majc_settings[custom][remove_product_btn_bg_color]" value="<?php echo isset($custom['remove_product_btn_bg_color']) ? esc_attr($custom['remove_product_btn_bg_color']) : null; ?>">
            </div>
        </div>

        <div class="majc-settings-field">
            <label><?php esc_html_e('Font Color', 'mini-ajax-cart'); ?></label>
            <div class="majc-settings-input-field">
                <input type="text" class="color-picker majc-color-picker" name="majc_settings[custom][remove_product_btn_font_color]" value="<?php echo isset($custom['remove_product_btn_font_color']) ? esc_attr($custom['remove_product_btn_font_color']) : null; ?>">
            </div>
        </div>

        <!-- ***************** -->
        <!-- ** Header Item Count Typography ** -->
        <!-- ***************** -->
        <div class="majc-float-menu-field majc-header-item-count-typography-field">
            <h2><?php esc_html_e('Header Item Count', 'mini-ajax-cart'); ?></h2>

            <ul class="majc-typography-fields">
                <li class="majc-settings-field typography-font-family">
                    <label><?php esc_html_e('Font Family', 'mini-ajax-cart'); ?></label>
                    <div class="majc-settings-input-field">
                        <select name="majc_settings[custom][header_item_count_font_family]" class="typography_face">

                            <?php
                            if ($standard_fonts) {
                                ?>
                                <optgroup label="Standard Fonts">
                                    <?php foreach ($standard_fonts as $standard_font) { ?>
                                        <option value="<?php echo esc_attr($standard_font); ?>" <?php
                                        if (isset($custom['header_item_count_font_family'])) {
                                            selected($custom['header_item_count_font_family'], $standard_font);
                                        }
                                        ?>><?php echo esc_attr($standard_font); ?></option>
                                            <?php } ?>
                                </optgroup>
                            <?php } ?>

                            <?php
                            if ($google_fonts) {
                                ?>
                                <optgroup label="Google Fonts">
                                    <?php foreach ($google_fonts as $google_font) { ?>
                                        <option value="<?php echo esc_attr($google_font); ?>" <?php
                                        if (isset($custom['header_item_count_font_family'])) {
                                            selected($custom['header_item_count_font_family'], $google_font);
                                        }
                                        ?>><?php echo esc_attr($google_font); ?></option>
                                            <?php } ?>
                                </optgroup>
                            <?php } ?>

                        </select>
                    </div>
                </li>

                <li class="majc-settings-field typography-font-style">
                    <label><?php esc_html_e('Font Style', 'mini-ajax-cart'); ?></label>

                    <?php
                    $header_title_family = isset($custom['header_item_count_font_family']) ? $custom['header_item_count_font_family'] : 'Helvetica';
                    $font_weights = majc_get_font_weight_choices($header_title_family);
                    if ($font_weights) {
                        ?>
                        <div class="majc-settings-input-field">
                            <select name="majc_settings[custom][header_item_count_font_style]" class="typography_font_style">
                                <?php foreach ($font_weights as $font_weight => $font_weight_label) { ?>
                                    <option value="<?php echo esc_attr($font_weight); ?>" <?php
                                    if (isset($custom['header_item_count_font_style'])) {
                                        selected($custom['header_item_count_font_style'], $font_weight);
                                    }
                                    ?>><?php echo esc_html($font_weight_label); ?></option>
                                        <?php } ?>
                            </select>
                        </div>
                    <?php } ?>
                </li>

                <li class="majc-settings-field typography-text-transform">
                    <label><?php esc_html_e('Text Transform', 'mini-ajax-cart'); ?></label>

                    <?php
                    if ($text_transforms) {
                        ?>
                        <div class="majc-settings-input-field">
                            <select name="majc_settings[custom][header_item_count_text_transform]" class="typography_text_transform">

                                <?php foreach ($text_transforms as $key => $value) { ?>

                                    <option value="<?php echo esc_attr($key) ?>" <?php
                                    if (isset($custom['header_item_count_text_transform'])) {
                                        selected($custom['header_item_count_text_transform'], $key);
                                    }
                                    ?>><?php echo esc_html($value); ?></option>

                                <?php } ?>
                            </select>
                        </div>
                    <?php } ?>
                </li>

                <li class="majc-settings-field typography-text-decoration">
                    <label><?php esc_html_e('Text Decoration', 'mini-ajax-cart'); ?></label>

                    <?php
                    if ($text_decorations) {
                        ?>
                        <div class="majc-settings-input-field">
                            <select name="majc_settings[custom][header_item_count_text_decoration]" class="typography_text_decoration">

                                <?php foreach ($text_decorations as $key => $value) { ?>

                                    <option value="<?php echo esc_attr($key) ?>" <?php
                                    if (isset($custom['header_item_count_text_decoration'])) {
                                        selected($custom['header_item_count_text_decoration'], $key);
                                    }
                                    ?>><?php echo esc_html($value); ?></option>

                                <?php } ?>
                            </select>
                        </div>
                    <?php } ?>
                </li>
            </ul>
        </div>

        <div class="majc-settings-field majc-typography-font-size">
            <label><?php esc_html_e('Font Size', 'mini-ajax-cart'); ?></label>

            <div class="majc-settings-input-field">
                <input min="0" max="60" type="number" value="<?php echo isset($custom['header_item_count_font_size']) ? intval($custom['header_item_count_font_size']) : null; ?>" name="majc_settings[custom][header_item_count_font_size]"/>
            </div>
        </div>


        <div class="majc-settings-field majc-typography-line-height">
            <label><?php esc_html_e('Line Height', 'mini-ajax-cart'); ?></label>

            <div class="majc-settings-input-field">
                <input class="range-input-selector" type="number" min="0" max="2" step="0.1" value="<?php echo isset($custom['header_item_count_line_height']) ? floatval($custom['header_item_count_line_height']) : null; ?>" name="majc_settings[custom][header_item_count_line_height]"/>
            </div>         
        </div>


        <div class="majc-settings-field majc-typography-letter-spacing">
            <label><?php esc_html_e('Letter Spacing', 'mini-ajax-cart'); ?></label>

            <div class="majc-settings-input-field">
                <input class="majc-range-input-selector" type="number" min="0" max="9" step="1" value="<?php echo isset($custom['header_item_count_letter_spacing']) ? esc_attr($custom['header_item_count_letter_spacing']) : null; ?>" name="majc_settings[custom][header_item_count_letter_spacing]"/>
            </div>           
        </div>

        <div class="majc-settings-field">
            <label><?php esc_html_e('Font Color', 'mini-ajax-cart'); ?></label>
            <div class="majc-settings-input-field">
                <input type="text" class="color-picker majc-color-picker" name="majc_settings[custom][header_item_count_font_color]" value="<?php echo isset($custom['header_item_count_font_color']) ? esc_attr($custom['header_item_count_font_color']) : null; ?>">
            </div>
        </div>


        <!-- ***************** -->
        <!-- ** Extras ** -->
        <!-- ***************** -->
        <h2><?php esc_html_e('Extra Custom Settings', 'mini-ajax-cart'); ?></h2>

        <div class="majc-settings-field">
            <label><?php esc_html_e('Close Icon Color', 'mini-ajax-cart'); ?></label>
            <div class="majc-settings-input-field">
                <input type="text" class="color-picker majc-color-picker" name="majc_settings[custom][close_icon_color]" value="<?php echo isset($custom['close_icon_color']) ? esc_attr($custom['close_icon_color']) : null; ?>">
            </div>
        </div>

        <div class="majc-settings-field">
            <label><?php esc_html_e('Default Border Color', 'mini-ajax-cart'); ?></label>
            <div class="majc-settings-input-field">
                <input type="text" class="color-picker majc-color-picker" name="majc_settings[custom][default_border_color]" value="<?php echo isset($custom['default_border_color']) ? esc_attr($custom['default_border_color']) : null; ?>">
            </div>
        </div>

        <div class="majc-settings-field">
            <label><?php esc_html_e('Quantity Change Button Background Color', 'mini-ajax-cart'); ?></label>
            <div class="majc-settings-input-field">
                <input type="text" class="color-picker majc-color-picker" name="majc_settings[custom][qty_change_btn_bg_color]" value="<?php echo isset($custom['qty_change_btn_bg_color']) ? esc_attr($custom['qty_change_btn_bg_color']) : null; ?>">
            </div>
        </div>

        <div class="majc-settings-field">
            <label><?php esc_html_e('Quantity Change Icon Color', 'mini-ajax-cart'); ?></label>
            <div class="majc-settings-input-field">
                <input type="text" class="color-picker majc-color-picker" name="majc_settings[custom][qty_change_icon_color]" value="<?php echo isset($custom['qty_change_icon_color']) ? esc_attr($custom['qty_change_icon_color']) : null; ?>">
            </div>
        </div>
    </div> <!-- majc-custom-fields -->
</div>