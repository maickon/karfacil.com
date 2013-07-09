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
			$u = new objVeiculosUsu(array(
				"nome" 			=> $_POST['usu_nome']
				));
			$u->retornarUsuarioIndice($u->getValor('nome'));
			$resp = $u->retorna_dados();
			$veiculo = new objVeiculosUsu(array(
				"dono_id"		=> $resp->id,
				"nome" 			=> $_POST['nome'],
				"preco"			=> $_POST['preco'],
				"cor"			=> $_POST['cor'],
				"categoria"		=> $_POST['categoria'],
				"estado"		=> $_POST['estado'],
				"cambio"		=> $_POST['cambio'],
				"cilindrada"	=> $_POST['cilindrada'],
				"direcao"		=> $_POST['direcao'],
				"transmissao"	=> $_POST['transmissao'],
				"combustivel"	=> $_POST['combustivel'],
				"portas"		=> $_POST['portas'],
				"kilometragem"	=> $_POST['kilometragem'],
				"marca"			=> $_POST['marca'],
				"modelo"		=> $_POST['modelo'],
				"ano"			=> $_POST['ano'],
				"versao"		=> $_POST['versao'],
				"img_1"			=> preparar_nome($_FILES['img_1']),
				"img_2"			=> preparar_nome($_FILES['img_2']),
				"img_3"			=> preparar_nome($_FILES['img_3']),
				"img_4"			=> preparar_nome($_FILES['img_4']),
				"descricao"		=> $_POST['descricao'],
			));
			$veiculo->inserir($veiculo);
			if($veiculo->getValor('img_1')):
				criar_diretorio_veiculos('exclusivos', $veiculo->getValor('img_1'));
				upload_mestre('exclusivos',$_FILES['img_1'],'/exclusivos/'.$veiculo->getValor('img_1'),$veiculo->getValor('img_1'),'img_lojas',500);
				upload_mestre('exclusivos',$_FILES['img_2'],'/exclusivos/'.$veiculo->getValor('img_1'),$veiculo->getValor('img_2'),'img_lojas',500);
				upload_mestre('exclusivos',$_FILES['img_3'],'/exclusivos/'.$veiculo->getValor('img_1'),$veiculo->getValor('img_3'),'img_lojas',500);
				upload_mestre('exclusivos',$_FILES['img_4'],'/exclusivos/'.$veiculo->getValor('img_1'),$veiculo->getValor('img_4'),'img_lojas',500);
				
			else:
				printMsg('Pasta não pode ser criada, pois o nome não foi definido','erro');
			endif;
			
			if($veiculo->linhas_afetadas == 1):
				printMsg('Dados inserido com sucesso <a href="'.ADMURL.'?m=veiculos_usu&t=listar">Exibir cadastros</a>');
				unset($_POST);
			endif;			
		endif;	
	?>
	<script type="text/javascript">
				$(document).ready(function(){
					$(".userForm").validate({
						rules:{
							usu_nome:{required:true},
							nome:{required:true},
							cor:{required:true},
							tipo:{required:true},
							combustivel:{required:true},
							kilometragem:{required:true},
							marca:{required:true},
							ano:{required:true},
							img_1:{required:true},
							img_2:{required:true},
							img_3:{required:true},
							img_4:{required:true},
							descricao:{required:true}
						}
					});
				});
			</script>
			<form class="userForm" method="post" action="" enctype="multipart/form-data">
				<fieldset><legend>Informe os dados para cadastrar o veículo.</legend>
				<ul>
				<?php 	
					if(isset($_GET['user_id'])):
						$usuarios = new usuarioDeVendaCarro();
						$usuarios->extras_select = " WHERE id=".$_GET['user_id'];
						$usuarios->seleciona_tudo($usuarios);
						$usu = $usuarios->retorna_dados();
				?>
					<li><label for="usu_nome">Dono do anuncio:</label> <select name="usu_nome" autofocus="autofocus">
						<option><?php echo $usu->nome; ?></option>
				<?php 				
					else:
						$usuarios = new objVeiculosUsu();
						$usuarios->retornarUsuarios(); 	
				?>
					<li><label for="usu_nome">Dono do anuncio :</label> <select name="usu_nome" autofocus="autofocus">
						<option></option>
				<?php 
						while($resp = $usuarios->retorna_dados()):
							echo '<option>'.$resp->login.'</option>';
						endwhile;
					endif;
				?>	
					</select></li>
					<li><label for="nome">Nome:</label> <input type="text" size="50" name="nome"  value="<?php echo $_POST['nome']='' ?>">
					</li>
					<li><label for="preco">preço:</label> <input type="text" size="50" name="preco" value="<?php echo $_POST['preco']='' ?>">
					</li>
					<li><label for="cor">Cor:</label> <input type="text" size="50" name="cor" value="<?php echo $_POST['cor']='' ?>">
					</li>
					<li><label for="categoria">Categoria:</label> <select name="categoria">
						<option>carros</option>
						<option>motos</option>
						<option>caminhão</option>
						<option>náuticos</option>
					</select></li>
					<li><label for="estado">Estado:</label> <select name="estado">
						<option>Novo</option>
						<option>Seminovo</option>
						<option>Usado</option>
						<option>Velho</option>
					</select></li>
					<li><label for="cambio">Câmbio:</label> <input type="text" size="50" name="cambio" value="<?php echo $_POST['cambio']='' ?>">
					</li>
					<li><label for="cilindrada">Cilindrada:</label> <input type="text" size="50" name="cilindrada" value="<?php echo $_POST['cilindrada']='' ?>">
					</li>				
					<li><label for="direcao">Direcão:</label> <input type="text" size="50" name="direcao" value="<?php echo $_POST['direcao']='' ?>">
					</li>
					<li><label for="transmissao">Transmissao:</label> <input type="text" size="50" name="transmissao" value="<?php echo $_POST['transmissao']='' ?>">
					</li>
					<li><label for="combustivel">Combustivel:</label> <input type="text" size="50" name="combustivel" value="<?php echo $_POST['combustivel']='' ?>">
					</li>
					<li><label for="portas">Portas:</label> <select name="portas">
						<option></option>
						<option>4</option>
						<option>1</option>
						<option>2</option>
						<option>3</option>
						<option>5</option>
						<option>6</option>
						<option>7</option>
						<option>8</option>
					</select></li>
					<li><label for="kilometragem">Kilometragem:</label> <input type="text" size="50" name="kilometragem" value="<?php echo $_POST['kilometragem']='' ?>">
					</li>
					<li><label for="marca">Marca:</label> <input type="text" size="50" name="marca" value="<?php echo $_POST['marca']='' ?>">
					</li>
					<li><label for="modelo">Modelo:</label> <input type="text" size="50" name="modelo" value="<?php echo $_POST['modelo']='' ?>">
					</li>
					<li><label for="ano">Ano:</label> <input type="text" size="50" name="ano" value="<?php echo $_POST['ano']='' ?>">
					</li>
					<li><label for="versao">Vesão:</label> <input type="text" size="50" name="versao" value="<?php echo $_POST['versao']='' ?>">
					</li>
					<li><label for="img_1">1º Imagem:</label> <input type="file" size="50" name="img_1" value="<?php echo $_POST['img_1']='' ?>">
					</li>
					<li><label for="img_2">2º Imagem:</label> <input type="file" size="25" name="img_2" value="<?php echo $_POST['img_2']='' ?>">
					</li>
					<li><label for="img_3">3º Imagem:</label> <input type="file" size="50" name="img_3" value="<?php echo $_POST['img_3']='' ?>">
					</li>
					<li><label for="img_4">4º Imagem:</label> <input type="file" size="50" name="img_4"  value="<?php echo $_POST['img_4']='' ?>">
					</li>
					<li>
					Descricao:
					<label for="descricao"></label> <textarea name="descricao" class="ckeditor" id="editor1" cols="20" rows="5"></textarea>
					</li>
					<li class="center"><input type="button"
						onclick="location.href='?m=veiculos_usu&t=listar'" value="Cancelar" /> <input
						type="submit" name="cadastrar" value="Salvar dados" /></li>
				</ul>
				</fieldset>
			</form>
		<?php 
		break;	
	case 'listar':
			echo '<h2>Carros cadastrados</h2>';
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
				    <th>Preço</th>
				    <th>Cor</th>
				    <th>Direção</th>
				    <th>Transmissao</th>
				    <th>combustivel</th>
				    <th>Kilometragem</th>
				    <th>Marca</th>
				    <th>Modelo</th>
				    <th>Ano</th>
				    <th>Ações</th>
				  </tr>
				  </thead>
				  
				  <tbody>
					<?php 
						$veiculo = new objVeiculosUsu();
						$veiculo->seleciona_tudo($veiculo);
						
						while($resp = $veiculo->retorna_dados()):
							$usu_id = new objVeiculosUsu();
							$usu_id->retornarUsuarioNome($resp->dono_id);
							$id = $usu_id->retorna_dados();
							echo '<tr>'; 
								printf('<td class="center">%s</td>',$id->nome);
								printf('<td class="center">%s</td>',$resp->nome);
								printf('<td class="center">%s</td>',$resp->preco);
								printf('<td class="center">%s</td>',$resp->cor);
								printf('<td class="center">%s</td>',$resp->direcao);
								printf('<td class="center">%s</td>',$resp->transmissao);
								printf('<td class="center">%s</td>',$resp->combustivel);
								printf('<td class="center">%s</td>',$resp->kilometragem);
								printf('<td class="center">%s</td>',$resp->marca);
								printf('<td class="center">%s</td>',$resp->modelo);
								printf('<td class="center">%s</td>',$resp->ano);					
								printf('
								<td class="center">
									<div>
										<a href="?m=veiculos_usu&t=incluir&id=%s" title="Novo cadastro"><img src="img/plus.png" alt="Novo cadastro" /></a>
										<a href="?m=veiculos_usu&t=editar&id=%s" title="Editar"><img src="img/edit.png" alt="Editar" /></a> 
										<a href="?m=veiculos_usu&t=excluir&id=%s" title="Excluir"><img src="img/cancel.png" alt="Excluir" /></a>
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
			echo '<h2>Edição de Veículos</h2>';
			$sessao = new sessao();
			$atualizar_file = FALSE;
			if(isAdmin() == TRUE || $sessao->getVar('id_user') == $_GET['id']):
				if(isset($_GET['id'])):
					$id = $_GET['id'];	
					if(isset($_POST['editar'])):
						$u = new usuarioDeVendaCarro(array(
							"login" 			=> $_POST['login']
							));
						$u->retornarUsuarioIndice($u->getValor('login'));
						$resp = $u->retorna_dados();
						
						$veiculo_bd = new objVeiculosUsu(array(
							"dono_id"		=> $resp->id,
							"nome" 			=> $_POST['nome'],
							"preco"			=> $_POST['preco'],
							"cor"			=> $_POST['cor'],
							"categoria"		=> $_POST['categoria'],
							"estado"		=> $_POST['estado'],
							"cambio"		=> $_POST['cambio'],
							"cilindrada"	=> $_POST['cilindrada'],
							"direcao"		=> $_POST['direcao'],
			 				"transmissao"	=> $_POST['transmissao'],
							"combustivel"	=> $_POST['combustivel'],
							"portas"		=> $_POST['portas'],
							"kilometragem"	=> $_POST['kilometragem'],
							"marca"			=> $_POST['marca'],
							"modelo"		=> $_POST['modelo'],
							"ano"			=> $_POST['ano'],
							"versao"		=> $_POST['versao'],
							"img_1"			=> preparar_nome($_FILES['img_1']),
							"img_2"			=> preparar_nome($_FILES['img_2']),
							"img_3"			=> preparar_nome($_FILES['img_3']),
							"img_4"			=> preparar_nome($_FILES['img_4']),
							"descricao"		=> $_POST['descricao'],
									));
						$veiculo_bd->valor_pk = $id;
						$veiculo_bd->extras_select =  " WHERE id=$id";
						$veiculo_bd->seleciona_tudo($veiculo_bd);
						$resp = $veiculo_bd->retorna_dados();
						
						$veiculo_bufer = new objVeiculosUsu();
						$veiculo_bufer->extras_select = " WHERE id=$id";
						$veiculo_bufer->seleciona_tudo($veiculo_bufer);
						$veiculo_bufer_r = $veiculo_bufer->retorna_dados();
						$B_IMG_1 = $veiculo_bufer_r->img_1;
						
						$veiculo_bd->atualizar($veiculo_bd);
						$atualizar_file = TRUE;
						if($veiculo_bd->linhas_afetadas == 1):
							printMsg('Dados alterados com sucesso. <a href="?m=veiculos_usu&t=listar">Exibir cadastros</a>');
							unset($_POST);
						else:
							printMsg('Nenhum dado foi alterado. <a href="?m=veiculos_usu&t=listar">Exibir cadastros</a>','alerta');	
						endif;
						
					endif;
					
					$veiculo_dono = new objVeiculosUsu();
					$veiculo_dono->extras_select = " WHERE id=$id";
					$veiculo_dono->seleciona_tudo($veiculo_dono);
					$veiculo_dono_r = $veiculo_dono->retorna_dados();
					
					if($atualizar_file == TRUE):
						if($B_IMG_1):
							$dir = 'img_lojas/exclusivos/'.$B_IMG_1;
							apaga_diretorio($dir);
							criar_diretorio_veiculos('exclusivos', $veiculo_bd->getValor('img_1'));
							upload_mestre('exclusivos',$_FILES['img_1'],'exclusivos/'.$veiculo_bd->getValor('img_1'),$veiculo_bd->getValor('img_1'),'img_lojas',500);
							upload_mestre('exclusivos',$_FILES['img_2'],'exclusivos/'.$veiculo_bd->getValor('img_1'),$veiculo_bd->getValor('img_2'),'img_lojas',500);
							upload_mestre('exclusivos',$_FILES['img_3'],'exclusivos/'.$veiculo_bd->getValor('img_1'),$veiculo_bd->getValor('img_3'),'img_lojas',500);
							upload_mestre('exclusivos',$_FILES['img_4'],'exclusivos/'.$veiculo_bd->getValor('img_1'),$veiculo_bd->getValor('img_4'),'img_lojas',500);
						else:
							printMsg('Ocorreu um erro no caminho da pasta especificada','erro');	
						endif;
						endif;
				else:
					printMsg('Veículo não definido, <a href="m=veiculos_usu&t=listar">Escolha um veículo para alterar</a>','erro');
				endif;
				?>
				
				<script type="text/javascript">
				$(document).ready(function(){
					$(".userForm").validate({
						rules:{
							usu_nome:{required:true},
							nome:{required:true},
							cor:{required:true},
							tipo:{required:true},
							combustivel:{required:true},
							kilometragem:{required:true},
							marca:{required:true},
							ano:{required:true},
							img_1:{required:true},
							img_2:{required:true},
							img_3:{required:true},
							img_4:{required:true},
							descricao:{required:true}
						}
					});
				});
			</script>
			<form class="userForm" method="post" action="" enctype="multipart/form-data">
				<fieldset><legend>Informe os dados para alteração.</legend>
				<ul>
				<?php 
						$dono = new objVeiculosUsu();
						$dono->retornarUsuarios(); 
						
						if($veiculo_dono_r):
							$dono_id = $veiculo_dono_r->dono_id;
							$meu_carro = new objVeiculosUsu();
							$meu_carro->retornarLogin($dono_id);
							$meu_login = $meu_carro->retorna_dados();
						endif;	
					?>
					<li><label for="login">Dono do anuncio:</label> <select name="login" autofocus="autofocus">
						<option><?php echo $meu_login->login ?></option>
					<?php 
						while($resp = $dono->retorna_dados()):
							echo '<option>'.$resp->login.'</option>';
						endwhile;
					?>	
					</select></li>
					<li><label for="nome">Nome:</label> <input type="text" size="50" name="nome" value="<?php if($veiculo_dono_r) echo $veiculo_dono_r->nome ?>">
					</li>
					<li><label for="preco">preço:</label> <input type="text" size="50" name="preco" value="<?php if($veiculo_dono_r) echo $veiculo_dono_r->preco ?>">
					</li>
					<li><label for="cor">Cor:</label> <input type="text" size="50" name="cor" value="<?php if($veiculo_dono_r) echo $veiculo_dono_r->cor ?>">
					</li>
					<li><label for="categoria">Categoria:</label> <select name="categoria">
						<option><?php if($veiculo_dono_r) echo $veiculo_dono_r->categoria ?></option>
						<option>carros</option>
						<option>motos</option>
						<option>caminhão</option>
						<option>náuticos</option>
					</select></li>
					<li><label for="estado">Estado:</label> <select name="estado">
						<option><?php if($veiculo_dono_r) echo $veiculo_dono_r->estado ?></option>
						<option>Novo</option>
						<option>Seminovo</option>
						<option>Usado</option>
						<option>Velho</option>
					</select></li>
					<li><label for="cambio">Câmbio:</label> <input type="text" size="50" name="cambio" value="<?php if($veiculo_dono_r) echo $veiculo_dono_r->cambio ?>">
					</li>
					<li><label for="cilindrada">Cilindrada:</label> <input type="text" size="50" name="cilindrada" value="<?php if($veiculo_dono_r) echo $veiculo_dono_r->cilindrada ?>">
					</li>
					<li><label for="direcao">Direcão:</label> <input type="text" size="50" name="direcao" value="<?php if($veiculo_dono_r) echo $veiculo_dono_r->direcao ?>">
					</li>
					<li><label for="transmissao">Transmissao:</label> <input type="text" size="50" name="transmissao" value="<?php if($veiculo_dono_r) echo $veiculo_dono_r->transmissao ?>">
					</li>
					<li><label for="combustivel">Combustivel:</label> <input type="text" size="50" name="combustivel" value="<?php if($veiculo_dono_r) echo $veiculo_dono_r->combustivel ?>">
					</li>
					<li><label for="portas">Portas:</label> <select name="portas">
						<option><?php if($veiculo_dono_r) echo $veiculo_dono_r->portas ?></option>
						<option></option>
						<option>4</option>
						<option>1</option>
						<option>2</option>
						<option>3</option>
						<option>5</option>
						<option>6</option>
						<option>7</option>
						<option>8</option>
					</select></li>
					<li><label for="kilometragem">Kilometragem:</label> <input type="text" size="50" name="kilometragem" value="<?php if($veiculo_dono_r) echo $veiculo_dono_r->kilometragem ?>">
					</li>
					<li><label for="marca">Marca:</label> <input type="text" size="50" name="marca" value="<?php if($veiculo_dono_r) echo $veiculo_dono_r->marca ?>">
					</li>
					<li><label for="modelo">Modelo:</label> <input type="text" size="50" name="modelo" value="<?php if($veiculo_dono_r) echo $veiculo_dono_r->modelo ?>">
					</li>
					<li><label for="ano">Ano:</label> <input type="text" size="50" name="ano" value="<?php if($veiculo_dono_r) echo $veiculo_dono_r->ano ?>">
					</li>
					<li><label for="versao">Vesão:</label> <input type="text" size="50" name="versao" value="<?php if($veiculo_dono_r) echo $veiculo_dono_r->versao ?>">
					</li>
					<li><label for="img_1">1º Imagem:</label> <input type="file" size="50" name="img_1" value="<?php if($veiculo_dono_r) echo $veiculo_dono_r->img_1 ?>">
					</li>
					<li><label for="img_2">2º Imagem:</label> <input type="file" size="25" name="img_2" value="<?php if($veiculo_dono_r) echo $veiculo_dono_r->img_2 ?>">
					</li>
					<li><label for="img_3">3º Imagem:</label> <input type="file" size="50" name="img_3" value="<?php if($veiculo_dono_r) echo $veiculo_dono_r->img_3 ?>">
					</li>
					<li><label for="img_4">4º Imagem:</label> <input type="file" size="50" name="img_4"  value="<?php if($veiculo_dono_r) echo $veiculo_dono_r->img_4 ?>">
					</li>
					<li>Descricao:
					<label for="descricao"></label> <textarea name="descricao" class="ckeditor" id="editor1" cols="20" rows="5"><?php if($veiculo_dono_r) echo $veiculo_dono_r->descricao ?></textarea>
					</li>
					<li class="center"><input type="button"
						onclick="location.href='?m=veiculos_usu&t=listar'" value="Cancelar" /> <input
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
			echo '<h2>Exclusão de veículos</h2>';
			$sessao = new sessao();
			$B_IMG_1 = NULL;
			
			$deletar_pasta = FALSE;
			if(isAdmin() == TRUE):
				if(isset($_GET['id'])):
					$id = $_GET['id'];
					if(isset($_POST['excluir'])):
						$veiculo_bd = new objVeiculosUsu(array());
						$veiculo_bd->valor_pk = $id;
						$veiculo_bd->extras_select =  " WHERE id=$id";
						$veiculo_bd->seleciona_tudo($veiculo_bd);
						$resp = $veiculo_bd->retorna_dados();
						$B_IMG_1 = $resp->img_1;
						
						$veiculo_bd->deletar($veiculo_bd);
						$deletar_pasta = TRUE;
						if($veiculo_bd->linhas_afetadas == 1):
							printMsg('Registro excluido com sucesso. <a href="?m=veiculos_usu&t=listar">Exibir cadastros</a>');
							unset($_POST);
						else:
							printMsg('Nenhum registro foi excluido. <a href="?m=veiculos_usu&t=listar">Exibir cadastros</a>','alerta');	
						endif;
					endif;
					
					$veiculo = new objVeiculosUsu();
					$veiculo->extras_select = " WHERE id=$id";
					$veiculo->seleciona_tudo($veiculo);
					$veiculo_resp = $veiculo->retorna_dados();
					if($deletar_pasta == TRUE):
						if($B_IMG_1):
							$dir = 'img_lojas/exclusivos/'.$B_IMG_1;
							apaga_diretorio($dir);
						else:
							printMsg('Ocorreu um erro no caminho da pasta especificada','erro');
						endif;	
					endif;
				else:
					printMsg('Veículo não definido, <a href="m=veiculos_usu&t=listar">Escolha um veículo para excluir</a>','erro');
				endif;
				?>
				<form class="userForm" method="post" action="">
				<fieldset><legend>Dados do veículo a ser excluido do sistema.</legend>
				<ul>
				<?php 
						$usu_nome = new objVeiculosUsu();
						if($veiculo_resp):
							$dono_id = $veiculo_resp->dono_id;
						else:
							$dono_id = '';
						endif;
						$usu_nome->retornarUsuarioNome($dono_id); 
						$resp = $usu_nome->retorna_dados();
				?>
					<li><label for="loja_nome">Dono:</label> <select name="loja_nome" disabled="disabled">
						<option><?php if(isset($resp->nome))echo $resp->nome ?></option>
					</select></li>
					<li><label for="nome">Nome:</label> <input type="text" size="50" name="nome" disabled="disabled" value="<?php if($veiculo_resp) echo $veiculo_resp->nome ?>">
					</li>
					<li><label for="preco">preço:</label> <input type="text" size="50" name="preco" disabled="disabled" value="<?php if($veiculo_resp) echo $veiculo_resp->preco ?>">
					</li>
					<li><label for="cor">Cor:</label> <input type="text" size="50" name="cor" disabled="disabled" value="<?php if($veiculo_resp) echo $veiculo_resp->cor ?>">
					</li>
					<li><label for="categoria">Categoria:</label> <select name="categoria" disabled="disabled">
						<option><?php if($veiculo_resp) echo $veiculo_resp->categoria ?></option>
					</select></li>
					<li><label for="estado">Estado:</label> <select name="estado" disabled="disabled">
						<option><?php if($veiculo_resp) echo $veiculo_resp->estado ?></option>
					</select></li>
					<li><label for="cambio">Câmbio:</label> <input type="text" size="50" name="cambio" disabled="disabled" value="<?php if($veiculo_resp) echo $veiculo_resp->cambio ?>">
					</li>
					<li><label for="cilindrada">Cilindrada:</label> <input type="text" size="50" name="cilindrada" disabled="disabled" value="<?php if($veiculo_resp) echo $veiculo_resp->cilindrada ?>">
					</li>
					<li><label for="direcao">Direcão:</label> <input type="text" size="50" name="direcao" disabled="disabled" value="<?php if($veiculo_resp) echo $veiculo_resp->direcao ?>">
					</li>
					<li><label for="transmissao">Transmissao:</label> <input type="text" size="50" name="transmissao" disabled="disabled" value="<?php if($veiculo_resp) echo $veiculo_resp->transmissao ?>">
					</li>
					<li><label for="combustivel">Combustivel:</label> <input type="text" size="50" name="combustivel" disabled="disabled" value="<?php if($veiculo_resp) echo $veiculo_resp->combustivel ?>">
					</li>
					<li><label for="portas">Portas:</label> <select name="portas" disabled="disabled">
						<option><?php if($veiculo_resp) echo $veiculo_resp->portas ?></option>
					</select></li>
					<li><label for="kilometragem">Kilometragem:</label> <input type="text" size="50" name="kilometragem" disabled="disabled" value="<?php if($veiculo_resp) echo $veiculo_resp->kilometragem ?>">
					</li>
					<li><label for="marca">Marca:</label> <input type="text" size="50" name="marca" disabled="disabled" value="<?php if($veiculo_resp) echo $veiculo_resp->marca ?>">
					</li>
					<li><label for="modelo">Modelo:</label> <input type="text" size="50" name="modelo" disabled="disabled" value="<?php if($veiculo_resp) echo $veiculo_resp->modelo ?>">
					</li>
					<li><label for="ano">Ano:</label> <input type="text" size="50" name="ano" disabled="disabled" value="<?php if($veiculo_resp) echo $veiculo_resp->ano ?>">
					</li>
					<li><label for="versao">Vesão:</label> <input type="text" size="50" name="versao" disabled="disabled" value="<?php if($veiculo_resp) echo $veiculo_resp->versao ?>">
					</li>
					<li><label for="descricao">Descricao:</label> <textarea name="descricao" disabled="disabled" id="resumo" cols="20" rows="5"><?php if($veiculo_resp) echo $veiculo_resp->descricao ?></textarea>
					</li>
					<li class="center"><input type="button"
						onclick="location.href='?m=veiculos_usu&t=listar'" value="Cancelar" /> <input
						type="submit" name="excluir" value="Excluir dados" /></li>
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