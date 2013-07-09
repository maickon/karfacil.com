<?php
require_once(dirname(dirname(__FILE__))."/funcoes.php");
loadJs('jquery_validate');
loadJs('jquery_validate_messages');
loadJs('geral');
loadJs('../'.CKEDITORPATH.'/ckeditor');

protegeArquivo(basename(__FILE__));
switch ($tela):
	case 'incluir':
				echo '<h2>Publicando uma noticia</h2>';
					if(isset($_POST['cadastrar'])):
						$sessao = new Sessao();
						$noticia = new noticias(array(
							'titulo' 			=>$_POST['titulo'],	
							'usuario' 			=>$sessao->getVar('nome_user'),
							'texto' 			=>$_POST['editor1'],
						));		
						$noticia->inserir($noticia);
						if($noticia->linhas_afetadas == 1):
							printMsg('Dados cadastrados com sucesso. <a href="?m=noticia&t=listar">Exibir cadastros</a>');
							unset($_POST);
						else:
							printMsg('Dados n�o cadastrados. <a href="?m=noticia&t=listar">Exibir cadastros</a>','alerta');	
						endif;
					endif;
					?>
					
					<script type="text/javascript">
					$(document).ready(function(){
						$(".userForm").validate({
							rules:{
								titulo:{required:true},
								texto:{required:true}
							}
						});
					});
					</script>
					<form class="userForm" method="post" action="">
					<fieldset><legend>Informe os dados para o cadastro</legend>
					<ul>
						<li><label for="titulo">T�tulo:</label> <input type="text" size="50" name="titulo" value="" />
						</li>
						<li><label for="texto">Mat�ria:</label>
						<br />
						<textarea  class="ckeditor" id="editor1" name="editor1" cols="20" rows="30"></textarea>
						</li>	
						<li class="center"><input type="button"
							onclick="location.href='?m=noticia&t=listar'" value="Cancelar" /> <input
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
							$noticia = new noticias(array(
							'titulo' 			=>$_POST['titulo'],		
							'usuario' 			=>$sessao->getVar('nome_user'),
							'texto' 			=>$_POST['editor1'],
							));		
							$noticia->valor_pk = $id;
							$noticia->extras_select =  " WHERE id=$id";
							$noticia->seleciona_tudo($noticia);
							$resp = $noticia->retorna_dados();
							
							$noticia->atualizar($noticia);
							if($noticia->linhas_afetadas == 1):
								printMsg('Dados alterados com sucesso. <a href="?m=noticia&t=listar">Exibir cadastros</a>');
								unset($_POST);
							else:
								printMsg('Nenhum dado foi alterado. <a href="?m=noticia&t=listar">Exibir cadastros</a>','alerta');	
							endif;
						endif;
						
						
						$noticia_edit = new noticias();
						$noticia_edit->extras_select = " WHERE id=$id";
						$noticia_edit->seleciona_tudo($noticia_edit);
						$noticia_edit_r = $noticia_edit->retorna_dados();
						
					else:
						printMsg('Usu�rio n�o definido, <a href="?m=noticia&t=listar">Voc� n�o tem permiss�o para alterar o sistema</a>','erro');
					endif;
					?>
					
					<script type="text/javascript">
					$(document).ready(function(){
						$(".userForm").validate({
							rules:{
								titulo:{required:true},
								assunto:{required:true},
								texto:{required:true}
							}
						});
					});
					</script>
					<form class="userForm" method="post" action="">
					<fieldset><legend>Informe os dados para altera��o</legend>
					<ul>
						<li><label for="titulo">T�tulo:</label> <input type="text" size="50" name="titulo" value="<?php if($noticia_edit_r) echo $noticia_edit_r->titulo ?>" />
						</li>
						<li><label for="texto">Met�ria:</label>
						<br />
						 <textarea class="ckeditor" id="editor1" name="editor1" cols="20" rows="30"><?php if($noticia_edit_r) echo $noticia_edit_r->texto ?></textarea>
						</li>	
						<li class="center"><input type="button"
							onclick="location.href='?m=noticia&t=listar'" value="Cancelar" /> <input
							type="submit" name="editar" value="Salvar altera��es" /></li>
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
			    <th>Titulo</th>
			    <th>Postado por</th>
			    <th>Data</th>
			    <th>Noticia</th>
			    <th>A��es</th>
			  </tr>
			  </thead>
			  
			  <tbody>
				<?php 
					$noticias = new noticias();
					$noticias->seleciona_tudo($noticias);
					while($resp = $noticias->retorna_dados()):
						echo '<tr>'; 
							printf('<td class="center">%s</td>',$resp->titulo);
							printf('<td class="center">%s</td>',$resp->usuario);
							printf('<td class="center">%s</td>',date("d/m/Y"),strtotime($resp->data));
							printf('<td class="center">%s</td>',$resp->texto);
							printf('
							<td class="center">
								<div>
									<a href="?m=noticia&t=incluir" title="Nova noticia"><img src="img/plus.png" alt="Nova noticia" /></a>		
									<a href="?m=noticia&t=editar&id=%s" title="Editar"><img src="img/edit.png" alt="Editar" /></a> 
									<a href="?m=noticia&t=excluir&id=%s" title="Excluir"><img src="img/cancel.png" alt="Excluir" /></a>
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
				if(isAdmin() == TRUE || $sessao->getVar('id_user') == $_GET['id']):
					if(isset($_GET['id'])):
						$id = $_GET['id'];
						if(isset($_POST['excluir'])):
							$noticia = new noticias(array());
							$noticia->valor_pk = $id;
							$noticia->extras_select =  " WHERE id=$id";
							$noticia->seleciona_tudo($noticia);
							$resp = $noticia->retorna_dados();
							
							$noticia->deletar($noticia);
							if($noticia->linhas_afetadas == 1):
								printMsg('Dados deletados com sucesso. <a href="?m=noticia&t=listar">Exibir cadastros</a>');
								unset($_POST);
							else:
								printMsg('Nenhum dado foi deletado. <a href="?m=noticia&t=listar">Exibir cadastros</a>','alerta');	
							endif;
						endif;
						
						
						$noticia_edit = new noticias();
						$noticia_edit->extras_select = " WHERE id=$id";
						$noticia_edit->seleciona_tudo($noticia_edit);
						$noticia_edit_r = $noticia_edit->retorna_dados();
						
					else:
						printMsg('Usu�rio n�o definido, <a href="?m=sistema&t=listar">Voc� n�o tem permiss�o para alterar o sistema</a>','erro');
					endif;
					?>
					<form class="userForm" method="post" action="">
					<fieldset><legend>Confira os dados para exclus�o</legend>
					<ul>
						<li><label for="titulo">T�tulo:</label> <input type="text" size="50" name="titulo" disabled="disabled" value="<?php if($noticia_edit_r) echo $noticia_edit_r->titulo ?>" />
						</li>
						<li><label for="texto">Mat�ria:</label> <textarea name="texto" id="resumo" cols="20" rows="20" disabled="disabled"><?php if($noticia_edit_r) echo $noticia_edit_r->texto ?></textarea>
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