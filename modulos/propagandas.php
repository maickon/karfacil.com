<?php 
require_once(dirname(dirname(__FILE__))."/funcoes.php");
protegeArquivo(basename(__FILE__));
?>
<div id="propagandas">
	<p>Propagandas</p>
<?php 
	$prop_logo = new objPropagandas();
	$prop_logo->inicializarPropLogo();
	while($logos = $prop_logo->retorna_dados()):
		if($logos->propaganda_completa == 's'):
?>
			<a href="?desc_p&id=<?php echo $logos->id ?>"><img id="img_propaganda" alt="<?php echo $logos->nome?>" title="<?php echo $logos->nome?>" src="<?php echo IMGPROPAGANDASPATH.$logos->nome.'/'.$logos->logo?>" width="50" height="100"></a>
<?php 
		else:
?>
			<img id="img_propaganda" alt="<?php echo $logos->nome?>" title="<?php echo $logos->nome?>" src="<?php echo IMGPROPAGANDASPATH.$logos->nome.'/'.$logos->logo?>" width="50" height="100">
<?php 	
		endif;
	endwhile;
?>
</div>