<?php

include("database.php");

if(isset($_GET['q'])){
	$query = $_GET['q'];
	$mysqli_query = $database->search($query);
		
	$json = json_encode($mysqli_query);
  	echo($json);
}

?>