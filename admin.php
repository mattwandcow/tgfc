<?php
/* TGFC Admin Page */

ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

//Start Session
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
switch($action)
{
	case 'panel':
		if($verified)
		{
			$page_title='TGFC Admin Panel';
			$target_view='views/admin/admin_panel.php';
		}
		else
		{
			$page_title='TGFC Login';
			$target_view='views/admin/login.php';
		}	
		break;
	case 'login':
			$page_title='TGFC Login';
			$target_view='views/admin/login.php';
		break;
	case 'login-submit':
	
		//For testing purposes
		//set_user_password('mattwandcow',password_hash("Matt", PASSWORD_DEFAULT));
		
		$uid	=$_POST['Username'];
		$pass	=$_POST['Password'];
		
		if($uid == "" || $pass=="")
		{
			$msg="<span style='color:red'>Invalid Login Details</span>";	
		}
		else
		{
			$user_file=get_user_login($uid);
			$hashed_pass=$user_file['password'];
			$success=password_verify($pass,$hashed_pass);
			if($success)
			{
				$_SESSION['UserData']['Username']=$user_file['username'];
				header("location:index.php"); 
				exit;
			}
			elseif($user_file=="")
			{
				$msg="<span style='color:red'>Invalid Login Details</span>";
				//currently, hiding the fact that your username is not in the DB
				//might be returning an error if you don't match case for uid? #TODO priority medium
			}
			else
			{
				$msg="<span style='color:red'>Invalid Login Details</span>";
				//other error, probably password mismatch
			}
			
			//echo $_SESSION['UserData']['Username'];
		
		}
		$page_title='TGFC Login';
		$target_view='views/admin/login.php';
		break;
	case 'logout':
			session_destroy(); /* Destroy started session */
			header("location:index.php"); 
			exit;
		break;
		
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