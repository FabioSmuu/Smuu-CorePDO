<?php
$pagina = 'adder';
$titulo = 'Painel ~ Novidades';
$navtitulo = 'novidades Email-Adder';

@include_once 'include/dependencias.php';

//Se não tiver logado, vá para o diretorio "/".
logado(false, '/');

@include_once 'include/menu.php';
@include_once 'include/navbar.php';
?>

<div>HTML qualquer</div>

<?php @include_once 'include/footer.php'; ?>