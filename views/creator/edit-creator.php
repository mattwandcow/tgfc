<?php

include('includes/header.php');
require_once('functions/db-functions.php');


// There are two types of pages that come here.
// 		First, when creating a new Creator, we might as well come here and be right into editing it
// 		Second, when coming to this page to edit, we need to display all of our options
// 		Third, when editing a Creator, we come back here to save our work and redisplay

$crid=$_GET["crid"]; 				// checks the URL for an id, saving it to $y if it exists

$n=$_POST['up_name'];
if (isset($n))
{
	$cre_id=	$_POST['up_id'];
	$cre_name=	$_POST['up_name'];
	$cre_link=	$_POST['up_link'];
	$cre_bday=	$_POST['up_bday'];
	$cre_join=	$_POST['up_join'];
	echo "$cre_id, $cre_name, $cre_join, $cre_bday, $cre_link";
	update_creator($cre_id, $cre_name, $cre_join, $cre_bday, $cre_link);
}

$result=get_creator_by_id($crid);
//print_r($result);
if (isset($result))
{
$row = $result;
echo "<fieldset>\n";
echo "<form action='edit.php?action=creator&crid=".$crid."' method='post'>\n";
echo "<fieldset>\n";
echo "Cre ID:<input type='text' name='up_id' value='".$row['creator_id']."'>Cre ID:<input type='text' name='up_name' value='".$row['name']."'><br>";
echo "Bday: <input type='text' name='up_bday' value='".$row['bday']."'>";
echo "Join: <input type='text' name='up_join' value='".$row['joined']."'>";
echo "Link: <input type='text' name='up_link' value='".$row['link']."'>";
echo "</fieldset>\n";
echo "<input type='submit'></form>\n";
echo "<a href='creator.php?id=".$row['creator_id']."'>Return to Creator Page</a>";
echo "</fieldset>\n";
}
else
	echo "<p>No Creator with that ID</p>";


?>