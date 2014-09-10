<?php
require_once(dirname(__FILE__)."/autoload.class.php");
protegeArquivo(basename(__FILE__));

class objLojas extends base{
	public function __construct($campos = array()){
		parent::__construct();
		$this->tabela = 'lojas';
		if(sizeof($campos) <= 0):
			$this->campos_valores = array(
				"dono_id"		=> NULL,
				"nome" 			=> NULL,
				"bairro"		=> NULL,
				"rua"			=> NULL,
				"numero"		=> NULL,
				"cep"			=> NULL,
				"logo"			=> NULL,
				"CNPJ"			=> NULL,
				"loja_foto"		=> NULL,
				"cidade"		=> NULL,
				"estado"		=> NULL,
				"telefone_cel"	=> NULL,
				"telefone_res"	=> NULL,
				"email"			=> NULL,
				"google_map"	=> NULL,
				"google_link"	=> NULL
			);
		else:
			$this->campos_valores = $campos;	
		endif;
		$this->campo_pk = "id";
	}//construct
	
	function retornarLojas(){
		$sql = "SELECT nome FROM lojas";
		$this->executaSQL($sql);
	}//retornarLojas
	function retornarLojaIndice($nome){
		$sql = "SELECT l.id FROM lojas l WHERE l.nome='".$nome."'";// Retorna o id da loja
		$this->executaSQL($sql);
	}
	function retornarLojaNome($id){
		$sql = "SELECT l.nome FROM lojas l WHERE l.id='".$id."'";// Retorna o nome da loja
		$this->executaSQL($sql);
	}
	function retornarTudoLoja($id){
		$sql = "SELECT * FROM lojas l WHERE l.id='".$id."'";// Retorna todos os dados da loja pelo id
		$this->executaSQL($sql);
	}//retornarTudoLoja
	function lojaJaExiste($campo = NULL, $valor = NULL){
		if($campo != null && $valor != NULL):
			is_numeric($valor) ? $valor = $valor : $valor = "'".$valor."'";
			$this->extras_select = " WHERE $campo = $valor";
			$this->seleciona_tudo($this);
			if($this->linhas_afetadas > 0):
				return TRUE;
			else:
				return FALSE;
			endif;
		else:
			$this->tratar_erro(__FILE__,__FUNCTION__,NULL,'Faltam parâmetros para executar a função.',TRUE);
		endif;
	}//fim usuJaExiste	
	
	function inicializarLojasLogo(){
		$sql = " SELECT nome, id, logo, logo,loja_foto FROM lojas ORDER BY rand() limit 0,8";
		$this->executaSQL($sql);
	}
	/*
	 * CONSULTAS SQL
	 * " SELECT u.nome FROM usuario u,lojas l WHERE l.dono_id=u.id ";//rotorna todos os donos de loja
	 * "SELECT DISTINCT u.nome FROM usuario u,lojas l WHERE l.dono_id=u.id AND l.dono_id=7";// Retorna o nome do dono da loja
	 */
}//fim classe anunciantes
	

?>