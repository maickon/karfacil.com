<?php
require_once(dirname(dirname(__FILE__))."/funcoes.php");
$veiculo = new objVeiculosLoja();
$veiculo->extras_select = " WHERE id=".$_GET['id'];
$veiculo->seleciona_tudo($veiculo);
$veiculo_resp = $veiculo->retorna_dados();

$loja = new objLojas();
$loja->extras_select = " WHERE id=".$_GET['l_id'];
$loja->seleciona_tudo($loja);
$loja_resp = $loja->retorna_dados();

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
	            	<a href="#" id="zoom_01" title="<?php echo $veiculo_resp->nome?> destaque"><img src="<?php echo IMGLOJASPATH.$_GET['l_nome'].'/'.$veiculo_resp->img_1.'/'.$veiculo_resp->img_1 ?>" data-zoom-image="<?php echo IMGLOJASPATH.$_GET['l_nome'].'/'.$veiculo_resp->img_1.'/'.$veiculo_resp->img_1 ?>" alt="<?php echo $veiculo_resp->nome?> destaque" /></a>
	                <div class="fundo"></div>
	                <p><a href="#" title="<?php echo $veiculo_resp->nome?> destaque"><?php echo $veiculo_resp->nome?></a></p>            
	            </li>
	            
	            <li>
	            	<a href="#" title="<?php echo $veiculo_resp->nome?> destaque"><img src="<?php echo IMGLOJASPATH.$_GET['l_nome'].'/'.$veiculo_resp->img_1.'/'.$veiculo_resp->img_2 ?>" alt="<?php echo $veiculo_resp->nome?> destaque" /></a>
	                <div class="fundo"></div>
	                <p><a href="#" title="<?php echo $veiculo_resp->nome?> destaque"><?php echo $veiculo_resp->nome?></a></p>            
	            </li>
	            
	            <li>
	            	<a href="#" title="<?php echo $veiculo_resp->nome?> destaque"><img src="<?php echo IMGLOJASPATH.$_GET['l_nome'].'/'.$veiculo_resp->img_1.'/'.$veiculo_resp->img_3 ?>" alt="<?php echo $veiculo_resp->nome?> destaque" /></a>
	                <div class="fundo"></div>
	                <p><a href="#" title="<?php echo $veiculo_resp->nome?> destaque"><?php echo $veiculo_resp->nome?></a></p>            
	            </li>
	            
	            <li>
	            	<a href="#" title="<?php echo $veiculo_resp->nome?> destaque"><img src="<?php echo IMGLOJASPATH.$_GET['l_nome'].'/'.$veiculo_resp->img_1.'/'.$veiculo_resp->img_4 ?>" alt="<?php echo $veiculo_resp->nome?> destaque" /></a>
	                <div class="fundo"></div>
	                <p><a href="#" title="<?php echo $veiculo_resp->nome?> destaque"><?php echo $veiculo_resp->nome?></a></p>            
	            </li>
	            
	        </ul>	
	</div>
</div>
<div class="v_desc radius5" align="center"> 
<?php exibirVeiculo($veiculo_resp)?>
<hr />
<p>Para mais detalhes do ve�culo entre em contato com a <?php echo $loja_resp->nome?> pelo telefone:
 <?php echo $loja_resp->telefone_cel?>/<?php echo $loja_resp->telefone_res?>
 ou E-mail <?php echo $loja_resp->email?></p>
 <p>Ou visite</p>
 <p>Cidade <?php echo $loja_resp->cidade ?>, bairro <?php echo $loja_resp->bairro?>
 , n�mero <?php echo $loja_resp->numero?>, cep <?php echo $loja_resp->cep?> e estado <?php echo $loja_resp->estado?></p>
 <hr />
 <p class="aviso">Todas as informa��es presentes aqui s�o de inteira responsabilidade 
 de nossa loja filiada <?php echo $loja_resp->nome?> declarada por contrato.</p>
</div>

<?php endif;?>

<div align="center">
	<p><a href="<?php echo '?desc_l=true&id='.$_GET['l_id']?>">Visualizar mais ve�culos.</a></p>
</div> 
