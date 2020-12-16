<?php
	$dbusername = "root";
	$dbpassword = "";
	$server = "localhost";
	
	$dbconnect = mysqli_connect($server, $dbusername, $dbpassword);
	$dbselect = mysqli_select_db($dbconnect, "rfid");
	
	$user = $_POST['user'];
	$pass = $_POST['pass'];
	$permi = $_POST['permissao'];

	$sql = "INSERT INTO rfid.usuarios (Usuario, Senha, Permissao) VALUES ('$user', '$pass', '$permi')";

	mysqli_query($dbconnect, $sql);
?>