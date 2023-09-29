<html>
<?php
include('includes/verify.php');
include('includes/header.php');
require_once('functions/tod-db-functions.php');
require_once('functions/builder-functions.php');
?>
<content>
<?php

$y=$_GET['id'];

if (!isset($y))
{
	$y=0;
}

//get_tod_by_id
//get_tod_list_by_parent


$row=get_tod_by_id($y);	//$y is the id of the post. -1 for header, 0 for a parentless, and numbers branching out. the second digit is the season

	echo "<h1>Truth or Dare</h1>\n";
	
	echo "<p><a href='event.php?action=truth_or_dare'>Back to Top</a>\n";
	if($row['id']>0)
	{
		echo "| <a href='event.php?action=truth_or_dare&id=".$row['parent']."'>Parent ToD</a>\n";
	}
	echo " | <a href='?action=tod_search'>Search</a>";
	echo " | <a href='?action=tod_all'>See All</a>";
	//echo " | <a href='?action=tod_stats'>Stats</a></p>";
	
	echo "<h3>".$row['type'].": ".$row['task']."</h3>\n";
	echo "<img src='".$row['content']."' style='max-width: 600px;'>\n";
	echo "<p>".$row['challenge']."</p>\n";

	$cresult=get_tod_list_by_parent($y);
	if (count($cresult))
	{
		echo "<h2>Responses</h2>\n";
		echo "<ul>\n";
		for($i = 0; $i < count($cresult); $i++)
		{	
		$crow=$cresult[$i];
		echo "<li><a href='event.php?action=truth_or_dare&id=".$crow['id']."'>".$crow['person']."</a></li>\n";
		}
		echo "</ul>\n";
	}
	if($row['id']>0)
	{
		echo "<p><a href='event.php?action=truth_or_dare&id=".$row['parent']."'>Parent ToD</a></p>\n";
	}
	if($verified=='Yes')
	{
		echo "(<a href='event.php?action=tod_add_page&parent=".$row['id']."'>Add Response</a>)<br>\n";
		echo "(<a href='event.php?action=edit_tod&id=".$row['id']."'>Edit This</a>)<br>\n";
	}
?>
</content>
<?

include('includes/footer.php');

?>