<?php
/*
Plugin Name: ATbar
Plugin URI: http://www.atbar.org
Description: ATbar is a cross browser accessibility toolbar which can be added to a user's browser or alternatively, for developers, the toolbar launcher can be embedded on a website.
Version: 3.1
Author: Magnus P White
Author Email: mpw@ecs.soton.ac.uk
Author URI: http://access.ecs.soton.ac.uk
*/

// registure plugin with Wordpress
add_action('admin_menu', 'atbar_register_settings');
add_action('admin_menu', 'atbar_add_options');

// adds functions & widget class
include_once ('functions/functions.php');
include_once ('functions/atbarwidget.class.php');

// add options menu
include(dirname(__FILE__).'/options.php');

// adds css to header
add_action('wp_print_styles', 'atbar_css');

// adds the toolbar itself
add_action('the_post', 'add_toolbar');

// adds ATbar widget
add_action( 'widgets_init', create_function( '', 'register_widget( "atbar_widget" );' ) );
?>