<html>
<?php
include('includes/verify.php');
include('includes/header.php');
require_once('functions/db-functions.php');
require_once('functions/builder-functions.php');
?>
<content>

<fieldset>
<form action='add.php?action=add_creator' method='post'>
<fieldset>
Creator Name:		<input type='text' name='cre_name' value=''><br>
Creator Bday:		<input type='text' name='cre_bday' value=''><br>
Creator Join Date:	<input type='text' name='cre_join' value=''><br>
DA URL:<br>			
					<input type='text' name='cre_link' size=60 value=''><br>
<input type='hidden' name='cre_id' size=10 value='-1'>
</fieldset>
<input type='submit'></form>
</fieldset>

</content>
<?

include('includes/footer.php');

?>