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

$consulta = "SELECT * FROM adm WHERE email = '$email'";
$resultado = mysqli_query($conexao, $consulta);
$dado = mysqli_fetch_array($resultado);                    	
$linha = mysqli_num_rows($resultado);
if ($linha > 0) {
	$senha_banco = $dado["senha"];
    if (password_verify($senha, $senha_banco)) {
    	if ($dado["situacao"] == 2) {
    		echo "<script language='javascript'>window.alert('Seu usuario foi desativado, entre em contato com o administrador do sistema'); </script>";
			echo "<script language='javascript'>window.location='../login_adm.php'; </script>";
    	}else{
			$_SESSION['id_adm'] = $dado["id_adm"];
			$_SESSION['usuario'] = $dado["email"];
			$_SESSION['nome'] = $dado["nome"];
			var_dump($_SESSION['usuario']);
			header('Location:../inicio.php');
		}
	}else{
		echo "<script language='javascript'>window.alert('login ou senha invalido'); </script>";
		echo "<script language='javascript'>window.location='../login_adm.php'; </script>";
	}
}else{
	echo "<script language='javascript'>window.alert('login ou senha invalido'); </script>";
	echo "<script language='javascript'>window.location='../login_adm.php'; </script>";
}
 ?>