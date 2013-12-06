<?php

include("process.php");
$log = new Process();
if($_REQUEST['action'] == "login"){
    if($log->login($_REQUEST['username'], $_REQUEST['password']) == true){
        //do something on successful login
    }else{
        //do something on FAILED login
    }
}

?>