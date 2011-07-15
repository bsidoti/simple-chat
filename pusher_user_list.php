<?php
session_start();
header('Content-Type: application/json');
require "Pusher.php";
require "globals.php";
require "User.php";
$user = new User();
$pusher = new Pusher (PUSHER_KEY, PUSHER_SECRET, PUSHER_APP);
$presence_data = array('name' => $_SESSION['username']);
echo $pusher->presence_auth($_POST['channel_name'], $_POST['socket_id'], $user->id, $presence_data);
?>