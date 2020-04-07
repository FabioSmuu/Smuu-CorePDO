<?php
@include_once '#/core.php';

//Se não tiver logado, vá para o diretorio "/painel".
logado(true, 'painel');
?>

<meta charset="UTF-8">

<form role="form" method="post" action="">
	<center><?=cadastrar('nome', 'email', 'senha')?></center>

	<input type="text" name="nome" maxlength="13" placeholder="Usuario">
	<input type="email" name="email" placeholder="Email">
	<input type="password" name="senha" placeholder="Senha">
	<button type="submit" name="register">Criar Conta</button>
	
	<p class="message">Já tem conta? <a href="/">Faça login</a></p>
</form>