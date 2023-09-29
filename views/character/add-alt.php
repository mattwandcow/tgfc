
<html>
<?php
include('includes/verify.php');
include('includes/header.php');
require_once('functions/db-functions.php');
require_once('functions/builder-functions.php');
?>
<content>
<fieldset>
<form action='add.php?action=alt-submit' method='post'>
<fieldset>
Character ID:	<input type='text' name='ch_id' value='<?php echo $_GET['id'];?>'><br>
Alt Name:		<input type='text' name='alt_name' value=''><br>
Event:			<input type='text' name='alt_event' value=''><br>
Link:			<input type='text' name='alt_link' size=60 value=''>
</fieldset>
<input type='submit'></form>
</fieldset>
</content>
<?

include('includes/footer.php');

?>