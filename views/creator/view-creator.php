<html>
<?php

include('includes/header.php');
require_once('functions/db-functions.php');
require_once('functions/builder-functions.php');

$title_str="Creator Dossier";
$season=$_GET['s'];
$default_season='3';

echo "<body>\n";

if(!isset($crid))//if Y is not existing
{
	//echo "Dude, no Y!";
	//Set a random Creator? Title the thing that?
}

$row=get_creator_by_id($crid);

if (count($row)>0)					//We got one!!
{
	
	$detail_display_str="<h2>Creator Dossier</h2>";
	if ($verified=="Yes") {$detail_display_str.="<a href='edit.php?action=creator&crid=".$crid."'>Edit this Creator Dossier</a>\n";}
	$detail_display_str.="<p><strong>Name:</strong>".$row['name']."</p>\n";
	$detail_display_str.="<p><strong>B-Day Date:</strong>".$row['bday']."</p>\n";
	$detail_display_str.="<p><strong>Join Date:</strong>".$row['joined']."</p>\n";
	$detail_display_str.="<p><a href='".$row['link']."'>Deviant Art Page</a></p>\n";
	
	//display childs
	if(isset($season))
	{
		$characters=get_characters_by_creator_and_season($crid,$season);
	}
	else
	{
	$characters=get_characters_by_creator_and_season($crid, $default_season);
	}
	//print_r($characters);
	
	if (count($characters)>0)
	{
		$detail_display_str.="<h3>Characters</h3><ul>";
		for($i = 0; $i < count($characters); $i++)
		{
		$child_row = $characters[$i];
		
		$detail_display_str.= "<li><a href='character.php?id=".$child_row['character_id']."'>".$child_row['name'];
		if($season=='0')
			$detail_display_str.=" (Season ".$child_row['season'].")";
		$detail_display_str.="</a></li>";
		}
		
		$detail_display_str.="</ul>";
	}
	else
	{
		$detail_display_str.="<p>This Creator has no listed characters.</p>";
	}
	if($verified=="Yes")
	{
		$detail_display_str.="(<a href='add.php?action=character&crid=".$row['creator_id']."'>Add new character</a>)<br>";
		$detail_display_str.="(<a href='add.php?action=event_character&crid=".$row['creator_id']."'>Add event character</a>)<br>";
	}

	//=== Statics ===
	$statics=get_statics_by_creator_id($crid);
	if(count($statics)>0)
	{
		$detail_display_str.="<h2>Statics</h2>\n";
		$detail_display_str.="<ul>\n";
		for($i=0;$i<count($statics);$i++)
		{
			$alt_row=$statics[$i];
			$detail_display_str.="<li><a href='".$alt_row['link']."'>".$alt_row['name']."</a> [<a href='event.php?action=event&event=".str_replace(' ', '-', $alt_row['event'])."'>".$alt_row['event']."</a>]";
			if($verified) $detail_display_str.=" (<a href=edit.php?action=static&stid=".$alt_row['statics_id'].">edit</a>)";
			$detail_display_str.="</li>\n";
		}
		$detail_display_str.="</ul>\n";	
	}
	else{
		$detail_display_str.="<p>No Statics on file. Contact Matt to add one.</p>\n";
	}
	if($verified=="Yes")
		$detail_display_str.="<p><a href='add.php?action=statics&id=".$crid."'>(Add a Static)</a></p>\n";
	
	
	echo $detail_display_str;
	echo season_select_creator_page($season,"crid=$crid");
}		
else
{
	echo "\nError:Search Returned no Results";
}


include('includes/footer.php');

?>