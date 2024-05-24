<?php

include_once("../classes/caixas.php");
include_once("../classes/conexao.php");

$c = new conectar();
$conexao = $c->conexao();

$registro = new caixas();

$id_adm = $_POST["id_adm"];
$id_funcionario = $_POST["id_funcionario"];
$id_caixa = $_POST["id_caixa"];
$descricao = $_POST["descricao"];
$valor = $_POST["sangria"];
$saldo = $_POST["saldo"];
        
if($saldo < $valor){
	echo "<script language='javascript'>window.alert('Não possui dinheiro suficiente no caixa para fazer essa sangria'); </script>";
    echo "<script language='javascript'>window.location='../inicio.php?vendas'; </script>";
    exit();
}else{
	$tentativa = $registro->sangria($id_adm, $id_funcionario, $id_caixa, $descricao, $valor);
	if ($tentativa > 0) {
		echo "<script language='javascript'>window.alert('Sangria efetuada com Sucesso'); </script>";
    	echo "<script language='javascript'>window.location='../inicio.php?vendas'; </script>";
	}else{
		echo "<script language='javascript'>window.alert('Erro ao efetuar sangria'); </script>";
    	echo "<script language='javascript'>window.location='../inicio.php?vendas'; </script>";
	}
}