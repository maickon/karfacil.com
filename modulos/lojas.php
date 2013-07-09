<?php
require_once(dirname(dirname(__FILE__))."/funcoes.php");
// echo basename(__FILE__); retorna o nome do arquivo
loadJs('jquery_validate');
loadJs('jquery_validate_messages');
loadJs('geral');
protegeArquivo(basename(__FILE__));
switch ($tela):
	case 'incluir':
		if(isset($_POST['cadastrar'])):
			$l = new usuarioDonoLoja(array(
				"nome" 			=> $_POST['login']
				));
			$l->extras_select = " WHERE login='".$_POST['login']."'";
			$l->seleciona_tudo($l);
			$resp = $l->retorna_dados();
			if($resp):
				$dono_id = $resp->id;
			else:
				$dono_id = '';
			endif;		
			$loja = new objLojas(array(
				"dono_id"		=> $dono_id,
				"nome" 			=> $_POST['nome'],
				"bairro"		=> $_POST['bairro'],
				"numero"		=> $_POST['numero'],
				"cep"			=> $_POST['cep'],
				"CNPJ"			=> $_POST['CNPJ'],
				"cidade"		=> $_POST['cidade'],
				"estado"		=> $_POST['estados'],
				"telefone_res"	=> $_POST['telefone_res'],
				"telefone_cel"	=> $_POST['telefone_cel'],
				"email"			=> $_POST['email'],
				"logo"			=> preparar_nome($_FILES['logo']),
				"loja_foto"		=> preparar_nome($_FILES['loja_foto']),
			));
			if($loja->lojaJaExiste('nome',$_POST['nome'])):
				printMsg('Este nome ja está cadastrado, escolha outro nome para sua loja.','erro');
				$duplicado = TRUE;
			else:
				$duplicado = FALSE;
			endif;
			if($loja->lojaJaExiste('CNPJ',$_POST['CNPJ'])):
				printMsg('Este CNPJ ja está cadastrado, escolha outro CNPJ.','erro');
				$duplicado = TRUE;
			else:
				$duplicado = FALSE;
			endif;
			if($duplicado != TRUE):
				$loja->inserir($loja);
				if($loja->linhas_afetadas == 1):
					printMsg('Dados inserido com sucesso <a href="'.ADMURL.'?m=lojas&t=listar">Exibir cadastros</a>');
					unset($_POST);
				endif;
				if($loja->getValor('nome')):
					criar_diretorio_loja($loja->getValor('nome'));
					if((dirname(__FILE__)."img_lojas/".$loja->getValor('nome'))):
						printMsg('Uma pasta para a loja '.$loja->getValor('nome').', foi criada com sucesso.');
					endif;
					upload_mestre($loja->getValor('nome'),$_FILES['logo'],$loja->getValor('nome'),$loja->getValor('logo'),'img_lojas',200);
					upload_mestre($loja->getValor('nome'),$_FILES['loja_foto'],$loja->getValor('nome'),$loja->getValor('loja_foto'),'img_lojas',500);
				else:
					printMsg('Pasta não pode ser criada, pois o nome não foi definido','erro');
				endif;
			endif;	
		endif;
	?>
	<script type="text/javascript">
				$(document).ready(function(){
					$(".userForm").validate({
						rules:{
							loja_nome:{required:true},
							nome:{required:true},
							bairro:{required:true},
							numero:{required:true},
							cep:{required:true},
							CNPJ:{required:true},
							cidade:{required:true},
							estados:{required:true},
							telefone_res:{required:true,rangelength:[6,14]},
							telefone_cel:{required:true,rangelength:[6,14]},
							email:{required:true, email:true},
							logo:{required:true},
							loja_foto:{required:true}
						}
					});
				});
			</script>
			<form class="userForm" method="post" action="" enctype="multipart/form-data">
				<fieldset><legend>Informe os dados para cadastrar uma loja.</legend>
				<ul>
					<?php 
						$usuarios = new usuarioDonoLoja();
						if(isset($_GET['user_id'])):
							$usuarios->extras_select = " WHERE id=".$_GET['user_id'];
							$usuarios->seleciona_tudo($usuarios);
							$usu = $usuarios->retorna_dados();
					?>
						<li><label for="login">Dono da loja:</label> <select name="login" autofocus="autofocus">
							<option><?php echo $usu->login; ?></option>
						</select></li>
					<?php 				
						else:
					?>
						<li><label for="login">Dono da loja:</label> <select name="login" autofocus="autofocus">
							<option></option>
					<?php 
							$usuarios->extras_select = " WHERE tipo='dono de loja'";
							$usuarios->seleciona_tudo($usuarios);
							while($resp = $usuarios->retorna_dados()):
								echo '<option>'.$resp->login.'</option>';
							endwhile;
						endif; 
					?>	
					</select></li>
					<li><label for="nome">Nome:</label> <input type="text" size="50" name="nome" value="<?php echo $_POST['nome']='' ?>">
					</li>
					<li><label for="bairro">Bairro:</label> <input type="text" size="50" name="bairro" value="<?php echo $_POST['bairro']='' ?>">
					</li>
					<li><label for="numero">Número:</label> <input type="text" size="50" name="numero" value="<?php echo $_POST['numero']='' ?>">
					</li>
					<li><label for="cep">Cep:</label> <input type="text" size="25" name="cep" value="<?php echo $_POST['cep']='' ?>">
					</li>
					<li><label for="CNPJ">CNPJ:</label> <input type="text" size="25" name="CNPJ" value="<?php echo $_POST['cnpj']='' ?>">
					</li>
					<li><label for="cidade">Cidade:</label> <input type="text" size="25" name="cidade" value="<?php echo $_POST['cidade']='' ?>">
					</li>
					<li><label for="estados">Estado:</label> <select name="estados">
							<OPTION VALUE="RJ">RJ</OPTION>
							<OPTION VALUE="AL">AL</OPTION>
							<OPTION VALUE="AM">AM</OPTION>
							<OPTION VALUE="AP">AP</OPTION>
							<OPTION VALUE="BA">BA</OPTION>
							<OPTION VALUE="CE">CE</OPTION>
							<OPTION VALUE="DF">DF</OPTION>
							<OPTION VALUE="ES">ES</OPTION>
							<OPTION VALUE="GO">GO</OPTION>
							<OPTION VALUE="MA">MA</OPTION>
							<OPTION VALUE="MG">MG</OPTION>
							<OPTION VALUE="MS">MS</OPTION>
							<OPTION VALUE="MT">MT</OPTION>
							<OPTION VALUE="PA">PA</OPTION>
							<OPTION VALUE="PB">PB</OPTION>
							<OPTION VALUE="PE">PE</OPTION>
							<OPTION VALUE="PI">PI</OPTION>
							<OPTION VALUE="PR">PR</OPTION>
							<OPTION VALUE="RO">RN</OPTION>
							<OPTION VALUE="RR">RR</OPTION>
							<OPTION VALUE="RS">RS</OPTION>
							<OPTION VALUE="SC">SC</OPTION>
							<OPTION VALUE="SE">SE</OPTION>
							<OPTION VALUE="SP">SP</OPTION>
							<OPTION VALUE="TO">TO</OPTION>
							</SELECT></li>
					<li><label for="telefone_res">Tel Residencial:</label> <input type="text" id="telefone_res" size="25" name="telefone_res" value="<?php echo $_POST['telefone_res']='' ?>">
					</li>
					<li><label for="telefone_cel">Tel Celular:</label> <input type="text" id="telefone_cel" size="25" name="telefone_cel" value="<?php echo $_POST['telefone_cel']='' ?>">
					</li>
					<li><label for="email">Email:</label> <input type="text" id="email" size="25" name="email" value="<?php echo $_POST['email']='' ?>">
					</li>
					<li><label for="logo">Logomarca:</label> <input type="file" size="25" name="logo" value="<?php echo $_POST['logo']='' ?>">
					</li>
					<li><label for="loja_foto">Imagem loja:</label> <input type="file" size="25" name="loja_foto" value="<?php echo $_POST['loja_foto']='' ?>">
					</li>
					<li class="center"><input type="button"
						onclick="location.href='?m=lojas&t=listar'" value="Cancelar" /> <input
						type="submit" name="cadastrar" value="Salvar dados" /></li>
				</ul>
				</fieldset>
			</form>
	<?php 
	break;	
	
	case 'listar':
		echo '<h2>Lojas cadastradas</h2>';
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
					    <th>Dono </th>
					    <th>Loja</th>
					    <th>Email</th>
					    <th>T.Celular</th>
					    <th>Bairro</th>
					    <th>Número</th>
					    <th>Cep</th>
					    <th>CNPJ</th>
					    <th>Cidade</th>
					    <th>Estado</th>
					   	<!-- <th>Residencial</th> -->
					    <th>Ações</th>
					  </tr>
					  </thead>
					  
					  <tbody>
						<?php 
							$lojas = new objLojas();
							$lojas->seleciona_tudo($lojas);
		
							while($resp = $lojas->retorna_dados()):
								$nome = new usuarioDonoPropaganda();
								$nome->extras_select = " WHERE id=".$resp->dono_id;
								$nome->seleciona_tudo($nome);
								$dono_login = $nome->retorna_dados();
								echo '<tr>'; 
									printf('<td class="center">%s</td>',$dono_login->login);
									printf('<td class="center">%s</td>',$resp->nome);
									printf('<td class="center">%s</td>',$resp->email);
									printf('<td class="center">%s</td>',$resp->telefone_cel);
									printf('<td class="center">%s</td>',$resp->bairro);
									printf('<td class="center">%s</td>',$resp->numero);
									printf('<td class="center">%s</td>',$resp->cep);
									printf('<td class="center">%s</td>',$resp->CNPJ);
									printf('<td class="center">%s</td>',$resp->cidade);
									printf('<td class="center">%s</td>',$resp->estado);
									//printf('<td class="center">%s</td>',$resp->telefone_res);
									
									printf('
									<td class="center">
										<div>
											<a href="?m=lojas&t=incluir&id=%s" title="Novo cadastro"><img src="img/plus.png" alt="Novo cadastro" /></a>
											<a href="?m=veiculos_loja&t=incluir&user_id='.$resp->dono_id.'" title="Novo carro na loja"><img src="img/car.png" alt="Novo carro na loja" /></a>
											<a href="?m=lojas&t=editar&id=%s" title="Editar"><img src="img/edit.png" alt="Editar" /></a> 
											<a href="?m=lojas&t=excluir&id=%s" title="Excluir"><img src="img/cancel.png" alt="Excluir" /></a>
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
		echo '<h2>Edição de lojas</h2>'; 
		$sessao = new sessao();
		$atualizar_file = FALSE;
		$B_LOGO = NULL;
		$B_LOJAFOTO = NULL;
		$B_NOME = NULL;
			if(isAdmin() == TRUE || $sessao->getVar('id_user') == $_GET['id']):
				if(isset($_GET['id'])):
					$id = $_GET['id'];
			
					if(isset($_POST['editar'])):
						$l = new usuarioDonoLoja(array(
							"nome" 			=> $_POST['login']
							));
						$l->extras_select = " WHERE login='".$_POST['login']."'";
						$l->seleciona_tudo($l);
						$resp = $l->retorna_dados();
						if($resp):
							$dono_id = $resp->id;
						else:
							$dono_id = '';
						endif;	
						$loja_bd = new objLojas(array(
							"dono_id"		=> $dono_id,
							"nome" 			=> $_POST['nome'],
							"bairro"		=> $_POST['bairro'],
							"numero"		=> $_POST['numero'],
							"cep"			=> $_POST['cep'],
							"CNPJ"			=> $_POST['CNPJ'],
							"cidade"		=> $_POST['cidade'],
							"estado"		=> $_POST['estados'],
							"telefone_res"	=> $_POST['telefone_res'],
							"telefone_cel"	=> $_POST['telefone_cel'],
							"email"			=> $_POST['email'],
							"logo"			=> preparar_nome($_FILES['logo']),
							"loja_foto"		=> preparar_nome($_FILES['loja_foto']),
						));
						
						$loja_bd->valor_pk = $id;
						$loja_bd->extras_select =  " WHERE id=$id";
						$loja_bd->seleciona_tudo($loja_bd);
						$resp = $loja_bd->retorna_dados();
						
						if($resp->nome != $_POST['nome']):
							if($loja_bd->lojaJaExiste('nome',$_POST['nome'])):
								printMsg('Esta loja ja existe no sistema, escolha outro nome para sua loja.','erro');
								$duplicado = TRUE;
							endif;
						endif;
						if($resp->CNPJ != $_POST['CNPJ']):
							if($loja_bd->lojaJaExiste('CNPJ',$_POST['CNPJ'])):
								printMsg('Este CNPJ ja existe no sistema, escolha outro CNPJ.','erro');
								$duplicado = TRUE;
							endif;
						endif;
						if(isset($duplicado) != TRUE):
							$loja_bufer = new objLojas();
							$loja_bufer->extras_select = " WHERE id=$id";
							$loja_bufer->seleciona_tudo($loja_bufer);
							$loja_bufer_r = $loja_bufer->retorna_dados();
							$B_NOME = $loja_bufer_r->nome;
							$B_LOGO = $loja_bufer_r->logo;
							$B_LOJAFOTO = $loja_bufer_r->loja_foto;
							$loja_bd->atualizar($loja_bd);
							$atualizar_file = TRUE;
							if($loja_bd->linhas_afetadas == 1):
								printMsg('Dados alterados com sucesso. <a href="?m=lojas&t=listar">Exibir cadastros</a>');
								unset($_POST);
							else:
								printMsg('Nenhum dado foi alterado. <a href="?m=lojas&t=listar">Exibir cadastros</a>','alerta');	
							endif;
						endif;	
					endif;	
				$loja_edit = new objLojas();
				$loja_edit->extras_select = " WHERE id=$id";
				$loja_edit->seleciona_tudo($loja_edit);
				$loja_resp = $loja_edit->retorna_dados();
				if($atualizar_file == TRUE):
					if($B_NOME):
						$dir_old = IMGLOJASPATH.$B_NOME;
						$dir_new = IMGLOJASPATH.$loja_bd->getValor('nome');
						rename($dir_old, $dir_new);
												
						$dir_logo = $dir_new.'/'.$B_LOGO;
						$dir_foto = $dir_new.'/'.$B_LOJAFOTO;
						apaga_diretorio($dir_logo);
						apaga_diretorio($dir_foto);
						upload_mestre($loja_bd->getValor('nome'),$_FILES['logo'],$loja_bd->getValor('nome'),$loja_bd->getValor('logo'),'img_lojas',200);
						upload_mestre($loja_bd->getValor('nome'),$_FILES['loja_foto'],$loja_bd->getValor('nome'),$loja_bd->getValor('loja_foto'),'img_lojas',500);
					else:
						printMsg('Pasta não pode ser criada, pois o nome não foi definido','erro');
					endif;
				endif;
				$l = new usuarioDonoLoja(array(
						"nome" 			=> $loja_resp->dono_id
						));
				$l->retornarUsuarioLogin($l->getValor('nome'));
				$resp = $l->retorna_dados();			
			else:
				printMsg('Veículo não definido, <a href="m=lojas&t=listar">Escolha um veículo para alterar</a>','erro');
			endif;
	?>
	<script type="text/javascript">
				$(document).ready(function(){
					$(".userForm").validate({
						rules:{
							loja_nome:{required:true},
							nome:{required:true},
							bairro:{required:true},
							numero:{required:true},
							cep:{required:true},
							CNPJ:{required:true},
							cidade:{required:true},
							estados:{required:true},
							telefone_res:{required:true,rangelength:[6,14]},
							telefone_cel:{required:true,rangelength:[6,14]},
							email:{required:true, email:true},
							logo:{required:true},
							loja_foto:{required:true}
						}
					});
				});
			</script>
			<form class="userForm" method="post" action="" enctype="multipart/form-data">
				<fieldset><legend>Editando uma loja.</legend>
				<ul>
					<?php 
						$usuarios = new usuarioDonoLoja();
						if(isset($_GET['user_id'])):
							$usuarios->extras_select = " WHERE id=".$_GET['user_id'];
							$usuarios->seleciona_tudo($usuarios);
							$usu = $usuarios->retorna_dados();
					?>
						<li><label for="login">Dono da loja:</label> <select name="login" autofocus="autofocus">
							<option><?php echo $usu->login; ?></option>
						</select></li>
					<?php 				
						else:
					?>
						<li><label for="login">Dono da loja:</label> <select name="login" autofocus="autofocus">
							<option><?php echo $resp->login; ?></option>
					<?php 
							$usuarios->extras_select = " WHERE tipo='dono de loja'";
							$usuarios->seleciona_tudo($usuarios);
							while($resp = $usuarios->retorna_dados()):
								echo '<option>'.$resp->login.'</option>';
							endwhile;
						endif; 
					?>	
					</select></li>
					<li><label for="nome">Nome:</label> <input type="text" size="50" name="nome" value="<?php if($loja_resp) echo $loja_resp->nome ?>">
					</li>
					<li><label for="bairro">Bairro:</label> <input type="text" size="50" name="bairro" value="<?php if($loja_resp) echo $loja_resp->bairro ?>">
					</li>
					<li><label for="numero">Número:</label> <input type="text" size="50" name="numero" value="<?php if($loja_resp) echo $loja_resp->numero ?>">
					</li>
					<li><label for="cep">Cep:</label> <input type="text" size="25" name="cep" value="<?php if($loja_resp) echo $loja_resp->cep ?>">
					</li>
					<li><label for="CNPJ">CNPJ:</label> <input type="text" size="25" name="CNPJ" value="<?php if($loja_resp) echo $loja_resp->CNPJ ?>">
					</li>
					<li><label for="cidade">Cidade:</label> <input type="text" size="25" name="cidade" value="<?php if($loja_resp) echo $loja_resp->cidade ?>">
					</li>
					<li><label for="estados">Estado:</label> <select name="estados">
							<OPTION VALUE="<?php if($loja_resp) echo $loja_resp->estado ?>"><?php if($loja_resp) echo $loja_resp->estado ?></OPTION>
							<OPTION VALUE="AL">AL</OPTION>
							<OPTION VALUE="AM">AM</OPTION>
							<OPTION VALUE="AP">AP</OPTION>
							<OPTION VALUE="BA">BA</OPTION>
							<OPTION VALUE="CE">CE</OPTION>
							<OPTION VALUE="DF">DF</OPTION>
							<OPTION VALUE="ES">ES</OPTION>
							<OPTION VALUE="GO">GO</OPTION>
							<OPTION VALUE="MA">MA</OPTION>
							<OPTION VALUE="MG">MG</OPTION>
							<OPTION VALUE="MS">MS</OPTION>
							<OPTION VALUE="MT">MT</OPTION>
							<OPTION VALUE="PA">PA</OPTION>
							<OPTION VALUE="PB">PB</OPTION>
							<OPTION VALUE="PE">PE</OPTION>
							<OPTION VALUE="PI">PI</OPTION>
							<OPTION VALUE="PR">PR</OPTION>
							<OPTION VALUE="RO">RN</OPTION>
							<OPTION VALUE="RR">RR</OPTION>
							<OPTION VALUE="RS">RS</OPTION>
							<OPTION VALUE="SC">SC</OPTION>
							<OPTION VALUE="SE">SE</OPTION>
							<OPTION VALUE="SP">SP</OPTION>
							<OPTION VALUE="TO">TO</OPTION>
							</SELECT></li>
					<li><label for="telefone_res">Tel Residencial:</label> <input type="text" id="telefone_res" size="25" name="telefone_res" value="<?php if($loja_resp) echo $loja_resp->telefone_res ?>">
					</li>
					<li><label for="telefone_cel">Tel Celular:</label> <input type="text" id="telefone_cel" size="25" name="telefone_cel" value="<?php if($loja_resp) echo $loja_resp->telefone_cel ?>">
					</li>
					<li><label for="email">Email:</label> <input type="text" id="email" size="25" name="email" value="<?php if($loja_resp) echo $loja_resp->email ?>">
					</li>
					<li><label for="logo">Logomarca:</label> <input type="file" size="25" name="logo" value="<?php if($loja_resp) echo $loja_resp->logo ?>">
					</li>
					<li><label for="loja_foto">Imagem loja:</label> <input type="file" size="25" name="loja_foto" value="<?php if($loja_resp) echo $loja_resp->loja_foto ?>">
					</li>
					<li class="center"><input type="button"
						onclick="location.href='?m=lojas&t=listar'" value="Cancelar" /> <input
						type="submit" name="editar" value="Editar dados" /></li>
				</ul>
				</fieldset>
			</form>
	<?php 
		else:
			printMsg('Você não tem permissão para acessar esta página. <a href="#" onclik="history.back()">Voltar</a>','erro');
		endif;
	break;	
	
	case 'excluir':
		echo '<h2>Exclusão de loja</h2>'; 
		$sessao = new sessao();
		$B_NOME = NULL;
		$delete_file = FALSE;
			if(isAdmin() == TRUE || $sessao->getVar('id_user') == $_GET['id']):
				if(isset($_GET['id'])):
					$id = $_GET['id'];
			
					if(isset($_POST['excluir'])):	
						$loja_bd = new objLojas(array());						
						$loja_bd->valor_pk = $id;
						$loja_bd->extras_select =  " WHERE id=$id";
						$loja_bd->seleciona_tudo($loja_bd);
						$resp = $loja_bd->retorna_dados();	
						$B_NOME = $resp->nome;	
						$loja_bd->deletar($loja_bd);
						$delete_file = TRUE;
						if($loja_bd->linhas_afetadas == 1):
							printMsg('Dados excluidos com sucesso. <a href="?m=lojas&t=listar">Exibir cadastros</a>');
							unset($_POST);
						else:
							printMsg('Nenhum dado foi alterado. <a href="?m=lojas&t=listar">Exibir cadastros</a>','alerta');	
						endif;
							
					endif;	
					
				$loja_edit = new objLojas();
				$loja_edit->extras_select = " WHERE id=$id";
				$loja_edit->seleciona_tudo($loja_edit);
				$loja_resp = $loja_edit->retorna_dados();
				if(isset($loja_resp->dono_id)):
						$nome = $loja_resp->dono_id;
					else:
						$nome = '';
					endif; 	
				$l = new usuarioDonoLoja(array(
						"nome" 			=> $nome
						));
				$l->retornarUsuarioLogin($l->getValor('nome'));
				$resp = $l->retorna_dados();	

				if($delete_file == TRUE):
					if($B_NOME):
						$dir = 'img_lojas/'.$B_NOME;
						apaga_diretorio($dir);
					else:
						printMsg('Ocorreu um erro no caminho da pasta especificada','erro');		
					endif;	
				endif;
			else:
				printMsg('Loja não definido, <a href="m=lojas&t=listar">Escolha uma loja para deletar</a>','erro');
			endif;
	?>
	<script type="text/javascript">
				$(document).ready(function(){
					$(".userForm").validate({
						rules:{
							loja_nome:{required:true},
							nome:{required:true},
							bairro:{required:true},
							numero:{required:true},
							cep:{required:true},
							CNPJ:{required:true},
							cidade:{required:true},
							estados:{required:true},
							telefone_res:{required:true,rangelength:[8,10]},
							telefone_cel:{required:true,rangelength:[8,10]},
							email:{required:true, email:true},
							logo:{required:true},
							loja_foto:{required:true}
						}
					});
				});
			</script>
			<form class="userForm" method="post" action="">
				<fieldset><legend>Excluir loja.</legend>
				<ul>
					<li><label for="login">Dono da loja:</label> <select name="login" disabled="disabled">
						<option><?php if($resp)echo $resp->login; ?></option>
					<?php 
						$usuarios = new usuarioDonoLoja();
						$usuarios->extras_select = " WHERE tipo='dono de loja'";
						$usuarios->seleciona_tudo($usuarios);
						while($resp = $usuarios->retorna_dados()):
							echo '<option>'.$resp->login.'</option>';
						endwhile;
					?>	
					</select></li>
					<li><label for="nome">Nome:</label> <input type="text" size="50" name="nome" disabled="disabled" value="<?php if($loja_resp) echo $loja_resp->nome ?>">
					</li>
					<li><label for="bairro">Bairro:</label> <input type="text" size="50" name="bairro" disabled="disabled" value="<?php if($loja_resp) echo $loja_resp->bairro ?>">
					</li>
					<li><label for="numero">Número:</label> <input type="text" size="50" name="numero" disabled="disabled" value="<?php if($loja_resp) echo $loja_resp->numero ?>">
					</li>
					<li><label for="cep">Cep:</label> <input type="text" size="25" name="cep" disabled="disabled" value="<?php if($loja_resp) echo $loja_resp->cep ?>">
					</li>
					<li><label for="CNPJ">CNPJ:</label> <input type="text" size="25" name="CNPJ" disabled="disabled" value="<?php if($loja_resp) echo $loja_resp->CNPJ ?>">
					</li>
					<li><label for="cidade">Cidade:</label> <input type="text" size="25" name="cidade" disabled="disabled" value="<?php if($loja_resp) echo $loja_resp->cidade ?>">
					</li>
					<li><label for="estados">Estado:</label> <select name="estados" disabled="disabled">
							<OPTION VALUE="<?php if($loja_resp) echo $loja_resp->estado ?>"><?php if($loja_resp) echo $loja_resp->estado ?></OPTION>
							<OPTION VALUE="AL">AL</OPTION>
							<OPTION VALUE="AM">AM</OPTION>
							<OPTION VALUE="AP">AP</OPTION>
							<OPTION VALUE="BA">BA</OPTION>
							<OPTION VALUE="CE">CE</OPTION>
							<OPTION VALUE="DF">DF</OPTION>
							<OPTION VALUE="ES">ES</OPTION>
							<OPTION VALUE="GO">GO</OPTION>
							<OPTION VALUE="MA">MA</OPTION>
							<OPTION VALUE="MG">MG</OPTION>
							<OPTION VALUE="MS">MS</OPTION>
							<OPTION VALUE="MT">MT</OPTION>
							<OPTION VALUE="PA">PA</OPTION>
							<OPTION VALUE="PB">PB</OPTION>
							<OPTION VALUE="PE">PE</OPTION>
							<OPTION VALUE="PI">PI</OPTION>
							<OPTION VALUE="PR">PR</OPTION>
							<OPTION VALUE="RO">RN</OPTION>
							<OPTION VALUE="RR">RR</OPTION>
							<OPTION VALUE="RS">RS</OPTION>
							<OPTION VALUE="SC">SC</OPTION>
							<OPTION VALUE="SE">SE</OPTION>
							<OPTION VALUE="SP">SP</OPTION>
							<OPTION VALUE="TO">TO</OPTION>
							</SELECT></li>
					<li><label for="telefone_res">Tel Residencial:</label> <input type="text" id="telefone_res" size="25" name="telefone_res" disabled="disabled" value="<?php if($loja_resp) echo $loja_resp->telefone_res ?>">
					</li>
					<li><label for="telefone_cel">Tel Celular:</label> <input type="text" id="telefone_cel" size="25" name="telefone_cel" disabled="disabled" value="<?php if($loja_resp) echo $loja_resp->telefone_cel ?>">
					</li>
					<li><label for="email">Email:</label> <input type="text" id="email" size="25" name="email" disabled="disabled" value="<?php if($loja_resp) echo $loja_resp->email ?>">
					</li>
					<li class="center"><input type="button"
						onclick="location.href='?m=lojas&t=listar'" value="Cancelar" /> <input
						type="submit" name="excluir" value="Confirmar exclusão" /></li>
				</ul>
				</fieldset>
			</form>
	<?php 
		else:
			printMsg('Você não tem permissão para acessar esta página. <a href="#" onclik="history.back()">Voltar</a>','erro');
		endif;
	break;	
endswitch;

?>