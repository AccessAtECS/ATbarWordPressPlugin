<?php

// functions

function atbar_css() {

	echo ('<link rel="stylesheet" type="text/css" media="all" href="'.plugin_dir_url(__FILE__).'atbar.css">');
}

function atbar_register_settings(){

	register_setting('atbar_options', 'atbar_persistent');
	register_setting('atbar_options', 'atbar_exclude');
	register_setting('atbar_options', 'atbar_exclude_pages');
	register_setting('atbar_options', 'atbar_no_show_banner_top');
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
	
	toolbarholder = document.createElement("div");
	toolbarholder.id = "toolbar-holder";
	toolbarholder.innerHTML = "'.$toolbar.'";
	document.body.insertBefore(toolbarholder, document.body.firstChild);
	
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
	
	$no_show_banner_top_option = get_option('atbar_no_show_banner_top');
	
	// if only widget wants to be selcted don't show banner at top
	if ($no_show_banner_top_option == "Yes"){
	
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
}

function exclude_pages() {

	$array = create_exclude_array();
	$postid = strval(get_the_ID());
	$exclude_option = get_option('atbar_exclude');
		
	if($exclude_option == "on") {
	
		if(in_array($postid, $array)) {			
			add_action('get_footer', 'toolbarlauncher');
		}
		else {
			add_action('get_footer', 'persistentlaunch');
		}
	}
	else {
		add_action('get_footer', 'persistentlaunch');
	}
}

function banner_show($value) {
	
	$no_show_banner_top_option = get_option('atbar_no_show_banner_top');
		
	if($no_show_banner_top_option == $value) {
		echo ("selected");
	}
}

function atbar_widget_init(){
	register_sidebar_widget(__('ATbar'), 'add_atbar_widget');
}

function add_atbar_widget($args) {
  extract($args);
  echo $before_widget;
  atbar_widget();
  echo $after_widget;
}

function atbar_widget(){
	$toolbar = file_get_contents(dirname(__FILE__).'/atbar-launcher.php');
	
	echo '<div id="toolbar-widget">'.$toolbar.'</div>';
}
?>