						<div class="card" id="login">
							<div class="card-body">
								<h5 class="card-title text-center">Login</h5>
								<form action="<?= URL_RAIZ . 'login' ?>" method="post">
									<div class="form-group">
										<label for="email">E-mail</label>
										<input type="email" class="form-control<?= $this->getErroCss('login') ?>" name="email" id="email" autofocus value="<?= $this->getPost('email') ?>" placeholder="Digite seu e-mail">
									</div>
									<div class="form-group">
										<label for="senha">Senha</label>
										<input type="password" class="form-control<?= $this->getErroCss('login') ?>" name="senha" id="senha" placeholder="Digite sua senha">
									</div>
									<?php if ($this->temErro('login')) : ?>
									<div class="alert alert-danger alert-dismissible">
										<button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
										<?= $this->getErro('login') ?>
									</div>
									<?php endif ?>
									<button type="submit" class="btn btn-success btn-lg btn-block">Entrar</button>
									<hr class="my-4">
									<div class="text-center mb-2">
										Não tem uma conta?
										<a href="<?= URL_RAIZ . 'usuarios/criar' ?>" class="register-link">Registre-se aqui</a>
									</div>
								</form>
							</div>
						</div>
