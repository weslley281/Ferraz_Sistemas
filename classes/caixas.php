<?php 
 include_once("conexao.php");
 date_default_timezone_set('America/Cuiaba');
 
 Class caixas{

 	public function abrir_caixa($id_adm, $id_funcionario, $situacao, $dinheiro, $credito, $debito, $outros){
 		$c = new conectar();
 		$conexao = $c->conexao();
 		$hoje = date("Y,m,d");
    $agora = date("H:i:s");

	 	$inserir = "INSERT INTO caixas (id_adm, id_funcionario, situacao, dinheiro, credito, debito, outros, data_abertura, hora_abertura) VALUES ('$id_adm', '$id_funcionario', '$situacao', '$dinheiro', '$credito', '$debito', '$outros', '$hoje', '$agora')";
    $resultado = mysqli_query($conexao, $inserir);

 		return $resultado;
 	}

 	public function fechar_caixa($id_caixa, $dinheiro, $debito, $credito, $deposito){
 		$c = new conectar();
 		$conexao = $c->conexao();
    $hoje = date("Y,m,d");
    $agora = date("H:i:s");
    $situacao = 2;

 		$consulta = "UPDATE caixas SET dinheiro = '$dinheiro', debito = '$debito', credito = '$credito', outros = '$deposito', data_fechamento = '$hoje', hora_fechamento = '$agora', situacao = '$situacao' WHERE id_caixa = $id_caixa";
    var_dump($consulta);
 		$resultado = mysqli_query($conexao, $consulta);

 		return $resultado;
 	}

  public function registrar_moeda_caixa($id_caixa, $id_adm, $id_funcionario, $valor, $forma){
    $c = new conectar();
    $conexao = $c->conexao();

    if ($forma == 1) {
      $busca = "SELECT * FROM caixas WHERE id_caixa = '$id_caixa'";
      $resultado = mysqli_query($conexao, $busca);
      $moeda = mysqli_fetch_array($resultado);
      $somado = $moeda["dinheiro"] + $valor;

      $muda = "UPDATE caixas SET dinheiro = '$somado' WHERE id_caixa = '$id_caixa'";
    }elseif ($forma == 2) {
      $busca = "SELECT * FROM caixas WHERE id_caixa = '$id_caixa'";
      $resultado = mysqli_query($conexao, $busca);
      $moeda = mysqli_fetch_array($resultado);
      $somado = $moeda["debito"] + $valor;

      $muda = "UPDATE caixas SET debito = '$somado' WHERE id_caixa = '$id_caixa'";
    }elseif ($forma == 3) {
      $busca = "SELECT * FROM caixas WHERE id_caixa = '$id_caixa'";
      $resultado = mysqli_query($conexao, $busca);
      $moeda = mysqli_fetch_array($resultado);
      $somado = $moeda["credito"] + $valor;

      $muda = "UPDATE caixas SET credito = '$somado' WHERE id_caixa = '$id_caixa'";
    }elseif ($forma == 4) {
      $busca = "SELECT * FROM caixas WHERE id_caixa = '$id_caixa'";
      $resultado = mysqli_query($conexao, $busca);
      $moeda = mysqli_fetch_array($resultado);
      $somado = $moeda["outros"] + $valor;

      $muda = "UPDATE caixas SET outros = '$somado' WHERE id_caixa = '$id_caixa'";
    }

    $resultado2 = mysqli_query($conexao, $muda);
    return $resultado2;
  }

  public function sangria($id_adm, $id_funcionario, $id_caixa, $descricao, $valor){
    $c = new conectar();
    $conexao = $c->conexao();
    $hoje = date("Y,m,d");
    $agora = date("H:i:s");

    $consulta = "INSERT INTO sangria (id_adm, id_funcionario, id_caixa, descricao, valor, data_sangria, hora_sangria) VALUES ('$id_adm', '$id_funcionario', '$id_caixa', '$descricao', '$valor', '$hoje', '$agora') ";
    //var_dump($consulta);
    $resultado = mysqli_query($conexao, $consulta);

    return $resultado;
  }

  public function suprimento($id_adm, $id_funcionario, $id_caixa, $descricao, $valor){
    $c = new conectar();
    $conexao = $c->conexao();
    $hoje = date("Y,m,d");
    $agora = date("H:i:s");

    $consulta = "INSERT INTO suprimentos (id_adm, id_funcionario, id_caixa, descricao, valor, data_suprimento, hora_suprimento) VALUES ('$id_adm', '$id_funcionario', '$id_caixa', '$descricao', '$valor', '$hoje', '$agora') ";
    //var_dump($consulta);
    $resultado = mysqli_query($conexao, $consulta);

    return $resultado;
  }
}
 ?>