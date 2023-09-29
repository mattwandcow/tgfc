<html>
<?php
include('includes/verify.php');
include('includes/header.php');
require_once('functions/db-functions.php');
require_once('functions/builder-functions.php');
?>
<content>
<?php

$rows=get_tod_list();
$rcount=count($rows);
echo "<p>Total number of entries: ".$rcount."</p>\n";
echo "<table><tr>
		<td>Person</td>
		<td>Task</td>
		<td>Challenge</td>
		<td>Season</td>
	</tr>\n";

for($i = 1; $i < $rcount; $i++)
	{	
	$row=$rows[$i];
	echo "<tr><td><a href='tgfc_tod.php?id=".$row['id']."'>".$row['person']."</a></td>";
	echo "<td>".$row['type'].": ".$row['task']."</td>";
	echo "<td>".$row['challenge']."</td>";
	echo "<td>".$row['season']."</td>";
	// if(is_null($row['COUNT']))
		// echo "<td>0</td>";
	// else
		// echo "<td>".$row['COUNT']."</td>";
	}
	echo "</tr></table>\n";


?>


</content>
<?

include('includes/footer.php');

?>