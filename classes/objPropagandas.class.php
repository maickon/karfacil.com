<?php
require_once(dirname(__FILE__)."/autoload.class.php");
protegeArquivo(basename(__FILE__));

class objPropagandas extends base{
	public function __construct($campos = array()){
		parent::__construct();
		$this->tabela = 'propagandas';
		if(sizeof($campos) <= 0):
			$this->campos_valores = array(
				"dono_id"				=> NULL,
				"nome" 					=> NULL,
				"tipo" 					=> NULL,
				"bairro"				=> NULL,
				"numero"				=> NULL,
				"cep"					=> NULL,
				"logo"					=> NULL,
				"cidade"				=> NULL,
				"estado"				=> NULL,
				"telefone1"				=> NULL,
				"telefone2"				=> NULL,
				"telefone3"				=> NULL,
				"telefone4"				=> NULL,
				"email"					=> NULL,
				"descricao"				=> NULL,
				"img_1"					=> NULL,
				"img_2"					=> NULL,
				"img_3"					=> NULL,
				"img_4"					=> NULL,
				"propaganda_completa"	=> NULL,
				"google_map"			=> NULL,
				"google_link"			=> NULL
			);
		else:
			$this->campos_valores = $campos;	
		endif;
		$this->campo_pk = "id";
	}//construct
	
	function inicializarPropLogo(){
		$sql = " SELECT id, nome, logo, propaganda_completa, img_1, img_2, img_3, img_4 
				 FROM propagandas 
				 ORDER BY rand() limit 0,8";
		$this->executaSQL($sql);
	}
}

?>