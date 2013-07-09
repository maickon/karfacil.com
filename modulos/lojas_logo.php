<?php 
require_once(dirname(dirname(__FILE__))."/funcoes.php");
protegeArquivo(basename(__FILE__));
?>
<div id="lojas_logo">
	<p>Lojas filiadas</p>
	<?php 
	$lojas_logo = new objLojas();
	$lojas_logo->inicializarLojasLogo();
	while($logos = $lojas_logo->retorna_dados()):
	?>
	<a href="?desc_l&id=<?php echo $logos->id ?>"><img id="img_logo" alt="<?php echo $logos->nome ?>" title="<?php echo $logos->nome ?>" src="<?php echo IMGLOJASPATH.$logos->nome.'/'.$logos->logo?>" width="100" height="100"></a>
<?php endwhile;?>
</div>