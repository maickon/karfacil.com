<?php 
loadCss('slide');
$site = new img_site();
$site->seleciona_tudo($site);
?>
<h1 align="center">Sejam bem vindo !</h1>

<?php 
	$site_desc = new img_site();
	$site_desc->extras_select = " WHERE id=1";
	$site_desc->seleciona_tudo($site_desc);
	$site_resp = $site_desc->retorna_dados();
?>	
<div class="h_desc" align="center">
<p>Karfacil.com � o seu novo lugar de pesquisa de ve�culos e servi�os automotivos da regi�o, 
de forma r�pida, pr�tica e precisa voc� encontrar� tudo o que precisa sem sair de casa.</p>
<hr />
<div class="slide">
	<div id="destaques">
		<a class="faixa" href="#" title=""></a>
	    	<ul>
	    	<?php while($site_resp = $site->retorna_dados()): ?>	
	        	<li>
	            	<a href="#" title="<?php echo $site_resp->nome ?>">
	            		<img src="<?php echo IMGKARFACILPATH.$site_resp->slide ?>" alt="<?php echo $site_resp->nome ?>" />
	            	</a>
	                <div class="fundo"></div>
	                <p>
	                	<a href="#" title="<?php echo $site_resp->nome ?>">
	                		<?php echo $site_resp->descricao_1 ?>
	                	</a>
	                </p>            
	            </li>
			<?php endwhile;?>                 
	        </ul>    
	</div>
</div>
<p>Na karfacil.com como voc� pode ver a sua esquerda, 
todas estas logomarcas pertencem as nossas lojas filiadas. 
Atrav�s dela voc� poder� fazer sua pesquisa pelo ve�culo que deseja. 
Lembrando que para pesquisar por ve�culos de uma loja especifica, basta clicar
na loja desejada. </p>
<hr />
<p>A sua direita, se encontra todas os propagandas de Campos e regi�o que se afiliaram ao nosso sistema. 
Por elas voc� poder� pesquisar pelo tipo de servi�o adequado ao seu ve�culo. </p>
<hr />
<p>Nossa proposta � que sem sair de casa o cliente possa consultar os melhores ofertas do mundo automotivo dispon�veis no mercado. </p>
</div> 