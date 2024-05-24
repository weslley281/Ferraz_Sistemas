<?php 
 include_once("conexao.php");

 Class funcionarios{

 	public function registrar_funcionarios($id_adm, $situacao, $nome, $email, $senha, $data_registro){
 		$c = new conectar();
 		$conexao = $c->conexao();

 		$inserir = "INSERT INTO funcionarios (id_adm, situacao, nome, email, senha, data_registro) VALUES ('$id_adm', '$situacao', '$nome', '$email', '$senha', '$data_registro')";
 		$resultado = mysqli_query($conexao, $inserir);

 		return $resultado;
 	}

 	public function editar_funcionarios($id_funcionario, $situacao, $nome, $email, $senha, $data_registro){
 		$c = new conectar();
 		$conexao = $c->conexao();

 		$consulta = "UPDATE funcionarios SET situacao = '$situacao', nome = '$nome', email = '$email', senha = '$senha', data_registro = '$data_registro' WHERE id_funcionario = '$id_funcionario'";
 		$resultado = mysqli_query($conexao, $consulta);

 		return $resultado;
 	}

 	public function excluir_funcionarios($id_funcionario){
 		$c = new conectar();
		$conexao=$c->conexao();

		$deletar = "DELETE FROM funcionarios where id_funcionario = '$id_funcionario'";
		$resultado = mysqli_query($conexao, $deletar);

		return $resultado; 
 	}
 }
 ?>