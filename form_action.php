<?php

include("database.php");
if($_REQUEST['action'] == "login"){
    if($database->login($_REQUEST['email'], $_REQUEST['pass']) == true){
        header('Location: /');
    }else{
		header('Location: login.php');
    }
}

?>