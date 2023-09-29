<html>
<?php
include('includes/verify.php');
include('includes/header.php');
require_once('functions/tod-db-functions.php');
require_once('functions/builder-functions.php');
?>
<content>
<?php

$y=$_POST['term'];

echo "<a href='event.php?action=truth_or_dare'>Back to ToD</a><br>\n";
echo "<form action='event.php?action=tod_search' method='post'>";
echo "Search Term:<input type='text' name='term' value='$y'>";
echo "<input type='submit'></form>\n";
if (isset($y))
{
	
	$result=search_tod($y);
if (count($result)>0)					//We got one!!
{
	echo "<table><tr><td>Person</td><td>Task</td><td>Challenge</td></tr>\n";
	for($i = 0; $i < count($result); $i++)
	{	
	$row=$result[$i];
	echo "<tr><td><a href='event.php?action=truth_or_dare&id=".$row['id']."'>".$row['person']."</a></td>";
	echo "<td>".$row['type'].": ".$row['task']."</td>";
	echo "<td>".$row['challenge']."</td>";
	}
	echo "</tr></table>\n";
}
else 
{
	echo "No results returned!";
}
}

?>


</content>
<?

include('includes/footer.php');

?>