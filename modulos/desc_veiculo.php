<?php
require_once(dirname(dirname(__FILE__))."/funcoes.php");
$veiculo = new objVeiculos();
$veiculo->extras_select = " WHERE id=".antiInject($_GET['id']);
$veiculo->seleciona_tudo($veiculo);
$veiculo_resp = $veiculo->retorna_dados();

$loja = new objLojas();
$loja->extras_select = " WHERE id=".$veiculo_resp->dono_id;
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
	            	<a href="#" id="zoom_01" title="<?php echo $veiculo_resp->nome?> destaque"><img src="<?php echo IMGLOJASPATH.$_GET['d_nome'].'/'.$veiculo_resp->img_1.'/'.$veiculo_resp->img_1 ?>" data-zoom-image="<?php echo IMGLOJASPATH.$_GET['d_nome'].'/'.$veiculo_resp->img_1.'/'.$veiculo_resp->img_1 ?>" alt="<?php echo $veiculo_resp->nome?> destaque" /></a>
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
<div class="v_desc radius5" align="center"> 
<?php exibirVeiculo($veiculo_resp)?>
<hr />
<p>Para mais detalhes do veículo entre em contato com a <?php echo $loja_resp->nome?> pelo telefone:
 <?php echo $loja_resp->telefone_cel?>/<?php echo $loja_resp->telefone_res?>
 ou E-mail <?php echo $loja_resp->email?></p>
 <p>Ou visite</p>

 <div class="mapa" align="center">
        <?php $cidade = $loja_resp->cidade.' '.$loja_resp->estado.' bairro '.$loja_resp->bairro.' cep '.$loja_resp->cep.' numero '.$loja_resp->numero ?>
		<iframe width="580" height="150" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" 
		src="https://maps.google.com.br/maps?f=q&amp;source=s_q&amp;hl=pt-BR&amp;geocode=&amp;q=<?php echo $cidade ?>&amp;aq=3&amp;oq=<?php echo $cidade ?>&amp;sll=-21.633466,-41.048953&amp;sspn=0.668915,1.352692&amp;g=S%C3%A3o+Jo%C3%A3o+da+Barra+-+Rio+de+Janeiro&amp;ie=UTF8&amp;hq=<?php echo $cidade ?>&amp;t=m&amp;z=16&amp;iwloc=A&amp;output=embed"></iframe>
		<br />
		<small>
		<a href="https://maps.google.com.br/maps?f=q&amp;source=embed&amp;hl=pt-BR&amp;geocode=&amp;q=<?php echo $cidade ?>&amp;aq=3&amp;oq=<?php echo $cidade ?>&amp;sll=-21.633466,-41.048953&amp;sspn=0.668915,1.352692&amp;g=S%C3%A3o+Jo%C3%A3o+da+Barra+-+Rio+de+Janeiro&amp;ie=UTF8&amp;hq=<?php echo $cidade ?>&amp;hnear=<?php echo $cidade ?>&amp;t=m&amp;z=16&amp;iwloc=A" style="color:#0000FF;text-align:left">Exibir mapa ampliado</a></small>
 </div>
 <p>Cidade <?php echo $loja_resp->cidade ?>, bairro <?php echo $loja_resp->bairro?>
 , número <?php echo $loja_resp->numero?>, cep <?php echo $loja_resp->cep?> e estado <?php echo $loja_resp->estado?></p>
 <hr />
 <p class="aviso">Todas as informações presentes aqui são de inteira responsabilidade 
 de nossa loja filiada <?php echo $loja_resp->nome?> declarada por contrato.</p>
</div>

<?php endif;?>

<div align="center">
	<p><a href="<?php echo '?desc_l=true&id='.antiInject($loja_resp->id)?>">Visualizar mais veículos.</a></p>
</div> 


<br />
<br />
<br />
<br />
<br />
<br />