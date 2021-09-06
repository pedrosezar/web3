<?php if ($this->temErro($campo)): ?>
    <span class="invalid-feedback"><?= $this->getErro($campo) ?></span>
<?php endif ?>
