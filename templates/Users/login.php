<div class="users form">
    <h2>Loginaokd</h2>
    <?= $this->Form->create() ?>
    <fieldset>
        <?= $this->Form->control('email', ['required' => true, 'label' => 'Email']) ?>
        <?= $this->Form->control('password', ['required' => true, 'label' => 'Senha']) ?>
    </fieldset>
    <?= $this->Form->button('Entrar') ?>
    <?= $this->Form->end() ?>
    <p><?= $this->Html->link('Registrar novo usuário', ['action' => 'add']) ?></p>
</div>
