<?php
/*Arquivos para upar
 * lojas.php
 * desc_loja.php
 * desc_prop.php
 * agenda.php
 * agenda.class.php
 * desc_vl.php
 * objLojas.class.php
 * sidebar.php
 * config.php
 * parceiros.class.php
 * parceiros.php
 * funcoes.php
 * karfacil.css
 * karfacil.php
 * 
 * */
require_once(dirname(dirname(__FILE__))."/funcoes.php");
loadJs('jquery_validate');
loadJs('jquery_validate_messages');
loadJs('geral');
loadJs('../'.CKEDITORPATH.'/ckeditor');

protegeArquivo(basename(__FILE__));
switch ($tela):
	case 'incluir':
				echo '<h2>Agenda, Cadastro de compromissos</h2>';
					if(isset($_POST['cadastrar'])):
						$agenda = new Agenda(array(
							'nome' 			=>$_POST['nome'],	
							'data_visita' 	=>$_POST['data_visita'],
							'dia_visita' 	=>$_POST['dia_visita'],	
							'hora' 			=>$_POST['hora'],
							'telefone' 		=>$_POST['telefone'],
							'adicional' 	=>$_POST['adicional'],	
						));		
						$agenda->inserir($agenda);
						if($agenda->linhas_afetadas == 1):
							printMsg('Dados cadastrados com sucesso. <a href="?m=agenda&t=listar">Exibir cadastros</a>');
							unset($_POST);
						else:
							printMsg('Dados não cadastrados. <a href="?m=agenda&t=listar">Exibir cadastros</a>','alerta');	
						endif;
					endif;
					?>
					
					<script type="text/javascript">
					$(document).ready(function(){
						$(".userForm").validate({
							rules:{
								nome:{required:true},
								data_visita:{required:true},
								dia_visita:{required:true},
								hora:{required:true},
								telefone:{required:true}
							}
						});
					});
					</script>
					<form class="userForm" method="post" action="">
					<fieldset><legend>Informe os dados para o cadastro</legend>
					<ul>
						<li><label for="nome">Nome:</label> <input type="text" size="50" name="nome" value="<?php $_POST['nome'] = '' ?>" />
						</li>
						<li><label for="data_visita">Data visita:</label> <input type="text" size="50" name="data_visita" value="<?php $_POST['data_visita'] = '' ?>" />
						</li>
						<li><label for="dia_visita">Dia visita:</label> <input type="text" size="50" name="dia_visita" value="<?php $_POST['dia_visita'] = '' ?>" />
						</li>
						<li><label for="hora">Hora:</label> <input type="text" size="50" name="hora" value="<?php $_POST['hora'] = '' ?>" />
						</li>
						<li><label for="telefone">Telefone:</label> <input type="text" size="50" name="telefone" value="<?php $_POST['telefone'] = '' ?>" />
						</li>
						<li><label for="texto">Lembrete:</label>
						<br />
						<textarea  class="ckeditor" id="editor1" name="adicional" cols="20" rows="30"><?php $_POST['adicional'] = '' ?></textarea>
						</li>	
						<li class="center"><input type="button"
							onclick="location.href='?m=agenda&t=listar'" value="Cancelar" /> <input
							type="submit" name="cadastrar" value="Salvar dados" /></li>
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
							$agenda = new Agenda(array(
							'nome' 			=>$_POST['nome'],	
							'data_visita' 	=>$_POST['data_visita'],
							'dia_visita' 	=>$_POST['dia_visita'],	
							'hora' 			=>$_POST['hora'],
							'telefone' 		=>$_POST['telefone'],
							'adicional' 	=>$_POST['adicional'],	
							));	
							$agenda->valor_pk = $id;
							$agenda->extras_select =  " WHERE id=$id";
							$agenda->seleciona_tudo($agenda);
							$resp = $agenda->retorna_dados();
							
							$agenda->atualizar($agenda);
							if($agenda->linhas_afetadas == 1):
								printMsg('Dados alterados com sucesso. <a href="?m=agenda&t=listar">Exibir cadastros</a>');
								unset($_POST);
							else:
								printMsg('Nenhum dado foi alterado. <a href="?m=agenda&t=listar">Exibir cadastros</a>','alerta');	
							endif;
						endif;
						
						
						$agenda_edit = new Agenda();
						$agenda_edit->extras_select = " WHERE id=$id";
						$agenda_edit->seleciona_tudo($agenda_edit);
						$agenda_edit_r = $agenda_edit->retorna_dados();
						
					else:
						printMsg('Usuário não definido, <a href="?m=noticia&t=listar">Você não tem permissão para alterar o sistema</a>','erro');
					endif;
					?>
					
					<script type="text/javascript">
					$(document).ready(function(){
						$(".userForm").validate({
							rules:{
								nome:{required:true},
								data_visita:{required:true},
								dia_visita:{required:true},
								hora:{required:true},
								telefone:{required:true}
							}
						});
					});
					</script>
					<form class="userForm" method="post" action="">
					<fieldset><legend>Informe os dados para alteração</legend>
					<ul>
						<li><label for="nome">Nome:</label> <input type="text" size="50" name="nome" value="<?php if($agenda_edit_r) echo $agenda_edit_r->nome ?>" />
						</li>
						<li><label for="data_visita">Data visita:</label> <input type="text" size="50" name="data_visita" value="<?php if($agenda_edit_r) echo $agenda_edit_r->data_visita ?>" />
						</li>
						<li><label for="dia_visita">Dia visita:</label> <input type="text" size="50" name="dia_visita" value="<?php if($agenda_edit_r) echo $agenda_edit_r->dia_visita ?>" />
						</li>
						<li><label for="hora">Hora:</label> <input type="text" size="50" name="hora" value="<?php if($agenda_edit_r) echo $agenda_edit_r->hora ?>" />
						</li>
						<li><label for="telefone">Telefone:</label> <input type="text" size="50" name="telefone" value="<?php if($agenda_edit_r) echo $agenda_edit_r->telefone ?>" />
						</li>
						<li><label for="texto">Lembrete:</label>
						<br />
						<textarea  class="ckeditor" id="editor1" name="adicional" cols="20" rows="30"><?php if($agenda_edit_r) echo $agenda_edit_r->adicional ?></textarea>
						</li>		
						<li class="center"><input type="button"
							onclick="location.href='?m=agenda&t=listar'" value="Cancelar" /> <input
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
			    <th>Nome</th>
			    <th>Data de visita</th>
			    <th>Dia de visita</th>
			    <th>Hora</th>
			    <th>Telefone.</th>
			    <th>Lembrete</th>
			    <th>Ações</th>
			  </tr>
			  </thead>
			  
			  <tbody>
				<?php 
					$agenda = new Agenda();
					$agenda->seleciona_tudo($agenda);
					while($resp = $agenda->retorna_dados()):
						echo '<tr>'; 
							printf('<td class="center">%s</td>',$resp->nome);
							printf('<td class="center">%s</td>',date("d/m/Y"),strtotime($resp->data_visita));
							printf('<td class="center">%s</td>',$resp->dia_visita);
							printf('<td class="center">%s</td>',$resp->hora);
							printf('<td class="center">%s</td>',$resp->telefone);
							printf('<td class="center">%s</td>',$resp->adicional);
							printf('
							<td class="center">
								<div>
									<a href="?m=agenda&t=incluir" title="Nova agenda"><img src="img/plus.png" alt="Nova agenda" /></a>		
									<a href="?m=agenda&t=editar&id=%s" title="Editar"><img src="img/edit.png" alt="Editar" /></a> 
									<a href="?m=agenda&t=excluir&id=%s" title="Excluir"><img src="img/cancel.png" alt="Excluir" /></a>
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
				echo '<h2>Exclusão de dados de uma agenda</h2>';
				$sessao = new sessao();
				if(isAdmin() == TRUE || $sessao->getVar('id_user') == $_GET['id']):
					if(isset($_GET['id'])):
						$id = $_GET['id'];
						if(isset($_POST['excluir'])):
							$agenda = new Agenda(array());
							$agenda->valor_pk = $id;
							$agenda->extras_select =  " WHERE id=$id";
							$agenda->seleciona_tudo($agenda);
							$resp = $agenda->retorna_dados();
							
							$agenda->deletar($agenda);
							if($agenda->linhas_afetadas == 1):
								printMsg('Dados deletados com sucesso. <a href="?m=agenda&t=listar">Exibir cadastros</a>');
								unset($_POST);
							else:
								printMsg('Nenhum dado foi deletado. <a href="?m=agenda&t=listar">Exibir cadastros</a>','alerta');	
							endif;
						endif;
						
						
						$agenda_edit = new Agenda();
						$agenda_edit->extras_select = " WHERE id=$id";
						$agenda_edit->seleciona_tudo($agenda_edit);
						$agenda_edit_r = $agenda_edit->retorna_dados();
						
					else:
						printMsg('Usuário não definido, <a href="?m=sistema&t=listar">Você não tem permissão para alterar o sistema</a>','erro');
					endif;
					?>
					<form class="userForm" method="post" action="">
					<fieldset><legend>Confira os dados para exclusão</legend>
					<ul>
						<li><label for="nome">Nome:</label> <input type="text" size="50" name="nome" disabled="disabled" value="<?php if($agenda_edit_r) echo $agenda_edit_r->nome ?>" />
						</li>
						<li><label for="data_visita">Data visita:</label> <input type="text" size="50" name="data_visita" disabled="disabled" value="<?php if($agenda_edit_r) echo $agenda_edit_r->data_visita ?>" />
						</li>
						<li><label for="dia_visita">Dia visita:</label> <input type="text" size="50" name="dia_visita" disabled="disabled" value="<?php if($agenda_edit_r) echo $agenda_edit_r->dia_visita ?>" />
						</li>
						<li><label for="hora">Hora:</label> <input type="text" size="50" name="hora" disabled="disabled" value="<?php if($agenda_edit_r) echo $agenda_edit_r->hora ?>" />
						</li>
						<li><label for="telefone">Telefone:</label> <input type="text" size="50" name="telefone" disabled="disabled" value="<?php if($agenda_edit_r) echo $agenda_edit_r->telefone ?>" />
						</li>
						<li><label for="texto">Lembrete:</label>
						<br />
						<textarea  class="ckeditor" id="editor1" name="adicional" disabled="disabled" cols="20" rows="30"><?php if($agenda_edit_r) echo $agenda_edit_r->adicional ?></textarea>
						</li>	
							
						<li class="center"><input type="button" onclick="location.href='?m=agenda&t=listar'" value="Cancelar" /> 
						<input type="submit" name="excluir" value="Confirmar exclusão" /></li>
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