<?php
	session_start(); /* Starts the session */
	$verified = isset($_SESSION['UserData']['Username']);
	if ($verified)
		$permission_level = 1;
?>