<?php 
date_default_timezone_set('America/Sao_Paulo');
inicializa();
function redireciona($url=''){
	header('Location:'.BASEURL.$url);
}//fim redireciona
function inicializa(){
	if (file_exists(dirname(__FILE__)."/config.php")):
		require_once(dirname(__FILE__)."/config.php");
	else:
		die(utf8_decode('O arquivo de inicialização não foi localizado, contate o administrador.'));
	endif;
	if (!defined("BASEPATH") || !defined("BASEURL")):
		die(utf8_decode('Faltam configurações básicas do sistema, contate o administrador.'));
	endif;
	require_once(BASEPATH.CLASSPATH.'autoload.class.php');
	if(isset($_GET['logoff']) == TRUE):
		$user = new usuarioAdmin();
		$user->logoff();
		exit;
	endif;
}//fim inicializa

function loadCss($arquivo, $media='screen', $import=FALSE){
	if ($arquivo != NULL):
		if ($import == TRUE):
			echo '<style type="text/css>">@import url("'.BASEURL.CLASSPATH.$arquivo.'.css");</style>'."\n";
		else:
			echo '<link rel="stylesheet" type="text/css" href="'.BASEURL.CSSPATH.$arquivo.'.css" media="'.$media.'" />'."\n";
		endif;
	endif;
}//fim loadCss

function loadJs($arquivo=NULL, $remoto=FALSE){
	if ($arquivo != NULL):
		if ($remoto == FALSE) $arquivo = BASEURL.JSPATH.$arquivo.'.js';
			echo '<script type="text/javascript" src="'.$arquivo.'"></script>'."\n";
	endif;
}//fim loadJs

function loadModuo($modulo=NULL, $tela=NULL){
	if($modulo == NULL || $tela == NULL):
		echo '<p>Erro na função <strong>'.__FUNCTION__.'</strong> faltam parâmetros para execução.</p>';
	else: 
		if(file_exists(MODULOSPATH."$modulo.php")):
			include_once(MODULOSPATH."$modulo.php");
		else:
			echo '<p>Módulo inexistente neste sistema.</p>';
		endif; 
	endif;
}//fim loadModulo

function protegeArquivo($nome_arquivo, $redir_para='index.php?p=adm&erro=3'){
	$url = $_SERVER["PHP_SELF"];
	if(preg_match("/$nome_arquivo/i", $url)):
		//redireciona para outra URL
		redireciona($redir_para);
	endif;
}//fim protegeArquivo

function codificarSenha($senha){
	return md5($senha);
}

function verificaLogin(){
	$sessao = new Sessao();
	if($sessao->getNvars() <= 0 || $sessao->getVar('logado') != TRUE || $sessao->getVar('ip') != $_SERVER['REMOTE_ADDR']):
		redireciona('index.php?p=adm&erro=3');
	endif;
}

function sair_index(){
	$sessao = new Sessao();
		if ($sessao->getNvars() > 0 || $sessao->getVar('logado') == TRUE || $sessao->getVar('ip') == $_SERVER['REMOTE_ADDR']):
			return "<li class='has-sub '><a href='?logoff=true'><span>Sair</span></a>";
		else:
			return '';
		endif;
}

function printMsg($msg = NULL, $tipo = NULL){
	if($msg != NULL):
		switch($tipo):
			case 'erro':
				echo '<div class="erro">'.$msg.'</div>';
				break;
			case 'alerta':
				echo '<div class="alerta">'.$msg.'</div>';
				break;
			case 'pergunta':
				echo '<div class="pergunta">'.$msg.'</div>';
				break;
			case 'secesso':
				echo '<div class="sucesso">'.$msg.'</div>';
				break;
			default:
				echo '<div class="sucesso">'.$msg.'</div>';
				break;
		endswitch;
	endif;
}

function isAdmin(){
	verificaLogin();
	$sessao = new Sessao();
	$userAdmin = new usuarioAdmin(array(
		'tipo' => NULL,
	));
	$id_user = $sessao->getVar('id_user');
	$userAdmin->extras_select = " WHERE id=$id_user";
	$userAdmin->seleciona_campos($userAdmin);
	$resp = $userAdmin->retorna_dados();
	if($resp = $resp->tipo == 'administrador'):
		return TRUE;
	else:
		return FALSE;
	endif;
}

function exibirVeiculo($objeto){
	(!empty($objeto->nome)) ? $nome = $objeto->nome.' ' : $nome=' ';
	(!empty($objeto->estado)) ? ' ,em estado '.$estado = $objeto->estado : $estado=' ';
	if($objeto->preco == 'a combinar'):
		$preco = 'preço '.$objeto->preco;
	elseif($objeto->preco && $objeto->preco != 'a combinar'):
		$preco = '  custa R$ '.$objeto->preco;
	else:
		$preco = ' ';
	endif;	
	(!empty($objeto->cor)) ? $cor = '  sua cor é '.$objeto->cor : $cor = ' ';
	(!empty($objeto->cilindrada)) ? $cilindrada = ' '.$objeto->cilindrada.' cilindrada' : $cilindrada = ' ';
	(!empty($objeto->cambio)) ? $cambio = ' Câmbio '.$objeto->cambio : $cambio = ' ';
	(!empty($objeto->direcao)) ? $direcao = ' com direção '.$objeto->direcao : $direcao = ' ';
	(!empty($objeto->transmissao)) ? $transmissao = '  tramsmissão '.$objeto->transmissao : $transmissao = ' ';
	(!empty($objeto->combustivel)) ? $combustivel = ' e combustivel '.$objeto->combustivel.' ' : $combustivel = ' ';
	(!empty($objeto->portas)) ? $portas = '  possui '.$objeto->portas.' portas ' : $portas = ' ';
	(!empty($objeto->kilometragem)) ? $kilometragem = '  kilometragem '.$objeto->kilometragem : $kilometragem = ' ';
	(!empty($objeto->marca)) ? $marca = '  da marca '.$objeto->marca : $marca = ' ';
	(!empty($objeto->modelo)) ? $modelo = '  modelo '.$objeto->modelo : $modelo = ' ';
	(!empty($objeto->versao)) ? $versao = '  versão '.$objeto->versao : $versao = ' ';
	(!empty($objeto->ano)) ? $ano = ' e do ano de  '.$objeto->ano : $ano = ' ';
	(!empty($objeto->descricao)) ? $descricao = ' <br /> <p class="compl">Complementos adicionais </p>'.$objeto->descricao : $descricao = ' ';
	if($objeto == NULL):
		printMsg('Seu veículo não foi definido.','erro');
	else:
		echo 'Este veículo pertence a loja ' .$_GET['d_nome'].'<br />'.
		$nome.$estado.' '.$preco.$cor.$cilindrada.$cambio.$direcao.$transmissao.$combustivel.$portas.$kilometragem.$marca.$modelo.$versao.$ano.$descricao;
	endif;
}

function exibirVeiculoUsu($objeto){
	(!empty($objeto->nome)) ? $nome = $objeto->nome.' ' : $nome=' ';
	(!empty($objeto->estado)) ? ' ,em estado '.$estado = $objeto->estado : $estado=' ';
	(!empty($objeto->preco)) ? $preco = '  custa '.$objeto->preco.' R$' : $preco = ' ';
	(!empty($objeto->cor)) ? $cor = '  sua cor é '.$objeto->cor : $cor = ' ';
	(!empty($objeto->cilindrada)) ? $cilindrada = ' '.$objeto->cilindrada.' cilindradas' : $cilindrada = ' ';
	(!empty($objeto->cambio)) ? $cambio = ' câmbio '.$objeto->cambio : $cambio = ' ';
	(!empty($objeto->direcao)) ? $direcao = ' com direção '.$objeto->direcao : $direcao = ' ';
	(!empty($objeto->transmissao)) ? $transmissao = '  tramsmissão '.$objeto->transmissao : $transmissao = ' ';
	(!empty($objeto->combustivel)) ? $combustivel = ' e combustivel '.$objeto->combustivel.' ' : $combustivel = ' ';
	(!empty($objeto->portas)) ? $portas = '  possui '.$objeto->portas.' portas ' : $portas = ' ';
	(!empty($objeto->kilometragem)) ? $kilometragem = '  kilometragem '.$objeto->kilometragem : $kilometragem = ' ';
	(!empty($objeto->marca)) ? $marca = '  da marca '.$objeto->marca : $marca = ' ';
	(!empty($objeto->modelo)) ? $modelo = '  modelo '.$objeto->modelo : $modelo = ' ';
	(!empty($objeto->versao)) ? $versao = '  versão '.$objeto->versao : $versao = ' ';
	(!empty($objeto->ano)) ? $ano = ' e do ano de  '.$objeto->ano : $ano = ' ';
	(!empty($objeto->descricao)) ? $descricao = ' <br /> <p class="compl">Complementos adicionais </p>'.$objeto->descricao : $descricao = ' ';
	if($objeto == NULL):
		printMsg('Seu veículo não foi definido.','erro');
	else:
		echo saudacoes($_GET['d_nome']).'<hr />'.
		$nome.$estado.$preco.$cor.$cilindrada.$cambio.$direcao.$transmissao.$combustivel.$portas.$kilometragem.$marca.$modelo.$versao.$ano.$descricao;
	endif;
}

function exibir_dados($objeto, $existe, $tipo){
	if($tipo == 'exclusivo'):
		if($existe == 0):
			printMsg('Usuário inexistente neste sistema.','erro');
		else:
			isset($objeto->nome)? $nome = $objeto->nome : $nome = ''; 
			if($objeto->telefone):
				$telefone = ' hoje pelo telefone: '.$objeto->telefone;
			else:
				$telefone = '';
			endif;	 
			if($objeto->email):
				$email = ' ou E-mail '.$objeto->email;
			else:	
				$email = ''; 
			endif;
				
			echo '<p>Para mais detalhes do veículo entre em contato com '.$nome.$telefone.$email.'</p>
			 <hr />';
			 //<p class="aviso">Todas as informações presentes aqui são de inteira responsabilidade 
			 //do usuário(a) '.$objeto->nome.' declarada por contrato.</p>	
		endif;
	elseif($tipo == 'loja'):
		if($existe == 0):
			printMsg('Usuário inexistente neste sistema.','erro');
		else:
			 isset($objeto->nome)? $nome = $objeto->nome : $nome = '';
			 if($objeto->telefone_cel):
			 	$telefone_cel = $objeto->telefone_cel;
			 else:
			 	$telefone_cel = ''; 
			 endif;
			 if($objeto->telefone_res):
			 	$telefone_res = '/'.$objeto->telefone_res;
			 else:
			 	$telefone_res = '';
			 endif;		
			 if($objeto->email):
			 	$email = ' ou E-mail '.$objeto->email;
			 else:
			 	$email = '';
			 endif;		 
			 if($objeto->cidade):
			 	$cidade = ' Cidade '.$objeto->cidade;
			 else:
			 	$cidade = '';
			 endif;	 
			 if($objeto->bairro):
			 	$bairro = ', '.$objeto->bairro;
			 else:
			 	$bairro = ''; 
			 endif;
			 if($objeto->rua):
			 	$rua = ', '.$objeto->rua;
			 else:
			 	$rua = ''; 
			 endif;
			 if($objeto->numero):
			 	$numero = ', número '.$objeto->numero;
			 else:	
			 	$numero = '';
			 endif;	 
			 if($objeto->cep):
			 	$cep = ', cep '.$objeto->cep;
			 else:
			 	$cep = '';
			 endif;
			 if($objeto->estado):
			 	$estado = ' e estado '.$objeto->estado;
			 else:
			 	$estado = '';
			 endif;	  
			 
			 echo '<p>Para mais detalhes do veículo entre em contato hoje com a '.$nome.' pelo telefone: '
			 .$telefone_cel.$telefone_res.'<br />'
			 .$email.'</p>
			 <p>Ou visite</p>
			 <p>'.$cidade.$bairro.$rua.$numero.$cep.$estado.'</p>
			 <hr />';
			 //<p class="aviso">Todas as informações presentes aqui são de inteira responsabilidade 
			 //de nossa loja filiada $loja_resp->nome declarada por contrato.</p>	
		endif;;	
	endif;	
}
function saudacoes($nome){
	
	$saudacoes = array(
	"Olá, eu me chamo $nome e através da Karfacil.com posso divulgar a venda do meu veículo com muita qualidade e detalhes
	que antes não conseguia. Caso se interesse pelo meu veículo entre em contato comigo o mais rápido possivél. Estarei muito feliz em atende-lo.",
	
	"Meu nome é $nome e me sinto muito feliz por estar divulgando o meu veículo pela Karfacil.com. Com eles eu sei que vou encontrar
	um comprador mais rápido do que antigamente. Fique a vontade e entre em contato comigo caso o meu veículo lhe agrade. ",
	
	"Saudações visitante, eu me chamo $nome e é um prazer ter o meu veículo sendo anunciado aqui na Karfacil.com. Sinta-se livre para escolher 
	o seu veículo.",
	
	"Meu nome é $nome e através da karfacil.com venho divulgar a venda do meu veículo, qualquer interessado favor entrar em contato comigo.",
	
	"Olá internauta, meu nome é $nome e estou vendendo este veículo que você está vendo ai em cima. Graças a karfacil.com posso anunciar a venda do 
	meu veículo atingindo mais pessoas do que antes, isso é uma maravilha.",
	
	"Seja bem vindo, eu me chamo $nome e através da karfacil.com estou divulgando a venda do meu veículo, fique a vontade para entrar em contato comigo.");
	
	$escolido = rand(0,4);
	switch($escolido):
		case 0:$saudacao = $saudacoes[$escolido];
			break;

		case 1:$saudacao = $saudacoes[$escolido];
			break;

		case 2:$saudacao = $saudacoes[$escolido];
			break;
			
		case 3:$saudacao = $saudacoes[$escolido];
			break;
			
		case 4:$saudacao = $saudacoes[$escolido];
			break;
		default:'<div class="erro">Saodação não definida.</div>';
	endswitch;
	
	return $saudacao;
}

function exibirProp($objeto){
	if($objeto == NULL):
		printMsg('Sua propaganda não foi definida.','erro');
	else:
		if($objeto->cidade):
			$cidade = 'Situada em '.$objeto->cidade.' ';
		else:
			$cidade = '';
		endif;
		if($objeto->bairro):
			$bairro = ', bairro '.$objeto->bairro.' ';
		else:
			$bairro = '';
		endif;	
		if($objeto->numero):
			$numero = ' Número '.$objeto->numero.' ';
		else:
			$numero = '';
		endif;
		if($objeto->cep):
			$cep = ' Cep '.$objeto->cep.' ';	
		else:
			$cep = '';
		endif;
		if($objeto->estado):
			$estado = ' Estado '.$objeto->estado.'<br />';	
		else:
			$estado = '';
		endif;
		if($objeto->telefone1):
			 $telefone1 = 'Telefones: '.$objeto->telefone1.'/';
		else:
			$telefone1 = '';
		endif;	
		if($objeto->telefone2):
			 $telefone2 = $objeto->telefone2.'/';
		else:
			$telefone2 = '';
		endif;	
		if($objeto->telefone3):
			 $telefone3 = $objeto->telefone3.'/';
		else:
			$telefone3 = '';
		endif;			 	
		if($objeto->telefone4):
			 $telefone4 = $objeto->telefone4;
		else:
			$telefone4 = '';
		endif;
		if($objeto->email):
			$email = ' <br />E-mail: '.$objeto->email.'<br />';
		else:
			$email = '';
		endif;	
		if($objeto->descricao):
			$descricao = '<p class="compl">Sobre a '.$objeto->nome.'</p>'.$objeto->descricao;
		else:
			$descricao = '';
		endif;		
		echo $cidade.$bairro.$numero.$cep.$estado.$telefone1.$telefone2.$telefone3.$telefone4.$email.$descricao;
	endif;	
}
function exibirloja($objeto){
	if($objeto == NULL):
		printMsg('Sua loja não foi definida.','erro');
	else:
		if($objeto->cidade):
			$cidade = ' Situada em  '.$objeto->cidade;
		else:
			$cidade = ' ';
		endif;	
		if($objeto->bairro):
			$bairro = ' ,  '.$objeto->bairro;
		else:
			$bairro = ' ';
		endif;
		if($objeto->rua):
			 $rua = ' ,  '.$objeto->rua;
		else:
			 $rua = ''; 
		endif;	
		if($objeto->numero):
			$numero = '<br /> número  '.$objeto->numero.'<br />';
		else:
			$numero = ' ';
		endif;	
		if($objeto->cep):
			$cep = ' Cep '.$objeto->cep.'<br />';
		else:
			$cep = ' ';
		endif;	
		if($objeto->estado):
			$estado = ' Estado '.$objeto->estado.'<br />';
		else:
			$estado = ' ';
		endif;	
		if($objeto->email):
			$email = '.<br /> E-mail '.$objeto->email.'<br />';
		else:
			$email = ' ';
		endif;	
		if(($objeto->CNPJ) != ''):
			$CNPJ = 'CNPJ '.$objeto->CNPJ.'<br />';
		else:
			$CNPJ = ' ';
		endif;	
		if($objeto->telefone_cel):
			$cel = $objeto->telefone_cel.'/';
		else:	
			$cel = ' ';
		endif;	
		if($objeto->telefone_res):
			$res = $objeto->telefone_res;
		else:
			$res = ' ';
		endif;	
		echo $cidade.$bairro.$rua.$numero.$cep.$CNPJ.$estado.' Dados para contato<br /> '.'Tel '.$cel.$res.$email;
	endif;	
}
function antiInject($string){
	$string = preg_replace("/(from|select|insert|delet|where|drop table|show table|#|\*|--|\\\\)/i","",$string);
	$string = trim($string);//limpa espaços vazios
	$string = strip_tags($string);//tiras tags php e html
	if(!get_magic_quotes_gpc())
		$string = addslashes($string);//adiciona barras invertidas a uma string	
	return $string;
}
function apagarDependencias($tipo = NULL,$id = NULL){
	if($tipo == NULL || $id == NULL):
		printMsg('Parâmetros não definidos.','erro');
	else:
		switch($tipo):
				
			case 'dono de carro':
					$sql = "DELETE FROM veiculos_usu WHERE dono_id=".$id;
					$usu = new usuarioAdmin();
					$usu->executaSQL($sql);
				break;
				
			case 'dono de loja':
					$sql_1 = "SELECT id FROM lojas WHERE dono_id=".$id;
					$usu = new usuarioAdmin();
					$usu->executaSQL($sql_1);
					$sql_2 = "DELETE FROM lojas WHERE dono_id=".$id;
					$usu->executaSQL($sql_2);
					while($dados = $usu->retorna_dados()):
						$sql_3 = "DELETE FROM veiculos_loja WHERE loja_id=".$dados->id;
						$usu->executaSQL($sql_3);
					endwhile;
				break;
				
			case 'dono de propaganda':
					$sql = "DELETE FROM propagandas WHERE dono_id=".$id;
					$usu = new usuarioAdmin();
					$usu->executaSQL($sql);
				break;
				
			default:
				printMsg('Ocorreu um erro no tipo de usuário.','erro');	
				
		endswitch;
	endif;
}

function apaga_diretorio($dir) {
	if (!file_exists($dir)) return true;
	if (!is_dir($dir)) return unlink($dir);
	foreach (scandir($dir) as $item):
		if (($item == '.') or ($item == '..')) continue;
		if (!apaga_diretorio($dir . DIRECTORY_SEPARATOR . $item)) return false;
	endforeach;
	return rmdir($dir);
}

function criar_diretorio_loja($nome){
	mkdir(dirname(__FILE__)."/img_lojas/$nome") or die('Um erro ocorreu, o pasta de nome '.$nome.' ja existe no sistema.');
}

function criar_diretorio_parceiros($parceiro_nome){
	mkdir(dirname(__FILE__).'/img_parceiros/'.$parceiro_nome) or die('Um erro ocorreu com o arquivo '.$parceiro_nome.'. Não foi possivel salva-lo.');
}
function criar_diretorio_veiculos($loja_nome,$veiculo_id){
	mkdir(dirname(__FILE__).'/img_lojas/'.$loja_nome.'/'.$veiculo_id) or die('Um erro ocorreu com o arquivo '.$veiculo_id.'. Não foi possivel salva-lo.');
}

function criar_diretorio_propagandas($prop_nome){
	mkdir(dirname(__FILE__).'/img_propagandas/'.$prop_nome) or die('Um erro ocorreu com o arquivo '.$prop_nome.'  Não foi possivel salva-lo.');
}

function deletar_diretorio_veiculos($loja_nome,$veiculo_id){
	rmdir(BASEURL.'/img_lojas/'.$loja_nome.'/'.$veiculo_id) or die('Um erro ocorreu com o arquivo '.$veiculo_id.'  Não foi possivel salva-lo.');
}

function deletar_loja($nome){
	unlink(dirname(__FILE__)."/img_lojas/$nome",0744,true);
}

function preparar_nome($file){
	$imagem = $file;
	$nome= gerar_nome($imagem['name']);
	return $nome;
}

function upload_mestre($caminho,$file,$loja_nome,$logo_unico,$tipo_file,$tamanho){
	$permite = array('image/jpg','image/jpeg','image/pjpeg','image/png');
	$imagem = $file;
	$destino = $imagem['tmp_name'];
	$imagem['name'] = $logo_unico;
	$nome= $imagem['name'];		
	$tipo = $imagem['type'];
	
	if($tipo_file == 'img_lojas'):
		$constante = IMGLOJASPATH;
	elseif($tipo_file == 'img_propagandas'):
		$constante = IMGPROPAGANDASPATH;
	else:
		$constante = IMGPARCEIROSPATH;	
	endif; 
	if(!empty($nome) && in_array($tipo,$permite)):
		upload($destino,$nome,$tamanho,$constante,$tipo,$constante."$loja_nome/$nome");
	else:
		echo '<div class="alerta">Aceitamos apenas imagens no formato JPEG</div>';
	endif;

}

function upload($destino = NULL,$nome = NULL,$largura = NULL,$pasta = NULL,$tipo = NULL,$caminho = NULL){
	if($destino == NULL && $nome == NULL && $largura == NULL && $pasta == NULL && $tipo == NULL && $caminho == NULL):
		echo 'Faltam parâmetros a serem definidos';
		exit;
	endif;
	switch($tipo):
		case 'image/png':
			$img = imagecreatefrompng($destino);
			$t = 'png';
		break;	
		case 'image/pjpeg':
			$img = imagecreatefromjpeg($destino);
			$t = 'jpeg';
		break;	
		case 'image/jpeg':
			$img = imagecreatefromjpeg($destino);
			$t = 'jpeg';
		break;	
		case 'image/jpg':
			$img = imagecreatefromjpeg($destino);
			$t = 'jpeg';
		break;	
	endswitch;
	$x = imagesx($img);
	$y = imagesy($img);
	$altura = ($largura*$y)/$x;
	
	$nova_imagem = imagecreatetruecolor($largura,$altura);
	imagecopyresampled($nova_imagem,$img,0,0,0,0,$largura,$altura,$x,$y);
	if($t = 'png'):
		imagepng($nova_imagem,$caminho);
	else:
		if($t = 'jpg'):	
			imagejpeg($nova_imagem,$caminho);
		endif;
	endif;	
	imagedestroy($img);
	imagedestroy($nova_imagem);	
}

function gerar_nome($imagem_atual,$ext = NULL){
	preg_match("/.(gif|bmp|png|jpg|jpeg){1}$/i", $imagem_atual, $ext);
	$nova_imagem = md5(uniqid(time())) . "." . $ext[1];
	return $nova_imagem;	
}

function hora_atual(){
	$tempo = localtime(time(),TRUE);
	$hora = $tempo['tm_hour'];
	$min = $tempo['tm_min'];
	$segundos = $tempo['tm_sec'];
	
	return "$hora : $min : $segundos ";
}

function data_atual($sessao){
	$tempo = localtime(time(),TRUE);
	$dia = $tempo['tm_mday'];
	$mes = $tempo['tm_mon'];
	$ano = $tempo['tm_year']+1900;
	$semana = $tempo['tm_wday'];
	
	return "Bom dia ".$sessao.", hoje é ".descobrir_samana($semana).", $dia de". descobrir_mes($mes)." de $ano";
}

function descobrir_samana($dia){
	switch($dia):
		case 0:$semana = 'Domingo';
			break;
		case 1:$semana = 'Segunda feira';
			break;
		case 2:$semana = 'Terça feira';
			break;
		case 3:$semana = 'Quarta feira';
			break;
		case 4:$semana = 'Quinta feira';
			break;
		case 5:$semana = 'Sexta feira';
			break;
		case 6:$semana = 'Sábado';
			break;	
		default:$semana = 'Erro, o parâmerto está incorreto';						
	endswitch;
	return $semana;
}

function descobrir_mes($mes){
	switch($mes):
		case 0:$novo_mes = 'Janeiro';
			break;
		case 1:$novo_mes = 'Fevereiro';
			break;
		case 2:$novo_mes = 'Março';
			break;
		case 3:$novo_mes = 'Abril';
			break;
		case 4:$novo_mes = 'Maio';
			break;
		case 5:$novo_mes = 'Junho';
			break;
		case 6:$novo_mes = 'Julho';
			break;					
		case 7:$novo_mes = 'Agosto';
			break;
		case 8:$novo_mes = 'Setembro';
			break;
		case 9:$novo_mes = 'Outubro';
			break;
		case 10:$novo_mes = 'Novembro';
			break;
		case 11:$novo_mes = 'Dezembro';
			break;		
		default:$novo_mes = 'Erro, o parâmerto está incorreto';	
	endswitch;
	return $novo_mes;
}

function entitular_lista($nome){
	$msg = NULL;
	$titulo_carro   = "Abaixo se encontra todos os carros cadastrados em nosso sistema.";
	$titulo_moto = "Abaixo se encontra todos as motos cadastradas em nosso sistema";
	$titulo_caminhao = "Abaixo se encontra todos os caminhões cadastrados em nosso sistema";
	$titulo_nautico = "Abaixo se encontra todos veículos nauticos cadastrados em nosso sistema";
	switch($nome):
		case 'carros':$msg = $titulo_carro;
			break;
			
		case 'motos':$msg = $titulo_moto;
			break;
		
		case 'caminhão':$msg = $titulo_caminhao;
			break;
		
		case 'nautico':$msg = $titulo_nautico;
			break;
		
		default:'<div class="erro">Nome não especificado.</div>';				
	endswitch;
	
	return $msg;
}
?>