<?php
require_once(dirname(__FILE__)."/autoload.class.php");
//protegeArquivo(basename(__FILE__));

class usuarioDonoLoja extends usuario {
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
	
	function retornarLojaIndice($nome){
		$sql = "SELECT l.id FROM lojas l WHERE l.nome='".$nome."'";// Retorna o id da loja
		$this->executaSQL($sql);
	}//retornarLojaIndice
	function retornarLojaNome($id){
		$sql = "SELECT l.nome FROM lojas l WHERE l.id='".$id."'";// Retorna o nome da loja
		$this->executaSQL($sql);
	}//retornarLojaNome
	function retornarUsuarioLogin($id){
		$sql = "SELECT u.login FROM usuario u WHERE u.id='".$id."'";// Retorna o nome do usuario
		$this->executaSQL($sql);
	}//retornarUsuarioNome
}//fim classe usuarioDonoLoja

?>