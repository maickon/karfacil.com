<?php 
require_once("funcoes.php");
protegeArquivo(basename(__FILE__));
verificaLogin();
$sessao = new Sessao();
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<?php 
loadCss('data_table'); 
loadCss('reset'); 
loadCss('style'); 
loadJs('geral');
loadJs('jquery_datatables');
loadJs('jquery_validate_messages');
loadJs('jquery_validate');
loadJs('jquery');
//loadJs('https://jquery.com/jquery/jquery.js',TRUE);
?>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>Karfacil.com</title>
</head>
<body class="painel">
	
	<div id="wrapper">
		<a href="<?php echo BASEURL.'?p=home' ?>" class="link">
			<div id="header">
				<p class="painel_adm">Painel adminstrativo</p>
					<p class="painel_adm_time" align="right"><?php echo hora_atual().'<br>'.data_atual($sessao->getVar('nome_user'));?></p>
			</div><!-- fim header -->
		</a>
		
		