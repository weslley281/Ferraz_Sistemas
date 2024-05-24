<?php

include_once("../classes/vendas.php");
include_once("../classes/conexao.php");
$c = new conectar();
$conexao = $c->conexao();

$registro = new vendas();

$id_venda = $_GET["id"];

$tentativa = $registro->cancelar_venda($id_venda);

if ($tentativa > 0) {
	$busca_pv = "SELECT * FROM produto_venda WHERE id_venda = '$id_venda'";
  $resultado_pv = mysqli_query($conexao, $busca_pv);
  $linha_pv = mysqli_num_rows($resultado_pv);
        
  while ($pv = mysqli_fetch_array($resultado_pv)) {

    $id_produto = $pv["id_produto"];
    $quantidade_vendida = $pv["quantidade"];

    $busca_produto = "SELECT * FROM produtos WHERE id_produto = '$id_produto'";
    $resultado_produto = mysqli_query($conexao, $busca_produto);
    $produto = mysqli_fetch_array($resultado_produto);

    $quantidade_estoque = $produto["quantidade"];
    $nova_quantidade = $quantidade_estoque + $quantidade_vendida;

	 	$consulta = "UPDATE produtos SET quantidade = '$nova_quantidade' WHERE id_produto = '$id_produto'";

	 	$resultado = mysqli_query($conexao, $consulta);
	}

  $busca_vd = "SELECT * FROM pagamento WHERE id_venda = '$id_venda'";
  $resultado_vd = mysqli_query($conexao, $busca_vd);
  while ($vd = mysqli_fetch_array($resultado_vd)) {
    $deletar = "DELETE FROM pagamento where id_venda = '$id_venda'";
    $resultado_del = mysqli_query($conexao, $deletar);
  }


    echo "<script language='javascript'>window.alert('Venda cancelada com sucesso'); </script>";
    echo "<script language='javascript'>window.location='../inicio.php?relatorio'; </script>";
}else{
    echo "<script language='javascript'>window.alert('Erro ao Cancelar'); </script>";
    echo "<script language='javascript'>window.location='../inicio.php?relatorio'; </script>";
}