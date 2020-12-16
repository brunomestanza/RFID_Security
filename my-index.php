<?php
	include("_connections/connection.php");
?>
<!DOCTYPE html>
<html>
	<head>
		<title>TCC HTML Index</title>
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
					<li><a href="contato.php">Contato</a></li>
					<li><a href="user-login.php">Painel</a></li>
				</ul>
			</div>
			<div id = "conteudo"> 
				<div id = "postagens">
					<?php
						$verificar = mysqli_query($Conexao, "SELECT * FROM postagens ORDER BY ID");
						$row = mysqli_num_rows($verificar);
						if($row <= 0){
							echo "Não há postagens para serem exibidas!";
						}
						else{
							while($array = mysqli_fetch_array($verificar)){
								$titulo = $array["Titulo"];
								$postagens = $array["Postagens"];
								$data = $array["Data"];
								$autor = $array["Autor"];
							}
						}
						
					?>
					<h1> <?php echo $titulo ?></h1>
					<h6> <?php echo $data ?></h6>
					<h5> <?php echo $autor ?></h5>
					<p>  <?php echo $postagens ?></p>
				</div>
			</div>
			<div id = "rodape"> 
				<span> RFID Security 2019 - Todos os Direitos reservados. Feito por Bruno Mestanza</span>
			</div>
		</div>
	</body>
</html>