<?php
@include_once '../../#/core.php';

logado(false, '/');

if (isset($_POST['code']))
{
	$codigo = filtrar($_POST['code']);
	$autorid = userid();

	$voucher = ler("SELECT * FROM vouchers WHERE codigo = '$codigo' LIMIT 1;");
	$usarvoucher = ler("SELECT * FROM users_vouchers WHERE codigo = '$codigo' AND autorid = '$autorid' LIMIT 1;");

	if ($voucher)
	{
		if ($voucher['usado'] >= $voucher['contia']) $log = 'limitado';
		elseif ($usarvoucher) $log = 'usado';
		elseif (user('plano') >= $voucher['plano'])
		{
			$hoje = date('Y-m-d');
			$expira = date('Y-m-d', strtotime(user('expira'). '+'.$voucher['dias'].' DAY'));

			executar("UPDATE vouchers SET usado = usado+1 WHERE codigo = '$codigo';");
			executar("INSERT INTO users_vouchers (autorid, codigo) VALUES ('$autorid', '$codigo');");
			executar("UPDATE users SET expira='$expira', comprado='$hoje' WHERE id = '$autorid';");
			
			$log = 'superior';
		}
		else
		{
			$hoje = date('Y-m-d');
			$expira = date('Y-m-d', strtotime($hoje. '+'.$voucher['dias'].' DAY'));
			
			executar("UPDATE vouchers SET usado = usado+1 WHERE codigo = '$codigo';");
			executar("INSERT INTO users_vouchers (autorid, codigo) VALUES ('$autorid', '$codigo');");
			executar("UPDATE users SET plano='". $voucher['plano'] ."', expira='$expira', comprado='$hoje' WHERE id = '$autorid';");
			
			$log = $voucher['menssagem'];
		}
	}
	else $log = 'invalido';
}

print $log;