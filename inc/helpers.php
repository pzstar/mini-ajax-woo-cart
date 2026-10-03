<?php

defined('ABSPATH') or die('No script please!');

function majc_get_var($param, $sanitize = 'sanitize_text_field', $default = '') {
    if (isset($_GET[$param])) {
        $majc_value = wp_unslash($_GET[$param]);
    } else {
        $majc_value = $default;
    }

    return majc_sanitize_value($sanitize, $majc_value);
}

function majc_get_post($param, $sanitize = 'sanitize_text_field', $default = '') {
    if (isset($_POST[$param])) {
        $majc_value = wp_unslash($_POST[$param]);
    } else {
        $majc_value = $default;
    }

    return majc_sanitize_value($sanitize, $majc_value);
}

function majc_get_request($param, $sanitize = 'sanitize_text_field', $default = '') {
    if (isset($_REQUEST[$param])) {
        $majc_value = wp_unslash($_REQUEST[$param]);
    } else {
        $majc_value = $default;
    }

    return majc_sanitize_value($sanitize, $majc_value);
}

function majc_sanitize_value($sanitize, &$majc_value) {
    if (!empty($sanitize)) {
        if (is_array($majc_value)) {
            $temp_values = $majc_value;
            foreach ($temp_values as $k => $v) {
                $majc_value[$k] = majc_sanitize_value($sanitize, $majc_value[$k]);
            }

        } else {
            $majc_value = call_user_func($sanitize, htmlspecialchars_decode($majc_value));
        }
    }

    return $majc_value;
}
