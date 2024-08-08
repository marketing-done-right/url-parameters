# Changelog

## [1.1.1] - 2024-08-08

- Added nonce verification for URL parameters in shortcodes
- Enhanced sanitization and validation of URL parameters
- Ensured readme.txt follows the required format for the WordPress.org plugin repository

## [1.1.0] - 2024-08-08

### Changed
- Introduced 'URLParameters' namespace to encapsulate all plugin functions.
- Updated shortcode registrations to reference namespaced functions.
- Improved code organization and adherence to WordPress coding standards.

## [1.0.2] - 2024-08-02

### Added
- Added regex check to preserve dashes in numeric URL parameter values such as phone numbers.
- Updated display_url_param shortcode to handle numeric values correctly.

### Fixed
- Fixed issue where dashes in numeric URL parameter values were incorrectly replaced with spaces.

## 1.0.1 - 2024-07-31
- Added support for replacing dashes with spaces in URL parameter values.
- Improved handling of empty and specific value checks in conditional content.

## 1.0.0 - 2024-07-29
- Initial release.
- Shortcodes to display URL parameters and conditionally display content based on URL parameters.

## [Unreleased]
- Planning to add more integrations and customizable features based on user feedback.
### Features in Progress
- **Return an Entire HTML Tag:** Add support for the shortcode to return a complete HTML tag based on URL parameter values, allowing users to dynamically generate elements like `<input>`, `<img>`, and `<a>` with attributes populated from URL parameters. This will enable more dynamic and flexible content generation based on user input.
- **Return an HTML Attribute:** Add functionality to return HTML attributes using shortcodes, enabling users to insert dynamic URL parameter values into attributes of existing HTML tags. For example, users can dynamically set the href attribute of an `<a>` tag or the `src` attribute of an `<img>` tag based on URL parameters, providing greater flexibility and customization options.