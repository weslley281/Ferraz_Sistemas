<?php

include_once("../classes/produtos.php");
$registro = new produtos();

$id_produto = $_POST["id_produto"];
$id_categoria = $_POST["id_categoria"];
$produto = $_POST["produto"];
$descricao = $_POST["descricao"];
$codigo = $_POST["codigo"];
$quantidade = $_POST["quantidade"];
$preco = $_POST["preco"];

$tentativa = $registro->editar_produto($id_produto, $id_categoria, $produto, $descricao, $codigo, $quantidade, $preco);
if ($tentativa > 0) {
    echo "<script language='javascript'>window.alert('Produto Editado com sucesso'); </script>";
    echo "<script language='javascript'>window.location='../produtos.php'; </script>";
}else{
    echo "<script language='javascript'>window.alert('Erro ao Editar'); </script>";
    echo "<script language='javascript'>window.location='../produtos.php'; </script>";
}
