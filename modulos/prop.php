<?php
require_once(dirname(dirname(__FILE__))."/funcoes.php");
// echo basename(__FILE__); retorna o nome do arquivo
loadJs('jquery_validate');
loadJs('jquery_validate_messages');
loadJs('geral');
loadJs('../'.CKEDITORPATH.'/ckeditor');
protegeArquivo(basename(__FILE__));
switch ($tela):
	case 'incluir':
		if(isset($_POST['cadastrar'])):
			$p = new usuarioDonoPropaganda(array(
				"tipo" 			=> $_POST['prop_nome']
				));
			$p->retornarPropIndice($p->getValor('tipo'));
			$resp = $p->retorna_dados();
			$propaganda = new objPropagandas(array(
				"dono_id"		=> $resp->id,
				"nome" 			=> $_POST['nome'],
				"tipo"			=> $_POST['tipo'],
				"bairro"		=> $_POST['bairro'],
				"numero"		=> $_POST['numero'],
				"logo"			=> preparar_nome($_FILES['logo']),
				"cep"			=> $_POST['cep'],
				"cidade"		=> $_POST['cidade'],
				"estado"		=> $_POST['estados'],
				"telefone_res"	=> $_POST['telefone_res'],
				"telefone_cel"	=> $_POST['telefone_cel'],
				"email"			=> $_POST['email'],
				"descricao"		=> $_POST['descricao'],
				"img_1"			=> preparar_nome($_FILES['img_1']),
				"img_2"			=> preparar_nome($_FILES['img_2']),
				"img_3"			=> preparar_nome($_FILES['img_3']),
				"img_4"			=> preparar_nome($_FILES['img_4']),
	"propaganda_completa"		=> ($_POST['completa']=='on') ? 's' : 'n',
				
			));
			$propaganda->inserir($propaganda);
			if($propaganda->getValor('nome')):
				criar_diretorio_propagandas($propaganda->getValor('nome'));
				upload_mestre($propaganda->getValor('nome'),$_FILES['logo'],$propaganda->getValor('nome'),$propaganda->getValor('logo'),'propagandas',200);
				upload_mestre($propaganda->getValor('nome'),$_FILES['img_1'],$propaganda->getValor('nome'),$propaganda->getValor('img_1'),'propagandas',500);
				upload_mestre($propaganda->getValor('nome'),$_FILES['img_2'],$propaganda->getValor('nome'),$propaganda->getValor('img_2'),'propagandas',500);
				upload_mestre($propaganda->getValor('nome'),$_FILES['img_3'],$propaganda->getValor('nome'),$propaganda->getValor('img_3'),'propagandas',500);
				upload_mestre($propaganda->getValor('nome'),$_FILES['img_4'],$propaganda->getValor('nome'),$propaganda->getValor('img_4'),'propagandas',500);
				
			else:
				printMsg('Pasta não pode ser criada, pois o nome não foi definido','erro');
			endif;
			if($propaganda->linhas_afetadas == 1):
				printMsg('Dados inserido com sucesso <a href="'.ADMURL.'?m=prop&t=listar">Exibir cadastros</a>');
				unset($_POST);
			endif;			
		endif;	
	?>
	<script type="text/javascript">
				$(document).ready(function(){
					$(".userForm").validate({
						rules:{
							prop_nome:{required:true},
							nome:{required:true},
							tipo:{required:true},
							bairro:{required:true},
							numero:{required:true},
							logo:{required:true},
							cep:{required:true},
							cidade:{required:true},
							estados:{required:true},
							img_1:{required:true},
							img_2:{required:true},
							img_3:{required:true},
							img_4:{required:true}
						}
					});
				});
			</script>
			<form class="userForm" method="post" action="" enctype="multipart/form-data">
				<fieldset><legend>Informe os dados para cadastrar uma propaganda.</legend>
					<ul>
					<?php 
						$usuarios = new usuarioDonoPropaganda();
						if(isset($_GET['user_id'])):
							$usuarios->extras_select = " WHERE id=".$_GET['user_id'];
							$usuarios->seleciona_tudo($usuarios);
							$usu = $usuarios->retorna_dados();
					?>
						<li><label for="loja_nome">Dono da propaganda:</label> <select name="loja_nome" autofocus="autofocus">
							<option><?php echo $usu->nome; ?></option>
						</select></li>
					<?php 				
						else:
					?>
						<li><label for="loja_nome">Dono da propaganda:</label> <select name="prop_nome" autofocus="autofocus">
							<option></option>
					<?php 
							$usuarios->retornarPropagandas();
							while($resp = $usuarios->retorna_dados()):
								echo '<option>'.$resp->nome.'</option>';
							endwhile;
						endif; 
					?>	
					</select></li>
						
					<li><label for="nome">Nome:</label> <input type="text" size="50" name="nome" value="<?php echo $_POST['nome']='' ?>">
					</li>
					<li><label for="tipo">Tipo de propaganda:</label> <select name=tipo>
							<option value="autoescola">Autoescola</option>
							<option value="borracharia">Borracharia</option>
							<option value="autopecas">Autopeças</option>
							<option value="som">Som</option>
							<option value="concerto">Concerto</option>
							<option value="equipamento">Equipamento</option>
							<option value="insufilme">Insufilme</option>
							<option value="posto">Posto</option>
							<option value="ferrovelho">Ferro velho</option>
							<option value="ferrovelho">Táxi</option>
							<option value="variado">variado</option>
							</select></li>
					<li><label for="beirro">Bairro:</label> <input type="text" size="50" name="bairro" value="<?php echo $_POST['bairro']='' ?>">
					</li>
					<li><label for="numero">Número:</label> <input type="text" size="50" name="numero" value="<?php echo $_POST['numero']='' ?>">
					</li>
					<li><label for="logo">Logomarca:</label> <input type="file" id="logo" size="25" name="logo" value="<?php echo $_POST['logo']='' ?>">
					</li>
					<li><label for="cep">Cep:</label> <input type="text" id="cep" size="25" name="cep" value="<?php echo $_POST['cep']='' ?>">
					</li>
					<li><label for="cidade">Cidade:</label> <input type="text" id="cidade" size="25" name="cidade" value="<?php echo $_POST['cidade']='' ?>">
					</li>
					<li><label for="tipo">Estado:</label> <select name="estados">
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
					<li><label for="img_1">1º Imagem:</label> <input type="file" size="50" name="img_1" value="<?php echo $_POST['img_1']='' ?>">
					</li>
					<li><label for="img_2">2º Imagem:</label> <input type="file" size="25" name="img_2" value="<?php echo $_POST['img_2']='' ?>">
					</li>
					<li><label for="img_3">3º Imagem:</label> <input type="file" size="50" name="img_3" value="<?php echo $_POST['img_3']='' ?>">
					</li>
					<li><label for="img_4">4º Imagem:</label> <input type="file" size="50" name="img_4"  value="<?php echo $_POST['img_4']='' ?>">
					</li>
					<li><label for="completa">Propaganda completa?</label> <input type="checkbox" name="completa" >
					</li>
					<br />
					<li>Descricao:
					<label for="descricao"></label> <textarea name="descricao" class="ckeditor" id="editor1" cols="20" rows="5"></textarea>
					</li>
					<li class="center"><input type="button"
						onclick="location.href='?m=prop&t=listar'" value="Cancelar" /> <input
						type="submit" name="cadastrar" value="Salvar dados" /></li>
				</ul>
				</fieldset>
			</form>
	<?php 
	break;	
	
	case 'listar':
			echo '<h2>Propagandas cadastradas</h2>';
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
				    <th>Dono</th>
				    <th>Nome</th>
				    <th>Tipo</th>
				    <th>Cidade</th>
				    <th>Estado</th>
				    <th>Celular</th>
				    <th>Residencial</th>
				    <th>Email</th>
				    <th>Completa</th>
				    <th>Ações</th>
				  </tr>
				  </thead>
				  
				  <tbody>
					<?php 
						$propaganda = new objPropagandas();
						$propaganda->seleciona_tudo($propaganda);
	
						while($resp = $propaganda->retorna_dados()):
							$nome = new usuarioDonoPropaganda();
							$nome->retornarPropagandaNome($resp->dono_id);
							$dono_nome = $nome->retorna_dados();
							echo '<tr>'; 
								printf('<td class="center">%s</td>',$dono_nome->nome);
								printf('<td class="center">%s</td>',$resp->nome);
								printf('<td class="center">%s</td>',$resp->tipo);
								printf('<td class="center">%s</td>',$resp->cidade);
								printf('<td class="center">%s</td>',$resp->estado);
								printf('<td class="center">%s</td>',$resp->telefone_cel);
								printf('<td class="center">%s</td>',$resp->telefone_res);
								printf('<td class="center">%s</td>',$resp->email);
								printf('<td class="center">%s</td>',$resp->propaganda_completa);
								printf('
								<td class="center">
									<div>
										<a href="?m=prop&t=incluir" title="Novo cadastro"><img src="img/plus.png" alt="Novo cadastro" /></a>
										<a href="?m=prop&t=editar&id=%s" title="Editar"><img src="img/edit.png" alt="Editar" /></a> 
										<a href="?m=prop&t=excluir&id=%s" title="Excluir"><img src="img/cancel.png" alt="Excluir" /></a>
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
		echo '<h2>Edição de propagandas</h2>'; 
		$sessao = new sessao();
		$editar_file = FALSE;
		$B_NOME = NULL;
			if(isAdmin() == TRUE || $sessao->getVar('id_user') == $_GET['id']):
				if(isset($_GET['id'])):
					$id = $_GET['id'];
					$p = new usuarioDonoPropaganda(array(
						"nome" 			=> $_POST['prop_nome']
						));
					$p->retornarPropIndice($p->getValor('nome'));
					$resp = $p->retorna_dados();	
					if(isset($_POST['editar'])):
						$propaganda_bd = new objPropagandas(array(
							"dono_id"		=> $resp->id,
							"nome" 			=> $_POST['nome'],
							"tipo" 			=> $_POST['tipo'],
							"bairro"		=> $_POST['bairro'],
							"numero"		=> $_POST['numero'],
							"logo"			=> preparar_nome($_FILES['logo']),
							"cep"			=> $_POST['cep'],
							"cidade"		=> $_POST['cidade'],
							"estado"		=> $_POST['estados'],
							"telefone_res"	=> $_POST['telefone_res'],
							"telefone_cel"	=> $_POST['telefone_cel'],
							"email"			=> $_POST['email'],
							"descricao"		=> $_POST['descricao'],
							"img_1"			=> preparar_nome($_FILES['img_1']),
							"img_2"			=> preparar_nome($_FILES['img_2']),
							"img_3"			=> preparar_nome($_FILES['img_3']),
							"img_4"			=> preparar_nome($_FILES['img_4']),
				"propaganda_completa"		=> ($_POST['completa']=='on') ? 's' : 'n',
							
						));
						$propaganda_bd->valor_pk = $id;
						$propaganda_bd->extras_select =  " WHERE id=$id";
						$propaganda_bd->seleciona_tudo($propaganda_bd);
						$resp = $propaganda_bd->retorna_dados();
						
						$propaganda_bufer = new objPropagandas();
						$propaganda_bufer->extras_select = " WHERE id=$id";
						$propaganda_bufer->seleciona_tudo($propaganda_bufer);
						$propaganda_bufer_r = $propaganda_bufer->retorna_dados();
						
						$B_NOME = $propaganda_bufer_r->nome;
						
						$propaganda_bd->atualizar($propaganda_bd);
						$editar_file = TRUE;
						if($propaganda_bd->linhas_afetadas == 1):
							printMsg('Dados alterados com sucesso. <a href="?m=prop&t=listar">Exibir cadastros</a>');
							unset($_POST);
						else:
							printMsg('Nenhum dado foi alterado. <a href="?m=prop&t=listar">Exibir cadastros</a>','alerta');	
						endif;
					endif;
					
					$propaganda_edit = new objPropagandas();
					$propaganda_edit->extras_select = " WHERE id=$id";
					$propaganda_edit->seleciona_tudo($propaganda_edit);
					$propaganda_resp = $propaganda_edit->retorna_dados();
					
					if($editar_file == TRUE):
						if($B_NOME):
							$dir = 'img_propagandas/'.$B_NOME;
							apaga_diretorio($dir);
							criar_diretorio_propagandas($propaganda_bd->getValor('nome'));
							upload_mestre($propaganda_bd->getValor('nome'),$_FILES['logo'],$propaganda_bd->getValor('nome'),$propaganda_bd->getValor('logo'),'propagandas',200);
							upload_mestre($propaganda_bd->getValor('nome'),$_FILES['img_1'],$propaganda_bd->getValor('nome'),$propaganda_bd->getValor('img_1'),'propagandas',500);
							upload_mestre($propaganda_bd->getValor('nome'),$_FILES['img_2'],$propaganda_bd->getValor('nome'),$propaganda_bd->getValor('img_2'),'propagandas',500);
							upload_mestre($propaganda_bd->getValor('nome'),$_FILES['img_3'],$propaganda_bd->getValor('nome'),$propaganda_bd->getValor('img_3'),'propagandas',500);
							upload_mestre($propaganda_bd->getValor('nome'),$_FILES['img_4'],$propaganda_bd->getValor('nome'),$propaganda_bd->getValor('img_4'),'propagandas',500);
						else:
							printMsg('Ocorreu um erro no caminho da pasta especificada','erro');		
						endif;							
					endif;
					
					$p = new usuarioDonoPropaganda(array(
							"nome" 			=> $propaganda_resp->dono_id
							));
						$p->retornarPropagandaNome($p->getValor('nome'));
						$resp = $p->retorna_dados();
				else:
					printMsg('Veículo não definido, <a href="m=prop&t=listar">Escolha um veículo para alterar</a>','erro');
				endif;
				?>
				
				<script type="text/javascript">
				$(document).ready(function(){
					$(".userForm").validate({
						rules:{
							prop_nome:{required:true},
							nome:{required:true},
							tipo:{required:true},
							bairro:{required:true},
							numero:{required:true},
							logo:{required:true},
							cep:{required:true},
							cidade:{required:true},
							estados:{required:true},
							img_1:{required:true},
							img_2:{required:true},
							img_3:{required:true},
							img_4:{required:true}
						}
					});
				});
			</script>
			<form class="userForm" method="post" action="" enctype="multipart/form-data">
				<fieldset><legend>Editando um propaganda.</legend>
					<ul>
						<li><label for="p_nome">Dono da propaganda:</label> <select name="prop_nome" autofocus="autofocus">
							<option><?php if($resp) echo $resp->nome; ?></option>
						<?php 
							$usu_prop = new usuarioDonoPropaganda();
							$usu_prop->retornarPropagandas();
							while($resp = $usu_prop->retorna_dados()):
								echo '<option>'.$resp->nome.'</option>';
							endwhile;
						?>	
						</select></li>
						
					<li><label for="nome">Nome:</label> <input type="text" size="50" name="nome" value="<?php if($propaganda_resp) echo $propaganda_resp->nome ?>">
					</li>
					<li><label for="tipo">Tipo de propaganda:</label> <select name=tipo>
							<option value="<?php if($propaganda_resp) echo $propaganda_resp->tipo ?>"><?php if($propaganda_resp) echo $propaganda_resp->tipo ?></option>
							<option value="autoescola">Autoescola</option>
							<option value="borracharia">Borracharia</option>
							<option value="autopecas">Autopeças</option>
							<option value="som">Som</option>
							<option value="concerto">Concerto</option>
							<option value="equipamento">Equipamento</option>
							<option value="insufilme">Insufilme</option>
							<option value="posto">Posto</option>
							<option value="ferrovelho">Ferro velho</option>
							<option value="ferrovelho">Táxi</option>
							<option value="variado">variado</option>
							</select></li>
					<li><label for="beirro">Bairro:</label> <input type="text" size="50" name="bairro" value="<?php if($propaganda_resp) echo $propaganda_resp->bairro ?>">
					</li>
					<li><label for="numero">Número:</label> <input type="text" size="50" name="numero" value="<?php if($propaganda_resp) echo $propaganda_resp->numero ?>">
					</li>
					<li><label for="logo">Logomarca:</label> <input type="file" id="logo" size="25" name="logo" value="<?php if($propaganda_resp) echo $propaganda_resp->logo ?>">
					</li>
					<li><label for="cep">Cep:</label> <input type="text" id="cep" size="25" name="cep" value="<?php if($propaganda_resp) echo $propaganda_resp->cep ?>">
					</li>
					<li><label for="cidade">Cidade:</label> <input type="text" id="cidade" size="25" name="cidade" value="<?php if($propaganda_resp) echo $propaganda_resp->cidade ?>">
					</li>
					<li><label for="tipo">Estado:</label> <select name="estados">
							<OPTION VALUE="RJ"><?php if($propaganda_resp) echo $propaganda_resp->estado ?></OPTION>
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
					<li><label for="telefone_res">Tel Residencial:</label> <input type="text" id="telefone_res" size="25" name="telefone_res" value="<?php if($propaganda_resp) echo $propaganda_resp->telefone_res ?>">
					</li>
					<li><label for="telefone_cel">Tel Celular:</label> <input type="text" id="telefone_cel" size="25" name="telefone_cel" value="<?php if($propaganda_resp) echo $propaganda_resp->telefone_cel ?>">
					</li>
					<li><label for="email">Email:</label> <input type="text" id="email" size="25" name="email" value="<?php if($propaganda_resp) echo $propaganda_resp->email ?>">
					</li>
					<li><label for="img_1">1º Imagem:</label> <input type="file" size="50" name="img_1"  value="<?php if($propaganda_resp) echo $propaganda_resp->img_1 ?>">
					</li>
					<li><label for="img_2">2º Imagem:</label> <input type="file" size="25" name="img_2" value="<?php if($propaganda_resp) echo $propaganda_resp->img_2 ?>">
					</li>
					<li><label for="img_3">3º Imagem:</label> <input type="file" size="50" name="img_3" value="<?php if($propaganda_resp) echo $propaganda_resp->img_3 ?>">
					</li>
					<li><label for="img_4">4º Imagem:</label> <input type="file" size="50" name="img_4"  value="<?php if($propaganda_resp) echo $propaganda_resp->img_4 ?>">
					</li>
					<li><label for="completa">Propaganda completa?</label> <input type="checkbox" name="completa" >
					</li>
					<br />
					<li>Descricao:
					<label for="descricao"></label> <textarea name="descricao" class="ckeditor" id="editor1" cols="20" rows="5"><?php if($propaganda_resp) echo $propaganda_resp->descricao ?></textarea>
					</li>
					<li class="center"><input type="button"
						onclick="location.href='?m=prop&t=listar'" value="Cancelar" /> <input
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
		echo '<h2>Exclusão de propagandas</h2>'; 
		$sessao = new sessao();
		$B_NOME = NULL;
		$delete_file = FALSE;
			if(isAdmin() == TRUE || $sessao->getVar('id_user') == $_GET['id']):
				if(isset($_GET['id'])):
					$id = $_GET['id'];
					if(isset($_POST['excluir'])):
						$propaganda_bd = new objPropagandas(array());
						$propaganda_bd->valor_pk = $id;
						$propaganda_bd->extras_select =  " WHERE id=$id";
						$propaganda_bd->seleciona_tudo($propaganda_bd);
						$resp = $propaganda_bd->retorna_dados();
						$B_NOME = $resp->nome;
						
						$propaganda_bd->deletar($propaganda_bd);
						$delete_file = TRUE;
						if($propaganda_bd->linhas_afetadas == 1):
							printMsg('Registro excluido com sucesso. <a href="?m=prop&t=listar">Exibir cadastros</a>');
							unset($_POST);
						else:
							printMsg('Nenhum registro foi excluido. <a href="?m=prop&t=listar">Exibir cadastros</a>','alerta');	
						endif;
						
					endif;
					
					$propaganda_edit = new objPropagandas();
					$propaganda_edit->extras_select = " WHERE id=$id";
					$propaganda_edit->seleciona_tudo($propaganda_edit);
					$propaganda_resp = $propaganda_edit->retorna_dados();
					if(isset($propaganda_resp->dono_id)):
						$nome = $propaganda_resp->dono_id;
					else:
						$nome = '';
					endif; 	
					$p = new usuarioDonoPropaganda(array(
							"nome" 			=> $nome
							));
						$p->retornarPropagandaNome($p->getValor('nome'));
						$resp = $p->retorna_dados();
						
					if($delete_file == TRUE):
						if($B_NOME):
							$dir = 'img_propagandas/'.$B_NOME;
							apaga_diretorio($dir);
						else:
							printMsg('Ocorreu um erro no caminho da pasta especificada','erro');		
						endif;	
					endif;
				else:
					printMsg('Propaganda não definida, <a href="m=prop&t=listar">Escolha uma propaganda para deletar</a>','erro');
				endif;
				?>
				
				<form class="userForm" method="post" action="">
				<fieldset><legend>Dados da propaganda a ser excluida do sistema.</legend>
					<ul>
						<li><label for="prop_nome">Dono da propaganda:</label> <select name="prop_nome" disabled="disabled">
							<option><?php if($resp) echo $resp->nome; ?></option>
						</select></li>	
					<li><label for="nome">Nome:</label> <input type="text" size="50" name="nome" disabled="disabled" value="<?php if($propaganda_resp) echo $propaganda_resp->nome ?>">
					</li>
					<li><label for="tipo">Tipo de propaganda:</label> <select name=tipo>
							<option value="<?php if($propaganda_resp) echo $propaganda_resp->tipo ?>"><?php if($propaganda_resp) echo $propaganda_resp->tipo ?></option>
							</select></li>
					<li><label for="beirro">Bairro:</label> <input type="text" size="50" name="bairro" disabled="disabled" value="<?php if($propaganda_resp) echo $propaganda_resp->bairro ?>">
					</li>
					<li><label for="numero">Número:</label> <input type="text" size="50" name="numero" disabled="disabled" value="<?php if($propaganda_resp) echo $propaganda_resp->numero ?>">
					</li>
					<li><label for="cep">Cep:</label> <input type="text" id="cep" size="25" name="cep" disabled="disabled" value="<?php if($propaganda_resp) echo $propaganda_resp->cep ?>">
					</li>
					<li><label for="cidade">Cidade:</label> <input type="text" id="cidade" size="25" name="cidade" disabled="disabled" value="<?php if($propaganda_resp) echo $propaganda_resp->cidade ?>">
					</li>
					<li><label for="tipo">Estado:</label> <select name="estados" disabled="disabled">
							<OPTION VALUE="RJ"><?php if($propaganda_resp) echo $propaganda_resp->estado ?></OPTION>
							</SELECT></li>
					<li><label for="telefone_res">Tel Residencial:</label> <input type="text" id="telefone_res" size="25" name="telefone_res" disabled="disabled" value="<?php if($propaganda_resp) echo $propaganda_resp->telefone_res ?>">
					</li>
					<li><label for="telefone_cel">Tel Celular:</label> <input type="text" id="telefone_cel" size="25" name="telefone_cel" disabled="disabled" value="<?php if($propaganda_resp) echo $propaganda_resp->telefone_cel ?>">
					</li>
					<li><label for="email">Email:</label> <input type="text" id="email" size="25" name="email" disabled="disabled" value="<?php if($propaganda_resp) echo $propaganda_resp->email ?>">
					</li>
					<li><label for="completa">Propaganda completa?</label> <input type="checkbox" name="completa" <?php if($propaganda_resp && $propaganda_resp->propaganda_completa == 's') echo 'checked="checked"'; ?>disabled="disabled" >
					</li>
					<br />
					<li><label for="descricao">Descricao:</label> <textarea name="descricao" disabled="disabled" id="descricao" cols="20" rows="5"><?php if($propaganda_resp) echo $propaganda_resp->descricao ?></textarea>
					</li>
					<li class="center"><input type="button"
						onclick="location.href='?m=prop&t=listar'" value="Cancelar" /> <input
						type="submit" name="excluir" value="Excluir dados" /></li>
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