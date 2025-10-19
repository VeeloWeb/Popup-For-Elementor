<?php
// File: popup-handler.php
// Dynamically passes configuration from Elementor controls to the JavaScript.

if (!defined('ABSPATH')) {
    exit;
}
function popup_for_elementor_register_assets()
{
    if (!is_admin()) {
        wp_register_script(
            'popup-widget-js',
            plugin_dir_url(__FILE__) . '../assets/popup-widget.js',
            array('jquery'),
            '1.0.0',
            true
        );
        $post_id = get_the_ID();

        if ($post_id) {
            $dynamic_config = array(
                'showOnLoad'           => get_post_meta($post_id, '_elementor_popup_show_on_load', true) ?: 'no',
                'delay'                => (int) get_post_meta($post_id, '_elementor_popup_delay', true) ?: 0,
                'showOnScroll'         => get_post_meta($post_id, '_elementor_popup_show_on_scroll', true) === 'yes',
                'scrollPercentage'     => (int) (get_post_meta($post_id, '_elementor_popup_scroll_percentage', true) ?: 50),
                'exitIntent'           => get_post_meta($post_id, '_elementor_popup_exit_intent', true) === 'yes',
                'exitIntentDisplayMode'=> get_post_meta($post_id, '_elementor_exit_intent_display_mode', true) ?: 'always',
                'cookieName'           => 'popup_seen',
                'cookieExpiry'         => 7,
                'triggerBySelector' => get_post_meta($post_id, '_elementor_trigger_selector_enabled', true) === 'yes',
                'triggerSelector'   => get_post_meta($post_id, '_elementor_trigger_selector', true) ?: '',
                
            );
            
            wp_localize_script(
                'popup-widget-js',
                'PopupForElementorConfig',
                $dynamic_config
            );
        }
        wp_enqueue_script('popup-widget-js');
    }
}
add_action('wp_enqueue_scripts', 'popup_for_elementor_register_assets');

add_action('admin_enqueue_scripts', function () {
    wp_dequeue_script('popup-widget-js');
    wp_deregister_script('popup-widget-js');
}, PHP_INT_MAX);

