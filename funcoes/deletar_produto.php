<?php

include_once("../classes/produtos.php");
$registro = new produtos();

$id_produto = $_GET["id"];
$id_imagem = $_GET["id_imagem"];

$tentativa = $registro->excluir_produto($id_produto);
if ($tentativa > 0) {
	include_once("../classes/conexao.php");
	$c = new conectar();
	$conexao = $c->conexao();
	$consulta = "SELECT * FROM imagens WHERE id_imagem = '$id_imagem'";
	$resultado = mysqli_query($conexao, $consulta);
	$imagem = mysqli_fetch_array($resultado);
	$caminho = $imagem["caminho"];
	unlink($caminho);
	$tentativa2 = $registro->excluir_imagem_produto($id_imagem);
    echo "<script language='javascript'>window.alert('Serviço Deletado com sucesso'); </script>";
    echo "<script language='javascript'>window.location='../produtos.php'; </script>";
}else{
    echo "<script language='javascript'>window.alert('Erro ao Deletar'); </script>";
    echo "<script language='javascript'>window.location='../produtos.php'; </script>";
}