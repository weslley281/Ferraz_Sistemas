<?php
    include_once("../classes/conexao.php");
    $c = new conectar();
    $conexao = $c->conexao(); 
    session_start();
    
    date_default_timezone_set('America/Cuiaba');
    
    if(empty($_POST['email']) or empty($_POST['senha'])){
 	echo "<script language='javascript'>window.alert('login ou senha vasio'); </script>";
	echo "<script language='javascript'>window.location='../login.php'; </script>";
 	exit();

 	}


$email = mysqli_real_escape_string($conexao, $_POST['email']);
$senha = mysqli_real_escape_string($conexao, $_POST['senha']);

$consulta = "SELECT * FROM funcionarios WHERE email = '$email'";
$resultado = mysqli_query($conexao, $consulta);
$dado = mysqli_fetch_array($resultado);                    	
$linha = mysqli_num_rows($resultado);
var_dump($linha);
if ($linha > 0) {
	$senha_banco = $dado["senha"];
    if (password_verify($senha, $senha_banco)) {
    	if ($dado["situacao"] == 2) {
    		echo "<script language='javascript'>window.alert('Seu usuario foi desativado, entre em contato com o seu gerente'); </script>";
			echo "<script language='javascript'>window.location='../login.php'; </script>";
    	}else{
			$_SESSION['id_funcionario'] = $dado["id_funcionario"];
			$_SESSION['usuario'] = $dado["email"];
			$_SESSION['nome'] = $dado["nome"];
			var_dump($_SESSION['usuario']);

			$id_funcionario = $dado["id_funcionario"];
			$presenca = 1;
			$entrou = date("H:i:s");
			$consulta = "UPDATE funcionarios SET presenca = '$presenca', entrou = '$entrou' WHERE id_funcionario = '$id_funcionario'";
 			$resultado = mysqli_query($conexao, $consulta);

			header('Location:../inicio.php');
		}
	}else{
		echo "<script language='javascript'>window.alert('login ou senha invalido'); </script>";
		echo "<script language='javascript'>window.location='../login.php'; </script>";
	}
}else{
	echo "<script language='javascript'>window.alert('login ou senha invalido'); </script>";
	echo "<script language='javascript'>window.location='../login.php'; </script>";
}
 ?>