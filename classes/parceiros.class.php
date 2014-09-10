<?php
require_once(dirname(__FILE__)."/autoload.class.php");
protegeArquivo(basename(__FILE__));

class parceiros extends base {
	public function __construct($campos = array()){
		parent::__construct();
		$this->tabela = 'parceiros	';
		if(sizeof($campos) <= 0):
			$this->campos_valores = array(
				"nome" 		=> NULL,
				"link"		=> NULL,
				"descricao"	=> NULL,
				"img"		=> NULL
			);
		else:
			$this->campos_valores = $campos;	
		endif;
		$this->campo_pk = "id";
	}//construct
}//fim classe usuario

?>