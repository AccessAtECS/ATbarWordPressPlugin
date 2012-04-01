<?php

// functions

function atbar_css() {

	echo ('<link rel="stylesheet" type="text/css" media="all" href="'.plugin_dir_url(__FILE__).'atbar.css">');
}

function atbar_register_settings(){

	register_setting('atbar_options', 'atbar_language');
	register_setting('atbar_options', 'atbar_persistent');
	register_setting('atbar_options', 'atbar_exclude');
	register_setting('atbar_options', 'atbar_exclude_pages');
	register_setting('atbar_options', 'atbar_no_show_banner_top');
	
	//default language setting is en
	
}

function atbar_add_options(){

	add_options_page('Atbar', 'Atbar', 'manage_options', 'atbaroptions', 'atbar_options');
}

function is_language($value) {

	$language_option = get_option('atbar_language');

	if($language_option == $value) {
		echo ("selected");
	}
}

function persistentlaunch() {
	
	$language_option = get_option('atbar_language');
	
	$persistenttoolbar = file_get_contents(dirname(__FILE__).'/atbar-launcher-'.$language_option.'.js');
	
	switch ($language_option){

		default:
			echo ('<script language="javascript">');
				file_get_contents(dirname(__FILE__).'/atbar-launcher-en.js');
			echo ('</script>');
		break;

		case "en":
			echo ('<script language="javascript">'.$persistenttoolbar.'</script>');
		break;

		case "ar":
			echo ('<script language="javascript">'.$persistenttoolbar.'</script>');
		break;
	}

}

function toolbarlauncher() {
	
	$language_option = get_option('atbar_language');
	
	$toolbar = addslashes(file_get_contents(dirname(__FILE__).'/atbar-launcher-'.$language_option.'.php'));
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

function atbar_widget_init() {
	register_sidebar_widget(__('ATbar'), 'add_atbar_widget');
}

function atbar_widget() {

	$language_option = get_option('atbar_language');	
	
	$toolbar = file_get_contents(dirname(__FILE__).'/atbar-launcher-'.$language_option.'.php');
	
	echo '<div id="toolbar-widget">'.$toolbar.'</div>';	
}

function add_atbar_widget($args) {
  extract($args);
  echo $before_widget;
  atbar_widget();
  echo $after_widget;
}

?>