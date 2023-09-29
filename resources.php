<?php
/* TGFC Admin Page */

include('includes/verify.php');
require_once('functions/db-functions.php');
$SEASON='2p5';
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
	case 'add-resource':
		if($verified)
		{
			$page_title='TGFC Admin Panel';
			$target_view='views/admin/add_resource.php';
		}
		else
		{
			$page_title='TGFC Login';
			$target_view='views/admin/login.php';
		}	
		break;
	case 'resource-submit':
		if($verified)
		{
			$name	=$_POST['res_name'];
			$event	=$_POST['res_event'];
			$link	=$_POST['res_link'];
			$result=add_resource($name, $event, $link);
			header("location:resources.php");
		}
		else
		{
			$page_title='TGFC Login';
			$target_view='views/admin/login.php';
		}	
		break;
	case 'random':
			$page_title='Random Character';
			$target_view='views/character/random-character.php';
		break;
	default:
		$page_title='TGFC Home Page';
		$target_view='views/admin/resource_list.php';
}

include($target_view);
?>