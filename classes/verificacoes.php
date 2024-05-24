<?php

 include_once("conexao.php");

 Class verificacao{

 	public function verifica_nivel($id_adm, $id_mestre, $id_funcionario){
 		if ($id_adm != null) {
 			$retorno = "Painel do Administrador";
 		}
 		if ($id_mestre != null) {
 			$retorno = "Painel do Administrador Mestre";
 		}
 		if ($id_funcionario != null) {
 			$retorno = "Painel do Funcionário";
 		}

 		return $retorno;
 	}

 	public function verifica_categoria($id_categoria){
 		$c = new conectar();
 		$conexao = $c->conexao();

 		$busca_categoria = "SELECT * FROM categorias WHERE id_categoria = '$id_categoria'";
    	$resultado_categoria = mysqli_query($conexao, $busca_categoria);
    	$categoria = mysqli_fetch_array($resultado_categoria);
    	$retorno = $categoria["categoria"];

    	return $retorno;
 	}

 	public function verifica_imagem($id_imagem){
 		$c = new conectar();
 		$conexao = $c->conexao();

 		$busca_imagem = "SELECT * FROM imagens WHERE id_imagem = '$id_imagem'";
    	$resultado_imagem = mysqli_query($conexao, $busca_imagem);
    	$imagem = mysqli_fetch_array($resultado_imagem);
    	$retorno = $imagem["nome"];

    	return $retorno;
 	}

    public function verifica_id_adm($id_funcionario){
        $c = new conectar();
        $conexao = $c->conexao();

        $busca = "SELECT * FROM funcionarios WHERE id_funcionario = '$id_funcionario'";
        $resultado = mysqli_query($conexao, $busca);
        $funcionario = mysqli_fetch_array($resultado);

        $id_adm = $funcionario["id_adm"];
        $retorno = $id_adm;

        return $retorno;
    }

 	public function verifica_vendas($id_adm, $id_funcionario, $id_caixa){
 		$c = new conectar();
 		$conexao = $c->conexao();
 		
        $situacao = 2;

 		$busca = "SELECT * FROM vendas WHERE id_adm = '$id_adm' and id_funcionario = '$id_funcionario' and situacao = '$situacao'";
        //var_dump($busca);
    	$resultado = mysqli_query($conexao, $busca);
    	$linha = mysqli_num_rows($resultado);
        //var_dump($linha);
    	if ($linha == 0) {
    		$inserir = "INSERT INTO vendas (id_adm, id_funcionario, situacao, id_caixa) VALUES ('$id_adm', '$id_funcionario', '$situacao', id_caixa)";
            //var_dump($inserir);
    		$resultado2 = mysqli_query($conexao, $inserir);
            //var_dump($resultado2);
            echo "Executa Esse";
    	}
        $busca2 = "SELECT * FROM vendas WHERE id_adm = '$id_adm' and id_funcionario = '$id_funcionario' and situacao = '$situacao'";
        //var_dump($busca2);
        $resultado2 = mysqli_query($conexao, $busca2);
        $venda = mysqli_fetch_array($resultado2);
        $retorno = $venda["id_venda"];

    	return $retorno;
 	}

    public function verifica_caixa($id_adm, $id_funcionario){
        $c = new conectar();
        $conexao = $c->conexao();
        
        $situacao = 1;

        $busca2 = "SELECT * FROM caixas WHERE id_adm = '$id_adm' and id_funcionario = '$id_funcionario' and situacao = '$situacao'";
        $resultado2 = mysqli_query($conexao, $busca2);
        $caixa = mysqli_fetch_array($resultado2);
        $retorno = $caixa["id_caixa"];

        return $retorno;
    }

    public function verifica_data_caixa($id_adm, $id_funcionario){
        $c = new conectar();
        $conexao = $c->conexao();
        
        $situacao = 1;

        $busca2 = "SELECT * FROM caixas WHERE id_adm = '$id_adm' and id_funcionario = '$id_funcionario' and situacao = '$situacao'";
        $resultado2 = mysqli_query($conexao, $busca2);
        $caixa = mysqli_fetch_array($resultado2);
        $retorno = $caixa["data_abertura"];

        return $retorno;
    }

    public function verifica_pagamento($id_venda){
        $c = new conectar();
        $conexao = $c->conexao();
        $total_pago = 0;

        $busca = "SELECT * FROM pagamento WHERE id_venda = '$id_venda'";
        $resultado = mysqli_query($conexao, $busca);

        while ($pagamento = mysqli_fetch_array($resultado)) {
            $total_pago += $pagamento["valor"];
        } 

        return $total_pago;
    }

    public function verifica_nome_empresa($id_adm){
        $c = new conectar();
        $conexao = $c->conexao();
        $total_pago = 0;

        $busca = "SELECT * FROM dados_empresa WHERE id_adm = '$id_adm'";
        $resultado = mysqli_query($conexao, $busca);
        $empresa = mysqli_fetch_array($resultado);

        $nome_empresa = $empresa["empresa"];

        return $nome_empresa;
    }

    public function verifica_situacao_venda($id_venda){
        $c = new conectar();
        $conexao = $c->conexao();
        $total_pago = 0;

        $busca = "SELECT * FROM vendas WHERE id_venda = '$id_venda'";
        $resultado = mysqli_query($conexao, $busca);
        $venda = mysqli_fetch_array($resultado);

        if ($venda["situacao"] == 1) {
            $retorno = "Finalizada";
        }elseif ($venda["situacao"] == 2) {
            $retorno = "Em Andamento";
        }elseif ($venda["situacao"] == 3) {
            $retorno = "Cancelada";
        }


        return $retorno;
    }

    public function verifica_situacao_caixa($id_caixa){
        $c = new conectar();
        $conexao = $c->conexao();
        $total_pago = 0;

        $busca = "SELECT * FROM caixas WHERE id_caixa = '$id_caixa'";
        $resultado = mysqli_query($conexao, $busca);
        $caixa = mysqli_fetch_array($resultado);

        if ($caixa["situacao"] == 1) {
            $retorno = "Aberto";
        }elseif ($caixa["situacao"] == 2) {
            $retorno = "Fechado";
        }


        return $retorno;
    } 

    public function verifica_caixa_anterior($id_funcionario){
        $c = new conectar();
        $conexao = $c->conexao();

        $busca = "SELECT * FROM caixas WHERE id_funcionario = '$id_funcionario' and data_fechamento = NULL";
        $resultado = mysqli_query($conexao, $busca);
        $caixa = mysqli_fetch_array($resultado);
        $linha = mysqli_num_rows($resultado);
        //var_dump($linha);
    }
 }