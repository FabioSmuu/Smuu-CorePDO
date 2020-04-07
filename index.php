<?php
@include_once '#/core.php';

if(isset($_GET['sair'])) deslogar();
	
//Se não tiver logado, vá para o diretorio "/painel".
logado(true, 'painel/index.php');
?>

<meta charset="UTF-8">
<form role="form" method="post" action="">
	<center><?=logar('email', 'senha')?></center>
	
	<input type="email" name="email" required="" placeholder="E-mail">
	<input type="password" name="senha" required="" placeholder="senha">
	<button type="submit" name="logar">login</button>
	
	<p class="message">Não é cadastrado? <a href="register.php">Crie sua conta</a><br>Esqueceu sua senha? <a href="recuperar.php">Recupere</a></p>
</form>