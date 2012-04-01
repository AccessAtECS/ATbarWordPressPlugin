<?php

function atbar_options()
{
	
	$persistent_option = get_option('atbar_persistent');
	$exclude_option = get_option('atbar_exclude');
	$exclude_pages_option = get_option('atbar_exclude_pages');
	$no_show_banner_top_option = get_option('atbar_no_show_banner_top');
	
	// display options page
	echo ('<div class="wrap">
	<div id="icon-options-general" class="icon32"><br /></div>
	<h2>Atbar Options</h2>

	<form method="post" action="options.php">');
	settings_fields('atbar_options');
	
	echo ('
	<table class="form-table">
		<tr valign="top">
			<th scope="row">Load ATbar launcher at the top of the page? (select yes for when using the ATbar widget)</th>
			<td>
				<select name="atbar_no_show_banner_top" width="60px">
					<option value="No" ');	// checks whether no show banner top is yes or no
											// sets drop down box to setting selected
											echo banner_show("No");	echo ('>No</option>
					<option value="Yes" '); echo banner_show("Yes");	echo ('>Yes</option>
				</select>
			</td>
		</tr>');
		
		if ($no_show_banner_top_option == "No") {
			echo ('
			<tr valign="top">
				<td>
					<div class="error fade">
					<p><b>ATbar launcher image at the top of the page is turned off.</b></p>
					</div>
				</td>
			</tr>');
		}
			
		echo ('
		<tr valign="top">
			<th scope="row">Is ATbar persistant on all pages:</th>
			<td><b>'.$persistent_option.'</b></td>
		</tr>
		
		<tr valign="top">
			<th scope="row">Load ATbar on all pages?</th>
			<td>
				<select name="atbar_persistent" width="60px">
					<option value="No" ');	// checks whether persistent option is yes or no
											// sets drop down box to setting selected
											echo is_persistent("No");	echo ('>No</option>
					<option value="Yes" '); echo is_persistent("Yes");	echo ('>Yes</option>
				</select>
			</td>
		</tr>
				
		<tr>
			<th scope="row">Exclude pages?</th>
			<td><input type="checkbox" name="atbar_exclude" lable="exclude pages" '); is_exclude();
			
			echo ('			
			>Exclude pages</td>
		</tr>
				
		<tr>
			<td></td>
			<td><input type="text" name="atbar_exclude_pages" value="'.$exclude_pages_option.'" style="width:346px;">
			<br />
			Enter a comma-separated list of page IDs to exclude, e.g. 1,2,3</td>
		</tr>	
		
		<tr valign="top">
			<th scope="row">
				<p class="submit">
					<input type="submit" class="button-primary" style="float:left" value="Save Changes" />
				</p>
			</th>
		</tr>
		</form>
		
		<br />
		
		<form method="post" action="options.php">');
		settings_fields('atbar_options');
		echo('
		<input type="hidden" name="atbar_persistent" value="'.get_option('atbar_persistent').'" />
		</form>	
	</table>');
}

?>

