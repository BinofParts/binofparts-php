<?php 
include('../session.php');
// if(!$session->logged_in && $session->admin != true){
// 	header('Location: ../login.php');
// 	exit;
// }

$team = $_POST["team"];

$url = "http://www.thebluealliance.com/api/v2/team/frc$team";
$context = stream_context_create(array(
    'http' => array(
        'method' => 'GET',
        'header' => "X-TBA-App-Id: 'binofparts:team_scraper:1'\r\n"
    )
));
$file = file_get_contents($url, false, $context);
var_dump($file);
//$data = json_decode($file, true);

//echo $data;

// $array = $data[0];
// foreach($array as $key => $value){
//   $sql[] = (is_numeric($value)) ? "`$key` = $value" : "`$key` = '" . $value . "'"; 
// }
// $sqlclause = implode(",",$sql);
// unset($sql);

//$database->updateTeam($sqlclause, $team);
//echo "completed..";
//header('Location: /admin');

?>