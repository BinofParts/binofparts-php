<?php 
include("../database.php"); 

$url = "http://www.thebluealliance.com/api/v1/events/list?year=2014";
$data = @json_decode(file_get_contents($url), true);

//Build Query from Json Data

foreach($data as $key => $value){
  $sql[] = (is_numeric($value)) ? "`$key` = $value" : "`$key` = '" . $value . "'"; 
}
$sqlclause = implode(",",$sql);
echo $sqlclause;

//Update the database
//$database->updateEvents($sqlclause);
unset($sql);

//echo "Updating Please allow a few minutes for the changes to take affect in the database.";
?>