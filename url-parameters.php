<?php
/**
 * Plugin Name: URL Parameters
 * Plugin URI: https://github.com/marketing-done-right/url-parameters
 * Description: A plugin to access URL parameters and display conditional content based on the Query String of the URL.
 * Version: 1.2.0
 * Author: Hans Steffens & Marketing Done Right LLC
 * Author URI:  https://marketingdr.co
 * Text Domain: url-parameters
 * License: GPL v3 or later
 * License URI: https://www.gnu.org/licenses/gpl-3.0.html
 * 
 * This program is free software: you can redistribute it and/or modify
 * it under the terms of the GNU General Public License as published by
 * the Free Software Foundation, either version 3 of the License, or
 * (at your option) any later version.
 *
 * This program is distributed in the hope that it will be useful,
 * but WITHOUT ANY WARRANTY; without even the implied warranty of
 * MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 * GNU General Public License for more details.
 *
 * You should have received a copy of the GNU General Public License
 * along with this program.  If not, see <http://www.gnu.org/licenses/>.
 */

namespace URLParameters;

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}

class URLParametersPlugin {

    public function __construct() {
        add_shortcode('url_query', [$this, 'display_url_param']);
        add_shortcode('if_url_query', [$this, 'if_url_param']);
    }

    // Shortcode to display URL parameter
    public function display_url_param($atts) {
        // Verify nonce before processing if it exists
        if (isset($_GET['nonce']) && !wp_verify_nonce($_GET['nonce'], 'url_parameters_nonce')) {
            return 'Invalid nonce';
        }

        $atts = shortcode_atts(
            array(
                'param' => '',
                'default'   => ''
            ), $atts, 'url_query');

        $params = explode(',', $atts['param']);
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
            ), $atts, 'if_url_query');

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
