<?php 
include('../session.php');
if(!$session->logged_in || $session->admin != 'Y'){
	header('Location: /');
}

$database->checkTableLastUpdated();

?>