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

function majc_get_post_data($param) {
    $post_data = array();
    if (isset($_POST[$param])) {
        parse_str($_POST[$param], $post_data);
    }

    return majc_sanitize_array($post_data);
}

function majc_get_request_data($param, $sanitize = 'sanitize_text_field', $default = '') {
    $post_data = array();
    if (isset($_REQUEST[$param])) {
        parse_str($_REQUEST[$param], $post_data);
    }

    return majc_sanitize_array($post_data);
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


function majc_sanitize_array($array = array(), $sanitize_rule = array()) {
    $new_args = (array) $array;

    if ($array) {
        foreach ($array as $majc_key => $majc_value) {
            if (is_array($majc_value)) {
                $new_args[$majc_key] = majc_sanitize_array($majc_value, isset($sanitize_rule[$majc_key]) ? $sanitize_rule[$majc_key] : 'sanitize_text_field');
            } else {
                if (isset($sanitize_rule[$majc_key]) && !empty($sanitize_rule[$majc_key]) && function_exists($sanitize_rule[$majc_key])) {
                    $sanitize_type = $sanitize_rule[$majc_key];
                    $new_args[$majc_key] = $sanitize_type($majc_value);
                } else {
                    $new_args[$majc_key] = $majc_value;
                }
            }
        }
    }

    return $new_args;
}