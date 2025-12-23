<?php

defined('ABSPATH') or die('No script please!');

function majc_get_var($param, $sanitize = 'sanitize_text_field', $default = '') {
    if (isset($_GET[$param])) {
        $value = wp_unslash($_GET[$param]);
    } else {
        $value = $default;
    }

    return majc_sanitize_value($sanitize, $value);
}

function majc_get_post($param, $sanitize = 'sanitize_text_field', $default = '') {
    if (isset($_POST[$param])) {
        $value = wp_unslash($_POST[$param]);
    } else {
        $value = $default;
    }

    return majc_sanitize_value($sanitize, $value);
}

function majc_get_request($param, $sanitize = 'sanitize_text_field', $default = '') {
    if (isset($_REQUEST[$param])) {
        $value = wp_unslash($_REQUEST[$param]);
    } else {
        $value = $default;
    }

    return majc_sanitize_value($sanitize, $value);
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

function majc_sanitize_value($sanitize, &$value) {
    if (!empty($sanitize)) {
        if (is_array($value)) {
            $temp_values = $value;
            foreach ($temp_values as $k => $v) {
                $value[$k] = majc_sanitize_value($sanitize, $value[$k]);
            }

        } else {
            $value = call_user_func($sanitize, htmlspecialchars_decode($value));
        }
    }

    return $value;
}


function majc_sanitize_array($array = array(), $sanitize_rule = array()) {
    $new_args = (array) $array;

    if ($array) {
        foreach ($array as $key => $value) {
            if (is_array($value)) {
                $new_args[$key] = majc_sanitize_array($value, isset($sanitize_rule[$key]) ? $sanitize_rule[$key] : 'sanitize_text_field');
            } else {
                if (isset($sanitize_rule[$key]) && !empty($sanitize_rule[$key]) && function_exists($sanitize_rule[$key])) {
                    $sanitize_type = $sanitize_rule[$key];
                    $new_args[$key] = $sanitize_type($value);
                } else {
                    $new_args[$key] = $value;
                }
            }
        }
    }

    return $new_args;
}