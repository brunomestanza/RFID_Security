<?php
	$Conexao = mysqli_connect("localhost", "root", "", "rfid");
	// $Conexao2 = mysqli_connect("localhost", "elias", "elias12345", "rfid");
	if ($Conexao->connect_error){
		printf("Erro MySQLi: %s\n", $Conexao->connect_error);
		exit();
	}
?>