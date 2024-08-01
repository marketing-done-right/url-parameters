# URL Parameters

### Authors: 
- [Hans Steffens](https://hanscode.io/)
- The folks behind [Marketing Done Right, LLC](https://marketingdr.co/)

## Description
The URL Parameters WordPress plugin allows you to access URL parameters and display conditional content based on the Query String of the URL. This plugin is ideal for tracking referral sources, personalizing user experiences, and managing content dynamically based on URL parameters.

## Key Features
- Display URL parameter values anywhere on your site using shortcodes.
- Conditionally display content based on URL parameters.
- Support for multiple parameters with fallback and default values.
- Replace dashes with spaces in URL parameter values for seamless display.

## Installation
1. **Upload the Plugin:**
   - Upload the `url-parameters` folder to the `/wp-content/plugins/` directory.
2. **Activate the Plugin:**
   - Activate the plugin through the 'Plugins' menu in WordPress.
3. **Start Using Shortcodes:**
   - Use the provided shortcodes in your posts, pages, or widgets to display or conditionally display content based on URL parameters.

## Usage

### Displaying URL Parameter

Use the `[url_param]` shortcode to display the value of a URL parameter. It accepts two attributes:
- `parameter`: The name of the URL parameter to display.
- `default`: The default value to display if the URL parameter is not set.

#### Example 

```plaintext
[url_param parameter="city" default="Cleveland"] 
```
In this example, the shortcode will display the value of the `city` URL parameter. If the `city` parameter is not set in the URL, the shortcode will display "Cleveland" as the default value. 

### Conditional Content Based on URL Parameter

Use the `[ifurlparam]` shortcode to conditionally display content based on the value of a URL parameter. It accepts three attributes:

- `param`: The name of the URL parameter to check.
- `empty`: A flag to check if the URL parameter is empty.
- `is`: The value to check against the URL parameter value.

#### Example

```plaintext
[ifurlparam param="utm_campaign" is="summer" empty="1"]This is a summer campaign![/ifurlparam] 
```
In this example, the shortcode will display "This is a summer campaign!" if the `utm_campaign` URL parameter is set to "summer" or if the  `utm_campaign` parameter is empty. 

### Advanced Usage with Multiple Parameters

You can specify multiple parameters separated by commas. The plugin will check for each parameter in order until a matching one is found and return that. If no parameters match, the default will be returned.

```plaintext
[url_param parameter="FirstName, first, name" default="Friend"]
```
In this example, the shortcode will check for `FirstName`, if not found, then `first`, if not found, then `name`. If none are found, it will return "Friend".

## Contributing

Contributions are what make the open source community such an amazing place to learn, inspire, and create. Any contributions you make are greatly appreciated.

1. Fork the Project
2. Create your Feature Branch (git checkout -b feature/AmazingFeature)
3. Commit your Changes (git commit -m 'Add some AmazingFeature')
4. Push to the Branch (git push origin feature/AmazingFeature)
5. Open a Pull Request

# Changelog

## 1.0.1
- Added support for replacing dashes with spaces in URL parameter values.
- Improved handling of empty and specific value checks in conditional content.

## 1.0.0
- Initial release.
- Shortcodes to display URL parameters and conditionally display content based on URL parameters.

## License
Distributed under the GPL v3 License. See [LICENSE](LICENSE) for more information.
