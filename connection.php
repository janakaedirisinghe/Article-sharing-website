<?php 
	
	$dbhost = "localhost";
	$dbuser = "root";
	$dbpass = "";
	$dbname = "postshare";

	$connect = mysqli_connect($dbhost,$dbuser,$dbpass,$dbname);

	if (mysqli_connect_errno()) {
		echo mysqli_connect_error();
	}else{
		//echo "successfully connected";
	}



 ?>