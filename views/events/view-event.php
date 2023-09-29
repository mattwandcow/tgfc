<html>
<?php
include('includes/verify.php');
include('includes/header.php');
require_once('functions/db-functions.php');
require_once('functions/builder-functions.php');

$alts=get_alts_by_event($event_name);
$statics=get_statics_by_event($event_name);

?>
<content>
<h1><?php echo $event_name?></h1>
<?php
if(count($alts)>0)
{
?>
<h2>
<?php echo count($alts);?> Characters with Alts for this event</h2>
<?php
	for($i = 0; $i < count($alts); $i++)
	{	
	$event_row=$alts[$i];
	echo "<li><a href='character.php?id=".$event_row['fk_character_id']."'>".$event_row['name']."[<a href=".$event_row['link'].">link</a>]</li>\n";
	}
}
if(count($statics)>0)
{
?>
<h2>Statics for this event</h2>
<?php
	for($i = 0; $i < count($statics); $i++)
	{	
	$event_row=$statics[$i];
	echo "<li><a href='".$event_row['link']."'>".$event_row['static_name']."</a> by <a href='creator.php?action=single&crid=".$event_row['creator_id']."'>".$event_row['creator_name']."</li>\n";
	}
}

if(count($statics)==0&&count($alts)==0)
{
?>
No items found for this event.
<?php } ?>

</content>
<?

include('includes/footer.php');

?>