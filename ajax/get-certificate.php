<?php
include '../cms/core.php';
global $conf, $appconf, $tdata;

Tools::showAllPhpErrors();

require_once $conf['app']['root'] . '/include/dompdf/autoload.inc.php';

use Dompdf\Dompdf;

$dompdf = new Dompdf();
$dompdf->loadHtml('<h1>HelloWorld</h1>This is my first test');

// (Optional) Setup the paper size and orientation
$dompdf->setPaper('A4', 'landscape');

// Render the HTML as PDF
$dompdf->render();

// Output the generated PDF to Browser
$dompdf->stream();

 ?>
