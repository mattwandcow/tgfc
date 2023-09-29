<?php
/* TGFC Admin Page */

include('includes/verify.php');
require_once('functions/db-functions.php');
$SEASON='3';
//Pulls action from POST or GET. Defaults to POST if Both are valid
	$action = filter_input(INPUT_POST,'action');
	if($action == NULL)
	{
	$action = filter_input(INPUT_GET, 'action');
	}
	$page_title='PHP Motors Home';
	$target_view='';

		if($verified)
		{
switch($action)
{
	case 'statics':
			$page_title='Add Static';
			$target_view='views/events/add-statics.php';
		break;
	case 'statics-submit':
		$crid	=$_POST['cr_id'];
		$name	=$_POST['static_name'];
		$event	=$_POST['static_event'];
		$link	=$_POST['static_link'];
		$result=add_statics($crid, $name, $event, $link);
		header("location:creator.php?action=single&crid=$crid");
		break;
	case 'creator':
			$page_title='Add Creator';
			$target_view='views/creator/add-creator.php';
		break;
	case 'add_creator':
		$name	=$_POST['cre_name'];
		$bday	=$_POST['cre_bday'];
		$join	=$_POST['cre_join'];
		$link	=$_POST['cre_link'];
		$result=add_new_creator($name, $bday, $join, $link);
		$newID=get_recent_creator_id();
		header("location:creator.php?action=single&crid=$newID");
		break;
	case 'character':
			$page_title='Add character';
			$target_view='views/character/add-character.php';
		break;
	case 'add_character':
		$crid	=$_POST['cre_id'];
		$chname	=$_POST['char_name'];
		$chgend	=$_POST['char_gender'];
		$chspec	=$_POST['char_species'];
		$chopen	=$_POST['char_open'];
		$chdesc	=$_POST['char_text'];
		$chlink	=$_POST['char_link'];
		
		if (isset($_POST['forbbidens']) && $_POST['forbbidens'] == 'forbid') 
		{	
			$chforb=1;
		}
		else
			$chforb=0;
		
		if (isset($_POST['secrets']) && $_POST['secrets'] == 'secret') 
		{	
			$chsecr=1;
		}
		else
			$chsecr=0;
		$result=add_new_character($crid, $chname, $chgend, $chspec, $chopen, $chforb, $chsecr, $chdesc, $chlink, $SEASON);
		//kinda assuming nothing went wrong?
		header("location:index.php");
		break;
	
	case 'alt':
			$page_title='Add Alternate';
			$target_view='views/character/add-alt.php';
		break;
	case 'alt-submit':
		$chid	=$_POST['ch_id'];
		$name	=$_POST['alt_name'];
		$event	=$_POST['alt_event'];
		$link	=$_POST['alt_link'];
		$result=add_alt_card($chid, $name, $event, $link);
		header("location:character.php?id=$chid");
		break;
	case '500':
		$page_title='Server Error';
		$target_view='view/500.php';
		break;
	case 'event_character':
		$page_title='Add Alternate';
		$target_view='views/character/add-event-character.php';
		break;
	case 'event_character_submit':
		$crid	=$_POST['cre_id'];
		$name	=$_POST['char_name'];
		$event	=$_POST['char_event'];
		$link	=$_POST['char_link'];
		$chgend	=$_POST['char_gender'];
		$chspec	=$_POST['char_species'];
		
		//add character
		$result=add_new_character($crid, $name, $chgend, $chspec, "Other", 0, 0, "Only Card is an Event Card", $link, $SEASON);
		//get $chid
		$chid=get_recent_character_id();
		//add alt of that character
		$result=add_alt_card($chid, $name, $event, $link);
		header("location:character.php?id=$chid");
		break;
	default:
		$page_title='TGFC Home Page';
		$target_view='views/character/list-character.php';
}
}
		else
		{
			$page_title='TGFC Login';
			$target_view='views/admin/login.php';
		}
include($target_view);
?>