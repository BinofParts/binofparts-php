<?
/**
 * This will take care of checking if the user is logged in. 
 * Also will see if they are an admin. 
 * Should be included on every page.
 */
include("database.php");

class Session
{
	var $logged_in;
	var $userinfo = array();
	var $username;
	var $team;
	var $type;
	var $name;
	//var $joindate;
	var $referrer;
	var $currentpage;
	
	function Session(){
		session_start();
		$this->logged_in = $this->checkLogin();
		$this->currentpage = substr($_SERVER["SCRIPT_NAME"],strrpos($_SERVER["SCRIPT_NAME"],"/")+1);
		
		if(isset($_SESSION['referrer'])){
			$this->referrer = $_SESSION['referrer'];
		}
		else{
			$this->referrer = "/";
		}
		$_SESSION['referrer'] = $this->currentpage;
	}
	function checkLogin(){
		global $database;
				
		if(isset($_COOKIE['username'])){
	         $this->username = $_SESSION['username'] = $_COOKIE['username'];
	      }
		
	  	if(isset($_SESSION['username'])){
	         /* Confirm that username is valid */
	         if($database->confirmUser($_SESSION['username']) != 0){
	            /* Variables are incorrect, user not logged in */
	            unset($_SESSION['username']);
				setcookie("username", '', mktime()-3000, "/");
	            return false;
	         }

	         /* User is logged in, set class variables */
	         $this->userinfo  = $database->getUserInfo($_SESSION['username']);
	         $this->username  = $this->userinfo['email'];
			 $this->team     = $this->userinfo['team'];
			 $this->type	=  $this->userinfo['type'];
			 $this->name	=  $this->userinfo['namefirst'];
			 $this->name	.= " ";
			 $this->name	.=  $this->userinfo['namelast'];
			 $this->admin = $this->userinfo['admin'];
			 //$this->joindate  = $this->userinfo['joindate'];
	         return true;
	      }
	      /* User not logged in */
	      else{
	         return false;
	      }
	}	
};

$session = new Session;

?>