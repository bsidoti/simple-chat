<?php
session_start();
require "Pusher.php";
require "globals.php";
require "User.php";
$user = new User();
$sql = "INSERT INTO messages (message, user_id) VALUES ('".mysql_escape_string($_POST['message'])."','".$user->id."')";
if(!mysql_query($sql)){		
	exit("query failed");
}

//Send a message to everyone logged into the chat room
$qry = mysql_fetch_row(mysql_query("SELECT created_at FROM messages WHERE id='".mysql_insert_id()."'"));
$timestamp = $qry[0];
$pusher = new Pusher (PUSHER_KEY, PUSHER_SECRET, PUSHER_APP);
$content = array(
	'username'=>$user->username,
	'message'=>$_POST['message'],
	'created_at'=>$timestamp
);
$pusher->trigger('chat_channel', 'new-message', $content);
?>