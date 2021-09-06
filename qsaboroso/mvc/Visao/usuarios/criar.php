						<div class="card" id="login">
							<div class="card-body">
								<h5 class="card-title text-center">Registre-se</h5>
								<?php if ($mensagemFlash) : ?>
								<div class="alert alert-success alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <?= $mensagemFlash ?>
                                </div>
								<?php endif ?>
								<form action="<?= URL_RAIZ . 'usuarios' ?>" method="post">
									<div class="form-group">
										<label for="nome">Nome</label>
										<input type="text" class="form-control<?= $this->getErroCss('nome') ?>" name="nome" id="nome" value="<?= $this->getPost('nome') ?>" placeholder="Digite seu nome">
										<?php $this->incluirVisao('util/formErro.php', ['campo' => 'nome']) ?>
									</div>
									<div class="form-group">
										<label for="email">E-mail</label>
										<input type="email" class="form-control<?= $this->getErroCss('email') ?>" name="email" id="email" value="<?= $this->getPost('email') ?>" aria-describedby="emailHelp" placeholder="Digite seu e-mail">
										<?php $this->incluirVisao('util/formErro.php', ['campo' => 'email']) ?>
										<small id="emailHelp" class="form-text text-muted">Nunca vamos compartilhar seu e-mail, com ninguém.</small>
									</div>
									<div class="form-group">
										<label for="senha">Senha</label>
										<input type="password" class="form-control<?= $this->getErroCss('senha') ?>" name="senha" id="senha" placeholder="Digite sua senha">
										<?php $this->incluirVisao('util/formErro.php', ['campo' => 'senha']) ?>
									</div>
									<button type="submit" class="btn btn-primary btn-lg btn-block">Registrar</button>
								</form>
							</div>
						</div>
