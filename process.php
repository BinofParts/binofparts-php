<?
/**
 * Process.php
 *
 * This class processes form data depending on what form is passed to it
 * Should only be called from an action in a form.
 * 
 * Author: Aaron Holland
 */
include("database.php"); 

class Process
{
	/*
	 * This function calls a class function based on what form was submitted.
	 * If no form was submitted and this page was just linked to it will logout.
	 */
	public function Process(){
		if(isset($_POST['sublogin'])){
			$this->login();
		}else if(isset($_POST['subnewpass'])){
			$this->passreset();
		}else if(isset($_POST['subpassword'])){
			$this->newpassword();
		}else if(isset($_POST['subregister'])){
			$this->register();
		}else{
			$this->logout();
		}
	}
	private function login(){
		global $database;
				
		$passwordcheck = $database->checkPassword($_POST['email'], $_POST['pass']);
		
		if($passwordcheck != 0){
			if($passwordcheck == 1){
				die("that user doesn't exist");
			}else if($passwordcheck == 2){
				die("Your password is incorrect");
			}else{
				die("Something went wrong while trying to login");
			}
		}else{
			session_start();
			if(isset($_COOKIE['username'])){
			   setcookie("username", "", mktime()-300, "/");
			}
			unset($_SESSION['username']);
			$_SESSION['username'] = $_POST['email'];
			
			if (isset($_POST['remember'])){
				setcookie("username", $_POST['username'], mktime()+86400, "/");
			}
						
			header('Location: /');
		}

	}
	private function newpassword(){
		global $database;
		
		//compare password fields
		if ($_POST['password1'] == $_POST['password2']){
			$password = $database->createPassword($_POST['password1']);
			$database->updatePassword($password, $_SESSION['username']); 
		}
		else if(empty($_POST['password1']) == $_POST['password2']){
			
		}
		else{
			//set session variable for error message
		}
		header('Location: settings.php');
	}
	private function passreset(){
		global $database, $mailer;
		
		$exist = $database->checkEmailExist($_POST['temail']);
		if($exist){
			$mailer->sendResetLink($_POST['temail']);
			$_SESSION['error'] = false;
		}
		else{
			$_SESSION['error'] = true;
		}
		header('Location: forgotpassword.php');
	}
	private function register(){
		global $database;

		$required = array('team','namefirst','namelast','email','pass','type');

		$error = false;
		foreach($required as $field) {
		  	if (empty($_POST[$field])) {
		    	$error = true;
		  	}
		}

		if ($error) {
		  	echo "All fields are required.";
		} else {
			$password = $database->createPassword($_POST['pass']);
			$database->createNewUser($_POST['team'], $_POST['namefirst'], $_POST['namelast'], $_POST['email'], $password, $_POST['type']);
			header('Location: /');
		}
	}
	private function logout(){
		session_start();
		if(isset($_COOKIE['username'])){
		   setcookie("username", "", mktime()-300, "/");
		}
		unset($_SESSION['username']);
		session_destroy();
				
		header('Location: /');

	}
	
};

$process = new Process;

?>