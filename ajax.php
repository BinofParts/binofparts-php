<?php
	include_once('database.php');
    if (!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest') {
		
		$lastid = $_POST['last'];
		$database->displayLiveFeed($lastid);

    }
?>