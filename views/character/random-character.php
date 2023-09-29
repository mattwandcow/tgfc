<html>
<?php
include('includes/verify.php');
include('includes/header.php');
require_once('functions/db-functions.php');
require_once('functions/builder-functions.php');

$character_list=get_all_characters_by_season('3');
$rand_char=array_rand($character_list, 1);
$rand_char=$character_list[$rand_char];
?>
<content>
Note: The character randomizer only handles Season 3

Your random character is: <?php  echo "<p><a href='character.php?chid=".$rand_char['character_id']."'>".$rand_char['character_name']."</a></p>"?>
<button onClick="window.location.reload();">Roll Again</button>
</content>
<?

include('includes/footer.php');

?>