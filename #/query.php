<?php
function plano($id, $coluna)
{
	$id = filtrar($id);
	$coluna = filtrar($coluna);
	
	$db = ler("SELECT * FROM planos WHERE id = '$id'");
	return $db[$coluna];
}

function perm($perm, $plano)
{
	if(!isset($plano)) $plano = user('plano');
	$plano = filtrar($plano);
	$perm = filtrar($perm);
	
	$retorno = ler("SELECT * FROM plano_perms WHERE tipo = 'minimo' AND perm = '$perm' ORDER BY plano LIMIT 1;");
	if ($retorno && $plano >= $retorno['plano']) return true;
	else
	{
		$retorno = ler("SELECT * FROM plano_perms WHERE plano = '$plano' AND perm = '$perm' LIMIT 1;");
		if ($retorno) return true;
	}
}

//
function user($coluna, $user)
{
	if(!isset($user)) $user = filtrar($_SESSION['username']);
	$user = filtrar($user);
	
	$user = ler("SELECT * FROM users WHERE email = '$user' OR id = '$user' LIMIT 1;");
	
	return ($coluna == 'expira' && $user[filtrar($coluna)] === '0000-00-00') ? 'Sem data de expiração' : $user[filtrar($coluna)];
}

//
function novidaderanking()
{
	$db = lista("SELECT * FROM users ORDER BY novidades DESC LIMIT 10;");

	foreach ($db as $id => $valor)
	{
		$r .= '<tr>'.
			'<th>'.($id+1).'</th>'.
			'<th>'.$valor['nome'].'</th>'.
			'<th>'.$valor['novidades'].'</th>'.
			'<th><span class="badge badge-primary" style="background:#'.plano($valor['plano'], 'cor').';">'.plano($valor['plano'], 'nome').'</span></th>'.
			'</tr>';
	}
	
	return $r;
}

//
function novidadecontia($user)
{
	if(!isset($user)) $user = filtrar($_SESSION['username']);
	$user = filtrar($user);
	$sessaoid = filtrar(userid($user));
	
	$contia = contar("SELECT * FROM novidades WHERE autorid = '$sessaoid'");
	executar("UPDATE users SET novidades='$contia' WHERE id='$sessaoid'");
	
	return $contia;
}

//
function novidadegrafico($user)
{
	if(!isset($user)) $user = filtrar($_SESSION['username']);
	$user = filtrar($user);
	$sessaoid = filtrar(userid($user));
	
	$db = lista("SELECT * FROM novidades WHERE autorid = '$sessaoid'");

	foreach ($db as $id => $valor)
	{
		$data = substr($valor['verificada'], 0, 10);
		$contia->$data++;
		$resultado = json_encode($contia);
	}
	
	return $resultado;
}

//
function novidade($user)
{
	if(!isset($user)) $user = filtrar($_SESSION['username']);
	$user = filtrar($user);
	$sessaoid = filtrar(userid($user));
	
	executar("UPDATE users SET novanovidade='0' WHERE id = '$sessaoid'");
	$db = lista("SELECT * FROM novidades WHERE autorid = '$sessaoid'");

	foreach ($db as $id => $valor)
	{
		print 'ID: '. $valor['id'] .'<br>'. $valor['nome'] .'<br>'. $valor['noticia']
	}
}

//
function devnovidade($user)
{
	//nulo
}
