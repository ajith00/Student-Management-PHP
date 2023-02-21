<?php

/*date_default_timezone_set('Asia/Kolkata');

$conn = mysqli_connect('localhost','rbanms123','rbanms#@!123');
if(!$conn) die("Failed to connect database!");
$status = mysqli_select_db($conn,'rbanms_live');
if(!$status) die("Failed to select database!");*/
date_default_timezone_set('Asia/Kolkata');
	$db_username="root";
	$db_password="";
	$db_name="db2";
	$conn= mysqli_connect("localhost",$db_username,$db_password,$db_name);
if(!$conn)
	{ 
		die("Connection Failed: ".mysqli_connect_error());
	} 
else
	{
		echo('<script>console.log("db connected")</script>');
	}

?>