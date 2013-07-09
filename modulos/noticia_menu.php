<?php 
require_once(dirname(dirname(__FILE__))."/funcoes.php");
protegeArquivo(basename(__FILE__));

$noticias = new noticias();
$noticias->extras_select = " ORDER BY  id DESC LIMIT 4 ";
$noticias->seleciona_tudo($noticias);
?>
<p class="noticias titulo" align="center">Karfacil Noticias</p>
<div class="noticiario radius5" >
<?php while($noticias_r = $noticias->retorna_dados()):?>
		<a href="?p=exibir_not&id=<?php echo $noticias_r->id ?>" class="noticias p_noticia">
			<p align="center" class="radius5 fundo_trans">			
					<?php echo $noticias_r->titulo?>
			</p>
		</a>
<?php endwhile;?>
<p class="radius5 fundo_trans"><a href="?p=noticias_listar" class="noticias p_noticia">Mais noticias...</a></p>
</div>
