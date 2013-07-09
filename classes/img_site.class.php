<?php
require_once(dirname(__FILE__)."/autoload.class.php");
protegeArquivo(basename(__FILE__));

class img_site extends base{
	public function __construct($campos = array()){
		parent::__construct();
		$this->tabela = 'img_do_site';
		if(sizeof($campos) <= 0):
			$this->campos_valores = array(
				"baner_principal" 	=> NULL,
				"slide"				=> NULL,
				"nome"				=> NULL,
				"descricao_1"		=> NULL,
				"descricao_2"		=> NULL,
				"descricao_3"		=> NULL,
				"data_cadastro"		=> NULL
			);
		else:
			$this->campos_valores = $campos;	
		endif;
		$this->campo_pk = "id";
	}//construct
}

?>