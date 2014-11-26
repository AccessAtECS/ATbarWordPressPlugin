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
	<h2><?php _e('ATbar Options','atbar');?></h2>
	
	<form method="post" action="options.php">
	<?php settings_fields("atbar_options"); ?>
	
	<p><b><?php _e('For instructions on this plugin view the <a href="http://www.atbar.org/wordpress-plugin-guide">ATbar Wordpress Plugin Guide</a>','atbar');?>.</b></p>
	
	<p><?php _e('The ATbar sidebar widget can be added in Appearance, Widgets then adding ATbar to your active Widgets.','atbar');?></p>
	
	
	<table class="form-table">
	
		<!-- select version to use -->
		<tr style="border-top: 1px solid #DFDFDF;">
			<td><h3><?php _e('Version','atbar');?></h3></td>
			<td><?php _e('Select which language version or if you want your own customised Marketplace toolbar. Create your own toolbar at <a href="http://marketplace.atbar.org">http://marketplace.atbar.org</a> or use one of the pre-made toolbars.','atbar');?></td>
		</tr>
		<tr>
			<th scope="row"><?php _e('Select version:','atbar');?></th>
			<td>
				<select name="atbar_version">
					<option value="en"	<?php echo is_version("en"); ?>><?php _e('English','atbar');?></option>
					<option value="ar" <?php echo is_version("ar"); ?>><?php _e('Arabic','atbar');?></option>
					<option value="marketplace"	<?php echo is_version("marketplace");	?>><?php _e('Toolbar from ATbar Marketplace','atbar');?></option>
				</select>
			</td>
		</tr>
			<th><?php _e('Toolbar from ATbar Marketplace:','atbar');?></th>
			<td>
				<input type="text" name="atbar_marketplace_toolbar" value="<?php echo $marketplace_toolbar_option ?>" style="width:350px;">
				<p><?php _e('Copy the install button link in the text box (the full javascript string)','atbar');?></p>
				<p><?php _e('For further instructions view the <a href="http://www.atbar.org/wordpress-plugin-guide">guide</a>.','atbar');?></p>
			</td>
		</tr>
		
		<!-- load atbar launcher -->
		<tr style="border-top: 1px solid #DFDFDF;">
			<td><h3><?php _e('ATbar Launcher','atbar');?></h3></td>
			<td><?php _e('The ATbar launcher is the default button/image at the top of the page and is the standard way of loading ATbar. If you have chosen to use the ATbar Widget or Shortcode else where you are unlikely to want this option on.','atbar');?></td>
		</tr>
		<tr>
			<th scope="row"><?php _e('Load ATbar launcher at the top of the page?','atbar');?></th>
			<td>
				<select name="atbar_launcher_image">
						<option value="No" <?php echo is_banner_show("No"); ?>><?php _e('No','atbar');?></option>
						<option value="Yes" <?php echo is_banner_show("Yes");	?>><?php _e('Yes','atbar');?></option>
				</select>
			</td>
		</tr>
		
		<!-- exclude pages for laucher -->
		<tr>
			<th scope="row"><?php _e('Exclude pages for ATbar launcher?','atbar');?></th>
			<td><input type="checkbox" name="atbar_launcher_exclude" label="exclude pages for launcher" <?php echo is_exclude('atbar_launcher_exclude'); ?>>  <?php _e('Exclude pages for ATbar launcher','atbar');?></td>
		</tr>
		<tr>
			<td></td>
			<td>
				<input type="text" name="atbar_launcher_exclude_pages" value="<?php echo $exclude_launcher_pages_option; ?>" style="width:346px;">
				<p><?php _e('Enter a comma-separated list of page IDs or name to exclude, e.g. 1,2,3 etc.','atbar');?></p>
			</td>
		</tr>
		
		<!-- auto load atbar -->		
		<tr style="border-top: 1px solid #DFDFDF;">
			<td><h3><?php _e('Auto Load ATbar?','atbar');?></h3></td>
			<td><?php _e('These settings will allows ATbar to be loaded on all pages automatically. Any number of pages can be excluded.','atbar');?></td>
		</tr>
		<tr>
			<th scope="row"><?php _e('Auto load ATbar on all pages? (user doesn\'t have to select to load each time)','atbar');?></th>
			<td>
				<select name="atbar_persistent">
					<option value="No" <?php echo is_persistent("No"); ?>><?php _e('No','atbar');?></option>
					<option value="Yes" <?php echo is_persistent("Yes"); ?>><?php _e('Yes','atbar');?></option>
				</select>
			</td>
		</tr>
		
		<!-- exclude pages for auto loader -->
		<tr>
			<th scope="row"><?php _e('Exclude pages for auto load?','atbar');?></th>
			<td><input type="checkbox" name="atbar_exclude" lable="exclude pages for auto loader" <?php echo is_exclude('atbar_exclude'); ?>>  <?php _e('Exclude pages for auto load','atbar');?></td>
		</tr>
				
		<tr>
			<td></td>
			<td>
				<input type="text" name="atbar_exclude_pages" value="<?php echo $exclude_pages_option; ?>" style="width:346px;">
				<p><?php _e('Enter a comma-separated list of page IDs or name to exclude, e.g. 1,2,3 etc.','atbar');?></p>
			</td>
		</tr>
		
		<!-- shortcode options -->			
		<tr style="border-top: 1px solid #DFDFDF;">
			<td><h3><?php _e('Shortcode','atbar');?></h3></td>
			<td><?php _e('Shortcodes are a short piece of text to place in a post or page to run a command. In ATbar\'s case it will add the ATbar launcher image whereever you place','atbar');?> <i>[atbar]</i></td>
		</tr>
		<tr>
			<th scope="row"><?php _e('Align position','atbar');?></th>
			
			<td>
				<select name="atbar_shortcode_align_option">
					<option value="left"	<?php echo is_sc_align("left"); ?>><?php _e('Left','atbar');?></option>
					<option value="center" <?php echo is_sc_align("center"); ?>><?php _e('Center','atbar');?></option>
					<option value="right" <?php echo is_sc_align("right"); ?>><?php _e('Right','atbar');?></option>
				</select>
			</td>
		</tr>
		
		<!-- save form -->		
		<tr valign="top">
			<th scope="row">
				<p class="submit">
					<input type="submit" class="button-primary" style="float:left" value="<?php _e('Save Changes','atbar');?>" />
				</p>
			</th>
		</tr>
		</form>
		
		<form method="post" action="options.php">
			<?php settings_fields('atbar_options'); ?>
			<input type="hidden" name="atbar_persistent" value="<?php get_option('atbar_persistent') ?>" />
		</form>	

	</table>
<?
	
}

?>