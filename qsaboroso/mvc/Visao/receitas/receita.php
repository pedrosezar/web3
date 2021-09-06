						<div class="row">
							<div class="col-12">
								<h3 class="main-title"><?= $receita->getTitulo() ?></h3>
							</div>
							<div class="col-md-6 mb-5">
								<img class="img-fluid" src="<?= URL_IMG . 'upload/' . $receita->getImagem() ?>" alt="Receita Culinária">
							</div>
							<div class="col-md-6">
								<h3 class="about-title">Ingredientes</h3>
								<ul class="about-list">
								<?php foreach ($receita->getIngredientes() as $ingrediente) : ?>
									<li><i class="fas fa-check"></i> <?= $ingrediente ?></li>
								<?php endforeach; ?>
								</ul>
								<h3 class="about-title">Modo de preparo</h3>
								<?php foreach ($receita->getModoPreparo() as $modoPreparo) : ?>
								<p><?= $modoPreparo ?></p>
								<?php endforeach; ?>
							</div>
						</div>
						<div class="row">
							<?php
							if ($this->getUsuario()) :
								$this->incluirVisao('util/formComentario.php');
							endif;
							foreach ($comentarios as $comentario) :
							?>
							<div class="col-12">
								<form action="<?= URL_RAIZ . 'comentarios/' . $comentario->getId() ?>" method="post">
									<input type="hidden" name="_metodo" value="DELETE">
									<div class="commentary">
										<h1 class="usuario"><?= $comentario->getUsuario()->getNome() ?></h1>
										<p class="comentario"><?= $comentario->getComentario() ?></p>
										<?php if ($comentario->getUsuarioId() == $this->getUsuario()) : ?>
										<button type="submit" class="btn btn-danger btn-sm px-3">Apagar comentário</button>
										<?php endif; ?>
									</div>
								</form>
							</div>
							<?php endforeach; ?>
						</div>
