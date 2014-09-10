<?php
require_once(dirname(__FILE__)."/autoload.class.php");
protegeArquivo(basename(__FILE__));

class Agenda extends base{
	public function __construct($campos = array()){
		parent::__construct();
		$this->tabela = 'agenda';
		if(sizeof($campos) <= 0):
			$this->campos_valores = array(
				"nome"			=> NULL,
				"data_visita" 	=> NULL,
				"dia_visita"	=> NULL,
				"hora"			=> NULL,
				"telefone"		=> NULL,
				"adicional"		=> NULL,
			);
		else:
			$this->campos_valores = $campos;	
		endif;
		$this->campo_pk = "id";
	}//construct
}
?>