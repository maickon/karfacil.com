<?php 
require_once(dirname(dirname(__FILE__))."/funcoes.php");

$veiculo = new objVeiculos();
$veiculo->extras_select = " WHERE id=".antiInject($_GET['id']);
$veiculo->seleciona_tudo($veiculo);
$veiculo_resp = $veiculo->retorna_dados();

$dono = new usuarioDeVendaCarro();
$dono->extras_select = " WHERE id=".$veiculo_resp->dono_id;
$dono->seleciona_tudo($dono);
$dono_resp = $dono->retorna_dados();

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
		<div class="fb-like" data-href="<?php echo KARFACIL.COM?>" data-send="true" data-width="450" data-show-faces="true">
		</div>
	</div>
	
	<div class="v_desc radius5" align="center"> 
	<?php exibirVeiculoUsu($veiculo_resp)?>
	<hr />
	<p>Para mais detalhes do veículo entre em contato com a <?php echo $dono_resp->nome?> hoje pelo telefone:
	 <?php echo $dono_resp->telefone?> ou E-mail <?php echo $dono_resp->email?></p>
	 <p>Anuncio válido até <?php echo $dono_resp->validade ?></p>
	<hr />
	 <p class="aviso">Todas as informações presentes aqui são de inteira responsabilidade 
	 do usuário(a) <?php echo $dono_resp->nome?> declarada por contrato.</p>
	</div>
<?php endif;?>

<div align="center">
	<p><a href="<?php echo '?p=listar_veiculos&categoria=carros'?>">Visualizar outros veículos.</a> 
	ou
	<a href="<?php echo '?p=listar_exclusivos'?>">Visualizar veículos exclusivos.</a>	
	</p>
</div> 


<br />
<br />
<br />
<br />
<br />
<br />