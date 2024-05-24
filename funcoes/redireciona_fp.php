<?php

$dataPesquisa = $_GET["dataPesquisa"];
$id_fp = $_GET["id_fp"];

echo "<script language='javascript'>window.location='../inicio.php?fechamento=&dataPesquisa=$dataPesquisa&forma=$id_fp'; </script>";