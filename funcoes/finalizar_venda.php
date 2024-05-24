<?php

include_once("../classes/vendas.php");
include_once("../classes/conexao.php");
$c = new conectar();
$conexao = $c->conexao();

$registro = new vendas();

$id_caixa = $_POST["id_caixa"];
$id_venda = $_POST["id_venda"];
$total = $_POST["total"];
$troco = $_POST["troco"];
$valor_pago = $_POST["valor_pago"];

$tentativa = $registro->finalizar_venda($id_venda, $id_caixa, $total, $troco, $valor_pago);

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
       		$nova_quantidade = $quantidade_estoque - $quantidade_vendida;

	 		$consulta = "UPDATE produtos SET quantidade = '$nova_quantidade' WHERE id_produto = '$id_produto'";

	 		$resultado = mysqli_query($conexao, $consulta);
	 	}

    echo "<script language='javascript'>window.alert('Venda Finalizada com Sucesso'); </script>";
    echo "<script language='javascript'>window.location='../inicio.php?vendas'; </script>";
}else{
    echo "<script language='javascript'>window.alert('Erro ao Finalizar Venda'); </script>";
    echo "<script language='javascript'>window.location='../inicio.php?vendas'; </script>";
}

