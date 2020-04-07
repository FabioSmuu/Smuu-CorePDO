<?php
function ativar($p) {
	global $pagina;
	return $p == $pagina ? 'class="active"' : null;
}

if (!perm('menu'.$pagina)) header("Location: /");
?>

<ul class="nav">
	<?php if (perm('perm_menudev')) {?>
	<li <?=ativar("dev")?>><a href="dev.php">
		<p>Developer  <span class="badge" style="background:#323c39;">NOVO</span></p>
	</a></li>
	<?php } ?>

	<li <?=ativar("index")?>><a href="index.php">
		<p>Estatísticas</p>
	</a></li>

	<li <?=ativar("paginas")?>><a href="paginas.php">
		<p>Páginas Prontas</p>
	</a></li>

	<li <?=ativar("adder")?>><a href="adder.php">		
		<p>novidades adder <span class="badge aviso" style="background:#e25f5f;">0</span></p>
	</a></li>

	<li <?=ativar("config")?>><a href="config.php">
		<p>Configurações</p>
	</a></li>

	<li class="active active-pro" ><a href="upgrade.php">
		<p>Faça upgrade</p>
	</a></li>

</ul>