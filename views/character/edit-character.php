<?php

include('includes/header.php');
require_once('functions/db-functions.php');

$chid=$_GET['chid'];
$x=$_POST['char_id'];//##need to add a confirmation value here
if(isset($chid))//we came to edit a specific character
{
	if(isset($x))//need to update the DB before we print things
	{
		//gather info from Post
		$chr_id=$_POST['char_id'];// $row['character_id']
		$chr_cr=$_POST['fk_cre_id'];// $row['fk_creator_id']
		$chr_sp=$_POST['char_species'];// $row['species']
		$chr_gn=$_POST['char_gender'];// $row['gender']
		$chr_op=$_POST['char_open'];// $row['open']
		$chr_nm=$_POST['char_name'];// $row['name']
		$chr_tx=$_POST['char_text'];// $row['text']
		$chr_lk=$_POST['char_link'];// $row['link']
		if (isset($_POST['char_forbiddens']) && $_POST['char_forbiddens'] == 'forbid') 
		{	
			$chr_fb=1;
		}
		else
			$chr_fb=0;
		
		if (isset($_POST['char_secrets']) && $_POST['char_secrets'] == 'secret') 
		{	
			$chr_sc=1;
		}
		else
			$chr_sc=0;
		update_character($chr_id, $chr_cr, $chr_nm, $chr_sp, $chr_gn, $chr_op, $chr_tx, $chr_lk, $chr_fb, $chr_sc);
		
		echo "Database Updated!<br>\n";
	}
	//pull all the info
	$result=get_character_by_id($chid);
	//print_r($result);
	if (isset($result))//got one
	{
		$row = $result;
		
		$edit_char_str="<h3>Character Dossier</h3>\n";
		$edit_char_str.="<fieldset>\n<form action='edit.php?action=character&chid=".$row['character_id']."' method='post'>\n<fieldset>\n";
		$edit_char_str.="Ch ID: <input type='text' name='char_id' value='".$row['character_id']."'>Cre ID:";
		$edit_char_str.="<input type='text' name='fk_cre_id' value='".$row['creator_id']."'><br>\n";
		$edit_char_str.='Character Name:<input type="text" name="char_name" value="'.htmlspecialchars($row['character_name']).'">';
		$edit_char_str.="Open:<input type='text' name='char_open' value='".$row['open']."'><br>\n";
		$edit_char_str.="Gender:<input type='text' name='char_gender' value='".$row['gender']."'>\n";
		$edit_char_str.="Species:<input type='text' name='char_species' value='".$row['species']."'><br>\n";
		
		$edit_char_str.="Forbiddens:<input type='checkbox' name='char_forbiddens' value='forbid'";
		if($row['forbiddens']==1)
		{
			$edit_char_str.=" checked";
		}
		$edit_char_str.="><br>\n";
		
		$edit_char_str.="Secrets:<input type='checkbox' name='char_secrets' value='secret'";
		if($row['secrets']==1)
		{
			$edit_char_str.=" checked";
		}
		$edit_char_str.="><br>\n";
		
		
		$edit_char_str.="Character Information:<br><textarea name='char_text'  rows='6' cols='60'>".$row['text']."</textarea><br>\n";
		$edit_char_str.="DA Fight Card URL:<br><input type='text' name='char_link' size=60 value='".$row['link']."'><br>\n";
		$edit_char_str.="</fieldset>\n<input type='submit'></form>\n";
		$edit_char_str.="<a href='character.php?id=$chid'>View Updated Character</a><br>\n</fieldset>\n";

		echo $edit_char_str;
	}
	else
		echo "Error: No character designated"; 
}

?>