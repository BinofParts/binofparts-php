<?php

include("database.php");
if($_REQUEST['action'] == "login"){
    if($database->login($_REQUEST['email'], $_REQUEST['pass']) == true){
        header('Location: index.php');
    }else{
		header('Location: login.php');
    }
}

?>