<?php

include_once("../classes/caixas.php");
include_once("../classes/conexao.php");

$c = new conectar();
$conexao = $c->conexao();

$registro = new caixas();

$id_adm = $_POST["id_adm"];
$id_funcionario = $_POST["id_funcionario"];
$situacao = 1;
$dinheiro = 0;
$credito = 0;
$debito = 0;
$outros = 0;

$busca = "SELECT * FROM caixas WHERE $id_funcionario = '$id_funcionario' AND situacao = '1'";
$resultado = mysqli_query($conexao, $busca);
$caixa = mysqli_fetch_array($resultado);
$linhas = mysqli_num_rows($resultado);
$data = date('d/m/Y',  strtotime($caixa["data_abertura"]));
        
if($linhas > 0){
	$tentativa = $linhas;
}else{
	$tentativa = $registro->abrir_caixa($id_adm, $id_funcionario, $situacao, $dinheiro, $credito, $debito, $outros);
}

if ($tentativa > 0) {
	if ($linhas > 0) {
		echo "<script language='javascript'>window.alert('Esse Funcionário já possui caixa aberto desde $data'); </script>";
    	echo "<script language='javascript'>window.location='../inicio.php?vendas'; </script>";
	}else{
		echo "<script language='javascript'>window.alert('Caixa Aberto com Sucesso'); </script>";
    	echo "<script language='javascript'>window.location='../inicio.php?vendas'; </script>";
	}   
}else{
    echo "<script language='javascript'>window.alert('Erro ao Abrir Caixa'); </script>";
    echo "<script language='javascript'>window.location='../inicio.php?categorias'; </script>";
}