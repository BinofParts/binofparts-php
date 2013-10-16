<?
/**
 * Process.php
 *
 * This class processes form data depending on what form is passed to it
 * Should only be called from an action in a form.
 * 
 * Author: Aaron Holland
 */
include('database.php');

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
		
		session_start();

		$required = array('email','pass');

		$error = false;
		foreach($required as $field) {
		  	if (empty($_POST[$field])) {
		    	$error = true;
		  	}
		}

		if ($error) {
			$_SESSION['error'] = "All fields are required.";
			header('Location: /login.php');
		}
		else{

			$passwordcheck = $database->checkPassword($_POST['email'], $_POST['pass']);
			
			if($passwordcheck != 0){
				if($passwordcheck == 1){
					$_SESSION['error'] = "Sorry, that email is not registered.";
					header('Location: /login.php');
				}else if($passwordcheck == 2){
					$_SESSION['error'] = "That password was incorrect.";
					header('Location: /login.php');
				}else if($passwordcheck == 3){
					$_SESSION['error'] = "Your account was declined access. Please contact the lead mentor for your team if this is an error.";
					header('Location: /login.php');
				}else if($passwordcheck == 4){
					$_SESSION['error'] = "Your account has been disabled. If this is an error please contact us at info(at)binofparts.com";
					header('Location: /login.php');
				}else if($passwordcheck == 5){
					$_SESSION['error'] = "Your account is currently not verified. Please contact your teams lead mentor.";
					header('Location: /login.php');
				}else{
					$_SESSION['error'] = "Something went wrong while trying to login.";
					header('Location: /login.php');
				}
			}else{
				if(isset($_COOKIE['username'])){
				   setcookie("username", "", mktime()-300, "/");
				}
				unset($_SESSION['username']);

				//TODO:
				//check if user is verified before logging them in... add another password check in database file
				//if not verified send to an unverified page
				//handle disabled and unverified accounts on this separate page. Display message on how to fix it, ie. contact us or get lead mentor to verify them.


				$_SESSION['username'] = $_POST['email'];
				
				if (isset($_POST['remember'])){
					setcookie("username", $_POST['username'], mktime()+86400, "/");
				}

				header('Location: /');
			}
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
		session_start();
		
		$required = array('team','namefirst','namelast','email','pass','type');

		$_SESSION['team'] = $_POST['team'];
		$_SESSION['namefirst'] = $_POST['namefirst'];
		$_SESSION['namelast'] = $_POST['namelast'];
		$_SESSION['email'] = $_POST['email'];

		$error = false;
		foreach($required as $field) {
		  	if (empty($_POST[$field]) && $_POST[$field] !== '0') {
		    	$error = true;
		  	}
		}

		if ($error) {
			$_SESSION['error'] = "All fields are required.";
			header('Location: /register.php');
		} else {
			if(strlen($_POST['pass']) < 6){
				$_SESSION['error'] = 'Password must be minimum 6 characters long.';
				header('Location: /register.php');
			}
			else{
				$password = $database->createPassword($_POST['pass']);
				$database->createNewUser($_POST['team'], $_POST['namefirst'], $_POST['namelast'], $_POST['email'], $password, $_POST['type']);
				if(isset($_SESSION['error'])){
					header('Location: /register.php');
				}
				else{
					header('Location: /');
				}
			}
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