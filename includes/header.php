<?php
$user_bar_str="";
$user_bar_str.='
<head>
<link rel="stylesheet" href="css/header.css">
</head>';
$user_bar_str.="<body>\n<div id='user_bar'>";
if($verified)
{
	$user_bar_str.="Welcome ".$_SESSION['UserData']['Username'];
	$user_bar_str.="(<a href='admin.php?action=panel'>Admin</a>, ";
	$user_bar_str.="<a href='admin.php?action=logout'>Logout</a>)";
}
else
{
	$user_bar_str.="<a href='admin.php?action=login'>login</a>";
}
$user_bar_str.="</div>";
echo $user_bar_str;
?>


<header>
This is the image of the TGFC Website Logo and the title text?
</header>
<?php
include('nav.php');
?>