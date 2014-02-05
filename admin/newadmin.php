<?php
include('../session.php');
if(!$session->logged_in && $session->admin != true){
	header('Location: ../login.php');
	exit;
}

$email = $_POST["email"];

$database->createNewAdmin($email);

header('Location: index.php');

?>