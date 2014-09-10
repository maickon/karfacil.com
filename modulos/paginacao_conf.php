<?php
$numreg = 3; // Quantos registros por página vai ser mostrado
if(!isset($pg)):
	$pg = 0;
endif;

$inicial = $pg * $numreg;

?>