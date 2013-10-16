<?php 
include('../session.php');
if(!$session->logged_in || $session->admin != 'Y'){
	header('Location: /');
}

$url = "http://www.thebluealliance.com/api/v1/events/list?year=2014";
$data = @json_decode(file_get_contents($url), true);

for($i=0; $i<count($data); $i++)
{
    $sql = array();
    foreach($data[$i] as $key => $value){
        $sql[] = (is_numeric($value)) ? "`$key` = $value" : "`$key` = '" . $value . "'";
    }
    $sqlclause = implode(",",$sql);
	echo $sqlclause;
    $database->updateEvents($sqlclause);
	unset($sql);
}
echo "Done.";
//echo "Updating Please allow a few minutes for the changes to take affect in the database.";
?>