<?php 
 include_once("conexao.php");

 Class dados{

 	public function editar_dado($id_adm, $empresa, $cnpj, $telefone){
 		$c = new conectar();
 		$conexao = $c->conexao();

 		$consulta = "UPDATE dados_empresa SET id_adm = '$id_adm', empresa = '$empresa', cnpj = '$cnpj', telefone = '$telefone' WHERE id_adm = $id_adm";
 		$resultado = mysqli_query($conexao, $consulta);
 		var_dump($consulta);
 		return $resultado;
 	}
 }
 ?>