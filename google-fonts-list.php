<?php

function majc_google_font_array() {

    $google_font_array = json_decode($google_font_json, true);

    return $google_font_array;
}

function majc_default_font_array() {
    return array(
        'Default' => array(
            'family' => 'Default',
            'variants' => array(
                'Default' => 'Default',
                '100' => 'Thin',
                '300' => 'Light',
                '400' => 'Normal',
                '400italic' => 'Normal Italic',
                '500' => 'Medium',
                '600' => 'Semi Bold',
                '700' => 'Bold',
                '700italic' => 'Bold Italic'
            ),
            'subsets' => array(
                'latin' => 'Latin'
            )
        )
    );
}

function majc_standard_font_array() {
    return array(
        'Helvetica' => array(
            'family' => 'Helvetica',
            'variants' => array(
                '400' => 'Normal',
                '700' => 'Bold'
            ),
            'subsets' => array(
                'latin' => 'Latin'
            )
        ),
        'Verdana' => array(
            'family' => 'Verdana',
            'variants' => array(
                '400' => 'Normal',
                '700' => 'Bold'
            ),
            'subsets' => array(
                'latin' => 'Latin'
            )
        ),
        'Arial' => array(
            'family' => 'Arial',
            'variants' => array(
                '400' => 'Normal',
                '700' => 'Bold'
            ),
            'subsets' => array(
                'latin' => 'Latin'
            )
        ),
        'Times' => array(
            'family' => 'Times',
            'variants' => array(
                '400' => 'Normal',
                '700' => 'Bold'
            ),
            'subsets' => array(
                'latin' => 'Latin'
            )
        ),
        'Georgia' => array(
            'family' => 'Georgia',
            'variants' => array(
                '400' => 'Normal',
                '700' => 'Bold'
            ),
            'subsets' => array(
                'latin' => 'Latin'
            )
        ),
        'Courier' => array(
            'family' => 'Courier',
            'variants' => array(
                '400' => 'Normal',
                '700' => 'Bold'
            ),
            'subsets' => array(
                'latin' => 'Latin'
            )
        ),
        'Trebuchet' => array(
            'family' => 'Trebuchet',
            'variants' => array(
                '400' => 'Normal',
                '700' => 'Bold'
            ),
            'subsets' => array(
                'latin' => 'Latin'
            )
        ),
        'Tahoma' => array(
            'family' => 'Tahoma',
            'variants' => array(
                '400' => 'Normal',
                '700' => 'Bold'
            ),
            'subsets' => array(
                'latin' => 'Latin'
            )
        ),
        'Palatino' => array(
            'family' => 'Palatino',
            'variants' => array(
                '400' => 'Normal',
                '700' => 'Bold'
            ),
            'subsets' => array(
                'latin' => 'Latin'
            )
        )
    );
}

function majc_font_array() {
    return array_merge(majc_default_font_array(), majc_standard_font_array(), majc_google_font_array());
}

function majc_get_google_font_families() {

    $majc_google_font = majc_google_font_array();

    foreach ($majc_google_font as $key => $value) {
        $font_family[$value['family']] = $value['family'];
    }
    return $font_family;
}

function majc_get_standard_font_families() {

    $majc_standard_font = majc_standard_font_array();

    foreach ($majc_standard_font as $key => $value) {
        $font_family[$value['family']] = $value['family'];
    }
    return $font_family;
}

function majc_get_font_weight_choices($family) {
    if (!$family) {
        return;
    }
    $all_font = majc_font_array();
    if (isset($all_font[$family]['variants'])) {
        $variants_array = $all_font[$family]['variants'];
        return $variants_array;
    } else {
        return array(
            'Default' => 'Default',
            '100' => 'Thin',
            '300' => 'Light',
            '400' => 'Normal',
            '400italic' => 'Normal Italic',
            '500' => 'Medium',
            '600' => 'Semi Bold',
            '700' => 'Bold',
            '700italic' => 'Bold Italic'
        );
    }
}

function majc_get_text_transform_choices() {
    return array(
        'inherit' => esc_html__('Default', 'mini-ajax-cart'),
        'none' => esc_html__('None', 'mini-ajax-cart'),
        'uppercase' => esc_html__('Uppercase', 'mini-ajax-cart'),
        'lowercase' => esc_html__('Lowercase', 'mini-ajax-cart'),
        'capitalize' => esc_html__('Capitalize', 'mini-ajax-cart')
    );
}

function majc_get_text_decoration_choices() {
    return array(
        'inherit' => esc_html__('Default', 'mini-ajax-cart'),
        'none' => esc_html__('None', 'mini-ajax-cart'),
        'underline' => esc_html__('Underline', 'mini-ajax-cart'),
        'line-through' => esc_html__('Line-through', 'mini-ajax-cart'),
        'overline' => esc_html__('Overline', 'mini-ajax-cart')
    );
}

add_action("wp_ajax_majc_get_google_font_variants", "majc_get_google_font_variants");

function majc_get_google_font_variants() {
    if (isset($_REQUEST['wp_nonce']) && wp_verify_nonce($_REQUEST['wp_nonce'], 'majc-backend-ajax-nonce')) {
        $font_family = sanitize_text_field(wp_unslash($_REQUEST['font_family']));
        $all_font = majc_font_array();
        $options = '';

        $variants_array = $all_font[$font_family]['variants'];

        foreach ($variants_array as $key => $variants) {
            if ($font_family == 'Default') {
                $selected = $key == 'Default' ? 'selected="selected"' : '';
            } else {
                $selected = $key == '400' ? 'selected="selected"' : '';
            }
            $options .= '<option ' . $selected . ' value="' . esc_attr($key) . '">' . esc_html($variants) . '</option>';
        }

        echo $options;
    }
    die();
}

function majc_typography_css($meta, $key, $selector) {
    if (!$key || !$selector) {
        return;
    }
    $css = array();

    $family = isset($meta[$key . '_font_family']) ? $meta[$key . '_font_family'] : NULL;
    $style = isset($meta[$key . '_font_style']) ? $meta[$key . '_font_style'] : NULL;
    $text_decoration = isset($meta[$key . '_text_decoration']) ? $meta[$key . '_text_decoration'] : NULL;
    $text_transform = isset($meta[$key . '_text_transform']) ? $meta[$key . '_text_transform'] : NULL;
    $size = isset($meta[$key . '_font_size']) ? $meta[$key . '_font_size'] : NULL;
    $line_height = isset($meta[$key . '_line_height']) ? $meta[$key . '_line_height'] : NULL;
    $letter_spacing = isset($meta[$key . '_letter_spacing']) ? $meta[$key . '_letter_spacing'] : NULL;
    $color = isset($meta[$key . '_font_color']) ? $meta[$key . '_font_color'] : NULL;

    if (strpos($style, 'italic')) {
        $italic = 'italic';
    }

    $weight = absint($style);

    $css[] = (!empty($family) && $family != 'Default') ? "font-family: '{$family}', serif" : NULL;
    $css[] = (!empty($weight) && $style != 'Default') ? "font-weight: {$weight}" : NULL;
    $css[] = (!empty($italic) && $style != 'Default') ? "font-style: {$italic}" : NULL;
    $css[] = (!empty($text_transform)) ? "text-transform: {$text_transform}" : NULL;
    $css[] = (!empty($text_decoration)) ? "text-decoration: {$text_decoration}" : NULL;
    $css[] = !empty($size) ? "font-size: {$size}px" : NULL;
    $css[] = !empty($line_height) ? "line-height: {$line_height}" : NULL;
    $css[] = !empty($letter_spacing) ? "letter-spacing: {$letter_spacing}px" : NULL;
    $css[] = !empty($color) ? "color: {$color}" : NULL;

    $css = array_filter($css);

    return $selector . '{' . implode(';', $css) . '}';
}

function majc_custom_fonts() {
    $font_family_array = array();
    $args = array(
        'post_type' => 'ultimate-woo-cart',
        'posts_per_page' => -1
    );
    $query = new WP_Query($args);

    if ($query->have_posts()) :
        while ($query->have_posts()) :
            $query->the_post();
            $majc_settings = get_post_meta(get_the_ID(), 'uwcc_settings', true);

            if (isset($majc_settings['display']['enable_flying_cart']) && isset($majc_settings['custom']['enable'])) {
                if (isset($majc_settings['custom']['header_title_font_family'])) {
                    $font_family_array[] = $majc_settings['custom']['header_title_font_family'];
                }
                if (isset($majc_settings['custom']['content_font_family'])) {
                    $font_family_array[] = $majc_settings['custom']['content_font_family'];
                }
                if (isset($majc_settings['custom']['product_title_font_family'])) {
                    $font_family_array[] = $majc_settings['custom']['product_title_font_family'];
                }
                if (isset($majc_settings['custom']['button_text_font_family'])) {
                    $font_family_array[] = $majc_settings['custom']['button_text_font_family'];
                }
            }

        endwhile;
        wp_reset_postdata();
    endif;

    return $font_family_array;
}

function majc_fonts_url() {
    $fonts_url = '';
    $subsets = 'latin,latin-ext';
    $fonts = $font_family_array = $variants_array = $font_array = array();
    $standard_fonts = ['Default', 'Helvetica', 'Verdana', 'Arial', 'Times', 'Georgia', 'Courier', 'Trebuchet', 'Tahoma', 'Palatino'];
    $all_font = majc_font_array();

    $custom_fonts = majc_custom_fonts();

    $font_family_array = array_unique($custom_fonts);
    $font_family_array = array_diff($font_family_array, $standard_fonts);

    foreach ($font_family_array as $font_family) {
        if (isset($all_font[$font_family]['variants'])) {
            $variants_array = $all_font[$font_family]['variants'];
            $variants_keys = array_keys($variants_array);
            $variants = implode(',', $variants_keys);

            $fonts[] = $font_family . ':' . str_replace('italic', 'i', $variants);
        }
    }
    /*
     * Translators: To add an additional character subset specific to your language,
     * translate this to 'greek', 'cyrillic', 'devanagari' or 'vietnamese'. Do not translate into your own language.
     */
    $subset = _x('no-subset', 'Add new subset (greek, cyrillic, devanagari, vietnamese)', 'total');

    if ('cyrillic' == $subset) {
        $subsets .= ',cyrillic,cyrillic-ext';
    } elseif ('greek' == $subset) {
        $subsets .= ',greek,greek-ext';
    } elseif ('devanagari' == $subset) {
        $subsets .= ',devanagari';
    } elseif ('vietnamese' == $subset) {
        $subsets .= ',vietnamese';
    }

    if ($fonts) {
        $fonts_url = add_query_arg(array(
            'family' => urlencode(implode('|', $fonts)),
            'subset' => urlencode($subsets),
            'display' => 'swap',
                ), '//fonts.googleapis.com/css');
    }

    return $fonts_url;
}
