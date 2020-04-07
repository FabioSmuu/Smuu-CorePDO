<?php
error_reporting(E_ALL & ~E_NOTICE & ~E_DEPRECATED & ~E_WARNING);

@session_start();
@require_once('pdo.php');
@require_once('query.php');
@require_once('session.php');

verificarsessao();
expirarplano();