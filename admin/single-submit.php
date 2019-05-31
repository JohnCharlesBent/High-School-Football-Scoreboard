<?php
//ini_set('display_errors',1); 
//error_reporting(E_ALL);

require_once '../db.php';

$week_date = isset($_POST['week_date']) ? $_POST['week_date'] : '';
//echo $week_date;

$Home = isset($_POST['home']) ? $_POST['home'] : '';
$H_Score = isset($_POST['h_score']) ? $_POST['h_score'] : NULL;
$H_Division = isset($_POST['h_division']) ? $_POST['h_division'] : '';
$Away = isset($_POST['away']) ? $_POST['away'] : '';
$A_Score = isset($_POST['a_score']) ? $_POST['a_score'] : NULL;
$A_Division = isset($_POST['a_division']) ? $_POST['a_division'] : '';
$Highlights = isset($_POST['highlights']) ? $_POST['highlights'] : '';
$Location = isset($_POST['location']) ? $_POST['location'] : '';
$Day = isset($_POST['day']) ? $_POST['day'] : '';
$Time = isset($_POST['time'])? $_POST['time'] : '';

$week_no = mysqli_real_escape_string($db, $week_no );
$week_date = mysqli_real_escape_string($db, $week_date);
$Home = mysqli_real_escape_string( $db, $Home );
$H_Score = mysqli_real_escape_string($db, $H_Score);
$Away = mysqli_real_escape_string($db, $Away);
$A_Score = mysqli_real_escape_string($db, $A_Score);
$Highlights = mysqli_real_escape_string($db, $Highlights);
$Location = mysqli_real_escape_string($db, $Location);
$Day = mysqli_real_escape_string($db, $Day);
$Time = mysqli_real_escape_string($db, $Time);

$insert_sql = "INSERT INTO Games_2017 (`week_no`, `week_date`, `Home`, `H_Score`, `H_Division`, `Away`, `A_Score`, `A_Division`, `Highlights`, `Location`, `Day`, `Time`)
              VALUES ('{$week_no}', '{$week_date}', '{$Home}', '{$H_Score}', '{$H_Division}', '{$Away}', '{$A_Score}', '{$A_Division}', '{$Highlights}', '{$Location}', '{$Day}','{$Time}')";

// Insert the user into the database
$result=$db->query($insert_sql) or die();

if($result){
header('Location: admin.php');
}

else {

}
include 'toJson.php';
?>
