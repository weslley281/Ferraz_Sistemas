<?php

include_once("../classes/produtos.php");
include_once("../classes/conexao.php");

$registro = new produtos();

$id_adm = $_POST["id_adm"];
$id_categoria = $_POST["id_categoria"];
$produto = $_POST["produto"];
$descricao = $_POST["descricao"];
$codigo = $_POST["codigo"];
$quantidade = $_POST["quantidade"];
$preco = $_POST["preco"];

//manda a imagem para a pasta
$caminho = '../imagens/' .$_FILES['foto']['name'];
$nome = $_FILES['foto']['name'];  
$nome_temp = $_FILES['foto']['tmp_name']; 
move_uploaded_file($nome_temp, $caminho);

//var_dump($caminho);
//var_dump($nome);

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
//var_dump($id_imagem);

//cadastra o serviço
$tentativa2 = $registro->registrar_produto($id_adm, $id_categoria, $id_imagem, $produto, $descricao, $codigo, $quantidade, $preco);

if ($tentativa2 > 0) {
    echo "<script language='javascript'>window.alert('Produto Cadastrado com sucesso'); </script>";
    echo "<script language='javascript'>window.location='../produtos.php'; </script>";
}else{
    echo "<script language='javascript'>window.alert('Erro ao Cadastrar'); </script>";
    echo "<script language='javascript'>window.location='../produtos.php'; </script>";
}

