<?php 
include('../session.php');
if(!$session->logged_in || $session->admin != 'Y'){
	header('Location: /');
}

for ($i = 1; $i < 10; $i++) {
$url = "http://www.thebluealliance.com/api/v1/teams/show?teams=frc$i";
$data = @json_decode(file_get_contents($url), true);
if ($data == null){
	continue;
}


//Build Query from Json Data
$array = $data[0];

foreach($array as $key => $value){
  $sql[] = (is_numeric($value)) ? "`$key` = $value" : "`$key` = '" . $value . "'"; 
}
$sqlclause = implode(",",$sql);
//echo $sqlclause;

//Update the database
$database->updateAllTeams($sqlclause);
unset($sql);
}
echo "Updating Please allow a few minutes for the changes to take affect in the database.";
?>