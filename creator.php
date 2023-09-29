<?php
/* TGFC Home */

//Start Session
include('includes/verify.php');

$crid=$_GET['crid'];

//Pulls action from POST or GET. Defaults to POST if Both are valid
	$action = filter_input(INPUT_POST,'action');
	if($action == NULL)
	{
	$action = filter_input(INPUT_GET, 'action');
	}
	$page_title='TGFC Creator Home';
	$target_view='';
switch($action)
{
	case 'single':
		$page_title='TGFC Dossier';
		$target_view='views/creator/view-creator.php';
		break;
	default:
		$page_title='TGFC Creator List';
		$target_view='views/creator/creator-list.php';
		break;
}
	
include($target_view);
?>