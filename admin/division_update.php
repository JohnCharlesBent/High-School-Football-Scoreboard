<?php
ini_set('display_errors',1);  
error_reporting(E_ALL);

include '../db.php';

$team = isset($_POST['team']) ? $_POST['team'] : '';
$div = isset($_POST['div']) ? $_POST['div'] : '';

$home_query = "UPDATE Games_2017 SET H_Division='$div' WHERE Home='$team'";

$away_query = "UPDATE Games_2017 SET A_Division='$div' WHERE Away='$team'";

$home_result=$db->query($home_query);

$away_result=$db->query($away_query);

echo $team.'<br>';
echo $div;

?>

<!DOCTYPE html>
<html>
<head>
<title>Division Update</title>
</head>

<body>

<form method="POST" action="division_update.php">

<select id="Team" name="team">
<option selected disabled>Change Team</option>
<?php
$sql = "SELECT DISTINCT(Home) AS Home FROM Games_2016";
$result=$db->query($sql);

while($row = $result->fetch_assoc()) {
echo '<option value="'.$row['Home'].'" class="thisWk">'.$row['Home'].'</option>';

}
?>
</select>

<select id="Division" name="div">
	<option selected>Select a division</option>
	<option value="I">Division I</option>
	<option value="II">Division II</option>
	<option value="III">Division III</option>
</select>

<input type="submit" value="submit"/>

</form>

</body>

</html>