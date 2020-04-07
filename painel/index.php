<?php
$pagina = 'index';
$titulo = 'Painel ~ Estatísticas';
$navtitulo = 'Estatísticas';

@include_once 'include/dependencias.php';

//Se não tiver logado, vá para o diretorio "/".
logado(false, '/');

@include_once 'include/menu.php';
@include_once 'include/navbar.php';
?>

<h4>Seu ID</h4>
<p><?=user('id')?></p>
<br>

<h4>novidades totais</h4>
<p><?=novidadecontia()?></p>
<br>

<table>
	<thead>
		<tr>
			<th>Posição</th>
			<th>Usuário</th>
			<th>novidades</th>
			<th>Plano</th>
		</tr>
	</thead>
	<tbody>			
		<?=novidaderanking()?>
	</tbody>
</table>
			
 <?php @include_once 'include/footer.php'?>