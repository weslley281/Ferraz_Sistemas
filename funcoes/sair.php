<?php 
date_default_timezone_set('America/Cuiaba');
session_start();

if (@$_SESSION['id_funcionario'] != null) {
	include_once("../classes/conexao.php");
    $c = new conectar();
    $conexao = $c->conexao();

	$id_funcionario = $_SESSION['id_funcionario'];
	$presenca = 2;
	$saiu = date("H:i:s");
	$consulta = "UPDATE funcionarios SET presenca = '$presenca', saiu = '$saiu' WHERE id_funcionario = '$id_funcionario'";
 	$resultado = mysqli_query($conexao, $consulta);
 	var_dump($consulta);
}

session_destroy();


header("location:../login.php");

 ?>