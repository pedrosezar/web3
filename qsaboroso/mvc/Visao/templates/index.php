<!DOCTYPE html>
<html lang="pt-br">
	<head>
		<!-- Meta tags Obrigatórias -->
		<meta charset="utf-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
		<!-- Bootstrap CSS -->
		<link rel="stylesheet" href="<?= URL_CSS . 'bootstrap.min.css' ?>">
		<link rel="stylesheet" href="<?= URL_CSS . 'geral.css' ?>">
		<title><?= APLICACAO_NOME ?></title>
	</head>
	<body>
		<div class="site">
			<header>
				<div class="container" id="nav-container">
					<nav class="navbar navbar-expand-lg navbar-dark">
						<a class="navbar-brand" href="<?= URL_RAIZ ?>">
							<img id="logo" src="<?= URL_IMG . 'logo.webp' ?>" alt="Logo QSaboroso">
						</a>
						<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbar-links" aria-controls="navbar-links" aria-expanded="false" aria-label="Toggle navigation">
							<span class="navbar-toggler-icon"></span>
						</button>
						<div class="collapse navbar-collapse justify-content-end" id="navbar-links">
							<ul class="navbar-nav">
							<?php if ($this->getUsuario()) : ?>
								<li class="nav-item active">
									<a class="nav-link" href="<?= URL_RAIZ ?>">Home <span class="sr-only">(página home)</span></a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="<?= URL_RAIZ . 'receitas/criar' ?>">Cadastrar Receita</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="<?= URL_RAIZ . 'receitas/visualizar' ?>">Visualizar Receitas</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="<?= URL_RAIZ . 'receitas/listar' ?>">Listar Receitas</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="<?= URL_RAIZ . 'receitas/relatorio' ?>">Relatório</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="<?= URL_RAIZ . 'usuarios/' . $this->getUsuario() ?>">Perfil</a>
								</li>
								<li class="nav-item">
									<form id="logout" action="<?= URL_RAIZ . 'login' ?>" method="post">
										<input type="hidden" name="_metodo" value="DELETE">
										<button type="submit" class="nav-link button">Sair</button>
									</form>
								</li>
							<?php else : ?>
								<li class="nav-item active">
									<a class="nav-link" href="<?= URL_RAIZ ?>">Home <span class="sr-only">(página home)</span></a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="<?= URL_RAIZ . 'receitas/listar' ?>">Listar Receitas</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="<?= URL_RAIZ . 'receitas/relatorio' ?>">Relatório</a>
								</li>
								<li class="nav-item">
									<a class="nav-link" href="<?= URL_RAIZ . 'login' ?>">Entrar</a>
								</li>
							<?php endif; ?>
							</ul>
						</div>
					</nav>
				</div>
			</header>
			<main>
				<div class="container-fluid">
					<div class="container">
					<?php $this->imprimirConteudo() ?>
					</div>
				</div>
			</main>
		</div>
		<footer>
			<div id="copy-area">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<p>Desenvolvido por <a href="">Pedro Sézar</a> &copy; <?= date('Y') ?></p>
						</div>
					</div>
				</div>
			</div>
		</footer>
		<!-- JavaScript (Opcional) -->
		<!-- jQuery primeiro, depois Popper.js, depois Bootstrap JS -->
		<script src="<?= URL_JS . 'jquery-3.1.1.min.js' ?>"></script>
		<script src="<?= URL_JS . 'popper.min.js' ?>"></script>
		<script src="<?= URL_JS . 'bootstrap.min.js' ?>"></script>
		<script src="https://kit.fontawesome.com/d8c9700b49.js" crossorigin="anonymous"></script>
	</body>
</html>
