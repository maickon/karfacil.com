<?php 
require_once(dirname(dirname(__FILE__))."/funcoes.php");
loadJs('jquery_validate');
loadJs('jquery_validate_messages');
loadJs('geral');
protegeArquivo(basename(__FILE__));
switch ($tela):
	case 'login':
		$sessao = new sessao();
		if ($sessao->getNvars() > 0 && $sessao->getVar('logado') == TRUE && $sessao->getVar('ip') == $_SERVER['REMOTE_ADDR']) redireciona('painel.php'); 
		if(isset($_POST['logar'])):
			$user = new usuarioAdmin();
			$user->setValor('login',antiInject($_POST['usuario']));
			$user->setValor('senha',antiInject($_POST['senha']));
			if($user->logar($user)):
				redireciona('painel.php?usu=');
			else:
				redireciona('?p=adm&erro=2');
			endif;
		endif;
?>
<script type="text/javascript">
		$(document).ready(function(){
			$(".userForm").validate({
				rules:{
					usuario:{required:true, minlength:3},
					senha:{required:true, rangelength:[4,10]}
				}
			});
		});
	</script>
<div id="logimForm">
<form class="userForm" method="post" action="">
<fieldset><legend>Acesso restrito, identifique-se</legend>
<ul>
	<li>
		<label for="usuario">Usuário</label> <input type="text" size="35" name="usuario" autofocus="autofocus" value="<?php echo $_POST['usuario']=''; ?>" />
	</li>
	<li>
		<label for="senha">Senha</label> <input type="password" size="35" name="senha" value="<?php echo $_POST['senha']=''; ?>" />
	</li>
	<li class="center"><input type="submit" name="logar" value="login" />
	</li>
</ul>
					<?php
					if(isset($_GET['erro'])):
						$erro = $_GET['erro'];
					else:
						$erro = '';
					endif;	
					switch ($erro):
						case 1:
							echo '<div class="sucesso">Você fez logoff do sistema.</div>';
							break;
						case 2:
							echo '<div class="erro">Dados incorretos ou você não é um administrador.</div>';
							break;
						case 3:
							echo '<div class="erro">Faça login de antes de acessar a página solicitada.</div>';
							break;
						case 4:
							echo '<div class="alerta">Aleerta.</div>';
							break;
						case 5:
							echo '<div class="pergunta">Pergunta.</div>';
							break;	
					endswitch;
					?>
				</fieldset>
</form>
<br>
<br>
<br>
<br>
<br>
<br>
</div>
<?php 
		break;
	
	case 'incluir':
			echo '<h2>Cadastro de usuários</h2>';
			if(isset($_POST['cadastrar'])):
				switch($_POST['tipo']):
					case 'administrador':
						$usu_admin = new usuarioAdmin(array(
							'nome'=>$_POST['nome'],
							'email'=>$_POST['email'],
							'login'=>$_POST['login'],
							'senha'=>codificarSenha($_POST['senha']),
							'ativo'=>'s',
							'tipo'=>$_POST['tipo'],
							'telefone'=>$_POST['telefone'],
							'validade'=>$_POST['validade']	
						));
						if($usu_admin->usuJaExiste('login',$_POST['login'])):
							printMsg('Este login ja está cadastrado, escolha outro nome de usuário.','erro');
							$duplicado = TRUE;
						else:
							$duplicado = FALSE;
						endif;
						if($duplicado != TRUE):
							$usu_admin->inserir($usu_admin);
							if($usu_admin->linhas_afetadas == 1):
								printMsg('Dados inserido com sucesso <a href="'.ADMURL.'?m=usuarios&t=listar">Exibir cadastros</a>');
								unset($_POST);
							endif;
						endif;	
						break;
					
					case 'dono de loja':
						$usu_dono_loja = new usuarioDonoLoja(array(
							'nome'=>$_POST['nome'],
							'email'=>$_POST['email'],
							'login'=>$_POST['login'],
							'senha'=>codificarSenha($_POST['senha']),
							'ativo'=>'s',
							'tipo'=>$_POST['tipo'],
							'telefone'=>$_POST['telefone'],
							'validade'=>$_POST['validade']	
						));
						if($usu_dono_loja->usuJaExiste('login',$_POST['login'])):
							printMsg('Este login ja está cadastrado, escolha outro nome de usuário.','erro');
							$duplicado = TRUE;
						else:
							$duplicado = FALSE;
						endif;
						if($duplicado != TRUE):
							$usu_dono_loja->inserir($usu_dono_loja);
							if($usu_dono_loja->linhas_afetadas == 1):
								printMsg('Dados inserido com sucesso <a href="'.ADMURL.'?m=usuarios&t=listar">Exibir cadastros</a>');
								unset($_POST);
							endif;
						endif;
						break;

					case 'dono de propaganda':
						$usu_dono_prop = new usuarioDonoPropaganda(array(
							'nome'=>$_POST['nome'],
							'email'=>$_POST['email'],
							'login'=>$_POST['login'],
							'senha'=>codificarSenha($_POST['senha']),
							'ativo'=>'s',
							'tipo'=>$_POST['tipo'],
							'telefone'=>$_POST['telefone'],
							'validade'=>$_POST['validade']	
						));
						if($usu_dono_prop->usuJaExiste('login',$_POST['login'])):
							printMsg('Este login ja está cadastrado, escolha outro nome de usuário.','erro');
							$duplicado = TRUE;
						else:
							$duplicado = FALSE;
						endif;
						if($duplicado != TRUE):
							$usu_dono_prop->inserir($usu_dono_prop);
							if($usu_dono_prop->linhas_afetadas == 1):
								printMsg('Dados inserido com sucesso <a href="'.ADMURL.'?m=usuarios&t=listar">Exibir cadastros</a>');
								unset($_POST);
							endif;
						endif;
						break;
						
					case 'dono de carro':
						$usu_dono_carro = new usuarioDeVendaCarro(array(
							'nome'=>$_POST['nome'],
							'email'=>$_POST['email'],
							'login'=>$_POST['login'],
							'senha'=>codificarSenha($_POST['senha']),
							'ativo'=>'s',
							'tipo'=>$_POST['tipo'],
							'telefone'=>$_POST['telefone'],
							'validade'=>$_POST['validade']	
						));
						if($usu_dono_carro->usuJaExiste('login',$_POST['login'])):
							printMsg('Este login ja está cadastrado, escolha outro nome de usuário.','erro');
							$duplicado = TRUE;
						else:
							$duplicado = FALSE;	
						endif;
						if($duplicado != TRUE):
							$usu_dono_carro->inserir($usu_dono_carro);
							if($usu_dono_carro->linhas_afetadas == 1):
								printMsg('Dados inserido com sucesso <a href="'.ADMURL.'?m=usuarios&t=listar">Exibir cadastros</a>');
								unset($_POST);
							endif;
						endif;
						break;
				endswitch;
			endif;
			?>
<script type="text/javascript">
				$(document).ready(function(){
					$(".userForm").validate({
						rules:{
							nome:{required:true, minlength:3},	
							telefone:{required:true, rangelength:[10,20]},
							login:{required:true, minlength:5},
							senha:{required:true, rangelength:[4,10]},
							senhaconf:{required:true,equalTo:"#senha"},
							tipo:{required:true, tipo:true}
						}
					});
				});
			</script>
<form class="userForm" method="post" action="">
<fieldset><legend>Informe os dados para o cadastro</legend>
<ul>
	<li><label for="nome">Nome:</label> <input type="text" size="50" name="nome" autofocus="autofocus" value="<?php echo $_POST['nome']='' ?>">
	</li>
	<li><label for="email">Email:</label> <input type="text" size="50" name="email" value="<?php echo $_POST['email']='' ?>">
	</li>
	<li><label for="validade">Validade:</label> <input type="text" size="50" name="validade" value="<?php echo $_POST['validade']='' ?>">
	</li>
	<li><label for="telefone">Telefone:</label> <input type="text" size="50" name="telefone" value="<?php echo $_POST['telefone']='' ?>">
	</li>
	<li><label for="login">Login</label> <input type="text" size="50" name="login" value="<?php echo $_POST['login']='' ?>">
	</li>
	<li><label for="senha">Senha:</label> <input type="password" size="25" name="senha" id="senha" value="<?php echo $_POST['senha']='' ?>">
	</li>
	<li><label for="senhaconf">Repita a senha:</label><input type="password" size="25" id="senha" name="senhaconf" value="<?php echo $_POST['senhaconf']='' ?>"></li>	
	<li><label for="tipo">Tipo de usuário:</label> <select name="tipo">
		<option></option>
		<option>administrador</option>
		<option>dono de loja</option>
		<option>dono de propaganda</option>
		<option>dono de carro</option>
	</select></li>
	<li class="center"><input type="button"
		onclick="location.href='?m=usuarios&t=listar'" value="Cancelar" /> <input
		type="submit" name="cadastrar" value="Salvar dados" /></li>
</ul>
</fieldset>
</form>
<?php 
		break;

	case 'listar':
			echo '<h2>Usuários cadastrados</h2>';
			loadCss('data_table',NULL,TRUE);
			loadJs('jquery_datatables');
			?>
			<script type="text/javascript">
				$(document).ready(function(){
					$('#listausers').dataTable({
					"oLanguage":{
						"sLengthMenu": "Mostrar _MENU_ elementos por página",
						"sZeroRecords": "Nenhum dado encontrado para exibição",
						"sInfo": "Mostrando _START_ a _END_ de _TOTAL_ de registros",
						"sInfoEmpty": "Nenhum registro para ser exibido",
						"sInfoFiltered": "(filtrado de _MAX_ registros no total)",
						"sSearch": "Pesquisar"
					}, 
						"sSrollY": "400px",
						"bPaginatc": false,
						"aaSorting": [[0, "asc"]]
					});
				});
			</script>
			<table cellspacing="0" cellpadding="0" border="0" class="display" id="listausers">
				 <thead>
				  <tr>
				    <th>Nome</th>
				    <th>Email</th>
				    <th>Login</th>
				    <th>Telefone</th>
				    <th>Tipo</th>
				    <th>Cadastrado</th>
				    <th>Validade</th>
				    <th>Ativo</th>
				    <th>Ações</th>
				  </tr>
				  </thead>
				  
				  <tbody>
					<?php 
						$user = new usuarioAdmin();
						$user->seleciona_tudo($user);
						while($resp = $user->retorna_dados()):
						
							if($resp->tipo == 'administrador')$link = '<a href="?m=usuarios&t=incluir" title="Novo cadastro"><img src="img/plus.png" alt="Novo cadastro" /></a> ';
							if($resp->tipo == 'dono de carro')$link = '<a href="?m=veiculos&t=incluir&user_id='.$resp->id.'&q=usu" title="Novo carro"><img src="img/car.png" alt="Novo carro" /></a> ';
							if($resp->tipo == 'dono de loja'):
								$link = '<a href="?m=veiculos&t=incluir&user_id='.$resp->id.'&q=loja" title="Novo carro na loja"><img src="img/car.png" alt="Novo carro na loja" /></a> '.
										'<a href="?m=lojas&t=incluir&user_id='.$resp->id.'" title="Nova loja"><img src="img/shop.png" alt="Nova loja" /></a>';
							endif;	
							if($resp->tipo == 'dono de propaganda')$link = '<a href="?m=prop&t=incluir&user_id='.$resp->id.'" title="Novo anuncio"><img src="img/anuncio.png" alt="Novo anuncio" /></a> ';
							echo '<tr>'; 
								printf('<td class="center">%s</td>',$resp->nome);
								printf('<td class="center">%s</td>',$resp->email);
								printf('<td class="center">%s</td>',$resp->login);
								printf('<td class="center">%s</td>',$resp->telefone);
								printf('<td class="center">%s</td>',$resp->tipo);
								printf('<td class="center">%s</td>',date("d/m/Y"),strtotime($resp->data_cadastro));
								printf('<td class="center">%s</td>',$resp->validade);
								printf('<td class="center">%s</td>',$resp->ativo);
								printf('
								<td class="center">
									<div>'
										.$link.
										'<a href="?m=usuarios&t=editar&id=%s" title="Editar"><img src="img/edit.png" alt="Editar" /></a> 
										<a href="?m=usuarios&t=senha&id=%s" title="Alterar senha"><img src="img/pass.png" alt="Alterar senha" /></a>
										<a href="?m=usuarios&t=excluir&id=%s" title="Excluir"><img src="img/cancel.png" alt="Excluir" /></a>
									</div>
								</td>',$resp->id,$resp->id,$resp->id);
							echo '</tr>';
							
						endwhile;
					?>
				  </tbody>
				</table>

			<?php 
		break;

	case 'editar':
			echo '<h2>Edição de usuários</h2>';
			$sessao = new sessao();
			if(isAdmin() == TRUE || $sessao->getVar('id_user') == $_GET['id']):
				if(isset($_GET['id'])):
					$id = $_GET['id'];
					if(isset($_POST['editar'])):
						$user_bd = new usuarioAdmin(array(
							'nome' =>$_POST['nome'],
							'email' =>$_POST['email'],
							'validade' =>$_POST['validade'],	
							'telefone' =>$_POST['telefone'],
							'tipo' =>$_POST['tipo'],
							'ativo' =>($_POST['ativo']=='on') ? 's' : 'n',
						));
						$user_bd->valor_pk = $id;
						$user_bd->extras_select =  " WHERE id=$id";
						$user_bd->seleciona_tudo($user_bd);
						$resp = $user_bd->retorna_dados();
						if(isset($duplicado) != TRUE):
							$user_bd->atualizar($user_bd);
							if($user_bd->linhas_afetadas == 1):
								printMsg('Dados alterados com sucesso. <a href="?m=usuarios&t=listar">Exibir cadastros</a>');
								unset($_POST);
							else:
								printMsg('Nenhum dado foi alterado. <a href="?m=usuarios&t=listar">Exibir cadastros</a>','alerta');	
							endif;
						endif;
					endif;
					
					$user_edit = new usuarioAdmin();
					$user_edit->extras_select = " WHERE id=$id";
					$user_edit->seleciona_tudo($user_edit);
					$resp_edit = $user_edit->retorna_dados();
				else:
					printMsg('Usuário não definido, <a href="m=usuario&t=listar">Escolha um usuário para alterar</a>','erro');
				endif;
				?>
				
				<script type="text/javascript">
				$(document).ready(function(){
					$(".userForm").validate({
						rules:{
							nome:{required:true, minlength:3},
							telefone:{required:true, rangelength:[10,20]},
							tipo:{required:true, tipo:true}
						}
					});
				});
				</script>
				<form class="userForm" method="post" action="">
				<fieldset><legend>Informe os dados para o alteração</legend>
				<ul>
					<li><label for="nome">Nome:</label> <input type="text" size="50" name="nome" autofocus="autofocus" value="<?php if($user_edit) echo $resp_edit->nome ?>" />
					</li>
					<li><label for="email">Email:</label> <input type="text" size="50" name="email" value="<?php if($user_edit) echo $resp_edit->email ?>" />
					</li>
					<li><label for="validade">Validade:</label> <input type="text" size="50" name="validade" value="<?php if($user_edit) echo $resp_edit->validade ?>" />
					</li>
					<li><label for="telefone">Telefone:</label> <input type="text" size="50" name="telefone" value="<?php if($user_edit) echo $resp_edit->telefone ?>" />
					</li>
					<li><label for="login">Login</label> <input type="text" disabled="disabled" size="50" name="login" value="<?php if($user_edit) echo $resp_edit->login ?>">
					</li>
					<li><label for="ativo">Ativo:</label> <input type="checkbox" name="ativo" <?php if($resp_edit->ativo == 's') echo 'checked = "checked"'; ?>" />
					</li>	
					<li><label for="tipo">Tipo de usuário:</label> <select name="tipo">
						<option><?php if($user_edit) echo $resp_edit->tipo?></option>
						<option>administrador</option>
						<option>dono de loja</option>
						<option>dono de propaganda</option>
						<option>dono de carro</option>
					</select></li>
					<li class="center"><input type="button"
						onclick="location.href='?m=usuarios&t=listar'" value="Cancelar" /> <input
						type="submit" name="editar" value="Salvar alterações" /></li>
				</ul>
				</fieldset>
				</form>
				
			<?php 
			else:
				printMsg('Você não tem permissão para acessar esta página. <a href="#" onclik="history.back()">Voltar</a>','erro');
			endif;	
		break;	
				
	case 'senha':
			echo '<h2>Edição de senha</h2>';
			$sessao = new sessao();
			if(isAdmin() == TRUE || $sessao->getVar('id_user') == $_GET['id']):
				if(isset($_GET['id'])):
					$id = $_GET['id'];
					if(isset($_POST['mudasenha'])):
						$user_bd = new usuarioAdmin(array(
							'senha'=>codificarSenha($_POST['senha']),
						));
						$user_bd->valor_pk = $id;
						$user_bd->extras_select =  " WHERE id=$id";
						$user_bd->seleciona_tudo($user_bd);
						$resp = $user_bd->retorna_dados();
					
						$user_bd->atualizar($user_bd);
						if($user_bd->linhas_afetadas == 1):
							printMsg('Senha alterada com sucesso. <a href="?m=usuarios&t=listar">Exibir cadastros</a>');
							unset($_POST);
						else:
							printMsg('Nenhum dado foi alterado. <a href="?m=usuarios&t=listar">Exibir cadastros</a>','alerta');	
						endif;
					endif;
					
					$user_edit = new usuarioAdmin();
					$user_edit->extras_select = " WHERE id=$id";
					$user_edit->seleciona_tudo($user_edit);
					$resp_edit = $user_edit->retorna_dados();
				else:
					printMsg('Usuário não definido, <a href="m=usuario&t=listar">Escolha um usuário para alterar</a>','erro');
				endif;
				?>
				
				<script type="text/javascript">
				$(document).ready(function(){
					$(".userForm").validate({
						rules:{
							login:{required:true, minlength:5},
							senha:{required:true, rangelength:[4,10]},
							senhaconf:{required:true,equalTo:"#senha"}
						}
					});
				});
				</script>
				<form class="userForm" method="post" action="">
				<fieldset><legend>Informe os dados para o alteração</legend>
				<ul>
					<li><label for="nome">Nome:</label> <input type="text" disabled="disabled" size="50" name="nome" value="<?php if($user_edit) echo $resp_edit->nome ?>" />
					</li>
					<li><label for="email">Email:</label> <input type="text" disabled="disabled" size="50" name="email" value="<?php if($user_edit) echo $resp_edit->email ?>" />
					</li>
					<li><label for="validade">Validade:</label> <input type="text" disabled="disabled" size="50" name="validade" value="<?php if($user_edit) echo $resp_edit->validade ?>" />
					</li>
					<li><label for="telefone">Telefone:</label> <input type="text" disabled="disabled" size="50" name="telefone" value="<?php if($user_edit) echo $resp_edit->telefone ?>" />
					</li>
					<li><label for="login">Login</label> <input type="text" disabled="disabled" size="50" name="login" value="<?php if($user_edit) echo $resp_edit->login ?>">
					</li>
					<li><label for="login">Tipo de usuário</label> <input type="text" disabled="disabled" size="50" name="login" value="<?php if($user_edit) echo $resp_edit->tipo ?>">
					</li>
					<li><label for="senha">Senha:</label> <input type="password" size="25" name="senha" autofocus="autofocus" id="senha" value="<?php echo $_POST['senha']='' ?>">
					</li>
					<li><label for="senhaconf">Repita a senha:</label><input type="password" size="25" id="senha" name="senhaconf" value="<?php echo $_POST['senhaconf']='' ?>"></li>	

					<li class="center"><input type="button"
						onclick="location.href='?m=usuarios&t=listar'" value="Cancelar" /> <input
						type="submit" name="mudasenha" value="Salvar alterações" /></li>
				</ul>
				</fieldset>
				</form>
				
			<?php 
			else:
				printMsg('Você não tem permissão para acessar esta página. <a href="#" onclik="history.back()">Voltar</a>','erro');
			endif;	
		break;
		
	case 'excluir':
			echo '<h2>Exclusão de usuários</h2>';
			$sessao = new sessao();
			if(isAdmin() == TRUE):
				if(isset($_GET['id'])):
					$id = $_GET['id'];
					if(isset($_POST['excluir'])):
						$user_depn = new usuarioAdmin();
						$user_depn->extras_select = " WHERE id=$id";
						$user_depn->seleciona_tudo($user_depn);
						$resp_depn = $user_depn->retorna_dados();

						if(isset($resp_depn->tipo)):
							$tipo = $resp_depn->tipo;
						else:
							$tipo = NULL;
						endif;	
						apagarDependencias($tipo, $id);
						
						$user_bd = new usuarioAdmin(array());
						$user_bd->valor_pk = $id;
					
						$user_bd->deletar($user_bd);
						
						if($user_bd->linhas_afetadas == 1):
							printMsg('Registro excluido com sucesso. <a href="?m=usuarios&t=listar">Exibir cadastros</a>');
							unset($_POST);
						else:
							printMsg('Nenhum registro foi excluido. <a href="?m=usuarios&t=listar">Exibir cadastros</a>','alerta');	
						endif;
					endif;
					
					$user_edit = new usuarioAdmin();
					$user_edit->extras_select = " WHERE id=$id";
					$user_edit->seleciona_tudo($user_edit);
					$resp_edit = $user_edit->retorna_dados();
					
				else:
					printMsg('Usuário não definido, <a href="m=usuario&t=listar">Escolha um usuário para excluir</a>','erro');
				endif;
				?>
				<form class="userForm" method="post" action="">
				<fieldset><legend>Confira os dados para exclusão</legend>
				<p class="alerta">OBS: Um usuário excluido apagará todas as suas dependências. Caso ele seje um dono de loja ou propagandas, ambas serão apagadas
				conforme o tipo de cliente.</p>
				<ul>
					<li><label for="nome">Nome:</label> <input type="text" disabled="disabled" size="50" name="nome" value="<?php if(isset($resp_edit->nome)) echo $resp_edit->nome ?>" />
					</li>
					<li><label for="email">Email:</label> <input type="text" disabled="disabled" size="50" name="email" value="<?php if(isset($resp_edit->email)) echo $resp_edit->email ?>" />
					</li>
					<li><label for="validade">Validade:</label> <input type="text" disabled="disabled" size="50" name="validade" value="<?php if(isset($resp_edit->validade)) echo $resp_edit->validade ?>" />
					</li>
					<li><label for="telefone">Telefone:</label> <input type="text" disabled="disabled" size="50" name="telefone" value="<?php if(isset($resp_edit->telefone)) echo $resp_edit->telefone ?>" />
					</li>
					<li><label for="login">Login</label> <input type="text" disabled="disabled" size="50" name="login" value="<?php if(isset($resp_edit->login)) echo $resp_edit->login ?>">
					</li>
					<li><label for="ativo">Ativo:</label> <input type="checkbox" name="ativo" disabled="disabled" <?php if(isset($resp_edit->ativo) && $resp_edit->ativo == 's') echo 'checked = "checked"'; ?>" />
					</li>	
					<li><label for="login">Tipo de usuário</label> <input type="text" disabled="disabled" size="50" name="login" value="<?php if(isset($resp_edit->tipo)) echo $resp_edit->tipo ?>">
					</li>
					<li class="center"><input type="button"
						onclick="location.href='?m=usuarios&t=listar'" value="Cancelar" /> <input
						type="submit" name="excluir" value="Confirmar exclusão" /></li>
				</ul>
				</fieldset>
				</form>
				
			<?php 
			else:
				printMsg('Você não tem permissão para acessar esta página. <a href="#" onclik="history.back()">Voltar</a>','erro');
			endif;	
		break;
			
	default:
			echo '<p>A tela solicitada não existe.</p>';
		break;
endswitch;
?>