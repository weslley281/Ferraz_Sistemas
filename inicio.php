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

                    <?php }if (isset($_GET["fechamento"])) { ?>
                        <!-- exibindo configuações de categorias -->
                        <div id="tabelaCategoriaLoad" class="card mb-4">
                            <?php
                            $dataPesquisa = @$_GET["dataPesquisa"];
                            $forma2 = @$_GET["forma"];
                            if (@$_GET["dataPesquisa"] == null) {
                                $dataPesquisa = $hoje;
                            }
                            ?>
                            <form class="col-lg-4" action="" method="get">
                                <div class="input-group mb-4">
                                    <input type="hidden" name="fechamento">
                                    <input name="dataPesquisa" type="date" class="form-control" aria-label="Exemplo do tamanho do input" aria-describedby="inputGroup-sizing-default" value="<?php echo $dataPesquisa; ?>">
                                    <div class="input-group-append">
                                    <button class="btn btn-outline-secondary" type="submit" title="pesquisar"><i class="fas fa-search"></i></button> 
                                    </div>
                                </div>
                            </form>
                            <div class="row">
                                <?php 
                                $busca_forma2 = "SELECT * FROM forma_pagamento";
                                $resultado_forma2 = mysqli_query($conexao, $busca_forma2);
                                while($res2 = mysqli_fetch_array($resultado_forma2)){
                                ?>
                                <div class="col mx-5 mb-3">
                                    <form action="funcoes/redireciona_fp.php">
                                        <input type="hidden" value="<?php echo $dataPesquisa ?>" name="dataPesquisa">
                                        <input type="hidden" value="<?php echo $res2["id_fp"] ?>" name="id_fp">
                                        <input class="btn btn-success" type="submit" value="<?php echo $res2["forma_pagamento"] ?>" name="">
                                    </form> 
                                </div>
                                <?php } ?>
                            </div>
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                                Relatório de Fechamento de Caixa
                            </div>
                            
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>F. Pagamento</th>
                                                <th>Valor</th>
                                                <th>Troco</th>
                                                <th>Valor Real</th>
                                                <th>Ações</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            //echo $_SERVER["REQUEST_URI"];
                                            //echo $dataPesquisa."<br>";
                                            echo $forma2."<br>";
                                            //echo $id_funcionario."<br>";
                                            //echo $id_adm."<br>";
                                            if (@$_SESSION['id_adm'] != null) {
                                                $busc_pg = "SELECT * FROM pagamento WHERE id_adm = '$id_adm'";                                    
                                             }elseif (@$_SESSION['id_funcionario'] != null) {

                                                if (@$_GET["dataPesquisa"] != "" and @$_GET["forma"] != "") {
                                                    //$busca_pg = "SELECT * FROM pagamento WHERE id_funcionario = '$id_funcionario' AND id_adm = '$id_adm' AND data_pagamento = '$dataPesquisa' and forma = '$forma2'";
                                                    $busca_pg = "SELECT * FROM `pagamento` WHERE `id_funcionario` = '$id_funcionario' AND `id_adm` = '$id_adm' AND `data_pagamento` = '$dataPesquisa' AND forma = '$forma2' ";
                                                    //var_dump($busca_pg);
                                                }elseif (@$_GET["dataPesquisa"] != null) {
                                                    $busca_pg = "SELECT * FROM pagamento WHERE id_funcionario = '$id_funcionario' AND id_adm = '$id_adm' AND data_pagamento = '$dataPesquisa'";
                                                }
                                                else{
                                                    $busca_pg = "SELECT * FROM pagamento WHERE id_funcionario = '$id_funcionario' AND id_adm = '$id_adm' AND data_pagamento = '$hoje'";
                                                }
                                             }
                                             else{
                                                $busca_pg = "SELECT * FROM pagamento";
                                             }
                                            $resultado_pg = mysqli_query($conexao, $busca_pg);
                                            $linha_pg = mysqli_num_rows($resultado_pg);
                                            if($linha_pg == ''){
                                                echo "<th><h3> Não foram encontrados dados Cadastrados no Banco!! </h3></th>";
                                            }else{
                                                while($res = mysqli_fetch_array($resultado_pg)){
                                                   //busca o tipo de pagamento
                                                   $id_forma = $res["forma"];
                                                   $busca_fp = "SELECT * FROM forma_pagamento WHERE id_fp = '$id_forma'"; 
                                                   $resultado_fp = mysqli_query($conexao, $busca_fp);
                                                   $fp = mysqli_fetch_array($resultado_fp);
                                                   //buca o troco
                                                   $id_venda2 = $res["id_venda"];
                                                   $busca_troco = "SELECT * FROM vendas WHERE id_venda = '$id_venda2' AND id_adm = '$id_adm'"; 
                                                   $resultado_troco = mysqli_query($conexao, $busca_troco);
                                                   $troco = mysqli_fetch_array($resultado_troco);
                                                   if ($fp["forma_pagamento"] == "Dinheiro" or $fp["forma_pagamento"] == "dinheiro") {
                                                       $valor_r = $res["valor"] - $troco["troco"];
                                                   }else{
                                                    $valor_r = $res["valor"];
                                                   }
                                                   
                                             ?>
                                            <tr>
                                                <td><?php echo $fp["forma_pagamento"]; ?></td>
                                                <td class="valor-pago"><?php echo $res["valor"]; ?></td>
                                                <td class="valor-troco"><?php echo $troco["troco"]; ?></td>
                                                <td class="valor-calculado"><?php echo $valor_r; ?></td>
                                                <td>
                                                    <?php if (@$_SESSION['id_adm'] != null) { ?>
                                                    <a title="Cancelar" class="btn btn-danger" href="funcoes/cancelar_venda.php?id=<?php echo $res["id_pagamento"]; ?>"><i class="fas fa-times-circle"></i></a>
                                                    <?php } ?>
                                                </td>
                                            </tr>
                                            <?php }} ?>
                                        </tbody>
                                        <tfoot>
                                            <tr class="bg-danger text-white">
                                                <th><b>Totais</b></th>
                                                <th><div id="qtdpago"></div></th>
                                                <th><div id="qtdtroco"></div></th>
                                                <th><div id="qtdtotal"></div></th>
                                                <th></th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>

                    <?php }elseif (isset($_GET["funcionario"])) { ?>
                        <!-- exibindo configuações gerais -->
                        <div class="card mb-4">
                            <div class="container">
                                <center class="mt-3"><h3>Dados do Funcionário</h3></center>
                                <?php 
                                $busca_funcionario2 = "SELECT * FROM funcionarios WHERE id_adm = '$id_adm' AND id_funcionario = '$id_funcionario'";
                                $resultado_funcionario2 = mysqli_query($conexao, $busca_funcionario2);
                                $funcionario = mysqli_fetch_array($resultado_funcionario2);
                                 ?>
                                <form action="funcoes/atualizar_dados.php" method="post">

                                    <input type="hidden" value="<?php echo $id_adm ?>" name="id_adm">

                                    <label for="empresa">Empresa:</label>
                                    <input id="empresa" class="form-control mb-3" value="<?php echo $funcionario['nome'] ?>" type="text" value="" name="empresa">

                                    <label for="email">Email:</label>
                                    <input id="email" class="form-control mb-3" value="<?php echo $funcionario['email'] ?>" type="email" value="" name="cnpj">

                                    <label for="telefone">Telefone:</label>
                                    <input id="telefone" class="form-control mb-3" value="<?php echo $funcionario['telefone'] ?>" type="text" value="" name="telefone" onkeypress="mask(this, mphone);" onblur="mask(this, mphone);">

                                    <input class="btn btn-success" type="submit" value="Salvar Edição" name="">
                                </form>
                            </div>
                        </div>

                    <?php
                    }elseif (isset($_GET["vendas"])) {
                    $id_caixa = $v->verifica_caixa($id_adm, $id_funcionario);
                    if (is_null($id_caixa)) {
                        echo "<center><h2><strong>Caixa Fechado</strong></h2></center>";
                    }else{
                    //var_dump($id_caixa);
                    $id_venda = $v->verifica_vendas($id_adm, $id_funcionario, $id_caixa);

                    $total_pago = $v->verifica_pagamento($id_venda);
                    $total_pago_formatado = number_format($total_pago, 2, ',', ' ');
                    //var_dump($id_venda);
                    ?>
                        <!-- exibindo configuações de vendas -->
                    
                        <div id="tabelaCategoriaLoad" class="card mb-4">
                            <div class="row">
                                <div class="col-lg-3">
                                    </button>
                                    <button class="btn btn-info mt-1 mb-1 mr-3 ml-3" data-toggle="modal" data-target=".bd-example-modal-xl">Pesquisar Produtos</button>
                                </div>
                                <div class="col-lg-4">
                                    <form class="mt-1 mb-1 mr-3 ml-3" action="funcoes/registrar_produtos.php" method="post">
                                        <input type="hidden" value="<?php echo $id_caixa ?>" name="id_caixa">
                                        <input type="hidden" value="<?php echo $id_venda ?>" name="id_venda">
                                        <input type="hidden" value="<?php echo $id_funcionario ?>" name="id_funcionario">
                                        <input type="hidden" value="<?php echo $id_adm ?>" name="id_adm">
                                        <div class="row">
                                            <input class="form-control mb-3 col-lg-7 mr-3" type="text" placeholder="Código do Produto" name="codigo">
                                            <input class="form-control mb-3 col-lg-2 mr-3" type="text" value="1" name="quantidade">
                                            <div class="col-lg-1">
                                                <button class="btn btn-success" type="submit"><i class="fa fa-check" aria-hidden="true"></i></button>
                                            </div>
                                        </div>
                                        
                                    </form>
                                </div>
                                <div class="col-lg-4 text-right">
                                    <?php $data_abertura = $v->verifica_data_caixa($id_adm, $id_funcionario); ?>
                                    <p><strong>Caixa Aberto em: <?php echo date('d/m/Y',  strtotime($data_abertura)); ?></strong></p>
                                </div>
                            </div>
                            <div class="card-header">
                                <i class="fas fa-table mr-1"></i>
                                <b>Tela de Vendas</b>
                            </div>
                            
                            <div class="card-body">
                                <div class="table-responsive">
                                    <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                                        <thead>
                                            <tr>
                                                <th>Código</th>
                                                <th>Produto</th>
                                                <th>Quantidade</th>
                                                <th>Valor</th>
                                                <th>Ações</th>
                                            </tr>
                                        </thead>
                                        
                                        <tbody>
                                            <?php
                                            $total = 0;
                                            $busca_vendas = "SELECT * FROM produto_venda WHERE id_venda = '$id_venda'";
                                            $resultado_vendas = mysqli_query($conexao, $busca_vendas);
                                            $linha_vendas = mysqli_num_rows($resultado_vendas);
                                            if($linha_vendas == ''){
                                                echo "<th><h3> Não foram inseridos nenhum produto!! </h3></th>";
                                            }else{
                                                while($res = mysqli_fetch_array($resultado_vendas)){
                                                    $id_produto = $res["id_produto"];
                                                    $busca_produto = "SELECT * FROM produtos WHERE id_produto = '$id_produto'";
                                                    $resultado_produto = mysqli_query($conexao, $busca_produto);
                                                    $produto = mysqli_fetch_array($resultado_produto);
                                                    $total += ($produto["preco"] * $res["quantidade"]);
                                                    $total_formatado = number_format($total, 2, ',', ' ');
                                                    $troco = $total_pago - $total;
                                                    //var_dump($troco);
                                                    $troco_formatado = number_format($troco, 2, ',', ' ');
                                             ?>
                                            <tr>
                                                <td><?php echo $produto["codigo"]; ?></td>
                                                <td><?php echo $produto["produto"]; ?></td>
                                                <td><?php echo $res["quantidade"]; ?></td>
                                                <td><?php echo $produto["preco"]; ?></td>
                                                <td>
                                                    <a title="Excluir" class="btn btn-danger" href="funcoes/deletar_pv.php?id=<?php echo $res["id_pv"]; ?>&total=<?php echo $total ?>"><i class="fa fa-minus-square"></i></a>
                                                </td>
                                            </tr>
                                            <?php }} ?>
                                        </tbody>

                                        <tfoot class="bg-success">
                                            <tr>
                                                <th></th>
                                                <th>Total Venda = R$ <?php
                                                if ($total > 0) {
                                                echo $total_formatado;
                                                }else{
                                                    echo 0;
                                                }
                                                ?></th>
                                                <th>Total Pago = R$ <?php
                                                if ($total_pago > 0) {
                                                echo $total_pago_formatado;
                                                }else{
                                                    echo 0;
                                                }?></th>
                                                <th>Troco = R$ <?php
                                                if (isset($troco) and $troco > 0) {
                                                echo $troco_formatado;
                                                }else{
                                                    echo 0;
                                                }
                                                ?></th>
                                                <th>
                                                    <button v-on:keyup.enter="submit" type="button" class="btn btn-primary" data-toggle="modal" data-target="#ModalRecebimento">
                                                      Finalizar Venda
                                                    </button>
                                                </th>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <?php }
                        $busca_dinheiro = "SELECT sum(valor) FROM pagamento WHERE forma = '1' AND id_caixa = '$id_caixa'";
                        $resultado_dinheiro = mysqli_query($conexao, $busca_dinheiro);
                        $dinheiro = mysqli_fetch_array($resultado_dinheiro);
                        if ($dinheiro['sum(valor)'] == "") {
                            $dinheiro['sum(valor)'] = 0;
                        }
                          //echo $dinheiro['sum(valor)']."<br>";
                        $busca_debito = "SELECT sum(valor) FROM pagamento WHERE forma = '2' AND id_caixa = '$id_caixa'";
                          $resultado_debito = mysqli_query($conexao, $busca_debito);
                          $debito = mysqli_fetch_array($resultado_debito);
                          if ($debito['sum(valor)'] == "") {
                              $debito['sum(valor)'] = 0;
                          }
                          //echo $debito['sum(valor)']."<br>";

                          $busca_credito = "SELECT sum(valor) FROM pagamento WHERE forma = '3' AND id_caixa = '$id_caixa'";
                          $resultado_credito = mysqli_query($conexao, $busca_credito);
                          $credito = mysqli_fetch_array($resultado_credito);
                          if ($credito['sum(valor)'] == "") {
                              $credito['sum(valor)'] = 0;
                          }

                          $busca_depodito = "SELECT sum(valor) FROM pagamento WHERE forma = '4' AND id_caixa = '$id_caixa'";
                          $resultado_depodito = mysqli_query($conexao, $busca_depodito);
                          $depodito = mysqli_fetch_array($resultado_depodito);
                          if ($depodito['sum(valor)'] == "") {
                              $depodito['sum(valor)'] = 0;
                          }

                          //busca sangrias
                          $busca_sangria = "SELECT sum(valor) FROM sangria WHERE id_caixa = '$id_caixa'";
                          $resultado_sangria = mysqli_query($conexao, $busca_sangria);
                          $sangria = mysqli_fetch_array($resultado_sangria);
                          $linha_sangrias = mysqli_num_rows($resultado_sangria);
                          if ($sangria['sum(valor)'] == "") {
                              $sangria['sum(valor)'] = 0;
                          }

                          //busca suprimentos
                          $busca_suprimento = "SELECT sum(valor) FROM suprimentos WHERE id_caixa = '$id_caixa'";
                          $resultado_suprimento = mysqli_query($conexao, $busca_suprimento);
                          $suprimento = mysqli_fetch_array($resultado_suprimento);
                          $linha_suprimento = mysqli_num_rows($resultado_suprimento);
                          if ($suprimento['sum(valor)'] == "") {
                              $suprimento['sum(valor)'] = 0;
                          }

                          //busca troco
                          $troco2 = 0;
                          $busca_t = "SELECT * FROM vendas WHERE id_caixa = '$id_caixa'";
                          $resultado_t = mysqli_query($conexao, $busca_t);
                          //$t = mysqli_fetch_array($resultado_t);
                          $linha_t = mysqli_num_rows($resultado_t);
                          //var_dump($linha_t);
                          while ($t = mysqli_fetch_array($resultado_t)) {
                              $troco2 += $t["troco"];
                          }

                          $dinheiro2 = $dinheiro['sum(valor)'] - $troco2;
                          if ($linha_sangrias > 0) {
                              $dinheiro2 -= $sangria['sum(valor)'];
                          }
                          if ($linha_suprimento > 0) {
                              $dinheiro2 += $suprimento['sum(valor)'];
                          }
                         ?>
                        <div id="supsangria" class="card mb-4">
                            <div class="row">
                                <div class="col-lg-2 ml-2 mt-3 mb-3">
                                    <form action="funcoes/abrir_caixa.php" method="post">
                                        <input type="hidden" value="<?php echo $id_funcionario ?>" name="id_funcionario">
                                        <input type="hidden" value="<?php echo $id_adm ?>" name="id_adm">
                                        <button type="submit" class="btn btn-success" type="submit">
                                            Abrir Caixa 
                                        </button>
                                    </form>
                                </div>
                                <div class="col-lg-2 mt-3 mb-3">
                                    <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#ModalFechamento">
                                        Fechar Caixa 
                                    </button>
                                </div>
                                <div class="col-lg-2 mt-3 mb-3">
                                    <button type="button" class="btn btn-primary" v-on:click="suprimento = !suprimento">
                                        Suprimento 
                                    </button>
                                </div>
                                <div class="col-lg-2 mt-3 mb-3">
                                    <button v-on:click="sangria = !sangria" type="button" class="btn btn-danger">
                                        Sangria
                                    </button>
                                </div>
                            </div>
                            <div class="container mt-3 mb-3">
                                <center v-if="sangria">
                                <h3><strong>Sangria</strong></h3>
                                <form action="funcoes/sangria.php" method="post">
                                    <input type="hidden" value="<?php echo $id_adm ?>" name="id_adm">
                                    <input type="hidden" value="<?php echo $id_funcionario ?>" name="id_funcionario">
                                    <input type="hidden" value="<?php echo $id_caixa ?>" name="id_caixa">
                                    <input type="hidden" value="<?php echo $dinheiro2 ?>" name="saldo">
                                    <input type="text" class="form-control col-lg-3 mb-2" placeholder="Descrição" name="descricao">
                                    <input class="form-control col-lg-3 mb-2" placeholder="Escreva o Valor" type="text" name="sangria" onKeyPress="return(moeda(this,',','.',event))">
                                    <button class="btn btn-danger" type="submit"><i class="fa fa-check" aria-hidden="true" title="confirmar"></i></button>
                                </form>
                                </center>
                            </div>
                            <div class="container mt-3 mb-3">
                                <center v-if="suprimento">
                                <h3><strong>Suprimento</strong></h3>
                                <form action="funcoes/suprimento.php" method="post">
                                    <input type="hidden" value="<?php echo $id_adm ?>" name="id_adm">
                                    <input type="hidden" value="<?php echo $id_funcionario ?>" name="id_funcionario">
                                    <input type="hidden" value="<?php echo $id_caixa ?>" name="id_caixa">
                                    <input type="text" class="form-control col-lg-3 mb-2" placeholder="Descrição" name="descricao">
                                    <input class="form-control col-lg-3 mb-2" placeholder="Escreva o Valor" type="text" name="suprimento" onKeyPress="return(moeda(this,',','.',event))">
                                    <button class="btn btn-success" type="submit"><i class="fa fa-check" aria-hidden="true"></i></button>
                                </form>
                                </center>
                            </div>    
                        </div>
                        <?php } ?>
                    </div>
                </main>
<?php 
    include_once("rodape.php");
}else{
    echo "<script language='javascript'>window.alert('ERRO - não está Logado'); </script>";
    echo "<script language='javascript'>window.location='login.php'; </script>";
}
?>

                                <!-- Modais de Cadastro -->

<?php if(isset($_GET["vendas"])) { ?>
<!-- Modal de Fechamento-->
<div class="modal fade" id="ModalFechamento" tabindex="-1" role="dialog" aria-labelledby="TituloModalCentralizado" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="TituloModalCentralizado">Fechamento de Caixa</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">

      <div class="container">
        <div class="alert alert-success" role="alert">
          <strong>Dinheiro = <?php echo $dinheiro2; ?></strong>
        </div>
      </div>

      <div class="container">
        <div class="alert alert-primary" role="alert">
          <strong>Débito = <?php echo $debito['sum(valor)']; ?></strong>
        </div>
      </div>

      <div class="container">
        <div class="alert alert-info" role="alert">
          <strong>Crédito = <?php echo $credito['sum(valor)']; ?></strong>
        </div>
      </div>

      <div class="container">
        <div class="alert alert-secondary" role="alert">
          <strong>Depósito = <?php echo $depodito['sum(valor)']; ?></strong>
        </div>
      </div>
      <center class="row">
          <div class="container col">
            <a class="btn btn-warning" href="inicio.php?fechamento">Relatório Detalhado</a>
          </div>

          <div class="container col">
            <form action="funcoes/fechar_caixa.php" method="post">
                <input type="hidden" name="dinheiro" value="<?php echo $dinheiro2; ?>">
                <input type="hidden" name="debito" value="<?php echo $debito['sum(valor)']; ?>">
                <input type="hidden" name="credito" value="<?php echo $credito['sum(valor)']; ?>">
                <input type="hidden" name="deposito" value="<?php echo $depodito['sum(valor)']; ?>">
                <input type="hidden" name="id_caixa" value="<?php echo $id_caixa; ?>">
                <input type="submit" class="btn btn-danger" value="Fechar Caixa">
            </form>
          </div>
      </center>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>
<?php } ?>

<!-- Estilo da tabela -->
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

<!-- Modal Buscar Produtos-->
<div class="modal fade bd-example-modal-xl" tabindex="-1" role="dialog" aria-labelledby="myExtraLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-xl">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="TituloModalCentralizado">Buscar Produtos</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <input class="form-control mb-3 col-lg-3" type="text" id="txtBusca" placeholder="Digite aqui um valor para filtrar..."/>
          <div class="table-responsive">
            
            <table  id="Itens" class="table table-striped" border="1">
                <thead>
                    <tr>
                        <th scope="col">Produto</th>
                    </tr>
                </thead>
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
                    <tr class="tr">
                        <td scope="row" class="row">
                            <div class="col">
                                <?php echo $res["codigo"]; ?>
                            </div>
                            <div class="col">
                                <?php echo $res["produto"] ?>
                            </div>
                            <div class="col">
                                <?php echo $res["preco"]; ?>
                            </div>
                            <div class="col">
                                <form class="mt-3 mb-3 mr-3 ml-3" action="funcoes/registrar_produtos.php" method="post">
                                    <input type="hidden" value="<?php echo $id_caixa ?>" name="id_caixa">
                                    <input type="hidden" value="<?php echo $id_venda ?>" name="id_venda">
                                    <input type="hidden" value="<?php echo $id_funcionario ?>" name="id_funcionario">
                                    <input type="hidden" value="<?php echo $id_adm ?>" name="id_adm">
                                    <input class="form-control mb-3 col-lg-8 mr-3" type="hidden" value="<?php echo $res["codigo"] ?>" name="codigo">
                                    <div class="row">
                                        <input class="form-control mb-3 col-lg-2 mr-3" type="text" value="1" name="quantidade">
                                        <div class="col-lg-2">
                                            <button class="btn btn-success" type="submit"><i class="fa fa-check" aria-hidden="true"></i></button>
                                        </div>
                                    </div>                                      
                                </form>
                            </div>
                        </td>
                    </tr>
                    <?php }} ?>
                    <!-- nova tabela -->
                </tbody>
            </table>
          </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
        </div>
    </div>
  </div>
</div>

<!-- Modal Recebimento-->
<div class="modal fade" id="ModalRecebimento" tabindex="-1" role="dialog" aria-labelledby="TituloModalCentralizado" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="TituloModalCentralizado">Receber Pagamento</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Fechar">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form action="funcoes/receber_pagamento.php" method="post">
            <input type="hidden" value="<?php echo($id_adm); ?>" name="id_adm">
            <input type="hidden" value="<?php echo($id_venda); ?>" name="id_venda">
            <input type="hidden" value="<?php echo($total); ?>" name="total">
            <input type="hidden" value="<?php echo($total_pago); ?>" name="total_pago">
            <input type="hidden" value="<?php echo($id_caixa); ?>" name="id_caixa">
            <select id="txtInput" class="form-control mb-3" name="forma">
                <?php 
                $busca_forma = "SELECT * FROM forma_pagamento";
                $resultado_forma = mysqli_query($conexao, $busca_forma);
                while ($forma = mysqli_fetch_array($resultado_forma)) {
                 ?>
                <option value="<?php echo $forma["id_fp"]; ?>"><?php echo $forma["forma_pagamento"]; ?></option>
                <?php } ?>
            </select>
            <?php
            
            $falta = $total - $total_pago;
            $falta_formatado = number_format($falta, 2, ',', ' ');
            if ($total_pago > $total) {
                $falta = 0;
                $falta = number_format($falta, 2, ',', ' ');
            }
            if (!isset($troco)) {
                $troco = 0;
            }
            
            ?>
            <input class="form-control" type="text" value="<?php echo $falta ?>" name="valor" onKeyPress="return(moeda(this,',','.',event))">
            <?php
            if ($total_pago < $total) { ?>
            <div class="alert alert-danger mt-3 mb-3 text-center" role="alert">
              <strong><?php echo "Falta receber R$ ".$falta_formatado; ?></strong>
            <?php } ?>
            <br>
            <?php
            if ($total_pago > $total) { ?>
            <div class="alert alert-success mt-3 mb-3 text-center" role="alert">
              <strong><?php echo "Troco R$ ".$troco; ?></strong>
            </div>
            <?php } ?>
      </div>
      <div class="modal-footer">

        <button type="submit" class="btn btn-primary">Inserir</button>
        </form>
        <?php if ($total_pago >= $total) { ?>
        <form action="funcoes/finalizar_venda.php" method="post">
            <input type="hidden" value="<?php echo($id_caixa); ?>" name="id_caixa">
            <input type="hidden" name="id_venda" value="<?php echo $id_venda; ?>">
            <input type="hidden" name="total" value="<?php echo $total; ?>">
            <input type="hidden" value="<?php echo($troco); ?>" name="troco">
            <input type="hidden" value="<?php echo($total_pago); ?>" name="valor_pago">
            <button type="submit" class="btn btn-success">Finalizar Venda</button>
        </form>
        <?php } ?>
        <a class="btn btn-danger" href="funcoes/limpar_pagamentos.php?id=<?php echo $id_venda ?>&id_caixa=<?php echo $id_caixa ?>">Limpar Pagamentos</a>
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Fechar</button>
      </div>
    </div>
  </div>
</div>
                                <!-- Modais de Edição -->
<!-- Script jquery de Busca -->
<script type="text/javascript">
$(function(){
    $("#txtBusca").keyup(function(){
        var texto = $(this).val();

        $("#Itens .tr").css("display", "block");
        $("#Itens .tr").each(function(){
            if($(this).text().toUpperCase().indexOf(texto.toUpperCase()) < 0)
            $(this).css("display", "none");
        });
    });
});
</script>

<script type="text/javascript">
    new Vue({
      el: '#supsangria',
      data: {
        suprimento: false,
        sangria: false
      }
    })
</script>

<script type="text/javascript">
    $(document).keypress(function(event) {
  if (event.keyCode  == 13){
    $("#ModalRecebimento").modal("show");
  }
  if (event.keyCode  == 61){
    $("#ModalFechamento").modal("show");
  }
</script>

<script>
function myFunction() {
    document.getElementById("txtInput").select();
}
</script>

<script type="text/javascript">
  var els = document.getElementsByClassName("valor-pago");
  var valorcalculado = 0;
  [].forEach.call(els, function (el) 
  {
    valorcalculado += parseFloat(el.innerHTML);
  });

  var valorcalculado = parseFloat(valorcalculado.toFixed(2));
  document.getElementById("qtdpago").innerHTML = valorcalculado;
</script>

<script type="text/javascript">
  var els = document.getElementsByClassName("valor-calculado");
  var valorcalculado = 0;
  [].forEach.call(els, function (el) 
  {
    valorcalculado += parseFloat(el.innerHTML);
  });

  var valorcalculado = parseFloat(valorcalculado.toFixed(2));
  document.getElementById("qtdtotal").innerHTML = valorcalculado;
</script>

<script type="text/javascript">
  var els = document.getElementsByClassName("valor-troco");
  var valorcalculado = 0;
  [].forEach.call(els, function (el) 
  {
    valorcalculado += parseFloat(el.innerHTML);
  });

  var valorcalculado = parseFloat(valorcalculado.toFixed(2));
  document.getElementById("qtdtroco").innerHTML = valorcalculado;
</script>

<script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>


                <!--AJAX PARA INSERÇÃO E EDIÇÃO DOS DADOS COM IMAGEM -->
                <script type="text/javascript">
                    $("#dados").submit(function () {
                        event.preventDefault();
                        var formData = new FormData(this);

                        $.ajax({
                            url: "funcoes/registrar_produtos.php",
                            type: 'POST',
                            data: formData,

                            success: function (mensagem) {

                                $('#mensagem').removeClass()

                                if (mensagem.trim() == "Salvo com Sucesso!") {

                    //$('#nome').val('');
                    //$('#cpf').val('');
                    $('#btn-fechar').click();
                    window.location = "inicio.php?vendas";

                } else {

                    $('#mensagem').addClass('text-danger')
                }

                $('#mensagem').text(mensagem)

            },

            cache: false,
            contentType: false,
            processData: false,
            xhr: function () {  // Custom XMLHttpRequest
                var myXhr = $.ajaxSettings.xhr();
                if (myXhr.upload) { // Avalia se tem suporte a propriedade upload
                    myXhr.upload.addEventListener('progress', function () {
                        /* faz alguma coisa durante o progresso do upload */
                    }, false);
                }
                return myXhr;
            }
        });
                    });
                </script>