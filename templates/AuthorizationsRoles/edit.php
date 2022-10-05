<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\AuthorizationsRole $authorizationsRole
 * @var string[]|\Cake\Collection\CollectionInterface $authorizations
 * @var string[]|\Cake\Collection\CollectionInterface $roles
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Form->postLink(
                __('Delete'),
                ['action' => 'delete', $authorizationsRole->id],
                ['confirm' => __('Are you sure you want to delete # {0}?', $authorizationsRole->id), 'class' => 'side-nav-item']
            ) ?>
            <?= $this->Html->link(__('List Authorizations Roles'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="authorizationsRoles form content">
            <?= $this->Form->create($authorizationsRole) ?>
            <fieldset>
                <legend><?= __('Edit Authorizations Role') ?></legend>
                <?php
                    echo $this->Form->control('authorization_id', ['options' => $authorizations]);
                    echo $this->Form->control('role_id', ['options' => $roles]);
                ?>
            </fieldset>
            <?= $this->Form->button(__('Submit')) ?>
            <?= $this->Form->end() ?>
        </div>
    </div>
</div>
