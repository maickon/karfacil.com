<?php
require_once(dirname(__FILE__)."/autoload.class.php");
protegeArquivo(basename(__FILE__));

class objVeiculosLoja extends base{
	public function __construct($campos = array()){
		parent::__construct();
		$this->tabela = 'veiculos_loja';
		if(sizeof($campos) <= 0):
			$this->campos_valores = array(
				"loja_id"		=> NULL,
				"nome" 			=> NULL,
				"preco"			=> NULL,
				"cor"			=> NULL,
				"categoria"		=> NULL,
				"estado"		=> NULL,
				"cambio"		=> NULL,
				"cilindrada"	=> NULL,
				"direcao"		=> NULL,
				"transmissao"	=> NULL,
				"combustivel"	=> NULL,
				"portas"		=> NULL,
				"kilometragem"	=> NULL,
				"marca"			=> NULL,
				"modelo"		=> NULL,
				"ano"			=> NULL,
				"versao"		=> NULL,
				"img_1"			=> NULL,
				"img_2"			=> NULL,
				"img_3"			=> NULL,
				"img_4"			=> NULL,
				"descricao"		=> NULL
			);
		else:
			$this->campos_valores = $campos;	
		endif;
		$this->campo_pk = "id";
	}//construct
	function retornarTudoLoja($id){
		$sql = "SELECT * FROM lojas l WHERE l.id='".$id."'";// Retorna todos os dados usuario pelo id
		$this->executaSQL($sql);
	}//retornarTudoUsuario
}

?>