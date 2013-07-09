<div align="center">
	<p>Confira todos os veículos cadastrado em nosso sistema.</p>
</div>
<?php 
$veiculos_u = new objVeiculosUsu();
$veiculos_u->extras_select = " ORDER BY rand()";
$veiculos_u->seleciona_tudo($veiculos_u);
?>
<div class="vitrine" align="center">
	<?php 
			while($veiculosu_resp = $veiculos_u->retorna_dados()):
			$dono_usu = new usuarioDeVendaCarro();
			$dono_usu->retornarTudoUsuario($veiculosu_resp->dono_id);
			$resp_dono_usu = $dono_usu->retorna_dados();
	?>
	<div class="imagem">
	     <div class="bg_imagem">
	       <a href="?desc_vu=true&id=<?php echo $veiculosu_resp->id ?>&d_nome=<?php echo $resp_dono_usu->nome ?>&d_id=<?php echo $resp_dono_usu->id?>">
	          <img src="<?php echo IMGLOJASPATH.'exclusivos/'.$veiculosu_resp->img_1.'/'.$veiculosu_resp->img_1?>" alt="<?php echo $veiculosu_resp->nome ?>" width="235" height="150" /></a>
	     </div>
	      <div class="legenda_todo">
	          <div class="legenda"><?php echo $veiculosu_resp->nome ?> </div>
	          <div class="legenda"><?php echo $veiculosu_resp->preco ?></div>
	          <div class="legenda"><?php echo $veiculosu_resp->ano ?></div>
	      </div>  
    </div>
    <?php endwhile;?> 

	<?php 
	$veiculos_l = new objVeiculosLoja();
	$veiculos_l->extras_select = " ORDER BY rand()";
	$veiculos_l->seleciona_tudo($veiculos_l);

	while($veiculosl_resp = $veiculos_l->retorna_dados()):
	$dono_veic = new objLojas();
	$dono_veic->retornarTudoLoja($veiculosl_resp->loja_id);
	$resp_dono_veic = $dono_veic->retorna_dados();
	?>
	<div class="imagem">
     <div class="bg_imagem">
       <a href="?desc_v=true&id=<?php echo $veiculosl_resp->id ?>&l_nome=<?php echo $resp_dono_veic->nome ?>&l_id=<?php echo $resp_dono_veic->id ?>&l_logo=<?php echo $resp_dono_veic->logo ?>">
          <img src="<?php echo IMGLOJASPATH.$resp_dono_veic->nome.'/'.$veiculosl_resp->img_1.'/'.$veiculosl_resp->img_1?>" alt="<?php echo $veiculosl_resp->nome ?>" width="235" height="150" /></a>
     </div>
      <div class="legenda_todo">
          <div class="legenda"><?php echo $veiculosl_resp->nome ?> </div>
          <div class="legenda"><?php echo $veiculosl_resp->preco ?></div>
          <div class="legenda"><?php echo $veiculosl_resp->ano ?></div>
      </div>   
    </div>
  <?php endwhile;?> 
<?php 
if(($veiculos_u->linhas_afetadas < 1) and ($veiculos_l->linhas_afetadas < 1)):
	echo '<div class="aviso">Por enquanto não ha registros relacionado a nome, marca, tipo, ano ou preço com nome de '.$_POST['buscar'].' cadastrado em nosso sistema</div>';
endif;	
?>
</div>    

