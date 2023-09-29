
<html>
<?php
include('includes/verify.php');
include('includes/header.php');
require_once('functions/db-functions.php');
require_once('functions/builder-functions.php');

$static=get_static_by_id($stid);

?>
<content>
<fieldset>
<form action='edit.php?action=statics-submit' method='post'>
<fieldset>
Creator ID:		<input type='text' name='cr_id' value='<?php echo $static['fk_creator_id'];?>'><br>
Item Name:		<input type='text' name='static_name' value='<?php echo htmlspecialchars($static['name']);?>'><br>
Event:			<input type='text' name='static_event' value='<?php echo $static['event'];?>'><br>
Link:			<input type='text' name='static_link' size=60 value='<?php echo $static['link'];?>'>
				<input type='hidden' name='static_id' value='<?php echo $static['statics_id'];?>'>
</fieldset>
<input type='submit'></form>
</fieldset>
</content>
<?

include('includes/footer.php');

?>