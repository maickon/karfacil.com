<?php
require_once(dirname(dirname(__FILE__))."/funcoes.php");
// echo basename(__FILE__); retorna o nome do arquivo
loadJs('jquery_validate');
loadJs('jquery_validate_messages');
loadJs('geral');
protegeArquivo(basename(__FILE__));
if($tela):
	?>
	
	<?php 

	if(isset($_POST['enviar'])):
		$nome = strip_tags(trim(antiInject($_POST['nome'])));
		$email = strip_tags(trim(antiInject($_POST['email'])));
		$assunto = strip_tags(trim(antiInject($_POST['assunto'])));
		$mensagem = strip_tags(antiInject($_POST['mensagem']));
		
		$headers  = "From: $email\r\n";
    	$headers .= "Reply-To: $email\r\n";
         
       	$corpo = "Formulário enviado\n";
      	$corpo .= "Nome: " . $nome . "\n";
       	$corpo .= "Email: " . $email . "\n";
       	$corpo .= "Comentários: " . $mensagem . "\n";
     
       	$email_to = 'karfacil.com@gmail.com';
      
  	  	if(mail($email_to, $subject, $corpo, $headers)):
        	echo '<p class="sucesso">E-mail enviado com sucesso !</p>'; 
    	else:
	        echo '<p class="falha">Um erro ocorreu, tente novamente.</p>';
		endif;
	endif;	
?>
	<script type="text/javascript">
				$(document).ready(function(){
					$(".userForm").validate({
						rules:{
							nome:{required:true},
							email:{required:true,email:true},
							assunto:{required:true},
							mensagem:{required:true}
						}
					});
				});
			</script>
			<div class="form_email">
				<form class="userForm" method="post" action="">
					<fieldset><legend>Entre em contato conosco, retornaremos o mais rápido possivel.</legend>
					<ul>
						<li><label for="nome">Nome:</label> <input type="text" size="50" name="nome" value="">
						</li>
						<li><label for="email">Email:</label> <input type="text" size="50" name="email" value="">
						</li>
						<li><label for="assunto">Assunto:</label> <input type="text" size="50" name="assunto" value="">
						</li>
						<br />
						<li><label for="mensagem">Mensagem:</label> <textarea name="mensagem" cols="20" rows="5"></textarea>
						</li>
						<li class="center">
						<input type="button" onclick="location.href='?m=contato&t=principal'" value="Cancelar" /> 
						<input type="submit" name="enviar" value="Enviar" /></li>
					</ul>
					</fieldset>		
				</form>
				<br>
				<br>
				<br>
				<br>
				<br>
				<br>
			</div>	
<?php endif; ?>