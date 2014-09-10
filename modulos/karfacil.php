<?php
require_once(dirname(dirname(__FILE__))."/funcoes.php");
$img_path = BASEURL."img_karfacil/";
$modulos_path = BASEURL.'modulos/';	
loadCss('slide'); 
loadJs('destaques');
loadJs('jcycle');

loadJs('jquery.elevateZoom');
loadJs('jquery-1.8.3.min');

if($tela == 'principal'): 
?>
<div class="container">
		<div class="header">
        	<a href="<?php echo BASEURL.'?p=home' ?>"><img src="<?php echo $img_path.'karfacil.jpg' ?>" alt="Karfacil.com" name="Karfacil.com" width="100%" height="242" id="Insert_logo" style="background: #8090AB; display:block;" /></a> 
		</div><!-- end .header(cabeçalho) -->
		<div id='cssmenu'>
			<ul>
			   <li><a href="?p=home"><span>Home</span></a></li>
			   <li class='has-sub '><a href="?p=quemsomos"><span>Quem somos</span></a></li>
			   <li class='has-sub '><a href="?p=empresa"><span>Empresa</span></a></li>
			   <li class='has-sub '><a href="?p=servicos"><span>Serviços</span></a></li>
			   <li class='has-sub '><a href="?p=parceiros"><span>Parceiros</span></a></li>
			   <li class='has-sub '><a href="?p=contato"><span>Contato</span></a></li>
			   <li class='has-sub '><a href='?p=noticias_listar'><span>Noticias</span></a></li>
			   <?php echo sair_index();?>
			</ul>
		</div>
        
       
		<div class="sidebar1">
		
			<?php loadModuo('busca_geral','principal')?>
			<?php loadModuo('importantes_itens_menu','principal')?>
			<?php loadModuo('lojas_logo','principal')?>
             
        </div><!-- end .sidebar1(menu lateal esquerdo) -->
        
        <div class="content">
            <?php 
            	if (isset($_GET['p'])):
	            	switch ($_GET['p']):
						case 'adm': loadModuo('usuarios','login');
						break;
						
						case 'parceiros': loadModuo('listar_parceiros','principal');
						break;
						
						case 'quemsomos':loadModuo('quemsomos','principal');
						break;
						
						case 'home':loadModuo('home','principal');
						break;
						
						case 'exibir_not':loadModuo('noticia_exibir','principal');
						break;
						
						case 'noticias_listar':loadModuo('noticias_listar','principal');
						break;
						
						case 'empresa':loadModuo('empresa','principal');
						break;
						
						case 'servicos':loadModuo('servicos','principal');
						break;
						
						case 'contato':loadModuo('contato','principal');
						break;
						
						case 'veiculos':loadModuo('exibir_veiculos','principal');
						break;
						
						case 'listar_veiculos':loadModuo('listar_veiculos','principal');
						break;
						
						case 'listar_exclusivos':loadModuo('listar_exclusivos','principal');
						break;
						
						case 'listar_propagandas':loadModuo('listar_propagandas','principal');
						break;
						
						case 'listar_lojas':loadModuo('listar_lojas','principal');
						break;

						case 'listar_tudo':loadModuo('listar_tudov','principal');
						break;
						
						case 'result_geral':loadModuo('result_geral','principal');
						break;
						
						default:loadModuo('home','principal');
						break;
	            	endswitch;
	            else:
	            	if(isset($_GET['desc_vl']) && isset($_GET['id'])):
	            		loadModuo('desc_vl','principal');
	            	else:
	            		if(isset($_GET['desc_ve']) && isset($_GET['id'])):
	            			loadModuo('desc_ve','principal');
		            	else:
		            		if(isset($_GET['desc_p']) && isset($_GET['id'])):
		            			loadModuo('desc_prop','principal');
		            		else:
		            			if(isset($_GET['desc_l']) && isset($_GET['id'])):
		            				loadModuo('desc_loja','principal');
		            			else:
		            				loadModuo('home','principal');		
		            			endif;		
		            		endif;
		            	endif;	
		            endif;
				endif;
            ?>
        </div><!-- end .content(corpo do site) -->
        
        <div class="sidebar2"> 
            <?php loadModuo('noticia_menu','principal')?> 
            <a href="#" alt="Propaganda premium1" title="Este espaço foi feito para apenas um cliente premium. Aqui sua logomarca sempre será vista, independente de quantas atualizações a página tiver." src="#">
				<img id="img_logo_static" alt="Loja premium" src="<?php echo BASEURL.'img_karfacil/premium.png'?>" width="100" height="100">
			</a>
			<p>Olugin do facebook</p>
            <hr />
            <?php loadModuo('propagandas','principal')?>
        </div><!-- end .sidebar2(menu lateal direito) -->
        
        <div class="footer">
            <p><a class="link" href="https://www.facebook.com/pages/karfacilcom/1374528982763546">Karfacil.com &copy; 2013</a> </p>
            <p><a class="link" href="https://www.facebook.com/maickon.rangel">Desenvolvido por Maickon Rangel</a></p>
        </div><!-- end .footer(rodapé) -->
    
</div><!-- end .container(fim do site inteiro) -->
<?php endif;?>
