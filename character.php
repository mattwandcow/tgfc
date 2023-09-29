<?php
/* TGFC Home */
include('includes/verify.php');

//We need a chid to do anything on this page.
$chid=$_GET['id'];
if(!isset($chid))
{
	header("Location: index.php");
}
//Pulls action from POST or GET. Defaults to POST if Both are valid
	$action = filter_input(INPUT_POST,'action');
	if($action == NULL)
	{
	$action = filter_input(INPUT_GET, 'action');
	}
	$page_title='TGFC Character Home';
	$target_view='';

switch($action)
{
	case 'single':
			$page_title='TGFC Dossier';
			$target_view='views/character/view-character.php';
		break;
	case 'ksk':
			$page_title='KSK Code';
			$target_view='views/character/view-ksk.php';
		break;
	case 'alts':
			$page_title='Event Alts';
			$target_view='views/character/alt-characters.php';
		break;
	default:
			$page_title='TGFC Dossier';
			$target_view='views/character/view-character.php';
		break;
}
	
include($target_view);
?>