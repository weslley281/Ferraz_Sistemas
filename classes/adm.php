<?php 
 include_once("conexao.php");

 Class adm{

 	public function registrar_adm($situacao, $nome, $email, $senha, $telefone){
 		$c = new conectar();
 		$conexao = $c->conexao();

 		$inserir = "INSERT INTO adm (situacao, nome, email, senha, telefone) VALUES ('$situacao', '$nome', '$email', '$senha', '$telefone')";
 		$resultado = mysqli_query($conexao, $inserir);

 		return $resultado;
 	}

 	public function editar_adm($id_adm, $situacao, $nome, $email, $senha, $telefone){
 		$c = new conectar();
 		$conexao = $c->conexao();

 		$consulta = "UPDATE adm SET situacao = '$situacao', nome = '$nome', email = '$email', senha = '$senha', telefone = '$telefone' WHERE id_adm = $id_adm";
 		$resultado = mysqli_query($conexao, $consulta);

 		return $resultado;
 	}

 	public function excluir_adm($id_adm){
 		$c = new conectar();
		$conexao=$c->conexao();

		$deletar = "DELETE FROM adm where id_adm = '$id_adm'";
		$resultado = mysqli_query($conexao, $deletar);

		return $resultado; 
 	}

 	public function registrar_dado($id_adm){
 		$c = new conectar();
 		$conexao = $c->conexao();

 		$inserir = "INSERT INTO dados_empresa (id_adm) VALUES ('$id_adm')";
 		$resultado = mysqli_query($conexao, $inserir);

 		return $resultado;
 	}
 }
 ?>