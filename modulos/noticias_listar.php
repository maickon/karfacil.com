<p class="lista_noticias" align="center">Nossas noticias</p>
<?php 
require_once(dirname(dirname(__FILE__))."/funcoes.php");
protegeArquivo(basename(__FILE__));

$noticias = new noticias();
$noticias->extras_select = " ORDER BY  id DESC ";
$noticias->seleciona_tudo($noticias);
?>
<div class="noticiario radius5 fundo_red" >
<?php while($noticias_r = $noticias->retorna_dados()):?>
		<a href="?p=exibir_not&id=<?php echo $noticias_r->id ?>" class="noticias p_noticia">
			<p align="center" class="radius5 fundo_trans">			
					<?php echo $noticias_r->titulo ?>
			</p>
		</a>
<?php endwhile;?>
</div>
<hr />