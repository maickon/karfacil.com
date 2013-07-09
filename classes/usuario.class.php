<?php
require_once(dirname(__FILE__)."/autoload.class.php");
protegeArquivo(basename(__FILE__));

abstract class usuario extends base {
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
	
	function usuJaExiste($campo = NULL, $valor = NULL){
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
	
	function deletarDependencias($tipo){
		switch($tipo):
			case 'dono de propaganda':
				$sql = "DELETE 
						FROM propagandas 
						WHERE dono_id=".$tipo;
			break;
			
			case 'dono de carro':
				$sql = "DELETE 
						FROM veiculos_usu 
						WHERE dono_id=".$tipo;
			break;	
			
			case 'dono de loja':
				$sql = "DELETE 
						FROM lojas, veiculos_loja 
						WHERE dono_id=".$tipo."
						AND
						WHERE loja_id=dono_id";
			break;	
			
			default:
				$sql = "";
		endswitch;
		
		return $this->executaSQL($sql);
	}
	
/*SQL
 * SELECT u.nome, p.nome FROM usuario u, propagandas p WHERE u.tipo =  'dono de propaganda' AND u.id = p.dono_id AND u.id =8 //apaga o usuario escolido e suas propagandas
 * SELECT u.nome, v.nome FROM usuario u, veiculos_usu v WHERE u.tipo='dono de carro' AND u.id=v.dono_id AND u.id=2 //vai apagar o usuario escolido e o seu carro
 * 
 */
}//fim classe usuario

?>