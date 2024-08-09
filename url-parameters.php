<?php
/**
 * Plugin Name: URL Parameters
 * Description: A plugin to access URL parameters and display conditional content based on the Query String of the URL.
 * Version: 1.1.1
 * Author: Hans Steffens & Marketing Done Right LLC
 * Author URI:  https://marketingdr.co
 * License: GPL v3 or later
 * License URI: https://www.gnu.org/licenses/gpl-3.0.html
 */

namespace URLParameters;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class URLParametersPlugin {

    public function __construct() {
        add_shortcode('url_param', [$this, 'display_url_param']);
        add_shortcode('ifurlparam', [$this, 'if_url_param']);
    }

    // Shortcode to display URL parameter
    public function display_url_param($atts) {
        // Verify nonce before processing if it exists
        if (isset($_GET['nonce']) && !wp_verify_nonce($_GET['nonce'], 'url_parameters_nonce')) {
            return 'Invalid nonce';
        }

        $atts = shortcode_atts(
            array(
                'parameter' => '',
                'default'   => ''
            ), $atts, 'url_param');

        $params = explode(',', $atts['parameter']);
        foreach ($params as $param) {
            $param = trim($param);
            // Sanitize and validate the input
            if (isset($_GET[$param]) && !empty($_GET[$param])) {
                $value = sanitize_text_field($_GET[$param]);
                // Additional validation: Check if the value is numeric or contains only numbers and dashes
                if (!preg_match('/^[0-9-]+$/', $value)) {
                    $value = str_replace('-', ' ', $value);
                }
                return $value;
            }
        }

        return sanitize_text_field($atts['default']);
    }

    // Shortcode for conditional display based on URL parameter
    public function if_url_param($atts, $content = null) {
        // Verify nonce before processing if it exists
        if (isset($_GET['nonce']) && !wp_verify_nonce($_GET['nonce'], 'url_parameters_nonce')) {
            return 'Invalid nonce';
        }

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

        // Additional validation: Check if the value is numeric or contains only numbers and dashes
        if ($param_value !== null && !preg_match('/^[0-9-]+$/', $param_value)) {
            $param_value = str_replace('-', ' ', $param_value);
        }

        return '';
    }
}

// Instantiate the plugin class
new URLParametersPlugin();
