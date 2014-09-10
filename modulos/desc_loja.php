<?php
require_once(dirname(dirname(__FILE__))."/funcoes.php");

$loja = new objLojas();
$loja->extras_select = " WHERE id=".antiInject($_GET['id']);
$loja->seleciona_tudo($loja);
$loja_resp = $loja->retorna_dados();
?>

<?php if(!$loja_resp):?>
	<?php printMsg('Loja inexistente.','erro');?>
<?php else:?>
	<div class="v_desc radius5"> 	
		
		<div class="logo" align="center">
		<?php echo '<h1>Visite a '.$loja_resp->nome.'</h1>' ?>
		<a class="faixa" href="#" title=""></a>
	    	<ul>
	        	<li>
	            	<a href="<?php echo $loja_resp->google_link?>" title="Clique nesta logomarca e você poderá ver o seu endereço no google maps.">
	            		<img src="<?php echo IMGLOJASPATH.$loja_resp->nome.'/'.$loja_resp->logo ?>" alt="<?php echo $loja_resp->nome ?> destaque" width="250" height="150" />
	            	</a>
	                <div class="fundo"></div>
	                <p>
	                	<?php echo $loja_resp->nome ?>, Confira nossos carros.
	                </p>            
	            </li>
			</ul>
		</div>
		<!--  google maps aqui --> 
		<br />
		<div> 
			<p><?php exibirloja($loja_resp)?></p>
		</div>
	</div>
<?php endif;?>		   
<?php 
$veiculo = new objVeiculos();
$loja = 'loja';
$veiculo->extras_select = " WHERE pertencente = '".$loja."' AND dono_id=".antiInject($_GET['id']);
$veiculo->seleciona_tudo($veiculo);
?>
<br />
<div class="vitrine" align="center">
	<?php while($resp_veiculo = $veiculo->retorna_dados()):?>
	<div class="imagem">
     <div class="bg_imagem">
       <a href="?desc_vl=true&id=<?php echo $resp_veiculo->id ?>&d_nome=<?php echo $loja_resp->nome ?>&d_id=<?php echo $loja_resp->id?>&d_logo=<?php echo $loja_resp->logo?>">
          <img src="<?php echo IMGLOJASPATH.$loja_resp->nome.'/'.$resp_veiculo->img_1.'/'.$resp_veiculo->img_1?>" alt="<?php echo $resp_veiculo->nome ?>" width="235" height="150" /></a>
     </div>
      <div class="legenda_todo">
          <div class="legenda"><?php echo $resp_veiculo->nome ?> </div>
          <div class="legenda">R$ <?php echo $resp_veiculo->preco ?></div>
          <div class="legenda"><?php echo $resp_veiculo->ano ?></div>
      </div>   
    </div>
    <?php endwhile;?> 
</div>
           	          