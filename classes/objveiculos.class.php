<?php
require_once(dirname(__FILE__)."/autoload.class.php");
protegeArquivo(basename(__FILE__));

class objVeiculos extends base{
	public function __construct($campos = array()){
		parent::__construct();
		$this->tabela = 'veiculos';
		if(sizeof($campos) <= 0):
			$this->campos_valores = array(
				"dono_id"		=> NULL,
				"pertencente" 	=> NULL,
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
	
	function retornarUsuarios(){
		$sql = "SELECT login FROM usuario WHERE tipo='dono de carro'";
		$this->executaSQL($sql);
	}//retornarUsuarios
	function retornarUsuarioIndice($login){
		$sql = "SELECT u.id FROM usuario u WHERE u.login='".$login."'";// Retorna o id do usuario pelo nome
		$this->executaSQL($sql);
	}//retornarUsuarioIndice
	function retornarUsuarioNome($id){
		$sql = "SELECT u.nome FROM usuario u WHERE u.id='".$id."'";// Retorna o nome do usuario pelo id
		$this->executaSQL($sql);
	}//retornarUsuarioNome
	function retornarLogin($id){
		$sql = "SELECT u.login FROM usuario u WHERE u.id='".$id."'";// Retorna o nome do usuario pelo id
		$this->executaSQL($sql);
	}//retornarUsuarioNome
	
	
}

?>