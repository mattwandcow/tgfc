<?php
include 'user_bar.php';
$title_str="TGFC Truth or Dare";
include 'header.php';
echo $user_bar_str;
?>
<body>
<?php
include 'tgfc_header.php';
include 'tgfc_menu.php';

include 'connect.php';

$y=$_POST['term'];

echo "<a href='tgfc_tod.php'>Back to ToD</a><br>\n";

$search_str="select * FROM tgfc_tod left JOIN (SELECT parent as pid, count(*) as COUNT FROM `tgfc_tod` GROUP by parent) c on c.pid=id";

$result=mysqli_query($connection, $search_str);
$rcount=mysqli_num_rows($result);
if ($rcount>0)					//We got one!!
{
	// echo "<p>Total number of entries: ".$rcount."</p>\n";
	// echo "<table><tr><td>Person</td><td>Task</td><td>Challenge</td><td>Children</td></tr>\n";
	// for($i = 1; $i <= $rcount; $i++)
	// {	
	// $row=mysqli_fetch_array($result);
	// echo "<tr><td><a href='tgfc_tod.php?id=".$row['id']."'>".$row['person']."</a></td>";
	// echo "<td>".$row['type'].": ".$row['task']."</td>";
	// echo "<td>".$row['challenge']."</td>";
	// if(is_null($row['COUNT']))
		// echo "<td>0</td>";
	// else
		// echo "<td>".$row['COUNT']."</td>";
	// }
	// echo "</tr></table>\n";
}
else 
{
	echo "No results returned!";
}


mysqli_close($connection);
include 'tgfc_footer.php';
?>