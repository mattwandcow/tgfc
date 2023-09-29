
<html>
<?php
include('includes/verify.php');
include('includes/header.php');
require_once('functions/db-functions.php');
require_once('functions/builder-functions.php');

$alt=get_alt_by_id($aid);

?>
<content>
<fieldset>
<form action='edit.php?action=alt-submit' method='post'>
<fieldset>
				<input type='hidden' name='alt_id' value='<?php echo $alt['alts_id'];?>'>
Character ID:	<input type='text' name='ch_id' value='<?php echo $alt['fk_character_id'];?>'><br>
Alt Name:		<input type='text' name='alt_name' value='<?php echo $alt['name'];?>'><br>
Event:			<input type='text' name='alt_event' value='<?php echo $alt['event'];?>'><br>
Link:			<input type='text' name='alt_link' size=60 value='<?php echo $alt['link'];?>'>
</fieldset>
<input type='submit'></form>
</fieldset>
</content>
<?

include('includes/footer.php');

?>