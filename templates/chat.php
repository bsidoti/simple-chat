<!DOCTYPE html>
<html>
	<head>
		<link rel="stylesheet" type = "text/css" href="style/reset.css"/>
		<link rel="stylesheet" type = "text/css" href="style/style.css"/>
		<script src="http://js.pusherapp.com/1.8/pusher.min.js" type="text/javascript"></script>
		<script src="js/jquery-1.6.2.min.js" type="text/javascript"></script>
		<script src="js/pusher.js" type="text/javascript"></script>
		<script type="text/javascript">
		$(document).ready(function(){
			$('#new-message').submit(function(){
				$.post("messages.php",{message:$('#send-box').val()});
				$('#send-box').val("");
				return false;
			});
		});
		$(window).load(function () {
			$("#chat-box").scrollTop($("#chat-box")[0].scrollHeight); 
		});
		</script>
	</head>
	<body>
		<div id="header">
			<h1>Braden Sidoti</h1>
			This is a simple chat application using Pusher API
		</div>
		<div id="main">
			<div id="left">
				<div id="chat-box">				
					<?php
						echo $messages;
					?>				
					<div id="bottom-bar">
						<form id="new-message" action="#" method="post">
							<input id="send-box" type="text" placeholder="Type Here..." />
							<input id="send-button" type="submit" value="Send"/>
						</form>
					</div>
				</div>
			</div>
			<div id="right-box">
				<div id="my-info">
				<h3>Logged In As:</h3>
				<span id='username-my-info'><?php echo $user->username; ?></span>
				(<a href="logout.php" class="link">Logout</a>)
				</div>
				<div id="others-info">
				<h3>Other Users Online:</h3>
				
				<ul id="other-users-list">					
				</ul>
				</div>
			</div>
		</div>
	</body>
</html>