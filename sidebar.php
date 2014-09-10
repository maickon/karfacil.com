<?php 
require_once("funcoes.php");
loadJs('geral');
loadCss('menu_dropdown');
protegeArquivo(basename(__FILE__));
?>
<div>
<div id='cssmenu'>
			<ul>
			   <li class='has-sub '><a href="?m=sistema&t=listar"><span>Site</span></a>
		           <ul>
			           <li><a href="?m=sistema&t=incluir"><span>Cadastrar banner</span></a></li>
			           <li><a href="?m=sistema&t=listar"><span>Exibir</span></a></li>
		           </ul>
			   </li>
			   <li class='has-sub '><a href="?m=noticia&t=listar"><span>Publicar noticia</span></a>
		           <ul>
			           <li><a href="?m=noticia&t=incluir"><span>Nova noticia</span></a></li>
			           <li><a href="?m=noticia&t=listar"><span>Exibir</span></a></li>
		           </ul>
			   </li>
			   <li class='has-sub '><a href="?m=usuarios&t=listar"><span>Usuários</span></a>
		           <ul>
			           <li><a href="?m=usuarios&t=incluir"><span>Cadastrar </span></a></li>
			           <li><a href="?m=usuarios&t=listar"><span>Exibir</span></a></li>
		           </ul>
			   </li>
			   <li class='has-sub '><a href="?m=veiculos&t=listar&q=loja"><span>Veículos de lojas</span></a>
		           <ul>
			           <li><a href="?m=veiculos&t=incluir&q=loja"><span>Cadastrar </span></a></li>
			           <li><a href="?m=veiculos&t=listar&q=loja"><span>Exibir</span></a></li>
		           </ul>
			   </li>
			   <li class='has-sub '><a href="?m=prop&t=listar"><span>Propagandas</span></a>
		           <ul>
			           <li><a href="?m=prop&t=incluir"><span>Cadastrar </span></a></li>
			           <li><a href="?m=prop&t=listar"><span>Exibir</span></a></li>
		           </ul>
			   </li>
			   <li class='has-sub '><a href="?m=veiculos&t=listar&q=usu"><span>Veículos exclusivos</span></a>
		           <ul>
			           <li><a href="?m=veiculos&t=incluir&q=usu"><span>Cadastrar </span></a></li>
			           <li><a href="?m=veiculos&t=listar&q=usu"><span>Exibir</span></a></li>
		           </ul>
			   </li>
			    <li class='has-sub '><a href="?m=lojas&t=listar"><span>Lojas</span></a>
		           <ul>
			           <li><a href="?m=lojas&t=incluir"><span>Cadastrar </span></a></li>
			           <li><a href="?m=lojas&t=listar"><span>Exibir</span></a></li>
		           </ul>
			   </li>
			   <li class='has-sub '><a href="?m=agenda&t=listar"><span>Agenda</span></a>
		           <ul>
			           <li><a href="?m=agenda&t=incluir"><span>Cadastrar </span></a></li>
			           <li><a href="?m=agenda&t=listar"><span>Exibir</span></a></li>
		           </ul>
			   </li>
			   <li class='has-sub '><a href="?m=parceiros&t=listar"><span>Parceiros</span></a>
		           <ul>
			           <li><a href="?m=parceiros&t=incluir"><span>Cadastrar </span></a></li>
			           <li><a href="?m=parceiros&t=listar"><span>Exibir</span></a></li>
		           </ul>
			   </li>
			   <?php 
				//$sessao = new sessao();
				$meu_id = $sessao->getVar('id_user');
				?>
				<li class='has-sub '><a href="?m=usuarios&t=senha&id=<?php echo $meu_id; ?>"><span>Alterar senha </span></a></li>
				<li class='has-sub '><a href="?logoff=true"><span>Sair</span></a></li>
			</ul>
		</div>
</div>		