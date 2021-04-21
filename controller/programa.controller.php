<?php
$fullPath = $_SERVER['DOCUMENT_ROOT'] . '/public/downloads/programa-foro-leo-2020.pdf';

header("Cache-Control: public");
header("Content-Description: File Transfer");
header('Content-disposition: attachment; filename='.basename($fullPath));
header("Content-Type: application/force-download");
header("Content-Type: application/pdf");
header('Content-Length: '. filesize($fullPath));
readfile($fullPath);
exit;
