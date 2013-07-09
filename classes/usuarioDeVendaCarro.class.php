<?php
require_once(dirname(__FILE__)."/autoload.class.php");
protegeArquivo(basename(__FILE__));

class usuarioDeVendaCarro extends usuario{
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
	
	function retornarTudoUsuario($id){
		$sql = "SELECT * FROM usuario u WHERE u.id='".$id."'";// Retorna todos os dados usuario pelo id
		$this->executaSQL($sql);
	}//retornarTudoUsuario
	function retornarUsuarioIndice($login){
		$sql = "SELECT u.id FROM usuario u WHERE u.login='".$login."'";// Retorna o id do usuario pelo nome
		$this->executaSQL($sql);
	}//retornarUsuarioIndice
}

?>