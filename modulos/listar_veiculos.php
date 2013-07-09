<div id="bucaGeralForm">
	<form class="buscaGeralForm" method="post" action="?p=listar_veiculos&categoria=<?php echo $_GET['categoria']?>&busca=true">
			<ul>
				<li>
					<label for="usuario" id="busca_lojas">Procurar por..</label> 
					<input type="text" size="30" name="buscar" value="" title="Digite o nome de um veículo em particular e clique em buscar para pesquisa-lo.  "  />
				</li>
				<li class="center"><input type="submit" value="Buscar" />
				</li>
			</ul>
	</form>
</div>

<?php if(isset($_GET['busca']) && $_GET['busca'] == TRUE):?>
	
	<?php 
	$v_usuario_busca = new objVeiculosUsu();
	$nome = $_POST['buscar'];
	$v_usuario_busca->extras_select = "WHERE categoria='".$_GET['categoria']."' AND nome LIKE '%$nome%'";
	$v_usuario_busca->seleciona_tudo($v_usuario_busca);
	?>
	<div align="center">
		<p><?php echo "Resultado da pesquisa por <u>$nome</u>";?></p>
	</div>
	<div class="vitrine" align="center">
		<?php 
				while($respv_usuario_busca = $v_usuario_busca->retorna_dados()): 
				$dono_usu_busca = new usuarioDeVendaCarro();
				$dono_usu_busca->retornarTudoUsuario($respv_usuario_busca->dono_id);
				$resp_dono_usu_busca = $dono_usu_busca->retorna_dados();
		?>
		<div class="imagem">
		     <div class="bg_imagem">
		       <a href="?desc_vu=true&id=<?php echo $respv_usuario_busca->id ?>&d_nome=<?php echo $resp_dono_usu_busca->nome ?>&d_id=<?php echo $resp_dono_usu_busca->id?>">
		          <img src="<?php echo IMGLOJASPATH.'exclusivos/'.$respv_usuario_busca->img_1.'/'.$respv_usuario_busca->img_1?>" alt="<?php echo $respv_usuario_busca->nome ?>" width="235" height="150" /></a>
		     </div>
		      <div class="legenda_todo">
		          <div class="legenda"><?php echo $respv_usuario_busca->nome ?> </div>
		          <div class="legenda"><?php echo $respv_usuario_busca->preco ?></div>
		          <div class="legenda"><?php echo $respv_usuario_busca->ano ?></div>
		      </div>  
	    </div>
	    <?php endwhile;?> 
	
		<?php 
		$loja_v_busca = new objVeiculosLoja();
		$loja_v_busca->extras_select = "WHERE categoria='".$_GET['categoria']."' AND nome LIKE '%$nome%'";
		$loja_v_busca->seleciona_tudo($loja_v_busca);
	
		while($lojav_resp_busca = $loja_v_busca->retorna_dados()):
		$dono_veic_busca = new objLojas();
		$dono_veic_busca->retornarTudoLoja($lojav_resp_busca->loja_id);
		$resp_dono_veic_busca = $dono_veic_busca->retorna_dados();
		?>
		<div class="imagem">
	     <div class="bg_imagem">
	       <a href="?desc_v=true&id=<?php echo $lojav_resp_busca->id ?>&l_nome=<?php echo $resp_dono_veic_busca->nome ?>&l_id=<?php echo $resp_dono_veic_busca->id ?>&l_logo=<?php echo $resp_dono_veic_busca->logo ?>">
	          <img src="<?php echo IMGLOJASPATH.$resp_dono_veic_busca->nome.'/'.$lojav_resp_busca->img_1.'/'.$lojav_resp_busca->img_1?>" alt="<?php echo $lojav_resp_busca->nome ?>" width="235" height="150" /></a>
	     </div>
	      <div class="legenda_todo">
	          <div class="legenda"><?php echo $lojav_resp_busca->nome ?> </div>
	          <div class="legenda"><?php echo $lojav_resp_busca->preco ?></div>
	          <div class="legenda"><?php echo $lojav_resp_busca->ano ?></div>
	      </div>   
	    </div>
	<?php endwhile;?> 
	<?php if(($v_usuario_busca->linhas_afetadas == 0) and ($loja_v_busca->linhas_afetadas == 0)):?>
		<div class="v_desc" align="center">
			<p class="erro">Este veículo não consta em nosso banco de dados!</p>
		</div>	
	<?php endif;?>

<?php else:?>

	<div align="center">
		<p><?php echo entitular_lista($_GET['categoria']);?></p>
	</div>
	
	<?php 
	$v_usuario = new objVeiculosUsu();
	$v_usuario->extras_select = "WHERE categoria='".$_GET['categoria']."' ORDER BY rand()";
	$v_usuario->seleciona_tudo($v_usuario);
	?>
	<div class="vitrine" align="center">
		<?php 
				while($respv_usuario = $v_usuario->retorna_dados()): 
				$dono_usu = new usuarioDeVendaCarro();
				$dono_usu->retornarTudoUsuario($respv_usuario->dono_id);
				$resp_dono_usu = $dono_usu->retorna_dados();
		?>
		<div class="imagem">
		     <div class="bg_imagem">
		       <a href="?desc_vu=true&id=<?php echo $respv_usuario->id ?>&d_nome=<?php echo $resp_dono_usu->nome ?>&d_id=<?php echo $resp_dono_usu->id?>">
		          <img src="<?php echo IMGLOJASPATH.'exclusivos/'.$respv_usuario->img_1.'/'.$respv_usuario->img_1?>" alt="<?php echo $respv_usuario->nome ?>" width="235" height="150" /></a>
		     </div>
		      <div class="legenda_todo">
		          <div class="legenda"><?php echo $respv_usuario->nome ?> </div>
		          <div class="legenda"><?php echo $respv_usuario->preco ?></div>
		          <div class="legenda"><?php echo $respv_usuario->ano ?></div>
		      </div>  
	    </div>
	    <?php endwhile;?> 
	
		<?php 
		$loja_v = new objVeiculosLoja();
		$loja_v->extras_select = "WHERE categoria='".$_GET['categoria']."' ORDER BY rand()";
		$loja_v->seleciona_tudo($loja_v);
	
		while($lojav_resp = $loja_v->retorna_dados()):
		$dono_veic = new objLojas();
		$dono_veic->retornarTudoLoja($lojav_resp->loja_id);
		$resp_dono_veic = $dono_veic->retorna_dados();
		?>
		<div class="imagem">
	     <div class="bg_imagem">
	       <a href="?desc_v=true&id=<?php echo $lojav_resp->id ?>&l_nome=<?php echo $resp_dono_veic->nome ?>&l_id=<?php echo $resp_dono_veic->id ?>&l_logo=<?php echo $resp_dono_veic->logo ?>">
	          <img src="<?php echo IMGLOJASPATH.$resp_dono_veic->nome.'/'.$lojav_resp->img_1.'/'.$lojav_resp->img_1?>" alt="<?php echo $lojav_resp->nome ?>" width="235" height="150" /></a>
	     </div>
	      <div class="legenda_todo">
	          <div class="legenda"><?php echo $lojav_resp->nome ?> </div>
	          <div class="legenda"><?php echo $lojav_resp->preco ?></div>
	          <div class="legenda"><?php echo $lojav_resp->ano ?></div>
	      </div>   
	    </div>
	  <?php endwhile;?> 
	<?php 
	if(($v_usuario->linhas_afetadas == 0) and ($loja_v->linhas_afetadas == 0)):
		echo '<div class="aviso">Por enquanto não ha registros da categoria '.$_GET['categoria'].' cadastrado em nosso sistema</div>';
	endif;	
	?>
<?php endif;?>
</div>    
