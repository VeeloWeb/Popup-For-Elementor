<?php
/**
 * Plugin Name: Popup for Elementor
 * Plugin URI: https://www.popupforelementor.com
 * Description: Create powerful, fully customizable popups directly in Elementor Free — includes click, delay, load, and exit-intent triggers, animations, and smart visibility controls to boost user engagement.
 * Version: 1.6
 * Author: Veelo
 * Author URI: https://www.veelo.es
 * Text Domain: popup-for-elementor
 * Domain Path: /languages
 * License: GPLv2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Requires at least: 5.8
 * Requires PHP: 7.4
 * Requires Plugins: elementor
 * Tested up to: 6.8.3
 */



// Exit if accessed directly
if (!defined('ABSPATH')) {
    exit;
}

register_activation_hook(__FILE__, function () {
    update_option('popupfe_redirect_on_activation', true);
});


// Check if Elementor is active
if (!did_action('elementor/loaded')) {
    add_action('admin_notices', function () {
        echo '<div class="error"><p>Popup for Elementor requires Elementor to be installed and active.</p></div>';
    });
    return;
}

// Define constants
define('POPUPFE_PATH', plugin_dir_path(__FILE__));
define('POPUPFE_URL', plugin_dir_url(__FILE__));

// Include necessary files
require_once POPUPFE_PATH . 'includes/admin-page.php';
require_once POPUPFE_PATH . 'includes/popup-handler.php';
require_once POPUPFE_PATH . 'includes/styles.php';

add_action('plugins_loaded', function () {
    $mo_path = dirname(plugin_basename(__FILE__)) . '/languages/';
});

add_action('wp_enqueue_scripts', 'popupfe_enqueue_popup_scripts');

function popupfe_enqueue_popup_scripts()
{
    wp_localize_script('popup-widget-js', 'PopupForElementorConfig', [
        'ajaxUrl' => admin_url('admin-ajax.php'),
    ]);
}

add_action('wp_enqueue_scripts', function () {
    wp_enqueue_style(
        'animate-css',
        plugin_dir_url(__FILE__) . 'library/animate.min.css',
        [],
        '4.1.1' 
    );
});
add_action('elementor/editor/before_enqueue_scripts', function() {
    wp_enqueue_script(
        'popup-editor-block-js',
        plugin_dir_url(__FILE__) . 'assets/popup-widget-block.js',
        ['jquery'],
        '1.0',
        true
    );
});
add_action('elementor/widgets/register', function ($widgets_manager) {
    if (class_exists('\Elementor\Widget_Base')) {
        require_once POPUPFE_PATH . 'includes/editor-options.php';
        $widgets_manager->register(new Popupfe_Popup_Widget());
    }
});

add_action('admin_menu', function () {
    add_menu_page(
        'Popup for Elementor',
        'Popup for Elementor',
        'manage_options',
        'popupfe_for_elementor',
        'popupfe_render_admin_page',
        'dashicons-welcome-view-site',
        58
    );
});
