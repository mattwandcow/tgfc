<html>
<?php

include('includes/header.php');
require_once('functions/db-functions.php');
require_once('functions/builder-functions.php');

$season=$_GET['s'];
$default_season='3';
?>
<script src="sorttable.js"></script>
<content>
<?php
echo season_select($season);
?>
<table class='sortable'>
	<tr bgcolor='#D291BC '>
		<td>#</td>
		<td>Creator Name</td>
		<td>Birth Day</td>
		<td>Join Date</td>
		<td>Number of Characters</td>
	</tr>
<?php
	if(!isset($season))
		$result=get_creators_by_season($default_season);
	elseif($season=='0')
		$result=get_all_creators();
	else
		$result=get_creators_by_season($season);
	if(count($result))
	{
	for($i = 0; $i < count($result); $i++)
		{		
		$row = $result[$i];
		$table_creation_str.="<tr><td>".($i+1)."</td><td>";
		$table_creation_str.="<a href='creator.php?action=single&crid=".$row['cre_id']."'>";
		$table_creation_str.=$row['cre_name'];
		$table_creation_str.="</a></td><td>";
		$table_creation_str.=$row['cre_bday'];
		$table_creation_str.="</a></td><td>";
		$table_creation_str.=$row['cre_join'];
		$table_creation_str.="</td><td style='text-align:center'>";
		$table_creation_str.=$row['cre_count'];
		$table_creation_str.="</td></tr>\n";
		}
	echo $table_creation_str;
	}
	else
	{
		//no cratores D:
		echo "Error: No creators found.";
	}
	echo "</table>\n";
	echo season_select($season);
?>
</table>
</content>


<?php

include('includes/footer.php');

?>