<?php 
 include_once("conexao.php");

 Class pagamentos{

 	public function registrar_pagamento($forma_pagamento){
 		$c = new conectar();
 		$conexao = $c->conexao();

 		$inserir = "INSERT INTO forma_pagamento (forma_pagamento) VALUES ('$forma_pagamento')";
 		$resultado = mysqli_query($conexao, $inserir);

 		return $resultado;
 	}

 	public function editar_pagamento($id_fp, $forma_pagamento){
 		$c = new conectar();
 		$conexao = $c->conexao();

 		$consulta = "UPDATE forma_pagamento SET forma_pagamento = '$forma_pagamento' WHERE id_fp = $id_fp";
 		$resultado = mysqli_query($conexao, $consulta);

 		return $resultado;
 	}

 	public function excluir_pagamento($id_venda){
 		$c = new conectar();
		$conexao=$c->conexao();

		$deletar = "DELETE FROM pagamento where id_venda = '$id_venda'";
		$resultado = mysqli_query($conexao, $deletar);

		return $resultado; 
 	}
 }
 ?>