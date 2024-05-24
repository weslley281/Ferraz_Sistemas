<?php 
	include_once("../classes/conexao.php");
	include_once("../classes/produtos.php");
	$id_produto = $_POST["id_produto"];
	$registro = new produtos();

	//manda a imagem para a pasta
	$caminho = '../imagens/' .$_FILES['foto']['name'];
	$nome = $_FILES['foto']['name'];  
	$nome_temp = $_FILES['foto']['tmp_name']; 
	move_uploaded_file($nome_temp, $caminho);

	//procura se a imagem existe
	$c = new conectar();
	$conexao = $c->conexao();
	$consulta = "SELECT * FROM imagens WHERE nome = '$nome'";
	$resultado = mysqli_query($conexao, $consulta);
	$dado = mysqli_fetch_array($resultado);                    	
	$linha = mysqli_num_rows($resultado);

	//insere a imagem
	if ($linha == 0) {
		$tentativa = $registro->registrar_imagem_produto($nome, $caminho);
	}

	//busca o id da imagem depois de inserir 
	$consulta = "SELECT * FROM imagens WHERE nome = '$nome'";
	$resultado = mysqli_query($conexao, $consulta);
	$dado = mysqli_fetch_array($resultado);                    	

	$id_imagem = $dado["id_imagem"];

	$consulta = "UPDATE produtos SET id_imagem = '$id_imagem' WHERE id_produto = $id_produto";
 	$resultado = mysqli_query($conexao, $consulta);

 	if ($resultado > 0) {
	    echo "<script language='javascript'>window.alert('Imagem Editada com sucesso'); </script>";
	    echo "<script language='javascript'>window.location='../inicio.php?produtos'; </script>";
	}else{
	    echo "<script language='javascript'>window.alert('Erro ao Editar'); </script>";
	    echo "<script language='javascript'>window.location='../inicio.php?produtos'; </script>";
	}
