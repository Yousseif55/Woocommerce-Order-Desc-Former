<?php
/*
 * Plugin Name: Order Description Formatter
 * Description: Extends the WooCommerce shipping method to customize package item formatting and provides additional configuration options.
 * Author: Yousseif Ahmed
 * Version: 1.0.0
*/

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}


function customize_shipping_rate_meta_data($rate, $args, $that) {
    // Retrieve configurations from the settings or use default values
    $item_line_format = get_option('item_line_format', '{count} {item}');
    $separator = get_option('separator', ',,');

    // Set default values if options are not set
    $item_line_format = $item_line_format ?: '{count} {item}';
    $separator = is_string($separator) ? ",{$separator}," : ',,';

    // Check if the separator should create a new line

    // Access package items
    $items_in_package = array();
    foreach ($args['package']['contents'] as $item) {
        $product = $item['data'];
        $count = $item['quantity'];

        // Apply custom format with placeholders
        $formatted_item = str_replace(
            array('{count}', '{item}'),
            array($count, $product->get_name()),
            $item_line_format
        );

        $items_in_package[] = $formatted_item;
    }

    // Add the custom formatted items to the rate meta data with HTML line breaks
    $rate->add_meta_data(__('Items', 'woocommerce'), implode($separator, $items_in_package));

    // Add the total quantity to the rate meta data
    $total_quantity = array_sum(array_column($args['package']['contents'], 'quantity'));
    $rate->add_meta_data(__('Total', 'woocommerce'), $total_quantity);

    return $rate;
}



function add_order_description_formatter_tab($tabs) {
    $tabs['order_description_formatter'] = __('Order Desc Formatter', 'woocommerce');
    return $tabs;
}

// Register settings for the custom shipping format tab
add_action('woocommerce_settings_order_description_formatter', 'add_order_description_formatter_settings');

function add_order_description_formatter_settings() {
    woocommerce_admin_fields(get_order_description_formatter_settings());
}

function get_order_description_formatter_settings() {
    return array(
        'section_title' => array(
            'name'     => __('Order Description Format Settings', 'woocommerce'),
            'type'     => 'title',
            'id'       => 'order_description_formatter_options',
        ),
        'item_line_format' => array(
            'name' => __('Item Line Format', 'woocommerce'),
            'type' => 'text',
            'desc' => __('Use placeholders {count} and {item}', 'woocommerce'),
            'id'   => 'item_line_format',
            'default' => '{count} {item}',
        ),
        'separator' => array(
            'name' => __('Separator', 'woocommerce'),
            'type' => 'text',
            'desc' => __('Enter a separator or leave blank for no separator', 'woocommerce'),
            'id'   => 'separator',
            'default' => '-',
        ),
        'section_end' => array(
            'type' => 'sectionend',
            'id' => 'order_description_formatter_options',
        ),
    );
}
// Save settings for the custom tab

function save_order_description_formatter_settings() {
    woocommerce_update_options(get_order_description_formatter_settings());
}

// handle js to change the , with new line
function separator_js_to_admin()
{

    // Add jQuery script
   ?><script>
jQuery(document).ready(function() {
    // Target the specific <p> tag within the #order_shipping_line_items tbody
    jQuery('tr.shipping td.name p').each(function() {
        jQuery(this).html(function(index, html) {
            // Replace commas with a new line
            html = html.replace(/,/g, '<br>');

            // Use a regular expression to find numbers and make them bold if they are greater than one
            return html.replace(/\b(\d+)\b/g, function(match) {
                return parseInt(match) > 1 ? '<b style="color: red;">' + match + '</b>' : match;
            });
        });
    });
});



    </script><?php
}

