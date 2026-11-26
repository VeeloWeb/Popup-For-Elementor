<?php
if (!defined('ABSPATH')) {
    exit;
}

function popup_for_elementor_register_assets()
{
    if (!is_admin()) {
        wp_enqueue_script(
            'popup-widget-js',
            plugin_dir_url(__FILE__) . '../assets/popup-widget.js',
            array('jquery'),
            '1.6.7.1',
            true
        );
    }
}
add_action('wp_enqueue_scripts', 'popup_for_elementor_register_assets');

add_action('admin_enqueue_scripts', function () {
    wp_dequeue_script('popup-widget-js');
    wp_deregister_script('popup-widget-js');
}, PHP_INT_MAX);
