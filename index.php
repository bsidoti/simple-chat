<?php
session_start();
require "globals.php";
require "User.php";
$user = new User();
if(isset($_POST['register'])){
	$ret = $user->register($_POST['reg_username'],$_POST['reg_password'],$_POST['reg_password_conf']);
	if(!$ret['success']){
		$error_register = $ret['error'];
	}else{
		header("location: ".WEB_ROOT);
	}
} else if(isset($_POST['login'])){
	$ret = $user->login($_POST['username'], $_POST['password']);
	if(!$ret['success']){
		$error_login = $ret['error'];
	}else{
		header("Location: ".WEB_ROOT);
	}
}

if($user->loggedIn){
	$sql = "SELECT users.username, messages.message, messages.created_at  
			FROM messages 
			JOIN users 
			ON messages.user_id = users.id 
			ORDER BY messages.created_at";
	$res = mysql_query($sql);
	$messages = '';
	$row = mysql_fetch_assoc($res);
	$messages = "<div class='message-box first'>".
						"<span class='msg-name'>". 
							$row['username'].
						"</span>".
						"<span class='msg-timestamp'>". 
							$row['created_at'].
						"</span>".
						"<span class='message'>".
							$row['message'].					
						"</span>".
					"</div>";
	while($row = mysql_fetch_assoc($res)){
		$messages .= "<div class='message-box'>".
						"<span class='msg-name'>". 
							$row['username'].
						"</span>".
						"<span class='msg-timestamp'>". 
							$row['created_at'].
						"</span>".
						"<span class='message'>".
							$row['message'].					
						"</span>".
					"</div>";
	}
	include "templates/chat.php";
}else{
	include "templates/login.php";
}
?>