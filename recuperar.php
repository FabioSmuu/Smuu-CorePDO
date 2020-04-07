<?php
@include_once '#/core.php';

//Se não tiver logado, vá para o diretorio "/painel".
logado(true, 'painel');
?>

<meta charset="UTF-8">
<form role="form" method="post" action="">
	<center><?=recuperar('nome', 'email')?></center>

	<input type="txt" name="nome" placeholder="Username">
	<input type="email" name="email" placeholder="Email">
	<button type="submit" name="recupera">Recuperar</button>
	
	<p class="message">Já recuperou a conta? <a href="/">Faça login</a></p>
	
</form>