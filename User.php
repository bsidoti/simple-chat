<?php
class User {
	public $username;
	public $id;
	public $loggedIn;
	
	function __construct(){
		$this->loggedIn = false;
		if(isset($_SESSION['username'])){
			$this->username = $_SESSION['username'];
			$this->id = $_SESSION['id'];
			$this->loggedIn = true;						
		}
	}	
	function login($username,$pass){
		$pass = self::encrypt($pass);
		if(self::checkUser($username,$pass)){			
			$_SESSION['username'] = $username;			
			$id = self::getUserId($username);
			$_SESSION['id'] = $id;
			$this->username = $username;
			$this->id = $id;
			$this->loggedIn = true;
			return array('success'=>true);
		} else {
			return array('success'=>false, 'error' => "Username/password combination invalid");
		}
	}
	static function getUserId($un){
		$sql = "SELECT id FROM users WHERE username='".mysql_escape_string($un)."'";
		$qry = mysql_fetch_row(mysql_query($sql));
		return $qry[0];
	}
	static function checkUser($un,$pass){
		$sql = "SELECT COUNT(*) FROM users WHERE username='".mysql_escape_string($un)."' AND pw='".mysql_escape_string($pass)."'";
		$qry = mysql_fetch_row(mysql_query($sql));
		return $qry[0]==1;
	}
	static function encrypt($str){
		return md5($str."g7^&%*Guigyr65(*pojkl89");
	}
	static function logout(){
		session_destroy();
	}
	function register($un, $password, $conf_password){
		if($password != $conf_password){
			return array('success'=>false, 'error' => "Passwords don't match");
		}else if (strlen($un) < 3){
			return array('success'=>false, 'error' => "Your username must be atleast 3 characters");
		}else if (strlen($password) < 3){
			return array('success'=>false, 'error' => "Your password must be atleast 3 characters");
		}
		$sql = "SELECT COUNT(*) FROM users WHERE username='".mysql_escape_string($un)."'";
		$qry = mysql_fetch_row(mysql_query($sql));
		if($qry[0]>0){
			return array('success'=>false, 'error' => "This username already exists in our database");
		}
		$sql = "INSERT INTO users (username,pw) VALUES ('".mysql_escape_string($un)."','".mysql_escape_string(self::encrypt($password))."')";		
		if(mysql_query($sql)){	
			$this->login($un, $password);
			return array('success'=>true);			
		} else {
			return array('success'=>false ,'error' => "failure");
		}
	}
}
?>