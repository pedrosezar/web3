						<div class="row">
							<div class="col-12">
								<h3 class="main-title">Últimas receitas</h3>
							</div>
							<?php if (empty($receitas)) : ?>
							<div class="col-lg-12">
								<div class="card text-center mb-3 destaque">
									<div class="card-body">
										<h3 class="card-title">Nenhuma receita encontrada.</h3>
									</div>
								</div>
							</div>
							<?php endif; ?>
							<?php foreach ($receitas as $receita) : ?>
							<div class="col-lg-4 col-md-6">
								<div class="card text-center mb-3 destaque">
									<img class="card-img-top" src="<?= URL_IMG . 'upload/' . $receita->getImagem() ?>" alt="imagem <?= $receita->getTitulo() ?>">
									<div class="card-body">
										<h5 class="card-title"><?= $receita->getTitulo() ?></h5>
										<p class="card-text text-muted"><?= $receita->getCategoria() ?></p>
									</div>
									<div class="card-footer">
										<a href="<?= URL_RAIZ . 'receitas/' . $receita->getId() ?>" class="btn btn-primary">Ver Receita</a>
									</div>
								</div>
							</div>
							<?php endforeach; ?>
						</div>
