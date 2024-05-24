<?php

include_once("../classes/vendas.php");
include_once("../classes/conexao.php");

$registro = new vendas();

$id_pv = $_GET["id"];

$tentativa = $registro->excluir_produto_venda($id_pv);

if ($tentativa > 0) {
    //echo "<script language='javascript'>window.alert('Produto Removido com sucesso'); </script>";
    echo "<script language='javascript'>window.location='../inicio.php?vendas'; </script>";
}else{
    echo "<script language='javascript'>window.alert('Erro ao Remover Produto'); </script>";
    echo "<script language='javascript'>window.location='../inicio.php?vendas'; </script>";
}