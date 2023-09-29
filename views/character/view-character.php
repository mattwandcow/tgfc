<html>
<head>
<link rel="stylesheet" href="css/quickfix.css">
</head>
<?php

include('includes/header.php');
require_once('functions/db-functions.php');
require_once('functions/builder-functions.php');

include 'parsedown.php';
$Parsedown = new Parsedown();

if(!isset($chid))//if there is not an id to pull from the URL
{
	//echo "Dude, no Y!";
	//random character stuff?
}
$character=get_character_by_id($chid);
//print_r($character);

if (count($character)>0)					//We got some!!
{
	
	$detail_display_str="<h2>Character Dossier</h2>\n";
	if ($verified=="Yes") {$detail_display_str.="<a href='edit.php?action=character&chid=".$chid."'>Edit this Character Dossier</a>\n";}
	//basic info
	$detail_display_str.="<p><strong>Name: </strong>".htmlspecialchars($character['character_name'])."</p>\n";
	$detail_display_str.="<p><strong>Creator: </strong><a href=creator.php?action=single&crid=".$character['creator_id'].">".$character['creator_name']."</a></p>\n";
	$detail_display_str.="<p><strong>Species: </strong>".$character['species']."</p>\n";
	$detail_display_str.="<p><strong>Gender: </strong>".$character['gender']."</p>\n";
	if ($character['open']=='Closed')
	{
	$detail_display_str.="<p class='warning'>This character has signifgant restrictions for use or requires communication with the owner before use.</p>\n";	
	}
	if ($character['forbiddens']==1)
	{
	$detail_display_str.="<p class='warning'>This character has Forbiddens.</p>\n";	
	}
	if ($character['secrets']==1)
	{
	$detail_display_str.="<p class='warning'>This character has Secrets that may effect what stories can be told with them.</p>\n";	
	}
	
	$detail_display_str.="<p><strong>Notes: </strong></p>\n";
	
	$detail_display_str.=$Parsedown->text($character['text']);
	
	$detail_display_str.="<p><strong>Season: </strong>".$character['season']."</p>\n";
	$detail_display_str.="<p><a href='".$character['link']."'>Fight Card</a></p>\n";
	/* Hiding ksk for now
	//===KSK===
	$ksk_codes=get_ksk_by_character_id($chid);
	
	if(count($ksk_codes)>0)
	{
		$detail_display_str.="<h2>Kiskae Codes</h2>\n";
		for($i=0;$i<count($ksk_codes);$i++)
		{
			$detail_display_str.="<details>\n<summary>".$ksk_codes[$i]['ksk_title'];
				if($verified) $detail_display_str.=" (<a href=edit.php?action=ksk&kcid=".$ksk_codes[$i]['id'].">edit</a>)";
			$detail_display_str.="</summary>";
			if($verified) $detail_display_str.="<a href='character.php?action=ksk&id=".$ksk_codes[$i]['id']."'>View KSK Details</a>";
			$detail_display_str.="<div class='ksk_code_box'><p>".$ksk_codes[$i]['ksk']."</p></div>";
			$detail_display_str.="</details>\n";
		}
	}
	else
		$detail_display_str.="<p>No Kiskae Code on file. Contact Matt to add one.</p>\n";
	
	if($verified){$detail_display_str.="<a href='add.php?chid=$chid&action=ksk'>Add KSK Code Link</a>";}
	//*/
	//===Alt List===
	
	$alts=get_alts_by_character_id($chid);
	if(count($alts)>0)
	{
		$detail_display_str.="<h2>Alternate Cards</h2>\n";
		$detail_display_str.="<ul>\n";
		for($i=0;$i<count($alts);$i++)
		{
			$alt_row=$alts[$i];
			$detail_display_str.="<li><a href='".$alt_row['link']."'>".$alt_row['name']."</a> [<a href='event.php?action=event&event=".str_replace(' ', '-', $alt_row['event'])."'>".$alt_row['event']."</a>]";
			if($verified) $detail_display_str.=" (<a href=edit.php?action=alt&aid=".$alt_row['alts_id'].">edit</a>)";
			$detail_display_str.="</li>\n";
		}
		$detail_display_str.="</ul>\n";	
	}
	else{
		$detail_display_str.="<p>No Alternate forms on file. Contact Matt to add one.</p>\n";
	}
	if($verified=="Yes")
		$detail_display_str.="<p><a href='add.php?action=alt&id=".$chid."'>(Add an Alt)</a></p>\n";
	
		//===tag list===
	$tags=get_tags_by_character_id($chid);
	if(count($tags)>0)
	{
		$detail_display_str.="<h2>Tags</h2>\n";
		$detail_display_str.="<div class='tag_list_box'>";
		for($i=0;$i<count($tags);$i++)
		{
			//$detail_display_str.="<span class='tag'><a href='tag.php?tag=".str_replace(' ', '-', $tags[$i]['tag'])."'>".$tags[$i]['tag']."</a></span>";
			$detail_display_str.="<span class='tag'>".$tags[$i]['tag']."</span>";
		}
		$detail_display_str.="</div>";
		
	}
	else
	{
			$detail_display_str.="<p>No tags listed.</p>\n";
	}
	if($verified=="Yes") $detail_display_str.="<p><a href='add_tag.php?id=".$y."'>(Add a Tag)</a></p>\n";
	
	echo $detail_display_str;
	
}		
else
{
	echo "Error:Search Returned no Results";
	
}

include('includes/footer.php');

?>