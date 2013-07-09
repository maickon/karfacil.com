<div id="bucaGeralForm">
	<form class="buscaGeralForm" method="post" action="?p=listar_exclusivos&busca=true">
			<ul>
				<li>
					<label for="usuario" id="busca_exclusivos">Procurar por..</label> 
					<input type="text" size="30" name="buscar" value="" title="Caso deseje encontrar um carro em particular, pesquise por ele aqui.  "  />
				</li>
				<li class="center"><input type="submit" value="Buscar" />
				</li>
			</ul>
	</form>
</div>
<?php 

if(isset($_GET['busca']) && $_GET['busca'] == TRUE):
	$v_usuario_busca = new objVeiculosUsu();
	$nome = $_POST['buscar'];
	$v_usuario_busca->extras_select = " WHERE nome LIKE '%$nome%'";
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
	    <?php if(($v_usuario_busca->linhas_afetadas == 0)):?>
			<div class="v_desc" align="center">
				<p class="erro">Este veículo não consta em nosso banco de dados!</p>
			</div>	
		<?php endif;?>
<?php else:?>
	<?php 
	$v_usuario = new objVeiculosUsu();
	$v_usuario->extras_select = " ORDER BY rand()";
	$v_usuario->seleciona_tudo($v_usuario);
	?>
	<div align="center">
		<p>Todos os veículos apresentados aqui, pertencem a lista de veículos exclusivos.</p>
	</div>
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
<?php endif;?>	    
</div>