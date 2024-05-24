<?php 
 include_once("conexao.php");

 Class adm_mestre{

 	public function registrar_adm_mestre($nome, $email, $senha){
 		$c = new conectar();
 		$conexao = $c->conexao();

 		$inserir = "INSERT INTO adm_mestre (nome, email, senha) VALUES ('$nome', '$email', '$senha')";
 		$resultado = mysqli_query($conexao, $inserir);

 		return $resultado;
 	}

 	public function editar_adm_mestre($id_adm_mestre, $nome, $email, $senha){
 		$c = new conectar();
 		$conexao = $c->conexao();

 		$consulta = "UPDATE adm_mestre SET nome = '$nome', email = '$email', senha = '$senha' WHERE id_adm_mestre = $id_adm_mestre";
 		$resultado = mysqli_query($conexao, $consulta);

 		return $resultado;
 	}

 	public function excluir_adm_mestre($id_adm_mestre){
 		$c = new conectar();
		$conexao=$c->conexao();

		$deletar = "DELETE FROM adm_mestre where id_adm_mestre = '$id_adm_mestre'";
		$resultado = mysqli_query($conexao, $deletar);

		return $resultado; 
 	}
 }
 ?>