<?
session_start();
require("api.php");
require("../bcrypt.php");

header("Content-Type: application/json");

switch ($_POST['command']) {
	case "login": 
		login($_POST['email'], $_POST['password']); break;
 
	case "register":
		register($_POST['username'], $_POST['password']); break;
		
	case "upload":
		upload($_SESSION['username'], $_FILES['file'], $_POST['title']);break;
	
	case "logout":
		logout();break;
		
	case "feed":
		feed($_POST['lastid']);break;
		
	case "kop":
		kop((int)$_POST['year']);break;
 
}

exit();
?>