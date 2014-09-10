<?php
require_once(dirname(dirname(__FILE__))."/funcoes.php");
$veiculo = new objVeiculos();
$veiculo->extras_select = " WHERE id=".antiInject($_GET['id']);
$veiculo->seleciona_tudo($veiculo);
$veiculo_resp = $veiculo->retorna_dados();

$loja = new objLojas();
$loja->extras_select = " WHERE id=".antiInject($_GET['d_id']);
$loja->seleciona_tudo($loja);
$loja_resp = $loja->retorna_dados();

if($veiculo->linhas_afetadas == 0):
?>
<div class="v_desc" align="center">
	<p class="erro">Este veículo não consta em nosso banco de dados!</p>
</div>

<?php else:?>

<div align="center">
	<p>Para visualizar o veículo com mais cautela deixe o cursor do mouse sobre a imagem que ela ficará estática. 
	Para visualizar outras imagens basta dar um clique sobre um dos índices indexados por números na parte superior a direita. </p>
</div>
<div class="slide"> 
	<div id="destaques" align="center">
		<a class="faixa" href="#" title=""></a>
	    	<ul>
	        	<li>
	            	<a href="#" id="zoom_01" title="<?php echo $veiculo_resp->nome?> destaque"><img src="<?php echo IMGLOJASPATH.$_GET['d_nome'].'/'.$veiculo_resp->img_1.'/'.$veiculo_resp->img_1 ?>" data-zoom-image="<?php echo IMGLOJASPATH.$_GET['l_nome'].'/'.$veiculo_resp->img_1.'/'.$veiculo_resp->img_1 ?>" alt="<?php echo $veiculo_resp->nome?> destaque" /></a>
	                <div class="fundo"></div>
	                <p><a href="#" title="<?php echo $veiculo_resp->nome?> destaque"><?php echo $veiculo_resp->nome?></a></p>            
	            </li>
	            
	            <li>
	            	<a href="#" title="<?php echo $veiculo_resp->nome?> destaque"><img src="<?php echo IMGLOJASPATH.$_GET['d_nome'].'/'.$veiculo_resp->img_1.'/'.$veiculo_resp->img_2 ?>" alt="<?php echo $veiculo_resp->nome?> destaque" /></a>
	                <div class="fundo"></div>
	                <p><a href="#" title="<?php echo $veiculo_resp->nome?> destaque"><?php echo $veiculo_resp->nome?></a></p>            
	            </li>
	            
	            <li>
	            	<a href="#" title="<?php echo $veiculo_resp->nome?> destaque"><img src="<?php echo IMGLOJASPATH.$_GET['d_nome'].'/'.$veiculo_resp->img_1.'/'.$veiculo_resp->img_3 ?>" alt="<?php echo $veiculo_resp->nome?> destaque" /></a>
	                <div class="fundo"></div>
	                <p><a href="#" title="<?php echo $veiculo_resp->nome?> destaque"><?php echo $veiculo_resp->nome?></a></p>            
	            </li>
	            
	            <li>
	            	<a href="#" title="<?php echo $veiculo_resp->nome?> destaque"><img src="<?php echo IMGLOJASPATH.$_GET['d_nome'].'/'.$veiculo_resp->img_1.'/'.$veiculo_resp->img_4 ?>" alt="<?php echo $veiculo_resp->nome?> destaque" /></a>
	                <div class="fundo"></div>
	                <p><a href="#" title="<?php echo $veiculo_resp->nome?> destaque"><?php echo $veiculo_resp->nome?></a></p>            
	            </li>
	            
	        </ul>	
	</div>
</div>

<div class="v_desc radius5" align="left">
<div class="fb-like" data-href="http://karfacil.com" data-width="550" data-show-faces="true" data-send="true"></div>
</div>
<br />
<div class="v_desc radius5" align="center"> 
<?php exibirVeiculo($veiculo_resp)?>
<hr />
<?php exibir_dados($loja_resp, $loja->linhas_afetadas,$veiculo_resp->pertencente)?>
</div>
<?php endif;?>
<p align="center">Este veículo se encontra aqui !</p>
<div class="v_desc radius5" align="center"> 
<?php echo $loja_resp->google_map?>
</div>
<div align="center">
	<p title="Aqui você encontrará todos os tipos de veículos."><a href="<?php echo '?desc_l=true&id='.$_GET['d_id']?>">Visualizar mais veículos.</a></p>
</div> 
