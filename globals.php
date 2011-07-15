<?php
	//Database Credentials
	define("DB_HOST","localhost"); 
	define("DB_USER","root"); //e39m5_bs
	define("DB_PASS",""); //yiTMhVa9grXd
	define("DB_NAME","simp_chat"); //e39m5_simp_chat

	//Connect to Database
	$conn = mysql_connect(DB_HOST,DB_USER,DB_PASS) or die ('Error connecting to mysql');
	mysql_select_db(DB_NAME);

	//Pusher Credentials
	define("PUSHER_KEY",'58f74697ee6b3d475dc2');
	define("PUSHER_APP",'6891');
	define("PUSHER_SECRET",'8088555d235b21c4bf4a');
	
	//Other Credentials
	define("WEB_ROOT","http://localhost/simp_chat/");
	
?>