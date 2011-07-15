<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" type = "text/css" href="style/reset.css"/>
<link rel="stylesheet" type = "text/css" href="style/style.css"/>
</head>
<body>
<div id="header">
	<h1>Braden Sidoti</h1>
	This is a simple chat application using Pusher API
</div>

<div id="login">
	<h2>Login:</h2>
	<form action="<?php echo WEB_ROOT; ?>" method="post">	
	<input type="text" placeholder="Username" name="username" value="<?php echo(isset($_POST['username']) ? $_POST['username']:''); ?>"/>	
	<br>
	<input type="password" placeholder="Password" name="password" />
	<br>
	<div class="errors"><?php if(isset($error_login)) echo $error_login; ?></div>
	<input type="submit" name="login" value="Login" />
	</form>
	<br>
	<br>	
	<h2>Register:</h2>
	<form action="<?php echo WEB_ROOT; ?>" method="post">	
	<input type="text" placeholder="Username" name="reg_username" value="<?php echo(isset($_POST['reg_username']) ? $_POST['reg_username']:''); ?>"/>
	<br>	
	<input type="password" placeholder="Password" name="reg_password" />
	<br>
	<input type="password" placeholder="Confirm Password" name="reg_password_conf" />
	<br>
	<div class = "errors"><?php if(isset($error_register)) echo $error_register; ?></div>
	<input type="submit" name="register" value="Register" />
	</form>
</div>

</body>
</html>