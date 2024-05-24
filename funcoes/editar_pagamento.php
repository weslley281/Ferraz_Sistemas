<?php

include_once("../classes/pagamentos.php");
include_once("../classes/conexao.php");

$registro = new pagamentos();

$id_fp = $_POST["id_fp"];
$forma_pagamento = $_POST["forma_pagamento"];

$tentativa = $registro->editar_pagamento($id_fp, $forma_pagamento);

if ($tentativa > 0) {
    //echo "<script language='javascript'>window.alert('Forma de Pagamento Editada com sucesso'); </script>";
    echo "<script language='javascript'>window.location='../pagamentos.php'; </script>";
}else{
    echo "<script language='javascript'>window.alert('Erro ao Editar'); </script>";
    echo "<script language='javascript'>window.location='../pagamentos.php'; </script>";
}