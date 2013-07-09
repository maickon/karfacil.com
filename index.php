<?php require_once('funcoes.php');?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html4/loose.dtd">
<html>
<head>
<?php 
loadCss('reset'); 
loadCss('data_table'); 
loadCss('style');
loadCss('vitrine');
loadCss('slide'); 
loadCss('menu_dropdown'); 
loadCss('karfacil'); 
loadJs('geral');
loadJs('destaques');
loadJs('jcycle');
loadJs('jquery_datatables');
loadJs('jquery_validate_messages');
loadJs('jquery_validate');
loadJs('jquery');
loadJs('ckeditor/ckeditor');

loadJs('jquery.elevateZoom');
loadJs('jquery-1.8.3.min');

//loadJs('https://jquery.com/jquery/jquery.js',TRUE);
?>
<meta http-equiv="Content-Type" content="text/html; charset=ISO-8859-1">
<title>Karfacil.com</title>
</head>
<body class="painel">
<div id="fb-root"></div>
<script>(function(d, s, id) {
  var js, fjs = d.getElementsByTagName(s)[0];
  if (d.getElementById(id)) return;
  js = d.createElement(s); js.id = id;
  js.src = "//connect.facebook.net/pt_BR/all.js#xfbml=1";
  fjs.parentNode.insertBefore(js, fjs);
}(document, 'script', 'facebook-jssdk'));</script>

	<?php loadModuo('karfacil','principal');?>
<script>
    $('#zoom_01').elevateZoom();
</script>
</body>
</html>	
		
		