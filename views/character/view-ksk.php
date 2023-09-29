<html>
<head>
<link rel="stylesheet" href="css/quickfix.css">
</head>
<?php

include('includes/header.php');
require_once('functions/db-functions.php');
require_once('functions/builder-functions.php');

include 'parsedown.php';
$Parsedown = new Parsedown();

$kcid=$chid;
$ksk=get_ksk_by_id($kcid);
print_r($ksk);



include('includes/footer.php');

?>