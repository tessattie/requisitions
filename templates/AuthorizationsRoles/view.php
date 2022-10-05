<?php
/**
 * @var \App\View\AppView $this
 * @var \App\Model\Entity\AuthorizationsRole $authorizationsRole
 */
?>
<div class="row">
    <aside class="column">
        <div class="side-nav">
            <h4 class="heading"><?= __('Actions') ?></h4>
            <?= $this->Html->link(__('Edit Authorizations Role'), ['action' => 'edit', $authorizationsRole->id], ['class' => 'side-nav-item']) ?>
            <?= $this->Form->postLink(__('Delete Authorizations Role'), ['action' => 'delete', $authorizationsRole->id], ['confirm' => __('Are you sure you want to delete # {0}?', $authorizationsRole->id), 'class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('List Authorizations Roles'), ['action' => 'index'], ['class' => 'side-nav-item']) ?>
            <?= $this->Html->link(__('New Authorizations Role'), ['action' => 'add'], ['class' => 'side-nav-item']) ?>
        </div>
    </aside>
    <div class="column-responsive column-80">
        <div class="authorizationsRoles view content">
            <h3><?= h($authorizationsRole->id) ?></h3>
            <table>
                <tr>
                    <th><?= __('Authorization') ?></th>
                    <td><?= $authorizationsRole->has('authorization') ? $this->Html->link($authorizationsRole->authorization->name, ['controller' => 'Authorizations', 'action' => 'view', $authorizationsRole->authorization->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Role') ?></th>
                    <td><?= $authorizationsRole->has('role') ? $this->Html->link($authorizationsRole->role->name, ['controller' => 'Roles', 'action' => 'view', $authorizationsRole->role->id]) : '' ?></td>
                </tr>
                <tr>
                    <th><?= __('Id') ?></th>
                    <td><?= $this->Number->format($authorizationsRole->id) ?></td>
                </tr>
            </table>
        </div>
    </div>
</div>
