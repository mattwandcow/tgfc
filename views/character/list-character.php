<html>
<?php

include('includes/header.php');
require_once('functions/db-functions.php');
require_once('functions/builder-functions.php');

$season=$_GET['s'];	//Throws a warning of Undefined Array Key if season wasn't selected. #TODO Priority low
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
		<td>Character Name</td>
		<td>Creator Name</td>
		<td>Species</td>
		<?php 
		//<td>Open</td>
		
		//<td>Tags</td>
		if(isset($season)){echo"<td>Season</td>";}?>
	</tr>
<?php
	if(!isset($season))
		$result=get_all_characters_by_season($default_season);
	elseif($season=='0')
		$result=get_all_characters();
	else
		$result=get_all_characters_by_season($season);
	
	if(count($result)>0)
	{
		for($i = 0; $i < count($result); $i++)
		{		
			
			$row = $result[$i];

			$table_creation_str.="<tr><td>".($i+1)."</td><td>";
			$table_creation_str.="<a href='character.php?id=".$row['character_id']."'>";
			$table_creation_str.=$row['character_name'];
			$table_creation_str.="</a></td><td>";
			$table_creation_str.="<a href='creator.php?action=single&crid=".$row['creator_id']."'>";
			$table_creation_str.=$row['creator_name'];
			$table_creation_str.="</a></td><td>";
			$table_creation_str.=$row['species'];
			//$table_creation_str.="</td><td>";
			//$table_creation_str.=$row['open'];
			//$table_creation_str.="</td><td>";
			//$table_creation_str.=$row['ch_tags'];
			if(isset($season))
			{
				$table_creation_str.="</td><td>";
				$table_creation_str.="Season ".$row['season'];
			}
			$table_creation_str.="</td></tr>\n";
		}
		echo $table_creation_str;
		echo "</table>\n";
	}
	else
	{
		echo "<p>No Results found</p>";
	}
echo season_select($season);
?>
</content>


<?php

include('includes/footer.php');

?>