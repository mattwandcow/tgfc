<html>
<?php

include('includes/header.php');
require_once('functions/db-functions.php');

$crid=$_GET['crid'];

if(!isset($crid))
{
	//blow upt
}
else
{
	?>
<fieldset>
<form action='add.php' method='post'>
<fieldset>
Character Name:	<input type='text' name='char_name' value=''><br>
Gender:			<input type='text' name='char_gender' value=''><br>
Species:		<input type='text' name='char_species' value=''><br>
Open:			<input type='text' name='char_open' value=''><br>
Forbiddens:		<input type='checkbox' name='forbbidens' value='forbid'><br>
Secrets:		<input type='checkbox' name='secrets' value='secret'><br>
Character Information:<br>
				<textarea name='char_text'  rows='6' cols='60'></textarea><br>
DA Fight Card URL:<br>
					<input type='text' name='char_link' size=60 value=''><br>
<input type='hidden' name='cre_id' value='<?php echo $crid;?>'>
<input type='hidden' name='action' value='add_character'>
</fieldset>
<input type='submit'></form>
</fieldset>
<?php
}



include('includes/footer.php');
?>