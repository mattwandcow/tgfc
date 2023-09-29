<?php
include 'user_bar.php';
$title_str="TGFC Truth or Dare";
include 'header.php';
echo $user_bar_str;

echo "<body>\n";

include 'tgfc_header.php';
include 'tgfc_menu.php';

include 'connect.php';

$y=$_POST['term'];

echo "<a href='tgfc_tod.php'>Back to ToD</a><br>\n";

echo "<h2>Truth or Dare Stats</h2>\n";

echo "<div id='tod_date_chart'></div>\n";

?>
<style type="text/css">
        #tod_date_chart
		{
			background-color: lightyellow; 
			position: relative; 
			height:210px; 
			width: 250px; 
			border: 1px black solid; 
			display: table-cell; 
			vertical-align: bottom; 
			font-size: 10px; 
		}
        .bar{
			position: absolute; 
			bottom: 0; 
			display:inline-block; 
			width: 10px; 
			margin: 2px; 
			background-color: lightpink;
		}
    </style>
<script type="text/javascript">
	var i, max, min, h, html='', data=[0
	<?php 
	$chart_str="select count(*) as count from tgfc_tod group by date order by date asc";
	$result=mysqli_query($connection, $chart_str);
	$rcount=mysqli_num_rows($result);
	if ($rcount>0)					//We got one!!
	{
		for($i = 1; $i <= $rcount; $i++)
		{	
		$row=mysqli_fetch_array($result);
		echo ", ".$row['count'];
		}
	}
	?>
	];
	min = 0;
	max = data[0];
	for (i=0; i<data.length; i++)
	{
		if (max<data[i]) max = data[i];
		if (min>data[i]) min = data[i];
	}
	for (i=0; i<data.length; i++)
	{
		h= Math.round (100*((data[i]-min)/max));
		html += '<div class="bar" style="height:' + h + '%; left:' + (12 * i) + 'px">' + data[i] + '</div>';
	}
	document.getElementById('tod_date_chart').innerHTML = html;
</script>

<?php
echo "<h3>Who's done dares? (Or truths)</h3>\n";
$search_str="select person, count(*) as count FROM tgfc_tod where type!='Start' and person!='' group by person order by count(*) desc";
$count_str="select count(*) as count FROM tgfc_tod where type!='Start' and person!=''";

$cresult=mysqli_query($connection, $count_str);
$crow=mysqli_fetch_array($cresult);

$result=mysqli_query($connection, $search_str);
$rcount=mysqli_num_rows($result);
if ($rcount>0)					//We got one!!
{
	echo "<p>Total number of dares performed: ".$crow['count']."</p>\n";
	echo "<table><tr><td>Person</td><td>Count</td></tr>\n";
	for($i = 1; $i <= $rcount; $i++)
	{	
	$row=mysqli_fetch_array($result);
	echo "<tr><td>".$row['person']."</td>";
	echo "<td>".$row['count']."</td>";
	}
	echo "</tr></table>\n";
}
else 
{
	echo "No results returned!";
}


mysqli_close($connection);
include 'tgfc_footer.php';
?>