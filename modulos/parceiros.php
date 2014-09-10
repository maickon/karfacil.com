<?php
require_once(dirname(dirname(__FILE__))."/funcoes.php");
loadJs('jquery_validate');
loadJs('jquery_validate_messages');
loadJs('geral');
loadJs('../'.CKEDITORPATH.'/ckeditor');

protegeArquivo(basename(__FILE__));
switch ($tela):
	case 'incluir':
				echo '<h2>Publicando um parceiro</h2>';
					if(isset($_POST['cadastrar'])):
						$parceiros = new parceiros(array(
							'nome' 			=>$_POST['nome'],	
							'link' 			=>$_POST['link'],	
							'descricao' 	=>$_POST['descricao'],
							'img' 			=>preparar_nome($_FILES['img']),
						));		
						$parceiros->inserir($parceiros);
						criar_diretorio_parceiros($parceiros->getValor('nome'));
						upload_mestre($parceiros->getValor('nome'),$_FILES['img'],$parceiros->getValor('nome'),$parceiros->getValor('img'),'img_parceiros',200);
						if($parceiros->linhas_afetadas == 1):
							printMsg('Dados cadastrados com sucesso. <a href="?m=parceiros&t=listar">Exibir cadastros</a>');
							unset($_POST);
						else:
							printMsg('Dados n�o cadastrados. <a href="?m=parceiros&t=listar">Exibir cadastros</a>','alerta');	
						endif;
					endif;
					?>
					
					<script type="text/javascript">
					$(document).ready(function(){
						$(".userForm").validate({
							rules:{
								nome:{required:true},
								img:{required:true}
							}
						});
					});
					</script>
					<form class="userForm" method="post" action="" enctype="multipart/form-data">
					<fieldset><legend>Informe os dados para o cadastro</legend>
					<ul>
						<li><label for="nome">Nome:</label> <input type="text" size="50" name="nome" value="" />
						</li>
						<li><label for="img">Imagem:</label> <input type="file" size="25" name="img" value="">
						</li>
						<li><label for="link">Link:</label> <input type="text" size="50" name="link" value="" />
						</li>
						<li><label for="descricao">Descri��o:</label>
						<br />
						<textarea  class="ckeditor" id="editor1" name="descricao" cols="20" rows="30"></textarea>
						</li>	
						<li class="center"><input type="button"
							onclick="location.href='?m=parceiros&t=listar'" value="Cancelar" /> <input
							type="submit" name="cadastrar" value="Salvar dados" /></li>
					</ul>
					</fieldset>
					</form>
					
				<?php 	
			break;

	case 'editar':
				echo '<h2>Editar dados do sistema</h2>';
				$sessao = new sessao();
				$editar_file = FALSE;
				$B_NOME = NULL;
				if(isAdmin() == TRUE || $sessao->getVar('id_user') == $_GET['id']):
					if(isset($_GET['id'])):
						$id = $_GET['id'];
						if(isset($_POST['editar'])):
							$parceiros = new parceiros(array(
							'nome' 			=>$_POST['nome'],	
							'link' 			=>$_POST['link'],	
							'descricao' 	=>$_POST['descricao'],
							'img' 			=>preparar_nome($_FILES['img']),
							));		
							$parceiros->valor_pk = $id;
							$parceiros->extras_select =  " WHERE id=$id";
							$parceiros->seleciona_tudo($parceiros);
							$resp = $parceiros->retorna_dados();
							
							$parceiros_bufer = new parceiros();
							$parceiros_bufer->extras_select = " WHERE id=$id";
							$parceiros_bufer->seleciona_tudo($parceiros_bufer);
							$parceiros_bufer_r = $parceiros_bufer->retorna_dados();
						
							$B_NOME = $parceiros_bufer_r->nome;
							
							$parceiros->atualizar($parceiros);
							$editar_file = TRUE;
							if($parceiros->linhas_afetadas == 1):
								printMsg('Dados alterados com sucesso. <a href="?m=parceiros&t=listar">Exibir cadastros</a>');
								unset($_POST);
							else:
								printMsg('Nenhum dado foi alterado. <a href="?m=parceiros&t=listar">Exibir cadastros</a>','alerta');	
							endif;
						endif;
						
						
						$parceiros_edit = new parceiros();
						$parceiros_edit->extras_select = " WHERE id=$id";
						$parceiros_edit->seleciona_tudo($parceiros_edit);
						$parceiros_edit_r = $parceiros_edit->retorna_dados();
						
						if($editar_file == TRUE):
						if($B_NOME):
							$dir = 'img_parceiros/'.$B_NOME;
							apaga_diretorio($dir);
							criar_diretorio_parceiros($parceiros->getValor('nome'));
							upload_mestre($parceiros->getValor('nome'),$_FILES['img'],$parceiros->getValor('nome'),$parceiros->getValor('img'),'img_parceiros',200);
						else:
							printMsg('Ocorreu um erro no caminho da pasta especificada','erro');		
						endif;							
					endif;
						
					else:
						printMsg('Usu�rio n�o definido, <a href="?m=parceiros&t=listar">Voc� n�o tem permiss�o para alterar o sistema</a>','erro');
					endif;
					?>
					
					<script type="text/javascript">
					$(document).ready(function(){
						$(".userForm").validate({
							rules:{
								nome:{required:true},
								img:{required:true}
							}
						});
					});
					</script>
					<form class="userForm" method="post" action="" enctype="multipart/form-data">
					<fieldset><legend>Informe os dados para altera��o</legend>
					<ul>
						<li><label for="nome">Nome:</label> <input type="text" size="50" name="nome" value="<?php if($parceiros_edit_r) echo $parceiros_edit_r->nome ?>" />
						</li>
						<li><label for="img">Imagem:</label> <input type="file" size="25" name="img" value="<?php if($parceiros_edit_r) echo $parceiros_edit_r->img ?>">
						</li>
						<li><label for="link">Link:</label> <input type="text" size="50" name="link" value="<?php if($parceiros_edit_r) echo $parceiros_edit_r->link ?>" />
						</li>
						<li><label for="descricao">Descri��o:</label>
						<br />
						<textarea  class="ckeditor" id="editor1" name="descricao" cols="20" rows="30"><?php if($parceiros_edit_r) echo $parceiros_edit_r->descricao ?></textarea>
						</li>	
						<li class="center">
						<input type="button" onclick="location.href='?m=parceiros&t=listar'" value="Cancelar" /> 
						<input type="submit" name="editar" value="Salvar altera��es" /></li>
					</ul>
					</fieldset>
					</form>
					
				<?php 
				else:
					printMsg('Voc� n�o tem permiss�o para acessar esta p�gina. <a href="#" onclik="history.back()">Voltar</a>','erro');
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
					"sLengthMenu": "Mostrar _MENU_ elementos por p�gina",
					"sZeroRecords": "Nenhum dado encontrado para exibi��o",
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
			    <th>Link</th>
			    <th>Descri��o</th>
			    <th>A��es</th>
			  </tr>
			  </thead>
			  
			  <tbody>
				<?php 
					$parceiros = new parceiros();
					$parceiros->seleciona_tudo($parceiros);
					while($resp = $parceiros->retorna_dados()):
						echo '<tr>'; 
							printf('<td class="center">%s</td>',$resp->nome);
							printf('<td class="center">%s</td>',$resp->link);
							printf('<td class="center">%s</td>',$resp->descricao);
							printf('
							<td class="center">
								<div>
									<a href="?m=parceiros&t=incluir" title="Novo parceiro"><img src="img/plus.png" alt="Novo perceiro" /></a>		
									<a href="?m=parceiros&t=editar&id=%s" title="Editar"><img src="img/edit.png" alt="Editar" /></a> 
									<a href="?m=parceiros&t=excluir&id=%s" title="Excluir"><img src="img/cancel.png" alt="Excluir" /></a>
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
				echo '<h2>Exclus�o de dados do sistema</h2>';
				$sessao = new sessao();
				$B_NOME = NULL;
				$delete_file = FALSE;
				if(isAdmin() == TRUE || $sessao->getVar('id_user') == $_GET['id']):
					if(isset($_GET['id'])):
						$id = $_GET['id'];
						if(isset($_POST['excluir'])):
							$parceiros = new parceiros(array());
							$parceiros->valor_pk = $id;
							$parceiros->extras_select =  " WHERE id=$id";
							$parceiros->seleciona_tudo($parceiros);
							$resp = $parceiros->retorna_dados();
							$B_NOME = $resp->nome;
							
							$parceiros->deletar($parceiros);
							$delete_file = TRUE;
							if($parceiros->linhas_afetadas == 1):
								printMsg('Dados deletados com sucesso. <a href="?m=parceiros&t=listar">Exibir cadastros</a>');
								unset($_POST);
							else:
								printMsg('Nenhum dado foi deletado. <a href="?m=parceiros&t=listar">Exibir cadastros</a>','alerta');	
							endif;
						endif;
						
						
						$parceiros_edit = new parceiros();
						$parceiros_edit->extras_select = " WHERE id=$id";
						$parceiros_edit->seleciona_tudo($parceiros_edit);
						$parceiros_edit_r = $parceiros_edit->retorna_dados();
						
						if($delete_file == TRUE):
						if($B_NOME):
							$dir = 'img_parceiros/'.$B_NOME;
							apaga_diretorio($dir);
						else:
							printMsg('Ocorreu um erro no caminho da pasta especificada','erro');		
						endif;	
					endif;
						
					else:
						printMsg('Usu�rio n�o definido, <a href="?m=sistema&t=listar">Voc� n�o tem permiss�o para alterar o sistema</a>','erro');
					endif;
					?>
					<form class="userForm" method="post" action="" enctype="multipart/form-data">
					<fieldset><legend>Confira os dados para exclus�o</legend>
					<ul>
						<li><label for="nome">Nome:</label> <input type="text" size="50" name="nome" disabled="disabled" value="<?php if($parceiros_edit_r) echo $parceiros_edit_r->nome ?>" />
						</li>
						<li><label for="img">Imagem:</label> <input type="file" size="25" name="img" disabled="disabled" value="<?php if($parceiros_edit_r) echo $parceiros_edit_r->img ?>">
						</li>
						<li><label for="link">Link:</label> <input type="text" size="50" name="link" disabled="disabled" value="<?php if($parceiros_edit_r) echo $parceiros_edit_r->link ?>" />
						</li>
						<li><label for="descricao">Descri��o:</label>
						<br />
						<textarea  class="ckeditor" id="editor1" disabled="disabled" name="descricao" cols="20" rows="30"><?php if($parceiros_edit_r) echo $parceiros_edit_r->descricao ?></textarea>
						</li>	
						<li class="center"><input type="button"
							onclick="location.href='?m=noticia&t=listar'" value="Cancelar" /> <input
							type="submit" name="excluir" value="Confirmar exclus�o" /></li>
					</ul>
					</fieldset>
					</form>					
				<?php 
				else:
					printMsg('Voc� n�o tem permiss�o para acessar esta p�gina. <a href="#" onclik="history.back()">Voltar</a>','erro');
				endif;	
			break;
			
	default:
		echo 'Nada selecionado.';
	break;		
endswitch;		
?>