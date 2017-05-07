<?php

	$mysql_host = 'localhost';
	$mysql_uname = 'id1029727_admin';
	$mysql_passwd = 'SzczecinZUT';
	$mysql_db = 'id1029727_blog'; 
	if(!@mysql_connect($mysql_host, $mysql_uname, $mysql_passwd) || !@mysql_select_db($mysql_db)){
		die("Connection failed.");
	}

?>