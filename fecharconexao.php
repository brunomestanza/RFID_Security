<?php
	function fecharconexao() {
		if(isset($_POST["fechar"])){
		mysqli_close($Conexao);
		mysqli_close($Conexao2);
		}
	}
?>