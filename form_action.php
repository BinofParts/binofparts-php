<?php

include("database.php");

if($_REQUEST['action'] == "login"){
    if($database->login($_REQUEST['email'], $_REQUEST['pass']) == true){
        header('Location: index.php');
    }else{
		header('Location: login.php');
    }
}
elseif ($_REQUEST['action'] == "register") {
	if($database->register($_REQUEST['team'], $_REQUEST['namefirst'], $_REQUEST['namelast'], $_REQUEST['email'], $_REQUEST['pass'], $_REQUEST['type']) == true){
        header('Location: login.php');
    }else{
        //TODO: Save Invite token to a session variable. Destroy the invite token when registered.
		header('Location: register.php?invite=test');
    }
}

?>