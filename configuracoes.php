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

                        <!-- exibindo configuações gerais -->
                        <div class="card mb-4">
                            <div class="container">
                                <center class="mt-3"><h3>Dados da Empresa</h3></center>
                                <?php 
                                $busca_dado = "SELECT * FROM dados_empresa WHERE id_adm = '$id_adm'";
                                $resultado_dado = mysqli_query($conexao, $busca_dado);
                                $dado = mysqli_fetch_array($resultado_dado);
                                 ?>
                                <form action="funcoes/atualizar_dados.php" method="post">

                                    <input type="hidden" value="<?php echo $id_adm ?>" name="id_adm">

                                    <label for="empresa">Empresa:</label>
                                    <input id="empresa" class="form-control mb-3" value="<?php echo $dado['empresa'] ?>" type="text" value="" name="empresa">

                                    <label for="produto-1-cnpj">CNPJ:</label>
                                    <input id="produto-1-cnpj" class="form-control mb-3" value="<?php echo $dado['cnpj'] ?>" type="text" value="" name="cnpj">

                                    <label for="telefone">Telefone:</label>
                                    <input id="telefone" class="form-control mb-3" value="<?php echo $dado['telefone'] ?>" type="text" value="" name="telefone" onkeypress="mask(this, mphone);" onblur="mask(this, mphone);">

                                    <input class="btn btn-success" type="submit" value="Salvar Edição" name="">
                                </form>
                            </div>
                        </div>



<?php 
    include_once("rodape.php");
}else{
    echo "<script language='javascript'>window.alert('ERRO - não está Logado'); </script>";
    echo "<script language='javascript'>window.location='login.php'; </script>";
}
?>
