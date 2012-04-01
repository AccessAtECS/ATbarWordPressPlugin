<?php
/*
Plugin Name: ATbar
Plugin URI: http://www.atbar.org
Description: ATbar is a cross browser accessibility toolbar which can be added to a user's browser or alternatively, for developers, the toolbar launcher can be embedded on a website.
Version: 1.0
Author: Magnus White
Author Email: mpw@ecs.soton.ac.uk
Author URI: http://access.ecs.soton.ac.uk
*/


// registure plugin with Wordpress
add_action('admin_menu', 'atbar_register_settings');
add_action('admin_menu', 'atbar_add_options');

function atbar_register_settings()
{
	register_setting('atbar_options', 'atbar_persistent');
}

function atbar_add_options()
{
	add_options_page('Atbar', 'Atbar', 'manage_options', 'atbaroptions', 'atbar_options');
}


// adds css to header
add_action('wp_head', 'atbar');

function atbar() {
	echo ('<link rel="stylesheet" type="text/css" media="all" href="'.plugin_dir_url(__FILE__).'atbar.css">');
}



// add options menu
include(dirname(__FILE__).'/options.php');

$persistent_option = get_option('atbar_persistent');

if($persistent_option == "true") {

	add_action('wp_head', 'persistentlaunch');

	function persistentlaunch() {

		$persistenttoolbar = file_get_contents(dirname(__FILE__).'/atbar-launcher.js');
		
		echo ('<script language="javascript">'.$persistenttoolbar.'</script>');
	}
}
else {
	// adds toolbar launcher
	add_action('wp_head', 'toolbarlauncher');

	function toolbarlauncher() {

		$toolbar = addslashes(file_get_contents(dirname(__FILE__).'/atbar-launcher.php'));
		echo ('<script language="javascript">
		
		jQuery(document).ready( function(){
					jQuery("body").prepend("' . $toolbar . '");
				}

				);	
		</script>');
	}
}

?>

