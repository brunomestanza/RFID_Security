<?php
	include("_connections/connection.php");
	session_start();
	include("protegerpagina.php");	
	protegerPagina();	
?>
<!DOCTYPE html>
<html>
	<head>
		<title>TCC HTML Painel</title>
		<link rel = "stylesheet" href="_styles/style-index.css" type="text/css" media="all">
	</head>
	<body>
		<div id = "container">
			<div id = "topo"> 
				<img id ="image" src ="_images/logoteste.png"/>
			</div>
			<div id = "menu"> 
				<ul>
					<li><a href="my-index.php">Ínicio</a></li>
					<li><a href="panel.php">Painel</a></li>
					<li><a href="panel.php?func=addpostagem">Add Postagem</a></li>
					<li><a href="panel.php?func=addusuarios">Add Usuário</a></li>
					<li><a href="panel.php?func=postagem">Postagem</a></li>
					<li><a href="panel.php?func=usuarios">Usuário</a></li>
				</ul>
			</div>
			<div id = "conteudo"> 
				<?php
					error_reporting(false);
					$page = $_GET["func"];
					if(isset($page)){
						include("$page.php");
					}
					else{
						$usuario = $_SESSION["Usuario"];
						echo "<script> alert'Bem vindo ao painel de Controle $usuario'</script>";
					}
				?>
			</div>
			<div id = "rodape"> 
				<span> RFID Security 2019 - Todos os Direitos reservados. Feito por Bruno Mestanza</span>
			</div>
		</div>
	</body>
</html>