<html>
<?php
include('includes/verify.php');
include('includes/header.php');
require_once('functions/db-functions.php');
require_once('functions/builder-functions.php');

$events=get_event_list();
?>
<content>
<H2>Events with Content</h2>
<?php
	for($i = 0; $i < count($events); $i++)
	{	
	$event_row=$events[$i];
	echo "<li><a href='event.php?action=event&event=".str_replace(' ', '-', $event_row['event'])."'>".$event_row['event']."</a>: ".$event_row['count']." items.</li>\n";
	}
	?>
<H2>Events with Alts</h2>
<?php
	$events=get_alt_options();
	for($i = 0; $i < count($events); $i++)
	{	
	$event_row=$events[$i];
	echo "<li><a href='event.php?action=event&event=".str_replace(' ', '-', $event_row['event'])."'>".$event_row['event']."</a>: ".$event_row['count']." characters</li>\n";
	}
?>
</content>
<?

include('includes/footer.php');

?>