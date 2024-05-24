<?php 
	include_once("classes/conexao.php");
    $c = new conectar();
    $conexao = $c->conexao();
    $id_venda = $_GET["id_venda"];

    $busca_venda = "SELECT * FROM vendas WHERE id_venda = '$id_venda'";
    $resultado_venda = mysqli_query($conexao, $busca_venda);
    $venda = mysqli_fetch_array($resultado_venda);

    $id_adm = $venda["id_adm"];

    $busca_dado = "SELECT * FROM dados_empresa WHERE id_adm = '$id_adm'";
    $resultado_dado = mysqli_query($conexao, $busca_dado);
    $dado = mysqli_fetch_array($resultado_dado);
 ?>

 <!DOCTYPE html>
 <html>
 <head>
 	<meta charset="utf-8" />
 	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
 	<title>Comprovante da Venda</title>
 	<link href="css/styles.css" rel="stylesheet" />
 	<style>
	table {
	  font-family: arial, sans-serif;
	  border-collapse: collapse;
	  width: 100%;
	}

	td, th {
	  border: 1px solid #dddddd;
	  text-align: left;
	  padding: 8px;
	}

	tr:nth-child(even) {
	  background-color: #dddddd;
	}
	</style>
 </head>
 <body>
 	<div id="dados">
	 	<div class="container border mt-5">
	 		<center class="mt-4">
	 			<h2><b>Comprovante</b></h2>
	 			<h3><?php echo $dado["empresa"]; ?></h3>
	 			<h5><b>CNPJ:</b><?php echo $dado["cnpj"]; ?></h4>
	 			<h5><b>Telefone:</b><?php echo $dado["telefone"]; ?></h4>
	 		</center>
	 		<hr>
	 		<div class="container">
	 			<b>Intens comprados:</b>

	 			<table class="table table-striped">
				  <thead>
				    <tr>
				      <th scope="col">Código</th>
				      <th scope="col">Nome</th>
				      <th scope="col">Quantidade</th>
				      <th scope="col">Valor UN</th>
				      <th scope="col">Valor somado</th>
				    </tr>
				  </thead>
				  <tbody>
				  	<?php 
				  	$busca_produto_venda = "SELECT * FROM produto_venda WHERE id_venda = '$id_venda'";
				    $resultado_produto_venda = mysqli_query($conexao, $busca_produto_venda);
				    while ($pv = mysqli_fetch_array($resultado_produto_venda)) {
				    	$id_produto = $pv["id_produto"];
				    	$busca_produto = "SELECT * FROM produtos WHERE id_produto = '$id_produto'";
					    $resultado_produto = mysqli_query($conexao, $busca_produto);
					    $produto = mysqli_fetch_array($resultado_produto);
					    $valor_somado = ($pv["valor"] * $pv["quantidade"]);
				  	?>
				    <tr>
				      <th scope="row"><?php echo $produto["codigo"]; ?></th>
				      <td><?php echo $produto["produto"]; ?></td>
				      <td><?php echo $pv["quantidade"]; ?></td>
				      <td><?php echo $pv["valor"]; ?></td>
				      <td><?php echo $valor_somado; ?></td>
				    </tr>
					<?php } ?>
				  </tbody>
				</table>
				<hr>
				<p><b>Valor Pago: R$ <?php $preco = number_format($venda["valor_pago"], 2, ',', ' '); echo($preco); ?></b></p> 
				<p><b>Total: R$ <?php $preco = number_format($venda["total"], 2, ',', ' '); echo($preco); ?></b></p>
				<p><b>Troco: R$ <?php $preco = number_format($venda["troco"], 2, ',', ' '); echo($preco); ?></b></p>
	 		</div>
	 		<center class="mt-4">
	 			<h5>Data da Venda = <?php echo date('d/m/Y',  strtotime($venda["data_venda"])) ?></h5>
	 			<h5>Horas da Venda = <?php echo $venda["hora_venda"] ?></h5>
	 		</center>
	 	</div>
 	</div>
 	<!--
 	<center>
	 	<input class="btn btn-secondary mt-2" type="button" value="IMPRIMIR DIRETO" onclick="funcao_pdf()" name="">
	 </center>
	-->
 </body>
 </html>

 <script type="text/javascript">
    function funcao_pdf(){
        var pegar_dados = document.getElementById('dados').innerHTML;

        var janela = window.open('','','width=800,heigth=600');
        janela.document.write('<html><head>');
        janela.document.write('<title>PDF</title>');
        janela.document.write('<body>');
        janela.document.write(pegar_dados);
        janela.document.write('<body><html>');
        janela.document.close();
        janela.print();
    }
</script>