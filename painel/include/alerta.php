<?php
@include_once '../../#/core.php';

logado(false, '/');
$novidade = user('novidades');
if ($novidade > 0) print $novidade;