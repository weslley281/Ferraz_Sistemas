<?php
    date_default_timezone_set('America/Cuiaba');
    $hoje = date("Y,m,d");
    include_once("menu.php");
    include_once("classes/verificacoes.php");
    $usuario = $_SESSION['usuario'];
    if(isset($_SESSION['usuario'])){
        include_once("classes/conexao.php");
        $c = new conectar();
        $conexao = $c->conexao();
        $v = new verificacao();
        $verificacao = $v->verifica_nivel($id_adm, $id_mestre, $id_funcionario);
        if (@$_SESSION['id_funcionario'] != null) {
            $id_adm = $v->verifica_id_adm($id_funcionario);
        }
        $nome_empresa = $v->verifica_nome_empresa($id_adm);
?>
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid">
                        <h1 class="mt-4"><?php echo $nome_empresa; ?></h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item active"><?php echo $verificacao; ?></li>
                        </ol>

                        <?php if (!isset($_GET["vendas"])) { ?>

                        <div class="row">
                            <div class="col-xl-3 col-md-6">
                                <?php 
                                $consulta_funcionarios = "SELECT * FROM funcionarios WHERE id_adm = $id_adm AND presenca = '1'";
                                $resultado_funcionarios = mysqli_query($conexao, $consulta_funcionarios);
                                $linha_funcionarios = mysqli_num_rows($resultado_funcionarios)
                                 ?>
                                <div class="card bg-primary text-white mb-4">
                                    <div class="card-body">Funcionários Online</div>
                                    <center><h2><?php echo $linha_funcionarios; ?></h2></center>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">Mais Detalhes</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <?php 
                                $consulta_funcionarios2 = "SELECT * FROM funcionarios WHERE id_adm = $id_adm AND presenca = '2'";
                                $resultado_funcionarios2 = mysqli_query($conexao, $consulta_funcionarios2);
                                $linha_funcionarios2 = mysqli_num_rows($resultado_funcionarios2)
                                 ?>
                                <div class="card bg-warning text-white mb-4">
                                    <div class="card-body">Funcionários Offline</div>
                                    <center><h2><?php echo $linha_funcionarios2; ?></h2></center>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">Mais Detalhes</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <?php
                                if (@$_SESSION['id_adm'] != null) {
                                    $consulta_vr = "SELECT * FROM vendas WHERE id_adm = $id_adm AND data_venda = '$hoje' AND situacao = '1'";
                                }elseif (@$_SESSION['id_funcionario'] != null) {
                                    $consulta_vr = "SELECT * FROM vendas WHERE id_adm = $id_adm AND id_funcionario = '$id_funcionario' AND data_venda = '$hoje' AND situacao = '1'";
                                }
                                $resultado_vr = mysqli_query($conexao, $consulta_vr);
                                $linha_vr = mysqli_num_rows($resultado_vr);
                                 ?>
                                <div class="card bg-success text-white mb-4">
                                    <div class="card-body">Vendas Concluidas</div>
                                    <center><h2><?php echo $linha_vr; ?></h2></center>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">Mais Detalhes</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-md-6">
                                <?php
                                if (@$_SESSION['id_adm'] != null) {
                                    $consulta_vr2 = "SELECT * FROM vendas WHERE id_adm = $id_adm AND data_venda = '$hoje' AND situacao = '3'";
                                }elseif (@$_SESSION['id_funcionario'] != null) {
                                    $consulta_vr2 = "SELECT * FROM vendas WHERE id_adm = $id_adm AND id_funcionario = '$id_funcionario' AND data_venda = '$hoje' AND situacao = '3'";
                                }
                                $resultado_vr2 = mysqli_query($conexao, $consulta_vr2);
                                $linha_vr2 = mysqli_num_rows($resultado_vr2);
                                 ?>
                                <div class="card bg-danger text-white mb-4">
                                    <div class="card-body">Vendas Canceladas</div>
                                    <center><h2><?php echo $linha_vr2; ?></h2></center>
                                    <div class="card-footer d-flex align-items-center justify-content-between">
                                        <a class="small text-white stretched-link" href="#">Mais Detalhes</a>
                                        <div class="small text-white"><i class="fas fa-angle-right"></i></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <?php } ?>

                        <!-- exibindo configuações de produtos -->
                        <div class="card mb-4">
                            <button type="button" class="btn btn-success mt-3 mb-3 mr-3 ml-3 col-lg-3" data-toggle="modal" data-target="#ModalProdutos">
                              Cadastrar Produtos
                            </button>
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                                Lista de Produtos
                            </div>
                            
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Código</th>
                                                <th>Produto</th>
                                                <th>Categoria</th>
                                                <th>Quantidade</th>
                                                <th>Preço</th>
                                                <th>Ações</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            <?php
                                            $busca = "SELECT * FROM produtos WHERE id_adm = '$id_adm'";
                                            $resultado = mysqli_query($conexao, $busca);
                                            $linha = mysqli_num_rows($resultado);
                                            if($linha == ''){
                                                echo "<h3> Não foram encontrados dados Cadastrados no Banco!! </h3>";
                                            }else{
                                                while($res = mysqli_fetch_array($resultado)){

                                                    //busca o nome da categoria
                                                    $id_categoria = $res["id_categoria"];
                                                    $consulta_categoria = "SELECT * FROM categorias WHERE id_categoria = '$id_categoria'";
                                                    $resultado_categoria = mysqli_query($conexao, $consulta_categoria);
                                                    $categoria = mysqli_fetch_array($resultado_categoria);

                                                    //busca o nome da imagem
                                                    $id_imagem = $res["id_imagem"];
                                                    $consulta_imagem = "SELECT * FROM categorias WHERE id_categoria = '$id_categoria'";
                                                    $resultado_imagem = mysqli_query($conexao, $consulta_imagem);
                                                    $imagem = mysqli_fetch_array($resultado_imagem);
                                             ?>
                                            <tr>
                                                <td><?php echo $res["codigo"]; ?></td>
                                                <td><?php echo $res["produto"]; ?></td>
                                                <td><?php echo $categoria["categoria"]; ?></td>
                                                <td><?php echo $res["quantidade"]; ?></td>
                                                <td><?php echo $res["preco"]; ?></td>
                                                <!-- funcionários não podem editar -->
                                                <td>
                                                    <?php if (@$_SESSION['id_adm'] != null) { ?>
                                                    <a href="" class="btn btn-info" data-toggle="modal" data-target="#ModalEditarProduto<?php echo $res["id_produto"] ?>"><i class="fas fa-edit"></i></a>

                                                    <a title="Excluir" class="btn btn-danger" href="funcoes/deletar_produto.php?id=<?php echo $res['id_produto']; ?>&id_imagem=<?php echo $res["id_imagem"] ?>"><i class="fa fa-minus-square"></i></a>
                                                    <?php }else{ echo "somente adm";} ?>
                                                </td>
                                            </tr>
                                            <?php }} ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>



<?php 
    include_once("rodape.php");
}else{
    echo "<script language='javascript'>window.alert('ERRO - não está Logado'); </script>";
    echo "<script language='javascript'>window.location='login.php'; </script>";
}
?>

<!-- Modal Cadastra Produtos-->
<div class="modal fade" id="ModalProdutos" tabindex="-1" role="dialog" aria-labelledby="TituloModalCentralizado" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="TituloModalCentralizado">Cadastrar Produtos</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="funcoes/cadastrar_produtos.php" method="post" enctype="multipart/form-data">
            <input type="hidden" value="<?php echo($id_adm) ?>" name="id_adm" id="id_adm">
            <input class="form-control mb-3" type="text" placeholder="Nome do Produto" name="produto">
            <select class="form-control mb-3" name="id_categoria">
                <?php 
                $busca_categoria = "SELECT * FROM categorias WHERE id_adm = '$id_adm'";
                $resultado_categoria = mysqli_query($conexao, $busca_categoria);
                while ($categoria = mysqli_fetch_array($resultado_categoria)) {
                 ?>
                <option value="<?php echo $categoria["id_categoria"] ?>"><?php echo $categoria["categoria"]; ?></option>
                <?php } ?>
            </select>
            <input class="form-control mb-3" type="file" name="foto">
            <label for="descricao">Descrição:</label>
            <textarea class="form-control mb-3" name="descricao" id="descricao" rows="3"></textarea>
            <input class="form-control mb-3" type="text" placeholder="Código" name="codigo">
            <input class="form-control mb-3" type="text" placeholder="Quantidade" name="quantidade">
            <input class="form-control mb-3" type="text" placeholder="Preço" name="preco" onKeyPress="return(moeda(this,',','.',event))">     
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <button type="submit" class="btn btn-success">Salvar</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal Edita produtos -->
<?php 
$busca_produtos = "SELECT * FROM produtos WHERE id_adm = '$id_adm'";
$resultado_produtos = mysqli_query($conexao, $busca_produtos);
while($res = mysqli_fetch_array($resultado_produtos)){ 
    //consulta nome da categoria
    $id_categoria = $res["id_categoria"];
    $categoria = $v->verifica_categoria($id_categoria);
    //consulta nome da imagem
    $id_imagem = $res["id_imagem"];
    $imagem = $v->verifica_imagem($id_imagem);
?>
<div class="modal fade" id="ModalEditarProduto<?php echo $res["id_produto"] ?>" tabindex="-1" role="dialog" aria-labelledby="TituloModalCentralizado" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="TituloModalCentralizado">Editar Produto</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="mb-3" action="funcoes/editar_imagem_produto.php" method="post" enctype="multipart/form-data">
            <input type="hidden" value="<?php echo $res["id_produto"] ?>" name="id_produto">
            <input class="form-control mb-3" type="file" name="foto">
            <input class="btn btn-secondary mb-3" type="submit" value="Editar Imagem">
        </form>

        <div class="text-center mb-3">
            <div class="card mx-auto" style="width: 18rem;">
                <img class="card-img-top" src="imagens/<?php echo $imagem; ?>" alt="<?php echo $imagem; ?>">
            </div>
        </div>

        <form action="funcoes/editar_produto.php" method="post">
            <input type="hidden" value="<?php echo $res["id_produto"] ?>" name="id_produto">

            <label for="nome">Nome:</label>
            <input id="nome" class="form-control mb-3" type="text" value="<?php echo $res['produto'] ?>" name="produto">

            <label for="id_categoria">Categoria:</label>
            <select id="categoria" class="form-control mb-3" name="id_categoria">
                <option value="<?php echo $res["id_categoria"] ?>"><?php echo $categoria; ?></option>
                <?php 
                $busca_categoria = "SELECT * FROM categorias WHERE id_adm = '$id_adm'";
                $resultado_categoria = mysqli_query($conexao, $busca_categoria);
                while ($categoria = mysqli_fetch_array($resultado_categoria)) {
                    if ($categoria["id_categoria"] != $res["id_categoria"]) {
                 ?>
                <option value="<?php echo $categoria["id_categoria"] ?>"><?php echo $categoria["categoria"]; ?></option>
                <?php }} ?>
            </select>

            <label for="descricao">Descrição:</label>
            <textarea class="form-control mb-3" name="descricao" id="descricao" rows="3"><?php echo $res["descricao"]; ?></textarea>

            <label for="codigo">Código:</label>
            <input id="codigo" class="form-control mb-3" type="text" value="<?php echo $res['codigo'] ?>" name="codigo">

            <label for="quantidade">Quantidade:</label>
            <input id="quantidade" class="form-control mb-3" type="text" value="<?php echo $res['quantidade'] ?>" name="quantidade">

            <label for="preco">Preço:</label>
            <input id="preco" class="form-control mb-3" type="text" value="<?php echo $res['preco'] ?>" name="preco" onKeyPress="return(moeda(this,',','.',event))">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <button type="submit" class="btn btn-primary">Salvar mudanças</button>
        </form>
      </div>
    </div>
  </div>
</div>
<?php } ?>