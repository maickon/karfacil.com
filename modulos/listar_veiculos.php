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
<?php //require_once 'modulos/paginacao_conf.php';?>
<?php if(isset($_GET['busca']) && $_GET['busca'] == TRUE):?>
	
	<?php 
	$v_busca = new objVeiculos();
	$nome = antiInject($_POST['buscar']);
	$v_busca->extras_select = "WHERE categoria='".antiInject($_GET['categoria'])."' AND nome LIKE '%$nome%'";
	$v_busca->seleciona_tudo($v_busca);
	
	$sql_conta = $v_busca->seleciona_tudo($v_busca);
	$quantreg = mysql_num_rows($sql_conta);
	
	//include 'modulos/paginacao.php';
	?>
	<div align="center">
		<p><?php echo "Resultado da pesquisa por <u>$nome</u>";?></p>
	</div>
	<div class="vitrine" align="center">
		<?php 
			while($respv_busca = $v_busca->retorna_dados()): 
				
				$dono_usu_busca = new usuarioDeVendaCarro();
				$dono_usu_busca->retornarTudoUsuario($respv_busca->dono_id);
				$resp_dono_busca = $dono_usu_busca->retorna_dados();
				
				
				$loja = new objLojas();
				$loja->retornarTudoLoja($respv_busca->dono_id);
          		$loja_dados = $loja->retorna_dados();
		?>
		<div class="imagem">
		     <div class="bg_imagem">
		     <?php if($respv_busca->pertencente == 'loja'):?>
		     			<a href="?desc_vl=true&id=<?php echo $respv_busca->id ?>&d_nome=<?php echo $loja_dados->nome ?>&d_id=<?php echo $loja_dados->id?>">
		       				<img src="<?php echo IMGLOJASPATH.$loja_dados->nome.'/'.$respv_busca->img_1.'/'.$respv_busca->img_1?>" alt="<?php echo $respv_busca->nome ?>" width="235" height="150" />
		       			</a> 	      		     			
		     <?php elseif($respv_busca->pertencente == 'exclusivo'):?>		     	
		       			<a href="?desc_ve=true&id=<?php echo $respv_busca->id ?>&d_nome=<?php echo $resp_dono_busca->nome ?>&d_id=<?php echo $resp_dono_busca->id?>">
		          			<img src="<?php echo IMGLOJASPATH.'exclusivos/'.$respv_busca->img_1.'/'.$respv_busca->img_1?>" alt="<?php echo $respv_busca->nome ?>" width="235" height="150" />
		          		</a>
		     <?php endif;?>
		     </div>
		      <div class="legenda_todo">
		          <div class="legenda"><?php echo $respv_busca->nome ?> </div>
		          <div class="legenda">R$ <?php echo $respv_busca->preco ?></div>
		          <div class="legenda"><?php echo $respv_busca->ano ?></div>
		      </div>  
	    </div>
	    <?php endwhile;?> 
	
	<?php if(($v_busca->linhas_afetadas == 0)):?>
		<div class="v_desc" align="center">
			<p class="erro">Este veículo não consta em nosso banco de dados!</p>
		</div>	
	<?php endif;?>

<?php else:?>

	<div align="center">
		<p><?php echo entitular_lista($_GET['categoria']);?></p>
	</div>
	
	<?php 
	$veiculo = new objVeiculos();
	$veiculo->extras_select = "WHERE categoria='".antiInject($_GET['categoria'])."' ORDER BY rand() ";
	$veiculo->seleciona_tudo($veiculo);
	
	$sql_conta = $veiculo->seleciona_tudo($veiculo);
	$quantreg = mysql_num_rows($sql_conta);
	
	//include 'modulos/paginacao.php';
	?>
	<div class="vitrine" align="center">
		<?php 
			while($resp_v = $veiculo->retorna_dados()): 
				
				$dono = new usuarioDeVendaCarro();
				$dono->retornarTudoUsuario($resp_v->dono_id);
				$resp_dono = $dono->retorna_dados();
				
				$loja = new objLojas();
				$loja->retornarTudoLoja($resp_v->dono_id);
          		$loja_dados = $loja->retorna_dados();
				
		?>
		<div class="imagem">
		     <div class="bg_imagem">
		     <?php if($resp_v->pertencente == 'loja'):?>
		     			<a href="?desc_vl=true&id=<?php echo $resp_v->id ?>&d_nome=<?php echo $loja_dados->nome ?>&d_id=<?php echo $loja_dados->id?>">
		       			<img src="<?php echo IMGLOJASPATH.$loja_dados->nome.'/'.$resp_v->img_1.'/'.$resp_v->img_1?>" alt="<?php echo $resp_v->nome ?>" width="235" height="150" /></a> 	      
		     			
		     <?php elseif($resp_v->pertencente == 'exclusivo'):?>
		     			<a href="?desc_ve=true&id=<?php echo $resp_v->id ?>&d_nome=<?php echo $resp_dono->nome ?>&d_id=<?php echo $resp_dono->id?>">
		       			<img src="<?php echo IMGLOJASPATH.'exclusivos/'.$resp_v->img_1.'/'.$resp_v->img_1?>" alt="<?php echo $resp_v->nome ?>" width="235" height="150" /></a> 	      
		     			
		     <?php endif;?>
		      </div>
		      <div class="legenda_todo">
		          <div class="legenda"><?php echo $resp_v->nome ?> </div>
		          <div class="legenda">R$ <?php echo $resp_v->preco ?></div>
		          <div class="legenda"><?php echo $resp_v->ano ?></div>
		      </div>  
	    </div>
	    <?php endwhile;?> 
	<?php 
	if(($veiculo->linhas_afetadas == 0)):
		echo '<div class="aviso">Por enquanto não ha registros da categoria '.$_GET['categoria'].' cadastrado em nosso sistema</div>';
	endif;	
	?>
<?php endif;?>
</div> 

<br />
<br />
<br />
<br />
<br />
<br />   
