<?php

// functions

function atbar_css() {
	echo ('<link rel="stylesheet" type="text/css" media="all" href="'.plugin_dir_url(__FILE__).'atbar.css">');
}

function atbar_register_settings(){
	register_setting('atbar_options', 'atbar_version');
	register_setting('atbar_options', 'atbar_marketplace_toolbar');
	register_setting('atbar_options', 'atbar_persistent');
	register_setting('atbar_options', 'atbar_exclude');
	register_setting('atbar_options', 'atbar_exclude_pages');
	register_setting('atbar_options', 'atbar_launcher_exclude');
	register_setting('atbar_options', 'atbar_launcher_exclude_pages');
	register_setting('atbar_options', 'atbar_launcher_image');
	register_setting('atbar_options', 'atbar_shortcode_align_option');
}

function atbar_add_options(){
	add_options_page('Atbar', 'Atbar', 'manage_options', 'atbaroptions', 'atbar_options');
}

function is_version($value) {
	$version = get_option('atbar_version');
	return ($version == $value) ? "selected" : "";
}

function is_persistent($value) {
	$persistent_option = get_option('atbar_persistent');
	return ($persistent_option == $value) ? "selected" : "";
}

function is_sc_align($value) {
	$align_option = get_option('atbar_shortcode_align_option');
	return ($align_option == $value) ? "selected" : "";
}

function is_exclude($setting) {
	$exclude_option = get_option($setting);
	return ($exclude_option == "on") ? "checked" : "unchecked";
}

function is_banner_show($value) {
	$launcher_image_option = get_option('atbar_launcher_image');
	return ($launcher_image_option == $value) ? "selected" : "";
}

function add_toolbar(){
	
	$launcher_image_option = get_option('atbar_launcher_image');
	$persistent_option = get_option('atbar_persistent');
	
	// adds persistent toolbar
	if ($persistent_option == "Yes"){
		exclude_pages('atbar_exclude', 'atbar_exclude_pages', 'persistentlaunch');
	}
	// adds toolbar launcher
	elseif ($launcher_image_option == "Yes"){
		exclude_pages('atbar_launcher_exclude', 'atbar_launcher_exclude_pages', 'toolbarlauncher');
	}
}

function toolbarlauncher() {
	
	$version = get_option('atbar_version');
	
	switch ($version){

		default:
		case "en":
			$js = file_get_contents(dirname(__FILE__).'/atbar-launcher-en.js');
		break;

		case "ar":
			$js = file_get_contents(dirname(__FILE__).'/atbar-launcher-ar.js');
		break;
		
		case "marketplace":
			$js = get_option('atbar_marketplace_toolbar');
		break;
	}
	
	$launcher = '<a href="'.$js.'" id="toolbar-launch" title="Launch ATbar to adjust this webpage, have it read aloud and other functions."><img src="https://core.atbar.org/resources/img/launcher.png" alt="ATbar"></a>';
	$launcher = addslashes($launcher);
	
	echo ('<script language="javascript">
		toolbarholder = document.createElement("div");
		toolbarholder.id = "toolbar-holder";
		toolbarholder.innerHTML = "'.$launcher.'";
		document.body.insertBefore(toolbarholder, document.body.firstChild);
		</script>');
}

function persistentlaunch() {
	
	$version = get_option('atbar_version');
	
	switch ($version){

		default:
		case "en":
			$ptoolbar = file_get_contents(dirname(__FILE__).'/atbar-launcher-en.js');
		break;

		case "ar":
			$ptoolbar = file_get_contents(dirname(__FILE__).'/atbar-launcher-ar.js');
		break;
		
		case "marketplace":
			$ptoolbar = get_marketplace_toolbar(get_option('atbar_marketplace_toolbar'));
			
			if($ptoolbar == NULL){
				$ptoolbar = file_get_contents(dirname(__FILE__).'/atbar-launcher-en.js');
			}
		break;
	}

	echo ('<script language="javascript">'.$ptoolbar.'</script>');

}

function shortcode_launcher() {
	
	$version = get_option('atbar_version');
	$align = get_option('atbar_shortcode_align_option');
	
	switch ($version){

		default:
		case "en":
			$js = file_get_contents(dirname(__FILE__).'/atbar-launcher-en.js');
		break;

		case "ar":
			$js = file_get_contents(dirname(__FILE__).'/atbar-launcher-ar.js');
		break;
		
		case "marketplace":
			$js = get_option('atbar_marketplace_toolbar');
		break;
	}
	
	$image = '<img src="https://core.atbar.org/resources/img/launcher.png" alt="ATbar">';
	$url = '<a href="'.$js.'" id="toolbar-launch-shortcode" title="Launch ATbar to adjust this webpage, have it read aloud and other functions.">'.$image.'</a>';
	$launcher = '<p style="text-align:'.$align.';">'.$url.'</p>';
	
	return $launcher;
}

function get_marketplace_toolbar($js) {

	// gets js file of toolbar from the marketplace
	$js = strchr($js,"http");
	$js = explode(".user.js",$js);
	$js = file_get_contents($js[0].'.user.js');
	
	return $js;	
}

function create_exclude_array($pages) {
	
	$pages = get_option($pages);
	$exclude_array = explode (',', $pages);

	return $exclude_array;
}

function exclude_pages($setting, $pages, $function) {

	$array = create_exclude_array($pages);
	$postid = strval(get_the_ID());
	$exclude_option = get_option($setting);

	if($exclude_option == "on") {
		if(!in_array($postid, $array)) {
			add_action('get_footer', $function);
		}
	}
	else {
		add_action('get_footer', $function);
	}
}


?>