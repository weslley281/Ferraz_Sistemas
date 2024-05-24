<?php
date_default_timezone_set('America/Cuiaba');
include_once("../classes/funcionarios.php");

$registros = new funcionarios();
session_start();

$id_adm = $_SESSION['id_adm'];
$situacao = $_POST["situacao"];
$nome1 = $_POST["nome1"];
$nome2 = $_POST["nome2"];
$nome = $nome1." ".$nome2;
$email = $_POST["email"];
$senha1 = $_POST["senha1"];
$senha2 = $_POST["senha2"];
$data_registro = date("Y,m,d");

if ($senha1 != $senha2 or $senha2 != $senha1) {
	echo "<script language='javascript'>window.alert('As senhas estão diferentes, por favor tente novamente'); </script>";
    echo "<script language='javascript'>window.location='../inicio.php?funcionarios'; </script>";
}else{
	$senha = password_hash($senha1, PASSWORD_DEFAULT);

	$tentativa = $registros->registrar_funcionarios($id_adm, $situacao, $nome, $email, $senha, $data_registro);
	if ($tentativa > 0) {
        echo "<script language='javascript'>window.alert('Funcionário Cadastrado com sucesso'); </script>";
        echo "<script language='javascript'>window.location='../inicio.php'; </script>";
    }else{
        echo "<script language='javascript'>window.alert('Erro ao Cadastrar'); </script>";
        echo "<script language='javascript'>window.location='../registra_funcionario.php'; </script>";
    }
}
