<?php

//ini_set('display_errors',1);  
//error_reporting(E_ALL);

class XmlToJson {

	public static function Parse ($url) {
		$fileContents = utf8_encode(file_get_contents($url));

		$simpleXml = simplexml_load_string($fileContents);

		$json = json_encode($simpleXml);

		return $json;
	}
}

include('../db.php');

$xml = new DomDocument('1.0', 'UTF-8');

// get contents from DB
$sql = "SELECT week_no, week_date, Home, H_Score, H_Division, Away, A_Score, A_Division, Highlights, Location, Day, Time FROM Games_2017 ORDER BY id ASC";
$result=$db->query($sql);


//$response = array();

$games = $xml->createElement("games");
$games = $xml->appendChild($games);

while($r = $result->fetch_assoc()) {
 $matchup = $xml->createElement("matchUp");
 $matchup = $games->appendChild($matchup);

 $week_no = $xml->createElement("weekNo" , ''.$r['week_no'].'');
 $week_no = $matchup->appendChild($week_no);

 

 $date = $xml->createElement("date", ''.trim($r['week_date']).'');
 $date = $matchup->appendChild($date);

 $home = $xml->createElement("homeTeam", ''.trim($r['Home']).'');
 $home = $matchup->appendChild($home);

if($r['H_Score'] != NULL) {
 $h_score = $xml->createElement("homeScore", ''.$r['H_Score'].'');
 $h_score = $matchup->appendChild($h_score);
} else {
 $h_score = $xml->createElement("homeScore", 'n/a');
 $h_score = $matchup->appendChild($h_score);
}
 $h_div = $xml->createElement("homeDivision", ''.$r['H_Division'].'');
 $h_div = $matchup->appendChild($h_div);

 $away = $xml->createElement("awayTeam", ''.trim($r['Away']).'');
 $away = $matchup->appendChild($away);
if($r['A_Score'] != NULL) {
 $a_score = $xml->createElement("awayScore", ''.$r['A_Score'].'');
 $a_score = $matchup->appendChild($a_score);
} else {
 $a_score = $xml->createElement("awayScore", 'n/a');
 $a_score = $matchup->appendChild($a_score);
}
 $a_div = $xml->createElement("awayDivision", ''.$r['A_Division']);
 $a_div = $matchup->appendChild($a_div);
if($r['Highlights'] != NULL) {
 $highlights = $xml->createElement("highlights", ''.trim($r['Highlights']).'');
 $highlights = $matchup->appendChild($highlights);
} else {
 $highlights = $xml->createElement("highlights", 'n/a');
 $highlights = $matchup->appendChild($highlights);
}
if($r['Location'] != NULL) {
 $location = $xml->createElement("location", ''.trim($r['Location']).'');
 $location = $matchup->appendChild($location);
} else {
	$location = $xml->createElement("location", 'n/a');
 $location = $matchup->appendChild($location);
}
 $gameDate = $xml->createElement("gameDate", ''.trim($r['Day']).'');
 $gameDate = $matchup->appendChild($gameDate);

 $gameTime = $xml->createElement("gameTime", ''.trim($r['Time']).'');
 $gameTime = $matchup->appendChild($gameTime);
}

$xml->FormatOutput = true;
$string_value = $xml->saveXML();

$xml->save('../xml/Games.2017.xml');

$records = array();

$gamedata =  XmlToJson::Parse('../xml/Games.2017.xml');
//$records[] = $gamedata; 

//print_r($gamedata);

//$gamesJson =json_encode($gamedate, JSON_PRETTY_PRINT);

file_put_contents('../json/Games.2017.json', $gamedata);
file_put_contents('Games.2017.json', $gamedata);

$ftp_server = "ftp.cdn.npub.io";
$ftp_conn = ftp_connect($ftp_server) or die("Could not connect to $ftp_server");
$login = ftp_login($ftp_conn,'weather_wpri', 'wfakbm6c');

$file = 'Games.2017.json';
chmod($file, 0777);

ftp_pasv($ftp_conn, true);

// upload file
if (ftp_put($ftp_conn, '/html/HSFB/json/'.$file, $file, FTP_ASCII))
  {
  echo '<h4>Successfully uploaded '.$file.' to wx server.</h4>';
  echo '</div>';
  }
else
  {
  echo "<h2>Error uploading $file.</h2>";
  }

// close connection
ftp_close($ftp_conn);

?>