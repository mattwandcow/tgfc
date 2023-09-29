<html>
<?php
include('includes/verify.php');
include('includes/header.php');
require_once('functions/db-functions.php');
require_once('functions/builder-functions.php');
?>
<content>
<fieldset>
<form action='resources.php?action=resource-submit' method='post'>
<fieldset>
Name:			<input type='text' name='res_name' value=''>
Event:			<input type='text' name='res_event' value=''>
Link:			<input type='text' name='res_link' value=''>
</fieldset>
<input type='submit'></form>
</fieldset>
</content>
<?

include('includes/footer.php');

?>