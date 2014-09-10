<?php

require_once(dirname(dirname(__FILE__))."/funcoes.php");
$prop = new objPropagandas();
$prop->extras_select = " WHERE id=".antiInject($_GET['id']);
$prop->seleciona_tudo($prop);
$prop_resp = $prop->retorna_dados();
?>
<h1 align="center">Conheça a <?php echo $prop_resp->nome?></h1>
<div class="slide"> 
	<div id="destaques" align="center">
		<a class="faixa" href="#" title=""></a>
	    	<ul>
	        	<li>
	            	<a href="#" title="<?php echo $prop_resp->nome?> destaque"><img src="<?php echo IMGPROPAGANDASPATH.$prop_resp->nome.'/'.$prop_resp->img_1 ?>" alt="<?php echo $prop_resp->nome?> destaque" /></a>
	                <div class="fundo"></div>
	                <p><a href="#" title="<?php echo $prop_resp->nome?> destaque"><?php echo $prop_resp->nome?></a></p>            
	            </li>
	            
	        	<li>
	            	<a href="#" title="<?php echo $prop_resp->nome?> destaque"><img src="<?php echo IMGPROPAGANDASPATH.$prop_resp->nome.'/'.$prop_resp->img_2 ?>" alt="<?php echo $prop_resp->nome?> destaque" /></a>
	                <div class="fundo"></div>
	                <p><a href="#" title="<?php echo $prop_resp->nome?> destaque"><?php echo $prop_resp->nome?></a></p>            
	            </li>
	            
	            <li>
	            	<a href="#" title="<?php echo $prop_resp->nome?> destaque"><img src="<?php echo IMGPROPAGANDASPATH.$prop_resp->nome.'/'.$prop_resp->img_3 ?>" alt="<?php echo $prop_resp->nome?> destaque" /></a>
	                <div class="fundo"></div>
	                <p><a href="#" title="<?php echo $prop_resp->nome?> destaque"><?php echo $prop_resp->nome?></a></p>            
	            </li>
	            
	            <li>
	            	<a href="#" title="<?php echo $prop_resp->nome?> destaque"><img src="<?php echo IMGPROPAGANDASPATH.$prop_resp->nome.'/'.$prop_resp->img_4 ?>" alt="<?php echo $prop_resp->nome?> destaque" /></a>
	                <div class="fundo"></div>
	                <p><a href="#" title="<?php echo $prop_resp->nome?> destaque"><?php echo $prop_resp->nome?></a></p>            
	            </li>
	</div>
</div>

<div class="v_desc radius5" align="left">
<div class="fb-like" data-href="http://karfacil.com" data-width="550" data-show-faces="true" data-send="true"></div>
</div>

<div class="v_desc radius5" align="center"> 
<?php 
if($prop_resp->google_map):
	$google_resp = 'Nos encontre aqui !';
else:
	$google_resp = '';
endif;		
?>
<p class="fonte"><?php echo $google_resp ?></p>
<?php echo $prop_resp->google_map ?>
</div>

<div class="v_desc radius5" align="center">
	<hr /> 
	<p class="fonte"><?php exibirProp($prop_resp) ?></p>
</div>


<br />
<br />
<br />
<br />
<br />
<br />