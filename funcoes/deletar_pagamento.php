<?php

include_once("../classes/pagamentos.php");
include_once("../classes/conexao.php");

$registro = new pagamentos();

$id_fp = $_GET["id"];

$tentativa = $registro->excluir_pagamento($id_fp);

if ($tentativa > 0) {
    //echo "<script language='javascript'>window.alert('Categoria Excluida com sucesso'); </script>";
    echo "<script language='javascript'>window.location='../pagamentos.php'; </script>";
}else{
    echo "<script language='javascript'>window.alert('Erro ao Excluir'); </script>";
    echo "<script language='javascript'>window.location='../pagamentos.php'; </script>";
}