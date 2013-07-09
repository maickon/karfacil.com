<?php 
require_once(dirname(dirname(__FILE__))."/funcoes.php");
protegeArquivo(basename(__FILE__));

$noticias = new noticias();
$noticias->extras_select = " WHERE id=".$_GET['id'];
$noticias->seleciona_tudo($noticias);
$noticias_r  = $noticias->retorna_dados();
?>

<div align="center">
<div class="post titulo" ><?php echo $noticias_r->titulo ?></div> 
<div align="right data">Postado dia  <?php printf('%s',date("d/m/Y h:i",strtotime($noticias_r->data)))?> Por <?php echo $noticias_r->usuario ?></div>
<hr />
<p class="post" >
	<?php echo $noticias_r->texto?>
</p>
<hr />
</div> 

<div class="face_plugin" align="center">
	<div class="fb-comments fundo" data-href="http://127.0.0.1/01/karfacil" data-width="500" data-num-posts="10"></div>
	<div class="fb-follow" data-href="http://127.0.0.1/01/karfacil" data-show-faces="true" data-width="450"></div>
</div>