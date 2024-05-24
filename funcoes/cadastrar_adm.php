<?php

include_once("../classes/adm.php");
include_once("../classes/conexao.php");
$c = new conectar();
$conexao = $c->conexao();

$registros = new adm();

$situacao = $_POST["situacao"];
$nome1 = $_POST["nome1"];
$nome2 = $_POST["nome2"];
$nome = $nome1." ".$nome2;
$email = $_POST["email"];
$senha1 = $_POST["senha1"];
$senha2 = $_POST["senha2"];
$telefone = $_POST["telefone"];

if ($senha1 != $senha2 or $senha2 != $senha1) {
	echo "<script language='javascript'>window.alert('As senhas estão diferentes, por favor tente novamente'); </script>";
    echo "<script language='javascript'>window.location='../inicio.php?adm'; </script>";
}else{
	$senha = password_hash($senha1, PASSWORD_DEFAULT);

	$tentativa = $registros->registrar_adm($situacao, $nome, $email, $senha, $telefone);
	if ($tentativa > 0) {
        $busca = "SELECT * FROM adm WHERE email = '$email'";
        $resultado = mysqli_query($conexao, $busca);
        $adm = mysqli_fetch_array($resultado);
        $id_adm = $adm["id_adm"];
        $registros->registrar_dado($id_adm);
        echo "<script language='javascript'>window.alert('Adiministrador Cadastrado com sucesso'); </script>";
        echo "<script language='javascript'>window.location='../inicio.php?adm'; </script>";
    }else{
        echo "<script language='javascript'>window.alert('Erro ao Cadastrar'); </script>";
        echo "<script language='javascript'>window.location='../inicio.php?adm'; </script>";
    }
}
