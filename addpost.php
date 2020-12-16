<?php
	$dbusername = "root";
	$dbpassword = "";
	$server = "localhost";
	
	$dbconnect = mysqli_connect($server, $dbusername, $dbpassword);
	$dbselect = mysqli_select_db($dbconnect, "rfid");
	
	$titulo = $_POST['titulo'];
	$post = $_POST['post'];
	$autor = $_POST['autor'];

	$sql = "INSERT INTO rfid.postagens (Titulo, Postagens, Autor) VALUES ('$titulo', '$post', '$autor')";

	mysqli_query($dbconnect, $sql);
?>