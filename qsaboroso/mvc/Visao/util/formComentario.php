							<div class="col-12 my-5">
								<form action="<?= URL_RAIZ . 'comentarios' ?>" method="post">
									<div class="input-group">
										<textarea class="form-control" name="comentario" id="comentario"></textarea>
										<div class="input-group-append">
											<button class="btn btn-outline-secondary" type="submit" id="button-addon"></button>
										</div>
										<input type="hidden" name="receitaId" value="<?= $receita->getId() ?>">
									</div>
								</form>
							</div>
