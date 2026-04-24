<?php
/**
 * Plugin Name: Student Manager
 * Description: Quản lý sinh viên (Tạo Custom Post Type, Meta Box và Shortcode hiển thị danh sách).
 * Version: 1.0.0
 * Author: Your Name
 * Text Domain: student-manager
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly.
}

// Define plugin paths
define( 'SM_PLUGIN_DIR', plugin_dir_path( __FILE__ ) );
define( 'SM_PLUGIN_URL', plugin_dir_url( __FILE__ ) );

// Include necessary files
require_once SM_PLUGIN_DIR . 'includes/class-sm-cpt.php';
require_once SM_PLUGIN_DIR . 'includes/class-sm-metabox.php';
require_once SM_PLUGIN_DIR . 'includes/class-sm-shortcode.php';

// Initialize the plugin
function sm_plugin_init() {
    new SM_CPT();
    new SM_MetaBox();
    new SM_Shortcode();
}
add_action( 'plugins_loaded', 'sm_plugin_init' );

// Enqueue styles for frontend
function sm_enqueue_scripts() {
    wp_enqueue_style( 'sm-style', SM_PLUGIN_URL . 'assets/style.css', array(), '1.0.0' );
}
add_action( 'wp_enqueue_scripts', 'sm_enqueue_scripts' );
