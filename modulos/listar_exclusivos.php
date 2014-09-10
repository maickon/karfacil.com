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
	$veiculo = new objVeiculos();
	$nome = antiInject($_POST['buscar']);
	$veiculo->extras_select = " WHERE pertencente='exclusivo' AND nome LIKE '%$nome%' ";
	$veiculo->seleciona_tudo($veiculo);
	?>
	<div align="center">
		<p><?php echo "Resultado da pesquisa por <u>$nome</u>";?></p>
	</div>
	<div class="vitrine" align="center">
		<?php 
			while($resp_veiculo = $veiculo->retorna_dados()): 
				$dono = new usuarioDeVendaCarro();
				$dono->retornarTudoUsuario($resp_veiculo->dono_id);
				$dono_dados = $dono->retorna_dados();
		?>
		<div class="imagem">
		     <div class="bg_imagem">
		       <a href="?desc_ve=true&id=<?php echo $resp_veiculo->id ?>&d_nome=<?php echo $dono_dados->nome ?>&d_id=<?php echo $dono_dados->id?>">
		          <img src="<?php echo IMGLOJASPATH.'exclusivos/'.$resp_veiculo->img_1.'/'.$resp_veiculo->img_1?>" alt="<?php echo $resp_veiculo->nome ?>" width="235" height="150" />
		       </a>
		     </div>
		      <div class="legenda_todo">
		          <div class="legenda"><?php echo $resp_veiculo->nome ?> </div>
		          <div class="legenda">R$ <?php echo $resp_veiculo->preco ?></div>
		          <div class="legenda"><?php echo $resp_veiculo->ano ?></div>
		      </div>  
	    </div>
	   <?php endwhile;?>
	   <?php if(($veiculo->linhas_afetadas == 0)):?>
			<div class="v_desc" align="center">
				<p class="erro">Este veículo não consta em nosso banco de dados!</p>
			</div>				
		<?php endif;?>
</div>	
<?php else:?>
	<?php 
	$veiculo_r = new objVeiculos();
	$veiculo_r->extras_select = " WHERE pertencente='exclusivo' ORDER BY rand()";
	$veiculo_r->seleciona_tudo($veiculo_r);
	?>
	<div align="center">
		<p>Todos os veículos apresentados aqui, pertencem a lista de veículos exclusivos.</p>
	</div>
	<div class="vitrine" align="center">
		<?php 
			while($resp_veiculo_r = $veiculo_r->retorna_dados()): 
				$dono_usu = new usuarioDeVendaCarro();
				$dono_usu->retornarTudoUsuario($resp_veiculo_r->dono_id);
				$resp_dono_usu = $dono_usu->retorna_dados();
		?>
		<div class="imagem">
		     <div class="bg_imagem">
		       <a href="?desc_ve=true&id=<?php echo $resp_veiculo_r->id ?>&d_nome=<?php echo $resp_dono_usu->nome ?>&d_id=<?php echo $resp_dono_usu->id?>">
		          <img src="<?php echo IMGLOJASPATH.'exclusivos/'.$resp_veiculo_r->img_1.'/'.$resp_veiculo_r->img_1?>" alt="<?php echo $resp_veiculo_r->nome ?>" width="235" height="150" />
		       </a>
		     </div>
		      <div class="legenda_todo">
		          <div class="legenda"><?php echo $resp_veiculo_r->nome ?> </div>
		          <div class="legenda">R$ <?php echo $resp_veiculo_r->preco ?></div>
		          <div class="legenda"><?php echo $resp_veiculo_r->ano ?></div>
		      </div>  
	    </div>
	   <?php endwhile;?>
	</div> 
<?php endif;?>	    
	
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
<br />
