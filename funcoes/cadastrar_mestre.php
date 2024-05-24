<?php

include_once("../classes/adm_mestre.php");

$registros = new adm_mestre();

$nome1 = $_POST["nome1"];
$nome2 = $_POST["nome2"];
$nome = $nome1." ".$nome2;
$email = $_POST["email"];
$senha1 = $_POST["senha1"];
$senha2 = $_POST["senha2"];

if ($senha1 != $senha2 or $senha2 != $senha1) {
	echo "<script language='javascript'>window.alert('As senhas estão diferentes, por favor tente novamente'); </script>";
    echo "<script language='javascript'>window.location='../inicio.php?adm_mestre'; </script>";
}else{
	$senha = password_hash($senha1, PASSWORD_DEFAULT);

	$tentativa = $registros->registrar_adm_mestre($nome, $email, $senha);
	if ($tentativa > 0) {
        echo "<script language='javascript'>window.alert('Adiministrador Cadastrado com sucesso'); </script>";
        echo "<script language='javascript'>window.location='../login_mestre.php'; </script>";
    }else{
        echo "<script language='javascript'>window.alert('Erro ao Cadastrar'); </script>";
        echo "<script language='javascript'>window.location='../registrar_mestre.php'; </script>";
    }
}
