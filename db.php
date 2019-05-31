<?php
// remote db connection
//$db = new mysqli('markets.lininteractive.com','admin_FBadmin', '#4aMm40j', 'admin_HSFootball');

//local connection (for testing)
$db = new mysqli('localhost', 'root', 'root', 'admin_HSFB');

if($db->connect_errno > 0) {
	die('Could not connect to database[' .$db->error. ']');
}
?>