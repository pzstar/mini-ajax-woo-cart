<?php
$display = isset($majc_settings['display']) ? $majc_settings['display'] : null;
$header = isset($majc_settings['header']) ? $majc_settings['header'] : null;
$buttons = isset($majc_settings['buttons']) ? $majc_settings['buttons'] : null;
$coupon = isset($majc_settings['coupon']) ? $majc_settings['coupon'] : null;
$summary = isset($majc_settings['summary']) ? $majc_settings['summary'] : null;
$cart_basket = isset($majc_settings['cart_basket']) ? $majc_settings['cart_basket'] : null;
$animations = $this->majc_animations();
?>

<div id="layout-settings" class="tab-content">
    <div class="majc-settings-field-wrap">
        <div class="majc-settings-field">
            <label><?php esc_html_e('Enable Mini Ajax Cart', 'mini-ajax-cart'); ?></label>
            <div class="majc-settings-input-field  majc-toggle-input-field">
                <input type="checkbox" name="majc_settings[display][enable_flying_cart]" <?php
                if (isset($display['enable_flying_cart'])) {
                    checked($display['enable_flying_cart'], 'on', true);
                }
                ?>>
                <p class="majc-desc"><?php esc_html_e('Display Ajax Cart?', 'mini-ajax-cart'); ?></p>
            </div>
        </div>
        <h2><?php esc_html_e('Cart Basket/Button Settings', 'mini-ajax-cart'); ?></h2>
        <div class="majc-settings-field">
            <label><?php esc_html_e('Open Icon Type', 'mini-ajax-cart'); ?></label>
            <div class="majc-settings-input-field">
                <select name="majc_settings[cart_basket][open_icon_type]" data-condition="toggle" id="majc-open-icon-type">
                    <option value="default_icon" <?php
                    if (isset($cart_basket['open_icon_type'])) {
                        selected($cart_basket['open_icon_type'], 'default_icon');
                    }
                    ?>><?php esc_html_e('Default Icon', 'mini-ajax-cart'); ?></option>
                    <option value="available_icon" <?php
                    if (isset($cart_basket['open_icon_type'])) {
                        selected($cart_basket['open_icon_type'], 'available_icon');
                    }
                    ?>><?php esc_html_e('Available Icon', 'mini-ajax-cart'); ?></option>
                    <option value="custom_icon" <?php
                    if (isset($cart_basket['open_icon_type'])) {
                        selected($cart_basket['open_icon_type'], 'custom_icon');
                    }
                    ?>><?php esc_html_e('Custom Icon', 'mini-ajax-cart'); ?></option>
                </select>
            </div>
        </div>

        <div class="majc-settings-field majc-icon-open-option-field majc-available_icon" data-condition-toggle="majc-open-icon-type" data-condition-val="available_icon">
            <label for="majc_floatmenu_default_icon"><?php esc_html_e('Choose Open Icon', 'mini-ajax-cart'); ?></label>
            <div class="majc-settings-input-field">
                <?php
                $inputName = 'majc_settings[cart_basket][open_available_icon]';
                $iconName = isset($cart_basket['open_available_icon']) ? $cart_basket['open_available_icon'] : null; //icon value from db
                $this->icon_field($inputName, $iconName);
                ?>
            </div>
        </div>

        <div class="majc-settings-field majc-icon-open-option-field majc-custom_icon" data-condition-toggle="majc-open-icon-type" data-condition-val="custom_icon">
            <label for="majc-header-icon"><?php esc_html_e('Upload Open Icon', 'mini-ajax-cart'); ?></label>
            <div class="majc-settings-input-field">
                <div class="majc-icon-image-uploader">
                    <div class="majc-custom-img-icon-btn">
                        <div class="majc-custom-menu-image-icon current-bg-image" >
                            <?php if (isset($cart_basket['open_custom_icon']) && !empty($cart_basket['open_custom_icon'])) { ?>
                                <img src="<?php echo isset($cart_basket['open_custom_icon']) ? esc_url($cart_basket['open_custom_icon']) : ''; ?>"/>
                            <?php } ?>
                        </div>
                        <div class="majc-image-remove"><?php esc_html_e('Remove', 'mini-ajax-cart'); ?></div>
                    </div>

                    <div class="button majc-image-upload"><?php esc_html_e('Upload', 'mini-ajax-cart') ?></div>
                    <input type="hidden" class="majc-upload-background-url" name="majc_settings[cart_basket][open_custom_icon]" id="majc-header-icon" value="<?php echo isset($cart_basket['open_custom_icon']) ? esc_url($cart_basket['open_custom_icon']) : ''; ?>"/>
                </div> <!-- majc-icon-image-uploader -->
            </div>
        </div>

        <div class="majc-settings-field">
            <label><?php esc_html_e('Close Icon Type', 'mini-ajax-cart'); ?></label>
            <div class="majc-settings-input-field">
                <select name="majc_settings[cart_basket][close_icon_type]" data-condition="toggle" id="majc-close-icon-type">
                    <option value="default_icon" <?php
                    if (isset($cart_basket['close_icon_type'])) {
                        selected($cart_basket['close_icon_type'], 'default_icon');
                    }
                    ?>><?php esc_html_e('Default Icon', 'mini-ajax-cart'); ?></option>
                    <option value="available_icon" <?php
                    if (isset($cart_basket['close_icon_type'])) {
                        selected($cart_basket['close_icon_type'], 'available_icon');
                    }
                    ?>><?php esc_html_e('Available Icon', 'mini-ajax-cart'); ?></option>
                    <option value="custom_icon" <?php
                    if (isset($cart_basket['close_icon_type'])) {
                        selected($cart_basket['close_icon_type'], 'custom_icon');
                    }
                    ?>><?php esc_html_e('Custom Icon', 'mini-ajax-cart'); ?></option>
                </select>
            </div>
        </div>

        <div class="majc-settings-field majc-icon-close-option-field majc-available_icon" data-condition-toggle="majc-close-icon-type" data-condition-val="available_icon">
            <label for="majc_floatmenu_default_icon"><?php esc_html_e('Choose Close Icon', 'mini-ajax-cart'); ?></label>
            <div class="majc-settings-input-field">
                <?php
                $inputName = 'majc_settings[cart_basket][close_available_icon]';
                $iconName = isset($cart_basket['close_available_icon']) ? $cart_basket['close_available_icon'] : null; //icon value from db
                $this->icon_field($inputName, $iconName);
                ?>
            </div>
        </div>

        <div class="majc-settings-field majc-icon-close-option-field majc-custom_icon" data-condition-toggle="majc-close-icon-type" data-condition-val="custom_icon">
            <label for="majc-header-icon"><?php esc_html_e('Upload Close Icon', 'mini-ajax-cart'); ?></label>
            <div class="majc-settings-input-field">
                <div class="majc-icon-image-uploader">
                    <div class="majc-custom-img-icon-btn">
                        <div class="majc-custom-menu-image-icon current-bg-image" >
                            <?php if (isset($cart_basket['close_custom_icon']) && !empty($cart_basket['close_custom_icon'])) { ?>
                                <img src="<?php echo isset($cart_basket['close_custom_icon']) ? esc_url($cart_basket['close_custom_icon']) : ''; ?>"/>
                            <?php } ?>
                        </div>
                        <div class="majc-image-remove"><?php esc_html_e('Remove', 'mini-ajax-cart'); ?></div>
                    </div>
                    <div class="button majc-image-upload"><?php esc_html_e('Upload', 'mini-ajax-cart') ?></div>
                    <input type="hidden" class="majc-upload-background-url" name="majc_settings[cart_basket][close_custom_icon]" id="majc-header-icon" value="<?php echo isset($cart_basket['close_custom_icon']) ? esc_url($cart_basket['close_custom_icon']) : ''; ?>"/>
                </div> <!-- majc-icon-image-uploader -->
            </div>
        </div>

        <div class="majc-settings-field">
            <label><?php esc_html_e('Button Shape', 'mini-ajax-cart'); ?></label>
            <div class="majc-settings-input-field">
                <select name="majc_settings[cart_basket][shape]">
                    <option value="round" <?php
                    if (isset($cart_basket['shape'])) {
                        selected($cart_basket['shape'], 'round');
                    }
                    ?>><?php esc_html_e('Round', 'mini-ajax-cart'); ?></option>
                    <option value="square" <?php
                    if (isset($cart_basket['shape'])) {
                        selected($cart_basket['shape'], 'square');
                    }
                    ?>><?php esc_html_e('Square', 'mini-ajax-cart'); ?></option>
                    <option value="rounded_square" <?php
                    if (isset($cart_basket['shape'])) {
                        selected($cart_basket['shape'], 'rounded_square');
                    }
                    ?>><?php esc_html_e('Rounded Square', 'mini-ajax-cart'); ?></option>
                </select>
            </div>
        </div>

        <div class="majc-settings-field">
            <label><?php esc_html_e('Button Position', 'mini-ajax-cart'); ?></label>
            <div class="majc-settings-input-field">
                <select name="majc_settings[basket_position]">
                    <option value="left-middle" <?php
                    if (isset($majc_settings['basket_position'])) {
                        selected($majc_settings['basket_position'], 'left-middle');
                    }
                    ?>><?php esc_html_e('Left Middle', 'mini-ajax-cart'); ?></option>
                    <option value="right-middle" <?php
                    if (isset($majc_settings['basket_position'])) {
                        selected($majc_settings['basket_position'], 'right-middle');
                    }
                    ?>><?php esc_html_e('Right Middle', 'mini-ajax-cart'); ?></option>
                    <option disabled value="" <?php
                    if (isset($majc_settings['basket_position'])) {
                        selected($majc_settings['basket_position'], 'left-top');
                    }
                    ?>><?php esc_html_e('Left Top (Pro)', 'mini-ajax-cart'); ?></option>
                    <option disabled value="" <?php
                    if (isset($majc_settings['basket_position'])) {
                        selected($majc_settings['basket_position'], 'left-bottom');
                    }
                    ?>><?php esc_html_e('Left Bottom (Pro)', 'mini-ajax-cart'); ?></option>
                    <option disabled value="" <?php
                    if (isset($majc_settings['basket_position'])) {
                        selected($majc_settings['basket_position'], 'right-top');
                    }
                    ?>><?php esc_html_e('Right Top (Pro)', 'mini-ajax-cart'); ?></option>
                    <option disabled value="" <?php
                    if (isset($majc_settings['basket_position'])) {
                        selected($majc_settings['basket_position'], 'right-bottom');
                    }
                    ?>><?php esc_html_e('Right Bottom (Pro)', 'mini-ajax-cart'); ?></option>
                    <option disabled value="" <?php
                    if (isset($majc_settings['basket_position'])) {
                        selected($majc_settings['basket_position'], 'center-bottom');
                    }
                    ?>><?php esc_html_e('Center Bottom (Pro)', 'mini-ajax-cart'); ?></option>
                </select>
            </div>
        </div>

        <div class="majc-settings-field">
            <label><?php esc_attr_e('Hover Animation', 'mini-ajax-cart') ?></label>
            <div class="majc-settings-input-field">
                <select name="majc_settings[cart_basket][hover_animation]">
                    <option value="none"><?php esc_html_e('None', 'mini-ajax-cart'); ?></option>
                    <?php foreach ($animations['hover_animation'] as $type => $type_array): ?>
                        <optgroup label="<?php echo esc_attr($type) ?>">
                            <?php foreach ($type_array as $key => $value): ?>
                                <option value="<?php echo esc_attr($value) ?>" <?php
                                if (isset($majc_settings['cart_basket']['hover_animation'])) {
                                    selected($majc_settings['cart_basket']['hover_animation'], $value);
                                }
                                ?>><?php echo esc_attr($key) ?></option>
                                    <?php endforeach ?>
                        </optgroup>
                    <?php endforeach ?>
                </select>
            </div>
        </div>

        <div class="majc-settings-field">
            <label><?php esc_html_e('Show Product Count', 'mini-ajax-cart'); ?></label>
            <div class="majc-settings-input-field majc-toggle-input-field">
                <input type="checkbox" name="majc_settings[cart_basket][product_count]" <?php
                if (isset($cart_basket['product_count'])) {
                    checked($cart_basket['product_count'], 'on', true);
                }
                ?>>
            </div>
        </div>
    </div>

    <h2><?php esc_html_e('Cart Content Settings', 'mini-ajax-cart'); ?></h2>

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

    <h2><?php esc_html_e('Header Section', 'mini-ajax-cart'); ?></h2>

    <div class="majc-settings-field">
        <label><?php esc_html_e('Header Title Text', 'mini-ajax-cart'); ?></label>
        <div class="majc-settings-input-field">
            <input type="text" name="majc_settings[header][title_text]" value="<?php echo isset($header['title_text']) ? esc_attr($header['title_text']) : null; ?>">
        </div>	
    </div>	

    <div class="majc-settings-field">
        <label><?php esc_html_e('Header Icon Type', 'mini-ajax-cart'); ?></label>
        <div class="majc-settings-input-field">
            <select name="majc_settings[header][icon_type]" data-condition="toggle" id="majc-header-icon-type">
                <option value="none" <?php
                if (isset($header['icon_type'])) {
                    selected($header['icon_type'], 'none');
                }
                ?>><?php esc_html_e('None', 'mini-ajax-cart'); ?></option>
                <option value="default_icon" <?php
                if (isset($header['icon_type'])) {
                    selected($header['icon_type'], 'default_icon');
                }
                ?>><?php esc_html_e('Default Icon', 'mini-ajax-cart'); ?></option>
                <option value="available_icon" <?php
                if (isset($header['icon_type'])) {
                    selected($header['icon_type'], 'available_icon');
                }
                ?>><?php esc_html_e('Available Icon', 'mini-ajax-cart'); ?></option>
                <option value="custom_icon" <?php
                if (isset($header['icon_type'])) {
                    selected($header['icon_type'], 'custom_icon');
                }
                ?>><?php esc_html_e('Custom Icon', 'mini-ajax-cart'); ?></option>
            </select>
        </div>
    </div>

    <div class="majc-settings-field majc-icon-option-field majc-available_icon" data-condition-toggle="majc-header-icon-type" data-condition-val="available_icon">
        <label for="majc_floatmenu_default_icon"><?php esc_html_e('Default menu icon', 'mini-ajax-cart'); ?></label>
        <div class="majc-settings-input-field">
            <?php
            $inputName = 'majc_settings[header][available_icon]';
            $iconName = isset($header['available_icon']) ? $header['available_icon'] : null; //icon value from db
            $this->icon_field($inputName, $iconName);
            ?>
        </div>
    </div>

    <div class="majc-settings-field majc-icon-option-field majc-custom_icon" data-condition-toggle="majc-header-icon-type" data-condition-val="custom_icon">
        <label for="majc-header-icon"><?php esc_html_e('Upload Custom Icon', 'mini-ajax-cart'); ?></label>
        <div class="majc-settings-input-field">
            <div class="majc-icon-image-uploader">
                <div class="majc-custom-img-icon-btn">
                    <div class="majc-custom-menu-image-icon current-bg-image" >
                        <?php if (isset($header['custom_icon']) && !empty($header['custom_icon'])) { ?>
                            <img src="<?php echo isset($header['custom_icon']) ? esc_url($header['custom_icon']) : ''; ?>"/>
                        <?php } ?>
                    </div>
                    <div class="majc-image-remove"><?php esc_html_e('Remove', 'mini-ajax-cart'); ?></div>
                </div>

                <div class="button majc-image-upload"><?php esc_html_e('Upload', 'mini-ajax-cart') ?></div>
                <input type="hidden" class="majc-upload-background-url" name="majc_settings[header][custom_icon]" id="majc-header-icon" value="<?php echo isset($header['custom_icon']) ? esc_url($header['custom_icon']) : ''; ?>"/>
            </div> <!-- majc-icon-image-uploader -->
        </div>
    </div>

    <div class="majc-settings-field">
        <label><?php esc_html_e('Show Cart Quantity & Items', 'mini-ajax-cart'); ?></label>
        <div class="majc-settings-input-field majc-toggle-input-field">
            <input type="checkbox" name="majc_settings[header][show_cart_item_count]" <?php
            if (isset($header['show_cart_item_count'])) {
                checked($header['show_cart_item_count'], 'on', true);
            }
            ?>>
        </div>
    </div>

    <h2><?php esc_html_e('Footer Section', 'mini-ajax-cart'); ?></h2>

    <div class="majc-settings-field">
        <label><?php esc_html_e('Enable Coupon Field', 'mini-ajax-cart'); ?></label>

        <div class="majc-settings-input-field majc-toggle-input-field">
            <input type="checkbox" name="majc_settings[coupon][enable]" <?php
            if (isset($coupon['enable'])) {
                checked($coupon['enable'], 'on', true);
            }
            ?> data-condition="toggle" id="majc-enable-coupon">
        </div>
    </div>

    <div class="majc-settings-field" data-condition-toggle="majc-enable-coupon">
        <label><?php esc_html_e('Apply Coupon Button Label', 'mini-ajax-cart'); ?></label>

        <div class="majc-settings-input-field">
            <input type="text" name="majc_settings[coupon][button_text]" value="<?php echo isset($coupon['button_text']) ? esc_html($coupon['button_text']) : null; ?>">
        </div>
    </div>

    <div class="majc-settings-field" data-condition-toggle="majc-enable-coupon">
        <label><?php esc_html_e('Promo Code Placeholder', 'mini-ajax-cart'); ?></label>

        <div class="majc-settings-input-field">
            <input type="text" name="majc_settings[coupon][promocode_placeholder]" value="<?php echo isset($coupon['promocode_placeholder']) ? esc_html($coupon['promocode_placeholder']) : null; ?>">
        </div>
    </div>

    <div class="majc-settings-field">
        <label><?php esc_html_e('Show View Cart Button', 'mini-ajax-cart'); ?></label>
        <div class="majc-settings-input-field majc-toggle-input-field">
            <input type="checkbox" name="majc_settings[buttons][show_view_cart]" <?php
            if (isset($buttons['show_view_cart'])) {
                checked($buttons['show_view_cart'], 'on', true);
            }
            ?> data-condition="toggle" id="majc-show-cart-button">
        </div>
    </div>

    <div class="majc-settings-field" data-condition-toggle="majc-show-cart-button">
        <label><?php esc_html_e('View Cart Label', 'mini-ajax-cart'); ?></label>
        <div class="majc-settings-input-field">
            <input type="text" name="majc_settings[buttons][view_cart_label]" value="<?php echo isset($buttons['view_cart_label']) ? esc_html($buttons['view_cart_label']) : esc_html__('View Cart', 'mini-ajax-cart'); ?>">
        </div>
    </div>

    <div class="majc-settings-field">
        <label><?php esc_html_e('Show Checkout Button', 'mini-ajax-cart'); ?></label>
        <div class="majc-settings-input-field majc-toggle-input-field">
            <input type="checkbox" name="majc_settings[buttons][show_checkout]" <?php
            if (isset($buttons['show_checkout'])) {
                checked($buttons['show_checkout'], 'on', true);
            }
            ?> data-condition="toggle" id="majc-show-checkout-button">
        </div>
    </div>

    <div class="majc-settings-field" data-condition-toggle="majc-show-checkout-button">
        <label><?php esc_html_e('View Checkout Label', 'mini-ajax-cart'); ?></label>
        <div class="majc-settings-input-field">
            <input type="text" name="majc_settings[buttons][checkout_label]" value="<?php echo isset($buttons['checkout_label']) ? esc_html($buttons['checkout_label']) : esc_html__('View Checkout', 'mini-ajax-cart'); ?>">
        </div>
    </div>

    <div class="majc-settings-field">
        <label><?php esc_html_e('Show Continue Shopping Button', 'mini-ajax-cart'); ?></label>
        <div class="majc-settings-input-field majc-toggle-input-field">
            <input type="checkbox" name="majc_settings[buttons][show_continue_shopping]" <?php
            if (isset($buttons['show_continue_shopping'])) {
                checked($buttons['show_continue_shopping'], 'on', true);
            }
            ?> data-condition="toggle" id="majc-show-shopping-button">
        </div>
    </div>

    <div class="majc-settings-field" data-condition-toggle="majc-show-shopping-button">
        <label><?php esc_html_e('View Continue Shopping Label', 'mini-ajax-cart'); ?></label>
        <div class="majc-settings-input-field">
            <input type="text" name="majc_settings[buttons][continue_shopping_label]" value="<?php echo isset($buttons['continue_shopping_label']) ? esc_html($buttons['continue_shopping_label']) : esc_html__('Continue Shopping', 'mini-ajax-cart'); ?>">
        </div>
    </div>

    <div class="majc-settings-field" data-condition-toggle="majc-show-shopping-button">
        <label><?php esc_html_e('Continue Shopping Link', 'mini-ajax-cart'); ?></label>
        <div class="majc-settings-input-field">
            <input type="url" name="majc_settings[buttons][continue_shopping_link]" value="<?php echo isset($buttons['continue_shopping_link']) ? esc_url($buttons['continue_shopping_link']) : ""; ?>">
        </div>
    </div>

    <div class="majc-settings-field">
        <label><?php esc_html_e('Shipping Text Label', 'mini-ajax-cart'); ?></label>
        <div class="majc-settings-input-field">
            <input type="text" name="majc_settings[buttons][shipping_text]" value="<?php echo isset($buttons['shipping_text']) ? esc_html($buttons['shipping_text']) : null; ?>">
            <p class="majc-desc"><?php esc_html_e('It will appear just above buttons.', 'mini-ajax-cart'); ?></p>
        </div>
    </div>

    <div class="majc-settings-field">
        <label><?php esc_html_e('Hide Cart Total', 'mini-ajax-cart'); ?></label>
        <div class="majc-settings-input-field majc-toggle-input-field">
            <input type="checkbox" name="majc_settings[summary][hide_cart_total]" <?php
            if (isset($summary['hide_cart_total'])) {
                checked($summary['hide_cart_total'], 'on', true);
            }
            ?>>
        </div>
    </div>

    <div class="majc-settings-field">
        <label><?php esc_html_e('Hide Discount', 'mini-ajax-cart'); ?></label>
        <div class="majc-settings-input-field majc-toggle-input-field">
            <input type="checkbox" name="majc_settings[summary][hide_discount]" <?php
            if (isset($summary['hide_discount'])) {
                checked($summary['hide_discount'], 'on', true);
            }
            ?>>
        </div>
    </div>

    <div class="majc-settings-field">
        <label><?php esc_html_e('Hide Subtotal', 'mini-ajax-cart'); ?></label>
        <div class="majc-settings-input-field majc-toggle-input-field">
            <input type="checkbox" name="majc_settings[summary][hide_subtotal]" <?php
            if (isset($summary['hide_subtotal'])) {
                checked($summary['hide_subtotal'], 'on', true);
            }
            ?>>
        </div>
    </div>
</div>