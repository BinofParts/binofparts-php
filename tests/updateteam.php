<?php 
include('../session.php');
if(!$session->logged_in || $session->admin != 'Y'){
	header('Location: /');
}

$team = $_POST["team"];
$url = "http://www.thebluealliance.com/api/v1/teams/show?teams=frc$team";
$data = json_decode(file_get_contents($url), true);

$array = $data[0];
foreach($array as $key => $value){
  $sql[] = (is_numeric($value)) ? "`$key` = $value" : "`$key` = '" . $value . "'"; 
}
$sqlclause = implode(",",$sql);
unset($sql);

$database->updateTeam($sqlclause, $team);
//echo "completed..";
header('Location: /admin.php');

?>