<?php 
loadCss('style_slide');
$site = new img_site();
$site->seleciona_tudo($site);
?>
<h1 align="center">Seja bem vindo !</h1>

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
<div id="wowslider-container1">
	<div class="ws_images">
		<ul>
			<?php while($site_resp = $site->retorna_dados()): ?>
				<li>
					<a href="127.0.0.1/01/karfacil" target="_parent">
						<img src="<?php echo IMGKARFACILPATH.$site_resp->slide ?>" alt="<?php echo $site_resp->nome ?>" title="<?php echo $site_resp->nome ?>" id="wows1_0"/>
					</a>
					<?php echo $site_resp->nome ?>
				</li>
			<?php endwhile;?> 	
		</ul>
	</div>
<div class="ws_bullets">
	<div>
		<?php while($site_resp = $site->retorna_dados()): ?>
			<a href="#" title="<?php echo $site_resp->nome ?>">
				<img src="<?php echo IMGKARFACILPATH.$site_resp->slide ?>" alt="<?php echo $site_resp->nome ?>"/>
				1
			</a>
		<?php endwhile;?> 	
	</div>
</div>
	<div class="ws_shadow"></div>
	</div>
	<?php loadJs('wowslider');?>
	<?php loadJs('script');?>
	<!-- End WOWSlider.com BODY section -->

<div class="fb-follow" data-href="https://www.facebook.com/pages/karfacilcom/1374528982763546" data-width="450" data-show-faces="true">
Siga-nos no Facebook
</div>
<p>Na karfacil.com como voc� pode ver a sua esquerda, 
todas estas logomarcas pertencem as nossas lojas filiadas. 
Atrav�s dela voc� poder� fazer sua pesquisa pelo ve�culo que deseja. 
Lembrando que para pesquisar por ve�culos de uma loja espec�fica, basta clicar
na loja desejada. </p>
<hr />
<p>A sua direita se encontra todas as propagandas de Campos e regi�o que se afiliaram ao nosso sistema. 
Por elas voc� poder� pesquisar pelo tipo de servi�o adequado ao seu ve�culo. </p>
<hr />
<p>Nossa proposta � que sem sair de casa o cliente possa consultar as melhores ofertas do mundo automotivo dispon�veis no mercado. </p>
</div> 