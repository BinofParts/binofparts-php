<?php 
include('session.php');
if ($session->logged_in){
	include 'home.php';
}
else{
	include 'about.php';
}
?>