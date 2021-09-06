						<form class="form-inline" method="get">
							<label class="my-1 mr-2" for="ingrediente">Digite o ingrediente</label>
							<input type="text" class="form-control" name="ingrediente" id="ingrediente" value="<?= $this->getGet('ingrediente') ?>" placeholder="Digite o ingrediente">
							<label class="my-1 mx-2" for="data">Ordenar por data</label>
							<select class="custom-select my-1 mr-sm-4 filtro" name="data" id="data">
								<option value="desc"<?= ($this->getGet('data') == 'desc') ? ' selected' : '' ?>>Decrescente</option>
								<option value="asc"<?= ($this->getGet('data') == 'asc') ? ' selected' : '' ?>>Crescente</option>
							</select>
							<button type="submit" class="btn btn-primary my-1">Enviar</button>
						</form>
						<div class="table-responsive">
							<table class="table table-bordered table-striped">
								<thead class="thead-light">
									<tr class="table-dark text-center">
										<th scope="col">#</th>
										<th scope="col">Receita</th>
										<th scope="col">Usuário</th>
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
										<td><?= $receita->getUsuario()->getNome() ?></td>
									</tr>
									<?php endforeach; ?>
								</tbody>
								<tfoot>
									<tr>
										<th scope="row" colspan="3">
											<?php
											unset($_GET['p']);
											$gets = http_build_query($_GET);
											?>
											<nav aria-label="Navegação de página exemplo">
												<ul class="pagination justify-content-center">
													<?php if ($pagina > 1) : ?>
													<li class="page-item">
														<a class="page-link" href="<?= URL_RAIZ . 'receitas/listar?p=' . ($pagina - 1) . '&' . $gets ?>">Página anterior</a>
													</li>
													<?php
													endif;
													if ($ultimaPagina > 1) :
													?>
													<li class="page-item active">
														<span class="page-link"><?= $pagina ?><span class="sr-only">(atual)</span></span>
													</li>
													<?php
													endif;
													if ($pagina < $ultimaPagina) :
													?>
													<li class="page-item">
														<a class="page-link" href="<?= URL_RAIZ . 'receitas/listar?p=' . ($pagina + 1) . '&' . $gets ?>">Próxima página</a>
													</li>
													<?php endif; ?>
												</ul>
											</nav>
										</th>
									</tr>
								</tfoot>
							</table>
						</div>
