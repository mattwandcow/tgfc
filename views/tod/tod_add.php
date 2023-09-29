<fieldset>
<form action='event.php?action=tod_add&id=<?php echo $_GET['parent'];?>' method='post' enctype="multipart/form-data">
<fieldset>
Character:<input type='text' name='person' value=''><br>
Published: <input type='text' name='date' value=''><br>
Type:<input type='text' name='type' value=''><br>
Task:<br><textarea name='task_text'  rows='6' cols='60'></textarea><br>
Challenge:<br><textarea name='challenge'  rows='6' cols='60'></textarea><br>
<input type='hidden' name='parent' size=10 value='<?php echo $_GET['parent'];?>'>
File: 	<input type="file" name="fileToUpload" id="fileToUpload">
</fieldset>
<input type='submit'></form>
</fieldset>
<?php
include 'tgfc_footer.php';
?>