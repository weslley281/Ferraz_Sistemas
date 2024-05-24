<?php

include_once("../classes/pagamentos.php");
include_once("../classes/conexao.php");

$c = new conectar();
$conexao = $c->conexao();

$registro = new pagamentos();

$id_venda = $_GET["id"];
$id_caixa = $_GET["id_caixa"];

var_dump($id_caixa);

/*
$busca = "SELECT * FROM pagamento WHERE id_venda = '$id_venda'";
$resultado = mysqli_query($conexao, $busca);
$linha = mysqli_num_rows($resultado);
var_dump($linha);
while ($res = mysqli_fetch_array($resultado)) {
	$forma = $res["forma"];
	$valor = $res["valor"];
	var_dump($forma);
	var_dump($valor);

	if ($forma == 1) {
      $busca = "SELECT * FROM caixas WHERE id_caixa = '$id_caixa'";
      var_dump($busca);
      $resultado = mysqli_query($conexao, $busca);
      $moeda = mysqli_fetch_array($resultado);
      $dividido = $moeda["dinheiro"] - $valor;
      echo "executando <br>";

      $muda = "UPDATE caixas SET dinheiro = '$dividido' WHERE id_caixa = '$id_caixa'";
      $resultado2 = mysqli_query($conexao, $muda);
    }
    if ($forma == 2) {
      $busca = "SELECT * FROM caixas WHERE id_caixa = '$id_caixa'";
      $resultado = mysqli_query($conexao, $busca);
      $moeda = mysqli_fetch_array($resultado);
      $dividido = $moeda["debito"] - $valor;
      echo "executando2 <br>";

      $muda = "UPDATE caixas SET debito = '$dividido' WHERE id_caixa = '$id_caixa'";
      $resultado2 = mysqli_query($conexao, $muda);
    }
    if ($forma == 3) {
      $busca = "SELECT * FROM caixas WHERE id_caixa = '$id_caixa'";
      $resultado = mysqli_query($conexao, $busca);
      $moeda = mysqli_fetch_array($resultado);
      $dividido = $moeda["credito"] - $valor;

      $muda = "UPDATE caixas SET credito = '$dividido' WHERE id_caixa = '$id_caixa'";
      $resultado2 = mysqli_query($conexao, $muda);
    }
    if ($forma == 4) {
      $busca = "SELECT * FROM caixas WHERE id_caixa = '$id_caixa'";
      $resultado = mysqli_query($conexao, $busca);
      $moeda = mysqli_fetch_array($resultado);
      $dividido = $moeda["outros"] - $valor;

      $muda = "UPDATE caixas SET outros = '$dividido' WHERE id_caixa = '$id_caixa'";
      $resultado2 = mysqli_query($conexao, $muda);
    }

    
}

if ($resultado2 > 0) {
	$tentativa = $registro->excluir_pagamento($id_venda);
}else{
	$tentativa = 0;
}
*/
$tentativa = $registro->excluir_pagamento($id_venda);

if ($tentativa > 0) {
    echo "<script language='javascript'>window.location='../inicio.php?vendas'; </script>";
}else{
    echo "<script language='javascript'>window.alert('Erro ao Limpar pagamentos'); </script>";
    echo "<script language='javascript'>window.location='../inicio.php?vendas'; </script>";
}