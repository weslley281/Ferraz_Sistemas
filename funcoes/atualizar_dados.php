<?php

include_once("../classes/dados.php");
include_once("../classes/conexao.php");

$registro = new dados();

$id_adm = $_POST["id_adm"];
$empresa = $_POST["empresa"];
$cnpj = $_POST["cnpj"];
$telefone = $_POST["telefone"];

$tentativa = $registro->editar_dado($id_adm, $empresa, $cnpj, $telefone);

if ($tentativa > 0) {
    //echo "<script language='javascript'>window.alert('Categoria Editada com sucesso'); </script>";
    echo "<script language='javascript'>window.location='../configuracoes.php'; </script>";
}else{
    echo "<script language='javascript'>window.alert('Erro ao Editar'); </script>";
    echo "<script language='javascript'>window.location='../configuracoes.php'; </script>";
}