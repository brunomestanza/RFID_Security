<?php
	$dbusername = "root";
	$dbpassword = "";
	$server = "localhost";
	
	$dbconnect = mysqli_connect($server, $dbusername, $dbpassword);
	$dbselect = mysqli_select_db($dbconnect, "rfid");
	
	$request = $_GET['request'];
	
	echo "Teste: " . $request;
	
	$sql = "INSERT INTO rfid.log (Tag) VALUES ('$request')";
	
	mysqli_query($dbconnect, $sql);
?>