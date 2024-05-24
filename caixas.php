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
                            <?php $dataPesquisa = @$_GET["dataPesquisa"]; ?>
                            <form class="col-lg-4" action="" method="get">
                                <div class="input-group mb-4">
                                    <input type="hidden" name="relatorio">
                                    <input name="dataPesquisa" type="date" class="form-control" aria-label="Exemplo do tamanho do input" aria-describedby="inputGroup-sizing-default" value="<?php echo $dataPesquisa; ?>">
                                    <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="submit" title="pesquisar"><i class="fas fa-search"></i></button> 
                                    </div>
                                </div>
                            </form>
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                                Relatório de Vendas
                            </div>
                            
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Funcionário</th>
                                                <th>Total Venda</th>
                                                <th>Valor Pago</th>
                                                <th>Troco</th>
                                                <th>Real</th>
                                                <th>Situação</th>
                                                <th>Ações</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if (@$_SESSION['id_adm'] != null) {
                                                if (isset($_GET["dataPesquisa"])) {
                                                    $busca_caixas = "SELECT * FROM caixas WHERE id_adm = '$id_adm' AND data_abertura = '$dataPesquisa'";
                                                }else{
                                                    $busca_caixas = "SELECT * FROM caixas WHERE id_adm = '$id_adm' AND data_abertura = '$hoje'";
                                                }                                    
                                             }elseif (@$_SESSION['id_funcionario'] != null) {
                                                if (isset($_GET["dataPesquisa"])) {
                                                    $busca_caixas = "SELECT * FROM caixas WHERE id_funcionario = '$id_funcionario' AND id_adm = '$id_adm' AND data_abertura = '$dataPesquisa'";
                                                }else{
                                                    $busca_caixas = "SELECT * FROM caixas WHERE id_funcionario = '$id_funcionario' AND id_adm = '$id_adm' AND data_abertura = '$hoje'";
                                                }
                                             }
                                             else{
                                                $busca_caixas = "SELECT * FROM caixas AND data_abertura = '$hoje'";
                                             }
                                            $resultado_caixas = mysqli_query($conexao, $busca_caixas);
                                            $linha_caixas = mysqli_num_rows($resultado_caixas);
                                            if($linha_caixas == ''){
                                                echo "<th><h3> Não foram encontrados dados Cadastrados no Banco!! </h3></th>";
                                            }else{
                                                while($res = mysqli_fetch_array($resultado_caixas)){
                                                   $id_funcionario2 = $res["id_funcionario"];
                                                   $busca_funcionario = "SELECT * FROM funcionarios WHERE id_funcionario = '$id_funcionario2' AND id_adm = '$id_adm'"; 
                                                   $resultado_funcionario = mysqli_query($conexao, $busca_funcionario);
                                                   $funcionario = mysqli_fetch_array($resultado_funcionario);
                                                   $id_caixa = $res["id_caixa"];
                                                   $situacao = $v->verifica_situacao_caixa($id_caixa);
                                                   //$valor_real = $res["valor_pago"] - $res["troco"];
                                             ?>
                                            <tr>
                                                <td><?php echo $funcionario["nome"]; ?></td>
                                                <td><?php echo $res["total"]; ?></td>
                                                <td><?php echo $res["valor_pago"]; ?></td>
                                                <td><?php echo $res["troco"]; ?></td>
                                                <td>
                                                    <?php echo $valor_real; ?>
                                                        
                                                    </td>
                                                <td><?php echo $situacao; ?></td>
                                                <td>
                                                    <a title="Imprimir Comprovante" href="funcoes/comprovante_pdf.php?id_venda=<?php echo $res["id_venda"] ?>" class="btn btn-success"><i class="fas fa-download"></i></a>

                                                    <a title="Ver Comprovante" href="comprovante.php?id_venda=<?php echo $res["id_venda"] ?>" class="btn btn-info"><i class="fas fa-eye"></i></a>

                                                    <?php if (@$_SESSION['id_adm'] != null) { ?>
                                                    <a title="Cancelar" class="btn btn-danger" href="funcoes/cancelar_venda.php?id=<?php echo $res["id_venda"]; ?>"><i class="fas fa-times-circle"></i></a>
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                            <?php }} ?>
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <th>    
                                                </th>
                                            </tr>
                                        </tfoot>
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
