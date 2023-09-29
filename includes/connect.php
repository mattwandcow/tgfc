<?php
function createConnection()
{
$server = 'db5007181903.hosting-data.io';
$dbname = 'dbs5920049';
$username = 'dbu323163';
$password = 'The Matts 3 approve of this password.';

//$dsn ='mysql:host='.$server.';port='.$port.';dbname='.$dbname;
$dsn ='mysql:host='.$server.';dbname='.$dbname;
$options = array(PDO::ATTR_ERRMODE=> PDO::ERRMODE_EXCEPTION);
try{
    $link = new PDO($dsn, $username, $password, $options);
    return $link;
} catch (PDOException $e) {
    //header('Location: /index.php?action=500');
	print_r($link->errorInfo());
	echo 'Connection failed: ' . $e->getMessage();
    exit;
}
}
?>