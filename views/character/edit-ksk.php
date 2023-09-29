<?php

include('includes/header.php');
require_once('functions/db-functions.php');

$kcid=$_GET['kcid'];
$x=$_POST['char_id'];//##need to add a confirmation value here
if(isset($kcid))//we came to edit a specific character
{
	if(isset($x))//need to update the DB before we print things
	{
		//gather info from Post
		$ksk_chid=addslashes ($_POST['char_id']);// $row['character_id']
		$ksk_title=addslashes ($_POST['ksk_title']);// $row['species']
		$ksk_code=addslashes ($_POST['ksk_text']);// $row['gender']
		$ksk_cr=addslashes ($_POST['cre_id']);// $row['fk_creator_id']
		$ksk_desc=addslashes ($_POST['desc_text']);// $row['open']
		
		update_ksk($kcid, $ksk_chid, $ksk_title, $ksk_code, $ksk_cr, $ksk_desc);
		
		echo "Database Updated!<br>\n";
	}
	//pull all the info
	$result=get_ksk_by_id($kcid);
	print_r($result);
	if (isset($result))//got one
	{
		$row = $result;
		
		$edit_char_str="<h3>Character Dossier</h3>\n";
		$edit_char_str.="<fieldset>\n<form action='edit.php?action=ksk&kcid=".$row['id']."' method='post'>\n<fieldset>\n";
		$edit_char_str.="KSK ID: <input type='text' name='ksk_id' value='".$row['id']."'>Code Creator:";
		$edit_char_str.="<input type='text' name='cre_id' value='".$row['code_creator']."'><br>\n";
		$edit_char_str.="<input type='text' name='char_id' value='".$row['character_id']."'><br>\n";
		$edit_char_str.='Code Title:<input type="text" name="ksk_title" value="'.htmlspecialchars($row['ksk_title']).'">';
		$edit_char_str.="Code:<br><textarea name='ksk_text'  rows='6' cols='60'>".$row['ksk']."</textarea><br>\n";
		$edit_char_str.="Description:<br><textarea name='desc_text'  rows='6' cols='60'>".$row['description']."</textarea><br>\n";
		$edit_char_str.="</fieldset>\n<input type='submit'></form>\n";	
		$edit_char_str.="<a href='character.php?action=ksk&id=$kcid'>View Updated KSK Code</a><br>\n";
		$edit_char_str.="<a href='character.php?id=".$row['character_id']."'>View Updated Character</a><br>\n</fieldset>\n";

		echo $edit_char_str;
	}
	else
		echo "Error: No character designated"; 
}

mysqli_close($connection);
?>