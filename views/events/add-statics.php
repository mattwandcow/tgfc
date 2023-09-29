
<html>
<?php
include('includes/verify.php');
include('includes/header.php');
require_once('functions/db-functions.php');
require_once('functions/builder-functions.php');
?>
<content>
<fieldset>
<form action='add.php?action=statics-submit' method='post'>
<fieldset>
Creator ID:	<input type='text' name='cr_id' value='<?php echo $_GET['id'];?>'><br>
Item Name:		<input type='text' name='static_name' value=''><br>
Event:			<input type='text' name='static_event' value=''><br>
Link:			<input type='text' name='static_link' size=60 value=''>
</fieldset>
<input type='submit'></form>
</fieldset>
</content>
<?

include('includes/footer.php');

?>