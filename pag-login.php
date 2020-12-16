<?php
	$ipPlayer = $_SERVER["REMOTE_ADDR"]; //Função para verificar o IP
	include("_connections/connection.php");	//Inclue o arquivo da conexão com o banco de dados
?>
<!DOCTYPE html>
<html>
	<head>
		<title>RFID LOGIN - ADM</title> <!--Titulo da aba-->
		<link rel="stylesheet" href="_styles/style-pag-login.css" type="text/css" media="all"/> <!--Definicao do estilo do site-->
	</head>
	<body id = "corpo">
		<div id = "container">
			<div id = "divisao"> <!--Divisao que recebe toda a página-->
				<h1>RFID SECURITY </H1> <!--Titulo do site-->
				<form id = "login" method="POST"> <!--Responsavel por fazer com que haja submissão dos dados a um servidor Web-->
					<input id = "dados" type="text" placeholder="Usuário" name="input_User"> <!--Campo para inserção do usuário-->
					<input id = "dados" type="password" placeholder="Senha" name="input_Pass"><br><br> <!--Campo para inserção do senha-->
					<input id = "button" type="submit" name="button" value="Entrar"> <!--Botão para confirmar os dados inseridos e autenticar-->
				<img id="logo" src="images/logoteste.png"/> <!--Inserção da imagem-->
				</form>
				<span class="span_IP"> <h4>Por segurança seu endereço de IP (<b> <?php echo $ipPlayer; ?> </b>) foi registrado!</h4></span> <!--Mostra o IP caputurado-->
			</div>
		</div>
	</body>
</html>

<?php
	if(isset($_POST["button"])){
		$user = mysqli_real_escape_string($Conexao, $_POST["input_User"]);
		$pass = mysqli_real_escape_string($Conexao, $_POST["input_Pass"]);
		if($user == "" OR $pass == ""){
			echo "<script> alert('Preencha todos os campos'); location.href='pag-login.php'</script>"; //Erro se o usuário deixar a senha ou o login sem preencher
		}	
		$check = mysqli_query($Conexao, "SELECT * FROM usuarios WHERE Usuario = '$user' AND Senha = '$pass'") or die (mysqli_error($Conexao));
		$row = mysqli_num_rows($check);
		if ($row > 0){
			$check2 = mysqli_query($Conexao, "SELECT Permissao FROM usuarios WHERE Usuario = '$user'");
			$row2 = mysqli_num_rows($check2);
			$dadosusuario = mysqli_fetch_array($check2); 
			if ($dadosusuario["Permissao"] == 1){
				echo "<script> alert('Bem vindo ao Painel de controle'); location.href='panel.php'</script>"; //Simulção de usuário administrativo com permissão
				session_start();
				$_SESSION["Usuario"] = $user;
			}
			else{
				echo "<script> alert('Você não possui permissão'); location.href='pag-login.php'</script>";
			}
		}
		else{
			echo "<script> alert('Usuario ou Senha Incorretos'); location.href='pag-login.php'</script>"; 
		}
	}
?>