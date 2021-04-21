<footer class="fixed-bottom">
	<center>
<b>Secretaría técnica</b>: secretaria@aulamayo.com | <strong>Tel.</strong>: 93 209 02 55 | © 2020 EDICIONES MAYO, S.A.
<br>
<br>
<div class="compativility text-center">
<!-- Página web optimizada para navegadores Google Chrome, Mozilla Firefox, Safari, Android Browser &amp; WebView (v5.0+) y Microsoft Edge.
Sistemas operativos tipo Macintosh: versión 10 o superior. -->
</div>

</footer>
<script type="text/javascript">
<?php
global $tdata, $conf;
$tdata['js_sitevars'] = isset($tdata['js_sitevars']) ? array_merge($tdata['js_sitevars'], ['env' => $conf['env']]) : ['env' => $conf['env']];
?>
window.sitevars = <?php echo json_encode(isset($tdata['js_sitevars']) ? $tdata['js_sitevars'] : []); ?>;
window.appvars = <?php echo json_encode(isset($tdata['js_appvars']) ? $tdata['js_appvars'] : []); ?>;
</script>
