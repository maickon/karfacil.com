<?php 
require_once(dirname(dirname(__FILE__))."/funcoes.php");
protegeArquivo(basename(__FILE__));
loadJs('geral');
?>

<div id="bucaGeralForm">
	<form class="buscaGeralForm" method="post" action="?p=result_geral&busca=s">
			<ul>
				<li>
					<label for="usuario" id="busca_geral">Procurar por..</label> 
					<input type="text" size="30" name="buscar" value="" title="Pesquise aqui o seu veículo desejado. Voce pode fazer sua pesquisa por nome, marca, tipo, ano ou preço. Bastar digitar e você encontrará o que deseja. "  />
				</li>
				<li class="center"><input type="submit" value="Buscar" />
				</li>
			</ul>
	</form>
</div>
