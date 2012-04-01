<?php
/*
Plugin Name: ATbar
Plugin URI: http://www.atbar.org
Description: ATbar is a cross browser accessibility toolbar which can be added to a user's browser or alternatively, for developers, the toolbar launcher can be embedded on a website.
Version: 1.2.2
Author: Magnus White
Author Email: mpw@ecs.soton.ac.uk
Author URI: http://access.ecs.soton.ac.uk
*/

// registure plugin with Wordpress
add_action('admin_menu', 'atbar_register_settings');
add_action('admin_menu', 'atbar_add_options');

// adds functions
include_once ('functions/functions.php');

// add options menu
include(dirname(__FILE__).'/options.php');

// adds css to header
add_action('wp_print_styles', 'atbar_css');

// adds the toolbar itself
add_action('the_post', 'add_toolbar');

// adds ATbar widget
add_action("plugins_loaded", "atbar_widget_init");
?>