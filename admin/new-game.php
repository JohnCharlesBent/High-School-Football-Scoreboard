<?php 
include '../db.php';
?>

<fieldset>

<label>Week of Play:</label>
<select id="week" name="week_date">
<?php
	$sql = "SELECT DISTINCT(week_date) AS week_date FROM $table";
$result=$db->query($sql);

while($row = $result->fetch_assoc()) {

echo '<option value="'.str_replace('u9006', '-', $row['week_date']).'" class="thisWk">'.str_replace('u9006', '-', $row['week_date']).'</option>';
}

?>
</select>




<label>Home</label>
<input type="text" name="home" />



<label>Home Score</label>
<input type="text" name="h_score" />


<label>Home Division</label>
<select id="h_division" name="h_division">
<option selected disabled="disabled">Select a Division</option>
<option value="I">I</option>
<option value="II">II</option>
<option value="II-A">II-A</option>
<option value="II-B">II-B</option>
<option value="III">III</option>
<option value="IV">IV</option>
<option value="mass-football">Mass. Football</option>
<option value="non-division">non-division</option>
</select>
</fieldset>

<fieldset>
<label>Away</label>
<input type="text" name="away" />

<label>Away Score</label>
<input type="text" name="a_score" />

<label>Away Division</label>
<select id="a_division" name="a_division">
<option selected disabled="disabled">Select a Division</option>
<option value="I">I</option>
<option value="II">II</option>
<option value="II-A">II-A</option>
<option value="II-B">II-B</option>
<option value="III">III</option>
<option value="IV">IV</option>
<option value="mass-football">Mass. Football</option>
<option value="non-division">non-division</option>
</select>

<label>Highlights Link</label>
<input type="text" name="highlights" />
</fieldset>

<fieldset>
<label>Location</label>
<input type="text" name="location" />

<label>Day</label>
<input type="text" name="day" />

<label>Time</label>
<input type="text" name="time" />

<input type="submit" value="submit" />
</fieldset>
<div class="clr"></div>