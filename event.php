<?php

// ini_set('display_errors', 1);
// ini_set('display_startup_errors', 1);
// error_reporting(E_ALL);

/* TGFC Home */
//Start Session
include('includes/verify.php');
include('functions/tod-db-functions.php');

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
	case 'event':
		$event_name=str_replace('-', ' ',addslashes($_GET['event']));
		$page_title='Event Participants';
		$target_view='views/events/view-event.php';
		break;
	case 'alt-list':
		$page_title='Events with Alts';
		$target_view='views/events/view-alt-list.php';
		break;
	case 'tod_add_page':
		$page_title='Add a TOD';
		$target_view='views/tod/tod_add.php';
		break;
	case 'tod_add':
		//Start Add Image
		$target_dir="images/tod/";
		$target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
		$uploadOk = 1;
		$imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));
		// Check if image file is a actual image or fake image
		if(isset($_POST["submit"])) 
		{
			$check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
			if($check !== false) 
			{
				//echo "File is an image - " . $check["mime"] . ".";
				$uploadOk = 1;
			} 
			else 
			{
				echo "File is not an image.";
				$uploadOk = 0;
			}
		}
		if (file_exists($target_file))
		{
			echo "File already uploaded.<br>\n";
			$uploadOk = 0;
		}
		if ($uploadOk == 0) 
		{
			echo "Sorry, your file was not uploaded.";
		} 
		else // if everything is ok, try to upload file
		{
			if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) 
			{
				//echo "The file ". htmlspecialchars( basename( $_FILES["fileToUpload"]["name"])). " has been uploaded.<br>\n";
			} 
			else 
			{
				echo "Sorry, there was an error uploading your file.<br>\n";
			}
		}
		//End Add Image
		//echo "Image uploaded?";
		$cre_parent=addslashes($_POST['parent']);
		$cre_char=addslashes($_POST['person']);
		$cre_pub=addslashes($_POST['date']);
		$cre_type=addslashes($_POST['type']);
		$cre_task=addslashes($_POST['task_text']);
		$cre_chal=addslashes($_POST['challenge']);
		
		
		add_tod($cre_parent, $cre_char, $cre_pub, $cre_type, $cre_task, $cre_chal, $target_file);
		
		$target_view='views/tod/tod_main.php';
		break;

	case 'truth_or_dare':
		$page_title='TGFC Truth or Dare!';
		$target_view='views/tod/tod_main.php';
		break;
	case 'tod_search':
		$page_title='Search Truth or Dare!';
		$target_view='views/tod/tod_search.php';
		break;
	case 'edit_tod':

		$page_title='Editing a Truth or Dare!';
		$target_view='views/tod/tod_edit.php';
		break;
	case 'edit_tod_submit':
		$cre_id=addslashes($_POST['id']);
		$cre_parent=addslashes($_POST['parent']);
		$cre_char=addslashes($_POST['person']);
		$cre_pub=addslashes($_POST['date']);
		$cre_type=addslashes($_POST['type']);
		$cre_task=addslashes($_POST['task_text']);
		$cre_con=addslashes($_POST['content']);
		$cre_chal=addslashes($_POST['challenge']);
		$cre_season=addslashes($_POST['season']);
		//function update_tod($id, $parent, $character, $date, $type, $task, $challenge, $content, $season=DEFAULT_SEASON)
		update_tod($cre_id, $cre_parent, $cre_char, $cre_pub, $cre_type, $cre_task, $cre_chal, $cre_con, $cre_season);
		$target_view='views/tod/tod_main.php';
		break;
	case 'tod_all':
	case 'tod_stats':
		$page_title='All Dares and Truths!';
		$target_view='views/tod/tod_all.php';
		break;
	default:
		$page_title='TGFC Creator List';
		$target_view='views/events/event-list.php';
		break;
}

/**To Do**
	TOD All
	TOD Edit
	TOD Stats
//*/

include($target_view);
?>