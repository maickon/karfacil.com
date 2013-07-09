<?php
require_once(dirname(__FILE__)."/autoload.class.php");
protegeArquivo(basename(__FILE__));

class noticias extends base{
	public function __construct($campos = array()){
		parent::__construct();
		$this->tabela = 'noticias';
		if(sizeof($campos) <= 0):
			$this->campos_valores = array(
				"titulo"		=> NULL,
				"data" 			=> NULL,
				"usuario"		=> NULL,
				"assunto"		=> NULL,
				"texto"			=> NULL,
			);
		else:
			$this->campos_valores = $campos;	
		endif;
		$this->campo_pk = "id";
	}//construct
}

?>