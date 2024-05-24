<?php
// Carregar dompdf
require_once '../lib/dompdf/autoload.inc.php';

use Dompdf\Dompdf;

$id=$_GET['id_venda'];



 $html=file_get_contents("http://localhost/Ferraz_Sistemas/comprovante.php?id_venda=".$id);


 
// Instanciamos um objeto da classe DOMPDF.
$pdf = new DOMPDF();
 
// Definimos o tamanho do papel e orientação.
$pdf->set_paper("letter", "portrait");
 
// Carregar o conteúdo html.
$pdf->load_html(utf8_decode($html));
 
// Renderizar PDF.
$pdf->render();
 
// Enviamos pdf para navegador.
$pdf->stream('relatorioVenda.pdf');




