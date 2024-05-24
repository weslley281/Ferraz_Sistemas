<?php

include_once("../classes/pagamentos.php");
include_once("../classes/conexao.php");

$registro = new pagamentos();

$forma_pagamento = $_POST["forma_pagamento"];

$tentativa = $registro->registrar_pagamento($forma_pagamento);

if ($tentativa > 0) {
    //echo "<script language='javascript'>window.alert('Forma de Pagamento Cadastrada com sucesso'); </script>";
    echo "<script language='javascript'>window.location='../pagamentos.php'; </script>";
}else{
    echo "<script language='javascript'>window.alert('Erro ao Cadastrar'); </script>";
    echo "<script language='javascript'>window.location='../pagamentos.php'; </script>";
}