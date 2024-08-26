# Order Description Formatter

**Description:**  
The "Order Description Formatter" plugin extends WooCommerce's shipping method functionality by allowing customization of package item formatting. It provides options to format the item descriptions and customize the separator between items in the shipping method display.

## Features:

- **Customizable Item Formatting:** Configure the format for item descriptions using placeholders such as `{count}` and `{item}`.
- **Separator Customization:** Define a custom separator or use default settings to separate item lines in the shipping method display.
- **Admin Settings Page:** An easy-to-use settings page in WooCommerce to configure item formatting and separators.
- **Dynamic Formatting:** Adjusts formatting in the admin panel with JavaScript for better readability.

## Usage:

### 1. Configuring Settings

- **Navigate to Settings Page:**
  - Go to `WooCommerce` → `Settings` → `Order Desc Formatter` in the WordPress admin sidebar.

- **Configure Item Line Format:**
  - Enter your preferred format using placeholders `{count}` for quantity and `{item}` for item name. The default is `{count} {item}`.

- **Set Separator:**
  - Specify a separator for formatting item lines or leave it blank for no separator. The default is `-`.

- **Save Changes:**
  - Click the "Save Changes" button to apply your settings.

### 2. JavaScript Formatting Adjustment

- **Automatic Formatting:**
  - The plugin includes JavaScript that replaces commas with line breaks and highlights quantities greater than one in red bold text for better visibility in the admin panel.

## Admin Notices

- After saving settings, a confirmation message will be displayed to indicate that your changes have been applied successfully.

## Customization:

- **Parameters and Formatting:**
  - Modify the formatting placeholders and separator settings directly from the plugin settings page.

- **JavaScript Adjustments:**
  - Customize the JavaScript used for formatting in the `separator_js_to_admin` function to suit your needs.

## Developer Information:

## Changelog:

**Version 1.0.0:**
- Initial release with basic formatting and separator customization.
- Added JavaScript for improved admin panel display.

## Credits:

- **Author:** Yousseif Ahmed

## License:

This plugin is licensed under the [GNU General Public License v3.0](https://www.gnu.org/licenses/gpl-3.0.html).

## Note:

**This plugin is a sample and should be customized to match the actual details.**
