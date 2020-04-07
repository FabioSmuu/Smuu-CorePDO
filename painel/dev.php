<?php
$pagina = 'dev';
$titulo = 'Painel ~ Developer';
$navtitulo = 'Area do Desenvolvedor';

@include_once 'include/dependencias.php';

//Se não tiver logado, vá para o diretorio "/".
logado(false, '/');

$autor = (isset($_GET['autor'])) ? filtrar($_GET['autor']) : null;

@include_once 'include/menu.php';
@include_once 'include/navbar.php';
?>

<?=devnovidade($autor)?>

<?php @include_once 'include/footer.php'; ?>