<div align="center">
	<p>Confira todos os ve�culos cadastrado em nosso sistema.</p>
</div>
<?php 
$veiculos = new objVeiculos();
$veiculos->extras_select = " ORDER BY rand()";
$veiculos->seleciona_tudo($veiculos);
?>
<div class="vitrine" align="center">
	<?php 
		while($veiculos_resp = $veiculos->retorna_dados()):
			$dono = new usuarioDeVendaCarro();
			$dono->retornarTudoUsuario($veiculos_resp->dono_id);
			$resp_dono = $dono->retorna_dados();
			
			$loja = new objLojas();
			$loja->retornarTudoLoja($veiculos_resp->dono_id);
          	$loja_dados = $loja->retorna_dados();
	?>
	<div class="imagem">
	     <div class="bg_imagem">
	     <?php if($veiculos_resp->pertencente == 'loja'):?>
	     	<a href="?desc_vl=true&id=<?php echo $veiculos_resp->id ?>&d_nome=<?php echo $loja_dados->nome ?>&d_id=<?php echo $loja_dados->id?>">
	          <img src="<?php echo IMGLOJASPATH.$loja_dados->nome.'/'.$veiculos_resp->img_1.'/'.$veiculos_resp->img_1?>" alt="<?php echo $veiculos_resp->nome ?>" width="235" height="150" />
	        </a>
	     <?php elseif($veiculos_resp->pertencente == 'exclusivo'):?>
	     	<a href="?desc_ve=true&id=<?php echo $veiculos_resp->id ?>&d_nome=<?php echo $resp_dono->nome ?>&d_id=<?php echo $resp_dono->id?>">
	          <img src="<?php echo IMGLOJASPATH.'exclusivos/'.$veiculos_resp->img_1.'/'.$veiculos_resp->img_1?>" alt="<?php echo $veiculos_resp->nome ?>" width="235" height="150" />
	        </a>
	     <?php endif;?>
	     </div>
	      <div class="legenda_todo">
	          <div class="legenda"><?php echo $veiculos_resp->nome ?> </div>
	          <div class="legenda">R$ <?php echo $veiculos_resp->preco ?></div>
	          <div class="legenda"><?php echo $veiculos_resp->ano ?></div>
	      </div>  
    </div>
    <?php endwhile;?> 
<?php 
if(($veiculos->linhas_afetadas < 1)):
	echo '<div class="aviso">Por enquanto n�o ha registros de cadastrado em nosso sistema</div>';
endif;	
?>
</div>    

