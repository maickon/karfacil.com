<?php
require_once(dirname(dirname(__FILE__))."/funcoes.php");
// echo basename(__FILE__); retorna o nome do arquivo

	$parceiros = new parceiros();
	$parceiros->seleciona_tudo($parceiros);
	?>
	<div align="center">Venha conhecer os nossos parceiros.</div>
	<div class="vitrine" align="center">
		<?php while($parceiros_resp = $parceiros->retorna_dados()):?>
		<div class="imagem">
	     <div class="bg_imagem">
	       <a href="<?php echo $parceiros_resp->link ?>" >
	          <img src="<?php echo IMGPARCEIROSPATH.$parceiros_resp->nome.'/'.$parceiros_resp->img ?>" alt="<?php echo $parceiros_resp->descricao ?>" title="<?php echo strip_tags($parceiros_resp->descricao) ?>" width="235" height="150" />
           </a>
          
	     </div>
	      <div class="legenda_todo">
	          <div class="legenda"><?php echo $parceiros_resp->nome ?> </div>
	      </div>   
	    </div>
	    <?php endwhile;?> 
	</div>	 
     

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