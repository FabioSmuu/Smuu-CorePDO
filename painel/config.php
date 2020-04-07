<?php
$pagina = 'config';
$titulo = 'Painel ~ Configurações';
$navtitulo = 'Configurações';

@include_once 'include/dependencias.php';

//Se não tiver logado, vá para o diretorio "/".
logado(false, '/');

@include_once 'include/menu.php';
@include_once 'include/navbar.php';
?>

<form name="from" action="" method="post">
	<center><?=redefinir('pass', 'newpass', 'repet-pass')?></center>
	
	<label>usuario </label>
	<input type="text" disabled="" placeholder="Company" value="<?=user('nome')?>">

	<label>E-mail </label>
	<input type="text" disabled="" placeholder="Company" value="<?=user('email')?>">

	<label>Senha atual </label>
	<input type="password" name="pass" placeholder="Senha atual" value="">

	<label>Nova senha </label>
	<input type="password" name="newpass" placeholder="Nova senha" value="">

	<label>Repita Senha </label>
	<input type="password" name="repet-pass" placeholder="Repita a senha" value="">

	<button type="submit" name="save1" class="btn btn-info btn-fill pull-right">Salvar</button>
</form>

<?php @include_once 'include/footer.php'; ?>