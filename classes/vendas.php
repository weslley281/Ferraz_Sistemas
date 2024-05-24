<?php 
 include_once("conexao.php");
 date_default_timezone_set('America/Cuiaba');
 
 Class vendas{

 	public function registrar_venda($id_caixa, $id_venda, $id_produto, $id_funcionario, $valor, $quantidade){
 		$c = new conectar();
 		$conexao = $c->conexao();

    //ve se o produto já foi inserido
 		$busca_vendas = "SELECT * FROM produto_venda WHERE id_caixa = '$id_caixa' and id_produto = '$id_produto' and id_venda = '$id_venda'";
        $resultado_vendas = mysqli_query($conexao, $busca_vendas);
        $pv = mysqli_fetch_array($resultado_vendas);
        $linha_vendas = mysqli_num_rows($resultado_vendas);
        var_dump($busca_vendas);
        var_dump($linha_vendas);
    // insere se for verdadeiro
    if($linha_vendas == ''){
	 		$inserir = "INSERT INTO produto_venda (id_venda, id_caixa, id_produto, quantidade, valor) VALUES ('$id_venda', '$id_caixa', '$id_produto', '$quantidade', '$valor')";
      var_dump($inserir);
	 		$resultado = mysqli_query($conexao, $inserir);
      var_dump($resultado);
	 	}else{
	 		$id_pv = $pv["id_pv"];
	 		$quantidade2 = $pv["quantidade"] + 1;
	 		$consulta = "UPDATE produto_venda SET quantidade = '$quantidade2' WHERE id_pv = $id_pv";
 			$resultado = mysqli_query($conexao, $consulta);
	 	}

 		return $resultado;
 	}

 	public function editar_quantidade($id_pv, $quantidade){
 		$c = new conectar();
 		$conexao = $c->conexao();

 		$consulta = "UPDATE produto_venda SET quantidade = '$quantidade' WHERE id_pv = $id_pv";
 		$resultado = mysqli_query($conexao, $consulta);

 		return $resultado;
 	}

 	public function excluir_produto_venda($id_pv){
 		$c = new conectar();
		$conexao=$c->conexao();

		$deletar = "DELETE FROM produto_venda where id_pv = '$id_pv'";
		$resultado = mysqli_query($conexao, $deletar);

		return $resultado; 
 	}

 	public function finalizar_venda($id_venda, $id_caixa, $total, $troco, $valor_pago){
 		$c = new conectar();
 		$conexao = $c->conexao();
 		$situacao = 1;
 		$data_venda = date("Y,m,d");
 		$hora_venda = date("H:i:s");

 		$consulta = "UPDATE vendas SET id_caixa = '$id_caixa', total = '$total', troco = '$troco', valor_pago = '$valor_pago', situacao = '$situacao', data_venda = '$data_venda', hora_venda = '$hora_venda' WHERE id_venda = '$id_venda'";
 		$resultado = mysqli_query($conexao, $consulta);
 		//var_dump($consulta);
 		return $resultado;
 	}

 	public function cancelar_venda($id_venda){
 		$c = new conectar();
 		$conexao = $c->conexao();
 		$situacao = 3;

 		$consulta = "UPDATE vendas SET situacao = '$situacao' WHERE id_venda = '$id_venda'";
 		$resultado = mysqli_query($conexao, $consulta);
 		//var_dump($consulta);
 		return $resultado;
 	}

 	public function remove_produto($id_venda){
 		$c = new conectar();
 		$conexao = $c->conexao();
 		var_dump($id_venda);
 		echo "<br>";

 		$busca_pv = "SELECT * FROM produto_venda WHERE id_venda = '$id_venda'";
 		var_dump($busca_pv);
 		echo "<br>";
 		
        $resultado_pv = mysqli_query($conexao, $busca_pv);

        $linha_pv = mysqli_num_rows($resultado_pv);
 		var_dump($linha_pv);
 		echo "linha <br>";
        
        while ($pv = mysqli_fetch_array($resultado_pv)) {

        	$id_produto = $pv["id_produto"];
        	var_dump($id_produto);
 			echo "<br>";
        	$quantidade_vendida = $pv["quantidade"];
        	var_dump($quantidade_vendida);
 			echo "<br>";

        	$busca_produto = "SELECT * FROM produtos WHERE id_produto = '$id_produto'";
       		$resultado_produto = mysqli_query($conexao, $busca_produto);
       		$produto = mysqli_fetch_array($resultado_produto);
       		var_dump($busca_produto);
 			echo "<br>";
       		$quantidade_estoque = $produto["quantidade"];
       		var_dump($quantidade_estoque);
 			echo "<br>";

       		$nova_quantidade = $quantidade_estoque - $quantidade_vendida;

	 		$consulta = "UPDATE produtos SET quantidade = '$nova_quantidade' WHERE id_produto = '$id_produto'";
	 		var_dump($consulta);
 			echo "<br>";
	 		$resultado = mysqli_query($conexao, $consulta);
	 		//var_dump($consulta);
	 		return $resultado;
 		}
 	}

 	public function receber_pagamento($id_adm, $id_funcionario, $id_venda, $id_caixa, $forma, $valor){
 		$c = new conectar();
 		$conexao = $c->conexao();
 		$data_pagamento = date("Y,m,d");

 		$inserir = "INSERT INTO pagamento (id_adm, id_funcionario, id_venda, id_caixa, forma, valor, data_pagamento) VALUES ('$id_adm', '$id_funcionario', '$id_venda', '$id_caixa', '$forma', '$valor', '$data_pagamento')";
 		$resultado = mysqli_query($conexao, $inserir);
    //var_dump($inserir);

 		return $resultado;
 	}
 }
 ?>