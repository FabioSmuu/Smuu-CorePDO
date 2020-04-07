<?php
$pagina = 'upgrade';
$titulo = 'Painel ~ faça upgrade do seu plano.';
$navtitulo = 'Nossos planos';

@include_once 'include/dependencias.php';

//Se não tiver logado, vá para o diretorio "/".
logado(false, '/');

@include_once 'include/menu.php';
@include_once 'include/navbar.php';
?>
	
<h4>Seu Plano atual</h4>
<span style="background:#<?=plano(user('plano'), 'cor')?>;"><?=plano(user('plano'), 'nome')?></span>

<h4>Expira em</h4>
<p><?=user('expira')?></p>

<p>Planos</p>
<tbody>
	<th><?=plano('0', 'nome')?></th>
	<th><?=plano('1', 'nome')?></th>
	<th><?=plano('2', 'nome')?></th>

	<td>Deletar novidade por novidade</td>

	<tr><td>Emblema no ranking</td>
		<td><i><span style="background:#<?=plano('0', 'cor')?>;"><?=plano('0', 'nome')?></span></i></td>
		<td><i><span style="background:#<?=plano('1', 'cor')?>;"><?=plano('1', 'nome')?></span></i></td>
		<td><span style="background:#<?=plano('2', 'cor')?>;"><?=plano('2', 'nome')?></span></td>
	</tr>

	<?php
		$s = '<td><i class="fa fa-check text-success"></i></td>';
		$n = '<td><i class="fa fa-times text-danger"></i></td>';
		
		print (perm('perm_delatarnovidades', '0')) ? $s : $n;
		print (perm('perm_delatarnovidades', '1')) ? $s : $n;
	?>
	 <tr>
		<td>Tempo de expiração</td>
		<td><?=plano('0', 'dias')?> dias</td>
		<td><?=plano('1', 'dias')?> dias</td>
		<td><?=plano('2', 'dias')?> dias</td>
	</tr>
	<tr>
		<td></td>
		<td>Free</td>
		<td>R$<?=plano('1', 'preco')?>/mes</td>
		<td>R$<?=plano('2', 'preco')?>/mes</td>
	</tr>
</tbody>
		
<?php @include_once 'include/footer.php'; ?>