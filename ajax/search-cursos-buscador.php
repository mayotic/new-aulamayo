<?php
include_once '../cms/core.php';
global $_l;

if (!Tools::isAjax()) {
    //die('Acceso no permitido');
}

//Tools::showAllPhpErrors();
Tools::loadTranslation($lang = $conf['app']['default_lang']);

$canalid = false;
if (Tools::get('canalid')){
    $canalid = $_GET['canalid'];
}

if (Tools::get('searchtext')){
    $string = $_GET["searchtext"];
}

$cursos = new CursosModel();
$cursos_search = $cursos->searchCursos($string, $canalid);
//echo "<pre>"; var_dump($cursos_search); echo "</pre>"; exit();

$s = "";
if( count($cursos_search) > 0 ) {
    foreach($cursos_search as $curso_search){
        $name_curs = strlen($curso_search->nombre) > 45 ? substr($curso_search->nombre, 0, 45).'...' : $curso_search->nombre;
        $s = $s."
	<a class='link-p-colr' href='/ficha-curso/".$curso_search->url_id."'>
		<div class='live-outer'>
                <!--
            	<div class='live-im'>
                	<img src='/public/img/".$curso_search->imagen."' class='img-fluid'/>
                </div>
                -->
                <div class='live-product-det'>
                	<div class='live-product-name'>  
                    	<p>".$name_curs."</p>
                    </div>
                    <!--
                    <div class='live-product-price'>
                        <div class='live-product-price-text'><p>Rs.".number_format($curso_search->precio)."</p></div>
                    </div>
                    -->
                </div>
            </div>
	</a>
	";
    }
}else{
    echo "<p style='color:#333; font-size:18px; margin-top:15px;'>No se ha encontrado ningún curso...</p>";
}
echo $s;
exit;

?>
