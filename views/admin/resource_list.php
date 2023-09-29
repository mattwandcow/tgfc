<html>
<?php
include('includes/verify.php');
include('includes/header.php');
require_once('functions/db-functions.php');
require_once('functions/builder-functions.php');
?>
<content>
<?php if($verified) echo "<p><a href='resources.php?action=add-resource'>Add Resource</a></p>"; ?>
<?php
//Right, so we obviously need to get the DB data...
$resource_list=get_resource_list();
//and, idk just dump them on the screen for now?
if (count($resource_list)>0)
{
	for($i=0; $i<count($resource_list); $i++)
	{
		$line=$resource_list[$i];
		echo "<a href='".$line['link']."'>".$line['name']."</a> [".$line['event']."]<br>";
	}
}
else
	echo "<p>No resources found</p>";
?>

<?php if($verified) echo "<p><a href='resources.php?action=add-resource'>Add Resource</a></p>"; ?>

</content>
<?

include('includes/footer.php');

?>