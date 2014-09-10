<style type="text/css">
.pgoff {font-family: Verdana, Arial, Helvetica; font-size: 1 1 px; color: #FF0000; text-decoration: none}
a.pg {font-family: Verdana, Arial, Helvetica; font-size: 1 1 px; color: #003366; text-decoration: none}
a:hover.pg {font-family: Verdana, Arial, Helvetica; font-size: 1 1 px; color: #0066cc; text-decoration:underline}
</style>

<?php
require_once(dirname(dirname(__FILE__))."/funcoes.php");

$quant_pg = ceil($quantreg/$numreg);
$quant_pg++;
echo '<div align="center" class="paginacao">';
// Verifica se esta na primeira página, se nao estiver ele libera o link para anterior
if($pg > 0):
	echo "<a href='.$PHP_SELF.'?pg='.$pg-1.' class='pg' > <b>&laquo; anterior</b> </a>";
else:
	echo "<font>&laquo; anterior</font>";
endif;

for($i_pg=1; $i_pg<$quant_pg; $i_pg++):
	// Verifica se a página que o navegante esta e retira o link do número para identificar visualmente
	if($pg == ($i_pg-1)):
		echo "&nbsp;<span class='pgoff'>[$i_pg]</span>&nbsp;";
	else:
		$i_pg2 = $i_pg-1;
		echo "&nbsp;<a href='.$PHP_SELF.'?pg='.$i_pg2.' class='pg'><b>".$i_pg."</b></a>&nbsp;";
	endif;
endfor;

// Verifica se esta na ultima página, se nao estiver ele libera o link para próxima
if(($pg+2) < $quant_pg):
	echo "<a href='.$PHP_SELF.'?pg='.$pg+1.' class='pg'><b>próximo &raquo;</b></a>";
else:
	echo "<font>próximo &raquo;</font>";
endif;

echo '</div>';
?>