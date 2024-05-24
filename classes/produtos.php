<?php

include_once("conexao.php");

 Class produtos{

 	public function registrar_produto($id_adm, $id_categoria, $id_imagem, $produto, $descricao, $codigo, $quantidade, $preco){
 		$c = new conectar();
 		$conexao = $c->conexao();

 		$inserir = "INSERT INTO produtos (id_adm, id_categoria, id_imagem, produto, descricao, codigo, quantidade, preco) VALUES ('$id_adm', '$id_categoria', '$id_imagem', '$produto', '$descricao', '$codigo', '$quantidade', '$preco')";
 		$resultado = mysqli_query($conexao, $inserir);

 		return $resultado;
 	}

 	public function registrar_imagem_produto($nome, $caminho){
 		$c = new conectar();
 		$conexao = $c->conexao();

 		$inserir = "INSERT INTO imagens (nome, caminho) VALUES ('$nome', '$caminho')";
 		$resultado = mysqli_query($conexao, $inserir);

 		return $resultado;
 	}

 	public function editar_produto($id_produto, $id_categoria, $produto, $descricao, $codigo, $quantidade, $preco){
 		$c = new conectar();
 		$conexao = $c->conexao();

 		$consulta = "UPDATE produtos SET id_categoria = '$id_categoria', produto = '$produto', descricao = '$descricao', codigo = '$codigo', quantidade = '$quantidade', preco = '$preco' WHERE id_produto = $id_produto";
 		$resultado = mysqli_query($conexao, $consulta);

 		return $resultado;
 	}

 	public function excluir_produto($id_produto){
 		$c = new conectar();
		$conexao=$c->conexao();

		$deletar = "DELETE FROM produtos where id_produto = '$id_produto'";
		$resultado = mysqli_query($conexao, $deletar);

		return $resultado; 
 	}

 	public function excluir_imagem_produto($id_imagem){
 		$c = new conectar();
		$conexao=$c->conexao();

		$deletar = "DELETE FROM imagens where id_imagem = '$id_imagem'";
		$resultado = mysqli_query($conexao, $deletar);

		return $resultado; 
 	}
 }
 ?>