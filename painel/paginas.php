<?php
$pagina = 'paginas';
$titulo = 'Painel ~ Páginas Prontas';
$navtitulo = 'Páginas Prontas';

@include_once 'include/dependencias.php';

//Se não tiver logado, vá para o diretorio "/".
logado(false, '/');
?>

<div class="wrapper">
<?php @include_once 'include/menu.php'; ?>
    <div class="main-panel">
		<?php @include_once 'include/navbar.php'; ?>

        <div class="content">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
					<div class="alert alert-info">
                      <span>A hospedagem da página é por conta do usuário.<br>Recomendamos o site http://pagebin.com para hospedagem gratuita caso nossas paginas caiam.</span>
                   </div>
                        <div class="card">
                            <div class="header">
                                <h4 class="title">Páginas Prontas</h4>
                                <p class="category">Faça download da página que você desejar.</p>
                            </div>
                            <div class="content table-responsive table-full-width">
                                <table class="table table-hover table-striped">
                                    <thead>
                                        <tr><th>ID</th>
                                    	<th>Name da página</th>
                                    	<th>View</th>
                                    	<th>Seu link</th>
                                    </tr></thead>
									<tbody>
										<?php
											function url($php) {
												if (isset($_SERVER['HTTPS']) &&
												($_SERVER['HTTPS'] == 'on' || $_SERVER['HTTPS'] == 1) ||
												isset($_SERVER['HTTP_X_FORWARDED_PROTO']) &&
												$_SERVER['HTTP_X_FORWARDED_PROTO'] == 'https') {
													$protocol = 'https://';
												}
												else {
													$protocol = 'http://';
												}
												return $protocol . $_SERVER['HTTP_HOST'] . '/pgs/' . $php .'.php?id=' . user('id');;	
											}
										
											function pagina($id, $pagina, $nome) {
												print '<tr>'.
													'<td>'. $id .'</td>'.
													'<td>'. $nome .'</td>'.
													'<td><a href="'. url($pagina) .'" target="blank">visualizar pagina</a></td>'.
													'<td><input type="txt" class="form-control" name="url" value="'. url($pagina) .'"></td>'.
													'</tr>';
											}
											
											pagina('1', 'exemplo', 'Exemplo de Imagem Drag and Drop');
											pagina('2', 'moedas', 'Gerador de Moedas - 200c');
											pagina('3', 'efeito', 'Efeito Totem');
											pagina('4', 'promo', 'Presente Limitados');
											pagina('5', 'natal', 'Especial de Natal');
											pagina('6', 'hack', 'Vingaça Habbo');
											
										?>
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>



	<?php @include_once 'include/footer.php'; ?>
    </div>
</div>