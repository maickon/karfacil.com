<?php
require_once(dirname(dirname(__FILE__))."/funcoes.php");
loadJs('jquery_validate');
loadJs('jquery_validate_messages');
loadJs('geral');
protegeArquivo(basename(__FILE__));
switch ($tela):
	case 'incluir':
				echo '<h2>Cadastrando dados do sistema</h2>';
					if(isset($_POST['cadastrar'])):
						$site = new img_site(array(
							'baner_principal' 	=>$_POST['baner_principal'],
							'slide' 			=>$_POST['slide'],
							'nome'	 			=>$_POST['nome'],	
							'descricao_1' 		=>$_POST['descricao_1'],
							'descricao_2' 		=>$_POST['descricao_2'],
							'descricao_3' 		=>$_POST['descricao_3']
						));		
						$site->inserir($site);
						if($site->linhas_afetadas == 1):
							printMsg('Dados cadastrados com sucesso. <a href="?m=sistema&t=listar">Exibir cadastros</a>');
							unset($_POST);
						else:
							printMsg('Dados não cadastrados. <a href="?m=sistema&t=listar">Exibir cadastros</a>','alerta');	
						endif;
					endif;
					?>
					
					<script type="text/javascript">
					$(document).ready(function(){
						$(".userForm").validate({
							rules:{
								baner_principal:{required:true},
								slide:{required:true}
							}
						});
					});
					</script>
					<form class="userForm" method="post" action="">
					<fieldset><legend>Informe os dados para o cadastro</legend>
					<ul>
						<li><label for="baner_principal">Baner principal:</label> <input type="file" size="50" name="baner_principal" autofocus="autofocus" value="<?php $_POST['baner_principal'] ?>" />
						</li>
						<br />
						<li><label for="slide">Slide:</label> <input type="file" size="50" name="slide" value="" />
						</li>
						<li><label for="nome">Nome:</label> <input type="text" size="50" name="nome" value="" />
						</li>
						<li><label for="descricao_1">Descricao:</label> <textarea name="descricao_1" id="resumo" cols="20" rows="5"></textarea>
						</li>
						<li><label for="descricao_2">Descricao:</label> <textarea name="descricao_2" id="resumo" cols="20" rows="5"></textarea>
						</li>
						<li><label for="descricao_3">Descricao:</label> <textarea name="descricao_3" id="resumo" cols="20" rows="5"></textarea>
						</li>	
						<li class="center"><input type="button"
							onclick="location.href='?m=sistema&t=listar'" value="Cancelar" /> <input
							type="submit" name="cadastrar" value="Salvar alterações" /></li>
					</ul>
					</fieldset>
					</form>
					
				<?php 	
			break;

	case 'editar':
				echo '<h2>Editar dados do sistema</h2>';
				$sessao = new sessao();
				if(isAdmin() == TRUE || $sessao->getVar('id_user') == $_GET['id']):
					if(isset($_GET['id'])):
						$id = $_GET['id'];
						if(isset($_POST['editar'])):
							$site = new img_site(array(
								'baner_principal' 	=>$_POST['baner_principal'],
								'slide' 			=>$_POST['slide'],
								'nome'	 			=>$_POST['nome'],	
								'descricao_1' 		=>$_POST['descricao_1'],
								'descricao_2' 		=>$_POST['descricao_2'],
								'descricao_3' 		=>$_POST['descricao_3']
							));
							$site->valor_pk = $id;
							$site->extras_select =  " WHERE id=$id";
							$site->seleciona_tudo($site);
							$resp = $site->retorna_dados();
							
							$site->atualizar($site);
							if($site->linhas_afetadas == 1):
								printMsg('Dados alterados com sucesso. <a href="?m=sistema&t=listar">Exibir cadastros</a>');
								unset($_POST);
							else:
								printMsg('Nenhum dado foi alterado. <a href="?m=sistema&t=listar">Exibir cadastros</a>','alerta');	
							endif;
						endif;
						
						
						$site_edit = new img_site();
						$site_edit->extras_select = " WHERE id=$id";
						$site_edit->seleciona_tudo($site_edit);
						$resp_edit = $site_edit->retorna_dados();
						
					else:
						printMsg('Usuário não definido, <a href="?m=sistema&t=listar">Você não tem permissão para alterar o sistema</a>','erro');
					endif;
					?>
					
					<script type="text/javascript">
					$(document).ready(function(){
						$(".userForm").validate({
							rules:{
								baner_principal:{required:true},
								slide:{required:true}
							}
						});
					});
					</script>
					<form class="userForm" method="post" action="">
					<fieldset><legend>Informe os dados para o alteração</legend>
					<ul>
						<li><label for="baner_principal">Baner principal:</label> <input type="file" size="50" name="baner_principal" autofocus="autofocus"  />
						</li>
						<br />
						<li><label for="slide">Slide:</label> <input type="file" size="50" name="slide"  />
						</li>
						<li><label for="nome">Nome:</label> <input type="text" size="50" name="nome" value="<?php if($resp_edit) echo $resp_edit->nome ?>" />
						</li>
						<li><label for="descricao_1">Descricao:</label> <textarea name="descricao_1" id="resumo" cols="20" rows="5"><?php if($resp_edit) echo $resp_edit->descricao_1 ?></textarea>
						</li>
						<li><label for="descricao_2">Descricao:</label> <textarea name="descricao_2" id="resumo" cols="20" rows="5"><?php if($resp_edit) echo $resp_edit->descricao_2 ?></textarea>
						</li>
						<li><label for="descricao_3">Descricao:</label> <textarea name="descricao_3" id="resumo" cols="20" rows="5"><?php if($resp_edit) echo $resp_edit->descricao_3 ?></textarea>
						</li>
						<li class="center"><input type="button"
							onclick="location.href='?m=sistema&t=listar'" value="Cancelar" /> <input
							type="submit" name="editar" value="Salvar alterações" /></li>
					</ul>
					</fieldset>
					</form>
					
				<?php 
				else:
					printMsg('Você não tem permissão para acessar esta página. <a href="#" onclik="history.back()">Voltar</a>','erro');
				endif;	
			break;
			
	case 'listar':
		echo '<h2>Dados cadastrados</h2>';
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
			    <th>Baner principal</th>
			    <th>slide</th>
			    <th>nome</th>
			    <th>Descrição 1</th>
			    <th>Descrição 2</th>
			    <th>Descrição 3</th>
			    <th>Data cadastro</th>
			    <th>Ações</th>
			  </tr>
			  </thead>
			  
			  <tbody>
				<?php 
					$site = new img_site();
					$site->seleciona_tudo($site);
					while($resp = $site->retorna_dados()):
						echo '<tr>'; 
							printf('<td class="center">%s</td>',$resp->baner_principal);
							printf('<td class="center">%s</td>',$resp->slide);
							printf('<td class="center">%s</td>',$resp->nome);
							printf('<td class="center">%s</td>',$resp->descricao_1);
							printf('<td class="center">%s</td>',$resp->descricao_2);
							printf('<td class="center">%s</td>',$resp->descricao_3);
							printf('<td class="center">%s</td>',date("d/m/Y"),strtotime($resp->data_cadastro));
							printf('
							<td class="center">
								<div>
									<a href="?m=sistema&t=incluir" title="Novo cadastro"><img src="img/plus.png" alt="Novo cadastro" /></a>		
									<a href="?m=sistema&t=editar&id=%s" title="Editar"><img src="img/edit.png" alt="Editar" /></a> 
									<a href="?m=sistema&t=excluir&id=%s" title="Excluir"><img src="img/cancel.png" alt="Excluir" /></a>
								</div>
							</td>',$resp->id,$resp->id,$resp->id);
						echo '</tr>';
						
					endwhile;
				?>
			  </tbody>
			</table>

		<?php 
	break;
		
	case 'excluir':
				echo '<h2>Exclusão de dados do sistema</h2>';
				$sessao = new sessao();
				if(isAdmin() == TRUE || $sessao->getVar('id_user') == $_GET['id']):
					if(isset($_GET['id'])):
						$id = $_GET['id'];
						if(isset($_POST['excluir'])):
							$site = new img_site(array());
							$site->valor_pk = $id;
							$site->extras_select =  " WHERE id=$id";
							$site->seleciona_tudo($site);
							$resp = $site->retorna_dados();
							
							$site->deletar($site);
							if($site->linhas_afetadas == 1):
								printMsg('Dados deletados com sucesso. <a href="?m=sistema&t=listar">Exibir cadastros</a>');
								unset($_POST);
							else:
								printMsg('Nenhum dado foi deletado. <a href="?m=sistema&t=listar">Exibir cadastros</a>','alerta');	
							endif;
						endif;
						
						
						$site_edit = new img_site();
						$site_edit->extras_select = " WHERE id=$id";
						$site_edit->seleciona_tudo($site_edit);
						$resp_edit = $site_edit->retorna_dados();
						
					else:
						printMsg('Usuário não definido, <a href="?m=sistema&t=listar">Você não tem permissão para alterar o sistema</a>','erro');
					endif;
					?>
					<form class="userForm" method="post" action="">
					<fieldset><legend>Confirme os dados para o deleção</legend>
					<ul>
						<li><label for="baner_principal">Baner principal:</label> <input type="file" size="50" name="baner_principal" disabled="disabled" autofocus="autofocus"  />
						</li>
						<br />
						<li><label for="slide">Slide:</label> <input type="file" size="50" name="slide" disabled="disabled" />
						</li>
						<li><label for="nome">Nome:</label> <input type="text" size="50" name="nome" disabled="disabled" value="<?php if($resp_edit) echo $resp_edit->nome ?>" />
						</li>
						<li><label for="descricao_1">Descricao:</label> <textarea name="descricao_1" disabled="disabled" id="resumo" cols="20" rows="5"><?php if($resp_edit) echo $resp_edit->descricao_1 ?></textarea>
						</li>
						<li><label for="descricao_2">Descricao:</label> <textarea name="descricao_2" disabled="disabled" id="resumo" cols="20" rows="5"><?php if($resp_edit) echo $resp_edit->descricao_2 ?></textarea>
						</li>
						<li><label for="descricao_3">Descricao:</label> <textarea name="descricao_3" disabled="disabled" id="resumo" cols="20" rows="5"><?php if($resp_edit) echo $resp_edit->descricao_3 ?></textarea>
						</li>
						<li class="center"><input type="button"
							onclick="location.href='?m=sistema&t=listar'" value="Cancelar" /> <input
							type="submit" name="editar" value="Salvar alterações" /></li>
					</ul>
					</fieldset>
					</form>
					
				<?php 
				else:
					printMsg('Você não tem permissão para acessar esta página. <a href="#" onclik="history.back()">Voltar</a>','erro');
				endif;	
			break;
			
	default:
		echo 'Nada selecionado.';
	break;		
endswitch;		
?>