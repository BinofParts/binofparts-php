<?php 
include('../session.php');
if(!$session->logged_in || $session->admin != 'Y'){
	header('Location: /');
}

$team = $_POST["team"];
// Modify header info for when TBA updates its api...
// $opts = array(
//   'http'=>array(
//     'method'=>"GET",
//     'header'=>array("X-TBA-App-Id: binofparts:webApp:1.0")
//   )
// );

// $context = stream_context_create($opts);

// Open the file using the HTTP headers set above
// $file = file_get_contents('http://www.thebluealliance.com/api/v1/teams/show?teams=frc'.$team, false, $context);
// $data = json_decode($file, true);

$url = "http://www.thebluealliance.com/api/v1/teams/show?teams=frc21";
$file = file_get_contents($url);
var_dump($file)
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