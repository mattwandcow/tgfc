<?php
/* TGFC Admin Page */

include('includes/verify.php');
require_once('functions/db-functions.php');

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
	case 'alt-submit':
		$aid	=$_POST['alt_id'];
		$chid	=$_POST['ch_id'];
		$name	=$_POST['alt_name'];
		$event	=$_POST['alt_event'];
		$link	=$_POST['alt_link'];
		$result=update_alt($aid, $chid, $name, $event, $link);
		header("location:character.php?action=single&id=$chid");
		break;
	case 'alt':
		$page_title='Edit Alt';
		$target_view='views/character/edit-alt.php';
		$aid=$_GET['aid'];
		if(!isset($aid)) header("location:index.php");
		break;
	case 'static':
		$page_title='Edit Creator';
		$target_view='views/events/edit-statics.php';
		$stid=$_GET['stid'];
		if(!isset($stid)) header("location:creator.php");
		break;
	case 'statics-submit':
		$stid	=$_POST['static_id'];
		$crid	=$_POST['cr_id'];
		$name	=$_POST['static_name'];
		$event	=$_POST['static_event'];
		$link	=$_POST['static_link'];
		$result=update_static($stid, $crid, $name, $event, $link);
		header("location:creator.php?action=single&crid=$crid");
		break;
	case 'creator':
			$page_title='Edit Creator';
			$target_view='views/creator/edit-creator.php';
		break;
	case 'character':
			$page_title='Edit Character';
			$target_view='views/character/edit-character.php';
		break;
	case 'ksk':
			$page_title='Edit Kiskae Codes';
			$target_view='views/character/edit-ksk.php';
		break;
	
	case '500':
		$page_title='Server Error';
		$target_view='view/500.php';
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