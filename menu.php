<?php
    session_start();
    $usuario = $_SESSION['usuario'];
    $nome = $_SESSION['nome'];
    $id_adm = @$_SESSION['id_adm'];
    $id_mestre = @$_SESSION['id_mestre'];
    $id_funcionario = @$_SESSION['id_funcionario'];
?>
<!DOCTYPE html>
<html lang="pt-br">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Ferraz - Sistemas</title>

        <link href="css/styles.css" rel="stylesheet" />
        <link href="https://cdn.datatables.net/1.10.20/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <link rel="stylesheet" type="text/css" href="lib/alertifyjs/css/alertify.css">
        <link rel="stylesheet" type="text/css" href="lib/alertifyjs/css/themes/default.css">
        <link rel="stylesheet" type="text/css" href="lib/select2/css/select2.css">

        <script type="text/javascript" src="js/jquery.js"></script>
        <script src="lib/alertifyjs/alertify.js"></script>
        <script src="lib/select2/js/select2.js"></script>
        <script src="js/funcoes.js"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.1/js/all.min.js" crossorigin="anonymous"></script>
        <script src="js/vue.js" type="text/javascript"></script>
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <a class="navbar-brand" href="index.html">Ferraz Freelancers</a>
            <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><i class="fas fa-bars"></i></button>
            <!-- Navbar Search-->
            <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
                <div class="input-group">
                    <input class="form-control" type="text" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2" />
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="button"><i class="fas fa-search"></i></button>
                    </div>
                </div>
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ml-auto ml-md-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i></a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                        <?php if (@$_SESSION['id_adm'] != null) { ?>
                        <a class="dropdown-item" href="configuracoes.php">Configurações</a>     
                        <a class="dropdown-item" href="registrar_funcionario.php">Registrar funconários</a>
                        <?php } ?>
                        <?php if (@$_SESSION['id_mestre'] != null) { ?>
                        <a class="dropdown-item" href="registrar_adm.php">Registrar administrador</a>
                        <a class="dropdown-item" href="registrar_mestre.php">Registrar adm mestre</a>
                        <div class="dropdown-divider"></div>
                        <?php } ?>
                        <?php if (@$_SESSION['id_funcionario'] != null) { ?>
                        <a class="dropdown-item" href="inicio.php?funcionario">Editar meus dados</a>
                        <?php } ?>
                        <a class="dropdown-item" href="funcoes/sair.php">Sair</a>
                    </div>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Core</div>
                            <a class="nav-link" href="inicio.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            <div class="sb-sidenav-menu-heading">Gerenciamento</div>
                            <a class="nav-link" href="produtos.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-archive"></i></div>
                                Produtos
                            </a>
                            <a class="nav-link" href="categorias.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-save"></i></i></div>
                                Categorias
                            </a>
                            <a class="nav-link" href="pagamentos.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-money-bill-wave"></i></div>
                                Forma de Pagamento
                            </a>
                            <a class="nav-link" href="relatorios.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-copy"></i></div>
                                Relatório de Vendas
                            </a>
                            <a class="nav-link" href="caixas.php">
                                <div class="sb-nav-link-icon"><i class="fas fa-copy"></i></div>
                                Relatório de Caixas
                            </a>
                            <?php if (@$_SESSION['id_funcionario'] != null) { ?>
                            <a class="nav-link" href="inicio.php?vendas">
                                <div class="sb-nav-link-icon"><i class="fas fa-dollar-sign"></i></div>
                                Vendas
                            </a>
                            <?php } ?>
                            <!--
                            <a class="nav-link" href="tables.html">
                                <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                                Tables
                            </a>
                            -->
                        </div>
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logado como:</div>
                        <?php echo $nome; ?>
                    </div>
                </nav>
            </div>
