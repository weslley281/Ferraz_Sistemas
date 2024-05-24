<?php

include_once("../classes/vendas.php");
include_once("../classes/conexao.php");
$c = new conectar();
$conexao = $c->conexao();

$registro = new vendas();

$id_caixa = $_POST["id_caixa"];
$id_venda = $_POST["id_venda"];
$id_funcionario = $_POST["id_funcionario"];
$codigo = $_POST["codigo"];
$id_adm = $_POST["id_adm"];
$quantidade = $_POST["quantidade"];

$busca = "SELECT * FROM produtos WHERE codigo = '$codigo' and id_adm = '$id_adm'";
$resultado = mysqli_query($conexao, $busca);
$produto = mysqli_fetch_array($resultado);
$id_produto = $produto["id_produto"];
$valor = $produto["preco"];

$tentativa = $registro->registrar_venda($id_caixa, $id_venda, $id_produto, $id_funcionario, $valor, $quantidade);

if ($tentativa > 0) {
    echo "<script language='javascript'>window.alert('Produto inserido com sucesso'); </script>";
    echo "<script language='javascript'>window.location='../inicio.php?vendas'; </script>";
}else{
    echo "<script language='javascript'>window.alert('Erro ao Inserir Produto'); </script>";
    //echo "<script language='javascript'>window.location='../inicio.php?vendas'; </script>";
}