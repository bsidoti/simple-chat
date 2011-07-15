<?php
session_start();
require "globals.php";
require "User.php";
$user = new User();
$user->logout();
header("Location: ".WEB_ROOT);
?>