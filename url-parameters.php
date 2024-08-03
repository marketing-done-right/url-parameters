<?php
/**
 * Plugin Name: URL Parameters
 * Description: A plugin to access URL parameters and display conditional content based on the Query String of the URL.
 * Version: 1.0.4
 * Author: Hans Steffens & Marketing Done Right LLC
 * Author URI:  https://marketingdr.co
 * License: GPL v3 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

// Shortcode to display URL parameter
function display_url_param($atts) {
    $atts = shortcode_atts(
        array(
            'parameter' => '',
            'default'   => ''
        ), $atts, 'url_param');

    $params = explode(',', $atts['parameter']);
    foreach ($params as $param) {
        $param = trim($param);
        if (isset($_GET[$param]) && !empty($_GET[$param])) {
            $value = sanitize_text_field($_GET[$param]);
            // Check if the value is numeric or contains only numbers and dashes
            if (!preg_match('/^[0-9-]+$/', $value)) {
                $value = str_replace('-', ' ', $value);
            }
            return $value;
        }
    }

    return sanitize_text_field($atts['default']);
}
add_shortcode('url_param', 'display_url_param');

// Shortcode for conditional display based on URL parameter
function if_url_param($atts, $content = null) {
    $atts = shortcode_atts(
        array(
            'param'  => '',
            'empty'  => '',
            'is'     => ''
        ), $atts, 'ifurlparam');

    $param_value = isset($_GET[$atts['param']]) ? sanitize_text_field($_GET[$atts['param']]) : null;

    // If the 'is' attribute is set and matches the parameter value
    if (!empty($atts['is']) && $param_value === $atts['is']) {
        return do_shortcode($content);
    }

    // If the 'empty' attribute is set and the parameter value is empty
    if (!empty($atts['empty']) && $atts['empty'] == '1' && empty($param_value)) {
        return do_shortcode($content);
    }

    // Check if the value is numeric or contains only numbers and dashes
    if ($param_value !== null && !preg_match('/^[0-9-]+$/', $param_value)) {
        $param_value = str_replace('-', ' ', $param_value);
    }

    return '';
}
add_shortcode('ifurlparam', 'if_url_param');
