<?php

// functions

function atbar_css() {

	echo ('<link rel="stylesheet" type="text/css" media="all" href="'.plugin_dir_url(__FILE__).'atbar.css">');
}

function atbar_register_settings(){

	register_setting('atbar_options', 'atbar_persistent');
	register_setting('atbar_options', 'atbar_exclude');
	register_setting('atbar_options', 'atbar_exclude_pages');
}

function atbar_add_options(){

	add_options_page('Atbar', 'Atbar', 'manage_options', 'atbaroptions', 'atbar_options');
}

function persistentlaunch() {

	$persistenttoolbar = file_get_contents(dirname(__FILE__).'/atbar-launcher.js');
	echo ('<script language="javascript">'.$persistenttoolbar.'</script>');
}

function toolbarlauncher() {

	$toolbar = addslashes(file_get_contents(dirname(__FILE__).'/atbar-launcher.php'));
	echo ('<script language="javascript">
	
	jQuery(document).ready( function(){
				jQuery("body").prepend("' . $toolbar . '");
			}

			);	
	</script>');
}

function is_persistent($value) {
	
	$persistent_option = get_option('atbar_persistent');
		
	if($persistent_option == $value) {
		echo ("selected");
	}
}

function is_exclude() {

	$exclude_option = get_option('atbar_exclude');
	
	if($exclude_option == "on") {
		echo ('checked');
	}
	else {
		echo ('unchecked');
	}			
}

function create_exclude_array() {

	$exclude_pages_option = get_option('atbar_exclude_pages');	
	$exclude_array = explode (',', $exclude_pages_option);
	
	return $exclude_array;
}

function add_toolbar(){

	// is persistent setting on?
	$persistent_option = get_option('atbar_persistent');

	// adds persistent toolbar
	if($persistent_option == "Yes") {
		exclude_pages();
	}

	// else adds toolbar launcher
	else {		
		add_action('get_footer', 'toolbarlauncher');	
	}
}

function exclude_pages() {

	$array = create_exclude_array();
	$postid = strval(get_the_ID());
	$exclude_option = get_option('atbar_exclude');
		
	if($exclude_option == "on") {
	
		if(in_array($postid, $array)) {			
			add_action('get_footer', 'persistentlaunch');
		}
		else {
			add_action('get_footer', 'toolbarlauncher');
		}
	}
	else {
		add_action('get_footer', 'toolbarlauncher');
	}
}

?>