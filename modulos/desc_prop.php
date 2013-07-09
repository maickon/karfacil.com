<?php

require_once(dirname(dirname(__FILE__))."/funcoes.php");
$prop = new objPropagandas();
$prop->extras_select = " WHERE id=".$_GET['id'];
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

<div class="v_desc radius5" align="center">
<div class="fb-facepile" data-href="http://127.0.0.1/01/karfacil/" data-max-rows="1" data-width="300"></div>
</div>

<div class="v_desc radius5" align="center"> 
	<p class="fonte"><?php exibirProp($prop_resp) ?></p>
</div>