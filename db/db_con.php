<?php
	$db_username="root";
	$db_password="";
	$db_name="db1";
	$conn= mysqli_connect("localhost",$db_username,$db_password,$db_name);
if(!$conn)
	{ 
		die("Connection Failed: ".mysqli_connect_error());
	} 
else
	{
		echo "successful";		
	}

?>