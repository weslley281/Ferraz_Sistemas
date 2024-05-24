<?php

include_once("../classes/vendas.php");
include_once("../classes/conexao.php");
$c = new conectar();
$conexao = $c->conexao();
session_start();

$registro = new vendas();

$id_adm = $_POST["id_adm"];
$id_venda = $_POST["id_venda"];
$id_caixa = $_POST["id_caixa"];
$forma  = $_POST["forma"];
$valor = $_POST["valor"];
$total  = $_POST["total"];
$total_pago = $_POST["total_pago"];
$troco = $total - $total_pago;
$id_funcionario = $_SESSION['id_funcionario'];

$tentativa = $registro->receber_pagamento($id_adm, $id_funcionario, $id_venda, $id_caixa, $forma, $valor);

if ($tentativa > 0) {
    echo "<script language='javascript'>window.location='../inicio.php?vendas'; </script>";
}else{
    echo "<script language='javascript'>window.alert('Erro ao Inserir Forma de Pagamento'); </script>";
    echo "<script language='javascript'>window.location='../inicio.php?vendas'; </script>";
}