<?php
	include("_connections/connection.php");
	session_start();
	include("protegerpagina.php");
	protegerPagina();	
?>
<!DOCTYPE html>
<html>
	<head>
		<title>TCC HTML Log</title>
		<link rel = "stylesheet" href="_styles/style-log.css" type="text/css" media="all">
	</head>
	<body>
		<div id = "container">
			<div id = "topo"> 
				<img id ="image" src ="_images/logoteste.png"/>
			</div>
			<div id = "menu"> 
				<ul>
					<li><a href="my-index.php">Ínicio</a></li>
					<li><a href="contato.php">Contato</a></li>
					<li><a href="user-login.php">Painel</a></li>
				</ul>
			</div>
			<div id = "conteudo"> 
				<?php
						$verificar = mysqli_query($Conexao, "SELECT * FROM log ORDER BY ID");
						$row = mysqli_num_rows($verificar);
						if($row <= 0){
							echo "Não há resgistros";
						}
						else{
								while($array = mysqli_fetch_array($verificar)){
									$tag = $array["Tag"];
									$data = $array["Data"];
								}
						}	
					?>
					<h1> <?php echo $tag ?></h1>
					<h6> <?php echo $data ?></h6>
			</div>
			<div id = "rodape"> 
				<span> RFID Security 2019 - Todos os Direitos reservados. Feito por Bruno Mestanza</span>
			</div>
		</div>
	</body>
</html>