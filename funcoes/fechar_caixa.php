<?php

include_once("../classes/caixas.php");
include_once("../classes/conexao.php");
session_start();

$c = new conectar();
$conexao = $c->conexao();

$registro = new caixas();

$id_caixa = $_POST["id_caixa"];
$id_funcionario = @$_SESSION['id_funcionario'];
$dinheiro = $_POST["dinheiro"];
$debito = $_POST["debito"];
$credito = $_POST["credito"];
$deposito = $_POST["deposito"];

if ($dinheiro == "" or $dinheiro == 0) {
	$dinheiro = 0;
}
if ($debito == "" or $debito == 0) {
	$debito = 0;
}
if ($credito == "" or $credito == 0) {
	$credito = 0;
}
if ($deposito == "" or $deposito == 0) {
	$deposito = 0;
}

$busca = "SELECT * FROM caixas WHERE $id_funcionario = '$id_funcionario'";
$resultado = mysqli_query($conexao, $busca);
$caixa = mysqli_fetch_array($resultado);
$linhas = mysqli_num_rows($resultado);
//var_dump($linhas);

$tentativa = $registro->fechar_caixa($id_caixa, $dinheiro, $debito, $credito, $deposito);
//var_dump($tentativa);

if ($linhas == 0) {
	echo "<script language='javascript'>window.alert('Esse Caixa já Fechado'); </script>";
    echo "<script language='javascript'>window.location='../inicio.php?vendas'; </script>";
}else{
	if ($tentativa > 0) {
		echo "<script language='javascript'>window.alert('Caixa Fechado com Sucesso'); </script>";
    	echo "<script language='javascript'>window.location='../inicio.php?vendas'; </script>";
	}else{
		echo "<script language='javascript'>window.alert('Erro ao Fechar Caixa'); </script>";
    	//echo "<script language='javascript'>window.location='../inicio.php?vendas'; </script>";
	} 
}

