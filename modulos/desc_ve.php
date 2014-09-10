<?php 
require_once(dirname(dirname(__FILE__))."/funcoes.php");

$veiculo = new objVeiculos();
$veiculo->extras_select = "WHERE id=".antiInject($_GET['id']);
$veiculo->seleciona_tudo($veiculo);
$veiculo_resp = $veiculo->retorna_dados();

$dono = new usuarioDeVendaCarro();
$dono->extras_select = "WHERE id=".antiInject($_GET['d_id']);
$dono->seleciona_tudo($dono);
$dono_resp = $dono->retorna_dados();

if($veiculo->linhas_afetadas == 0):
?>

<div class="v_desc" align="center">
	<p class="erro">Este ve�culo n�o consta em nosso banco de dados!</p>
</div>

<?php else:?>

<div align="center">
	<p>Para visualizar o ve�culo com mais cautela deixe o cursor do mouse sobre a imagem que ela ficar� est�tica. 
	Para visualizar outras imagens basta dar um clique sobre um dos �ndices indexados por n�meros na parte superior a direita. </p>
</div>

<div class="slide"> 
	<div id="destaques" align="center">
		<a class="faixa" href="#" title=""></a>
	    	<ul>
	        	<li>
	            	<a href="#" title="<?php echo $veiculo_resp->nome?> destaque"><img src="<?php echo IMGEXCLUSIVOSPATH.$veiculo_resp->img_1.'/'.$veiculo_resp->img_1 ?>" alt="<?php echo $veiculo_resp->nome?> destaque" /></a>
	                <div class="fundo"></div>
	                <p><a href="#" title="<?php echo $veiculo_resp->nome?> destaque"><?php echo $veiculo_resp->nome?></a></p>            
	            </li>
	            
	            <li>
	            	<a href="#" title="<?php echo $veiculo_resp->nome?> destaque"><img src="<?php echo IMGEXCLUSIVOSPATH.$veiculo_resp->img_1.'/'.$veiculo_resp->img_2 ?>" alt="<?php echo $veiculo_resp->nome?> destaque" /></a>
	                <div class="fundo"></div>
	                <p><a href="#" title="<?php echo $veiculo_resp->nome?> destaque"><?php echo $veiculo_resp->nome?></a></p>            
	            </li>
	            
	            <li>
	            	<a href="#" title="<?php echo $veiculo_resp->nome?> destaque"><img src="<?php echo IMGEXCLUSIVOSPATH.$veiculo_resp->img_1.'/'.$veiculo_resp->img_3 ?>" alt="<?php echo $veiculo_resp->nome?> destaque" /></a>
	                <div class="fundo"></div>
	                <p><a href="#" title="<?php echo $veiculo_resp->nome?> destaque"><?php echo $veiculo_resp->nome?></a></p>            
	            </li>
	            
	            <li>
	            	<a href="#" title="<?php echo $veiculo_resp->nome?> destaque"><img src="<?php echo IMGEXCLUSIVOSPATH.$veiculo_resp->img_1.'/'.$veiculo_resp->img_4 ?>" alt="<?php echo $veiculo_resp->nome?> destaque" /></a>
	                <div class="fundo"></div>
	                <p><a href="#" title="<?php echo $veiculo_resp->nome?> destaque"><?php echo $veiculo_resp->nome?></a></p>            
	            </li>
	            
	        </ul>	
	</div>
</div>
<div class="slide"> 
	<div class="fb-like" data-href="<?php echo ''//KARFACIL.COM?>" data-send="true" data-width="450" data-show-faces="true">
	</div>
</div>

<div class="v_desc radius5" align="center"> 
<?php exibirVeiculoUsu($veiculo_resp)?>
<hr />
<?php exibir_dados($dono_resp,$dono->linhas_afetadas,$veiculo_resp->pertencente)?>
</div>
<?php endif;?>

<div align="center">
	<p title="Aqui voc� encontrar� todos os tipos de ve�culos."><a href="<?php echo '?p=listar_veiculos&categoria=carros'?>">Visualizar outros ve�culos.</a> 
	ou
	<a title="Aqui voc� encontrar� apenas a lista de ve�culos que pertencem a pessoas f�sicas." href="<?php echo '?p=listar_exclusivos'?>">Visualizar ve�culos exclusivos.</a>	
	</p>
</div> 

