<?php
require_once(dirname(dirname(__FILE__))."/funcoes.php");


$veiculo_usu = new objVeiculosUsu();
$veiculo_usu->seleciona_tudo($veiculo_usu);
$veiculo_usu->extras_select = " LIMIT 5,5";


$veiculo_loja = new objVeiculosLoja();
$veiculo_loja->seleciona_tudo($veiculo_loja);
$veiculo_loja->extras_select = " LIMIT 5,5";


$pg = $_GET['pagina'] - 1; // pega o nro da página e subtraí 1, para que os dez primeiros registros apareçam

if($pg < 0) $pg = 0; //Caso a pagina seja negativa, vai para a primeira pagina

	$qnt = 10; //Numero de resultados por página.

$sql = "SELECT * FROM tabela LIMIT ($pg*10) , $qnt";

$query = mysql_query($sql); //Executa a pesquisa.

while($row = mysql_fetch_array($query)) // Repete o codigo o nro de vezes equivalentes ao nro de registros retornados.

{

	echo "Nome: ".$row['nome']."";

	echo "Msg :".$row['msg']."";

	echo "<hr>";

}



echo "<a href=consulta.php?pg=".($pg-1).">Anterior</a>";

echo "<a href=consulta.php?pg=".($pg+1).">Próximo</a>";

?>