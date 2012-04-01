<?php

function atbar_options()
{
	
	$persistent_option = get_option('atbar_persistent');
	
	// display options page
	echo ('<div class="wrap">
	<div id="icon-options-general" class="icon32"><br /></div>
	<h2>Atbar Options</h2>

	<form method="post" action="options.php">');
	settings_fields('atbar_options');
	
	echo ('
	<table class="form-table">
		<tr valign="top">
			<th scope="row">Is ATbar persistent on all pages:</th>
			<td><b>'.$persistent_option.'</b></td>
		</tr>
		<tr valign="top">
			<th scope="row">Load ATbar on all pages?</th>
			<td>
				<select name="atbar_persistent" width="60px">
					<option value="false">No</option>
					<option value="true">Yes</option>
				</select>
			</td>
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

