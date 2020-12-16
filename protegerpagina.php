<?php
	function protegerPagina() {
		if (!isset($_SESSION["Usuario"])){
			echo "<script> location.href='my-index.php' </script>";
		}
	}
?>