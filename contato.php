<!DOCTYPE html>
<html>
	<head>
		<title>RFID Security - Contato</title>
		<link rel = "stylesheet" href="_styles/style-contato.css" type="text/css" media="all">
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
				<div id = "contato">
					<form action = "" method = "POST">
						<h4>Email: rfidcontato@gmail.com</h4>
						<h4>Telefone: (12) 3920-4040</h4>
						<input name="nome" type="text" id="nome" placeholder="Usuário"/> <br>
						<input name="assunto" type="text" id="assunto" placeholder="Assunto"/> <br>
						<input name="email" type="text" id="email" placeholder="example@email.com"/> <br>
						<textarea name="texto" id="texto" placeholder="Digite o texto aqui"> </textarea> <br>
						<input name="button" type="submit" id="button" value="Enviar">
						<?php
							if(isset($_POST["button"])){
								$nome = $_POST["nome"];
								$assunto = $_POST["assunto"];
								$email = $_POST["email"];
								$texto = $_POST["texto"];
								
								if($nome == "" || $assunto == "" || $email == "" || $texto == ""){
									echo "<script> alert('Preencha todos os campos'); location.href='contato.php'</script>";
								}
								$corpoEmail = "
									Email = $email
									Nome = $nome
									
									$texto
								";
								$Enviar = mail("rfidcontato@gmail.com", $assunto, $corpoEmail);
								echo "<script> alert('E-mail enviado com sucesso'); location.href='contato.php'</script>";
							}
						?>
					</form>
				</div>
			</div>
			<div id = "rodape">
				<span> RFID Security 2019 - Todos os Direitos reservados. Feito por Bruno Mestanza</span>
			</div>

		</div>
	</body>
</html>