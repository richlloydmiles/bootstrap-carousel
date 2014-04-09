<?php

/**
 * Plugin Name: Bootstrap Carousel
 * Plugin URI: http://lsdev.biz
 * Description: Carousel plugin for themes using the Bootstrap Framework.
 * Author: Iain Coughtrie
 * Version: 1.0
 * Author URI: http://lsdev.biz
 */

// Post Type and Custom Fields
include plugin_dir_path( __FILE__ ) . '/inc/class-bs-carousel-admin.php';

// Shortcode
include plugin_dir_path( __FILE__ ) . '/inc/class-bs-carousel.php';

// Widget
include plugin_dir_path( __FILE__ ) . '/inc/class-bs-carousel-widget.php';

// Template Tag and functions
include plugin_dir_path( __FILE__ ) . '/inc/bs-carousel-functions.php';
