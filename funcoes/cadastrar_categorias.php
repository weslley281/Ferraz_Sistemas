<?php

include_once("../classes/categorias.php");
include_once("../classes/conexao.php");

$registro = new categoria();

$id_adm = $_POST["id_adm"];
$categoria = $_POST["categoria"];

$tentativa = $registro->registrar_categoria($categoria, $id_adm);

if ($tentativa > 0) {
    echo "<script language='javascript'>window.alert('Categoria Cadastrada com sucesso'); </script>";
    echo "<script language='javascript'>window.location='../categorias.php'; </script>";
}else{
    echo "<script language='javascript'>window.alert('Erro ao Cadastrar'); </script>";
    echo "<script language='javascript'>window.location='../categorias.php'; </script>";
}