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

                        <!-- exibindo configuações de categorias -->
                        <div id="tabelaCategoriaLoad" class="card mb-4">
                            <button type="button" class="btn btn-success mt-3 mb-3 mr-3 ml-3 col-lg-3" data-toggle="modal" data-target="#ModalCategorias">
                              Cadastrar Categoria
                            </button>
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                                Lista de Categorias
                            </div>
                            
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Categoria</th>
                                                <th>Ações</th>
                                            </tr>
                                        </thead>
                                        <tfoot>
                                            <tr>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                            </tr>
                                        </tfoot>
                                        <tbody>
                                            <?php
                                            if (@$_SESSION['id_adm'] != null) {
                                                $busca_categoria = "SELECT * FROM categorias WHERE id_adm = '$id_adm'";                                    
                                             }else{
                                                $busca_categoria = "SELECT * FROM categorias";
                                             }
                                            $resultado_categoria = mysqli_query($conexao, $busca_categoria);
                                            $linha_categoria = mysqli_num_rows($resultado_categoria);
                                            if($linha_categoria == ''){
                                                echo "<th><h3> Não foram encontrados dados Cadastrados no Banco!! </h3></th>";
                                            }else{
                                                while($res = mysqli_fetch_array($resultado_categoria)){
                                             ?>
                                            <tr>
                                                <td><?php echo $res["id_categoria"]; ?></td>
                                                <td><?php echo $res["categoria"]; ?></td>
                                                <!-- funcionários não podem editar -->
                                                <td>
                                                    <?php if (@$_SESSION['id_adm'] != null) { ?>
                                                    <a href="" class="btn btn-info" data-toggle="modal" data-target="#ModalEditarCategoria<?php echo $res["id_categoria"] ?>"><i class="fas fa-edit"></i></a>

                                                    <a title="Excluir" class="btn btn-danger" href="funcoes/deletar_categoria.php?id=<?php echo $res["id_categoria"]; ?>"><i class="fa fa-minus-square"></i></a>
                                                    <?php } ?>
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

<!-- Modal Cadastra Categorias-->
<div class="modal fade" id="ModalCategorias" tabindex="-1" role="dialog" aria-labelledby="TituloModalCentralizado" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="TituloModalCentralizado">Cadastrar Categorias</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            <form action="funcoes/cadastrar_categorias.php" method="post">
            <input class="form-control" type="text" placeholder="Nome da Categoria" name="categoria" id="categoria">
            <input type="hidden" value="<?php echo($id_adm) ?>" name="id_adm" id="id_adm">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        <button type="submit" class="btn btn-success">Salvar</button>
        </form>
      </div>
    </div>
  </div>
</div>

<!-- Modal Edita categorias -->
<?php 
$busca_categoria = "SELECT * FROM categorias WHERE id_adm = '$id_adm'";
$resultado_categoria = mysqli_query($conexao, $busca_categoria);
while($res = mysqli_fetch_array($resultado_categoria)){ 
?>
<div class="modal fade" id="ModalEditarCategoria<?php echo $res["id_categoria"] ?>" tabindex="-1" role="dialog" aria-labelledby="TituloModalCentralizado" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="TituloModalCentralizado">Editar Categoria</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="funcoes/editar_categoria.php" method="post">
            <input type="hidden" value="<?php echo $res["id_categoria"] ?>" name="id_categoria">
            <input class="form-control" type="text" value="<?php echo $res["categoria"] ?>" name="categoria">
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