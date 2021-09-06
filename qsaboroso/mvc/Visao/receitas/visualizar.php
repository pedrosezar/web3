						<div class="table-responsive">
							<?php if ($mensagemFlash) : ?>
							<div class="alert alert-success alert-dismissible">
								<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
								<?= $mensagemFlash ?>
							</div>
							<?php endif ?>
							<table class="table table-bordered table-striped">
								<thead class="thead-light">
									<tr class="table-dark text-center">
										<th scope="col">#</th>
										<th scope="col">Receita</th>
										<th scope="col">Ação</th>
									</tr>
								</thead>
								<tbody>
									<?php if (empty($receitas)) : ?>
									<tr>
										<td colspan="99" class="text-center">Nenhuma receita encontrada.</td>
									</tr>
									<?php endif ?>
									<?php foreach ($receitas as $i => $receita) : ?>
									<tr>
										<th scope="row"><?= ($i + 1) ?></th>
										<td><?= $receita->getTitulo() ?></td>
										<td class="text-center">
											<div class="row">
												<a href="<?= URL_RAIZ . 'receitas/' . $receita->getId() . '/editar' ?>" class="btn btn-warning btn-sm px-3 mr-3"> <i class="fa fa-pencil"></i></a>
												<form action="<?= URL_RAIZ . 'receitas/' . $receita->getId() ?>" method="post">
													<input type="hidden" name="_metodo" value="DELETE">
													<button type="submit" class="btn btn-danger btn-sm px-3 ml-3" title="Deletar"> <i class="fas fa-times"></i></button>
												</form>
											</div>
										</td>
									</tr>
									<?php endforeach; ?>
								</tbody>
							</table>
						</div>
