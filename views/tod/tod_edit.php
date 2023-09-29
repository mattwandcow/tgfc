<?php
include('includes/verify.php');
include('includes/header.php');
require_once('functions/tod-db-functions.php');
require_once('functions/builder-functions.php');
?>

<content>
<?php
$y=$_GET['id'];
$row=get_tod_by_id($y)
?>
<fieldset>
<form action='event.php?action=edit_tod_submit&id=<?php echo $row['id'];?>' method='post' enctype="multipart/form-data">
<fieldset>
Parent:<input type='text' name='parent' value='<?php echo $row['parent'];?>'><br>
Character:<input type='text' name='person' value='<?php echo $row['person'];?>'><br>
Published: <input type='text' name='date' value='<?php echo $row['date'];?>'><br>
Type:<input type='text' name='type' value='<?php echo $row['type'];?>'><br>
Task:<br><textarea name='task_text'  rows='6' cols='60'><?php echo $row['task'];?></textarea><br>
Image:<input type='text' name='content' value='<?php echo $row['content'];?>'><br>
Challenge:<br><textarea name='challenge'  rows='6' cols='60'><?php echo $row['challenge'];?></textarea><br>
Season: <input type='text' name='season' value='<?php echo $row['season'];?>'><br>
<input type='hidden' name='id' size=10 value='<?php echo $row['id'];?>'>
</fieldset>
<input type='submit'></form>
</fieldset>
</content>

<?

include('includes/footer.php');

?>