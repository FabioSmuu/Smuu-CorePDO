<?php
////////////////////////////////////////
//	- Anti Session-Inject
function verificarsessao()
{
	if (!empty($_SESSION['username']) && !empty($_SESSION['password']))
	{
		$email = filtrar($_SESSION['username']);
		$senha = filtrar($_SESSION['password']);
		
		if ($senha !== user('senha', $email)) deslogar();
	}
}

function expirarplano()
{
	if (!empty($_SESSION['username']))
	{
		$email = filtrar($_SESSION['username']);
		$expira = user('expira', $email);
		
		if ($expira != 'Sem data de expiração' && strtotime($hoje) >= strtotime($expira))
		{
			//Plano acabou.
			executar("UPDATE users SET plano='0', comprado='0000-00-00', expira='0000-00-00' WHERE email='$email'");
		}
	}
}

////////////////////////////////////////
//	- Verificar login efetuado
function logado($logado, $redireciona = '/')
{
	//if (userid()) header("Location: $redireciona");
	if ($logado != empty($_SESSION['username'])) header("Location: $redireciona");
}

////////////////////////////////////////
//	- Desloga session
function deslogar()
{
	@session_destroy();
	header("location: /");
}

////////////////////////////////////////
//	- Logar
function logar($email, $senha)
{
	if(isset($_POST[$email]) && isset($_POST[$senha]))
	{
		global $erro;
		$email = strtolower(filtrar($_POST[$email]));
		$senha = filtrar($_POST[$senha]);
		
		if(empty($email)) $log = $erro['login_usuario'];
		elseif(empty($senha)) $log = $erro['login_senha'];
		else
		{
			$senha = desfoque($senha);
			
			if ($senha === user('senha', $email))
			{
				$_SESSION['username'] = $email;
				$_SESSION['password'] = $senha;
				header("location: /");
				exit;
			} else $log = $erro['login_conta'];
		}
	}
	
	if (isset($log)) return '<div style="width:937px;max-width:100%" class="alert alert-danger"><strong>'.$log.'</strong></div>';
}

////////////////////////////////////////
//	- ID do usuario
function userid($nome)
{
	if(!isset($nome)) $nome = filtrar($_SESSION['username']);
	$user = ler("SELECT id FROM users WHERE email = '".filtrar($nome)."' OR nome = '".filtrar($nome)."' LIMIT 1");
	return $user[0];
}

////////////////////////////////////////
//	- Cadastrar
function cadastrar($nome, $email, $senha)
{
	if(isset($_POST[$email]) && isset($_POST[$$nome]) && isset($_POST[$senha]))
	{
		global $erro;
		$nome = filtrar($_POST[$nome]);
		$email = filtrar($_POST[$email]);
		$senha = filtrar($_POST[$senha]);
		$cadastro = date('Y-m-d');
		
		if(empty($email)) $log = $erro['cadastro_email'];
		elseif(empty($nome)) $log = $erro['cadastro_nome'];
		elseif(empty($senha)) $log = $erro['cadastro_senha'];
		elseif (strlen($senha) < 6) $log = $erro['cadastro_senhacurta'];
		else
		{
			$senha = desfoque($senha);
			
			$check = ler("SELECT id FROM users WHERE email = '$email' OR nome = '$nome' LIMIT 1;");
			if (!$check)
			{
				executar("INSERT INTO users (nome, email, senha, cadastro) VALUES ('$nome', '$email', '$senha', '$cadastro');");

				//efetuar login
				$_SESSION['username'] = $email;
				$_SESSION['password'] = $senha;
				header("location: /");
				exit;
			} 
			else $log = $erro['cadastro_existente'];
		}
	}
	if (isset($log)) return '<div style="width:937px;max-width:100%" class="alert alert-danger"><strong>'.$log.'</strong></div>';
}

////////////////////////////////////////
//	- Redefinir senha
function redefinir($senha, $novasenha, $novasenha2)
{
	if(isset($_POST[$senha]) || isset($_POST[$$novasenha]) || isset($_POST[$novasenha2]))
	{
		global $erro;
		$senha = filtrar($_POST[$senha]);
		$novasenha = filtrar($_POST[$novasenha]);
		$novasenha2 = filtrar($_POST[$novasenha2]);
		
		if(empty($senha)) $log = $erro['config_senha'];
		elseif(empty($novasenha)) $log = $erro['config_novasenha'];
		elseif (strlen($novasenha) < 6) $log = $erro['config_senhacurta'];
		elseif(empty($novasenha2)) $log = $erro['config_novasenha2'];
		else 
		{
			$senha = desfoque($senha);
			$email = user('email');
			
			if ($senha === user('senha', $email))
			{
				if ($novasenha == $novasenha2)
				{
					$novasenha = desfoque($novasenha);
					executar("UPDATE users SET senha='$novasenha' WHERE email='$email'");
					$_SESSION['password'] = $novasenha;
					return '<div class="alert alert-success">Sua senha foi redefinida.</div>';
				}
				else $log = $erro['config_senhadiferente'];
			}
			else $log = $erro['config_senhaerrada'];
		}
	}
	if (isset($log)) return '<div class="alert alert-danger">'.$log.'</div>';
}

////////////////////////////////////////
//	- Gerador de senha
function gerar_senha($tamanho)
{
	$ma = "ABCDEFGHIJKLMNOPQRSTUVYXWZ";
	$mi = "abcdefghijklmnopqrstuvyxwz";
	$nu = "0123456789";

	$senha = str_shuffle($ma). str_shuffle($mi) . str_shuffle($nu);
	return substr(str_shuffle($senha),0,$tamanho);
}

////////////////////////////////////////
//	- Recupera senha
function recuperar($nome, $email)
{
	if(isset($_POST[$nome]) && isset($_POST[$email]))
	{
		global $erro;
		$nome = strtolower(filtrar($_POST[$nome]));
		$email = strtolower(filtrar($_POST[$email]));
		
		if(empty($nome)) $log = $erro['recuperar_nome'];
		elseif(empty($email)) $log = $erro['recuperar_email'];
		else
		{
			if ($nome == strtolower(user('nome', $email)))
			{
				$senha = gerar_senha(9);
				
				executar("UPDATE users SET senha='". desfoque($senha) ."' WHERE email='$email'");
				
				return '<div class="alert alert-success"><b>Nova senha:</b> '. $senha .'</div>';
			} else $log = $erro['recuperar_invalido'];
		}
	}
	
	if (isset($log)) return '<div style="width:937px;max-width:100%" class="alert alert-danger"><strong>'.$log.'</strong></div>';
}
