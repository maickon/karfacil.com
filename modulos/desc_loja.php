<?php
require_once(dirname(dirname(__FILE__))."/funcoes.php");

$loja = new objLojas();
$loja->extras_select = " WHERE id=".$_GET['id'];
$loja->seleciona_tudo($loja);
$loja_resp = $loja->retorna_dados();
?>

<div class="v_desc radius5" align="center"> 
	<?php echo '<h1>Visite a '.$loja_resp->nome.'</h1>' ?>
	<a class="faixa" href="#" title=""></a>
    	<ul>
        	<li>
            	<a href="">
            		<img src="<?php echo IMGLOJASPATH.$loja_resp->nome.'/'.$loja_resp->logo ?>" alt="<?php echo $loja_resp->nome ?> destaque" />
            	</a>
                <div class="fundo"></div>
                <p>
                	<?php echo $loja_resp->nome ?>, Confira nossos carros.
                </p>            
            </li>
		</ul>
		
	<div> 
		<p><?php exibirloja($loja_resp)?></p>
	</div>
</div>		   
<?php 
$loja_v = new objVeiculosLoja();
$loja_v->extras_select = " WHERE loja_id=".$_GET['id'];
$loja_v->seleciona_tudo($loja_v);
?>
<div class="vitrine" align="center">
	<?php while($lojav_resp = $loja_v->retorna_dados()):?>
	<div class="imagem">
     <div class="bg_imagem">
       <a href="?desc_v=true&id=<?php echo $lojav_resp->id ?>&l_nome=<?php echo $loja_resp->nome ?>&l_id=<?php echo $loja_resp->id?>&l_logo=<?php echo $loja_resp->logo?>">
          <img src="<?php echo IMGLOJASPATH.$loja_resp->nome.'/'.$lojav_resp->img_1.'/'.$lojav_resp->img_1?>" alt="<?php echo $lojav_resp->nome ?>" width="235" height="150" /></a>
     </div>
      <div class="legenda_todo">
          <div class="legenda"><?php echo $lojav_resp->nome ?> </div>
          <div class="legenda"><?php echo $lojav_resp->preco ?></div>
          <div class="legenda"><?php echo $lojav_resp->ano ?></div>
      </div>   
    </div>
    <?php endwhile;?> 
</div>
           	          