<?php
ini_set('display_errors',1);  
error_reporting(E_ALL);

ignore_user_abort(true);
set_time_limit(0);

$wk = isset($_POST['wk']) ? $_POST['wk'] : '2016-09-04';

$wk_no = '';
$wk_date = '';

switch($wk) {
	case '2016-08-21':
		$wk_no = '1';
		$wk_date = '8/21 - 8/27';
	break;
	case '2016-08-28':
		$wk_no = '2';
		$wk_date = '8/28 - 9/03';
	break;
	case '2016-09-04':
		$wk_no = '3';
		$wk_date = '9/04 - 9/10';
	break;
	case '2016-09-11':
		$wk_no = '4';
		$wk_date = '9/11 - 9/17';
	break;
	case '2016-09-18':
		$wk_no = '5';
		$wk_date = '9/18 - 9/24';
	break;
	case '2016-09-25':
		$wk_no = '6';
		$wk_date = '9/25 - 10/01';
	break;
	case '2016-10-02':
		$wk_no = '7';
		$wk_date = '10/02 - 10/08';
	break;
	case '2016-10-09':
		$wk_no = '8';
		$wk_date = '10/09 - 10/15';
	break;
	case '2016-10-16':
		$wk_no = '9';
		$wk_date = '10/16 - 10/22';
	break;
	case '2016-10-23':
		$wk_no = '10';
		$wk_date = '10/23 - 10/29';
	break;
	case '2016-10-30':
		$wk_no = '11';
		$wk_date = '10/30 - 11/05';
	break;
	case '2016-11-06':
		$wk_no = '12';
		$wk_date = '11/06 - 11/12';
	break;
	case '2016-11-13':
		$wk_no = '13';
		$wk_date = '11/13 - 11/19';
	break;
	case '2016-11-20':
		$wk_no = '14';
		$wk_date = '11/20 - 11/26';
	break;
	endswitch;
}



include('simple_html_dom.php');

$html = new simple_html_dom();

$game_dates = array();

$url = 'http://www.schtools.net/membersnew/public/index.cfm?fuseaction=datessched&OrgSportID=8&SportLevelCode=C&InputDate={ts%20%27'.$wk.'%2000:00:00%27}&Org=RIIL&CFID=8915759&CFTOKEN=45735882';

$html->load_file($url);

foreach($html->find('td[width=50]') as $e) {
	$date = $e->plaintext;
	//$matchup = $e->find('td[width=250')->plaintext;
	//$location = $e->find('td[width=100]')->plaintext;

	 $game_dates[] = array(
	 	'week_no' => '3',
	 	'week_date' => '',
	 	'day' => $date
	 	);

}


$toJSON = json_encode($game_dates, JSON_PRETTY_PRINT);

file_put_contents('game_dates.json', $toJSON);


?>