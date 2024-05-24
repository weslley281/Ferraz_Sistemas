<?php
    include_once("../classes/conexao.php");
    $c = new conectar();
    $conexao = $c->conexao(); 
    session_start();
    
    /*
    if(empty($_POST['usuario']) or empty($_POST['senha'])){
 	echo "<script language='javascript'>window.alert('login ou senha vasio'); </script>";
	echo "<script language='javascript'>window.location='../login.php'; </script>";
 	exit();

 	}*/


$email = mysqli_real_escape_string($conexao, $_POST['email']);
$senha = mysqli_real_escape_string($conexao, $_POST['senha']);
var_dump($usuario);
var_dump($senha);

$consulta = "SELECT * FROM adm_mestre WHERE email = '$email'";
$resultado = mysqli_query($conexao, $consulta);
$dado = mysqli_fetch_array($resultado);                    	
$linha = mysqli_num_rows($resultado);
if ($linha > 0) {
	$senha_banco = $dado["senha"];
    if (password_verify($senha, $senha_banco)) {
		$_SESSION['id_mestre'] = $dado["id_mestre"];
		$_SESSION['usuario'] = $dado["email"];
		$_SESSION['nome'] = $dado["nome"];
		var_dump($_SESSION['usuario']);
		header('Location:../inicio.php');
	}else{
		echo "<script language='javascript'>window.alert('login ou senha invalido'); </script>";
		echo "<script language='javascript'>window.location='../login_mestre.php'; </script>";
	}
}else{
	echo "<script language='javascript'>window.alert('login ou senha invalido'); </script>";
	echo "<script language='javascript'>window.location='../login_mestre.php'; </script>";
}
 ?>