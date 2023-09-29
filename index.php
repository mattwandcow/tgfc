<?php
/* TGFC Home */

//Start Session
include('includes/verify.php');

//Pulls action from POST or GET. Defaults to POST if Both are valid
	$action = filter_input(INPUT_POST,'action');
	if($action == NULL)
	{
	$action = filter_input(INPUT_GET, 'action');
	}
	$page_title='PHP Motors Home';
	$target_view='';
switch($action)
{
	case '500':
		$page_title='Server Error';
		$target_view='view/500.php';
		break;

	default:
		$page_title='TGFC Home Page';
		$target_view='views/character/list-character.php';
}
	
include($target_view);
?>