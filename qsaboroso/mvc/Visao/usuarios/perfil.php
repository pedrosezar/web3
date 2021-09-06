						<div class="row d-flex justify-content-center">
							<div class="col-md-10 mt-5 pt-5">
								<div class="row z-depth-3">
									<div class="col-sm-4 bg-info rounded-left">
										<div class="card-block text-center text-white">
											<i class="fas fa-user-tie fa-7x mt-5"></i>
											<h2 class="font-weight-bold mt-4"><?= $usuario->getPrimeiroNome() ?></h2>
											<i class="far fa-edit fa-2x mb-4"></i>
										</div>
									</div>
									<div class="col-sm-8 bg-white rounded-right">
										<h3 class="mt-3 text-center">Informações</h3>
										<hr class="badge-primary mt-0 w-25">
										<div class="row">
											<div class="col-sm-12">
												<p class="font-weight-bold">Nome:</p>
												<h6 class="text-muted"><?= $usuario->getNome() ?></h6>
											</div>
										</div>
										<div class="row">
											<div class="col-sm-12">
												<p class="font-weight-bold">Email:</p>
												<h6 class="text-muted"><?= $usuario->getEmail() ?></h6>
											</div>
										</div>
										<hr class="bg-primary">
										<div class="row">
											<div class="col-sm-6">
											<?php if ($contarReceitas > 0) : ?>
												<p class="font-weight-bold"><?= $contarReceitas ?> <span class="text-muted"><?= ($contarReceitas == 1) ? 'Receita' : 'Receitas' ?></span></p>
											<?php endif; ?>
											</div>
											<div class="col-sm-6">
											<?php if ($contarComentarios > 0) : ?>
												<p class="font-weight-bold"><?= $contarComentarios ?> <span class="text-muted"><?= ($contarComentarios == 1) ? 'Comentário' : 'Comentários' ?></span></p>
											<?php endif; ?>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
