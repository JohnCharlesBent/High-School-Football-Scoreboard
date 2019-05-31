<?php

include '../db.php';

$id = $_POST['id'];

// Delete data in mysql from row that has this id
$delete_sql = "DELETE FROM Games_2017 WHERE ID=$id";
$result=$db->query($delete_sql) or die();

// if successfully deleted
if($result){
header('Location:admin.php');
} else {

}

include 'toJson.php';

?>