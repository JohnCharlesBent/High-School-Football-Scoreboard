<?php
// error reporting / for debuggin only / turn off before uploading to server
//ini_set('display_errors',1);  error_reporting(E_ALL);

include '../db.php'; 


$table = 'Games_2017';
$thisWeek = date('W');
$currWeek = '';
if($thisWeek == 36) {
		$currWeek = '9.03+%96+9.09';
	} else if($thisWeek == 37) {
		$currWeek = '9.10+%96+9.16';
	} else if($thisWeek == 38) {
		$currWeek = '9.17+%96+9.23';
	} else if($thisWeek == 39) {
		$currWeek = '9.24+%96+9.30';
	} else if($thisWeek == 40) {
		$currWeek = '10.01+%96+10.07';
	} else if($thisWeek == 41) {
		$currWeek = '10.08+%96+10.14';
	} else if($thisWeek == 42) {
		$currWeek = '10.15+%96+10.21';
	} else if($thisWeek == 43) {
		$currWeek = '10.22+%96+10.28';
	} else if($thisWeek == 44) {
		$currWeek = '10.29+%96+11.04';
	} else if($thisWeek == 45) {
		$currWeek = '11.05+%96+11.11';
	} else if($thisWeek == 46) {
		$currWeek = '11.12+%96+11.18';
	} else if($thisWeek == 47) {
		$currWeek = '11.19+%96+11.25';
	}

$value = isset($_GET['value']) ? $_GET['value'] : urldecode($currWeek);

$term = isset($_GET['term']) ? $_GET['term'] : 'week_date';

if($term == 'Home') {
	$terms = 'Home LIKE "'.$value.'" OR Away LIKE "'.$value.'"';
	$display = 'Team: '.$value;
} else {
	$terms = $term. ' LIKE '.'"'.$value.'"';
	$display = 'Selected Week: '.$value;
}

?>
<!DOCTYPE html>
<html>
<head>
<meta charset="iso-8859-1">
<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title></title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700' rel='stylesheet' type='text/css'>
<link href='http://fonts.googleapis.com/css?family=Graduate' rel='stylesheet' type='text/css'>
<!--<link href="../HSFB.css" rel="stylesheet" type="text/css">-->
<style>
* {box-sizing:border-box;}
body{margin:0;padding:0;font-family:'Open Sans', helvetica, sans-serif;}
#wrap {width:98%;max-width:none;margin:0 auto;border-left:solid thin #30518e;border-right:solid thin #30518e;}
header.admin img.branding {width:75%;max-width:650px;}
span#season {font-family:'Graduate', sans-serif;font-size:1.2em;display:inline-block;background:#30518e;vertical-align:top;padding:1em;color:#fff;float:right;}
header.admin {border-bottom:solid thin #30518e;}
#wk {background:#A5C4EB;padding:.5em;text-align:center;border-bottom:solid thin #30518e;}
#currWeek {width:50%;display:inline-block;font-family:'Graduate', sans-serif;}
#changeWeek {width:30%;display:inline-block;border:solid thin #30518e;font-family:'Open-Sans',helvetica, arial;padding:.25em;border-radius:4px;font-size:1em;}
#new {width:100%;border-bottom:solid thin #30518e;font-family:'Graduate', sans-serif;}
#newGame {padding:1em;}
.T, .filtTeam, .filtWeek {float:left;padding:.5em;background:#30518e;color:#fff;width:auto;width:33.3333333%;text-align:center;cursor:pointer;}
.filtTeam {background:#a5c4eb;color:#30518e;}
.filtWeek {background:#eee;color:#30518e;}
#Team, #changeWeek {display:block;width:300px;padding:.25em;height:35px;border:solid thin #30518e;font-size:1.1em;font-family:'Open Sans', arial, helvetica, sans-serif;margin:1em auto;border-radius:4px;}
.clr {clear:both;}
label {display:block;margin:.25em 0;}
#newGame fieldset {border:none;width:32%;float:left;}
#newGame {background:#eee;padding:.25em;}
input[type="submit"] {padding:.5em;background:#30518e;color:#fff;font-size:1.1em;border:none;border-radius:4px;cursor:pointer;text-transform:capitalize;display:block;margin:.5em 0;}
input[type="submit"]:hover {padding:.45em;opacity:.8;}
table {width:100%;}
td , th {width:7.14%;font-size:1em;}
td input[type="submit"] {padding:.15em;font-size:.8em;width:auto;}
td input[type="submit"]:hover {padding:.15em;}
#chWk {padding:.15em;display:inline-block;vertical-align:middle;font-size:.9em;margin-left:10px;}
.matchUp {font-size:1.2em;padding:1em;border-bottom:solid thin #30518e;font-family:'Graduate', helvetica, sans-serif;}
#curr {text-align:center;font-family:'Graduate', helvetica, arial, sans-serif;border-bottom:solid thin #30518e;font-size:1.2em;}
.edit, .hide {float:right;padding:.5em;border-radius:4px;background:red;color:#fff;font-size:1em;cursor:pointer;}
.home {color:#30518e;}
.away {color:#5F5F5F;}
#location, .vs {color:#A5C4EB;}
#location {font-size:.8em;}
.listing {display:inline-block;margin:.5em 1em;text-align:left}
.form {border-top:solid thin #30518e;background:#eee;padding:.25em;font-size:.9em;margin:.5em 0;}
.form input[type="submit"] {font-size:1em;font-family:'Graduate', helvetica, sans-serif;vertical-align:bottom;display:inline-block;padding:.25em;}
#submit {background:green;}
#delete {background:red;}
span.btn {font-size:.8em;background:#30518e;color:#fff;display:inline-block;padding:.25em;border-radius:4px;margin:0 10px;cursor:pointer;}
span.btn:hover {opacity:.8;}
@media screen and (min-width:2px) and (max-width:900px) {
	body {font-size:90%;}
	span#season {display:none;}
}
@media screen and (min-width:2px) and (max-width:600px) {
	.edit, .hide {padding:.15em;font-size:.9em;}
	#newGame fieldset {width:100%;display:block;margin:0 auto;}
}
</style>
</head>
<body>
<div id="wrap">

<header class="admin">
	<img src="../img/EWNSports.jpg" class="branding" alt="EWN Sports Branding" />
	<span id="season">Season: 2017</span>
</header>
<!-- filter buttons.  Add new game / filter by team or by division -->
<div id="new">
<span class="T">Add a New Game &raquo;</span> <span class="filtTeam">Filter by Team &raquo;</span> <span class="filtWeek">Filter by Week &raquo;</span>
<div class="clr"></div>
</div>
<form action="single-submit.php" method="POST" id="newGame">
<?php include 'new-game.php'; ?>
</form>


<select id="Team">
<option selected disabled>Change Team</option>
<?php
$sql = "SELECT DISTINCT(Home) AS Home FROM $table";
$result=$db->query($sql);

while($row = $result->fetch_assoc()) {
echo '<option value="admin.php?value='.$row['Home'].'&term=Home" class="thisWk">'.$row['Home'].'</option>';

}
?>
</select>



<!-- select a week of play / loads week based week number variable.  default is first week of play -->



<select id="changeWeek" name="week">
	<option selected disabled>Change Week</option>
<?php
$sql = "SELECT DISTINCT(week_date) AS week_date FROM $table";
$result=$db->query($sql);

while($row = $result->fetch_assoc()) {
echo '<option value="admin.php?value=' .urlencode(str_replace('u9006', '-', $row['week_date'])).'" class="thisWk">'.str_replace('u9006', '-', $row['week_date']).'</option>';
}
?>
</select>


<!--<input type="submit" id="chWk" value="Change Week" />-->

<div id="curr"><?php echo $display; ?></div>
<?php
//echo $tW;
// select record from mysql
$sql="SELECT * FROM Games_2017 WHERE $terms";
$result=$db->query($sql);

while($rows = $result->fetch_assoc()) {
?>
<div class="matchUp"><span class="home"><?php echo $rows['Home']; ?></span> <span class="hscore">
<?php 
if($rows['H_Score'] != NULL) {
	echo '<span>'.$rows['H_Score'].'</span>';
}
?>
</span>
 <span class="vs">VS.</span> <span class="away"><?php echo $rows['Away']; ?></span><span class="ascore">
<?php 
if($rows['A_Score'] != NULL) {
	echo '<span>'.$rows['A_Score'].'</span>';
}
?>
</span>
<span class="edit">Edit</span>
<div id="location">Location: <?php echo $rows['Location']; ?> | Day: <?php echo $rows['Day']; ?> | Time: <?php echo $rows['Time']; ?></div>


<div class="form">
<form method="POST" action="submit.php">
<div class="listing" style="display:none;"><input type="hidden" name="id" value="<?php echo $rows['ID']; ?>"></div>
<div class="listing" style="display:none;"><input type="hidden" name="week_no" value="<?php echo $rows['week_no']; ?>"></div>
<div class="listing" style="display:none;"><input type="hidden" name="week_date" value="<?php echo $rows['week_date']; ?>"></div>
<div class="listing">Week: <?php echo $rows['week_date']; ?><span class="chWk btn">Change Week</span>
	<select name="week_date" class="wkDt" disabled>
	<option selected disabled>Change Week</option>
<?php
$sel_sql = "SELECT DISTINCT(week_date) AS week_date FROM $table";
$sel_result=$db->query($sel_sql);

while($sel_row = $sel_result->fetch_assoc()) {
echo '<option value="'.$sel_row['week_date'].'" class="thisWk">'.str_replace('u9006', '-', $sel_row['week_date']).'</option>';
}
?>
</select></div>
<div class="H">
<div class="listing team">Home: <input type="text" name="home" value="<?php echo $rows['Home']; ?>"></div>
<div class="listing">Home Score: <input type="text" name="h_score" value="<?php echo $rows['H_Score']; ?>" size="10"></div>
<div class="listing">Home Division: <input type="text" readonly  name="h_division" class="div" value="<?php echo $rows['H_Division']; ?>"><span class="btn chDiv">Change Division</span>
<select name="h_division" class="Div">
<option selected disabled="disabled">Select a Division</option>
<option value="I">I</option>
<option value="II">II</option>
<option value="II-A">II-A</option>
<option value="II-B">II-B</option>
<option value="III">III</option>
<option value="IV">IV</option>
<option value="mass-football">Mass. Football</option>
<option value="non-division">Non-divisional</option>
</select>
</div>
</div>
<div class="A">
<div class="listing">Away: <input type="text" name="away" value="<?php echo $rows['Away']; ?>"></div>
<div class="listing">Away Score: <input type="text" name="a_score" value="<?php echo $rows['A_Score']; ?>" size="10"></div>
<div class="listing">Away Division: <input type="text" readonly name="a_division" class="div" value="<?php echo $rows['A_Division']; ?>"><span class="btn chDiv">Change Division</span>
<select name="a_division" class="Div">
<option selected disabled="disabled">Select a Division</option>
<option value="I">I</option>
<option value="II">II</option>
<option value="II-A">II-A</option>
<option value="II-B">II-B</option>
<option value="III">III</option>
<option value="IV">IV</option>
<option value="mass-football">Mass. Football</option>
<option value="non-division">Non-divisional</option>
</select>
</div>
</div>
<div class="listing">Highlights Link: <input type="text" name="highlights" value="<?php echo $rows['Highlights']; ?>"></div>
<div class="listing">Location: <input type="text" name="location" value="<?php echo $rows['Location']; ?>"></div>
<div class="listing">Day: <input type="text" name="day" value="<?php echo $rows['Day']; ?>"></div>
<div class="listing">Time: <input type="text" name="time" value="<?php echo $rows['Time']; ?>"></div>
<div>
<input type="submit" value="Submit" formaction="submit.php" id="submit">
<input type="submit" value="delete" formaction="delete.php" id="delete">

</div>
</form>
</div>
</div>
<?php
// close while loop
}
?>





</div>


<script>
$(document).ready(function(){

$('#newGame, #Team, #changeWeek, .form, .Div, .back, .wkDt').hide();

// sort option lists alphabetically
(function( $ ) {
	$(function() {
		$( "option", "#Team" ).sort(function( a, b ) {
			return $( a ).text() > $( b ).text(); 

		}).appendTo( "#Team" );

	});

})( jQuery );



$('.T').click(function() {
if($('#newGame').css('display') == 'none') {
	$('#newGame').show();
	$('.T').text('Hide');
} else {
	$('#newGame').hide();
	$('.T').html('Add A New Game &raquo;');
}
});

$('.filtTeam').click(function() {
if($('#Team').css('display') == 'none') {
	$('#Team').show();
	$('.filtTeam').text('Hide');
	$('#curr').text('Team: '+team);
} else {
	$('#Team').hide();
	$('.filtTeam').html('Filter by Team &raquo;');
}
});

$('.filtWeek').click(function() {
if($('#changeWeek').css('display') == 'none') {
	$('#changeWeek').show();
	$('.filtWeek').text('Hide');

} else {
	$('#changeWeek').hide();
	$('.filtWeek').html('Filter by Week &raquo;');
}
});

$(document).on('click', '.edit', function(){
$(this).closest('div').find('.form').show();
$(this).closest('.edit').text('Back').addClass('hide').removeClass('edit');
$('.matchUp').hide();
$(this).parent('.matchUp').show();
});

$(document).on('click', '.hide', function(){
$(this).closest('div').find('.form').hide();
$('.matchUp').show();
$(this).closest('.hide').text('Edit').addClass('edit').removeClass('hide');
$('.A .Div, .H .Div, .wkDt').hide();
$('.wkDt').attr('disabled', 'disabled');
});

$('.H .chDiv').on('click', function() {
$('.H .Div').show();
});

$('.A .chDiv').on('click', function() {
$('.A .Div').show();
});

$('.chWk').on('click', function(){

	$('.wkDt').removeAttr('disabled').show();
});

$('#changeWeek, #Team').change(function(){
window.open(this.options[this.selectedIndex].value, '_top');
});


});
</script>
</body>
</html>