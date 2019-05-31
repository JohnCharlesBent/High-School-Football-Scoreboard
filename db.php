<?php
// remote db connection
//$db = new mysqli('markets.lininteractive.com','user', 'pass', 'admin_HSFootball');

//local connection (for testing)
$db = new mysqli('localhost', 'root', 'root', 'admin_HSFB');

if($db->connect_errno > 0) {
	die('Could not connect to database[' .$db->error. ']');
}
?>
