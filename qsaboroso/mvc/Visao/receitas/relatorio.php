						<div class="row">
							<?php if ($contarUsuarios < 1) : ?>
							<div class="col-md-6">
								<div class="card text-center mb-3">
									<div class="card-body">
										<div class="icon icon-info mb-5">
											<img src="<?= URL_IMG . 'users.png' ?>">
										</div>
										<h6 class="stats-title">Nenhum usuário encontrado.</h6>
									</div>
								</div>
							</div>
							<?php else : ?>
							<div class="col-md-6">
								<div class="card text-center mb-3">
									<div class="card-body">
										<div class="icon icon-info">
											<img src="<?= URL_IMG . 'users.png' ?>">
										</div>
										<h3 class="info-title"><?= $contarUsuarios ?></h3>
										<h6 class="stats-title"><span class="text-muted"><?= ($contarUsuarios == 1) ? 'Usuário' : 'Usuários' ?></h6>
									</div>
								</div>
							</div>
							<?php endif; ?>
							<?php if ($contarReceitas < 1) : ?>
							<div class="col-md-6">
								<div class="card text-center mb-3">
									<div class="card-body">
										<div class="icon icon-info mb-5">
											<img src="<?= URL_IMG . 'recipes.png' ?>">
										</div>
										<h6 class="stats-title">Nenhuma receita encontrada.</h6>
									</div>
								</div>
							</div>
							<?php else : ?>
							<div class="col-md-6">
								<div class="card text-center mb-3">
									<div class="card-body">
										<div class="icon icon-info">
											<img src="<?= URL_IMG . 'recipes.png' ?>">
										</div>
										<h3 class="info-title"><?= $contarReceitas ?></h3>
										<h6 class="stats-title"><span class="text-muted"><?= ($contarReceitas == 1) ? 'Receita' : 'Receitas' ?></h6>
									</div>
								</div>
							</div>
							<?php endif; ?>
						</div>
