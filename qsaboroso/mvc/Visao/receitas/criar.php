                        <div class="col-md-12">
                            <h3 class="main-title">Cadastrar nova receita</h3>
                        </div>
                        <div class="row justify-content-center mb-5">
                            <div class="col-sm-12 col-md-10 col-lg-8">
                                <?php if ($mensagemFlash) : ?>
                                <div class="alert alert-success alert-dismissible">
                                    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                                    <?= $mensagemFlash ?>
                                </div>
                                <?php endif ?>
                                <form action="<?= URL_RAIZ . 'receitas' ?>" method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <label for="categoriaId">Categoria</label>
                                        <select class="form-control<?= $this->getErroCss('categoriaId') ?>" name="categoriaId" id="categoriaId">
                                            <option value="">Selecione...</option>
                                            <option value="1"<?= ($this->getPost('categoriaId') == 1) ? ' selected' : '' ?>>Salgado</option>
                                            <option value="2"<?= ($this->getPost('categoriaId') == 2) ? ' selected' : '' ?>>Doce</option>
                                            <option value="3"<?= ($this->getPost('categoriaId') == 3) ? ' selected' : '' ?>>Sobremesa</option>
                                            <option value="4"<?= ($this->getPost('categoriaId') == 4) ? ' selected' : '' ?>>Bebida</option>
                                        </select>
                                        <?php $this->incluirVisao('util/formErro.php', ['campo' => 'categoriaId']) ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="titulo">Título da receita</label>
                                        <input type="text" class="form-control<?= $this->getErroCss('titulo') ?>" name="titulo" id="titulo" value="<?= $this->getPost('titulo') ?>" placeholder="Digite o título da receita">
                                        <?php $this->incluirVisao('util/formErro.php', ['campo' => 'titulo']) ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="ingredientes">Ingredientes</label>
                                        <textarea class="form-control<?= $this->getErroCss('ingredientes') ?>" name="ingredientes" id="ingredientes" rows="3"><?= $this->getPost('ingredientes') ?></textarea>
                                        <?php $this->incluirVisao('util/formErro.php', ['campo' => 'ingredientes']) ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="modoPreparo">Modo de preparo</label>
                                        <textarea class="form-control<?= $this->getErroCss('modoPreparo') ?>" name="modoPreparo" id="modoPreparo" rows="3"><?= $this->getPost('modoPreparo') ?></textarea>
                                        <?php $this->incluirVisao('util/formErro.php', ['campo' => 'modoPreparo']) ?>
                                    </div>
                                    <div class="form-group">
                                        <label for="foto">Foto (somente PNG)</label>
                                        <input type="file" class="form-control-file<?= $this->getErroCss('foto') ?>" name="foto" id="foto">
                                        <?php $this->incluirVisao('util/formErro.php', ['campo' => 'foto']) ?>
                                    </div>
                                    <button type="submit" class="btn btn-primary">Cadastrar</button>
                                </form>
                            </div>
                        </div>
