<?php
@include_once '../../#/core.php';

logado(false, '/');

if (isset($_GET['id']))
{
	$id = filtrar($_GET['id']);
	$autorid = userid();
	
	if (perm('perm_delatarnovidades')) {
		$novidade = ler("SELECT * FROM novidades WHERE autorid = '$autorid' AND id = '$id' LIMIT 1;");
		if ($novidade)
		{
			executar("DELETE FROM novidades WHERE id = '$id';");
			novidadecontia();
		}	
	}
}