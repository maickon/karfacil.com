<?php
//$bodytag = str_replace("m", "MMM", "maickonm");
//echo $bodytag; 
// str_replace()
// caso seja encontrado uma ocerrencia do primeiro par�metro no �ltimo par�metro, coloque o par�metro do meio nas ocorrencias
// encontradas. Ex Existe m no inicio e no fim da palavra maickonm, ent�o substitui o m por MMM resultando em MMMaickonMMM. 

$path_local = dirname(__FILE__);
require_once(dirname($path_local)."/funcoes.php");
function __autoload($classe){
	$classe = str_replace('..', '', $classe);
	require_once(dirname(__FILE__)."/$classe.class.php");
}//fim __autoload
?>