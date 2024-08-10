=== URL Parameters ===
Contributors: hanscode, marketingdoneright
Tags: url parameters, query string, url, dynamic content, conditional content
Requires at least: 5.0
Tested up to: 6.6
Requires PHP: 7.4
Stable tag: 1.2.0
License: GPLv3
License URI: https://www.gnu.org/licenses/gpl-3.0.html

Access URL parameters and display conditional content based on the query string in your WordPress site.

== Description ==

The URL Parameters WordPress plugin allows you to access URL parameters and display conditional content based on the Query String of the URL. This plugin is ideal for tracking referral sources, personalizing user experiences, and managing content dynamically based on URL parameters.

== Installation ==

1. Upload the `url-parameters` folder to the `/wp-content/plugins/` directory.
2. Activate the plugin through the 'Plugins' menu in WordPress.
3. Use the provided shortcodes in your posts, pages, or widgets to display or conditionally display content based on URL parameters.

== Usage ==

=== Displaying URL Parameter ===

Use the `[url_query]` shortcode to display the value of a URL parameter. It accepts two attributes:
* `param`: The name of the URL parameter to display.
* `default`: The default value to display if the URL parameter is not set.

Example:
`[url_query param="city" default="Cleveland"]`

In this example, the shortcode will display the value of the city URL parameter. If the city parameter is not set in the URL, the shortcode will display "Cleveland" as the default value.

=== Conditional Content Based on URL Parameter ===

Use the [if_url_query] shortcode to conditionally display content based on the value of a URL parameter. It accepts three attributes:

param: The name of the URL parameter to check.
empty: A flag to check if the URL parameter is empty.
is: The value to check against the URL parameter value.

Example:
`[if_url_query param="utm_campaign" is="summer" empty="1"]This is a summer campaign![/if_url_query]`

In this example, the shortcode will display "This is a summer campaign!" if the utm_campaign URL parameter is set to "summer" or if the utm_campaign parameter is empty.

=== Advanced Usage with Multiple Parameters ===

You can specify multiple parameters separated by commas. The plugin will check for each parameter in order until a matching one is found and return that. If no parameters match, the default will be returned.

Example:
`[url_query param="FirstName, first, name" default="Friend"]`

In this example, the shortcode will check for FirstName, if not found, then first, if not found, then name. If none are found, it will return "Friend".

== Changelog ==

= 1.2.0 - 2024-08-03 =

* Updated shortcode tags to 'url_query' and 'if_url_query' to avoid conflicts with other plugins.
* Improved consistency and readability of shortcode tags.

= 1.1.1 - 2024-08-08 =

* Added nonce verification for URL parameters in shortcodes
* Enhanced sanitization and validation of URL parameters

= 1.1.0 - 2024-08-08 =

* Introduced 'URLParameters' namespace to encapsulate all plugin functions.
* Updated shortcode registrations to reference namespaced functions.
* Improved code organization and adherence to WordPress coding standards.

= [1.0.2] - 2024-08-02 =

* Added regex check to preserve dashes in numeric URL parameter values such as phone numbers.
* Updated display_url_param shortcode to handle numeric values correctly.
* Fixed issue where dashes in numeric URL parameter values were incorrectly replaced with spaces.

= 1.0.1 - 2024-07-31 =
* Added support for replacing dashes with spaces in URL parameter values.
* Improved handling of empty and specific value checks in conditional content.

= 1.0.0 - 2024-07-29 =
* Initial release.
* Shortcodes to display URL parameters and conditionally display content based on URL parameters.


