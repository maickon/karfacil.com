	<div id="bucaGeralForm">
		<form class="buscaGeralForm" method="post" action="?p=listar_propagandas&busca=true">
				<ul>
					<li class="input_prop">
						<label>Loja..</label> 
						<input type="text" name="buscar" value="" title="Caso deseje encontrar uma loja em particular, pesquise por ela aqui.  "  />
					</li>
					<li class="select_prop"><label>Tipo:</label> 
						<select name="tipo" title="Escolha aqui o tipo de estabelecimento. ">
									<option value=""></option>
									<option value="autoescola">Autoescola</option>
									<option value="borracharia">Borracharia</option>
									<option value="autopecas">Autopeças</option>
									<option value="som">Som</option>
									<option value="concerto">Concerto</option>
									<option value="equipamento">Equipamento</option>
									<option value="insufilme">Insufilme</option>
									<option value="posto">Posto</option>
									<option value="ferrovelho">Ferro velho</option>
									<option value="ferrovelho">Táxi</option>
									<option value="variado">variado</option>
						</select></li>
					<li class="submit_prop"><input type="submit" value="Buscar" />
					</li>
				</ul>
		</form>
	</div>
<?php
require_once(dirname(dirname(__FILE__))."/funcoes.php");
// echo basename(__FILE__); retorna o nome do arquivo

if(isset($_GET['busca']) && $_GET['busca'] == TRUE):
	$nome = $_POST['buscar'];
	$tipo = $_POST['tipo'];
	$propagandas_busca = new objPropagandas();
	$propagandas_busca->extras_select = " WHERE nome LIKE '%$nome%'";
	
	if(!empty($tipo)):
		$propagandas_busca->extras_select .= " AND tipo = '$tipo'";
	endif;
	$propagandas_busca->seleciona_tudo($propagandas_busca);
	?>
	<?php if(!empty($_POST['buscar']) && !empty($_POST['tipo'])):?>
		<div align="center">Resultado da pesquisa por <?php echo $_POST['buscar']?> do tipo <?php echo $_POST['tipo']?> </div>
	<?php else:?>
		<?php if(!empty($_POST['buscar'])):?>
			<div align="center">Resultado da pesquisa por  <?php echo $_POST['buscar']?> </div>
			<?php else:?>
				<?php if(!empty($_POST['tipo'])):?>	
					<div align="center">Resultado da pesquisa por <?php echo $_POST['tipo']?> </div>
				<?php endif;?>
		<?php endif;?>				
	<?php endif;?>
	<?php if($propagandas_busca->linhas_afetadas == 0):?>
			<div class="v_desc" align="center">
				<p class="erro">Esta loja não consta em nosso banco de dados!</p>
			</div>
		<?php 
			unset($_POST);
			unset($_POST);
		?>	
	<?php endif;?> 
	<div class="vitrine" align="center">
		<?php while($propagandas_r = $propagandas_busca->retorna_dados()):?>
		<div class="imagem">
		<?php 
			if($propagandas_r->propaganda_completa == 's'):?>
			     <div class="bg_imagem">
			       <a href="?desc_p&id=<?php echo $propagandas_r->id ?>">
			          <img src="<?php echo IMGPROPAGANDASPATH.$propagandas_r->nome.'/'.$propagandas_r->logo?>" alt="<?php echo $propagandas_r->nome ?>" width="235" height="150" /></a>
			     </div>
	     <?php 
	     	else:
	     		if($propagandas_r->propaganda_completa == 'n'):
	     ?>
			     <div >
			     	  <img src="<?php echo IMGPROPAGANDASPATH.$propagandas_r->nome.'/'.$propagandas_r->logo?>" alt="<?php echo $propagandas_r->nome ?>" width="235" height="150" />
			     </div>
	     <?php
		     	else:
		     		echo "<div class='erro'>Atributo não definido.</div>";
		     	endif;	
	     	endif;
	     ?>     
	     
	      <div class="legenda_todo">
	          <div class="legenda"><?php echo $propagandas_r->nome ?> </div>
	      </div>   
	    </div>
	    <?php endwhile;?> 
	</div>	    

<?php else:?>
	
	<?php 
	$propagandas = new objPropagandas();
	$propagandas->seleciona_tudo($propagandas);
	?>
	<div align="center">Todas estas lojas estão ampliando o seu reconhecimento filiando-se a Karfacil.com</div>
	<div class="vitrine" align="center">
		<?php while($propagandas_r = $propagandas->retorna_dados()):?>
		<div class="imagem">
	     
		<?php 
			if($propagandas_r->propaganda_completa == 's'):?>
			     <div class="bg_imagem">
			       <a href="?desc_p&id=<?php echo $propagandas_r->id ?>">
			          <img src="<?php echo IMGPROPAGANDASPATH.$propagandas_r->nome.'/'.$propagandas_r->logo?>" alt="<?php echo $propagandas_r->nome ?>" width="235" height="150" /></a>
			     </div>
	     <?php 
	     	else:
	     		if($propagandas_r->propaganda_completa == 'n'):
	     ?>
			     <div >
			     	  <img src="<?php echo IMGPROPAGANDASPATH.$propagandas_r->nome.'/'.$propagandas_r->logo?>" alt="<?php echo $propagandas_r->nome ?>" width="235" height="150" />
			     </div>
	     <?php
		     	else:
		     		echo "<div class='erro'>Atributo não definido.</div>";
		     	endif;	
	     	endif;
	     ?>     
	     
	      <div class="legenda_todo">
	          <div class="legenda"><?php echo $propagandas_r->nome ?> </div>
	      </div>   
	    </div>
	    <?php endwhile;?> 
	</div>
<?php endif;?>	    