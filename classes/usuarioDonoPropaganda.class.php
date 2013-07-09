<?php
require_once(dirname(__FILE__)."/autoload.class.php");
protegeArquivo(basename(__FILE__));

class usuarioDonoPropaganda extends usuario{
	public function __construct($campos = array()){
		parent::__construct();
		$this->tabela = 'usuario';
		if(sizeof($campos) <= 0):
			$this->campos_valores = array(
				"nome" 			=> NULL,
				"email"			=> NULL,
				"login"			=> NULL,
				"senha"			=> NULL,
				"ativo"			=> 's',
				"tipo"			=> NULL,
				"data_cadastro"	=> NULL
			);
		else:
			$this->campos_valores = $campos;	
		endif;
		$this->campo_pk = "id";
	}//construct
	
	function retornarPropagandas(){
		$sql = "SELECT nome 
				FROM usuario 
				WHERE tipo='dono de propaganda'";
		$this->executaSQL($sql);
	}//retornarPropagandas
	
	function retornarPropIndice($nome){
		$sql = "SELECT u.id FROM usuario u 
				WHERE u.tipo='dono de propaganda' 
				AND u.nome='".$nome."'";// Retorna o id da propaganda
		$this->executaSQL($sql);
	}//retornarLojaIndice
	
	function retornarPropagandaNome($id){
		$sql = "SELECT u.nome FROM usuario u
				WHERE u.tipo='dono de propaganda'
				AND u.id='".$id."'";// Retorna o dono da propaganda
		$this->executaSQL($sql);
	}//retornarPropagandaNome
}
?>