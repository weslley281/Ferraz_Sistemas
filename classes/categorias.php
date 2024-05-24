<?php 
 include_once("conexao.php");

 Class categoria{

 	public function registrar_categoria($categoria, $id_adm){
 		$c = new conectar();
 		$conexao = $c->conexao();

 		$inserir = "INSERT INTO categorias (id_adm, categoria) VALUES ('$id_adm', '$categoria')";
 		$resultado = mysqli_query($conexao, $inserir);

 		return $resultado;
 	}

 	public function editar_categoria($id_categoria, $categoria){
 		$c = new conectar();
 		$conexao = $c->conexao();

 		$consulta = "UPDATE categorias SET categoria = '$categoria' WHERE id_categoria = $id_categoria";
 		$resultado = mysqli_query($conexao, $consulta);

 		return $resultado;
 	}

 	public function excluir_categoria($id_categoria){
 		$c = new conectar();
		$conexao=$c->conexao();

		$deletar = "DELETE FROM categorias where id_categoria = '$id_categoria'";
		$resultado = mysqli_query($conexao, $deletar);

		return $resultado; 
 	}
 }
 ?>