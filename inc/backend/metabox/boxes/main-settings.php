<?php
$header = isset($majc_settings['header']) ? $majc_settings['header'] : null;
$buttons = isset($majc_settings['buttons']) ? $majc_settings['buttons'] : null;
$coupon = isset($majc_settings['coupon']) ? $majc_settings['coupon'] : null;
$summary = isset($majc_settings['summary']) ? $majc_settings['summary'] : null;
$cart_basket = isset($majc_settings['cart_basket']) ? $majc_settings['cart_basket'] : null;
$slider = isset($majc_settings['slider']) ? $majc_settings['slider'] : null;
$animations = $this->majc_animations();
?>

<div id="layout-settings" class="tab-content">
    <h2><?php esc_html_e('Main Settings', 'mini-ajax-cart'); ?></h2>

    <div class="majc-settings-field">
        <label><?php esc_attr_e('Show Animation', 'mini-ajax-cart') ?></label>
        <div class="majc-settings-input-field">
            <select name="majc_settings[show_animation]">
                <option value="none"><?php esc_html_e('None', 'mini-ajax-cart'); ?></option>
                <?php foreach ($animations['show_animation'] as $key => $key_array): ?>
                    <optgroup label="<?php echo esc_attr($key) ?>"></optgroup>
                    <?php foreach ($key_array as $value): ?>
                        <option value="<?php echo esc_attr($value) ?>" <?php
                        if (isset($majc_settings['show_animation'])) {
                            selected($majc_settings['show_animation'], $value);
                        }
                        ?>><?php echo esc_attr($value) ?></option>
                            <?php endforeach ?>
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
                    <optgroup label="<?php echo esc_attr($key) ?>"></optgroup>
                    <?php foreach ($key_array as $value): ?>
                        <option value="<?php echo esc_attr($value) ?>" <?php
                        if (isset($majc_settings['hide_animation'])) {
                            selected($majc_settings['hide_animation'], $value);
                        }
                        ?>><?php echo esc_attr($value) ?></option>
                            <?php endforeach ?>
                        <?php endforeach ?>
            </select>
        </div>
    </div>

    <div class="majc-settings-field">
        <label><?php esc_html_e('Layout Type', 'mini-ajax-cart'); ?></label>
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
                ?>><?php esc_html_e('Floating', 'mini-ajax-cart'); ?></option>
                <option disabled value="popup" <?php
                if (isset($majc_settings['layout_type'])) {
                    selected($majc_settings['layout_type'], 'popup');
                }
                ?>><?php esc_html_e('Popup', 'mini-ajax-cart'); ?></option>
            </select>
        </div>
    </div>

    <div class="majc-settings-field">
        <label><?php esc_html_e('Enable Ajax Add To Cart', 'mini-ajax-cart'); ?></label>
        <div class="majc-settings-input-field">
            <input type="checkbox" name="majc_settings[enable_ajax_atc]" <?php
            if (isset($majc_settings['enable_ajax_atc'])) {
                checked($majc_settings['enable_ajax_atc'], 'on', true);
            }
            ?>>
        </div>
    </div>

    <div class="majc-settings-field">
        <label><?php esc_html_e('Cart Basket Position', 'mini-ajax-cart'); ?></label>
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
            </select>
        </div>
    </div>

    <div class="majc-settings-field">
        <label><?php esc_html_e('Cart Item Layout', 'mini-ajax-cart'); ?></label>
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
            <input type="number" name="majc_settings[content_width]" value="<?php echo isset($majc_settings['content_width']) ? intval($majc_settings['content_width']) : null; ?>">
        </div>	
    </div>	

    <div class="majc-settings-field">
        <label><?php esc_html_e('Enable Overlay', 'mini-ajax-cart'); ?></label>
        <div class="majc-settings-input-field">
            <input type="checkbox" name="majc_settings[enable_overlay]" <?php
            if (isset($majc_settings['enable_overlay'])) {
                checked($majc_settings['enable_overlay'], 'on', true);
            }
            ?>>
        </div>
    </div>

    <div class="majc-settings-field-wrap majc-settings-content">
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
                <select name="majc_settings[header][icon_type]" onchange="hideShow(this)" target="majc-icon-option-field">
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

        <div class="majc-settings-field majc-icon-option-field majc-available_icon" style="<?php echo isset($header['icon_type']) && $header['icon_type'] == 'available_icon' ? 'display: flex;' : 'display: none;'; ?>">
            <label for="majc_floatmenu_default_icon"><?php esc_html_e('Default menu icon', 'mini-ajax-cart'); ?></label>
            <div class="majc-settings-input-field">
                <?php
                $inputName = 'majc_settings[header][available_icon]';
                $iconName = isset($header['available_icon']) ? $header['available_icon'] : null; //icon value from db
                $this->icon_field($inputName, $iconName);
                ?>
            </div>
        </div>

        <div class="majc-settings-field majc-icon-option-field majc-custom_icon" style="<?php echo isset($header['icon_type']) && $header['icon_type'] == 'custom_icon' ? 'display: flex;' : 'display: none;'; ?>">
            <label for="majc-header-icon"><?php esc_html_e('Upload Custom Icon', 'mini-ajax-cart'); ?></label>
            <div class="majc-settings-input-field">
                <div class="majc-icon-image-uploader">
                    <div class="button majc-custom-img-icon-btn">
                        <div class="majc-custom-menu-image-icon current-bg-image" >
                            <?php if (isset($header['custom_icon']) && !empty($header['custom_icon'])) { ?>
                                <img src="<?php echo isset($header['custom_icon']) ? esc_url($header['custom_icon']) : ''; ?>"/>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="majc-image-remove"><?php esc_html_e('Remove', 'mini-ajax-cart'); ?></div>
                    <div class="majc-image-upload"><?php esc_html_e('Upload', 'mini-ajax-cart') ?></div>
                    <input type="hidden" class="majc-upload-background-url" name="majc_settings[header][custom_icon]" id="majc-header-icon" value="<?php echo isset($header['floatmenu_img_icon']) ? esc_url($header['floatmenu_img_icon']) : ''; ?>"/>
                </div> <!-- majc-icon-image-uploader -->
            </div>
        </div>

        <div class="majc-settings-field">
            <label><?php esc_html_e('Show Total Cart Items Count', 'mini-ajax-cart'); ?></label>
            <div class="majc-settings-input-field">
                <input type="checkbox" name="majc_settings[header][show_cart_item_count]" <?php
                if (isset($header['show_cart_item_count'])) {
                    checked($header['show_cart_item_count'], 'on', true);
                }
                ?>>
            </div>
        </div>
    </div>

    <div class="majc-settings-field-wrap majc-settings-content">
        <h2><?php esc_html_e('Cart Basket Tab', 'mini-ajax-cart'); ?></h2>

        <div class="majc-settings-content">
            <div class="majc-settings-field">
                <label><?php esc_html_e('Menu Open Icon Type', 'mini-ajax-cart'); ?></label>
                <div class="majc-settings-input-field">
                    <select name="majc_settings[cart_basket][open_icon_type]" onchange="hideShow(this)" target="majc-icon-open-option-field">
                        <option value="none" <?php
                        if (isset($cart_basket['open_icon_type'])) {
                            selected($cart_basket['open_icon_type'], 'none');
                        }
                        ?>><?php esc_html_e('None', 'mini-ajax-cart'); ?></option>
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

            <div class="majc-settings-field majc-icon-open-option-field majc-available_icon" style="<?php echo isset($cart_basket['open_icon_type']) && $cart_basket['open_icon_type'] == 'available_icon' ? 'display: flex;' : 'display: none;'; ?>">
                <label for="majc_floatmenu_default_icon"><?php esc_html_e('Default Menu Open Icon', 'mini-ajax-cart'); ?></label>
                <div class="majc-settings-input-field">
                    <?php
                    $inputName = 'majc_settings[cart_basket][open_available_icon]';
                    $iconName = isset($cart_basket['open_available_icon']) ? $cart_basket['open_available_icon'] : null; //icon value from db
                    $this->icon_field($inputName, $iconName);
                    ?>
                </div>
            </div>

            <div class="majc-settings-field majc-icon-open-option-field majc-custom_icon" style="<?php echo isset($cart_basket['open_icon_type']) && $cart_basket['open_icon_type'] == 'custom_icon' ? 'display: flex;' : 'display: none;'; ?>">
                <label for="majc-header-icon"><?php esc_html_e('Upload Custom Open Icon', 'mini-ajax-cart'); ?></label>
                <div class="majc-settings-input-field">
                    <div class="majc-icon-image-uploader">
                        <div class="button majc-custom-img-icon-btn">
                            <div class="majc-custom-menu-image-icon current-bg-image" >
                                <?php if (isset($cart_basket['open_custom_icon']) && !empty($cart_basket['open_custom_icon'])) { ?>
                                    <img src="<?php echo isset($cart_basket['open_custom_icon']) ? esc_url($cart_basket['open_custom_icon']) : ''; ?>"/>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="majc-image-remove"><?php esc_html_e('Remove', 'mini-ajax-cart'); ?></div>
                        <div class="majc-image-upload"><?php esc_html_e('Upload', 'mini-ajax-cart') ?></div>
                        <input type="hidden" class="majc-upload-background-url" name="majc_settings[cart_basket][open_custom_icon]" id="majc-header-icon" value="<?php echo isset($cart_basket['open_custom_icon']) ? esc_url($cart_basket['open_custom_icon']) : ''; ?>"/>
                    </div> <!-- majc-icon-image-uploader -->
                </div>
            </div>
        </div>

        <div class="majc-settings-content">
            <div class="majc-settings-field">
                <label><?php esc_html_e('Menu Close Icon Type', 'mini-ajax-cart'); ?></label>
                <div class="majc-settings-input-field">
                    <select name="majc_settings[cart_basket][close_icon_type]" onchange="hideShow(this)" target="majc-icon-close-option-field">
                        <option value="none" <?php
                        if (isset($cart_basket['close_icon_type'])) {
                            selected($cart_basket['close_icon_type'], 'none');
                        }
                        ?>><?php esc_html_e('None', 'mini-ajax-cart'); ?></option>
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

            <div class="majc-settings-field majc-icon-close-option-field majc-available_icon" style="<?php echo isset($cart_basket['close_icon_type']) && $cart_basket['close_icon_type'] == 'available_icon' ? 'display: flex;' : 'display: none;'; ?>">
                <label for="majc_floatmenu_default_icon"><?php esc_html_e('Default Menu Close Icon', 'mini-ajax-cart'); ?></label>
                <div class="majc-settings-input-field">
                    <?php
                    $inputName = 'majc_settings[cart_basket][close_available_icon]';
                    $iconName = isset($cart_basket['close_available_icon']) ? $cart_basket['close_available_icon'] : null; //icon value from db
                    $this->icon_field($inputName, $iconName);
                    ?>
                </div>
            </div>

            <div class="majc-settings-field majc-icon-close-option-field majc-custom_icon" style="<?php echo isset($cart_basket['close_icon_type']) && $cart_basket['close_icon_type'] == 'custom_icon' ? 'display: flex;' : 'display: none;'; ?>">
                <label for="majc-header-icon"><?php esc_html_e('Upload Custom Close Icon', 'mini-ajax-cart'); ?></label>
                <div class="majc-settings-input-field">
                    <div class="majc-icon-image-uploader">
                        <div class="button majc-custom-img-icon-btn">
                            <div class="majc-custom-menu-image-icon current-bg-image" >
                                <?php if (isset($cart_basket['close_custom_icon']) && !empty($cart_basket['close_custom_icon'])) { ?>
                                    <img src="<?php echo isset($cart_basket['close_custom_icon']) ? esc_url($cart_basket['close_custom_icon']) : ''; ?>"/>
                                <?php } ?>
                            </div>
                        </div>
                        <div class="majc-image-remove"><?php esc_html_e('Remove', 'mini-ajax-cart'); ?></div>
                        <div class="majc-image-upload"><?php esc_html_e('Upload', 'mini-ajax-cart') ?></div>
                        <input type="hidden" class="majc-upload-background-url" name="majc_settings[cart_basket][close_custom_icon]" id="majc-header-icon" value="<?php echo isset($cart_basket['close_custom_icon']) ? esc_url($cart_basket['close_custom_icon']) : ''; ?>"/>
                    </div> <!-- majc-icon-image-uploader -->
                </div>
            </div>
        </div>

        <div class="majc-settings-field">
            <label><?php esc_html_e('Shape', 'mini-ajax-cart'); ?></label>
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
            <label><?php esc_html_e('Show Product Count', 'mini-ajax-cart'); ?></label>
            <div class="majc-settings-input-field">
                <input type="checkbox" name="majc_settings[cart_basket][product_count]" <?php
                if (isset($cart_basket['product_count'])) {
                    checked($cart_basket['product_count'], 'on', true);
                }
                ?>>
            </div>
        </div>

        <div class="majc-settings-field">
            <label><?php esc_attr_e('Hover Animation', 'mini-ajax-cart') ?></label>
            <div class="majc-settings-input-field">
                <select name="majc_settings[cart_basket][hover_animation]">
                    <option value="none"><?php esc_html_e('None', 'mini-ajax-cart'); ?></option>
                    <?php foreach ($animations['hover_animation'] as $type => $type_array): ?>
                        <optgroup label="<?php echo esc_attr($type) ?>"></optgroup>
                        <?php foreach ($type_array as $key => $value): ?>
                            <option value="<?php echo esc_attr($value) ?>" <?php
                            if (isset($majc_settings['cart_basket']['hover_animation'])) {
                                selected($majc_settings['cart_basket']['hover_animation'], $value);
                            }
                            ?>><?php echo esc_attr($key) ?></option>
                                <?php endforeach ?>
                            <?php endforeach ?>
                </select>
            </div>
        </div>
    </div>

    <div class="majc-settings-field-wrap majc-settings-content">
        <h2><?php esc_html_e('Price Summary', 'mini-ajax-cart'); ?></h2>

        <div class="majc-settings-field">
            <label><?php esc_html_e('Hide Cart Total', 'mini-ajax-cart'); ?></label>
            <div class="majc-settings-input-field">
                <input type="checkbox" name="majc_settings[summary][hide_cart_total]" <?php
                if (isset($summary['hide_cart_total'])) {
                    checked($summary['hide_cart_total'], 'on', true);
                }
                ?>>
            </div>
        </div>

        <div class="majc-settings-field">
            <label><?php esc_html_e('Hide Discount', 'mini-ajax-cart'); ?></label>
            <div class="majc-settings-input-field">
                <input type="checkbox" name="majc_settings[summary][hide_discount]" <?php
                if (isset($summary['hide_discount'])) {
                    checked($summary['hide_discount'], 'on', true);
                }
                ?>>
            </div>
        </div>

        <div class="majc-settings-field">
            <label><?php esc_html_e('Hide Subtotal', 'mini-ajax-cart'); ?></label>
            <div class="majc-settings-input-field">
                <input type="checkbox" name="majc_settings[summary][hide_subtotal]" <?php
                if (isset($summary['hide_subtotal'])) {
                    checked($summary['hide_subtotal'], 'on', true);
                }
                ?>>
            </div>
        </div>
    </div>
</div>