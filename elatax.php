<?php
/**
 * Plugin Name: Elatax
 * Description: A custom Elementor widget to display taxonomy terms with the styling and layout options similar to the Elementor Posts widget.
 * Version: 1.0
 * Author: Ammanulah
 * Author URI: https://nabalela.com
 */

 if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly
}

function elatax_load_plugin() {
    if (!did_action('elementor/loaded')) {
        add_action('admin_notices', 'elatax_elementor_not_loaded');
        return;
    }

    add_action('elementor/init', function() {
        require_once(plugin_dir_path(__FILE__) . 'elatax-widget.php');
        add_action('elementor/widgets/widgets_registered', 'register_elatax_widget');
    });
}

function elatax_elementor_not_loaded() {
    if (current_user_can('activate_plugins')) {
        echo '<div class="error"><p>' . sprintf(__('Elatax requires Elementor to be installed and activated. <a href="%s">Install Elementor</a> or <a href="%s">activate Elementor</a>.', 'elatax'), admin_url('plugin-install.php?tab=search&type=term&s=Elementor'), admin_url('plugins.php')) . '</p></div>';
    }
}

function register_elatax_widget() {
    $widgets_manager = \Elementor\Plugin::$instance->widgets_manager;
    $widgets_manager->register_widget_type(new Elatax_Widget());
}


// Load the plugin after all plugins are loaded
add_action('plugins_loaded', 'elatax_load_plugin');