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
$valor = $_POST["suprimento"];
        
$tentativa = $registro->suprimento($id_adm, $id_funcionario, $id_caixa, $descricao, $valor);
if ($tentativa > 0) {
	echo "<script language='javascript'>window.alert('suprimento efetuado com Sucesso'); </script>";
    echo "<script language='javascript'>window.location='../inicio.php?vendas'; </script>";
}else{
	echo "<script language='javascript'>window.alert('Erro ao efetuar suprimento'); </script>";
    echo "<script language='javascript'>window.location='../inicio.php?vendas'; </script>";
}