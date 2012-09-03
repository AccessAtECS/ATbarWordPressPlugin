<?php

function atbar_options()
{
	
	$version_option = get_option('atbar_version');
	$marketplace_toolbar_option = get_option('atbar_marketplace_toolbar');
	$persistent_option = get_option('atbar_persistent');
	$exclude_option = get_option('atbar_exclude');
	$exclude_pages_option = get_option('atbar_exclude_pages');
	$exclude_option = get_option('atbar_launcher_exclude');
	$exclude_launcher_pages_option = get_option('atbar_launcher_exclude_pages');
	$atbar_launcher_image_option = get_option('atbar_launcher_image');
	$atbar_shortcode_align_option = get_option('atbar_shortcode_align_option');
	
?>
	
	<div class="wrap">
	<div id="icon-options-general" class="icon32"><br /></div>
	<h2>Atbar Options</h2>
	
	<form method="post" action="options.php">
	<? settings_fields("atbar_options"); ?>
	
	<p><b>For instructions on this plugin view the <a href="http://www.atbar.org/wordpress-plugin-guide">ATbar Wordpress Plugin Guide</a>.</b></p>
	
	<p>The ATbar sidebar widget can be added in Appearance, Widgets then adding ATbar to your active Widgets.</p>
	
	
	<table class="form-table">
	
		<!-- select version to use -->
		<tr style="border-top: 1px solid #DFDFDF;">
			<td><h3>Version</h3></td>
			<td>Select which language version or if you want your own customised Marketplace toolbar. Create your own toolbar at <a href="http://marketplace.atbar.org">http://marketplace.atbar.org</a> or use one of the pre-made toolbars.</td>
		</tr>
		<tr>
			<th scope="row">Select version:</th>
			<td>
				<select name="atbar_version">
					<option value="en"	<? echo is_version("en"); ?>>English</option>
					<option value="ar" <? echo is_version("ar"); ?>>Arabic</option>
					<option value="marketplace"	<? echo is_version("marketplace");	?>>Toolbar from ATbar Marketplace</option>
				</select>
			</td>
		</tr>
			<th>Toolbar from ATbar Marketplace:</th>
			<td>
				<input type="text" name="atbar_marketplace_toolbar" value="<? echo $marketplace_toolbar_option ?>" style="width:350px;">
				<p>Copy the install button link in the text box (the full javascript string)</p>
				<p>For further instructions view the <a href="http://www.atbar.org/wordpress-plugin-guide">guide</a>.</p>
			</td>
		</tr>
		
		<!-- load atbar launcher -->
		<tr style="border-top: 1px solid #DFDFDF;">
			<td><h3>ATbar Launcher</h3></td>
			<td>The ATbar launcher is the default button/image at the top of the page and is the standard way of loading ATbar. If you have chosen to use the ATbar Widget or Shortcode else where you are unlikely to want this option on.</td>
		</tr>
		<tr>
			<th scope="row">Load ATbar launcher at the top of the page?</th>
			<td>
				<select name="atbar_launcher_image">
						<option value="No" <? echo is_banner_show("No"); ?>>No</option>
						<option value="Yes" <? echo is_banner_show("Yes");	?>>Yes</option>
				</select>
			</td>
		</tr>
		
		<!-- exclude pages for laucher -->
		<tr>
			<th scope="row">Exclude pages for ATbar launcher?</th>
			<td><input type="checkbox" name="atbar_launcher_exclude" lable="exclude pages for launcher" <? is_exclude('atbar_launcher_exclude'); ?>>  Exclude pages for ATbar launcher</td>
		</tr>
		<tr>
			<td></td>
			<td>
				<input type="text" name="atbar_launcher_exclude_pages" value="<? echo $exclude_launcher_pages_option; ?>" style="width:346px;">
				<p>Enter a comma-separated list of page IDs or name to exclude, e.g. 1,2,3 etc.</p>
			</td>
		</tr>
		
		<!-- auto load atbar -->		
		<tr style="border-top: 1px solid #DFDFDF;">
			<td><h3>Auto Load ATbar?</h3></td>
			<td>These settings will allows ATbar to be loaded on all pages automatically. Any number of pages can be excluded.</td>
		</tr>
		<tr>
			<th scope="row">Auto load ATbar on all pages? (user doesn't have to select to load each time)</th>
			<td>
				<select name="atbar_persistent">
					<option value="No" <? echo is_persistent("No"); ?>>No</option>
					<option value="Yes" <? echo is_persistent("Yes"); ?>>Yes</option>
				</select>
			</td>
		</tr>
		
		<!-- exclude pages for auto loader -->
		<tr>
			<th scope="row">Exclude pages for auto load?</th>
			<td><input type="checkbox" name="atbar_exclude" lable="exclude pages for auto loader" <? is_exclude('atbar_exclude'); ?>>  Exclude pages for auto load</td>
		</tr>
				
		<tr>
			<td></td>
			<td>
				<input type="text" name="atbar_exclude_pages" value="<? echo $exclude_pages_option; ?>" style="width:346px;">
				<p>Enter a comma-separated list of page IDs or name to exclude, e.g. 1,2,3 etc.</p>
			</td>
		</tr>
		
		<!-- shortcode options -->			
		<tr style="border-top: 1px solid #DFDFDF;">
			<td><h3>Shortcode</h3></td>
			<td>Shortcodes are a short piece of text to place in a post or page to run a command. In ATbar's case it will add the ATbar launcher image whereever you place <i>[atbar]</i></td>
		</tr>
		<tr>
			<th scope="row">Align position</th>
			
			<td>
				<select name="atbar_shortcode_align_option">
					<option value="left"	<? echo is_sc_align("left"); ?>>Left</option>
					<option value="center" <? echo is_sc_align("center"); ?>>Center</option>
					<option value="right" <? echo is_sc_align("right"); ?>>Right</option>
				</select>
			</td>
		</tr>
		
		<!-- save form -->		
		<tr valign="top">
			<th scope="row">
				<p class="submit">
					<input type="submit" class="button-primary" style="float:left" value="Save Changes" />
				</p>
			</th>
		</tr>
		</form>
		
		<form method="post" action="options.php">
			<? settings_fields('atbar_options'); ?>
			<input type="hidden" name="atbar_persistent" value="<? get_option('atbar_persistent') ?>" />
		</form>	

	</table>
<?
	
}

?>