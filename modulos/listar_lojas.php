<div id="bucaGeralForm">
	<form class="buscaGeralForm" method="post" action="?p=listar_lojas&busca=true">
			<ul>
				<li>
					<label for="usuario" id="busca_lojas">Procurar loja..</label> 
					<input type="text" size="30" name="buscar" value="" title="Caso deseje encontrar uma loja em particular, pesquise por ela aqui.  "  />
				</li>
				<li class="center"><input type="submit" value="Buscar" />
				</li>
			</ul>
	</form>
</div>
<?php
require_once(dirname(dirname(__FILE__))."/funcoes.php");
// echo basename(__FILE__); retorna o nome do arquivo

if(isset($_GET['busca']) && $_GET['busca'] == TRUE):
	$lojas = new objLojas();
	$nome = antiInject($_POST['buscar']);
	$lojas->extras_select = " WHERE nome LIKE '%$nome%'";
	$lojas->seleciona_tudo($lojas);
	?>
	<div align="center">Resultado da pesquisa por <?php echo $_POST['buscar']?> </div>
	<div class="vitrine" align="center">
		<?php while($lojas_resp = $lojas->retorna_dados()):?>
		<div class="imagem">
	     <div class="bg_imagem">
	       <a href="?desc_l&id=<?php echo $lojas_resp->id ?>">
	          <img src="<?php echo IMGLOJASPATH.$lojas_resp->nome.'/'.$lojas_resp->loja_foto?>" alt="<?php echo $lojas_resp->nome ?>" width="235" height="150" /></a>
	     </div>
	      <div class="legenda_todo">
	          <div class="legenda"><?php echo $lojas_resp->nome ?> </div>
	      </div>   
	    </div>
	    <?php endwhile;?> 
	    <?php if(($lojas->linhas_afetadas == 0)):?>
			<div class="v_desc" align="center">
				<p class="erro">Esta loja não consta em nosso banco de dados!</p>
			</div>	
		<?php endif;?>
	</div>
	<?php 
else:
	
	$lojas = new objLojas();
	$lojas->seleciona_tudo($lojas);
	?>
	<div align="center">Todas estas lojas estão ampliando o seu reconhecimento filiando-se a Karfacil.com</div>
	<div class="vitrine" align="center">
		<?php while($lojas_resp = $lojas->retorna_dados()):?>
		<div class="imagem">
	     <div class="bg_imagem">
	       <a href="?desc_l&id=<?php echo $lojas_resp->id ?>">
	          <img src="<?php echo IMGLOJASPATH.$lojas_resp->nome.'/'.$lojas_resp->loja_foto?>" alt="<?php echo $lojas_resp->nome ?>" width="235" height="150" /></a>
	     </div>
	      <div class="legenda_todo">
	          <div class="legenda"><?php echo $lojas_resp->nome ?> </div>
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